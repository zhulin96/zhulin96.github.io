<?php
    
    if(file_exists("../../process/file/time.txt"))
	{
	   $a=unlink("../../process/file/time.txt");	
	}
    
    file_put_contents("../../process/file/time.txt","1");





?>


