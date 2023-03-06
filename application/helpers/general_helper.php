<?php defined('BASEPATH') OR exit('No direct script access allowed');

 function bulan($bulan=0){

	if(!is_numeric($bulan)) return '';

	if($bulan > 12) return '';

	if($bulan < 1) return '';

	$val_bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

	return $val_bulan[$bulan];

}

 function hari($hari=0){

	if(!is_numeric($hari)) return '';

	if($hari > 7) return '';

	if($hari < 1) return '';

	$val_hari = array(1=>'Senin', 'Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');

	return $val_hari[$hari];
}

function profile_p(){
	$CI =& get_instance();
	$CI->load->database(); 
	$ses = $CI->session->userdata(SESSION_USER);

	$CI->db->where(F_USER_ID, $ses[SESSION_USER_ID]);
	$dt = $CI->db->get(TABLE_USER)->row_array();

	return $dt[F_USER_IMAGE];
}


if (!function_exists('get_session')){
	function get_session(){
		$CI=& get_instance();
		return $CI->session->userdata(SESSION_USER);
	}
}

if (!function_exists('bulan')){
	function bulan($bulan=0){

		if(!is_numeric($bulan)) return '';

		if($bulan > 12) return '';

		if($bulan < 1) return '';

		$val_bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

		return $val_bulan[$bulan];

	}
}


if (!function_exists('hari')){
	function hari($hari=0){

		if(!is_numeric($hari)) return '';

		if($hari > 7) return '';

		if($hari < 1) return '';

		$val_hari = array(1=>'Senin', 'Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');

		return $val_hari[$hari];
	}
}

if(!function_exists('bulan_romawi')){
	function bulan_romawi($bulan = 0){

		if(!is_numeric($bulan)) return '';

		if($bulan < 1 || $bulan > 12) return '';

		$val_romawi = array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');

		return $val_romawi[(int)$bulan];

	}
}

if(!function_exists('validateDate')){
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

}

if(!function_exists('sortDate')){
	function sortDate( $a, $b ) {
	    return strtotime($a) - strtotime($b);
	}
}

if(!function_exists('print_month')){
	function print_month(){
		$val_bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

		return $val_bulan;
	}
}

if(!function_exists('calculate_fase_by_wop')){
	function calculate_fase_by_wop($min_laying, $age){
		$week_l = 0;
		$fase = 'G';
		if($min_laying > 0){
			if($age['week'] >= $min_laying){
				$week_l = ($age['week'] - $min_laying) + 1;
			}
			$fase = ($age['week'] >= $min_laying ? 'L' : 'G');
		}

		return array('week_l'=> $week_l, 'fase'=>$fase);
	}
}

if(!function_exists('calculate_fase_by_production_date')){
	function calculate_fase_by_production_date($production_date){
		$today = date('Y-m-d');

		if($production_date != null && $production_date != "null" && $production_date != "" && $production_date != "0000-00-00"){
			$production_date = date('Y-m-d', strtotime($production_date));
			if($today >= $production_date){
				return 'L';
			}
		}

		return 'G';
	}
}

if(!function_exists('remove_comma')){
	function remove_comma($number){

		$num = str_replace(',',"",$number);

		if($num == 0 || $num == "" || $num == null){
			return 0;
		}

		if(!is_numeric($num)){
			return 0;
		}

		return $num;
	}
}

if(!function_exists('calculate_real_age')){
	function calculate_real_age($age = null, $start_age = null){

		if($start_age > 1){
			$age = $age - 1;
			return $age+$start_age;
		}

		$start_age = 0;
		return $age+$start_age; 

	}
}

if(!function_exists('num_separator')){
	function num_separator($num, $dec = 0){
		if(!is_numeric($num)){
			return "";
		}
		return number_format($num,$dec,'.',',');
	}
}

if ( ! function_exists('number_to_words'))
{
	function number_to_words($number)
	{

		if($number == 0){
			return "Nol";
		}

		$before_comma = trim(to_word($number));
		$after_comma = trim(comma($number));
		return ucwords($results = $before_comma);
		// return ucwords($results = $before_comma.' koma '.$after_comma);
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		

		if($number<12)
		{
			$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = to_word($number/10)." puluh ".to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".to_word($number-100);
		}
		else if($number<1000)
		{
			$words = to_word($number/100)." ratus ".to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = to_word($number/1000)." ribu ".to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = to_word($number/1000000)." juta ".to_word($number%1000000);
		}
		else if($number<1000000000000)
		{
			$words = to_word($number/1000000000)." Miliar ".to_word($number%1000000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}

	if(!function_exists('getUserHelper')){
		function getUserHelper($id){
			$ci =& get_instance();
			$ci->load->database();
			
			$ci->db->select(array(
				F_USER_FULLNAME,	
			));
			$ci->db->from(TABLE_USER);
			$ci->db->where(F_USER_ID, $id);
			$ci->db->limit(1);
			return $ci->db->get()->row_array();
		}
	}

	if(!function_exists('is_assoc')){
		function is_assoc(array $arr)
		{
		    if (array() === $arr) return false;
		    return array_keys($arr) !== range(0, count($arr) - 1);
		}
	}

	if(!function_exists('rand_color')){
		function rand_color() {
		    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
		}
	}
}