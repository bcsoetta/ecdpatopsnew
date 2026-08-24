<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  if( !function_exists('menu') ) {
    
    function get_menu( $menu = 'TEST!!!' ) {
      echo  $menu;
    }
    
  }

  function array_date($start, $end)
    {
       $range = array();    
       if (is_string($start) === true) $start = strtotime($start);
       if (is_string($end) === true ) $end = strtotime($end);      
       if ($start > $end) return array_date($end, $start);     
       do {
          $range[] = date('Y-m-d', $start);
          $start = strtotime("+ 1 day", $start);
       }
       while($start <= $end);      
       return $range;
    }

?> 