<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('delivery_order_list') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<script type="text/javascript">
    function excel_export() {
        var from_date           =    document.getElementById('from_date').value;
        var to_date             =    document.getElementById('to_date').value;
        var all                 =    document.getElementById('all').checked;
        var expedition_id       =    document.getElementById('expedition_id').value;

        if(all == true) { all = 1; }
        if(all == false) { all = 0; }

        document.location.href = "app/delord_view_xls.php?from_date="+from_date+"&to_date="+to_date+"&expedition_id="+expedition_id+"&all="+all+"";   

    }
</script>

<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$client_code            =    $_REQUEST['client_code'];
$expedition_id          =    $_REQUEST["expedition_id"];
$all                    =    $_REQUEST['all'];

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
                        $delete2->delete_delivery_order($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('delivery_order_list'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="row" role="form" action="" method="post" name="delivery_order_view" id="delivery_order_view" class="form-horizontal" enctype="multipart/form-data" >

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
                                                <p class="mb-1">Ekspedisi</p>
                                                <select class="destroy-selector" id="expedition_id" name="expedition_id">
                                                    <option value=""></option>
                                                    <?php combo_select_active('expedition', 'id', 'name', 'active', '1', $expedition_id) ?>
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
                                                &nbsp;&nbsp;<a href="JavaScript:excel_export()">
                                                    <img src="images/excel.jpg" />
                                                </a>
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
                                        <th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Pengirim'; } ?></th>  
                                        <th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Penerima'; } ?></th>  
                                        <th><?php if($lng==1) { echo 'Qty'; } else { echo 'qty'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Amount'; } else { echo 'Jumlah Ongkir'; } ?></th>
                                        <th>Edit/Hapus</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php         
                                        $total_qty = 0;
                                        $total_expedition = 0;
                                        $sql=$select->list_delivery_order("", $from_date, $to_date, $all, $expedition_id);
                                        while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                                /*$item_name = "";
                                                $sql2=$select->list_delivery_order_detail($row_delivery_order->ref);
                                                while($row_delivery_order_det=$sql2->fetch(PDO::FETCH_OBJ)) {
                                                    if($item_name == "") {
                                                        $item_name =  $row_delivery_order_det->item_name; 
                                                    } else {
                                                        $item_name =  $item_name . '<br>' . $row_delivery_order_det->item_name; 
                                                    }
                                                       
                                                }*/
                                                
                                                $style = "";
                                                $status = $row_delivery_order->status;
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
                                                

                                                $total_qty = $total_qty + $row_delivery_order->qty;
                                                $total_expedition = $total_expedition + $row_delivery_order->freight_cost;
                                                
                                        $i++;
                                    ?>
                                                
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_delivery_order->ref ?></td>
                                                <td><?php echo $row_delivery_order->date ?></td>
                                                <td><?php echo $row_delivery_order->location_name ?></td>
                                                <td><?php echo $row_delivery_order->uid ?></td>
                                                <td><?php echo $row_delivery_order->client_name ?></td>
                                                <td align="right"><?php echo number_format($row_delivery_order->qty,"0",".",",") ?></td>
                                                <td align="right"><?php echo number_format($row_delivery_order->freight_cost,"0",".",",") ?></td>
                                                <td>
                                                
                                                    <?php if (allowupd('frmdelivery_order')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('delord') ?>/<?php echo $row_delivery_order->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmdelivery_order')==1) { ?>    
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_delivery_order->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                                
                                            </tr>
                                        
                                        <?php
                                            }
                                        ?>
                                </tbody>
                                <tr style="font-size: 14px; font-weight: bold;">
                                    <td align="right" colspan="6">TOTAL</td>
                                    <td align="right"><?php echo number_format($total_qty,"0",".",",") ?></td>
                                    <td align="right"><?php echo number_format($total_expedition,"0",".",",") ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.page-content -->
