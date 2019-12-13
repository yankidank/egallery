<?php
//////////////////////////////////////////////////////
///////////////// EGallery Index File ////////////////
//////////////////////////////////////////////////////
//      Place this file in the image directory      //
//////////////////////////////////////////////////////

// Customize this next line if you changed the location of egallery.
include_once "egallery/functions.php";

// Find your domain
if ( $domain == "" ) {
	$domain = 'http://'.$_SERVER['HTTP_HOST'];
}
// Find the subdirectory
if ( $subdirectory == "" ) {
	$subdir = $_SERVER["REQUEST_URI"];
	$subdirectory = str_replace("/index.php", "", $subdir);
}
// Fix for index.php directory. Alternatively you could write a htaccess redirect to root.
$onindex = str_replace($subdirectory, "", $subdir);
if ( $onindex == "/index.php" ){
	$directory = str_replace("\/", "", $directory);
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php
			// Get directory name for use in the <title>
			$curdir = getcwd();
			$shortname = basename(trim($curdir, '/'));
			$titlename = ucwords($shortname);
		?>
		<title><?php if ($page_title != ""){ echo $page_title; } else { echo $titlename; } ?></title>
		<link rel="stylesheet" href="<?php echo $domain.$subdirectory.$directory; ?>/style.css" />
		<style type="text/css">
			.box{
			  width: <?php echo $image_width; ?>px;
			}
		</style>
	</head>
<body>

<?php if ( $zip_download == "yes" ) { ?>
<div class="download-set">
	<div class="download-button-wrapper"><a href="<?php echo $domain.$subdirectory.$directory; ?>/download.php?zip=1" class="download-button"><?php echo $zip_download_text; ?></a></div>
</div>
<?php } ?>

<div class="masonry" id="container">
	<?php
	// Get the images
	$images = getImages($shortname);
	foreach($images as $img) {
		echo "<div class=\"box drop-shadow lifted\">";
		echo "<a href=\"".$domain.$subdirectory.$directory."/download.php?image=".basename($img['file'])."\"><div class='download-text'><img class=\"photo rounded_corner\" src=\"".$domain.$subdirectory.$directory."/thumb.php?src={$img['file']}&w=".$image_width."\" alt=\"\"></div></a>";
		if ($show_info == "yes") {
			// Showing name and file size information below each image
			$filename = str_replace("/egallery/", "", ($img['file']));
			$image_width_negative10 = $image_width - 10;
			echo '<div class="file-details" style="width:'. $image_width_negative10 .'">';
			echo '<div class="image_info">'.$filename.'</div>';
			$rawsize = filesize($filename);
			print ByteSize($rawsize); 
			echo "</td></tr></table>";
			if ($show_advanced_info == "yes") {
				// Showind more advanced details below each image
				if (function_exists('exif_read_data')) {
					// If you run the image through another website or software your EXIF data may be broken
					$image_width_negative10 = $image_width - 10;
					echo '<div width="'. $image_width_negative10 .'">';

					$exif_data = exif_read_data ($filename);
					
					$edate = $exif_data['DateTime'];
						$edate=split(':',str_replace(' ',':',$edate));
						$edate="{$edate[0]}-{$edate[1]}-{$edate[2]} {$edate[3]}:{$edate[4]}:{$edate[5]}";
						$date = date('m-d-Y H:i', strtotime($edate));
					if ($date != "12-31-1969 19:00" && $date != "01-01-1970 00:00"){ echo '<div class="image_info">'.$date.'</div>'; }
					
					list($width, $height, $type, $attr) = getimagesize($filename);
					echo '<div class="image_info">'.$width.'x'.$height.'</div>';

					$emodel = $exif_data['Model'];
						if ($emodel != ""){ echo '<div class="image_info">'.$emodel.'</div>'; }
					$eexposuretime = $exif_data['ExposureTime'];
						if ($eexposuretime != ""){ echo '<div class="image_info">'.$eexposuretime.' sec</div>'; }
					$efnumber = $exif['COMPUTED']['ApertureFNumber'];
						if ($efnumber != ""){ echo '<div class="image_info">f/'.$efnumber.'</div>'; }
					$eiso = $exif_data['ISOSpeedRatings'];
						if ($eiso != ""){ echo '<div class="image_info">ISO '.$eiso.'</div>'; }
					
					echo '</div>';
				}
			}
			echo "</div>";
		}
		echo "</div>\n";
	} 
	?>
</div>

<div class="credits"><a href="http://ericheikkinen.com/egallery-automatic-php-image-galleries/" target="_blank">EGallery - PHP Image Gallery</a></div>

<!-- Jquery Masonry -->
<script src="<?php echo $domain.$subdirectory.$directory; ?>/js/jquery-1.4.2.min.js"></script>
<script src="<?php echo $domain.$subdirectory.$directory; ?>/js/jquery.masonry.min.js"></script>
<script>
  $(function(){

	var $container = $('#container');
  
	$container.imagesLoaded( function(){
	  $container.masonry({
		itemSelector : '.box'
	  });
	});
  
  });
</script>

</body>
</html>
