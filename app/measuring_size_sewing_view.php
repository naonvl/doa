<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('measuring_size_sewing_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<?php

$from_date	            =    $_POST['from_date'];
$to_date		    	=    $_POST['to_date'];
$client_code          	=    $_POST['client_code'];
$status					=	 $_POST["status"];
$all			       	=    $_POST['all'];

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

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
					$delete = $segmen3; //$_REQUEST['mxKz'];
	                
					if ($delete == "xm8r389xemx23xb2378e23") {
						include 'class/class.delete.php';
						$delete2=new delete;
						$delete2->delete_measuring_size_sewing($segmen4);
				?>
						<div class="alert alert-success">
							<strong>Delete Data successfully</strong>
						</div>
	                    
	                    <meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('measuring_size_sewing_view') ?>" />
				<?php
	                    
	                    
					}
				?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="measuring_size_sewing_view" id="measuring_size_sewing_view" enctype="multipart/form-data" >

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
                                                <p class="mb-1">Customer</p>
                                                <select id="client_code" name="client_code" class="destroy-selector">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("client","syscode","name","active","1", $client_code)
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
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
	                                    <th><?php if($lng==1) { echo 'PO No'; } else { echo 'No. PO'; } ?></th>
	                                    <th><?php if($lng==1) { echo 'MS No'; } else { echo 'No. MS'; } ?></th>
										<th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
										<th><?php if($lng==1) { echo 'Client'; } else { echo 'Customer'; } ?></th>
										<th>Qty</th>
										<th><?php if($lng==1) { echo 'Updated By'; } else { echo 'Diupdate Oleh'; } ?></th>
										<th><?php if($lng==1) { echo 'Date Last Update'; } else { echo 'Terakhir edit'; } ?></th>
										<th>Edit|Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php			
										$i = 0;
										$j = 0;
	            						$sql=$select->list_measuring_size_sewing($kode, $from_date, $to_date, $client_code);
							            while($row_sewing=$sql->fetch(PDO::FETCH_OBJ)){
	            						
	            						$i++;
	            						
									?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td> 
	                                            <th>
	                                            	<?php echo $row_sewing->so_ref ?>
	                                            </th>
	                                            <td><?php echo $row_sewing->ref ?></td>
							                    <td><?php echo $row_sewing->date ?></td>
							                    <td><?php echo $row_sewing->client_name ?></td>
												<td><?php echo number_format($row_sewing->qty,0,'.',',') ?></td>
												<td><?php echo $row_sewing->uid ?></td>
												<td><?php echo $row_sewing->dlu ?></td>

                                                <td align="center">

                                                    <?php if (allowupd('frmmeasuring_size_sewing')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('measuring_size_sewing') ?>/<?php echo $row_sewing->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmmeasuring_size_sewing')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_sewing->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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