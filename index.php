<!--The top of the page is included in the php file below-->
	<?php include("pagetemplates/basic page template top.php"); ?>
			<!--
			start of write area
			After any code after this until the bottom of the page area, alters on each page 
			-->

	<?php include("pageparts/cheneyReqLinks.php"); ?>


			
			
			<h1>Home</h1>
			<br><br><br>
		
			<br><br><br>
			<img width="50%" src="images/carousel/IMG_20221202_063340.jpg"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_2675.JPG"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_3818.JPG"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_20230224_195405.jpg"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_20230325_174027.jpg"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_20230327_232949.jpg"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_20220222_180831_1.jpg"  onerror="image404(this)">
			<img width="50%" src="images/carousel/IMG_20220705_165129_01.jpg"  onerror="image404(this)">
			<p class="centernews">temp</p>
			<br><br><br>
			<?php
			
			$sql = "SELECT * FROM cheneyReqData";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
				echo "<h3>". $row["title"]. "</h3><p class='centernews'>". $row["textdata"]. "</p><br>";
			  }
			} else {
			  echo "MySQL Error. Please notify Rob if you see this.";
			}
			
			?>
			
<!--The bottom of the page is included in the php file above-->			
	<?php include("pagetemplates/basic page template bottom.php"); ?>