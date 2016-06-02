<?php
// Load the stamp and the photo to apply the watermark to
						$stamp1 = imagecreatefrompng("testlocateuser/marker.png");
						$sx = imagesx($stamp1);
						$sy = imagesy($stamp1);
						
						
						// Set the margins for the stamp and get the height/width of the stamp image
						
						//initialize counter
						$counter = 0;
						$marge_right = 750;
						$marge_bottom = 288;
						while($counter < 1)
						{
						if($counter == 0){
						$im = imagecreatefromjpeg('images/photo.jpg');	
						}else{
						$im = imagecreatefromjpeg('testlocateuser/nu_loc.jpeg');
						}
						
						// Merge the stamp onto our photo with an opacity of 50%
						imagecopymerge($im, $stamp1, imagesx($im) - $sx - $marge_right, 
						imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp1), imagesy($stamp1),50);

						// Save the image to file and free memory
						imagejpeg($im, 'testlocateuser/nu_loc.jpeg');
						imagedestroy($im); 
						$marge_right = $marge_right+30;
						$counter = $counter+1;
						}
?>