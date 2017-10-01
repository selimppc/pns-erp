DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_ConfirmGRN`(p_id INT, p_insertuser VARCHAR(50))
BEGIN
	DECLARE vImNumber,vGrnNumber,vStore,vProCode,vBatchNumber,vSupplierId,vSupNmae,vUnit,vCurrency,vStoreCur VARCHAR(50);
	DECLARE vExchangeRate,vRate,vExchRate DECIMAL(20,5);

	DECLARE vId,vRcvQuantity INT;
	DECLARE vExpireDate DATE;

	DECLARE No_DATA INT DEFAULT 0;

	DECLARE CurGrn CURSOR FOR -- This cursor declare for GRN Table

	SELECT b.id, a.im_grnnumber, a.im_store, b.cm_code, b.im_BatchNumber, b.im_ExpireDate, a.cm_supplierid,
				 (b.im_RcvQuantity*b.im_unitqty)/c.cm_stkconfac AS Quantity, ROUND(b.im_costprice,2) AS CostPrice,
				 a.im_currency, a.im_exchrate,c.cm_stkunit
	FROM im_grnheader a
	INNER JOIN im_grndetail b ON a.im_grnnumber=b.im_grnnumber
	INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code
	WHERE a.id=p_id AND a.im_status='Open'; -- Declaration close
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN CurGrn; /******Cursor open here**********/
	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency, vExchRate,vUnit;
	WHILE No_DATA=0 DO -- 1
		SELECT cm_orgname INTO vSupNmae FROM cm_suppliermaster WHERE cm_supplierid=vSupplierId;
		SELECT Fu_GetTrn('Im Transaction','PO--',8,0) INTO vImNumber;

		INSERT INTO im_transaction
		(im_number, cm_code, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit,
		 im_rate, im_totalprice, im_basevalue, im_RefNumber, im_RefRow, im_note, im_status,cm_supplierid, im_currency,
		 im_ExchangeRate, inserttime, insertuser,im_foreignrate)
		VALUES
		(vImNumber, vProCode, vStore, vBatchNumber, CURRENT_DATE, vExpireDate, vRcvQuantity, 1, vUnit,
		 vRate*vExchRate, vRate*vRcvQuantity,(vRate*vRcvQuantity)*vExchRate, vGrnNumber, vId, vSupNmae, 'Open', vSupplierId, vCurrency,
		 vExchRate, CURRENT_TIMESTAMP, p_insertuser,vRate);

	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency, vExchRate,vUnit;
	END WHILE; -- 1
	CLOSE CurGrn;

	-- Update im_grndetail Set c_status='Confirmed' Where im_grnnumber=vGrnNumber;
	UPDATE im_grnheader SET im_status='Confirmed' WHERE id=p_id;

END;;
DELIMITER ;