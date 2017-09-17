<table class="table table-striped table-bordered detail-view">
               
    <tr>
        <th>Purchase Order No</th>
        <th>Date</th>
        <th>Supplier</th>
        <th>Payment Terms</th>
        <th>Delivery Date</th>
        <th>Branch</th>
        <th>Currency</th>
        <th>Exchange Rate</th>
        <th>Prime Amount</th>
        <th>Net Amount</th>
        <th>Status</th>
    </tr>

    <tr>
        <td><?=$model->po_order_number?></td>
        <td><?=$model->date?></td>
        <td><?=isset($model->supplier)?$model->supplier->supplier_code:''?></td>
        <td><?=$model->pay_terms?></td>
        <td><?=$model->delivery_date?></td>
        <td><?=isset($model->branch)?$model->branch->title:''?></td>
        <td><?=isset($model->currency)?$model->currency->currency_code:''?></td>
        <td><?=number_format($model->exchange_rate,3)?></td>
        <td><?=number_format($model->prime_amount,3)?></td>
        <td><?=number_format($model->net_amount,3)?></td>
        <td><?=ucfirst($model->status)?></td>
    </tr>
    
</table>

<?php
    if(!empty($purchased_order_details))
    {
?>
    <div class="panel panel-default">
        <div class="panel-heading" style="padding: 5px 10px">
            <i class="fa fa-envelope"></i> Purchase Order Details
           
        </div>

        <table class="table table-striped table-bordered detail-view">
            
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit of Measurment</th>
                <th>UOM Quantity</th>
                <th>Purchased Rate</th> 
                <th>Line Total</th>   
            </tr>

            <?php
                foreach($purchased_order_details as $po_details)
                {
            ?>
                    <tr>
                        <td>
                            <?=isset($po_details->product)?$po_details->product->title:'';?>
                                
                        </td>

                        <td>
                            <?=$po_details->quantity?>
                                
                        </td>

                        <td>
                            <?=isset($po_details->uomData)?$po_details->uomData->title:''?>
                                
                        </td>

                        <td>
                            <?=$po_details->uom_quantity?>
                                
                        </td>

                        <td>
                            <?=number_format($po_details->purchase_rate,3)?>
                                
                        </td>

                        <td>
                            <?=number_format($po_details->purchase_rate*$po_details->quantity,3)?>
                        </td>
                    </tr>
            <?php
                }
            ?>

        </table>
    </div>
<?php
    }
?>