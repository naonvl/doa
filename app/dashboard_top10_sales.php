<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Top 10 Product Sales</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                        $from_date      = $_POST["from_date"];
                        $to_date        = $_POST["to_date"];

                        if($from_date == "") {
                            $from_date = "01 ".date("F, Y");
                            $from_date = date("d F, Y", strtotime($from_date));
                        }

                        if($to_date == "") {
                            $to_date = date("d F, Y");
                        }
                        
                    ?>

                    <form role="form" action="" method="post" name="dashboard_top" id="dashboard_top">
                        <table width="50%">
                            <tr>
                                <td style="padding-left: 20px; padding-top: 15px">Periode&nbsp;</td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $from_date ?>" id="from_date" name="from_date">
                                </td>
                                <td style="padding-top: 15px">
                                    <input class="datepicker-default form-control" type="text" value="<?php echo $to_date ?>" id="to_date" name="to_date">
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

                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>No</strong></th>
                                    <th><strong>SKU</strong></th>
                                    <th><strong>Nama Produk</strong></th>
                                    <th><strong>Qty</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    $sqltop = $select->dashboard_sales_top10($from_date, $to_date);
                                    while($datatop=$sqltop->fetch(PDO::FETCH_OBJ)) {
                                        $i++;
                                ?>
                                        <tr>
                                            <td><strong><?= $i ?></strong></td>
                                            <td><?= $datatop->code ?></td>
                                            <td><?= $datatop->name ?></td>
                                            <td><?= number_format($datatop->qty,0,'.',',') ?></td>
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