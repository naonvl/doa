<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('item_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<script>
    function print_barcode(ref) {
        window.open('<?php echo $__folder ?>app/item_qrcode.php?ref='+ref, 'QR Code Print','450','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
</script>

<?php

$code                   =    $_REQUEST['code'];
$old_code               =    $_REQUEST['old_code'];
$name                   =    $_REQUEST['name'];
$item_group_id          =    $_REQUEST['item_group_id'];
$all                    =    $_REQUEST['all'];

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
                        $delete2->delete_item($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('item_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" role="form" action="" method="post" name="client_view" id="client_view" class="form-horizontal" enctype="multipart/form-data" >

                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Kode Barcode</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="old_code" name="old_code" value="<?php echo $old_code ?>" >

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Nama Produk</label>
                                            <div class="col-8">
                                                <select class="destroy-selector" id="name" name="name">
                                                    <option value=""></option>
                                                    <?php
                                                        populate_select("item","syscode","name",$name)
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Kelompok Produk</label>
                                            <div class="col-8">
                                                <select class="destroy-selector" id="item_group_id" name="item_group_id">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("item_group","id","name","active","1",$item_group_id); 
                                                    ?>  
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check custom-checkbox mb-3">
                                            <input id="all" name="all" type="checkbox" class="form-check-input" value="1" <?php echo $all2 ?> >
                                            <label class="form-check-label" for="preview-semua">Semua</label>
                                        </div>
                                    </div>
                                    <div class="col-2 offset-5 ">
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                                    </div>
                                    
                                </form>
                            </div>
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
                                        <!-- <th width="2%">ID</th> -->
                                        <th>SKU</th>
                                        <th>Nama Produk</th>
                                        <th>Kelompok Produk</th>
                                        <th>Satuan</th>
                                        <th>Size</th>
                                        <th>Harga Jual</th>
                                        <th>Min. Stok</th>
                                        <th>Maks. Stok</th>
                                        <th>Active</th>
                                        <th>Edit|Delete</th>
                                        <th>Print QR Code</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_item($kode, $all, $active, $code, $old_code, $name, $item_group_id);
                                        while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                            $i++;
                                            
                                            //get current_cost
                                            $sqlcost=$select->list_set_item_cost_last("", $row_item->syscode);
                                            $row_item_cost=$sqlcost->fetch(PDO::FETCH_OBJ);
        
                                            //set current price
                                            $sqlprice = $select->list_set_item_price_last("", $row_item->syscode);
                                            $dataprice = $sqlprice->fetch(PDO::FETCH_OBJ);
                                            
                                    ?>
                                                
                                            <tr>
                                                <td align="center"><?php echo $i ?></td>
                                                <!-- <td style="width: 2%" ><hp echo $row_item->syscode ?></td> -->
                                                <td><?php echo $row_item->code ?></td>
                                                <td><?php echo $row_item->name ?></td>
                                                <td><?php echo $row_item->item_group_name ?></td>
                                                <td><?php echo $row_item->uom_code_stock ?></td>
                                                <td><?php echo $row_item->size_name ?></td>
                                                <td align="right"><?php echo number_format($dataprice->current_price,0,'.',',') ?></td>
                                                <td align="center"><?php echo number_format($row_item->minimum_stock,0,'.',',') ?></td>
                                                <td align="center"><?php echo number_format($row_item->maximum_stock,0,'.',',') ?></td>
                                                <td>
                                                    <?php if ($row_item->active == 1) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmitem')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('item') ?>/<?php echo $row_item->syscode ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmitem')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_item->syscode ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-white btn-info btn-bold" onclick="print_barcode('<?php echo $row_item->syscode ?>')" >      
                                                        <i class="ace-icon fa fa-barcode bigger-120 blue"></i>
                                                    </button>  
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
