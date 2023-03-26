 <div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
    <h5 class="mb-3">Nama Barang</h5>
    <div style="width: 300px;max-width: 100%;">
        <select id="item_code" name="item_code" class="destroy-selector" onchange="loadHTMLPost3('<?php echo $__folder ?>app/outbound_detail_ajax.php','item_ajax','getdata2','item_code','warehouse_id_from')" >
			<option value=""></option>
			<?php 
				select_item("")
			?>	

		</select>	
    </div>
</div>

<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-flush" id="example">
            <thead class="thead-light">
                <tr>
                    <th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode Barang'; } ?></th>
					<th width="40%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th> 
					<th>Satuan</th> 									 
					<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml Barang'; } ?></th>
                </tr>
            </thead>
            <tbody>
                <tr id="item_ajax">
                    
                </tr>
            </tbody>
        </table>
    </div>
</div>
