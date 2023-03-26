<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Sales Return</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                     <?php
                        $from_date2      = $_POST["from_date2"];
                        $to_date2        = $_POST["to_date2"];

                        if($from_date2 == "") {
                            $from_date2 = "01 ".date("F, Y");
                            $from_date2 = date("d F, Y", strtotime($from_date2));
                        }

                        if($to_date2 == "") {
                            $to_date2 = date("d F, Y");
                        }
                        
                    ?>

                    <form role="form" action="" method="post" name="dashboard_return" id="dashboard_return">
                        <table width="50%">
                            <tr>
                                <td style="padding-left: 20px; padding-top: 15px">Periode&nbsp;</td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $from_date2 ?>" id="from_date2" name="from_date2">
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $to_date2 ?>" id="to_date2" name="to_date2">
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
                                    <th>No. Sales</th>
                                    <th>SKU</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    $sqlrtn = $select->dashboard_sales_return($from_date2, $to_date2);
                                    while($datartn=$sqlrtn->fetch(PDO::FETCH_OBJ)) {
                                        $i++;

                                ?>
                                        <tr>
                                            <td><strong><?= $i ?></strong></td>
                                            <td><?= $datartn->si_ref ?></td>
                                            <td><?= $datartn->code ?></td>
                                            <td><?= $datartn->name ?></td>
                                            <td align="center"><?= number_format($datartn->qty,0,'.',',') ?></td>
                                            <td align="right"><?= number_format($datartn->amount,0,'.',',') ?></td>
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