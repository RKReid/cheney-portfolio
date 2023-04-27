<?php 
echo "<p class='bordermax1500 centerimg'>";
$sql2 = "SELECT * FROM credits ORDER BY creditID DESC";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result2->fetch_assoc()) {	  
	echo $row2["text"];
  }
} else {
   echo "MySQL Error. Please notify Rob if you see this.";
}
echo "</p>";
?>