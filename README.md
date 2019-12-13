# egallery
Egallery is a free script that automatically generates image galleries by reading from a directory of image files.
It is designed as a simple way to share image files with clients and give them the ability to download high resolution copies from your own website.

// HOW TO USE //

1. Upload images to a new directory on your web server. For example: YOUR-WEBSITE.COM/sample/
2. Upload the /egallery/ directory to the same subdirectory that you just created on step 1. Example: YOUR-WEBSITE.COM/sample/egallery/
3. CHMOD the /egallery/cache/ directory as well as the contained index.html file to 777.
4. Upload the index.php file included with the download package to the directory you created on step 1.
5. (OPTIONAL) Configure egallery by editing the /egallery/settings.php file.
6. If you renamed or moved egallery to another location, make sure that you update the third line in the index.php file.

Once you have completed the step above, navigate to the image directory from step 1 using your web browser. The first time that you visit this page it may take a little while for the script to generate thumbnail files. After the initial load, those thumbnails will be cached resulting in a faster page load.

// CREDITS //
Jquery : http://jquery.com/
Jquery Masonry : http://masonry.desandro.com/
TimThumb : http://code.google.com/p/timthumb/
Directory List : http://www.the-art-of-web.com/php/dirlist/1/
Convert Byte to MB : http://www.phpfront.com/php/Convert-Bytes-to-corresponding-size/
Force Download : http://elouai.com/force-download.php
Image Upload : www.uploadify.com/

// VERSIONS //
1.0 
 - Initial release
1.1 : March 5, 2012
 - Improved security
 - Added image upload feature
 - Added zip download feature
 - Fixed bug caused by visiting index.php url
1.2 : March 8, 2012
 - Altered the style
 - Added option to display image EXIF details
 
