<?php
@session_start();

if ($act == '' ) {  
    $dashboard = "active open";
} 


/*SALES*/
if ( $act == obraxabrix('pos') ) {  
    $sales = "active open";
    $pos_active = "active";
}
if ( $act == obraxabrix('pos_view') ) {  
    $sales = "active open";
    $pos_view_active = "active";
}
if ( $act == obraxabrix('pos_list') ) {  
    $sales = "active open";
    $pos_list_active = "active";
}
if ( $act == obraxabrix('pos_status') ) {  
    $sales = "active open";
    $pos_status_active = "active";
}
if ( $act == obraxabrix('delord') || $act == obraxabrix('delord_view') ) {  
    $sales = "active open";
    $delord_active = "active";
}
if ( $act == obraxabrix('client') ) {  
    $sales = "active open";
    $client_active = "active";
} 
if ( $act == obraxabrix('client_view') ) {  
    $sales = "active open";
    $client_view_active = "active";
}
if ( $act == obraxabrix('client_type') || $act == obraxabrix('client_type_view') ) {  
    $sales = "active open";
    $client_type_active = "active";
}
if ( $act == obraxabrix('payment_method') || $act == obraxabrix('payment_method_view') ) {  
    $sales = "active open";
    $payment_method_active = "active";
}
if ( $act == obraxabrix('shopify_client') ) { 
    $sales = "active open";
    $shopify_client_active = "active"; 
}
if ( $act == obraxabrix('shopify_sales') ) { 
    $sales = "active open";
    $shopify_sales_active = "active"; 
}



/*PURCHASING*/
if ( $act == obraxabrix('purchase_inv') || $act == obraxabrix('purchase_inv_view')) {  
    $purchase = "active open";
    $purchase_inv_active = "active";
}

if ( $act == obraxabrix('good_receipt_list') || $act == obraxabrix('good_receipt') ) {  
    $purchase = "active open";
    $good_receipt_active = "active";
}
if ( $act == obraxabrix('good_receipt_view') ) {  
    $purchase = "active open";
    $good_receipt_view_active = "active";
}
if ( $act == obraxabrix('purchase_type') || $act == obraxabrix('purchase_type_view')) {  
    $purchase = "active open";
    $purchase_type_active = "active";
}
if ( $act == obraxabrix('measuring_size_sewing') || $act == obraxabrix('measuring_size_sewing_view')) {  
    $purchase = "active open";
    $measuring_size_sewing_active = "active";
}


/*MASTER DATA*/
if ( $act == obraxabrix('client_saldo') ) {  
    $master_data = "active open";
    $client_saldo_active = "active";
}
if ( $act == obraxabrix('vendor') ) {  
    $master_data = "active open";
    $vendor_active = "active";
} 
if ( $act == obraxabrix('vendor_view') ) {  
    $master_data = "active open";
    $vendor_view_active = "active";
}
if ( $act == obraxabrix('vendor_type') || $act == obraxabrix('vendor_type_view') ) {  
    $master_data = "active open";
    $vendor_type_active = "active";
}
if ( $act == obraxabrix('item') ) {  
    $master_data = "active open";
    $item_active = "active";
}
if ( $act == obraxabrix('item_view') ) {  
    $master_data = "active open";
    $item_view_active = "active";
}
if ( $act == obraxabrix('colour') ) {  
    $master_data = "active open";
    $colour_active = "active";
}
if ( $act == obraxabrix('colour_view') ) {  
    $master_data = "active open";
    $colour_view_active = "active";
}
if ( $act == obraxabrix('channel') ) {  
    $master_data = "active open";
    $channel_active = "active";
}
if ( $act == obraxabrix('channel_view') ) {  
    $master_data = "active open";
    $channel_view_active = "active";
}
if ( $act == obraxabrix('size') || $act == obraxabrix('size_view') ) {  
    $master_data = "active open";
    $size_active = "active";
}
if ( $act == obraxabrix('shopify_item') ) {  
    $master_data = "active open";
    $shopify_item_active = "active";
}

if ( $act == obraxabrix('product') || $act == obraxabrix('product_view') ) {  
    $master_data = "active open";
    $product_active = "active";
} 
if ( $act == obraxabrix('item_group') ) {  
    $master_data = "active open";
    $item_group_active = "active";
}
if ( $act == obraxabrix('item_group_view') ) {  
    $master_data = "active open";
    $item_group_view_active = "active";
}
if ( $act == obraxabrix('material') || $act == obraxabrix('material_view') ) {  
    $master_data = "active open";
    $material_active = "active";
}
if ( $act == obraxabrix('warehouse') || $act == obraxabrix('warehouse_view') ) {  
    $master_data = "active open";
    $warehouse_active = "active";
}
if ( $act == obraxabrix('uom') ) {  
    $master_data = "active open";
    $uom_active = "active";
}
if ( $act == obraxabrix('uom_view') ) {  
    $master_data = "active open";
    $uom_view_active = "active";
}
if ( $act == obraxabrix('promo') || $act == obraxabrix('promo_view') ) {  
    $master_data = "active open";
    $promo_active = "active";
}



/*WAREHOUSE*/
if ( $act == obraxabrix('rpt_good_receipt') ) {  
    $warehouse = "active open";
    $rpt_good_receipt_active = "active";
}
if ( $act == obraxabrix('outbound') || $act == obraxabrix('outbound_view') ) {  
    $warehouse = "active open";
    $outbound_active = "active";
}
if ( $act == obraxabrix('sales_return') || $act == obraxabrix('sales_return_view') ) {  
    $warehouse = "active open";
    $sales_return_active = "active";
}
if ( $act == obraxabrix('stock_opname') || $act == obraxabrix('stock_opname_list') || $act == obraxabrix('stock_opname_view') ) {  
    $warehouse = "active open";
    $stock_opname_active = "active";
}
if ( $act == obraxabrix('good_receipt_view2') ) {  
    $warehouse = "active open";
    $good_receipt_view2_active = "active";
}
if ( $act == obraxabrix('rpt_good_receipt_warehouse') ) {  
    $warehouse = "active open";
    $rpt_good_receipt_warehouse_active = "active";
}
if ( $act == obraxabrix('rpt_bincard') ) {  
    $warehouse = "active open";
    $rpt_bincard_active = "active";
}
if ( $act == obraxabrix('rpt_stock') ) {  
    $warehouse = "active open";
    $rpt_stock_active = "active";
}
##---------------------------------------------------




//Setup
if ( $act == obraxabrix('usr') || $act == obraxabrix('usr_view')) {  
    $pengaturan_system = "active open";
    $user_active = "active";
} 
 
if ( $act == obraxabrix('company') || $act == obraxabrix('company_view') ) {  
    $pengaturan_system = "active open";
    $company_active = "active";
}
if ( $act == obraxabrix('client_set_level') || $act == obraxabrix('client_set_level_view') ) {  
    $pengaturan_system = "active open";
    $client_set_level_active = "active";
}
if ( $act == obraxabrix('level') ) {  
    $pengaturan_system = "active open";
    $level_active = "active";
}


/*utility*/
if ( $act == obraxabrix('upload_download') ) { 
    $utility = "active open";
    $upload_download_active = "active"; 
}
if ( $act == obraxabrix('backup') ) { 
    $utility = "active open";
    $backup_active = "active"; 
}
if ( $act == obraxabrix('query_string') ) {  
    $utility = "active open hover";
    $query_string_active = "active";
}


/*HRD*/
if ( $act == obraxabrix('employee') || $act == obraxabrix('employee_view') ) {  
    $hrd = "active open";
    $employee_active = "active";
}
if ( $act == obraxabrix('division') || $act == obraxabrix('division_view') ) {  
    $hrd = "active open";
    $division_active = "active";
}
if ( $act == obraxabrix('position') || $act == obraxabrix('position_view') ) {  
    $hrd = "active open";
    $position_active = "active";
}
if ( $act == obraxabrix('employee_basic_salary') ) {  
    $hrd = "active open";
    $employee_basic_salary_active = "active";
}
if ( $act == obraxabrix('salary') || $act == obraxabrix('salary_view') ) {  
    $hrd = "active open";
    $salary_active = "active";
}




/*FINANCE*/
if ( $act == obraxabrix('finance_type') || $act == obraxabrix('finance_type_view') ) {  
    $finance = "active open";
    $finance_type_active = "active";
}
if ( $act == obraxabrix('receipt') || $act == obraxabrix('receipt_view') ) {  
    $finance = "active open";
    $receipt_active = "active";
}
if ( $act == obraxabrix('payment') || $act == obraxabrix('payment_view') ) {  
    $finance = "active open";
    $payment_active = "active";
}

if ( $act == obraxabrix('coa') || $act == obraxabrix('coa_view') ) {  
    $finance = "active open";
    $coa_active = "active";
}
if ( $act == obraxabrix('general_journal') || $act == obraxabrix('general_journal_view') ) {  
    $finance = "active open";
    $general_journal_active = "active";
}
if ( $act == obraxabrix('general_journal_in') || $act == obraxabrix('general_journal_in_view') ) {  
    $finance = "active open";
    $general_journal_in_active = "active";
}
if ( $act == obraxabrix('deposit_client') || $act == obraxabrix('deposit_client_view') ) {  
    $finance = "active open";
    $deposit_client_active = "active";
}
if ( $act == obraxabrix('rpt_room_tax') ) {  
    $finance = "active open";
    $rpt_room_tax_active = "active";
}
if ( $act == obraxabrix('rpt_sales') ) {  
    $finance = "active open";
    $rpt_sales_active = "active";
}
if ( $act == obraxabrix('rpt_sales_tax') ) {  
    $finance = "active open";
    $rpt_sales_tax_active = "active";
}
if ( $act == obraxabrix('rpt_sales_product_summary') ) {  
    $finance = "active open";
    $rpt_sales_product_summary_active = "active";
}
if ( $act == obraxabrix('rpt_purchase_inv_global') ) {  
    $finance = "active open";
    $rpt_purchase_inv_global_active = "active";
}
if ( $act == obraxabrix('rpt_general_journal') ) {  
    $finance = "active open";
    $rpt_general_journal_active = "active";
}
if ( $act == obraxabrix('rpt_ap') ) {  
    $finance = "active open";
    $rpt_ap_active = "active";
}
if ( $act == obraxabrix('rpt_ar') ) {  
    $finance = "active open";
    $rpt_ar_active = "active";
}
if ( $act == obraxabrix('rpt_cash_flow') ) {  
    $finance = "active open";
    $rpt_cash_flow_active = "active";
}



/*REPORT*/
if ( $act == obraxabrix('rpt_client') ) {  
    $report = "active open";
    $rpt_client_active = "active";
} 
if ( $act == obraxabrix('rpt_profit_loss2') ) {  
    $report = "active open";
    $rpt_profit_loss2_active = "active";
}



/*REPORT FOR COMPANY*/
if ( $act == obraxabrix('rpt_member') ) {  
    $report_company = "active open";
    $rpt_member_active = "active";
} 
if ( $act == obraxabrix('rpt_member_registration') ) {  
    $report_company = "active open";
    $rpt_member_registration_active = "active";
}
if ( $act == obraxabrix('rpt_agent') ) {  
    $report_company = "active open";
    $rpt_agent_active = "active";
}
if ( $act == obraxabrix('rpt_budget_product') ) {  
    $report_company = "active open";
    $rpt_budget_product_active = "active";
}
if ( $act == obraxabrix('rpt_budget_bonus') ) {  
    $report_company = "active open";
    $rpt_budget_bonus_active = "active";
}
if ( $act == obraxabrix('rpt_cash_bank') ) {  
    $report_company = "active open";
    $rpt_cash_bank_active = "active";
}
if ( $act == obraxabrix('rpt_commision_reward') ) {  
    $report_company = "active open";
    $rpt_commision_reward_active = "active";
}
if ( $act == obraxabrix('rpt_commision_reward_summary') ) {  
    $report_company = "active open";
    $rpt_commision_reward_summary_active = "active";
}
if ( $act == obraxabrix('rpt_sales_product') ) {  
    $report_company = "active open";
    $rpt_sales_product_active = "active";
}

if ( $act == obraxabrix('rpt_topup_saldo') ) {  
    $report_company = "active open";
    $rpt_topup_saldo_active = "active";
}
if ( $act == obraxabrix('rpt_company_summary') ) {  
    $report_company = "active open";
    $rpt_company_summary_active = "active";
}


/*PRODUKSI*/
if ( $act == obraxabrix('sewing') || $act == obraxabrix('sewing_view') ) {  
    $production = "active open";
    $sewing_active = "active";
}
if ( $act == obraxabrix('sewing_list') ) {  
    $production = "active open";
    $sewing_list_active = "active";
} 
if ( $act == obraxabrix('rpt_sewing') ) {  
    $production = "active open";
    $rpt_sewing_active = "active";
}

/*R & D*/
if ( $act == obraxabrix('new_product') || $act == obraxabrix('new_product_view') ) {  
    $rnd = "active open";
    $new_product_active = "active";
}


/*TRANSACTION*/
if ( $act == obraxabrix('registration') || $act == obraxabrix('registration_view') || $act == obraxabrix('registration_list') ) {  
    $transaction = "active open";
    $registration_active = "active";
}
if ( $act == obraxabrix('booking') || $act == obraxabrix('booking_view') || $act == obraxabrix('booking_room') ) {  
    $transaction = "active open";
    $booking_active = "active";
}
if ( $act == obraxabrix('room_registration') || $act == obraxabrix('room_registration_view') || $act == obraxabrix('room_registration_list') ) {  
    $transaction = "active open";
    $room_registration_active = "active";
}
if ( $act == obraxabrix('room_booking') || $act == obraxabrix('room_booking_filter') || $act == obraxabrix('room_booking_view') ) {  
    $transaction = "active open";
    $room_booking_active = "active";
}
if ( $act == obraxabrix('outbound') || $act == obraxabrix('outbound_view') ) {  
    $transaction = "active open";
    $outbound_active = "active";
}
if ( $act == obraxabrix('defective') || $act == obraxabrix('defective_view') ) {  
    $transaction = "active open";
    $defective_active = "active";
}
if ( $act == obraxabrix('inspection') || $act == obraxabrix('inspection_view') ) {  
    $transaction = "active open";
    $inspection_active = "active";
}
if ( $act == obraxabrix('build_list') ) {  
    $transaction = "active open";
    $build_list_active = "active";
}
if ( $act == obraxabrix('room_list') ) {  
    $transaction = "active open";
    $room_list_active = "active";
}
if ( $act == obraxabrix('chamber_list') ) {  
    $transaction = "active open";
    $chamber_list_active = "active";
}
if ( $act == obraxabrix('garden_list') ) {  
    $transaction = "active open";
    $garden_list_active = "active";
}
if ( $act == obraxabrix('toilet_inspection') || $act == obraxabrix('toilet_inspection_filter') || $act == obraxabrix('toilet_inspection_view') ) {  
    $transaction = "active open";
    $toilet_inspection_active = "active";
}

if ( $act == obraxabrix('build') || $act == obraxabrix('build_view') ) {  
    $transaction = "active open";
    $build_active = "active";
} 
if ( $act == obraxabrix('room') || $act == obraxabrix('room_view') ) {  
    $transaction = "active open";
    $room_active = "active";
}
if ( $act == obraxabrix('chamber') || $act == obraxabrix('chamber_view') ) {  
    $transaction = "active open";
    $chamber_active = "active";
}
if ( $act == obraxabrix('garden') || $act == obraxabrix('garden_view') ) {  
    $transaction = "active open";
    $garden_active = "active";
} 
if ( $act == obraxabrix('toilet_indicator') || $act == obraxabrix('toilet_indicator_view') ) {  
    $transaction = "active open";
    $toilet_indicator_active = "active";
} 

                                
?>

<!--**********************************
    Sidebar start
***********************************-->
<?php if($_SESSION['adm'] == 1) { ?>
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li>
                    <a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('main') ?>">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>

                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-shopping-basket"></i>
                        <span class="nav-text">Sales</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $pos_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos') ?>">Penjualan</a></li>
                        <li class="<?php echo $pos_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_view') ?>">Daftar Penjualan</a></li>
                        <li class="<?php echo $pos_status_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_status') ?>">Status Penjualan</a></li>
                        <li class="<?php echo $pos_list_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_list') ?>">Order Belum Kirim</a></li>
                        <li class="<?php echo $delord_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('delord_view') ?>">Daftar Pengiriman</a></li>
                        <li class="<?php echo $client_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client') ?>">Tambah Customer</a>
                        </li>
                        <li class="<?php echo $client_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client_view') ?>">Daftar Customer</a></li>
                        <li class="<?php echo $client_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client_type') ?>">Tipe Customer</a>
                        </li>
                        <li class="<?php echo $payment_method_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('payment_method') ?>">Jenis Pembayaran</a>
                        </li>                    
                        <li class="<?php echo $shopify_sales_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_sales') ?>">Download Orders Shopify</a></li>
                        <li class="<?php echo $shopify_client_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_client') ?>">Download Customer Shopify</a></li>
                    </ul>

                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="nav-text">Purchasing</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $purchase_inv_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv') ?>">Pembelian</a></li>
                        <li class="<?php echo $good_receipt_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_list') ?>">Penerimaan Pembelian</a></li>
                        <li class="<?php echo $good_receipt_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view') ?>">Daftar Penerimaan</a>
                        </li>
                        <li class="<?php echo $measuring_size_sewing_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('measuring_size_sewing') ?>">Measuring Size Jahit</a></li>

                        <li class="<?php echo $measuring_size_sewing_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_order_sewing') ?>">Order Vendor Jahit</a></li>

                        <li class="<?php echo $measuring_size_sewing_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('receipt_purchase_order_sewing') ?>">QC Penerimaan Jahit</a></li>

                        <li class="<?php echo $purchase_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_type') ?>">Jenis Order</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-box"></i>
                        <span class="nav-text">Master Data</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $vendor_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor') ?>">Tambah Vendor</a></li>
                        <li class="<?php echo $vendor_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor_view') ?>">Daftar Vendor</a></li>
                        <li class="<?php echo $vendor_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor_type') ?>">Tipe Vendor</a>
                        </li>
                        <li class="<?php echo $item_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item') ?>">Tambah Produk</a></li>
                        <li class="<?php echo $item_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_view') ?>">Daftar Produk</a></li>
                        <li class="<?php echo $item_group_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group') ?>">Kelompok Produk</a></li>
                        <li class="<?php echo $item_group_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group_view') ?>">Daftar Kelompok Produk</a></li>
                        <li class="<?php echo $colour_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('colour') ?>">Tambah Warna</a></li>
                        <li class="<?php echo $colour_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('colour_view') ?>">Daftar Warna</a></li>
                        <li class="<?php echo $uom_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('uom') ?>">Tambah Satuan</a></li>
                        <li class="<?php echo $uom_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('uom_view') ?>">Daftar Satuan</a></li>
                        <li class="<?php echo $channel_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('channel') ?>">Tambah Channel Penjualan</a></li>
                        <li class="<?php echo $channel_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('channel_view') ?>">Daftar Channel Penjualan</a></li>
                        <li class="<?php echo $size_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('size') ?>">Master Size</a></li>
                        <li class="<?php echo $warehouse_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('warehouse') ?>">Master Gudang</a></li>
                        <li class="<?php echo $shopify_item_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_item') ?>">Download Produk Shopify</a></li>      
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-building"></i>
                        <span class="nav-text">Warehouse</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $good_receipt_view2_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view2') ?>">Daftar Penerimaan PO</a>
                        </li>
                        <li class="<?php echo $stock_opname_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('stock_opname') ?>">Stock Opname</a></li>
                        </li>
                        <li class="<?php echo $outbound_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('outbound') ?>">Pemindahan Barang</a></li>
                        </li>
                        <li class="<?php echo $sales_return_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('sales_return') ?>">Sales Return</a></li>
                        </li>
                        <li class="<?php echo $rpt_good_receipt_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_good_receipt') ?>">Laporan Incoming PO</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-archive"></i>
                        <span class="nav-text">Laporan</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $rpt_bincard_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_bincard') ?>">Lap. Kartu Stok</a></li>
                        <li class="<?php echo $rpt_stock_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_stock') ?>">Lap. Stok Barang</a></li>                    
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-cogs"></i>
                        <span class="nav-text">Setup</span>
                    </a>
                    <ul aria-expanded="false">
                        <li class="<?php echo $user_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('usr') ?>">Setup User</a></li>
                        <li class="<?php echo $company_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('company') ?>">Setup Perusahaan</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-tools"></i>
                        <span class="nav-text">Utility</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Backup Database </a></li>
                        <li class="<?php echo $query_string_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('query_string') ?>">Execute Query</a></li>

                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<?php 
    } else {
        include('menu_user.php');
    }
?>


<!--**********************************
    Sidebar end
***********************************-->