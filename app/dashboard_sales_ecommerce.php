<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Penjualan per e-Commerce</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                        $from_date1      = $_POST["from_date1"];
                        $to_date1        = $_POST["to_date1"];

                        if($from_date1 == "") {
                            $from_date1 = "01 ".date("F, Y");
                            $from_date1 = date("d F, Y", strtotime($from_date1));
                        }

                        if($to_date1 == "") {
                            $to_date1 = date("d F, Y");
                        }
                        
                    ?>
                    <form role="form" action="" method="post" name="dashboard_com" id="dashboard_com">
                        <table width="50%">
                            <tr>
                                <td style="padding-left: 20px; padding-top: 15px">Periode&nbsp;</td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $from_date1 ?>" id="from_date1" name="from_date1">
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $to_date1 ?>" id="to_date1" name="to_date1">
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

                        <table class="table header-border" style="min-width: 500px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama E-Commerce</th>
                                    <th>Qty</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    $sqlch = $select->list_channel();
                                    while($datach=$sqlch->fetch(PDO::FETCH_OBJ)) {
                                        $i++;

                                        $sqlsls = $select->dashboard_sales_ecommerce($from_date1, $to_date1, $datach->id);
                                        $datasls = $sqlsls->fetch(PDO::FETCH_OBJ);
                                ?>
                                        <tr>
                                            <td><strong><?= $i ?></strong></td>
                                            <td><?= $datach->name ?></td>
                                            <td align="center"><?= number_format($datasls->qty,0,'.',',') ?></td>
                                            <td align="right"><?= number_format($datasls->total,0,'.',',') ?></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                <!-- <tr class="table-active">
                                    <td>1</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>1</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-success">
                                    <td>2</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-info">
                                    <td>3</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-warning">
                                    <td>4</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="table-danger">
                                    <td>5</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>