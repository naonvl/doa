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
            document.location.href = "<?php echo obraxabrix('sales_return_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
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
        
        window.location = "app/sales_return_view_print_create.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier+"&all="+all; //localhost only
        //window.location = "app/sales_return_view_print_create_ol.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier; //internet only
        
        
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
                        $delete2->delete_sales_return($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('sales_return_view'); ?>" />
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
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Ref.'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Client'; } else { echo 'Customer'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Status'; } else { echo 'Status'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Updated by'; } else { echo 'Diedit oleh'; } ?></th>  
                                        <th><?php if($lng==1) { echo 'Date Last Update'; } else { echo 'Terakhir diupdate'; } ?></th>
                                        <th>Edit|Delete</th>
                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_sales_return("", $from_date, $to_date, $all);
                                        while($row_sales_return=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                            $status = "";
                                            if ($row_sales_return->status == "R") {
                                                $status = "Released";
                                            }
                                            $i++;
                                    ?>
                                                
                                            <tr <?php echo $void_color ?> >
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_sales_return->ref ?></td>
                                                <td><?php echo $row_sales_return->date ?></td>
                                                <td><?php echo $row_sales_return->client_name ?></td>
                                                <td><?php echo $status ?></td>
                                                <td><?php echo $row_sales_return->uid ?></td>
                                                <td><?php echo $row_sales_return->dlu ?></td>
                                                
                                                <td align="center">                                                
                                                    <?php if (allowupd('frmsales_return')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('sales_return') ?>/<?php echo $row_sales_return->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmsales_return')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_sales_return->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
