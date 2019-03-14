<?php
    $a=$_POST['passid'];
	$b=$_POST['pas'];
   
   
   function city($x){
  
    if($x==1)
     return "beijing";
	 
	if($x==2)
     return "chongqing";
 
   if($x==3)
      return "shanghai";
	 
 	 
   if($x==4)
     return "tianjin";	 
	 
   if($x==5)
     return "anhui";
	 
  if($x==6)
     return "fujian"; 
	 
  if($x==7)
     return "gansu";	 
	 
  if($x==8)
     return "guangdong";
	 
  if($x==9)
     return "guangxi";	 
	 
  if($x==10)
     return "guizhou";	
	 
  if($x==11)
     return "hainan";	 
	  
  if($x==12)
     return "hebei";
  if($x==13)
     return "heilongjiang";	 	
	 
  if($x==14)
     return "henan";	 
	 
   if($x==28)
     return "shanxi";	
	 
   if($x==22)
     return "liaoning";   
	 
    if($x==21)
     return "jilin";
	 

	 
	if($x==19)
     return "jiangsu";
	 
	if($x==35)
     return "zhejiang";
	 

	 
	 if($x==20)
     return "jiangxi"; 
	 
	 if($x==27)
     return "shandong";
	 

	 
	 if($x==17)
     return "hubei";
	 

	 
	 if($x==29)
     return "sichaun";
	 

	 
	 if($x==34)
     return "yunnan";
	 
	 if($x==18)
     return "hunan";
	 
	 if($x==26)
     return "shan3xi";	 
	 

     
	 if($x==25)
     return "qinghai";
	 
	 if($x==30)
     return "taiwan";
	 
	 if($x==23)
     return "neimenggu";
	 
	
	 
	 if($x==33)
     return "xizang";
	 
	 if($x==24)
     return "ningxia";
	 
	 if($x==32)
     return "xinjiang";
	 
	 if($x==31)
     return "xianggang";
	 
	 if($x==15)
     return "aomen";
	 
	 if($x==16)
	 return "haiwai";
	 if($x==36)
	 return "all"; 
	 
}
function quarter($y){

     if($y==1)
	   return "1";

     if($y==2)
	   return "2";

     if($y==3)
	   return "3";	

     if($y==4)
	   return "4";	
	 if($y==0)
	   return "0";        
}





$x=city($a);
$y=quarter($b);

$adf=$x."_".$y;

file_put_contents ("../process/form1/form1.txt",$adf );

?>


<html>

<form name="EditView" method="POST" action="../stage/first1.html" > 
<input type="hidden" name="xxx" value="1"> 
</form> 
<script type=text/javascript> 
document.EditView.submit(); 
</script>
</html>
