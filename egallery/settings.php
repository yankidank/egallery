<?php
//////////////////////////////////////////////
/////////// Egallery Settings File ///////////
//////////////////////////////////////////////
//     Used for configuring the gallery     //
//////////////////////////////////////////////

$password = "test123"; // Password used to upload files using /egallery/upload.php
$image_width = "200"; // Max width of a thumbnail
$show_info = "yes"; // yes = show file name and size below thumbnail
$show_advanced_info = "yes"; // yes = show lots of details about the image
$zip_download = "yes"; // yes = allow users to download a .zip file of all image files
$page_title = ""; // What to use as the <title> tag. If left blank we will use your folder name

/////////////////////
//  Language Items //
/////////////////////

$zip_download_text = "Download Entire Gallery as a .zip File"; // Text used for the download button
$bad_extension = 'Sorry, bad file extension detected. Download denied.'; // Error message when the download url points to a non .jpg file
$no_password = 'No password has been set! Please add a password by editing the settings.php file.'; // Error when there is no upload password set
$password_label = 'Password'; // Label on top of the upload login page
$login_button = 'Login'; // Login button on the login page
$wrong_password = 'Wrong Password! Try again.'; // Wrong upload password entered
$upload_title = 'Image Upload';
$upload_directions = 'Click on the button below to begin uploading image files.';
			
////////////////////////////////////////////////////////////////////////
///// STOP! You probably don't need to continue editing past here! /////
////////////////////////////////////////////////////////////////////////

$error_reporting = "off"; // on = turns error reporting on
$domain = ""; // Domain name (start with http://). If you leave this blank, we will try to figure it out for you
$subdirectory = ''; // The directory where your image gallery exists in relation to your root domain. If you leave this blank, we will try to figure it out for you. Begin with a forward slash. No trailing slash at the end. Example: /demo/sample 
$directory = "/egallery"; // Directory this file is in. Must be sitting in a subdirectory where your images are stored
$imagetypes = array("image/jpeg", "image/gif", "image/jpg", "image/png"); // Array of image types to be allowed
?>