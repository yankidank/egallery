<?php
//////////////////////////////////////////////////////
/////////////// EGallery Functions File //////////////
//////////////////////////////////////////////////////
// Declares functions and other common expressions  //
//////////////////////////////////////////////////////

include_once "settings.php";

if ($error_reporting != "on"){
	// Turn off error reporting
	error_reporting(0);
}

// Get images in a directory
function getImages($dir) { 
	global $imagetypes;
	
	// Array to hold return value 
	$retval = array(); 
	
	// Add trailing slash if missing
	if(substr($dir, -1) != "/") $dir .= "/"; 
	
	// Full server path to directory 
	$fulldir = "../$dir"; 
	$d = @dir($fulldir) or die("Failed opening directory $dir for reading");
	while(false !== ($entry = $d->read())) {
		// Skip hidden files 
		if($entry[0] == ".") continue; 

		// Check for image files 
		$f = "$fulldir$entry"; 
		list($width, $height, $type, $attr) = @getimagesize($f);
		if (in_array(image_type_to_mime_type($type), $imagetypes))
			$retval[] = array(
				'file' => "/$dir$entry", 
				'size' => getimagesize($f)
			);
	}
	$d->close();
	sort($retval);	
	return $retval;
} 

// Byte to MB conversion
function ByteSize($bytes){
	$size = $bytes / 1024;
	if($size < 1024){
		$size = number_format($size, 2);
		$size .= ' KB';
	} else {
		if($size / 1024 < 1024){
			$size = number_format($size / 1024, 2);
			$size .= ' MB';
		} else if ($size / 1024 / 1024 < 1024) {
			$size = number_format($size / 1024 / 1024, 2);
			$size .= ' GB';
		}
	}
	return $size;
} 

?>