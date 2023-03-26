<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Asset</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                        $condition       = $_POST["status"];
                        $from_date4      = $_POST["from_date4"];
                        $to_date4        = $_POST["to_date4"];

                        if($from_date4 == "") {
                            $from_date4 = "01-01-2022";
                            $from_date4 = date("d F, Y", strtotime($from_date4));
                        }

                        if($to_date4 == "") {
                            $to_date4 = date("d F, Y");
                        }
                    ?>
                    <form role="form" action="" method="post" name="dashboard_item" id="dashboard_item">
                        <table width="70%">
                            <tr>
                                <td style="padding-left: 20px; padding-top: 15px">Status&nbsp;</td>
                                <td style="padding-top: 15px">
                                    <div style="width: 100px">
                                        <select class="destroy-selector" id="status" name="status">
                                            <option value="">All</option>
                                            <?php select_condition_goodreceipt($condition) ?>
                                        </select>
                                    </div>
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $from_date4 ?>" id="from_date4" name="from_date4">
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $to_date4 ?>" id="to_date4" name="to_date4">
                                </td>
                                <td style="padding-left: 5px; padding-top: 0px">
                                    &nbsp;
                                    <button type="submit" name="submit" id="submit" class="btn btn-success me-6" value="refresh">
                                        <i class="ace-icon fa fa-refresh bigger-120 green"></i>
                                        Refresh
                                    </button>
                                </td>
                            </tr>
                        </table>

                        <table id="example5" class="display">
                            <thead>
                                <tr>
                                    <th class="center" style="font-weight:bold ">No.</th>
                                    <th><?php if($lng==1) { echo 'Code'; } else { echo 'SKU'; } ?></th>
                                    <th><?php if($lng==1) { echo 'Product Name'; } else { echo 'Nama Product'; } ?></th>
                                    <th><?php if($lng==1) { echo 'Qty'; } else { echo 'Qty'; } ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php           
                                    $qty = 0;
                                    $sql1=$select->list_item("", 1);
                                    while($row_item=$sql1->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;

                                        $sqlbincard = $select->dashboard_bincard_stok_opname($row_item->syscode, $from_date4, $to_date4);
                                        $databincard = $sqlbincard->fetch(PDO::FETCH_OBJ);
                                        $qty = $databincard->qty;

                                        //------penerimaan
                                        if($condition == "Reject") {
                                            $sqlrcp = $select->dashboard_bincard_good_receipt($row_item->syscode, $from_date4, $to_date4);
                                            $datarcp = $sqlrcp->fetch(PDO::FETCH_OBJ);
                                            $qty = $datarcp->qty;
                                        }

                                        if($qty < 0) {
                                            $qty = 0;
                                        }
                                ?>
                                            
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row_item->code ?></td>
                                            <td><?php echo $row_item->name ?></td>
                                            <td align="center"><?php echo number_format($qty,"0",".",",") ?></td>
                                        </tr>
                                    
                                    <?php
                                        }
                                    ?>
                                    
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>