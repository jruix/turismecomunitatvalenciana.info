<?php

$uploaddir = '../uploads/'; 
$file = $uploaddir . basename($_FILES['uploadfile']['name']); 

if ((($_FILES["uploadfile"]["type"] == "image/gif")
|| ($_FILES["uploadfile"]["type"] == "image/jpeg")
|| ($_FILES["uploadfile"]["type"] == "image/pjpeg")
|| ($_FILES["uploadfile"]["type"] == "image/png")
|| ($_FILES["uploadfile"]["type"] == "image/x-icon"))
&& ($_FILES["uploadfile"]["size"] < 20000))
 	{

		 if ($_FILES["uploadfile"]["error"] > 0)
   			 {
   			 echo "Return Code: " . $_FILES["uploadfile"]["error"] . "<br />";
    			}
 		 else
   				 {

				if (file_exists($uploaddir . $_FILES["uploadfile"]["name"]))
     			 {
     			echo "The image '" . $_FILES["uploadfile"]["name"] . "' already exists on the server. ";
    				  }
    				else
    		 		 {
			
						if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
 						 echo "success"; 
						} else {
								echo "error";
								}
					}
				}
	}
else
  {
  echo "Image too big. Maximum 20kb accepted.";
  }

?>
