<!--The top of the page is included in the php file below-->
	<?php include("pagetemplates/basic page template top.php"); ?>
<!--start of write area-->
<?php 
//This code changes depending on the page, it is independant from the basicmodalsearch template, but it is meant to be use with it, and some line are required for it to work
$results_per_page = 40; // number of results per page 

$isStandard = "true"; //used to determine whether the page should use the standard modal or a custom one. false means custom, so it will based off of $pagename, and true means standard, so $pagename will not change what the modal will look like.
$pagename = "gallery"; //used to determine how the page works and looks 


?>
		<?php include("pageparts/cheneyReqLinks.php"); ?>
	
<!--Item here-->
<?php
//Grabs URL Vars
if (isset($_GET['table'])) { 
	$table = $_GET['cheneyReqData']; 
} else { 
	$table="Error"; 
}
if (isset($_GET['title'])) { 
	$title= $_GET['title']; 
} else { 
	$title="Error"; 
} 
           






$sql = "SELECT * FROM cheneyReqData WHERE title='".$title."'";  //this line should use views to check whether a tag has any files associtated with it, if so it  displays them, if not it hides them.
$result = $conn->query($sql);

if ($result->num_rows  > 0) {
	 while($row = $result->fetch_assoc()) {
	//Each displayed item
	echo "<h1>".$row["title"]."</h1><p>".$row["textdata"]."</p><br><br><br><img width='500px' class='cheneyimage' style='width: 40%;'  src='images/carousel/". $row["image1"]. "' onerror='image404(this)'><br><p>".$row["imageDescription"]."</p>";
	 }} elseif ($result->num_rows > 1) {
	   echo "<br><br>More than one result. Please alert Rob to this if you accessed this page via an page from this site.<br>";	 //tell user there are more results than 1
	 } else {
	   echo "<br><br>No results. Please alert Rob to this if you accessed this page via an page from this site.<br>";	 //tell user there are no results
	 }; 


?>


    <b><?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?></b>


<!--The bottom of the page is included in the php file above-->			
	<?php include("pagetemplates/basic page template bottom.php"); ?>