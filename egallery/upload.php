<?php
//////////////////////////////////////////////
//////////// Egallery Upload File ////////////
//////////////////////////////////////////////
//       Upload Images to Your Server       //
//////////////////////////////////////////////

include_once "settings.php";

if ($error_reporting != "on"){
	// Turn off error reporting
	error_reporting(0);
}

if (isset($_POST['Password']) && $_POST['Password'] == $password && (!isset($_COOKIE['password']))){
	// If pass submitted and correct, and no cookie exist, add a cookie for 7 days
	$cookiepass = $_POST['Password'];
	setcookie('password',$cookiepass,time() + (86400 * 7)); // 86400 = 1 day
	$page = $_SERVER['PHP_SELF'];
	header("Refresh: 0; url=$page");
} 

if ($password == ""){
	// No password has been set
	echo '<html><head><link rel="stylesheet" href="style.css" /></head><body class="upload_page upload_page_colors"><div class="login_wrapper"><div class="drop-shadow lifted" id="mainbody">'.$no_password.'</div></div></body></html>';
	die;
} elseif (isset($_COOKIE['password']) && $_COOKIE['password'] == $password ){
	// Everything is cool, now upload something
	
	// Go one directory up, where the images will be stored
	$subdir = $_SERVER["REQUEST_URI"];
	$subdirectory = str_replace($directory."/upload.php", "", $subdir);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>EGallery Image Upload</title>
		<link rel="stylesheet" href="style.css" />
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/swfobject.js"></script>
		<script type="text/javascript" src="js/jquery.uploadify.v2.1.4.js"></script>
		<script type="text/javascript">
		// <![CDATA[
		$(document).ready(function() {
		  $('#file_upload').uploadify({
			'uploader'  : 'uploadify.swf',
			'script'    : 'uploadify.php',
			'cancelImg' : 'cancel.png',
			'folder'    : '<?php echo $subdirectory; ?>',
						  'multi'          : true,
						  'auto'           : true,
						  'fileExt'        : '*.jpg;*.gif;*.png',
						  'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',
						  'queueID'        : 'queue',
						  'checkScript'    : 'check.php',
						  'queueSizeLimit' : 10,
						  'simUploadLimit' : 2,
						  'sizeLimit'   : 2621440,
						  'removeCompleted': false,
						  'onSelectOnce'   : function(event,data) {
							  $('#status-message').text(data.filesSelected + ' files have been added to the queue.');
							},
						  'onAllComplete'  : function(event,data) {
							  $('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
							}
		  });
		});
		// ]]>
		</script>
	</head>
	<body class="upload_page upload_page_colors">
		<div class="login_wrapper"><div class="drop-shadow lifted" id="mainbody">
			<h1><?php echo $upload_title; ?></h1>
			<p><?php echo $upload_directions; ?></p>

			<div id="queue"></div>
				<br /><input id="file_upload" type="file" name="file_upload" />
		</div></div>
		<div class="login_wrapper"><div class="drop-shadow lifted" id="mainbody">
			<div class="upload_footer">
				<p><a href="../">Back to Gallery</a></p><br />
				<p><strong>Please Note:</strong> Make sure that you set the directory permissions for the image gallery to CHMOD 777, otherwise image uploads won't work. 
			</div>
		</div></div>
	</body>
</html>
<?php
}else{
// Password isn't right, so login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>EGallery Image Upload Login</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body class="upload_page upload_page_colors">
		<div class="login_wrapper"><div class="drop-shadow lifted" id="mainbody">
			<h1><?php echo $password_label; ?></h1>
			<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="password" title="Enter your password" name="Password" />
				<input type="submit" name="Submit" value="<?php echo $login_button; ?>" /></p>
			</form>
			<?php if (isset($_POST['Password']) && $_POST['Password'] != $password) { ?>
			<div class="error"><?php echo $wrong_password; ?></div>
			<?php } ?>			
		</div></div>
	<body>
</html>
<?php
}
?> 