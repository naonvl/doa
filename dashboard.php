<script src="app/chart/js/amcharts.js" type="text/javascript"></script>
<script src="app/chart/js/canvasjs.min.js" type="text/javascript"></script>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <?php
                           //include('app/chart/chart_line_multi.php');
                           include('app/chart/chart_line_test.php');
                           //include('app/chart/chart_sales_line.php');                        
                           include('app/dashboard_top10_sales.php');
                           include('app/dashboard_sales_ecommerce.php');
                           include('app/dashboard_sales_return.php');
                           include('app/dashboard_item.php');
                           include('app/dashboard_shipped.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>