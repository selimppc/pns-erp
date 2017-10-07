<table class="table table-striped table-bordered detail-view">
	<tr>
		<th>Product Code</th>
		<td><?=$model->product_code?></td>
		<th>Product Title</th>
		<td><?=$model->title?></td>
	</tr>

	<tr>
		<th>Product Class</th>
		<td><?=isset($model->product_class)?$model->product_class->title:''?></td>
		<th>Product Group</th>
		<td><?=isset($model->product_group)?$model->product_group->title:''?></td>
	</tr>

	<tr>
		<th>Product Category</th>
		<td><?=isset($model->product_category)?$model->product_category->title:''?></td>
		<th>Product Model</th>
		<td><?=$model->model?></td>
	</tr>

	<tr>
		<th>Product Size</th>
		<td><?=$model->size?></td>
		<th>Product Origin</th>
		<td><?=$model->origin?></td>
	</tr>

	<tr>
		<th>Manufacturer Code</th>
		<td><?=$model->manufacturer_code?></td>
		<th>Manufacturer Year</th>
		<td><?=$model->manufacturer_year?></td>
	</tr>

	<tr>
		<th>Speed</th>
		<td><?=$model->speed?></td>
		<th>Machine Size</th>
		<td><?=$model->machine_size?></td>
	</tr>

	<tr>
		<th>Generic</th>
		<td><?=$model->generic?></td>
		<th>Stock Type</th>
		<td><?=$model->stock_type?></td>
	</tr>

	<tr>
		<th>Supplier</th>
		<td><?=isset($model->supplier)?$model->supplier->supplier_code:''?></td>
		<th>Sell Rate</th>
		<td><?=$model->sell_rate?></td>
	</tr>

	<tr>
		<th>Product Sell UOM</th>
		<td><?=isset($model->product_sell_uom)?$model->product_sell_uom->title:''?></td>
		<th>Cost Price</th>
		<td><?=$model->cost_price?></td>
	</tr>

	<tr>
		<th>Product Purchase UOM</th>
		<td><?=isset($model->product_purchase_uom)?$model->product_purchase_uom->title:''?></td>
		<th>Purchase UOM Qty</th>
		<td><?=$model->purchase_uom_qty?></td>
	</tr>

	<tr>
		<th>Product Stock UOM</th>
		<td><?=isset($model->product_stock_uom)?$model->product_stock_uom->title:''?></td>
		<th>Stock UOM Qty</th>
		<td><?=$model->stock_uom_qty?></td>
	</tr>

	<tr>
		<th>Pack Size</th>
		<td><?=$model->pack_size?></td>
		<th>Currency</th>
		<td><?=isset($model->currency)?$model->currency->title:''?></td>
	</tr>

	<tr>
		<th>Exchange Rate</th>
		<td><?=$model->exchange_rate?></td>
		<th>Max Level</th>
		<td><?=$model->max_level?></td>
	</tr>

	<tr>
		<th>Min Level</th>
		<td><?=$model->min_level?></td>
		<th>Re Order</th>
		<td><?=$model->re_order?></td>
	</tr>

</table>