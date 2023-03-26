<!--**********************************
    Sidebar start
***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('main') ?>">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

            </li>

            <?php if ( allow("frmpos")==1 || allow("frmclient")==1 || allow("frmclient_type")==1 || allow("frmdelivery_order")==1 || allow("frmpayment_method")==1 || allow("frmpos_status")==1 || allow("shopify_client")==1 || allow("shopify_sales")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-shopping-basket"></i>
	                    <span class="nav-text">Sales</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("frmpos")==1 ) { ?>
	                    	<li class="<?php echo $pos_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos') ?>">Penjualan</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmpos")==1 ) { ?>
	                    	<li class="<?php echo $pos_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_view') ?>">Daftar Penjualan</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmpos_status")==1 ) { ?>
	                    	<li class="<?php echo $pos_status_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_status') ?>">Status Penjualan</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmdelivery_order")==1 ) { ?>
	                    	<li class="<?php echo $pos_list_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('pos_list') ?>">Order Belum Kirim</a></li>

	                    	<li class="<?php echo $delord_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('delord_view') ?>">Daftar Pengiriman</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmclient")==1 ) { ?>
	                    	<li class="<?php echo $client_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client') ?>">Tambah Customer</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmclient")==1 ) { ?>
	                    	<li class="<?php echo $client_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client_view') ?>">Daftar Customer</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmclient_type")==1 ) { ?>
		                    <li class="<?php echo $client_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('client_type') ?>">Tipe Customer</a>
		                    </li>     
	                    <?php } ?>

	                    <?php if ( allow("frmpayment_method")==1 ) { ?>
	                    	<li class="<?php echo $payment_method_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('payment_method') ?>">Jenis Pembayaran</a>
                        	</li>     
                        <?php } ?>  

                        <?php if ( allow("shopify_sales")==1 ) { ?>
                        	<li class="<?php echo $shopify_sales_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_sales') ?>">Download Orders Shopify</a></li>      
                        <?php } ?>

                        <?php if ( allow("shopify_client")==1 ) { ?>
                        	<li class="<?php echo $shopify_client_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_client') ?>">Download Customer Shopify</a></li>      
                        <?php } ?>    
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("frmpurchase_inv")==1 || allow("frmgood_receipt")==1 || allow("frmpurchase_type")==1 || allow("frmmeasuring_size_sewing")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-shopping-cart"></i>
	                    <span class="nav-text">Purchasing</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("frmpurchase_inv")==1 ) { ?>
	                    	<li class="<?php echo $purchase_inv_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_inv') ?>">Pembelian</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmgood_receipt")==1 ) { ?>
	                    	<li class="<?php echo $good_receipt_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_list') ?>">Penerimaan Pembelian</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmgood_receipt")==1 ) { ?>
		                    <li class="<?php echo $good_receipt_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view') ?>">Daftar Penerimaan</a>
		                    </li>
		                <?php } ?>

		                <?php if ( allow("frmmeasuring_size_sewing")==1 ) { ?>
		                	<li class="<?php echo $measuring_size_sewing_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('measuring_size_sewing') ?>">Measuring Size Jahit</a></li>
		                <?php } ?>

		                <?php if ( allow("frmpurchase_type")==1 ) { ?>
		                    <li class="<?php echo $purchase_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('purchase_type') ?>">Jenis Order</a></li>
		                <?php } ?>
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("frmvendor")==1 || allow("frmvendor_type")==1 || allow("frmitem")==1 || allow("frmitem_group")==1 || allow("frmcolour")==1 || allow("frmuom")==1 || allow("frmchannel")==1 || allow("frmsize")==1 || allow("shopify_item")==1 || allow("frmwarehouse")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-box"></i>
	                    <span class="nav-text">Master Data</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("frmvendor")==1 ) { ?>
	                    	<li class="<?php echo $vendor_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor') ?>">Tambah Vendor</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmvendor")==1 ) { ?>
	                    	<li class="<?php echo $vendor_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor_view') ?>">Daftar Vendor</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmvendor_type")==1 ) { ?>
		                    <li class="<?php echo $vendor_type_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('vendor_type') ?>">Tipe Vendor</a>
		                    </li>
	                    <?php } ?>

	                    <?php if ( allow("frmitem")==1 ) { ?>
		                    <li class="<?php echo $item_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item') ?>">Tambah Produk</a></li>
		                    <li class="<?php echo $item_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_view') ?>">Daftar Produk</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmitem_group")==1 ) { ?>	
		                    <li class="<?php echo $item_group_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group') ?>">Kelompok Produk</a></li>
		                    <li class="<?php echo $item_group_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('item_group_view') ?>">Daftar Kelompok Produk</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmcolour")==1 ) { ?>
		                    <li class="<?php echo $colour_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('colour') ?>">Tambah Warna</a></li>
		                    <li class="<?php echo $colour_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('colour_view') ?>">Daftar Warna</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmuom")==1 ) { ?>
		                    <li class="<?php echo $uom_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('uom') ?>">Tambah Satuan</a></li>
		                    <li class="<?php echo $uom_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('uom_view') ?>">Daftar Satuan</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmchannel")==1 ) { ?>
		                    <li class="<?php echo $channel_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('channel') ?>">Tambah Channel Penjualan</a></li>
		                    <li class="<?php echo $channel_view_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('channel_view') ?>">Daftar Channel Penjualan</a></li>
		                <?php } ?>

		                <?php if ( allow("frmsize")==1 ) { ?>
			                <li class="<?php echo $size_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('size') ?>">Master Size</a></li>
			            <?php } ?>

			            <?php if ( allow("frmwarehouse")==1 ) { ?>
			            	<li class="<?php echo $warehouse_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('warehouse') ?>">Master Gudang</a></li>
			            <?php } ?>

			            <?php if ( allow("shopify_item")==1 ) { ?>
                        	<li class="<?php echo $shopify_item_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('shopify_item') ?>">Download Produk Shopify</a></li>      
                        <?php } ?>
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("frmgood_receipt")==1 || allow("frmstock_opname")==1 || allow("rpt_good_receipt")==1 ||allow("frmoutbound")==1 || allow("frmsales_return")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-building"></i>
	                    <span class="nav-text">Warehouse</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("frmgood_receipt")==1 ) { ?>
		                    <li class="<?php echo $good_receipt_view2_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('good_receipt_view2') ?>">Daftar Penerimaan PO</a>
		                    </li>
	                    <?php } ?>

	                    <?php if ( allow("frmstock_opname")==1 ) { ?>
		                    <li class="<?php echo $stock_opname_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('stock_opname') ?>">Stock Opname</a></li>
		                    </li>
	                    <?php } ?>

	                    <?php if ( allow("frmoutbound")==1 ) { ?>
	                    	<li class="<?php echo $outbound_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('outbound') ?>">Pemindahan Barang</a></li>
                        	</li>
                        <?php } ?>

                        <?php if ( allow("frmsales_return")==1 ) { ?>
                        	<li class="<?php echo $sales_return_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('sales_return') ?>">Sales Return</a></li>
                        	</li>
                        <?php } ?>

	                    <?php if ( allow("rpt_good_receipt")==1 ) { ?>
		                    <li class="<?php echo $rpt_good_receipt_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_good_receipt') ?>">Laporan Incoming PO</a>
		                    </li>
		                <?php } ?>
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("rpt_bincard")==1 || allow("rpt_stock")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-archive"></i>
	                    <span class="nav-text">Laporan</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("rpt_bincard")==1 ) { ?>
	                    	<li class="<?php echo $rpt_bincard_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_bincard') ?>">Lap. Kartu Stok</a></li>
	                    <?php } ?>

	                    <?php if ( allow("rpt_stock")==1 ) { ?>
	                    	<li class="<?php echo $rpt_stock_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('rpt_stock') ?>">Lap. Stok Barang</a></li>   
	                    <?php } ?>                  
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("frmusr")==1 || allow("frmcompany")==1 ) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-cogs"></i>
	                    <span class="nav-text">Setup</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("frmusr")==1 ) { ?>
	                    	<li class="<?php echo $user_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('usr') ?>">Setup User</a></li>
	                    <?php } ?>

	                    <?php if ( allow("frmcompany")==1 ) { ?>
		                    <li class="<?php echo $company_active ?>"><a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('company') ?>">Setup Perusahaan</a></li>
		                <?php } ?>
	                </ul>
	            </li>
            <?php } ?>

            <?php if ( allow("backup")==1 || allow("upload_client")==1) { ?>
	            <li>
	                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
	                    <i class="fas fa-tools"></i>
	                    <span class="nav-text">Utility</span>
	                </a>
	                <ul aria-expanded="false">
	                	<?php if ( allow("backup")==1 ) { ?>
	                    	<li><a href="#">Backup Database    </a></li>
	                    <?php } ?>

	                    <?php if ( allow("upload_client")==1 ) { ?>
	                    	<li><a href="#">Upload Daftar Customer</a></li>
	                    <?php } ?>
	                </ul>
	            </li>
            <?php } ?>

        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->