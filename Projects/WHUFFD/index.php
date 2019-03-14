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
  
deldir("process/image");

deldir("process/form1");
deldir("process/file");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META http-equiv="Page-Enter" CONTENT="RevealTrans(Duration=4,Transition=7)">
<meta    http-equiv="Page-Exit"    contect="revealTrans(duration=1.0,transtion=12)"> 
<link rel="shortcut icon"type="image/x-icon" href="resource/image/golast.png" media="screen"  style="width:100px"/>
<link rel="stylesheet" href="resource/dist/css/bootstrap.min.css">
<script src="resource/dist/js/jquery.min.js"></script>
<script src="resource/dist/js/bootstrap.min.js"></script>
<script src="resource/dist/js/holder.min.js"></script>
<script src="resource/dist/js/application.js"></script>
<style type="text/css"> 
.body{
	
	position:relative}


#bodybg { 
    position: absolute;
    width: 90%;
    height: 100%;
    left: 10%;
    top: 0px;
    z-index: 0;
	background-color:#FFF;
}

#bodyb{ 
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0px;
    top: 120%;
    z-index: 0;
	background-color:#FFF;

	
}
#bod { 
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0px;
    top: 240%;
    z-index: 0;
	background-color:#FFF;
}

#bodybg .stretch { 
    width:100%;
    height:100%;
} 


#bodyb .stretc { 
    width:100%;
    height:100%;
} 

#bod .stret { 
    width:100%;
    height:100%;
} 



	#button {
		font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif;
		position: fixed;
		font-size: 3em;
		text-transform: uppercase;
		padding: 40px 10px;
		left: 50%;
		width: 200px;
		font:"华文行楷";
		margin-left: -20px;
		top: 40%;
		border: none;
		left:85%;
		color: white;
		cursor: pointer;
		border-color:transparent;


		animation: pulse 1s infinite alternate;
		transition: background 0.4s, border 0.2s, margin 0.2s;
	}
	@keyframes pulse {
		0% {
			margin-ledt: 0px;
		}
		100% {
			margin-left: 5px; 
		} 
	}

</style>

 <script src="resource/dist/js/prefixfree.min.js"></script>
<title>首页</title>
<link rel="stylesheet" href="../resource/dist/css/bootstrap.css">
<script src="resource/dist/js/jquery.min.js"></script>
<script src="resource/dist/js/bootstrap.min.js"></script>
<script src="resource/dist/js/holder.min.js"></script>
<script src="resource/dist/js/application.js"></script>
</head>


<body  >




<div id="bodybg">
  <img src="resource/image/bg.svg" class="stretch" style="#FFF" />
</div>
<div id="bodyb">
  <img src="resource/image/fhelp.svg" class="stretc" style="#FFF" />
</div>
<div id="bod">
  <img src="resource/image/team.svg" class="stret" style="#FFF" />
</div>


  <div class="container" ><input id="button" name="button" onclick="window.location='stage/first.html'"  type="image" src="resource/image/golast.png"  border="no"></div>
   <script src="resource/dist/js/index.js"></script>
   <script>
     $("input,button").focus(function(){this.blur()});
   </script>
</body>
</html>

