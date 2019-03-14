<?php

    $a=$_POST['checkbox'];
	$b=$_POST['tname'];
	$i=1;$arr=$a[0];$k=0;
	while($a[$i])
	{
		 if($b==$a[$i])
		 {
			  $k++;
		 }
		  $arr=$arr.','.$a[$i];
		  $i++;
    }
	if($k==0)
	{
		$arr=$b.','.$arr;
		
   }
	
	
	
	file_put_contents("../process/file/netform.csv",$arr);
	
 
	
     file_put_contents("../process/file/netbegin.txt",$b);



?>