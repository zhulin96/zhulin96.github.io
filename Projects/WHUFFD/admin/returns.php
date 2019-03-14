<?php
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


<html>

<form name="EditView" method="POST" action="../stage/first.html"> 
<input type="hidden" name="xxx"> 
</form> 
<script type=text/javascript> 
document.EditView.submit(); 
</script>
</html>
