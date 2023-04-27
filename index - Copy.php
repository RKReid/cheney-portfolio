<!--The top of the page is included in the php file below-->
	<?php include("pagetemplates/basic page template top.php"); ?>
			<!--
			start of write area
			After any code after this until the bottom of the page area, alters on each page 
			-->




			
			

			<br><br><br>
			<?php
			
			$sql = "SELECT * FROM communityService";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
				echo "<h3><b>". $row["place"]. "</h3><p class='centernews'>". $row["location"]. " - ". $row["phoneNumber"]. "</b><br>". $row["description"]. "</p><br>";
			  }
			} else {
			  echo "MySQL Error. Please notify Rob if you see this.";
			}
			
			?>
			
<!--The bottom of the page is included in the php file above-->			
	<?php include("pagetemplates/basic page template bottom.php"); ?>