<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function jquery_select2(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/select2/select2.min.css').'" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/select2/select2.full.min.js').'"></script>'."\n";
}

function jquery_datepicker(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/datepicker/datepicker3.css').'" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/datepicker/bootstrap-datepicker.js').'"></script>'."\n";
}

function autocomplete(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/autocomplete/jquery-ui.css').'" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/autocomplete/jquery-ui.js').'"></script>'."\n";
}

function highcharts(){
	return
		'<script type="text/javascript" src="'.base_url('/assets/plugins/highcharts/highcharts.js').'"></script>'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/highcharts/data.js').'"></script>'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/highcharts/drilldown.js').'"></script>'."\n";
}

/* End of file js_plugins_helper.php */
/* Location: ./application/helpers/js_plugins_helper.php */