<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('timelineTimeLabel')){
	function timelineTimeLabel($label){
		$content = '';

		$content .= '<div class="time-label">';
        $content .= '<span class="bg-green">'. date('d M Y', strtotime($label)) .'</span>';
      	$content .= '</div>';

      	return $content;
	}
}

if(!function_exists('timelineItemApproval')){
	function timelineItemApproval($data, $type){

		$content = '';

		$content .= '<div>';
		$content .= '<i class="fas fa-user-check bg-teal"></i>';
		$content .= '<div class="timeline-item">';

		if($type == 'so'){
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_po'][FIELD_CHECKER_APPROVAL_AT])) .'</span>';

			$checker_approval = ($data['master_po'][FIELD_CHECKER_APPROVAL] == 1 && !is_null($data['master_po'][FIELD_CHECKER_APPROVAL]) ? 'Sales Order <label class="badge badge-success">disetujui</label> oleh checker' : 'Sales Order <label class="badge badge-danger">ditolak</label> oleh checker');
			$detail_link = $data['master_po'][FIELD_PM_FISCAL_YEAR]."-".$data['master_po'][FIELD_PM_PO_ID];
			$checker_by = $data['master_po'][FIELD_CHECKER_APPROVAL_BY];

			$content .= '<h3 class="timeline-header"><strong>Approval '. strtoupper($type) .' -</strong> <a href="'.base_url('purchase_order/view/'.$detail_link).'">'. $data['master_po'][FIELD_PM_PO_NO] .'</a></h3>';
		}else if($type == 'do'){
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_do'][FIELD_CHECKER_APPROVAL_AT])) .'</span>';

			$checker_approval = ($data['master_do'][FIELD_CHECKER_APPROVAL] == 1 && !is_null($data['master_do'][FIELD_CHECKER_APPROVAL]) ? 'Delivery Order <label class="badge badge-success">disetujui</label> oleh checker' : 'Delivery Order <label class="badge badge-danger">ditolak</label> oleh checker');
			$detail_link = $data['master_do'][FIELD_DOM_PLANT]."-".$data['master_do'][FIELD_DOM_FISCAL_YEAR]."-".$data['master_do'][FIELD_DOM_ID];
			$checker_by = $data['master_do'][FIELD_CHECKER_APPROVAL_BY];

			$content .= '<h3 class="timeline-header"><strong>Approval '. strtoupper($type) .' -</strong> <a href="'.base_url('delivery_order/view/'.$detail_link).'">'. $data['master_do'][FIELD_DOM_NO] .'</a></h3>';
		}else if($type == 'sc'){
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_sc'][FIELD_CHECKER_APPROVAL_AT])) .'</span>';

			$checker_approval = ($data['master_sc'][FIELD_CHECKER_APPROVAL] == 1 && !is_null($data['master_sc'][FIELD_CHECKER_APPROVAL]) ? 'Sales Confirmation <label class="badge badge-success">disetujui</label> oleh checker' : 'Sales Confirmation <label class="badge badge-danger">ditolak</label> oleh checker');
			$detail_link = $data['master_sc'][FIELD_SCM_PLANT]."-".$data['master_sc'][FIELD_SCM_FISCAL_YEAR]."-".$data['master_sc'][FIELD_SCM_ID];
			$checker_by = $data['master_sc'][FIELD_CHECKER_APPROVAL_BY];

			$content .= '<h3 class="timeline-header"><strong>Approval '. strtoupper($type) .' -</strong> <a href="'.base_url('sales_confirmation/view/'.$detail_link).'">'. $data['master_sc'][FIELD_SCM_NO] .'</a></h3>';
		}

		$content .= '<div class="timeline-body">';

		$user = getUserHelper($checker_by);

		$content .= '<dl>';

		$content .= '<dt>Status</dt>';
		$content .= '<dd>'.$checker_approval.'</dd>';

		$content .= '<dt>Checker</dt>';
		$content .= '<dd>'.$user[F_USER_FULLNAME].'</dd>';


		$content .= '</dl>';

		$content .= '</div>';
		$content .= '<div class="timeline-footer">';
		
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';

		return $content;

	}
}

if(!function_exists('timelineItemPO')){
	function timelineItemPO($data){

		$po_link = $data['master_po'][FIELD_PM_FISCAL_YEAR]."-".$data['master_po'][FIELD_PM_PO_ID];

		$content = '';

		$content .= '<div>';
		$content .= '<i class="fas fa-file-alt bg-blue"></i>';
		$content .= '<div class="timeline-item">';
		$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_po'][FIELD_CREATE_DATETIME])) .'</span>';
		$content .= '<h3 class="timeline-header"><strong>Sales Order -</strong> <a href="'.base_url('purchase_order/view/'.$po_link).'">'. $data['master_po'][FIELD_PM_PO_NO] .'</a></h3>';
		$content .= '<div class="timeline-body">';

		//content for so master info
		$content .= '<div class="row">';
		$content .= '<div class="col-12 col-md-12">';
		$content .= '<table class="table table-sm table-striped">';
		$content .= '<tbody>';

		$content .= '<tr>';
		$content .= '<th style="width:180px;">Tanggal Order</th>';
		$content .= '<td>: '. date('d M Y', strtotime($data['master_po'][FIELD_PM_PO_DATE])) .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th style="width:180px;">Customer</th>';
		$content .= '<td>: '. $data['master_po'][FIELD_PARTNER_NAME] .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th style="width:180px;">Ekspektasi Diterima</th>';
		$content .= '<td>: '. date('d M Y', strtotime($data['master_po'][FIELD_PM_PO_SEND_DATE])) .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th>Customer Segment</th>';
		$content .= '<td>: '. $data['master_po']['partner_segment1'] .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th>Customer PO No.</th>';
		$content .= '<td>: '. $data['master_po'][FIELD_PM_CUSTOMER_PO_NO] .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th style="width:180px;">Term of Payment</th>';
		$content .= '<td>: '. $data['master_po']['term_name'] .'</td>';
		$content .= '</tr>';

		$content .= '<tr>';
		$content .= '<th style="width:180px;">PIC Sales</th>';
		$content .= '<td>: '. $data['master_po'][FIELD_SALES_NAME] .'</td>';
		$content .= '</tr>';

		$content .= '</tbody>';
		$content .= '</table>';
		$content .= '</div>';
		$content .= '</div>';

		//content for so detail info

		$total_pcs = 0;
		$total_kg = 0;
		$grand_total = 0;

		$content .= '<div class="row mt-1">';
		$content .= '<div class="col-12 col-md-12">';
		$content .= '<table class="table table-bordered table-hover table-sm" style="width:100%;">';
		$content .= '<thead>';
		$content .= '<tr>';
		$content .= '<th class="text-center align-middle" rowspan="2">No.</th>';
		$content .= '<th class="text-center align-middle" rowspan="2">Produk</th>';
		$content .= '<th class="text-center align-middle" colspan="2">Qty</th>';
		$content .= '<th class="text-center align-middle" rowspan="2" style="width:100px;">Basis Harga</th>';
		$content .= '<th class="text-center align-middle" rowspan="2">HPP</th>';
		$content .= '<th class="text-center align-middle" rowspan="2">Total Harga</th>';
		$content .= '</tr>';
		$content .= '<tr>';
		$content .= '<th class="text-center align-middle">Pcs</th>';
		$content .= '<th class="text-center align-middle">Kg</th>';
		$content .= '</tr>';
		$content .= '</thead>';
		$content .= '<tbody>';
		
		if(count($data['detail_po']) <= 0){
			$content .= '<tr>';
			$content .= '<td colspan="9" class="text-center">Daftar barang kosong</td>';
			$content .= '</tr>';
		}else{

			foreach ($data['detail_po'] as $key => $value) {

				$content .= '<tr>';
				$content .= '<td>'. ($key+1) .'</td>';
				$content .= '<td>'. $value[FIELD_ITEM_NAME] .'</td>';
				$content .= '<td class="text-right">';
				$content .= number_format($value[FIELD_PD_QTY_PCS],0,'.',',');
				$total_pcs = $total_pcs + $value[FIELD_PD_QTY_PCS];
				$content .= '</td>';
				$content .= '<td class="text-right">';
				$content .= number_format($value[FIELD_PD_QTY_KG],2,'.',',');
				$total_kg = $total_kg + $value[FIELD_PD_QTY_KG];
				$content .= '</td>';
				$content .= '<td class="text-center">'. ucfirst($value[FIELD_PD_PRICE_BY]) .'</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_PD_UNIT_PRICE],0,'.',',') .'</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_PD_AMOUNT],0,'.',',') .'</td>';
				$grand_total = $grand_total + $value[FIELD_PD_AMOUNT];
				$content .= '</tr>';

			}

		}
		$content .= '</tbody>';
		$content .= '<tfoot>';
		$content .= '<tr>';
		$content .= '<th colspan="2" class="text-right">Total</th>';
		$content .= '<th><span id="total-pcs" class="float-right">'. num_separator($total_pcs) .'</span></th>';
		$content .= '<th><span id="total-kg" class="float-right">'. num_separator($total_kg,2) .'</span></th>';
		$content .= '<th colspan="2">&nbsp;</th>';
		$content .= '<th><span class="float-right">'. num_separator($grand_total) .'</span></th>';
		$content .= '</tr>';
		$content .= '</tfoot>';
		$content .= '</table>';
		$content .= '</div>';
		$content .= '</div>';


		$content .= '</div>';
		$content .= '<div class="timeline-footer">';
		$content .= '<hr class="mb-2">';
		$content .= '<p class="text-muted mt-0 mb-0">Created by '. $data['master_po'][F_USER_FULLNAME] .' at '. date('d M Y | H:i', strtotime($data['master_po'][FIELD_CREATE_DATETIME])) .'</p>';
		$content .= '</div>';
		$content .= '</div>';

		$content .= '</div>';

		return $content;

	}


	if(!function_exists('timelineItemDO')){
		function timelineItemDO($data){

			$detail_link = $data['master_do'][FIELD_DOM_PLANT]."-".$data['master_do'][FIELD_DOM_FISCAL_YEAR]."-".$data['master_do'][FIELD_DOM_ID];

			$content = '';

			$content .= '<div>';
			$content .= '<i class="fas fa-truck-loading bg-yellow"></i>';
			$content .= '<div class="timeline-item">';
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_do'][FIELD_CREATE_DATETIME])) .'</span>';
			$content .= '<h3 class="timeline-header"><strong>Delivery Order -</strong> <a href="'.base_url('delivery_order/view/'.$detail_link).'">'. $data['master_do'][FIELD_DOM_NO] .'</a></h3>';
			$content .= '<div class="timeline-body">';

			$content .= '<div class="row">';
			$content .= '<div class="col-12 col-md-12">';
			$content .= '<table class="table table-sm table-striped">';
			$content .= '<tbody>';
			$content .= '<tr>';
			$content .= '<th style="width:180px;">No. DO</th>';
			$content .= '<td>: '. $data['master_do'][FIELD_DOM_NO].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th style="width:180px;">Tanggal DO</th>';
			$content .= '<td>: '. date('d M Y / H:i', strtotime($data['master_do'][FIELD_DOM_DATE]." ".$data['master_do'][FIELD_DOM_TIME])).'</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th style="width:180px;">Tipe Barang</th>';
			$content .= '<td>: '. ($data['master_do'][FIELD_DOM_GOODS_TYPE] == DO_GOODS_TYPE_FROZEN ? 'FROZEN' : ($data['master_do'][FIELD_DOM_GOODS_TYPE] == DO_GOODS_TYPE_FRESH ? 'Fresh' : 'Retail')).'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th style="width:180px;">Ekspektasi Diterima</th>';
			$content .= '<td>: '. date('d M Y / H:i', strtotime($data['master_do'][FIELD_DOM_SEND_DATE]." ".$data['master_do'][FIELD_DOM_SEND_TIME])).'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th style="width:180px;">Unit</th>';
			$content .= '<td>: '. $data['master_do'][FIELD_PLANT_NAME].'</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th style="width:180px;">Storage</th>';
			$content .= '<td>: '. $data['master_do'][FIELD_STORAGE_NAME] .'</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th style="width:180px;">Nama Supir</th>';
			$content .= '<td>: '. $data['master_do'][FIELD_DOM_DRIVER_NAME].'</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th style="width:180px;">No. Kendaraan</th>';
			$content .= '<td>:  '. $data['master_do'][FIELD_DOM_PLATE_NUMBER].'</td>';
			$content .= '</tr>';

			$content .= '</tbody>';
			$content .= '</table>';
			$content .= '</div>';
			$content .= '</div>';

			$content .= '<div class="row">';
			$content .= '<div class="col-12">';
			$content .= '<table class="table table-hover table-striped table-sm table-bordered" id="tbl-input">';
			$content .= '<thead>';
			$content .= '<tr>';
			$content .= '<th class="text-center align-middle" rowspan="2">No.</th>';
			$content .= '<th class="text-center align-middle" rowspan="2" style="width: 300px;">Produk</th>';
			$content .= '<th class="text-center" colspan="3">Qty</th>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th class="text-center">Pcs</th>';
			$content .= '<th class="text-center">Kg</th>';
			$content .= '<th class="text-center">Karung</th>';
			$content .= '</tr>';
			$content .= '</thead>';

			$content .= '<tbody>';


			$do_pcs = 0;
			$do_kg = 0;
			$do_karung = 0;


			if(count($data['detail_do']) == 0){
			
				$content .= '<tr id="row-empty">';
				$content .= '<td colspan="9" class="text-center">Daftar barang kosong</td>';
				$content .= '</tr>';
			
			}else{

				foreach ($data['detail_do'] as $key => $value) {

					$content .= '<tr class="recv-item">';

					$content .= '<td class="align-middle">';
					$content .= $key+1;
					$content .= '</td>';
					$content .= '<td class="align-middle">';
					$content .= $value[FIELD_ITEM_NAME];
					$content .= '</td>';
					$content .= '<td class="text-right align-middle">';
					$content .= number_format($value[FIELD_DOD_QTY_PCS],0,'.',',');
					$do_pcs = $do_pcs+$value[FIELD_DOD_QTY_PCS];

					$content .= '</td>';
					$content .= '<td class="text-right align-middle">';
					$content .= number_format($value[FIELD_DOD_QTY_KG],2,'.',',');
					$do_kg = $do_kg+$value[FIELD_DOD_QTY_KG];

					$content .= '</td>';
					$content .= '<td class="text-right align-middle">';
					$content .= number_format($value[FIELD_DOD_QTY_KARUNG],2,'.',',');
					$do_karung = $do_karung+$value[FIELD_DOD_QTY_KARUNG];

					$content .= '</td>';

					$content .= '</tr>';

				}

			}
			$content .= '</tbody>';
			$content .= '<tfoot>';
			$content .= '<tr>';
			$content .= '<th colspan="2" class="text-right">Total</th>';
			$content .= '<th class="text-right">'. num_separator($do_pcs) .'</th>';
			$content .= '<th class="text-right">'. num_separator($do_kg,2) .'</th>';
			$content .= '<th class="text-right">'. num_separator($do_karung) .'</th>';
			$content .= '</tr>';
			$content .= '</tfoot>';
			$content .= '</table>';
			$content .= '</div>';

			$content .= '</div>';
			$content .= '</div>';
			$content .= '<div class="timeline-footer">';
			$content .= '<hr class="mb-2">';
			$content .= '<p class="text-muted mt-0 mb-0">Created by '. $data['master_do'][F_USER_FULLNAME] .' at '. date('d M Y | H:i', strtotime($data['master_do'][FIELD_CREATE_DATETIME])) .'</p>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';

			return $content;

		}
	}

	if(!function_exists('timelineItemSJ')){
		function timelineItemSJ($data){

			$detail_link = $data['master_do'][FIELD_SJM_PLANT]."-".$data['master_do'][FIELD_SJM_FISCAL_YEAR]."-".$data['master_do'][FIELD_SJM_ID];
			$content = '';

			$content .= '<div>';
			$content .= '<i class="fas fa-file-signature bg-orange"></i>';
			$content .= '<div class="timeline-item">';
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_do']['sj_generated_at'])) .'</span>';
			$content .= '<h3 class="timeline-header"><strong>Surat Jalan -</strong> <a href="'.base_url('delivery_order/view_print_sj/'.$detail_link).'">'. $data['master_do'][FIELD_SJM_NO] .'</a></h3>';
			$content .= '<div class="timeline-body">';

			$content .= '<div class="row">';
			$content .= '<div class="col-12">';

			$content .= '<table class="table table-sm table-striped mb-0" style="width:100%;">';
			$content .= '<tbody>';

			$content .= '<tr>';
			$content .= '<th style="width:30%;">Unit</th>';
			$content .= '<td class="info-table-colon">:</td>';
			$content .= '<td>';
			$content .= $data['master_do'][FIELD_STORAGE_NAME];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th class="info-table-title">Kode Customer</th>';
			$content .= '<td class="info-table-colon">:</td>';
			$content .= '<td>';
			$content .= $data['master_po'][FIELD_PM_PARTNER];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th>Nama Customer</th>';
			$content .= '<td>:</td>';
			$content .= '<td>';
			$content .= $data['master_po'][FIELD_PARTNER_NAME];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th>No. Telp Customer</th>';
			$content .= '<td>:</td>';
			$content .= '<td>';
			$content .= $data['master_po'][FIELD_PARTNER_PHONE];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th class="info-table-title">Alamat Pengiriman</th>';
			$content .= '<td class="info-table-colon">:</td>';
			$content .= '<td >';
			$content .= $data['master_po'][FIELD_PM_SHIP_TO];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th>No. Pol. Kendaraan</th>';
			$content .= '<td>:</td>';
			$content .= '<td>';
			$content .= $data['master_do'][FIELD_DOM_PLATE_NUMBER];
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '</tbody>';
			$content .= '</table>';

			$content .= '</div>';
			$content .= '</div>';

			$content .= '</div>';
			$content .= '<div class="timeline-footer">';
			$content .= '<hr class="mb-2">';
			$content .= '<p class="text-muted mt-0 mb-0">Generated by '. $data['master_do']['sj_user_fullname'] .' at '. date('d M Y | H:i', strtotime($data['master_do']['sj_generated_at'])) .'</p>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';

			return $content;

		}
	}

	if(!function_exists('timelineItemSC')){
		function timelineItemSC($data){
			$detail_link = $data['master_sc'][FIELD_SCM_PLANT]."-".$data['master_sc'][FIELD_SCM_FISCAL_YEAR]."-".$data['master_sc'][FIELD_SCM_ID];

			$content = '';

			$content .= '<div>';
			$content .= '<i class="fas fa-clipboard-check bg-purple"></i>';
			$content .= '<div class="timeline-item">';
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_sc'][FIELD_CREATE_DATETIME])) .'</span>';
			$content .= '<h3 class="timeline-header"><strong>Sales Confirmation -</strong> <a href="'.base_url('sales_confirmation/view/'.$detail_link).'">'. $data['master_sc'][FIELD_SCM_NO] .'</a></h3>';
			$content .= '<div class="timeline-body">';

			$content .= '<div class="row">';
			$content .= '<div class="col-12">';

			$content .= '<h5>Konfirmasi Penjualan</h5>';

			$content .= '<table class="table table-hover table-striped table-sm table-bordered" id="tbl-input">';
			$content .= '<thead>';
			$content .= '<tr>';
			$content .= '<th class="text-center align-middle" rowspan="2">No.</th>';
			$content .= '<th class="text-center align-middle" rowspan="2" style="width: 300px;">Produk</th>';
			$content .= '<th class="text-center" colspan="2">Qty</th>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<th class="text-center">Pcs</th>';
			$content .= '<th class="text-center">Kg</th>';
			$content .= '</tr>';
			$content .= '</thead>';

			$content .= '<tbody>';


			$sc_pcs = 0;
			$sc_kg = 0;
			$sc_karung = 0;


			if(count($data['detail_sc']) == 0){
				$content .= '<tr id="row-empty-do">';
				$content .= '<td colspan="9" class="text-center">Daftar barang kosong</td>';
				$content .= '</tr>';
			}else{

				foreach ($data['detail_sc'] as $key => $value) {

					$content .= '<tr class="recv-item">';

					$content .= '<td class="align-middle">';
					$content .=  $key+1;
					$content .= '</td>';
					$content .= '<td class="align-middle">';
					$content .=  $value[FIELD_ITEM_NAME];
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .=  num_separator($value[FIELD_SCD_QTY_PCS]); $sc_pcs = $sc_pcs + $value[FIELD_SCD_QTY_PCS];
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .=  num_separator($value[FIELD_SCD_QTY_KG], 2); $sc_kg = $sc_kg + $value[FIELD_SCD_QTY_KG];
					$content .= '</td>';


					$content .= '</tr>';

				}

			}
			$content .= '</tbody>';
			$content .= '<tfoot>';
			$content .= '<tr>';
			$content .= '<th colspan="2" class="text-right">Total</th>';
			$content .= '<th class="text-right"><span id="total-selcon-pcs">'. num_separator($sc_pcs) .'</span></th>';
			$content .= '<th class="text-right"><span id="total-selcon-kg">'. num_separator($sc_kg,2) .'</span></th>';
			$content .= '</tr>';
			$content .= '</tfoot>';
			$content .= '</table>';
			
			$content .= '</div>';

			$content .= '</div>';

			$content .= '<div class="row mt-2">';
			$content .= '<div class="col-12">';

			$content .= '<h5>Retur / Susut</h5>';

			$content .= '<table class="table table-striped table-bordered table-sm" id="table-return" style="width: 100%;">';
			$content .= '<thead>';
			$content .= '<tr>';
			$content .= '<th class="text-center align-middle" rowspan="2" style="width: 5%;">No.</th>';
			$content .= '<th class="text-center align-middle" rowspan="2" style="width: 35%;">Produk</th>';
			$content .= '<th class="text-center align-middle" colspan="2">Susut</th>';
			$content .= '<th class="text-center align-middle" colspan="2">Retur</th>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th class="text-center align-middle">Pcs</th>';
			$content .= '<th class="text-center align-middle">Kg</th>';
			$content .= '<th class="text-center align-middle">Pcs</th>';
			$content .= '<th class="text-center align-middle">Kg</th>';
			$content .= '</tr>';
			$content .= '</thead>';
			$content .= '<tbody>';
		
			
			$st_pcs = 0;
			$st_kg = 0;
			$ret_pcs = 0;
			$ret_kg = 0;
			
			
			if(count($data['retur_sc']) == 0){
				$content .= '<tr id="row-empty-do">';
				$content .= '<td colspan="9" class="text-center">Daftar barang kosong</td>';
				$content .= '</tr>';
			}else{
			
				foreach ($data['retur_sc'] as $key => $value) {
					$content .= '<tr>';
					$content .= '<td>'. ($key+1) .'</td>';
					$content .= '<td>';
					$content .= $value[FIELD_ITEM_NAME];
					
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .= num_separator($value[FIELD_SCR_SUSUT_PCS]); $st_pcs = $st_pcs+$value[FIELD_SCR_SUSUT_PCS];
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .= num_separator($value[FIELD_SCR_SUSUT_KG]); $st_kg = $st_kg+$value[FIELD_SCR_SUSUT_KG];
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .= num_separator($value[FIELD_SCR_RETUR_PCS]); $ret_pcs = $ret_pcs+$value[FIELD_SCR_RETUR_PCS];
					$content .= '</td>';
					$content .= '<td class="text-right">';
					$content .= num_separator($value[FIELD_SCR_RETUR_KG]); $st_kg = $st_kg+$value[FIELD_SCR_RETUR_KG];
					$content .= '</td>';
					$content .= '</tr>';
				}
			
			}
			$content .= '</tbody>';
			$content .= '<tfoot>';
			$content .= '<tr>';
			$content .= '<th colspan="2">Total</th> ';
			$content .= '<th class="text-right"><span id="total-susut-pcs">'. num_separator($st_pcs) .'</span></th>';
			$content .= '<th class="text-right"><span id="total-susut-kg">'. num_separator($st_kg,2) .'</span></th>';
			$content .= '<th class="text-right"><span id="total-retur-pcs">'. num_separator($ret_pcs) .'</span></th>';
			$content .= '<th class="text-right"><span id="total-retur-kg">'. num_separator($ret_pcs,2) .'</span></th>';
			$content .= '</tr>';
			$content .= '</tfoot>';
			$content .= '</table>';

			$content .= '</div>';
			$content .= '</div>';

			$content .= '</div>';
			$content .= '<div class="timeline-footer">';
			$content .= '<hr class="mb-2">';
			$content .= '<p class="text-muted mt-0 mb-0">Created by '. $data['master_sc'][F_USER_FULLNAME] .' at '. date('d M Y | H:i', strtotime($data['master_sc'][FIELD_CREATE_DATETIME])) .'</p>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';

			return $content;
		}
	}

	if(!function_exists('timelineItemINV')){
		function timelineItemINV($data){

			$detail_link = $data['master_inv'][FIELD_INVM_PLANT]."-".$data['master_inv'][FIELD_INVM_FISCAL_YEAR]."-".$data['master_inv'][FIELD_INVM_ID];

			$content = '';

			$content .= '<div>';
			$content .= '<i class="fas fa-file-invoice bg-maroon"></i>';
			$content .= '<div class="timeline-item">';
			$content .= '<span class="time"><i class="fas fa-clock"></i> '. date('H:i', strtotime($data['master_inv'][FIELD_CREATE_DATETIME])) .'</span>';
			$content .= '<h3 class="timeline-header"><strong>Invoice -</strong> <a href="'.base_url('invoice/view/'.$detail_link).'">'. $data['master_inv'][FIELD_INVM_NO] .'</a></h3>';
			$content .= '<div class="timeline-body">';

			$content .= '<div class="row">';
			$content .= '<div class="col-12 col-md-12">';
			$content .= '<table class="table table-sm table-striped">';
			$content .= '<tbody>';
			$content .= '<tr>';
			$content .= '<th style="width:180px;">Customer</th>';
			$content .= '<td>: '. $data['master_inv'][FIELD_PARTNER_NAME].'</td>';
			$content .= '</tr>';
			$content .= '</table>';
			$content .= '</div>';
			$content .= '</div>';

			$content .= '<div class="row">';
			$content .= '<div class="col-12">';

			$content .= '<table class="table table-bordered table-sm" style="font-size: 10pt;">';
			$content .= '<thead>';
			$content .= '<tr>';
			$content .= '<th class="text-center" style="width: 20px;">No.</th>';
			$content .= '<th class="text-center">Nama Barang</th>';
			$content .= '<th class="text-center">Jatuh Tempo</th>';
			$content .= '<th class="text-center">Pcs</th>';
			$content .= '<th class="text-center">Kg</th>';
			$content .= '<th class="text-center" style="width:50px;">Pengali Harga</th>';
			$content .= '<th class="text-center">Harga</th>';
			$content .= '<th class="text-center" style="width: 6rem;">Jumlah</th>';
			$content .= '';
			$content .= '</tr>';
			$content .= '</thead>';
			$content .= '<tbody>';

			$total_pcs_do = 0;
			$total_kg_do = 0;
		

			foreach ($data['detail_inv'] as $key => $value) {
				$content .= '<tr>';
				$content .= '<td>'. ($key+1) .'</td>';
				$content .= '<td>'. $value[FIELD_ITEM_NAME].'</td>';
				$content .= '<td class="text-center">';

				if($data['master_inv']['term_length'] > 0){
					$content .=  date('d-m-y', strtotime($data['master_do']['sj_generated_at']." + ". $data['master_inv']['term_length'] ." Days"));
				}else{
					$content .= date('d-m-y', strtotime($data['master_do']['sj_generated_at']));
				}
				$content .= '</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_INVD_QTY_PCS],0,'.',','); ($total_pcs_do = $total_pcs_do + $value[FIELD_INVD_QTY_PCS]).'</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_INVD_QTY_KG],2,'.',','); ($total_kg_do = $total_kg_do + $value[FIELD_INVD_QTY_KG]).'</td>';
				$content .= '<td class="text-center">'. ucfirst($value[FIELD_INVD_PRICE_BY]).'</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_INVD_UNIT_PRICE],0,'.',',').'</td>';
				$content .= '<td class="text-right">'. number_format($value[FIELD_INVD_TOTAL_AMT],0,'.',',').'</td>';
				$content .= '';
				$content .= '</tr>';
			}
			$content .= '</tbody>';

			$content .= '<tfoot>';
			$content .= '<tr>';
			$content .= '<th></th>';
			$content .= '<th colspan="4">';
			$content .= '<center>Total</center>';
			$content .= '</th>';
			$content .= '<th class="text-right">';
			$content .= number_format($total_pcs_do,0,'.',',');
			$content .= '</th>';
			$content .= '<th class="text-right">';
			$content .= number_format($total_kg_do,2,'.',',');
			$content .= '</th>';
			$content .= '<th colspan="3"></th>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th colspan="7" ><strong>TOTAL</strong></th>';
			$content .= '<th class="dt-nowrap">Rp. <span class="float-right">'. number_format($data['master_inv'][FIELD_INVM_TOTAL_AMT],0,'.',',').'</span></th>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th colspan="7"><strong>DP</strong></th>';
			$content .= '<th>Rp. <span class="float-right">'. number_format($data['master_inv'][FIELD_INVM_DP],0,'.',',').'</span></th>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th colspan="7"><strong>TOTAL Invoice</strong></th>';
			$content .= '<th>Rp. <span class="float-right">'. number_format($data['master_inv'][FIELD_INVM_GRAND_TOTAL],0,'.',',').'</span></th>';
			$content .= '</tr>';
			$content .= '<tr>';
			$content .= '<th colspan="8">';
			$content .= 'Terbilang : <strong>'.ucwords(number_to_words($data['master_inv'][FIELD_INVM_GRAND_TOTAL])).' Rupiah</strong>';
			$content .= '</th>';
			$content .= '</tr>';
			$content .= '';
			$content .= '</tfoot>';
			$content .= '</table>';
			
			$content .= '</div>';

			$content .= '</div>';

			

			$content .= '</div>';
			$content .= '<div class="timeline-footer">';
			$content .= '<hr class="mb-2">';
			$content .= '<p class="text-muted mt-0 mb-0">Created by '. $data['master_inv'][F_USER_FULLNAME] .' at '. date('d M Y | H:i', strtotime($data['master_inv'][FIELD_CREATE_DATETIME])) .'</p>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';

			return $content;
		}
	}

	if(!function_exists('timelineItemEnd')){
		function timelineItemEnd(){

			$content = '';

			$content .= '<div>';
			$content .= '<i class="fas fa-check-circle bg-green"></i>';
			$content .= '</div>';

			return $content;
		}
	}
}