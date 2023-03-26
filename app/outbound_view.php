<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo obraxabrix('outbound_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<?php

$from_date	            =    $_REQUEST['from_date'];
$to_date		    	=    $_REQUEST['to_date'];
$all			       	=    $_REQUEST['all'];

if($from_date == "") {
	$from_date = date("d F, Y");
}

if($to_date == "") {
	$to_date = date("d F, Y");
}

if($all == 1 || $all == true) {
	$all2 = "checked";
}
		
?>

<script type="text/javascript">
	function print() {
        var from_date	        =    document.getElementById('from_date').value;
		var to_date		    	=    document.getElementById('to_date').value;
		var all			       	=    document.getElementById('all').checked;

		if(all == true) { all = 1; }
		if(all == false) { all = 0; }

        window.open('<?php echo $__folder ?>app/outbound_print.php?from_date=' + from_date + '&to_date=' + to_date + '&all=' + all , 'Pemindahan Barang Print', '825', '450', 'resizable=1,scrollbars=1,status=0,toolbar=0')

    }

    function printout(ref) {
		window.open('<?php echo $__folder ?>app/outbound_printout.php?ref=' + ref, 'Pemindahan Barang Print', '825', '450', 'resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>

<div class="content-body">
    <div class="container-fluid">						
		<div class="row">
			<div class="col-xl-12">
	                
	            <?php
					$delete = $segmen3; //$_REQUEST['mxKz'];
					if ($delete == "xm8r389xemx23xb2378e23") {
						include 'class/class.delete.php';
						$delete2=new delete;
						$delete2->delete_outbound($segmen4);
				?>
						<div class="alert alert-success">
							<strong>Delete Data successfully</strong>
						</div>
	                    
	                    <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('outbound_view'); ?>" />
				<?php
	                    
	                    
					}
				?>
				            
	            <!-- PAGE CONTENT BEGINS -->
	            <div class="row">
	            	<div class="col-lg-12">
                        <div class="card">
			                <form class="form-horizontal" role="form" action="" method="post" name="purchase_view" id="purchase_view" class="form-horizontal" enctype="multipart/form-data" >

								<div class="card-body">
		                            <div class="row">
		                                <div class="col-xl-4 mb-3">
		                                    <div class="example">
		                                        <p class="mb-1">Dari Tanggal</p>
		                                        <input type="text" name="from_date" class="datepicker-default form-control" id="from_date" autocomplete="off" value="<?php echo $from_date ?>">
		                                    </div>
		                                </div>
		                                <div class="col-xl-4 mb-3">
		                                    <div class="example">
		                                        <p class="mb-1">s/d Tanggal</p>
		                                        <input type="text" name="to_date" class="datepicker-default form-control" id="to_date" autocomplete="off" value="<?php echo $to_date ?>">
		                                    </div>
		                                </div>                                
		                            </div>

		                            <div class="row">
		                                <div class="col-xl-4 mb-3">
		                                    <div class="example">
		                                    	<p class="mb-1">All</p>
		                                        <input id="all" name="all" type="checkbox" class="form-check-input" value="1" <?php echo $all2 ?> >
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="row">
		                                <div class="col-xl-4 mb-3">
		                                    <div class="example">
		                                        <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>&nbsp;&nbsp;
		                                        <input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
								
							</form>
						</div>
					</div>
				</div>
				
				    
				<!-- PAGE CONTENT BEGINS -->
				<div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
						
							<table id="example" class="display">
								<thead>
									<tr>
	                                    <th class="center" style="font-weight:bold ">No.</th>
	                                    <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Ref.'; } ?></th>
										<th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
										<th><?php if($lng==1) { echo 'From Location'; } else { echo 'Dari Gudang'; } ?></th>
										<th><?php if($lng==1) { echo 'To Location'; } else { echo 'Ke Gudang'; } ?></th>									<th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Pengirim'; } ?></th>	
										<th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Penerima'; } ?></th>	
										<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jumlah'; } ?></th>
				                        <th><?php if($lng==1) { echo 'Status'; } else { echo 'Status'; } ?></th>
				                        <th><?php if($lng==1) { echo 'Print'; } else { echo 'Print'; } ?></th>
										<th>Edit|Delete</th>
									</tr>
								</thead>

								<tbody>
	                                <?php			
										$sql=$select->list_outbound("", $from_date, $to_date, $all);
										while($row_outbound=$sql->fetch(PDO::FETCH_OBJ)){
										
				                            $style = "";
			                                $status = $row_outbound->status;
			                                if($status == "P") {
												$status = "Planned";
											}
											if($status == "R") {
												$status = "Released";
											}
											if($status == "C") {
												$status = "Receipt";
												$style = 'style="color: #ff0000; font-weight: bold;"';
											}
				                                
										$i++;
									?>
	                                            
	                                        <tr <?php echo $void_color ?> >
	                                            <td><?php echo $i ?></td>
	                                            <td><?php echo $row_outbound->ref ?></td>
							                    <td><?php echo $row_outbound->date ?></td>
							                    <td><?php echo $row_outbound->from_location ?></td>
							                    <td><?php echo $row_outbound->to_location ?></td>
							                    <td><?php echo $row_outbound->employee_name ?></td>
							                    <td><?php echo $row_outbound->employee_name2 ?></td>
												<td align="right"><?php echo number_format($row_outbound->qty,"0",".",",") ?></td>
												<td <?php echo $style ?>><?php echo $status ?></td>
												<td align="center">
													<a href="JavaScript:printout('<?php echo $row_outbound->ref ?>')" ><img src="images/print.png" ></a>
	                                            </td>
												<td align="center">
	                                            
	                                                <?php if (allowupd('frmoutbound')==1) { ?>
	    												<a href="<?php echo $__folder ?><?php echo obraxabrix('outbound') ?>/<?php echo $row_outbound->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
	                                                <?php } ?>
	                                                
	                                                <?php if (allowdel('frmoutbound')==1) { ?>   
	                                            	    &nbsp;
	                                            	    <a href="JavaScript:hapus('<?php echo $row_outbound->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
	                                                <?php } ?>

	                                            </td>
	                                            
	                                                        
											</tr>
	                                    
	                                    <?php
	                                        }
	                                    ?>
	                                    
								</tbody>

							</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
</div><!-- /.page-content -->
