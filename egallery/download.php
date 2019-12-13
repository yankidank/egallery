<?php
//////////////////////////////////////////////
/////////// EGallery Download File ///////////
//////////////////////////////////////////////
//          Used to download images         //
//////////////////////////////////////////////

// Turn off error reporting to preserve the downloaded files in case of an error
error_reporting(0);

include_once "settings.php";
include_once "functions.php";

// Checking to make sure it's an image file for security purposes
$parts=explode(".", $_GET['image']);
$extension = $parts[count($parts)-1];

if ($_GET['zip'])
{
    $zip = new ZipArchive;
    $tmpfname = tempnam("../tmp", "zip");
    $res = $zip->open($tmpfname, ZipArchive::CREATE);
    if ($res === TRUE) 
    {
		$images = getImages('./');
		foreach($images as $img) 
			$zip->addFile('../'.basename($img['file']),basename($img['file']));
			
		// Get the folder where images are stored for use in the .zip file name
		$subdir = $_SERVER["REQUEST_URI"];
		$subdir2 = str_replace($directory."/download.php?zip=1", "", $subdir);
		$subdirectory = str_replace('/', '', $subdir2);
		
		$filename = $subdirectory.'.zip';
		$file_extension = 'zip';
		$file = $tmpfname;
        $zip->close();
    }
    else
	die ("Zip not supported");
}
elseif (in_array($extension,array('jpg','png','gif')))
{
	$filename = $_GET['image'];
	$file = '../'.$filename;

	// required for IE, otherwise Content-disposition is ignored
	if(ini_get('zlib.output_compression'))
	  ini_set('zlib.output_compression', 'Off');

	// addition by Jorg Weske
	$file_extension = strtolower(substr(strrchr($filename,"."),1));

	if( $filename == "" ) 
	{
	  echo "<html><body>ERROR: download file NOT SPECIFIED. USE force-download.php?file=filepath</body></html>";
	  exit;
	} elseif (strstr($filename,'/') || !file_exists($file)) 
	{
	  echo "<html><body>ERROR: File not found. USE force-download.php?file=filepath</body></html>";
	  exit;
	};
}else{
	echo $bad_extension;
	die;
}

switch( $file_extension )
{
  case "zip": $ctype="application/zip"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/force-download";
}

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers 
header("Content-Type: $ctype");
// change, added quotes to allow spaces in filenames, by Rajkumar Singh
header("Content-Disposition: attachment; filename=\"$filename\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file));
readfile($file);
exit();
?>