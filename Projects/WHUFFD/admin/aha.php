<?php

   $a1=file_get_contents("../process/form1/form1.txt");
	$conn_string  ="host=120.25.253.38 port=5432 dbname=CityData user=team password=maet" ; 
    $dbconn = pg_connect($conn_string);
    $query = 'SELECT * FROM public.weibo_'.$a1.'_dbscan';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $query1 = 'SELECT * FROM public.weibo_'.$a1.'_net';
    $result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());
	$query2 = 'SELECT * FROM public.weibo_'.$a1.'_roads';
    $result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
	$query3 = 'SELECT * FROM public.weibo_'.$a1.'_week_net';
    $result3 = pg_query($query3) or die('Query failed: ' . pg_last_error());
	$query4 = 'SELECT * FROM public.weibo_'.$a1.'_authority';
    $result4 = pg_query($query4) or die('Query failed: ' . pg_last_error());
	$query5 = 'SELECT * FROM public.weibo_'.$a1.'_week_region';
    $result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
	$i=0;
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
   
			   $b1[$i]=$line["longitude"];
			   $b2[$i]=$line["latitude"];                    //
			   $b3[$i]=(int)$line["regionid"];               //area
			   $b4[$i]=$line["checkin_time"];                //time
               $b5[$i]=$line["categoryid"];                  //categoyid 
			   $i++;
    }
	while ($line4 = pg_fetch_array($result4, null, PGSQL_ASSOC)) {
	     $auth[(int)$line4["regionid"]-1]=$line4["authority"];
	}
	
	
	 for($r1=0;$r1<max($b3);$r1++)
	   {
		   $ark[$r1]=1;
		     for($r2=0;$r2<max($b3);$r2++)
			   {
				   if($auth[$r1]<$auth[$r2])
				      $ark[$r1]++;
				      
			   }
		   
	   }  
	 

	
	
	
	$net=NULL;
	
    while ($line1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {   //save net 
                      $net=$net.$line1["regionid"];
		for($ne = 1; $ne < count($line1)-1; $ne++)  
					   {
						   $net=$net.",".$line1[$ne];
					   } 
					   
					  $net=$net."\r\n";
    }
	file_put_contents("../process/file/net.csv",$net);    
  
	     
	
	
   $ry=0;$re=0;$rs=0;$load[0]="";$load[1]=""; $load[2]="";
   while ($line2 = pg_fetch_array($result2, null, PGSQL_ASSOC)) {     //read out three roads
          
						   
			if($line2["V1"]!=NULL){
				$load[0]=$load[0]." ".$line2["V3"];
							
				}
  
		    if($line2["V2"]!=NULL){
			    $load[1]=$load[1]." ".$line2["V2"];
				}
			 if($line2["V3"]!=NULL){
				$load[2]=$load[2]." ".$line2["V1"];
			   }
			
	 }
	  
	$loa=$load[0]."@".$load[1]."@".$load[2];
	file_put_contents("../process/file/load.txt",$loa);
	
	
	                                        
 
      $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;	
	  
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
	  
	  
	  
	  
	  
    while ($line3 = pg_fetch_array($result3, null, PGSQL_ASSOC)) {     //read out week_net
	
	    
		 $bt[$line3["start"]-1][$line3["end"]-1][$line3["day"]]=(int)$line3["count"];
	  
	
		  if($line3["day"]==0)
		     {
			     $start1[$t1]=$line3["start"];
				 $end1[$t1]=$line3["end"]; 
				 $count1[$t1]=$line3["count"];
				 $t1++;
			 }
			 
			 
			 
		 if($line3["day"]==1)
		     {
			     $start2[$t2]=$line3["start"];
				 $end2[$t2]=$line3["end"]; 
				 $count2[$t2]=$line3["count"];
				 $t2++;
			 }
			 
	    if($line3["day"]==2)
		     {
			     $start3[$t3]=$line3["start"];
				 $end3[$t3]=$line3["end"]; 
				 $count3[$t3]=$line3["count"];
				 $t3++;
			 }
			 
	    if($line3["day"]==3)
		     {
			     $start4[$t4]=$line3["start"];
				 $end4[$t4]=$line3["end"]; 
				 $count4[$t4]=$line3["count"];
				 $t4++;
			 }
			 
		if($line3["day"]==4)
		     {
			     $start5[$t5]=$line3["start"];
				 $end5[$t5]=$line3["end"]; 
				 $count5[$t5]=$line3["count"];
				 $t5++;
			 }
			 	 
	   if($line3["day"]==5)
		     {
			     $start6[$t6]=$line3["start"];
				 $end6[$t6]=$line3["end"]; 
				 $count6[$t6]=$line3["count"];
				 $t6++;
			 }
			 	 		 
	  if($line3["day"]==6)
		     {
			     $start7[$t7]=$line3["start"];
				 $end7[$t7]=$line3["end"]; 
				 $count7[$t7]=$line3["count"];
				 $t7++;
			 }
			 	 
			 	 
    }
	 $wr=0;
    
	 for($zl=0;$zl<max($b3);$zl++)
	   {
		   for($zl1=0;$zl1<max($b3);$zl1++)
		     {
				 
				  $x="区域".($zl+1)."-区域".($zl1+1);
				  if(max($bt[$zl][$zl1])>0){
				  for($k=0;$k<7;$k++)
				   {
					   
					     $y[$k]=array(($k+1),$bt[$zl][$zl1][$k]);
					   
				   }
				   
				   $zs[$wr]=array("key"=>$x,"value"=>json_encode($y));
				  
				   $wr++;
				  }
			}
			
			
			
		}
  
 $txt="["."\r\n";       
for($ac=0;$ac<$wr-1;$ac++)
{
	$txt=$txt."{"."\r\n".'"'."key".'":'.'"'.$zs[$ac]["key"].'"'.","."\r\n".'"'."values".'":'.$zs[$ac]["value"]."\r\n"."},"."\r\n";
	
}	   

$txt=$txt."{"."\r\n".'"'."key".'":'.'"'.$zs[$wr-1]["key"].'"'.","."\r\n".'"'."values".'":'.$zs[$wr-1]["value"]."\r\n"."}"."\r\n"."]";

 
 
file_put_contents("../process/file/arr.json",$txt);
	  
	
	
	
	
	
	
	
	
	for($k1=0;$k1<$t1;$k1++)
	 {
		 $coun[0][$k1]=0;
		 for($k2=0;$k2<$t1;$k2++)
	   { 
		   if($count1[$k1]<$count1[$k2])
		     $coun[0][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t1;$k1++)
   {
	   if( $coun[0][$k1]==0)
	     $f8[0]=$k1;
		 
	  if($coun[0][$k1]==1)
	     $f9[0]=$k1; 	    
   }
   
   if($f9[0]==NULL)
   {
	   for($k1=0;$k1<$t1;$k1++)
    {
		 if( $coun[0][$k1]==0&&$k1!=$f8[0])
		  {
			  $f9[0]=$k1;
		  }
    }
   
 }
    
   $str=$start1[$f8[0]]." ".$end1[$f8[0]]." ".$count1[$f8[0]].",".$start1[$f9[0]]." ".$end1[$f9[0]]." ".$count1[$f9[0]];
   
 	for($k1=0;$k1<$t2;$k1++)
	 {
		 $coun[1][$k1]=0;
		 for($k2=0;$k2<$t2;$k2++)
	   { 
		   if($count2[$k1]<$count2[$k2])
		     $coun[1][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t2;$k1++)
   {
	   if( $coun[1][$k1]==0)
	     $f8[1]=$k1;
		 
	  if($coun[1][$k1]==1)
	     $f9[1]=$k1; 	    
   }
   
   if($f9[1]==NULL)
   {
	   for($k1=0;$k1<$t2;$k1++)
    {
		 if( $coun[1][$k1]==0&&$k1!=$f8[1])
		  {
			  $f9[1]=$k1;
		  }
    }
   
 }
   
   $str=$str."@".$start2[$f8[1]]." ".$end2[$f8[1]]." ".$count2[$f8[1]].",".$start2[$f9[1]]." ".$end2[$f9[1]]." ".$count2[$f9[1]];  
 	for($k1=0;$k1<$t3;$k1++)
	 {
		 $coun[2][$k1]=0;
		 for($k2=0;$k2<$t3;$k2++)
	   { 
		   if($count3[$k1]<$count3[$k2])
		     $coun[2][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t3;$k1++)
   {
	   if( $coun[2][$k1]==0)
	     $f8[2]=$k1;
		 
	  if($coun[2][$k1]==1)
	     $f9[2]=$k1; 	    
   }
   
   if($f9[2]==NULL)
   {
	   for($k1=0;$k1<$t3;$k1++)
    {
		 if( $coun[2][$k1]==0&&$k1!=$f8[2])
		  {
			  $f9[2]=$k1;
		  }
    }
   
 }
    
   $str=$str."@".$start3[$f8[2]]." ".$end3[$f8[2]]." ".$count3[$f8[2]].",".$start3[$f9[2]]." ".$end3[$f9[2]]." ".$count3[$f9[2]];
   
 	for($k1=0;$k1<$t4;$k1++)
	 {
		 $coun[3][$k1]=0;
		 for($k2=0;$k2<$t4;$k2++)
	   { 
		   if($count4[$k1]<$count4[$k2])
		     $coun[3][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t4;$k1++)
   {
	   if( $coun[3][$k1]==0)
	     $f8[3]=$k1;
		 
	  if($coun[3][$k1]==1)
	     $f9[3]=$k1; 	    
   }
   
   if($f9[3]==NULL)
   {
	   for($k1=0;$k1<$t4;$k1++)
    {
		 if( $coun[3][$k1]==0&&$k1!=$f8[3])
		  {
			  $f9[3]=$k1;
		  }
    }
   
 }
    
   $str=$str."@".$start4[$f8[3]]." ".$end4[$f8[3]]." ".$count4[$f8[3]].",".$start4[$f9[3]]." ".$end4[$f9[3]]." ".$count4[$f9[3]];  
   
   
    
 	for($k1=0;$k1<$t5;$k1++)
	 {
		 $coun[4][$k1]=0;
		 for($k2=0;$k2<$t5;$k2++)
	   { 
		   if($count5[$k1]<$count5[$k2])
		     $coun[4][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t5;$k1++)
   {
	   if( $coun[4][$k1]==0)
	     $f8[4]=$k1;
		 
	  if($coun[4][$k1]==1)
	     $f9[4]=$k1; 	    
   }
   
   if($f9[4]==NULL)
   {
	   for($k1=0;$k1<$t5;$k1++)
    {
		 if( $coun[4][$k1]==0&&$k1!=$f8[4])
		  {
			  $f9[4]=$k1;
		  }
    }
   
 }
    
   $str=$str."@".$start5[$f8[4]]." ".$end5[$f8[4]]." ".$count5[$f8[4]].",".$start5[$f9[4]]." ".$end5[$f9[4]]." ".$count5[$f9[4]];  
   
 
    
 	for($k1=0;$k1<$t6;$k1++)
	 {
		 $coun[5][$k1]=0;
		 for($k2=0;$k2<$t6;$k2++)
	   { 
		   if($count6[$k1]<$count6[$k2])
		     $coun[5][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t6;$k1++)
   {
	   if( $coun[5][$k1]==0)
	     $f8[5]=$k1;
		 
	  if($coun[5][$k1]==1)
	     $f9[5]=$k1; 	    
   }
   
   if($f9[5]==NULL)
   {
	   for($k1=0;$k1<$t6;$k1++)
    {
		 if( $coun[5][$k1]==0&&$k1!=$f8[5])
		  {
			  $f9[5]=$k1;
		  }
    }
   
 }
    
   $str=$str."@".$start6[$f8[5]]." ".$end6[$f8[5]]." ".$count6[$f8[5]].",".$start6[$f9[5]]." ".$end6[$f9[5]]." ".$count6[$f9[5]];  
   
      
 	for($k1=0;$k1<$t7;$k1++)
	 {
		 $coun[6][$k1]=0;
		 for($k2=0;$k2<$t7;$k2++)
	   { 
		   if($count7[$k1]<$count7[$k2])
		     $coun[6][$k1]++;
	   } 
    }
   for($k1=0;$k1<$t7;$k1++)
   {
	   if( $coun[6][$k1]==0)
	     $f8[6]=$k1;
		 
	  if($coun[6][$k1]==1)
	     $f9[6]=$k1; 	    
   }
   
   if($f9[6]==NULL)
   {
	   for($k1=0;$k1<$t7;$k1++)
    {
		 if( $coun[6][$k1]==0&&$k1!=$f8[6])
		  {
			  $f9[6]=$k1;
		  }
    }
   
 }
    
   $str=$str."@".$start7[$f8[6]]." ".$end7[$f8[6]]." ".$count7[$f8[6]].",".$start7[$f9[6]]." ".$end7[$f9[6]]." ".$count7[$f9[6]];  
   
   
   
   
   file_put_contents("../process/file/ptop.txt",$str);   
	
	
	
	
	
	
	//count the area number 
	//所有区域 起始下标为零
   //时段和星期联合表    
   
for($c4=0;$c4<max($b3);$c4++)   {                         
for($c1=0;$c1<24;$c1++)  
{
   for($c2=0;$c2<7;$c2++)         
   {
	    $area[$c4][$c1][$c2]=0;   
   }
}
}
for($d=0;$d<$i;$d++)
{
	$e1=spliti(" ",$b4[$d]);
	$e2=spliti("-",$e1[0]);
	$e3=spliti(":",$e1[1]);
	$e4=mktime(1,1,1,$e2[1],$e2[2],(int)$e2[0]);
    $e5= date("w",$e4);
	if($e3[0][0]==0)
	  $e3[0]=$e3[0][1];
	 $e3[0]=(int)$e3[0];
    $area[$b3[$d]-1][$e3[0]][$e5]++;
	  
}	

for($c4=0;$c4<max($b3);$c4++)   { 

 $file_week="day"."\t".'hour'."\t".'value';
 for($c2=0;$c2<7;$c2++)         
   {
	    for($c1=0;$c1<24;$c1++)  
      {   		   		   		   		   		   		      
          $file_week=$file_week."\r\n".($c2+1)."\t".($c1+1)."\t".$area[$c4][$c1][$c2];
      }   
   }
		
	file_put_contents("../process/file/data".($c4+1)."tsv",$file_week);
	
}
	

//找出每个区域对应的 categories 的比例分布

for($f=0;$f<max($b3);$f++)
  {
	  for($f1=0;$f1<15;$f1++)
	  {
	      $cate[$f][$f1]=0;
		  
		  $cate1[$f][$f1]=0;
	  }
  }

for($f2=0;$f2<$i;$f2++)
{
    $cate[$b3[$f2]-1][$b5[$f2]]++;	
	 $cate1[$b5[$f2]][$b3[$f2]-1]++;	
}

   pg_free_result($result);
    pg_free_result($result1);
    pg_free_result($result2);
    pg_free_result($result3);	
	pg_free_result($result4);
	pg_free_result($result5);
	$qy=range(0,max($b3)-1,1);
	print_r($qy);
?>