DELIMITER ;;
CREATE DEFINER=`reza`@`localhost` PROCEDURE `sp_im_confirm_grn_2`(im_grn_head_id INT, user_id VARCHAR(50))
BEGIN
	DECLARE vImNumber, vGrnNumber, vStoreId, vBatchNumber, vSupName, vUnit VARCHAR(50);
	DECLARE vExchangeRate, vRate, vExchRate DECIMAL(20,8);
	DECLARE vId, vRcvQuantity, vSupplierId, vCurrencyId, vProductId, vStoreCurrId INT;
	DECLARE vExpireDate DATE;

	DECLARE No_DATA INT DEFAULT 0;

	DECLARE CurGrn CURSOR FOR -- This cursor declare for GRN Table

	SELECT b.id, a.`grn_number`, a.`branch_id`, b.`product_id`, b.`batch_number`, b.`expire_date`, a.`supplier_id`,
				 (b.`receive_quantity`) AS Quantity, ROUND(b.`cost_price`,2) AS CostPrice,
				 a.`currency_id`, a.`exchange_rate`,c.`stock_uom`

	FROM `im_grn_head` a
	INNER JOIN `im_grn_detail` b ON a.`id`=b.`im_grn_head_id`
	INNER JOIN `product` c ON b.`product_id`=c.`id`
	WHERE a.`id`=im_grn_head_id AND a.`status`='open'; -- Declaration close

	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN CurGrn; /******Cursor open here**********/

	FETCH FROM CurGrn INTO vId, vGrnNumber, vStoreId, vProductId, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrencyId, vExchRate, vUnit;
	WHILE No_DATA=0 DO -- 1
		SELECT org_name INTO vSupName FROM `supplier` WHERE `id`=vSupplierId;
		SELECT fu_get_trn('IM TRANSACTION','PO--',8) INTO vImNumber;

		INSERT INTO `im_transaction`
		(`transaction_number`, `product_id`, `branch_id`, `batch_number`, `currency_id`, `exchange_rate`, `date`, `expire_date`, `uom`, `quantity`, `sign`,
		`rate`, `total_price`, `base_value`, `reference_number`, `reference_row`, `note`, `status`,
		`created_by`, `updated_by`, `created_at`, `updated_at`)

		VALUES
		(vImNumber, vProductId, vStoreId, vBatchNumber, vCurrencyId, vExchRate, CURRENT_DATE, vExpireDate, vUnit, vRcvQuantity, 1,
		 vRate*vExchRate, vRate*vRcvQuantity, (vRate*vRcvQuantity)*vExchRate, vGrnNumber, vId, vSupName, 'open',
		 user_id, NULL, CURRENT_TIMESTAMP, NULL);

	FETCH FROM CurGrn INTO vId, vGrnNumber, vStoreId, vProductId, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrencyId, vExchRate, vUnit;
	END WHILE; -- 1
	CLOSE CurGrn;

	-- Update im_grndetail Set c_status='Confirmed' Where im_grnnumber=vGrnNumber;
	UPDATE `im_grn_head` SET status='confirmed' WHERE id=im_grn_head_id;

END;;
DELIMITER ;

