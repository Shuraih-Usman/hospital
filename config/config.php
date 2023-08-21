<?php
 ob_start();
 session_start();
 
define('database','hospital');
define('db_user','root');
define('db_pass','');
define('host','localhost');

$db = mysqli_connect(host,db_user,db_pass,database);

if(!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


function to_time_ago( $time ) {
      
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff = time() - $time;
      
    if( $diff < 1 ) { 
        return 'less than 1 second ago'; 
    }
      
    $time_rules = array ( 
                12 * 30 * 24 * 60 * 60 => 'year',
                30 * 24 * 60 * 60       => 'month',
                24 * 60 * 60           => 'day',
                60 * 60                   => 'hour',
                60                       => 'minute',
                1                       => 'second'
    );
  
    foreach( $time_rules as $secs => $str ) {
          
        $div = $diff / $secs;
  
        if( $div >= 1 ) {
              
            $t = round( $div );
              
            return $t . ' ' . $str . 
                ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
