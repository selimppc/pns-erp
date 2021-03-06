<?php

namespace backend\models;

use Yii;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
#use yii\base\Security;
use yii\web\IdentityInterface;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $last_access
 * @property string $status
 * @property string $ip_address
 * @property string $image
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                ],
            
        ];
    }

    public $repeat_password;
    public $new_password;
    public $current_password;
    public $roles;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'email', 'status','password'], 'required','on'=>'create'],
            [['first_name', 'last_name', 'username', 'email', 'status'], 'required','on'=>'update'],
            [['email'], 'required','on'=>'forgot_password'],
            [['password','repeat_password'], 'required','on'=>'reset_password'],


            [['username', 'email', 'password', 'password_reset_token', 'last_access', 'image'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'auth_key', 'password_reset_token', 'last_access'], 'string', 'max' => 64],
            #['repeat_password', 'compare', 'compareAttribute'=>'password' ],
            
            [['current_password','new_password', 'repeat_password'], 'required' , 'on' => 'change_password'],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password','on'=>'change_password'],
            ['current_password', 'findPasswords', 'on' => 'change_password'],
            [['first_name', 'last_name', 'username', 'email', 'password','password_reset_token', 'last_access','auth_key', 'roles'],'safe']
        ];


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'last_access' => Yii::t('app', 'Last Access'),
            'status' => Yii::t('app', 'Status'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'image' => Yii::t('app', 'Image'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new UsersQuery(get_called_class());
    }*/



    ##TODO:: Login Process Functions ##

    public function findPasswords($attribute, $params)
    {
        $user = self::find()->where(['id'=>Yii::$app->user->identity->id])->one();

        if (!$user->validatePassword($this->current_password)){
            $this->addError($attribute, 'Current Password Invalid.');
        }else{
            $this->clearErrors($attribute);
        }
    }

    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            //'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/



    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getCreateUserName()
    {
        return $this->createUser ? $this->createUser->first_name.' '.$this->createUser->last_name : '- no user -';
    }

    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getUpdateUserName()
    {
        return $this->updateUser ? $this->updateUser->first_name.' '.$this->updateUser->last_name : '- no user -';
    }


    /**
     * @param bool $object
     * @return array
     */
    public static function userList($object=false){
        $response = [];

        $data = User::find()->all();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                if($object){
                    $response[$value->id] = $value;
                }else{
                    $response[$value->id] = $value->first_name.' '.$value->last_name;
                }
            }
        }

        return $response;
    }


    /**
     * @param $model
     * @return array
     */
    public static function getRoles($model){
        $response = [];

        $array = [];
        $html = '';
        $assignments = Yii::$app->authmanager->getAssignments($model->id);

        $i=0;
        if(!empty($assignments)){
            foreach ($assignments  as $key => $value) {
                array_push($array, $value->roleName);

                if($i == 0){
                    $html .= $value->roleName;
                }else{
                    $html .= ', '.$value->roleName;
                }

                $i++;
            }
        }

        $response['array'] = $array;
        $response['html'] = $html;

        return $response;
    }





}
