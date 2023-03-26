<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
    function submitForm(tipe)
    {
        if(tipe == 'view') {
            //document.getElementById("delord_view").action = "app/delord_print.php";
            $("#rpt_bincard").attr('action', 'app/rpt_bincard_view.php')
               .attr('target', '_BLANK');
            $("#rpt_bincard").submit();
        }
        
        return false;    
    }       
</script>

<script type="text/javascript">
    function excel_export() {
        item_code   =   document.getElementById('item_code').value;
        location_id =   document.getElementById('location_id').value;
        item_group_id   =   document.getElementById('item_group_id').value;
        date_from   =   document.getElementById('date_from').value;
        date_to =   document.getElementById('date_to').value;
        /*all       =   document.getElementById('all').checked;
        
        if(all == true) { all = 1}
        if(all == false) { all = 0}
        */
        
        document.location.href = "app/rpt_bincard_xls.php?item_code="+item_code+"&location_id="+location_id+"&item_group_id="+item_group_id+"&date_from="+date_from+"&date_to="+date_to+""; 
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

/*$date_from                =    $_REQUEST['date_from'];
$date_to                =    $_REQUEST['date_to'];*/

if($admin == 0) {
    $disabled = "disabled";
}

if($date_from == "") {
    $date_from = date("d F, Y");
}

if($date_to == "") {
    $date_to = date("d F, Y");
}

                        
$admin           =    $_SESSION["adm"];
$location_id     =    $_SESSION["location_id2"];
        
?>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <?php 
            $ref = $segmen3; 
                        
            include("app/exec/colour_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_colour($ref);
                $row_colour=$sql->fetch(PDO::FETCH_OBJ);    

                $active = "";
                if($row_colour->active == 1) {
                    $active = "checked";
                }
            }           
        ?>

        <form class="row" role="form" action="" method="post" name="rpt_bincard" id="rpt_bincard" class="form-horizontal" enctype="multipart/form-data" >

            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORM KIRI -->
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