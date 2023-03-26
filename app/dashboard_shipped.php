<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Shipping</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                        $from_date3      = $_POST["from_date3"];
                        $to_date3        = $_POST["to_date3"];

                        if($from_date3 == "") {
                            $from_date3 = "01 ".date("F, Y");
                            $from_date3 = date("d F, Y", strtotime($from_date3));
                        }

                        if($to_date3 == "") {
                            $to_date3 = date("d F, Y");
                        }
                        
                    ?>
                    <form role="form" action="" method="post" name="dashboard_shipped" id="dashboard_shipped">
                        <table width="50%">
                            <tr>
                                <td style="padding-left: 20px; padding-top: 15px">Periode&nbsp;</td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $from_date3 ?>" id="from_date3" name="from_date3">
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $to_date3 ?>" id="to_date3" name="to_date3">
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

                        <table id="example" class="display">
                            <thead>
                                <tr>
                                    <th class="center" style="font-weight:bold ">No.</th>
                                    <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Ref.'; } ?></th>
                                    <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                    <th><?php if($lng==1) { echo 'From Location'; } else { echo 'Dari Gudang'; } ?></th>
                                    <th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Pengirim'; } ?></th>  
                                    <th><?php if($lng==1) { echo 'Employee Name'; } else { echo 'Nama Penerima'; } ?></th>  
                                    <th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jumlah'; } ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php           
                                    $sql=$select->list_delivery_order("", $from_date3, $to_date3);
                                    while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
                                    
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
                                            
                                            
                                    $i++;
                                ?>
                                            
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row_delivery_order->ref ?></td>
                                            <td><?php echo $row_delivery_order->date ?></td>
                                            <td><?php echo $row_delivery_order->location_name ?></td>
                                            <td><?php echo $row_delivery_order->uid ?></td>
                                            <td><?php echo $row_delivery_order->client_name ?></td>
                                            <td align="right"><?php echo number_format($row_delivery_order->qty,"0",".",",") ?></td>
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