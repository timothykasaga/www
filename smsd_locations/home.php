<!DOCTYPE HTML>

<html>

<head>
  <title>Smart Shopping Mate location capture</title>
  <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class="main">
    <div id="static_header">
    <center>
    <section class="header">
          <h1>Smart Shopping Mate</h1>
          <h3>Powered by Leontymo developers</h3>
    </section>
    <section class="links">
        <h4><a href="home.htm">Home</a> || <a href="services.htm">Our services</a> || <a href="faq.htm">FAQ</a> || <a href="aboutus.htm">About us</a> </h4>
    </section>
    </center>
    </div>
    <section class="main_article">

        <hr>
            <p><h4> Please upload image of floor plan </h4></p>
                <form action="home.php" method="POST" enctype="multipart/form-data">
                <input type="file" accept=".jpeg,.jpg" style="float: left" name="myfile" required="required"/>
                <input type="text" name="supermarket_id" placeholder="Supermarket id" required="required"/>
                <input type="number" name="floor_no" placeholder="Floor number" required="required"/>
                <input type="submit" value="Load image on scaler" style="float: right" name="submit"/>
                </form>
                    </br>
				
				<?php
					include("connect.php");
					if($db){
					if(isset($_POST['submit'])){
					$supermkt_id = $_POST['supermarket_id'];
                    $floor_no = $_POST['floor_no'];
					  $name = mysqli_real_escape_string($db,$_FILES['myfile']['name']);
					  $temploc = $_FILES['myfile']['tmp_name'];
					  $error = $_FILES['myfile']['error'];
					  if($error > 0){
						//die("Error uploading file");
						echo "<br><h4>Error uploading the file</h4>";
					  }else{
					  //try to resize image
					  $source_image = imagecreatefromjpeg($temploc);
					  $source_imagex = imagesx($source_image);
					  $source_imagey = imagesy($source_image);
					  $dest_imagex = 800;
					  $dest_imagey = 315;
					  $dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
					  imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);

					  imagejpeg($dest_image, $temploc);
					  $image_content = mysqli_real_escape_string($db,file_get_contents($_FILES['myfile']['tmp_name']));
					  move_uploaded_file($temploc,"images/".$name.".jpg");
					  merge_images($name);
					  //finish resize


						//$image_content = mysqli_real_escape_string($db,file_get_contents($_FILES['myfile']['tmp_name']));

						$query = "insert into images(image_name, image, SupermarketID,floor_no) values('$name','$image_content','$supermkt_id',$floor_no)";
						mysqli_query($db,$query);
						echo(" <h4> Image Upload successful !!!!<br> For supermarket id: $supermkt_id
                         floor: $floor_no</h4>");
					  }
				  }
				  }else{

				  }

				  function merge_images($name){
					include("connect.php");
					$sql = "update uploadtimes set times = 1 where id = 1";
						mysqli_query($db,$sql);
					// Load the stamp and the photo to apply the watermark to
						$im = imagecreatefromjpeg('photo.jpg');

						// First we create our stamp image manually from GD
						//$stamp = imagecreatetruecolor(800, 560);
						$stamp = imagecreatetruecolor(800, 315);
						imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
						imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
						$im = imagecreatefromjpeg('mygrid.jpg');
						imagestring($stamp, 5, 20, 20, 'libGD', 0x0000FF);
						imagestring($stamp, 3, 20, 40, '(c) 2007-9', 0x0000FF);

						// Set the margins for the stamp and get the height/width of the stamp image
						$marge_right = 0;
						$marge_bottom = 0;

						$stamp1 = imagecreatefromjpeg("images/".$name.".jpg");

						$sx = imagesx($stamp1);
						$sy = imagesy($stamp1);

						// Merge the stamp onto our photo with an opacity of 50%
						imagecopymerge($im, $stamp1, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp1), imagesy($stamp1),50);

						// Save the image to file and free memory
						imagepng($im, 'photo_stamp.png');	
						imagedestroy($im);
						
				  }

				?>
				
				<div class="myimages">

                <div id ="floor_image">
				<center>
				<?php 
				include("connect.php");
				$sql = "select times from uploadtimes where id = 1";
				$result = mysqli_query($db,$sql);
				$x = 0;
				while($data = mysqli_fetch_array($result)){
				$x = $data[0];
				}
				if($x == 1){
					echo '<img src="photo_stamp.png" alt="Image not uploaded" id="myImg"/>';
				}else{
					echo '<img src="mygrid.jpg" alt="Image not uploaded" id="myImg"/>';
				}
				
				$sql1 = "update uploadtimes set times = 0 where id = 1";
						mysqli_query($db,$sql1);
				?>
				</center>
                </div>

                </div>


                <hr>
				<h4>Mappings</h4>
                 <form action="mapping.php" method="POST">
                     <div>
                     <label for="sname" >Supermarket name</label><input type="text" name="sname"required="required" />
                     <label for="s_id">Supermarket id</label><input type="text" name="sid" required="required"/>
                     <label for="floor_no">Floor number</label><input  type="number" name="floorno" required="required"/>
                     </div>
                     <br>
                     <div>
                     <label for="sname">Section name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="secname" required="required"/>
                     <label for="sid">Section id&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="secid" required="required"/>
                     </div>

                     <h4>Grid cells for section </h4>

                     <div>
                     <select name="cells[]"  multiple="multiple" size="5" style="width: 200px" required="required">
					 
					 <?php 
						for($i =1; $i<495 ;$i++){
						echo "<option >$i</option>";
						}
						?>
					 
                     </select>
                     </div>
                 </br>
                     <div>
                    <!-- <button name="view">View cells</button> -->
                     <input type="submit" name="save" value="Save section details" />
                     </div>
                     <br>
                     <!--<textarea rows="4" cols="64">
                     </textarea>   -->
                </form>


    </section>
    </div>
</body>

</html>