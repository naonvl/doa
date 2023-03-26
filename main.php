<?php
    include("main_set.php");    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
        <meta property="og:title" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
        <meta property="og:description" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
        <meta property="og:image" content="social-image.png" />
        <meta name="format-detection" content="telephone=no">
        
        <!-- PAGE TITLE HERE -->
        <title>DOA Ritel System</title>
        
        <!-- FAVICONS ICON -->
        <link rel="shortcut icon" type="image/png" href="<?php echo $__folder ?>images/favicon.png" />
        <link href="<?php echo $__folder ?>vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
        <link href="<?php echo $__folder ?>vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $__folder ?>vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $__folder ?>vendor/pickadate/themes/default.css">
        <link rel="stylesheet" href="<?php echo $__folder ?>vendor/pickadate/themes/default.date.css">
        <!-- Style css -->
        <link href="<?php echo $__folder ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $__folder ?>vendor/select2/css/select2.min.css">
        <link href="<?php echo $__folder ?>vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
        <link href="<?php echo $__folder ?>css/style.css" rel="stylesheet">

        <!----finance only------>
        <script src="app/js_popup/script/tooltips.js" language="javascript"></script>
        <script src="app/js_popup/script/tools.js" language="javascript"></script>
        <!------------------------->

        <!--[if lte IE 8]>
        <script src="<?php echo $__folder ?>assets/js/html5shiv.min.js"></script>
        <script src="<?php echo $__folder ?>assets/js/respond.min.js"></script>
        <![endif]-->
        
        <script>
            //import data
            function import_client() 
{   
                newWindow('app/import_client.php','Import Data Customer','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
            }
            
            //import data
            function import_item() 
{   
                newWindow('app/import_item.php','Import Data Item','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
            }
            
        </script>
                
    </head>

    <body>
        
        <div id="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>

        <div id="main-wrapper">
            
            <?php require("header.php"); ?>
                    
            <?php 

                require("menu.php");
                                            
            ?>
                    
            
                        
                    <?php
                        
                        if ($act == '' ) { include_once("dashboard.php"); }
                        if ($act == obraxabrix('main') ) { include_once("dashboard.php"); }
                        if ($act == obraxabrix('logout')) { include_once("logout.php"); }
                        
                        ##setup
                        if ($act == obraxabrix('usr') ) { include_once("app/usr.php"); }
                        if ($act == obraxabrix('usr_view')) { include_once("app/usr_view.php"); }
                        if ($act == obraxabrix('usr_change') ) { include_once("app/usr_change.php"); }
                        if ($act == obraxabrix('company') ) { include_once("app/company.php"); }
                        if ($act == obraxabrix('company_view')) { include_once("app/company_view.php"); }
                        if ($act == obraxabrix('client_set_level') ) { include_once("app/client_set_level.php"); }
                        if ($act == obraxabrix('client_set_level_view')) { include_once("app/client_set_level_view.php"); }
                        if ($act == obraxabrix('level') ) { include_once("app/level.php"); }
                        if ($act == obraxabrix('warehouse') ) { include_once("app/warehouse.php"); }
                        if ($act == obraxabrix('warehouse_view')) { include_once("app/warehouse_view.php"); }
                        
                        ##utility
                        if ($act == obraxabrix('upload_download')) { include_once("app/upload_download.php"); }
                        if ($act == obraxabrix('backup')) { include_once("app/backup.php"); }
                        if ($act == obraxabrix('query_string')) { include_once("app/query_string.php"); }


                        ##sales
                        if ($act == obraxabrix('sales_order_cs') ) { include_once("app/sales_order_cs.php"); }
                        if ($act == obraxabrix('sales_order') ) { include_once("app/sales_order.php"); }
                        if ($act == obraxabrix('sales_order_view') ) { include_once("app/sales_order_view.php"); }
                        if ($act == obraxabrix('capster_order_list') ) { include_once("app/capster_order_list.php"); }
                        if ($act == obraxabrix('sales_order_list') ) { include_once("app/sales_order_list.php"); }
                        if ($act == obraxabrix('sales_order_cs_upload') ) { include_once("app/sales_order_cs_upload.php"); }
                        if ($act == obraxabrix('pos') ) { include_once("app/pos.php"); }
                        if ($act == obraxabrix('pos_view') ) { include_once("app/pos_view.php"); }
                        if ($act == obraxabrix('pos_status') ) { include_once("app/pos_status.php"); }
                        if ($act == obraxabrix('pos_view_user') ) { include_once("app/pos_view_user.php"); }
                        if ($act == obraxabrix('sales_invoice_list') ) { include_once("app/sales_invoice_list.php"); }
                        if ($act == obraxabrix('sales_invoice_list_user') ) { include_once("app/sales_invoice_list_user.php"); }
                        if ($act == obraxabrix('shopify_sales')) { include_once("app/shopify_sales.php"); }
                        if ($act == obraxabrix('sales_order_acc_list') ) { include_once("app/sales_order_acc_list.php"); }
                        if ($act == obraxabrix('pos_list') ) { include_once("app/pos_list.php"); }
                        if ($act == obraxabrix('delord') ) { include_once("app/delord.php"); }
                        if ($act == obraxabrix('delord_view') ) { include_once("app/delord_view.php"); }
                        if ($act == obraxabrix('delivery_order_list') ) { include_once("app/delivery_order_list.php"); }
                        if ($act == obraxabrix('sales_order_po_list') ) { include_once("app/sales_order_po_list.php"); }
                        if ($act == obraxabrix('payment_method') ) { include_once("app/payment_method.php"); }
                        if ($act == obraxabrix('payment_method_view') ) { include_once("app/payment_method_view.php"); }
                        
                        ##Purchasing
                        if ($act == obraxabrix('purchase_inv') ) { include_once("app/purchase_inv.php"); }
                        if ($act == obraxabrix('purchase_inv_view') ) { include_once("app/purchase_inv_view.php"); }
                        if ($act == obraxabrix('good_receipt_list') ) { include_once("app/good_receipt_list.php"); }
                        if ($act == obraxabrix('good_receipt') ) { include_once("app/good_receipt.php"); }
                        if ($act == obraxabrix('good_receipt_view') ) { include_once("app/good_receipt_view.php"); }
                        if ($act == obraxabrix('measuring_size_sewing') ) { include_once("app/measuring_size_sewing.php"); }
                        if ($act == obraxabrix('measuring_size_sewing_view') ) { include_once("app/measuring_size_sewing_view.php"); }
                        if ($act == obraxabrix('do_good_receipt_qc') ) { include_once("app/do_good_receipt_qc.php"); }
                        if ($act == obraxabrix('do_good_receipt_qc_view') ) { include_once("app/do_good_receipt_qc_view.php"); }
                        if ($act == obraxabrix('purchase_type') ) { include_once("app/purchase_type.php"); }
                        if ($act == obraxabrix('purchase_type_view') ) { include_once("app/purchase_type_view.php"); }
                        if ($act == obraxabrix('purchase_order_sewing') ) { include_once("app/purchase_order_sewing.php"); }
                        if ($act == obraxabrix('receipt_purchase_order_sewing') ) { include_once("app/receipt_purchase_order_sewing.php"); }

                        ##warehouse
                        if ($act == obraxabrix('good_receipt_view2') ) { include_once("app/good_receipt_view2.php"); }
                        if ($act == obraxabrix('stock_opname') ) { include_once("app/stock_opname.php"); }
                        if ($act == obraxabrix('stock_opname_view')) { include_once("app/stock_opname_view.php"); }
                        if ($act == obraxabrix('stock_opname_list') ) { include_once("app/stock_opname_list.php"); }
                        if ($act == obraxabrix('sales_return') ) { include_once("app/sales_return.php"); }
                        if ($act == obraxabrix('sales_return_view') ) { include_once("app/sales_return_view.php"); }
                        
                        
                        ##master data
                        if ($act == obraxabrix('client') ) { include_once("app/client.php"); }
                        if ($act == obraxabrix('client_view')) { include_once("app/client_view.php"); }
                        if ($act == obraxabrix('client_type') ) { include_once("app/client_type.php"); }
                        if ($act == obraxabrix('client_type_view')) { include_once("app/client_type_view.php"); }
                        if ($act == obraxabrix('vendor') ) { include_once("app/vendor.php"); }
                        if ($act == obraxabrix('vendor_view')) { include_once("app/vendor_view.php"); }
                        if ($act == obraxabrix('vendor_type') ) { include_once("app/vendor_type.php"); }
                        if ($act == obraxabrix('vendor_type_view')) { include_once("app/vendor_type_view.php"); }
                        if ($act == obraxabrix('client_saldo')) { include_once("app/client_saldo.php"); }
                        if ($act == obraxabrix('item') ) { include_once("app/item.php"); }
                        if ($act == obraxabrix('item_view')) { include_once("app/item_view.php"); }
                        if ($act == obraxabrix('promo') ) { include_once("app/promo.php"); }
                        if ($act == obraxabrix('promo_view')) { include_once("app/promo_view.php"); }
                        if ($act == obraxabrix('material') ) { include_once("app/material.php"); }
                        if ($act == obraxabrix('material_view')) { include_once("app/material_view.php"); }
                        if ($act == obraxabrix('coa') ) { include_once("app/coa.php"); }
                        if ($act == obraxabrix('coa_view')) { include_once("app/coa_view.php"); }
                        if ($act == obraxabrix('item_group') ) { include_once("app/item_group.php"); }
                        if ($act == obraxabrix('item_group_view')) { include_once("app/item_group_view.php"); }
                        if ($act == obraxabrix('channel') ) { include_once("app/channel.php"); }
                        if ($act == obraxabrix('channel_view')) { include_once("app/channel_view.php"); }
                        if ($act == obraxabrix('size') ) { include_once("app/size.php"); }
                        if ($act == obraxabrix('size_view')) { include_once("app/size_view.php"); }
                        if ($act == obraxabrix('shopify_client')) { include_once("app/shopify_client.php"); }
                        if ($act == obraxabrix('shopify_item')) { include_once("app/shopify_item.php"); }
                                                
                        ##HRD
                        if ($act == obraxabrix('employee') ) { include_once("app/employee.php"); }
                        if ($act == obraxabrix('employee_view')) { include_once("app/employee_view.php"); }
                        if ($act == obraxabrix('position') ) { include_once("app/position.php"); }
                        if ($act == obraxabrix('position_view')) { include_once("app/position_view.php"); }
                        if ($act == obraxabrix('division') ) { include_once("app/division.php"); }
                        if ($act == obraxabrix('division_view')) { include_once("app/division_view.php"); }
                        if ($act == obraxabrix('employee_basic_salary')) { include_once("app/employee_basic_salary.php"); }                     
                        if ($act == obraxabrix('salary') ) { include_once("app/salary.php"); }
                        if ($act == obraxabrix('salary_view')) { include_once("app/salary_view.php"); }
                        
                        
                        if ($act == obraxabrix('rpt_stock') ) { include_once("app/rpt_stock.php"); }
                        if ($act == obraxabrix('uom') ) { include_once("app/uom.php"); }
                        if ($act == obraxabrix('uom_view')) { include_once("app/uom_view.php"); }
                        
                        if ($act == obraxabrix('colour') ) { include_once("app/colour.php"); }
                        if ($act == obraxabrix('colour_view')) { include_once("app/colour_view.php"); }
                        
                        



                        if ($act == obraxabrix('capster_order_update') ) { include_once("app/capster_order_update.php"); }
                        if ($act == obraxabrix('sewing') ) { include_once("app/sewing.php"); }
                        if ($act == obraxabrix('sewing_view') ) { include_once("app/sewing_view.php"); }
                        if ($act == obraxabrix('sewing_list') ) { include_once("app/sewing_list.php"); }
                        if ($act == obraxabrix('outbound') ) { include_once("app/outbound.php"); }
                        if ($act == obraxabrix('outbound_view') ) { include_once("app/outbound_view.php"); }
                        
                        ##R & D
                        if ($act == obraxabrix('new_product') ) { include_once("app/new_product.php"); }
                        if ($act == obraxabrix('new_product_view')) { include_once("app/new_product_view.php"); }
                        
                        ##Finance
                        if ($act == obraxabrix('finance_type') ) { include_once("app/finance_type.php"); }
                        if ($act == obraxabrix('finance_type_view')) { include_once("app/finance_type_view.php"); }
                        if ($act == obraxabrix('receipt') ) { include_once("app/receipt.php"); }
                        if ($act == obraxabrix('receipt_view')) { include_once("app/receipt_view.php"); }
                        if ($act == obraxabrix('payment') ) { include_once("app/payment.php"); }
                        if ($act == obraxabrix('payment_view')) { include_once("app/payment_view.php"); }
                        if ($act == obraxabrix('general_journal') ) { include_once("app/general_journal.php"); }
                        if ($act == obraxabrix('general_journal_view') ) { include_once("app/general_journal_view.php"); }
                        if ($act == obraxabrix('general_journal_in') ) { include_once("app/general_journal_in.php"); }
                        if ($act == obraxabrix('general_journal_in_view') ) { include_once("app/general_journal_in_view.php"); }
                        if ($act == obraxabrix('deposit_client') ) { include_once("app/deposit_client.php"); }
                        if ($act == obraxabrix('deposit_client_view') ) { include_once("app/deposit_client_view.php"); }
                        
                        if ($act == obraxabrix('rpt_general_journal') ) { include_once("app/rpt_general_journal.php"); }
                        if ($act == obraxabrix('rpt_ar') ) { include_once("app/rpt_ar.php"); }
                        if ($act == obraxabrix('rpt_ap') ) { include_once("app/rpt_ap.php"); }
                        if ($act == obraxabrix('rpt_cash_flow') ) { include_once("app/rpt_cash_flow.php"); }
                        
                        ##report
                        if ($act == obraxabrix('rpt_client')) { include_once("app/rpt_client.php"); }
                        if ($act == obraxabrix('rpt_room_tax')) { include_once("app/rpt_room_tax.php"); }
                        if ($act == obraxabrix('rpt_sales')) { include_once("app/rpt_sales.php"); }
                        if ($act == obraxabrix('rpt_sales_tax')) { include_once("app/rpt_sales_tax.php"); }
                        if ($act == obraxabrix('rpt_good_receipt')) { include_once("app/rpt_good_receipt.php"); }
                        if ($act == obraxabrix('rpt_good_receipt_warehouse')) { include_once("app/rpt_good_receipt_warehouse.php"); }
                        if ($act == obraxabrix('rpt_sewing')) { include_once("app/rpt_sewing.php"); }
                        if ($act == obraxabrix('rpt_profit_loss2')) { include_once("app/rpt_profit_loss2.php"); }
                        if ($act == obraxabrix('rpt_sponsoring')) { include_once("app/rpt_sponsoring.php"); }
                        if ($act == obraxabrix('rpt_client_commision_ro')) { include_once("app/rpt_client_commision_ro.php"); }
                        if ($act == obraxabrix('rpt_sales_commision_ro')) { include_once("app/rpt_sales_commision_ro.php"); }
                        if ($act == obraxabrix('rpt_member')) { include_once("app/rpt_member.php"); }
                        if ($act == obraxabrix('rpt_member_registration')) { include_once("app/rpt_member_registration.php"); }
                        if ($act == obraxabrix('rpt_budget_product')) { include_once("app/rpt_budget_product.php"); }
                        if ($act == obraxabrix('rpt_budget_bonus')) { include_once("app/rpt_budget_bonus.php"); }
                        if ($act == obraxabrix('rpt_member_top10')) { include_once("app/rpt_member_top10.php"); }
                        if ($act == obraxabrix('rpt_reward_commision')) { include_once("app/rpt_reward_commision.php"); }
                        if ($act == obraxabrix('rpt_cash_bank')) { include_once("app/rpt_cash_bank.php"); }
                        if ($act == obraxabrix('rpt_commision_reward')) { include_once("app/rpt_commision_reward.php"); }
                        if ($act == obraxabrix('rpt_commision_reward_summary')) { include_once("app/rpt_commision_reward_summary.php"); }
                        if ($act == obraxabrix('rpt_sales_product')) { include_once("app/rpt_sales_product.php"); }
                        if ($act == obraxabrix('rpt_purchase_inv_global')) { include_once("app/rpt_purchase_inv_global.php"); }
                        if ($act == obraxabrix('rpt_sales_product_summary')) { include_once("app/rpt_sales_product_summary.php"); }
                        if ($act == obraxabrix('rpt_topup_saldo')) { include_once("app/rpt_topup_saldo.php"); }
                        if ($act == obraxabrix('rpt_company_summary')) { include_once("app/rpt_company_summary.php"); }
                        if ($act == obraxabrix('rpt_agent')) { include_once("app/rpt_agent.php"); }
                        if ($act == obraxabrix('transfer_saldo')) { include_once("app/transfer_saldo.php"); }
                        if ($act == obraxabrix('transfer_saldo_view')) { include_once("app/transfer_saldo_view.php"); }
                        if ($act == obraxabrix('rpt_bincard')) { include_once("app/rpt_bincard.php"); }
                        
                        
                        ##transaction
                        if ($act == obraxabrix('registration')) { include_once("app/registration.php"); }
                        if ($act == obraxabrix('registration_view')) { include_once("app/registration_view.php"); }
                        if ($act == obraxabrix('registration_list')) { include_once("app/registration_list.php"); }
                        if ($act == obraxabrix('booking')) { include_once("app/booking.php"); }
                        if ($act == obraxabrix('booking_room')) { include_once("app/booking_room.php"); }
                        if ($act == obraxabrix('booking_view')) { include_once("app/booking_view.php"); }
                        if ($act == obraxabrix('room_registration')) { include_once("app/room_registration.php"); }
                        if ($act == obraxabrix('room_registration_view')) { include_once("app/room_registration_view.php"); }
                        if ($act == obraxabrix('room_registration_list')) { include_once("app/room_registration_list.php"); }
                        if ($act == obraxabrix('room_booking_filter')) { include_once("app/room_booking_filter.php"); }
                        if ($act == obraxabrix('room_booking')) { include_once("app/room_booking.php"); }
                        if ($act == obraxabrix('room_booking_view')) { include_once("app/room_booking_view.php"); }
                        if ($act == obraxabrix('defective')) { include_once("app/defective.php"); }
                        if ($act == obraxabrix('defective_view')) { include_once("app/defective_view.php"); }
                        if ($act == obraxabrix('inspection')) { include_once("app/inspection.php"); }
                        if ($act == obraxabrix('inspection_view')) { include_once("app/inspection_view.php"); }
                        if ($act == obraxabrix('build_list')) { include_once("app/build_list.php"); }
                        if ($act == obraxabrix('room_list')) { include_once("app/room_list.php"); }
                        if ($act == obraxabrix('chamber_list')) { include_once("app/chamber_list.php"); }
                        if ($act == obraxabrix('garden_list')) { include_once("app/garden_list.php"); }
                        
                        if ($act == obraxabrix('toilet_indicator') ) { include_once("app/toilet_indicator.php"); }
                        if ($act == obraxabrix('toilet_indicator_view')) { include_once("app/toilet_indicator_view.php"); }
                        if ($act == obraxabrix('toilet_inspection_filter')) { include_once("app/toilet_inspection_filter.php"); }
                        if ($act == obraxabrix('toilet_inspection') ) { include_once("app/toilet_inspection.php"); }
                        if ($act == obraxabrix('toilet_inspection_view')) { include_once("app/toilet_inspection_view.php"); }
                        if ($act == obraxabrix('build') ) { include_once("app/build.php"); }
                        if ($act == obraxabrix('build_view')) { include_once("app/build_view.php"); }
                        if ($act == obraxabrix('room') ) { include_once("app/room.php"); }
                        if ($act == obraxabrix('room_view')) { include_once("app/room_view.php"); }
                        if ($act == obraxabrix('chamber') ) { include_once("app/chamber.php"); }
                        if ($act == obraxabrix('chamber_view')) { include_once("app/chamber_view.php"); }
                        if ($act == obraxabrix('garden') ) { include_once("app/garden.php"); }
                        if ($act == obraxabrix('garden_view')) { include_once("app/garden_view.php"); }
                        if ($act == obraxabrix('toilet_indicator') ) { include_once("app/toilet_indicator.php"); }
                        if ($act == obraxabrix('toilet_indicator_view')) { include_once("app/toilet_indicator_view.php"); }
                        
                    ?>

            
            <?php require("footer.php"); ?>

        </div><!-- /.main-container -->

        
        <!-- Required vendors -->
        <script src="<?php echo $__folder ?>vendor/global/global.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/chart.js/Chart.bundle.min.js"></script>
        <!-- Apex Chart -->
        <script src="<?php echo $__folder ?>vendor/apexchart/apexchart.js"></script>



        <!-- Daterangepicker -->
        <!-- momment js is must -->
        <script src="<?php echo $__folder ?>vendor/moment/moment.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- clockpicker -->
        <script src="<?php echo $__folder ?>vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!-- asColorPicker -->
        <script src="<?php echo $__folder ?>vendor/jquery-asColor/jquery-asColor.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
        <!-- Material color picker -->
        <script src="<?php echo $__folder ?>vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- pickdate -->
        <script src="<?php echo $__folder ?>vendor/pickadate/picker.js"></script>
        <script src="<?php echo $__folder ?>vendor/pickadate/picker.time.js"></script>
        <script src="<?php echo $__folder ?>vendor/pickadate/picker.date.js"></script>



        <!-- Daterangepicker -->
        <script src="<?php echo $__folder ?>js/plugins-init/bs-daterange-picker-init.js"></script>
        <!-- Clockpicker init -->
        <script src="<?php echo $__folder ?>js/plugins-init/clock-picker-init.js"></script>
        <!-- asColorPicker init -->
        <script src="<?php echo $__folder ?>js/plugins-init/jquery-asColorPicker.init.js"></script>
        <!-- Material color picker init -->
        <script src="<?php echo $__folder ?>js/plugins-init/material-date-picker-init.js"></script>
        <!-- Pickdate -->
        <script src="<?php echo $__folder ?>js/plugins-init/pickadate-init.js"></script>

        <script src="<?php echo $__folder ?>vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

        <!-- Datatable -->
        <script src="<?php echo $__folder ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo $__folder ?>js/plugins-init/datatables.init.js"></script>

        <!-- Required <?php echo $__folder ?>vendors -->
        <script src="<?php echo $__folder ?>vendor/global/global.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
        <script src="<?php echo $__folder ?>vendor/select2/js/select2.full.min.js"></script>
        <script src="<?php echo $__folder ?>js/plugins-init/select2-init.js"></script>

        <script src="<?php echo $__folder ?>vendor/global/global.min.js"></script>
        <script src="<?php echo $__folder ?>js/custom.min.js"></script>
        <script src="<?php echo $__folder ?>js/dlabnav-init.js"></script>
        <script src="<?php echo $__folder ?>js/styleSwitcher.js"></script>
        
    </body>
</html>
