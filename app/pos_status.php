<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$shift                  =    $_REQUEST['shift'];
$cashier                =    $_REQUEST['cashier'];
$employee_id            =    $_POST["employee_id"];
$status                 =    $_POST["status"];
$all                    =    $_REQUEST['all'];

/*if($shift == "") {
    $shift = $_SESSION["shift"];
}*/

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
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('pos_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<script>
    function print() {
        var from_date   =    document.getElementById('from_date').value;
        var to_date     =     document.getElementById('to_date').value;
        var shift       =     document.getElementById('shift').value;
        var cashier     =     document.getElementById('cashier').value;
        var all         =     0; //document.getElementById('all').value;
        
        window.location = "app/pos_view_print_create.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier+"&all="+all; //localhost only
        //window.location = "app/pos_view_print_create_ol.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier; //internet only
        
        
    }
</script>

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
                    $delete = $segmen3; //$_REQUEST['mxKz'];
                    //$segmen4 = $_REQUEST['id'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_pos($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('pos_view'); ?>" />
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
                                                <p class="mb-1">Kasir</p>
                                                <select id="employee_id" name="employee_id" class="chosen-select form-control" >
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("employee","id","name","active","1",$employee_id);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Status</p>
                                                <select id="status" name="status" class="chosen-select form-control" >
                                                    <option value=""></option>
                                                    <?php 
                                                        select_poas_status($status);
                                                    ?>
                                                </select>
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
                                                <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                <?php
                    if($_POST['submit'] == "update_status") {
                        include("app/exec/pos_insert.php");
                    }
                ?>

                <!-- PAGE CONTENT BEGINS -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <form class="form-horizontal" role="form" action="" method="post" name="pos_view" id="pos_view" enctype="multipart/form-data">
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th class="center" style="font-weight:bold ">No.</th>
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Nota'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Time'; } else { echo 'Jam'; } ?></th>
                                        <th>Customer</th>
                                        <th>Detail Sales</th>
                                        <th>Paid</th>
                                        <th>Print</th>    
                                        <th>Process Warehouse</th>
                                        <th>On Shipped</th>
                                        <th>Terkirim</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $grand_gross_sales = 0;
                                        $grand_net_sales = 0;
                                        $grand_cogs = 0;
                                        $grand_gross_profit = 0;
                                        $grand_total = 0;
                                        $grand_discount = 0;
                                        $grand_cash     = 0;
                                        $grand_bank     = 0;
                                        $grand_total_owner = 0;
                                        $grand_total_capster = 0;       
                                        $i = 0;     
                                        $j = 0;                            
                                        $sql=$select->list_pos('', $all, $from_date, $to_date, $shift, $cashier, $employee_id, '', '', '', '', $status);
                                        while($row_pos=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <input type="hidden" id="ref_<?php echo $j ?>" name="ref_<?php echo $j ?>" value="<?php echo $row_pos->ref ?>"/>
                                                <input type="hidden" id="old_onshipped_<?php echo $j ?>" name="old_onshipped_<?php echo $j ?>" value="<?php echo $row_pos->onshipped ?>"/>

                                                <td><?php echo $i ?></td> 
                                                <td><?php echo $row_pos->ref ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($row_pos->date)) ?></td>
                                                <td><?php echo date("H:i", strtotime($row_pos->dlu)) ?></td>
                                                <td><?php echo $row_pos->client_name ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" name="Find" title="Detail" onClick=window.open("<?php echo $__folder ?>app/pos_status_detail.php?ref=<?php echo $row_pos->ref ?>","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); />
                                                        <?php echo $row_pos->ref ?>
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <?php if($row_pos->paid == 1) { ?>
                                                        <img src="images/check.png">
                                                        <input id="paid_<?= $j ?>" name="paid_<?= $j ?>" type="hidden" value="1" >
                                                    <?php } else { ?>
                                                        <input id="paid_<?= $j ?>" name="paid_<?= $j ?>" type="checkbox" class="form-check-input" value="1" >
                                                    <?php } ?>
                                                </td>   
                                                <td align="center">
                                                    <?php if($row_pos->print == 1) { ?>
                                                        <img src="images/check.png">
                                                        <input id="print_<?= $j ?>" name="print_<?= $j ?>" type="hidden" value="1" >
                                                    <?php } else { ?>
                                                        <input id="print_<?= $j ?>" name="print_<?= $j ?>" type="checkbox" class="form-check-input" value="1" >
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                    <?php if($row_pos->process_whs == 1) { ?>
                                                        <img src="images/check.png">
                                                        <input id="process_whs_<?= $j ?>" name="process_whs_<?= $j ?>" type="hidden" value="1" >
                                                    <?php } else { ?>
                                                        <input id="process_whs_<?= $j ?>" name="process_whs_<?= $j ?>" type="checkbox" class="form-check-input" value="1" >
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                    <?php if($row_pos->onshipped == 1) { ?>
                                                        <img src="images/check.png">
                                                        <input id="onshipped_<?= $j ?>" name="onshipped_<?= $j ?>" type="hidden" value="1" >
                                                        <input id="onshipped_old_<?= $j ?>" name="onshipped_old_<?= $j ?>" type="hidden" value="1" >
                                                    <?php } else { ?>
                                                        <input id="onshipped_<?= $j ?>" name="onshipped_<?= $j ?>" type="checkbox" class="form-check-input" value="1" >
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                    <?php if($row_pos->shipped == 1) { ?>
                                                        <img src="images/check.png">
                                                        <input id="shipped_<?= $j ?>" name="shipped_<?= $j ?>" type="hidden" value="1" >
                                                    <?php } else { ?>
                                                        <input id="shipped_<?= $j ?>" name="shipped_<?= $j ?>" type="checkbox" class="form-check-input" value="1" >
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        
                                        <?php
                                                $j++;
                                            }
                                        ?>
                                        
                                </tbody>
                                <tr>
                                    <td colspan="9" align="right">
                                        <button type="submit" name="submit" id="submit" class="btn btn-white btn-danger btn-bold" value="update_status" onClick="return confirm('Apakah yakin akan update status?')">
                                            Update Status
                                        </button>
                                    </td>
                                </tr>

                            </table>

                            <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $j ?>"/>

                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.page-content -->
