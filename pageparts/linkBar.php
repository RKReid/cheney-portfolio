<!--If you need assitance with this code, please contact robkreid05@gmail.com-->


<?php
	echo "<div class='linksbackground'><br>";
						$sql = "SELECT * FROM cheneyReqData";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			if  ($row["hide"] == 1) {
				//do nothing
			} else if ($row["hide"] == 0) {
				echo "<a class='a1' href='itemDetails.php?title=". $row["title"]. "'>". $row["title"]. "</a>";
			}
		  }
	} else {
		  echo "MySQL Error. Please notify Rob if you see this.";
		}
	echo "<br><br></div>";
?>