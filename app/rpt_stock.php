<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
    function submitForm(tipe)
    {
        if(tipe == 'view') {
            //document.getElementById("delord_view").action = "app/delord_print.php";
            $("#rpt_stock").attr('action', 'app/rpt_stock_view.php')
               .attr('target', '_BLANK');
            $("#rpt_stock").submit();
        }
        
        if(tipe == 'label') {
            //document.getElementById("delord_view").action = "app/delord_print.php";
            $("#rpt_stock").attr('action', 'app/rpt_stock_harga.php')
               .attr('target', '_BLANK');
            $("#rpt_stock").submit();
        }
        
        return false;    
    }       
</script>

<script type="text/javascript">
    function excel_export() {
        item_code           =   document.getElementById('item_code').value;
        location_id         =   document.getElementById('location_id').value;
        uom_code            =   document.getElementById('uom_code').value;
        item_group_id       =   document.getElementById('item_group_id').value;
        //item_subgroup_id  =   document.getElementById('item_subgroup_id').value;
        date_from           =   document.getElementById('date_from').value;
        date_to             =   document.getElementById('date_to').value;
        all                 =   document.getElementById('all').checked;
        
        if(all == true) { all = 1}
        if(all == false) { all = 0}
        
        document.location.href = "app/rpt_stock_xls.php?item_code="+item_code+"&location_id="+location_id+"&uom_code="+uom_code+"&date_from="+date_from+"&date_to="+date_to+"&all="+all+"&item_group_id="+item_group_id;    
    }
</script>

<script type="text/javascript">
    var request;
    var dest;
    
    function loadHTMLPost2(URL, destination, button, getId){        
        dest = destination; 
        str = getId + '=' + document.getElementById(getId).value;       
        //str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
        var str = str + '&button=' + button;
        
        if (window.XMLHttpRequest){
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
            request.send(str);      
                    
        } else if (window.ActiveXObject) {
            request = new ActiveXObject("Microsoft.XMLHTTP");
            if (request) {
                request.onreadystatechange = processStateChange;
                request.open("POST", URL, true);
                request.send();             
            }
        }
                
    }
     
</script>

<?php

if($date_from == "") {
    $date_from = date("d F, Y");
}

if($date_to == "") {
    $date_to = date("d F, Y");
}

?> 

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        
        <form class="row" role="form" action="" method="post" name="rpt_stock" id="rpt_stock" class="form-horizontal" enctype="multipart/form-data" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kode/Barcode Barang</label>
                                <div class="col-10">
                                    <select class="destroy-selector" id="item_code" name="item_code">
                                        <option value=""></option>
                                        <?php 
                                            select_item($item_code) 
                                        ?>  
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Nama Barang</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="<?php echo $item_name ?>" id="item_name" name="item_name">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kelompok Barang</label>
                                <div class="col-10">
                                    <select class="destroy-selector" id="item_group_id" name="item_group_id">
                                        <option value=""></option>
                                        <?php 
                                            combo_select_active("item_group","id","name","active","1",$item_group_id) 
                                        ?>  
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Satuan</label>
                                <div class="col-10">
                                    <select class="destroy-selector" id="uom_code" name="uom_code">
                                        <option value=""></option>
                                        <?php select_uom($uom_code) ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Gudang/Lokasi</label>
                                <div class="col-10">
                                    <select class="destroy-selector" id="location_id" name="location_id">
                                        <option value=""></option>
                                        <?php 
                                            combo_select_active("warehouse","id","name","active","1",$location_id) 
                                        ?>  
                                    </select>
                                </div>
                            </div>                            

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Dari Tanggal</label>
                                <div class="col-10">
                                    <input class="datepicker-default form-control" type=" text" value="<?php echo $date_from ?>" id="date_from" name="date_from">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">s/d Tanggal</label>
                                <div class="col-10">
                                    <input class="datepicker-default form-control" type=" text" value="<?php echo $date_to ?>" id="date_to" name="date_to">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="submit" name="submit" id="submit" class='btn btn-primary me-10' value="Preview" onclick="submitForm('view')" />
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>