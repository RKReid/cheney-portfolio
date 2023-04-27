<?php
//Background scripts
	//creates the modal summoning button and calls preventresubmit.js, which prevents the "are you sure you want to resubmit this" dialog
	echo '<script src="pageparts/preventresubmit.js"></script><button class="gallery-modal-button" id="myBtn">Search<br><br>Pages</button><br>';


//Initialization
	//get the tagbutton value
	$tagIDbutton = $_POST['tagbutton'];

	//Sets the sort to descending if there is no pre existing sorting value 
	if (isset($_GET['sort'])) { 
	$sort_int= $_GET['sort']; 
	} else { 
	$value="desc"; 
	} 
	//Sets tag_int to 0 if there is no pre existing tag value. tag_int is used to determine whether or not to use tags.
	if (isset($_GET['tagIDbutton'])) { 
	$tag_int= $_GET['tagIDbutton']; 
	} else { 
	$tag_int="0"; 
	} 
	//gets the value for filesearch and if there is nothing, it sets it to nothing. This is used to search via filenames
	if (isset($_GET['filsearch'])) { 
	$filsearch_int= $_GET['filsearch']; 
	} else { 
	$filsearch_int=""; 
	} 
	
	//unused value? maybe remove?
	if (isset($_GET['textsearch'])) { 
	$textsearch_int= $_GET['textsearch']; 
	} else { 
	$textsearch_int=""; 
	} 


	echo "
	<div id='gallery-modal' class='gallery-modal'>

	  <!-- Modal content -->
	  <div class='gallery-modal-content'>
		<div class='gallery-modal-header'>
		  <span class='gallery-close'>&times;</span>
		  <h2>Gallery Search</h2>
		</div>
		<div class='gallery-modal-body'>

	<form method='get' action='gallery.php'><input maxlength='30' type='text' name='filsearch' placeholder='Search'><input type='hidden' name='page' value='1'><input type='hidden' name='sort' value='desc'><input type='submit' value='Search'></form>
	<br>

	<a class='tagbutton' href='gallery.php?page=1&sort=desc'>All</a>
	<a class='tagbutton' href='gallery.php?page=1&sort=desc'>New</a>
	<a class='tagbutton' href='gallery.php?page=1&sort=asc'>Old</a>

	<br>";

//grab all tags that have matching files
				//FIX LATER!!!!!!!!!!!!!!! 

//	$sql = "SELECT * FROM gallerytags JOIN imgcountview ON tags.tagID = imgcountview.tagID WHERE imgCount>0 ORDER BY tag ASC";  //this line should use views to check whether a tag has any files asocitatted with it, if so it  displays them, if not it hides them.
	$sql = "SELECT * FROM gallerytags ORDER BY tag ASC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {	  
		echo "<a class='tagbutton' href='gallery.php?page=1&sort=".$sort_int."&tagIDbutton=". $row["tagID"]."'>". $row["tag"]."</a>";
	  }
	} else {
	   echo "If you see this, something broke. Please notify Rob.";
	}
	echo '<br>Search by file type<br>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.png">PNG</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.jpg">JPG</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.gif">GIF</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.webp">WEBP</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.jfif">JFIF</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.jpeg">JPEG</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.svg">SVG</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.ico">ICO</a>
	<a class="tagbutton" href="gallery.php?page=1&sort=desc&filsearch=.bmp">BMP</a>



		</div>
		<div class="gallery-modal-header">
		  <h2>Page Number</h2>
		</div>

	<script src="pageparts/basicmodal.js"></script>

	<div class="gallery-modal-body">
	<br>
	';

//tag search
	
	if ($tag_int > 0) {
	$sql = "SELECT COUNT(imgID) AS total FROM gallerytags WHERE tagID=".$tag_int."";	//this outputs any files with the tag from the url 
	} elseif ($tag_int == 0) {
	$sql = "SELECT COUNT(imgID) AS total FROM gallery WHERE filename LIKE '%".$filsearch_int."%'";	//this outputs any file based on the text search and file name
	}
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
	for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
				echo "<a class='mpagenumbers' href='gallery.php?page=".$i."&sort=".$sort_int."&tagIDbutton=".$tag_int."&filsearch=".$filsearch_int."'";
				if ($i==$page)  echo " class='curPage'";
				echo ">".$i."</a> "; 
	}; 


	echo '
	  </div>

	<div class="gallery-modal-footer">Hello!<br>You found a secret message!<br></div>
	  </div>
	</div>
	';


//page system
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; //checks if the url had a page number, if not it sets it to 1
	$start_from = ($page-1) * $results_per_page;
	if ($tag_int > 0) {
	$sql = "SELECT * FROM gallery JOIN gallerytags USING (imgID) WHERE tagID = ".$tag_int." AND filename LIKE '%".$filsearch_int."%' ORDER BY imgID ".$_GET["sort"]." LIMIT $start_from, ".$results_per_page."";
	} elseif ($tag_int == 0) {
	$sql = "SELECT * FROM gallery WHERE filename LIKE '%".$filsearch_int."%' ORDER BY imgID ".$_GET["sort"]." LIMIT $start_from, ".$results_per_page."";
	}	
	$rs_result = $conn->query($sql);
	 if ($rs_result->num_rows > 0) {
	 while($row = $rs_result->fetch_assoc()) {
	echo "<a href='images/". $row["filename"]."' target='_blank'><div class='gallerybox'><img class='galleryimg' src='images/". $row["filename"]. "' onerror='image404(this)'><br>". $row["imgID"]. "<br>". $row["filename"]. "</div></a>";
	 }} else {
	   echo "<br><br>No results";	 
	 }; 

	echo "<br>";
	if ($tag_int > 0) {
	$sql = "SELECT COUNT(imgID) AS total FROM gallerytags WHERE tagID=".$tag_int."";	
	} elseif ($tag_int == 0) {
	$sql = "SELECT COUNT(imgID) AS total FROM gallery WHERE filename LIKE '%".$filsearch_int."%'";	
	}
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
	for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
				echo "<a class='mpagenumbers' href='gallery.php?page=".$i."&sort=".$sort_int."&tagIDbutton=".$tag_int."&filsearch=".$filsearch_int."'";
				if ($i==$page)  echo " class='curPage'";
				echo ">".$i."</a> "; 
	}; 

?>