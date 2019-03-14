<?php


 $a=file_get_contents("../process/file/time.txt");
 
 if($a<21&&$a>0){                              //用于显示区域相关的图
 $aa=array($a,$a,$a);
 $arr_aa3=json_encode($aa);
  
  $xdd=file_get_contents("../process/file/cate".$a.".tsv");
   $xdd1=spliti("\r\n",$xdd);
    $q=0;
	for($i=1;$i<count($xdd1);$i++)
	{
		 $c=spliti("\t",$xdd1[$i]);
		 if($c[1]!=0)
	     {
			 $qx[$q]=urlencode($c[0]);
			 $qy[$q]=((int)($c[1]*10000))/10000;
			 $q++;
		 }	
     } 
	 
	 $a1=urldecode(json_encode($qx));$a2=json_encode($qy);
	 
	 echo "var data1=".$arr_aa3.";"."var data2=".$a1.";"."var data3=".$a2;
 

 }
 
 
if($a==23)                                //自定义路线
{
   $aa=array($a,$a,$a); 
   $k=array("天","一","二","三","四","五","六");     //判断星期几
   $time=time();
   $t=date("w",$time);
   
   
	$file1=file_get_contents("../process/file/lonlat.txt");  //读出各个区域的经纬度
	$file2=spliti(",",$file1);
	for($i=0;$i<count($file2)-1;$i++)
	 {
	      $s=spliti(" ",$file2[$i+1]);
		  $lon[$i]=$s[0];
		  $lat[$i]=$s[1];	 
	 
	 }
	                                                         //读出这天排名前三的区域
	 $quyu=file_get_contents("../process/file/tqy.txt");
	 $qy=spliti("@",$quyu);
	  
	 $quyu2=$qy[$t+1];
	 $quyu3=spliti(",",$quyu2);
	 $f1=spliti(" ",$quyu3[0]);
	 $qy3[0]=$f1[0];
	 $qyn3[0]=$f1[1];
	 $f1=spliti(" ",$quyu3[1]);
	 $qy3[1]=$f1[0];
	 $qyn3[1]=$f1[1];	
	 $f1=spliti(" ",$quyu3[2]);
	 $qy3[2]=$f1[0];
	 $qyn3[2]=$f1[1];	
	 

	
	
	 
     $road=file_get_contents("../process/file/ptop.txt");	
	  
	 $road1=spliti("@",$road);
	 $road2=$road1[$t];	                                                  //读出排名前二的的路线
	 $road3=spliti(",",$road2);
	 $rw1=spliti(" ",$road3[0]);
	 $start[0]=$rw1[0];$end[0]=$rw1[1];$coun[0]=$rw1[2];
	 $rw2=spliti(" ",$road3[1]);
	 $start[1]=$rw2[0];$end[1]=$rw2[1];$coun[1]=$rw2[2];	  
	
    $arr_aa1=json_encode($aa);                      //识别符
	$arr_aa2=json_encode($k[$t]);                    //星期几 
	$arr_aa3=json_encode($lon);                     //经度
    $arr_aa4=json_encode($lat);                     //纬度
    $arr_aa5=json_encode($qy3);                     //区域号
    $arr_aa6=json_encode($qyn3);                    //区域authority
	$arr_aa7=json_encode($start);                   //起点
    $arr_aa8=json_encode($end);                     //终点
	$arr_aa9=json_encode($coun);                    //次数
	  
  
   echo "var data1=".$arr_aa1.";"."var data2=".$arr_aa2.";"."var data3=".$arr_aa3.";"."var data4=".$arr_aa4.";"."var data5=".$arr_aa5.";"."var data6=".$arr_aa6.";"."var data7=".$arr_aa7.";"."var data8=".$arr_aa8.";"."var data9=".$arr_aa9;
	 

}
 
if($a==24)                              //第一条默认路线
{
  $aa=array($a,$a,$a); 
  file_put_contents("../process/file/three.txt");
  $arr_aa1=json_encode($aa);
  echo "var data1=".$arr_aa1;
	
} 

if($a==25)                             //第二条默认路线
{
	  $aa=array($a,$a,$a); 
 	  file_put_contents("../process/file/three.txt");
      $arr_aa1=json_encode($aa);
     echo "var data1=".$arr_aa1;
}
 
if($a==26)                            //第三条默认路线
{
    $aa=array($a,$a,$a); 
	
   file_put_contents("../process/file/three.txt");
   $arr_aa1=json_encode($aa);
   echo "var data1=".$arr_aa1;
	
} 

if($a==21)
{
	 $aa=array($a,$a,$a);
	 $f=file_get_contents("../process/file/lly.txt");
	 $f1=spliti("@",$f);
	 for($i=0;$i<count($f1)-1;$i++)
	 {
		 $f2=spliti(";",$f1[$i]);
		 $name[$i]=$f2[0];
		 $f3[$i]=spliti(",",$f2[1]);
		 for($j=0;$j<count($f3[$i])-1;$j++)
		 {
			$f7=spliti(" ",$f3[$i][$j+1]);
			 
			 
			 if($f7[1]!=0){
			
			 $f4[$i][$j]=$f7[0];
			 $f5[$i][$j]=$f7[1];
			 }
		 }
		 if(count($f4[$i])==0)
		 {
			 $f4[$i][0]=1000;
			 $f5[$i][0]=1000;
		 }
		 
	}
	
	  $arr4=json_encode($f5);
	  $arr3=json_encode($f4);
	 
	  $arr2=json_encode($name);
	  $arr1=json_encode($aa);
	echo "var data1=".$arr1.";"."var data2=".$arr2.";"."var data3=".$arr3.";"."var data4=".$arr4;
	
	
}


 
 
?>
