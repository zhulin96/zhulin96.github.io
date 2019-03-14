<?php



$a1=file_get_contents("../process/form1/form1.txt");
$conn_string  ="host=120.25.253.38 port=5432 dbname=CityData user=team password=maet" ; 
$dbconn = pg_connect($conn_string);
$query = 'SELECT * FROM public.weibo_'.$a1.'_dbscan';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

$query3 = 'SELECT * FROM public.weibo_'.$a1.'_week_net';
$result3 = pg_query($query3) or die('Query failed: ' . pg_last_error());

 for($zl=0;$zl<max($b3);$zl++)
	   {
		   for($zl1=0;$zl1<max($b3);$zl1++)
		     {
				 for($zl2=0;$zl2<7;$zl2++)
				 {
					 $bt[$zl][$zl1][$zl2]=0;
				 }
				 
			 }
		   
	   }

    pg_free_result($result);
 pg_free_result($result3);	






?>