<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$shift                  =    $_REQUEST['shift'];
$cashier                =    $_REQUEST['cashier'];
$employee_id            =    $_POST["employee_id"];
$all                    =    $_REQUEST['all'];

/*if($shift == "") {
    $shift = $_SESSION["shift"];
}*/

/*if($from_date == "") {
    $from_date = date("d F, Y");
}

if($to_date == "") {
    $to_date = date("d F, Y");
}*/

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
                
                    
                <!-- PAGE CONTENT BEGINS -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th class="center" style="font-weight:bold ">No.</th>
                                        <td align="center">No. Invoice</td>
                                        <td align="center">Tanggal</td>
                                        <td align="center">Nama Customer</td>
                                        <td align="center">Status</td>
                                        <td align="center">Barang</td>
                                        <td align="center">Kirim</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $no = 0;
                                        $sql=$select->get_sales_invoice_list('', $all, $from_date, $to_date, $shift, $cashier, $employee_id);
                                        $jmldata = $sql->rowCount();
                                        while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
                                            
                                            $status = "";
                                            if($row_item->status == "P") {
                                                $status = "Planned";
                                            }
                                            if($row_item->status == "R") {
                                                $status = "Order";
                                            }
                                            if($row_item->status == "D") {
                                                $status = "Bayar";
                                            }
                                            if($row_item->status == "S") {
                                                $status = "Dikirim Sebagian";
                                            }
                                            if($row_item->status == "F") {
                                                $status = "Dikirim Semua";
                                            }
                                            if($row_item->status == "C") {
                                                $status = "Tutup";
                                            }
                                            if($row_item->status == "A") {
                                                $status = "ACC";
                                            }
                                    ?>
                                                
                                            <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                                            <input type="hidden" id="ref_<?php echo $no; ?>" name="ref_<?php echo $no; ?>" value="<?php echo $row_item->ref ?>" />
                                            <tr>
                                                <td valign="top" align="center" style=" vertical-align: top;"><?php echo $no+1 ?>.</td> 
                                                <td style="vertical-align: top;"><?php echo $row_item->ref ?></td>
                                                <td style=" vertical-align: top;"><?php echo date("d-m-Y", strtotime($row_item->date)) ?></td>
                                                <td style=" vertical-align: top;"><?php echo $row_item->client_name ?></td>
                                                <td style=" vertical-align: top;"><?php echo $status ?></td>
                                                <td align="center" style=" vertical-align: top;">
                                                    <table width="100%" border="1" style="border: 1px solid #93d145; font-size: 11px">
                                                        <tr style="background: #d3fe7a">
                                                            <td align="center" width="10%">No.</td>
                                                            <td align="center" width="10%">Kode</td>
                                                            <td align="center" width="70%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Artikel'; } ?></td>
                                                            <td align="center" width="20%"><?php if($lng==1) { echo 'Qty'; } else { echo 'Qty'; } ?></td>
                                                            <td align="center" width="20%">Qty Kirim</td>
                                                        </tr>
                                                        <?php 
                                                            $x = 0;
                                                            $total_qty = 0;
                                                            $total_qty_shp = 0;
                                                            $sql2=$select->list_pos_detail($row_item->ref);
                                                            while($row_so_det=$sql2->fetch(PDO::FETCH_OBJ)) {   
                                                            
                                                                $x++;
                                                                
                                                                $stypo = "";
                                                                if($row_so_det->qty_shp > 0) {
                                                                    $stypo = 'style="background-color: #5e0000; color: #ffffff"';
                                                                }
                                                                
                                                                $total_qty = $total_qty + $row_so_det->qty;
                                                                $total_qty_shp = $total_qty_shp + $row_so_det->qty_shp;
                                                        ?>
                                                        <tr <?php echo $stypo ?>>
                                                            <td align="center"><?php echo $x; ?>.</td>
                                                            <td>&nbsp;<?php echo $row_so_det->code ?></td>
                                                            <td>&nbsp;<?php echo $row_so_det->item_name ?></td>
                                                            
                                                            <td align="center"><?php echo number_format($row_so_det->qty,0,".",",") ?></td>
                                                            <td align="right"><?php echo number_format($row_so_det->qty_shp,0,".",",") ?>&nbsp;</td>
                                                        </tr>
                                                        <?php
                                                                
                                                            }
                                                        ?>
                                                        
                                                        <tr style="font-weight: bold">
                                                            <td colspan="3" align="right">Total&nbsp;</td>
                                                            <td align="center"><?php echo number_format($total_qty,0,".",",") ?>&nbsp;</td>
                                                            <td align="right"><?php echo number_format($total_qty_shp,0,".",",") ?>&nbsp;</td>
                                                        </tr>
                                                        
                                                    </table>    
                                                </td>
                                                <td align="center" style="vertical-align: top;">
                                                    <?php if (allowadd('frmdelivery_order')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('delord') ?>/<?php echo $row_item->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                </td>
                                                            
                                            </tr>
                                        
                                        <?php
                                                $no++;
                                            
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
