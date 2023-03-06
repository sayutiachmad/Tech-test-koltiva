<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	// public function get_sum_population($where = null){		
		
	// 	$p_date = date('Y-m-d');
	// 	// $p_date = '2019-04-03';
	// 	return $this->db->query("SELECT fn_sum_ps_population('".$p_date."','F') AS sum_female_pop ,
	// 									fn_sum_ps_population('".$p_date."','M')	AS sum_male_pop ")->result_array();
	// }	

	public function get_sum_population(){	
		
		$p_date = date('Y-m-d');
		// $p_date = '2019-04-03';
		$CI =& get_instance();
		$query = $this->db->query("CALL sp_prd_dashboard_1()");
		mysqli_next_result( $CI->db->conn_id );
		$result = $query->row_array();
		$query->free_result();
		return $result;
		// ->row_array();
	}	

	public function get_ps_grower($where){
		return $this->db->query("CALL sp_inv_dash_mib_ps_grow(
			'".$where['company_']."',
			'".$where['plant_']."',
			'".$where['fiscal_year_']."',
			'".$where['period_']."')")->result_array();
	}	

	public function get_telur_HD_daily($start_date, $end_date){
	// public function get_telur_HD_daily($company,$plant,$start_date,$end_date){	
		$company = '3020';
		$plant = '4201';
		// $start_date = '2020-06-01' ;
		// $end_date = '2020-06-30' ;

		$this->db->select(array(
			'DATE_FORMAT('.FIELD_TELUR_DATE.',"%d-%b-%y") AS Production_Date',
			'SUM('.FIELD_TELUR_HD.') as HD_Qty',

		));

		$this->db->from(TABLE_TELUR.' a');
		$this->db->where(FIELD_TELUR_COMPANY, $company);
		$this->db->where(FIELD_TELUR_PLANT, $plant);
		$this->db->where('Production_Date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$this->db->group_by('a.'.FIELD_TELUR_DATE);
		$this->db->order_by('a.'.FIELD_TELUR_DATE);
		
		return $this->db->get()->result_array();
		// $this->db->get();
		// echo $this->db->last_query();
	}

	public function get_telur_HD_weekly($start_date, $end_date){
	// public function get_telur_HD_daily($company,$plant,$start_date,$end_date){	
		$company = '3020';
		$plant = '4201';
		// $start_date = '2020-06-01' ;
		// $end_date = '2020-06-30' ;

		$this->db->select(array(
			'DATE_FORMAT('.FIELD_TELUR_DATE.',"%d-%b-%y") AS Production_Date',
			'SUM('.FIELD_TELUR_HD.') as HD_Qty',

		));

		$this->db->from(TABLE_TELUR.' a');
		$this->db->where(FIELD_TELUR_COMPANY, $company);
		$this->db->where(FIELD_TELUR_PLANT, $plant);
		$this->db->where('Production_Date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		// $this->db->group_by('WEEK(a.'.FIELD_TELUR_DATE.')');

		$this->db->group_by('FROM_DAYS(TO_DAYS('.FIELD_TELUR_DATE.') -MOD(TO_DAYS('.FIELD_TELUR_DATE.') -1, 7))');

		$this->db->order_by('FROM_DAYS(TO_DAYS('.FIELD_TELUR_DATE.') -MOD(TO_DAYS('.FIELD_TELUR_DATE.') -1, 7))');
		
		return $this->db->get()->result_array();
		// $this->db->get();
		// echo $this->db->last_query();
	}

	public function get_telur_HD_monthly($start_date, $end_date){
	// public function get_telur_HD_daily($company,$plant,$start_date,$end_date){	
		$company = '3020';
		$plant = '4201';
		// $start_date = '2020-06-01' ;
		// $end_date = '2020-06-30' ;

		$this->db->select(array(
			'DATE_FORMAT('.FIELD_TELUR_DATE.',"%d-%b-%y") AS Production_Date',
			'SUM('.FIELD_TELUR_HD.') as HD_Qty',

		));

		$this->db->from(TABLE_TELUR.' a');
		$this->db->where(FIELD_TELUR_COMPANY, $company);
		$this->db->where(FIELD_TELUR_PLANT, $plant);
		$this->db->where('Production_Date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$this->db->group_by('MONTH(a.'.FIELD_TELUR_DATE.')');
		$this->db->order_by('MONTH(a.'.FIELD_TELUR_DATE.')');
		
		return $this->db->get()->result_array();
		// $this->db->get();
		// echo $this->db->last_query();
	}

	public function get_telur_HD_yearly($start_date, $end_date){
	// public function get_telur_HD_daily($company,$plant,$start_date,$end_date){	
		$company = '3020';
		$plant = '4201';
		// $start_date = '2020-06-01' ;
		// $end_date = '2020-06-30' ;

		$this->db->select(array(
			'DATE_FORMAT('.FIELD_TELUR_DATE.',"%d-%b-%y") AS Production_Date',
			'SUM('.FIELD_TELUR_HD.') as HD_Qty',

		));

		$this->db->from(TABLE_TELUR.' a');
		$this->db->where(FIELD_TELUR_COMPANY, $company);
		$this->db->where(FIELD_TELUR_PLANT, $plant);
		$this->db->where('Production_Date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$this->db->group_by('YEAR(a.'.FIELD_TELUR_DATE.')');
		$this->db->order_by('YEAR(a.'.FIELD_TELUR_DATE.')');
		
		return $this->db->get()->result_array();
		// $this->db->get();
		// echo $this->db->last_query();
	}
    
    public function get_henday_production($start_date, $end_date){

    	$year = date('Y', strtotime($end_date));

    	return $this->db->query('
    			SELECT DATE(production_date) AS production_date,
    			       CONCAT(year(production_date),  WEEK(production_date)) AS wekk,
    			        (sum(HD) / fn_sum_ps_population((production_date - INTERVAL 1 DAY),"F")/7 * 100 )AS HDP
    			FROM egg_production
    			GROUP BY year(production_date),WEEK(production_date)
    			ORDER BY year(production_date),WEEK(production_date)

    		')->result_array();
    }
}

