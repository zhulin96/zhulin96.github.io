<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache'); 
function deldir($dir)
	{
		//删除目录下的文件：
		$dh=opendir($dir);
		
		while ($file=readdir($dh)) 
		{
			if($file!="." && $file!="..") 
			{
				$fullpath=$dir."/".$file;
				
				if(!is_dir($fullpath))
				{
					unlink($fullpath);
				} 
				else
				{
					deldir($fullpath);
				}
			}
		}
	 
		closedir($dh);

}
  
deldir("../process/image");

deldir("../process/form1");
deldir("../process/file");





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
<META http-equiv="Page-Enter" CONTENT="RevealTrans(Duration=4,Transition=7)">
<META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
<META HTTP-EQUIV="expires" CONTENT="0">
<link rel="stylesheet" href="../resource/dist/css/bootstrap.css">
<script src="../resource/dist/js/jquery.min.js"></script>
<script src="../resource/dist/js/bootstrap.min.js"></script>
<script src="../resource/dist/js/holder.min.js"></script>
<script src="../resource/dist/js/application.js"></script>

<link rel="shortcut icon"type="image/x-icon" href="../resource/image/golast.png" media="screen"  style="width:100px"/>
<title>WHUFFD深圳旅游推荐</title>
    <style type="text/css">
      body,html,#contain{
        width: 100%;
        height: 100%;
        margin: 0px
      }
	  
	  
	  
     #buttongroup1{
		  height:100%;
		  width:100%;
		  margin-top:3%;
		  left:-2%;
	  }
	 #buttongroup2{
		  height:100%;
		  width:100%;
		  margin-top:-4%;
		  left:78%;
	  }
     #buttongroup3{
		   height:100%;
		  width:100%;
		  left:99%;
		    margin-top:44%;
		 }
	   .cb{
		  }
    </style>
<script>

	alert("区域太少，无法生成路线，请重新选择");

</script>
    
</head>



<body onload="zdd()">
   
<div id="contain" tabindex="0">
      <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=您申请的key值&plugin=AMap.ToolBar"></script>
      <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
      <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main.css?v=1.0"/>
      <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>

       <script type="text/javascript">
   

	   
	    var map = new AMap.Map('contain', {
        resizeEnable: true,
        zoom:12,
        center: [114.085947,22.547]
        
        });

	
      </script>  
  <div class="container">
        
     <div class="btn-group btn-group-lg" id="buttongroup1">
       <button type="button"  id="button1" class="btn btn-default">选择属性</button>
       
       <button type="button"  id="button2" class="btn btn-default" disabled="disabled">区域信息</button>
       <button type="button"  id="button3" class="btn btn-default"  disabled="disabled">推荐路线</button>
       <button type="button"  id="button4" class="btn btn-default"  disabled="disabled">自定义路线</button>
       
       <script>
	   $('#button1').tooltip({
		
	     'title':'请输入来源地及所在季节',
	     'placement':'bottom',
      });
	  
	     $('#button1').popover({
	     'placement':'bottom',
	     'title':'',
	     'content':'   	<div class="container">'+
         '<form action="../admin/form1.php" name="form" id="form" method="post">'+
			'<div class="form-group">'+
             '<div class="row">'+
					'<label for="passid" class="control-label" >请选择来源地:</label><br>'+
				 '</div>'+
				 '<div class="row">'+ 
                 '<div class="col-sm-2">'+
					'<select name="passid" id="passid" class="form-control">'+
							'<option value="1">北京</option>'+
                    '<option value="2">重庆</option>'+
                    '<option value="3">上海</option>'+
                    '<option value="4"  >天津</option>'+
					 '  <option value="15">澳门</option>'+ 
				    '  <option value="31" selected="selected">香港</option>'+
					 '<option value="5">安徽</option>'+
                    '<option value="6">福建</option>'+
                    '<option value="7">甘肃</option>'+
                    '<option value="8">广东</option>'+
                    ' <option value="10">贵州</option>'+
                   ' <option value="11">海南</option>'+
                   ' <option value="12">河北</option>'+
                   ' <option value="13">黑龙江</option>'+
                   ' <option value="14">河南</option>'+
                   ' <option value="17">湖北</option>'+
                   ' <option value="18" >湖南</option>'+
                   ' <option value="19">江苏</option>'+
                   ' <option value="20">江西</option>'+
                   ' <option value="21">吉林</option>'+
                   ' <option value="22">辽宁</option>'+                               
                   ' <option value="25">青海</option>'+
                    '<option value="26">陕西</option>'+
                   ' <option value="27">山东</option>'+
                   ' <option value="28">山西</option>'+
                  '  <option value="29">四川 </option>'+
                  '  <option value="30">台湾</option>'+                        
                   ' <option value="34">云南</option>'+
                  '  <option value="35">浙江</option>'+
		         ' <option value="23" >内蒙古</option>'+
			     ' <option value="9">广西</option>'+
		         '  <option value="24">宁夏</option>'+
			     ' <option value="32">新疆</option>'+
                 ' <option value="33">西藏</option>'+	
				
				  
				   '  <option value="16">海外</option>'+
                   ' <option value="36" class="cb">全国</option>'+
					'</select>'+
				'</div>'+
             '   </div>'+
          ' </div>	'+
           
           
          '<div class="form-group">'+
          '  <div class="row">'+
				'	<label for="pas" class="control-label">请选择时间:</label><br>'+
				' </div>'+
                    '  <div class="row">'+       
            
				'<div class="col-sm-2">'+
                 '<select name="pas" id="pas" class="form-control">'+
                 '   <option value="1" selected="selected">第一季度（3-5月）</option>'+
                 '   <option value="2">第二季度（6-8月）</option>'+
                '    <option value="3">第三季度（9-11月）</option>'+
                '    <option value="4">第四季度（12-2月）</option>'+
				 '    <option value="0"  class="cb">全年</option>'+
             '    </select>'+
                  '</div>'+
               '</div>'+
			   '<br>'+
			   
		          '<div class="form-group">'+
				'<div class="col-md-1">'+
					'<input type="submit" value="确定" class="btn btn-primary" >'+
				'</div>'+
                '<div class="col-md-1">'+
					'<input  type="reset" value="取消" class="btn btn-info" >'+
				'</div>'+
	      '</div>'+
      '  </form>'+
     
      '</div>',
	     'html':true,
	     'trigger':'click'
        });
	   </script>

     </div>
      
          
      
     <div class="btn-group btn-group-lg" id="buttongroup2">
       <button type="button"  id="button5" class="btn btn-default" onclick="window.location='../index.php'">首页</button>
       
       <button type="button"  id="button6" class="btn btn-default" onclick="window.location='help.html'">使用帮助</button>
       <button type="button"  id="button6" class="btn btn-default" onclick="window.location='readme.html'">团队介绍</button>
      </div>
      
      <div  class="btn-group btn-group-lg" id="buttongroup3">
             <img src="../resource/image/logo.png" style="width:10%; height:10%">
      </div>
  </div>



 
</div>


<script>
     
	setTimeout(function(){ $("#acv").click(function(){
		 var ff=0;

	  	
        var _radio = document.getElementById("form").getElementsByClassName("cb");//获取单选框集合
        for (var i = 0; i < _radio.length; i++)
            if (_radio[i].selected="selected") {
               ff++;
				
		   }
			
			    if(ff==2)
	         {
	                alert("无法返回结果，请您重新选择");
					return false;
	         }	
		 }
		
   
		 
		 
		 )},1000);

	</script>
 
 
 
 
</body>
</html>