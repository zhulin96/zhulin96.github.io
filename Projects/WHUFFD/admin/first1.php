<?php

 function copy_only_file($file,$aim_dir){  
   $arr_file=scandir($file) ;
   for($i=2;$i<count($arr_file);$i++)
    {
	  
			 $a=file_get_contents($file.'/'.$arr_file[$i]);
			 file_put_contents("../process/file/".$arr_file[$i],$a) ;
			 
			 
	
    }
} 






if(!file_exists("../process/file/net.csv"))
 {
	    
      $a1=file_get_contents("../process/form1/form1.txt");
	
	 if($a1=="guangdong_0"||$a1=="guangdong_1"||$a1=="guangdong_2"||$a1=="guangdong_3"||$a1=="guangdong_4"||$a1=="all_1"||$a1=="all_2"||$a1=="all_3"||$a1=="all_4")
	
	{
		
		copy_only_file("../resource/file/".$a1,"../process/file");
		
		$j1=file_get_contents("../process/file/trans1.txt");
		$j2=file_get_contents("../process/file/trans2.txt");
		$j3=file_get_contents("../process/file/trans3.txt");
		$j4=file_get_contents("../process/file/trans4.txt");
		$j100=file_get_contents("../process/file/trans100.txt");
		
		$jj1=spliti("@",$j1);
		$jj2=spliti("@",$j2);
		$jj3=spliti("@",$j3);
		$jj4=spliti("@",$j4);
		$jj100=spliti("@",$j100);
		$arr_lon=json_encode($jj1);
		$arr_lat=json_encode($jj2);
		$arr_ark=json_encode($jj3);
		$arr_a100=json_encode($jj100);
		$ar5=json_encode($jj4);
	
	 
	
	}
	
	else
	{
	
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
$zt=0;	   $zz=NULL;
$xcc=array('其他','餐饮','购物','住宿','出行','文体娱乐','金融服务','生活服务','汽车服务','教育','医疗','房产','旅游','企事业单位','行政单位');
for($f=0;$f<max($b3);$f++)
{
    $sum[$f]=0;$e100=0;
    for($f1=0;$f1<15;$f1++)
	  {
		  $sum[$f]=$sum[$f]+$cate[$f][$f1];
	  }
	  for($f1=0;$f1<15;$f1++)
     {

	      $mean[$f][$f1]=($cate[$f][$f1]/$sum[$f]); 
		  
	 }
	 $xcs=$xcc;
	  for($c1=0;$c1<15;$c1++)
	   {
		 for($c2=0;$c2<15;$c2++) 
		 {
			 if($mean[$f][$c1]>$mean[$f][$c2])
			  {
				  $t1=$mean[$f][$c2];
				  $mean[$f][$c2]=$mean[$f][$c1];
				  $mean[$f][$c1]=$t1;
				  $t2=$xcs[$c2];
				  $xcs[$c2]=$xcs[$c1];
				  $xcs[$c1]=$t2;
			  }
		 } 
		   
	 } 
	$tk[$f]="letter"."\t"."frequency";
   for($c1=0;$c1<15;$c1++)
	   {
	      $tk[$f]=$tk[$f]."\r\n".$xcs[$c1]."\t".$mean[$f][$c1];	   
	   }
	   
	   $zc[$zt]=$xcs[0];

	   $zt++;$zz=$zz.",".$xcs[0];
	   
	file_put_contents("../process/file/cate".($f+1).".tsv",$tk[$f]);   
}
 
 file_put_contents("../process/file/tip.txt",$zz);
 $ar5=json_encode($zc);
$text=NULL; 

for($c1=0;$c1<15;$c1++)
 {
	 $qy=range(0,max($b3)-1,1);
      $sun=0;$text=$text.$xcc[$c1].";";
	 for($c2=0;$c2<max($b3);$c2++)
	 {
		 $sun=$sun+$cate1[$c1][$c2]; 
	 }   
	 
	 for($c2=0;$c2<max($b3);$c2++)        //排序
	 {
	   for($c3=0;$c3<max($b3);$c3++)
	   {
	       if($cate1[$c1][$c2]>$cate1[$c1][$c3])
		     {
				 $t1=$cate1[$c1][$c3];
				 $cate1[$c1][$c3]=$cate1[$c1][$c2];
				 $cate1[$c1][$c2]=$t1;
				 $t2=$qy[$c3];
				 $qy[$c3]=$qy[$c2];
				 $qy[$c2]=$t2;
				 
			 }
	  
	   }
	 }
	 
	 
	 for($c2=0;$c2<max($b3);$c2++)
	 {
		 if($sun!=0){
		 $cate1[$c1][$c2]=((int)($cate1[$c1][$c2]*10000/$sun))/10000;
		 }
		 else
		   $cate1[$c1][$c2]=0;
		   
		 $text=$text.",".($qy[$c2]+1)." ".$cate1[$c1][$c2];
	 }
	 $text=$text."@";    	 
    
 }   
  file_put_contents("../process/file/lly.txt",$text);
   $a2=file_get_contents("../process/file/lly.txt");
  $a3=spliti("@",$a2);
  for($c1=0;$c1<15;$c1++)
  {
     $a4[$c1]=spliti(";",$a3[$c1]);
	 $a5[$c1]=$a4[$c1][0];
	 $a6[$c1]=spliti(",",$a4[$c1][1]);$c2=0;
	 for($cc2=0;$cc2<count($a6[$c1])-1;$cc2++)
	  {
		 $a7=spliti(" ",$a6[$c1][$cc2]);
		 if($a7[1]!=0){
		 $dd[$c2]=array("name"=>$a7[0],"size"=>$a7[1]); $c2++;} 
	  }
	  
	 $dd2[$c1]=array("name"=>$a5[$c1],"children"=>$dd); 
  }
  $dd3=array("name"=>"类别","children"=>$dd2);
  
   $xdd=json_encode($dd3);
   file_put_contents("../process/file/xdd.json",$xdd);  
	
	
for($c1=0;$c1<max($b2);$c1++)      //让各个区域的下标为0
{
	$g[$c1]=0;
}	

for($c2=0;$c2<$i;$c2++)
{
   	$lon[$b3[$c2]-1][$g[$b3[$c2]-1]]=$b1[$c2];
	$lat[$b3[$c2]-1][$g[$b3[$c2]-1]]=$b2[$c2];
	$g[$b3[$c2]-1]++;
}
$ad=NULL;
for($c1=0;$c1<max($b3);$c1++)
{
   $lon1[$c1]=0;$latt[$c1]=0;	
   for($c2=0;$c2<count($lon[$c1]);$c2++)
   {
	   $lon1[$c1]=($c2*$lon1[$c1]+$lon[$c1][$c2])/($c2+1);
	   $latt[$c1]=($c2*$latt[$c1]+$lat[$c1][$c2])/($c2+1);
	   
   }	
   $ad=$ad.",".$lon1[$c1]." ".$latt[$c1];
}   	

file_put_contents("../process/file/lonlat.txt",$ad);
$arr_lon=json_encode($lon1);
$arr_lat=json_encode($latt);
$arr_ark=json_encode($ark);



	$c1=0;
	while ($line5 = pg_fetch_array($result5, null, PGSQL_ASSOC)) {
		   for($c2=0;$c2<count($line5)-2;$c2++)
		     {$day[$c1][$c2]=$line5[$c2+1];}
		$c1++;	 
   }
   $xvb=NULL;
  for($c1=0;$c1<7;$c1++){
	   for($f1=0;$f1<count($day[$c1]);$f1++)
	   {
		   $da[$c1][$f1]=0;
	     for($f2=0;$f2<count($day[$c1]);$f2++)
		 {
			 if($day[$c1][$f1]<$day[$c1][$f2])
			  {
				   $da[$c1][$f1]++;
			 }
		}
	   }

	   for($f1=0;$f1<count($day[$c1]);$f1++)
	     {
			 if($da[$c1][$f1]==0)
			     $f5=$f1;
			   
			  if($da[$c1][$f1]==1)
			   $f6=$f1;  
			  if($da[$c1][$f1]==2)
			    $f7=$f1;
		 }
		if($f6==NULL&&$f7==NULL)                     //防止有相等的
		{                                            //一二三相等
			 $f5=NULL;
			for($f1=0;$f1<count($day[$c1]);$f1++)
	     {
		     if($da[$c1][$f1]==0)
			  {
				 if($f5==NULL)
				  {
					  $f5=$f1;
				  }
				  else
				  {
				     if($f6==NULL)	 
					   $f6=$f1;
					   else
					   $f7=$f1; 
					  
				 }
			  }	 
		 }
		} 
		
		if($f6==NULL&&$f7!=NULL)                    //一二相等
		 {
			 for($f1=0;$f1<count($day[$c1]);$f1++)
	       {
			    if($da[$c1][$f1]==0&&$f1!=$f5)
				$f6=$f1;
		   }
	     }
		 
	 if($f6!=NULL&&$f7==NULL )                    //二三相等 
		{
		   	 if($da[$c1][$f1]==1&&$f1!=$f6)
			  $f7=$f1;
		
		}
		 
		 
		
	$xvb=$xvb."@".$day[$c1][$f5]." ".($f5+1).",".$day[$c1][$f6]." ".($f6+1).",".$day[$c1][$f7]." ".($f7+1);
	  
  }
  
  file_put_contents("../process/file/tqy.txt",$xvb);
  $a100=array(100,100,100);
  $arr_a100=json_encode($a100);

	
    pg_free_result($result);
    pg_free_result($result1);
    pg_free_result($result2);
    pg_free_result($result3);	
	pg_free_result($result4);
	pg_free_result($result5);
}


echo "var data1=".$arr_lon.';'.'var data2='.$arr_lat.';'.'var data3='.$arr_ark.';'.'var data100='.$arr_a100.";var data4=".$ar5;
	
	
}	



else{
	    	   $fi1=file_get_contents("../process/file/lonlat.txt");  //读出各个区域的经纬度
	           $fi2=spliti(",",$fi1);
            	for($i=0;$i<count($fi2)-1;$i++)
	       {
	           $s=spliti(" ",$fi2[$i+1]);
		       $lon[$i]=$s[0];
		       $lat[$i]=$s[1];	 
	 
	       }
	      $fr=file_get_contents("../process/file/tip.txt");
		  $fr1=spliti(",",$fr);
		  for($gq=0;$gq<count($fr1)-1;$gq++)
		   {
			     $fr3[$gq]=$fr1[$gq+1];
		   }  
	      $arr99=json_encode($fr3);
	
	      
	    if(file_exists("../process/file/netform.csv"))   //自定义
		   {
		         exec("/usr/bin/R --vanilla <local.R",$out); 
		         $file1=file_get_contents("../process/file/roads.csv");
                 $file2=(int)file_get_contents("../process/file/netbegin.txt");
				 $file3=explode("\n", $file1);
				 $file4=spliti(",",$file3[0]);
				 for($file=0;$file<count($file4);$file++)
                {
                  if($file4[$file]==$file2)
                 {
               	    $t=$file;
                 }
                }
				
				$file6=0;$tt=0;
               $file4=spliti(",",$file3[0]);
                while($file4[$t])
             {
                if($file4[$t]!='NA')
             {
            	 $file7[$tt]=$file4[$t];
            	 $tt++;
             }
          
              $file6++;
             $file4=spliti(",",$file3[$file6]);
             }
            
               $i=0;
            while($file7[$i]!=NULL)
		  {
			$qw[$i]=(float)$lon[(int)$file7[$i]-1];
			$qt[$i]=(float)$lat[(int)$file7[$i]-1];
			$qx[$i]=(int)$file7[$i];
			$i++;  
		  }	
         
		 
		 
		      $arr_100=array(150,150,150);
		  
		     $arr_1=json_encode($lon);                          //所有经度
		     $arr_2=json_encode($lat);                          //所有纬度
		     $arr_3=json_encode($qw);                           //路线经度
			 $arr_4=json_encode($qt);						    //路线纬度
			 $arr_5=json_encode($qx);					        //路线顺序 
			 $arr_6=json_encode($arr_100);	 
	
	     echo "var data1=".$arr_1.';'.'var data2='.$arr_2.';'.'var data3='.$arr_3.';'.'var data4='.$arr_4.';'.'var data5='.             $arr_5.';'.'var data100='.$arr_6.';'.'var data99='.$arr99;
			
             unlink("../process/file/netform.csv");		   
			   
		   }
		 
		 	 
	   if(file_exists("../process/file/three.txt"))   //默认路线
		
		{
			  $roadnum=file_get_contents("../process/file/three.txt");
			  $tnet=file_get_contents("../process/file/load.txt");
			  
			  $tnet1=spliti("@",$tnet);
			  $thisroad= $tnet1[$roadnum-24];
			  
			  	$thisroad2=spliti(" +",$thisroad);
	         for($qz=0;$qz<count($thisroad2)-2;$qz++)
		   {
			  $qw[$qz]=$lon[$thisroad2[$qz+1]-1];
			  $qt[$qz]=$lat[$thisroad2[$qz+1]-1];
			  $qx[$qz]=(int)$thisroad2[$qz+1];
			  
		   }
		  
		    $arr_100=array(160,160,160);
			 $arr_1=json_encode($lon);                          //所有经度
		     $arr_2=json_encode($lat);                          //所有纬度
		     $arr_3=json_encode($qw);                           //路线经度
			 $arr_4=json_encode($qt);						    //路线纬度
			 $arr_5=json_encode($qx);					        //路线顺序 
			 $arr_6=json_encode($arr_100);	 
		    echo "var data1=".$arr_1.';'.'var data2='.$arr_2.';'.'var data3='.$arr_3.';'.'var data4='.$arr_4.';'.'var data5='.             $arr_5.';'.'var data100='.$arr_6.';'.'var data99='.$arr99;
			
			 unlink("../process/file/three.txt");	
			   			    		
        }
		 
 	
	    
	
}
	
	
?>
