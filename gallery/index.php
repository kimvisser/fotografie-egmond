<?php #########################################################################################################
#####                                                                                                     #####
#####  JV2 Quick Gallery                                                     http://quickgallery.jv2.net  #####
#####  Copyright: Joonas Viljanen 2013                                                jv2 at jv2 dot net  #####
#####                                                                                                     #####
       $version = '3.2'; // minor version 3.2.2                                                           #####
/*#############################################################################################################
##                                                                                                           ##
##                       This script is NOT freely available to copy or to distribute.                       ##
##                                                                                                           ##
##   It is only distributed to those who have made a donation towards the project. If you are enjoying the   ##
##      use of it and have received it from somewhere else other than me... You should feel very guilty!     ##
##                                                                                                           ##
###############################################################################################################
## Fugue Icons - Copyright (C) 2010 Yusuke Kamiyamane. All rights reserved.                                  ##
## Licensed under a Creative Commons Attribution 3.0 license. <http://creativecommons.org/licenses/by/3.0/>  ##
###############################################################################################################

  INTRO

  Congrats on getting my one file quick gallery :)
  As you probably know, this file is all you get. It includes everything.
  This file has all the PHP, HTML, CSS, jQuery and embedded images that the gallery needs.

  To get the gallery working with default settings...
  should be as simple as putting it into a directory with some photos on your webserver.

  By default, the gallery now resizes and caches the large view images as well, resizing them to fit to a HD screen.
  This is done so that images are displayed quicker as they are potentially a lot smaller than many pictures even from mobile phones.
  You are welcome to turn this off if you wish to save space.

  For the gallery to function with cached images it must have a sub directory "thumbs" and it must have write permissions to it.
  (The name of this folder can be set in the config.)
  The gallery will attempt to create this for you. Depending on your server settings, you may need to create this yourself.
  The gallery needs the GD package to be installed with PHP for it to be able to generate thumbnails.

  Just read through the setup section and the $config array so you know all the options that are available to you.
  You may also want to have a look at the themes array. 
  
  Examples of things this gallery can do (available in config):
  - change themes
  - resize, crop and watermark images in different ways
  - login for admin area / upload images, create albums and set titles and captions
  - user login for gallery or individual albums
  - display donwload links and exif information
  - show photos with X per page, while allowing viewer to skip through all
  - fit into your own page template - read "Include Mode Setup"

  Some of the options in the config array can be overridden in each individual album.
  This can be done through the admin interface or by manually creating a php file in the folder.
  The admin simply creates a file called config.php which contains a $gallerySetup array which is then merged with the original config.

  If you have any questions or suggestions... Please do not hesitate to email me.
  
  Hope you enjoy the gallery!
  
/////////////////////////////////////////////////////////////////////////////////////
// SETUP
///////////////////////////////////////////////////////////////////////////////////*/


# increase memory limit if you have very large photos and they are not shown
ini_set('memory_limit', '128M');


/*************************************
Admin Security / Login
**************************************
  By default, login is disabled to the admin section of the gallery, you will always need to enable this
  when you get a new gallery file. Be sure to change the admin username and password too.
*************************************/
$galleryUsername = 'admin-username';
$galleryPassword = 'admin-password'; 
# allow login to the gallery admin?
$loginEnabled = false;
# show the login link at the bottom of the page? (else, just learn the url)
$showLoginLink = false; 


/*** Config ***/
$config = array(
  
/*************************************
Album Login - password protection? 
**************************************
  If the normal "username" and "password" are populated, then the gallery will ask the login detail from
  any visitor to view the photos. This can be set here in the code or in the admin options which will write 
  it in the config.php file and override things in this setup - they can of course be setup separately 
  for each album. The login sets a cookie - and the user will only need to login once.
  leave empty to allow normal access 
  - can be overridden in the $gallerySetup array in a config.php file in each folder 
*************************************/
  'username' => '', 
  'password' => '', 

/*************************************
Gallery Appearance / Themes / Options
**************************************
  There are a few themes included in the gallery by default. One of them is preselected for you in the setting below.
  'selectedTheme' => "black", // white, black, simple, simpledark, photo, polaroid or tiles ...
  This will be the theme shown in the gallery when you first load it - unless you have used the theme selector
  in the top right hand corner. This sets a cookie with your selection and overrides the selection in this config.

* Themes Config Override
  ----------------------
  Some Themes are able to override the cookie selection and this is controlled by hiding the theme selector.
  The themes can have sub arrays in them that will override values in the config and thumbSizes.
  (See the example config array in theme "photo" or "tiles".)
*************************************/

  ##### Theme Options #####
  # theme -> options = (white, black, simple, simpledark, photo, polaroid or tiles)
  'selectedTheme' => 'simple', 
  # override the theme selection for any subfolder (e.g. have normal theme in root for albums and have 'photo' theme in subfolder)
  'subFolderTheme' => '',
  # default size of thumbnails (small, medium or large)
  'imgSize' => 'medium', 
  # show image names? (file extensions will be removed and "_" replace by " ")
  # Themes can override this. For example my "photo" theme overrides this setting and sets it to false 
  # because the names would not fit in between the pictures within the layout.
  'displayImgName' => true,
  # add spaces before numbers and camelcase words in file and folder names
  # e.g. "SomeFileFrom2013" => "Some File From 2013"
  'addCamelCaseSpace' => true,
  # force the image name to be shown like the actual file name
  'displayImgNameAsFilename' => false,

  ##### Theme Changer #####
  # Theme changer sets a cookie to select a theme.
  # If you hide the theme selector after using it, the cookie does not get used.
  # Themes you select may already hide the changer for you - have a look if the theme has a "config" array within it.
  # Some themes may be hidden from the visitor view at the top right.
  # By default I do this if the themes are too different from the norm.
  # You can also control which are shown in there yourself.
  'showThemeChanger' => false, 

  # You can decide if you want to show the theme and size change options at the top right or center bottom
  # of the page. Themes may override this setting.
  'showOptionsInFooter' => false, 

  ##### Image Size Changer #####
  # Allow visitor to select the size of thumbs they wish to view (defined options)
  # stored in cookie
  'showImageSizeOptions' => false, 
  

  ##### Navigation #####
  # By default the gallery will show the title of the gallery as well as the path to the current directory.
  # You can change which of these is shown in the config below.
  # show_gallery_title_or_breadcrumbs/true will allow showing both.
  'show_gallery_title_or_breadcrumbs' => true,

  # show links to folders when browsing:
  # show_breadcrumbs/false will hide the path to current folder and leave only title if above is true.
  'show_breadcrumbs' => true,

  # print the breadcrumbs in the footer
  'show_breadbrumbs_in_footer' => false,

  # bread crumb and title path separator #
  'gallery_path_separator' => '&raquo;',

  # First item within a subfolder view = back link
  # In some setups you may not want to show the back links. These are the folder icons with an arrow which will take 
  # you back to the parent directory you came from. You can hide it by setting show_backlink to false.
  # For example, you may prefer to use just either the breadcrumbs or the backlinks.
  'show_backlink' => false,
  
  ##### CSS3 Rounded borders and shadows #####
  # You can turn all the css rounded borders and shadows on or off in the config.
  # These are only visible in decent browsers. If you do not see rounded borders and shadows; I suggest you switch browsers.
  # You can control the size and spacing of all these setting within the theme array of your selected theme.

  # use css3 shadows
  'showShadows' => true,
  # use css3 border radius
  'showRoundedBorders' => false,
  # use css3 border radius on viewer
  'showRoundedViewerBorders' => false,

  ##### New Item highlighting #####
  # You can highlight new items if you wish.
  # These are applied as a css class "newItem" for the parent of the image.
  # not all themes have this option ('item-highlight') defined.

  # highlight new items #
  'highlightNewItems' => false,
  # how many days do you want to highlight a new item for #
  'highlightNewItemDays' => 7,


/*************************************
Image Viewer Options
*************************************/
  # If you are using the view image on page instead of javascript option
  # then you can edit function customCodeContentForImagePageView
  # to add your own custom content like social sharing and comment functionality

  # use javascript overlay image viewer
  'useOverlayJsViewer'=> true,

  ##### Javascript image overlay viewer options #####

  # opacity of the overlay
  'opacity'=>'0.8',
  # time in milliseconds for duration of viewer resize
  'resizeSpeed'=>'200',
  # padding around the image in the viewer
  'borderSize'=>'10',
  # Allow the use of the slideshow feature
  'slideshow' => true,
  # auto start the slideshow
  'slideshowAutoStart' => false,
  # time in milliseconds between each slide
  'slideShowDuration' => '6000',
  # show a link for downloading the image - will force browser to give download prompt
  'downloadLink' => false,
  # show link for showing share this options (you can implement any share stuff yourself in function shareThis)
  'share' => false,
  # Show link for showing Image and EXIF info:
  'imageInfo' => false,
  # Show image filename and location in info:
  'imageInfoFileLoc' => true,
  # Show image last modified time in info:
  'imageInfoModTime' => false,
  # The "exif" option controls whether to show a link in the viewer for loading exif data.
  # When clicked, the viewer will send an ajax request to the gallery and load the exif data separately.
  # Your PHP installation must be compatible and have exif installed with it. 
  # This uses the standard exif_read_data() function.
  # If the exif data had geo data (embedded gps coordinates) in it, then the viewer should also show
  # a link to google maps to the spot the photo was taken at.
  'exif' => true,

  # EXPERIMENTAL VIDEO FEATURE
  # ----- this is likely to change further -----
  # This uses CDN hosted video.js (http://videojs.com/)
  # It searches for video files with formats defined in 'accepted_video' (e.g. mp4)
  # You will need to create a thumbnail for the video named the same as the video file.
  # e.g. if you have "My Video.jpg" it will be linked with "My Video.mp4" if it exists.
  'enableVideo' => false,

  ##### Options for viewing image on page #####

  # show folder images in slider under main image
  'showImageSliderInImgView' => true,
  # show image number out of total under image
  'showImageTotalCounter' => true,

  ##### Common options for both viewers #####

  # show image title in viewer
  'displayImgTitle' => true,
  # show author name on imagas - either default, or set per image through admin or config array
  'displayAuthor' => true,



/*************************************
Folder Thumbnails
**************************************
  You have four options for your folder thumbs:
  
  1) Use auto generated thumbs that will use images from the folder and combine them as small thumbs in the image for the folder.
     You can set the number of how many small thumbs you want in them. e.g. 4,9,12...
     The larger the number, the longer it will take to generate these thumbnails. Size of your original files can be an issue as well.
     If the folder does not contain any (or enough) images - it will scan any subfolders in order and use them in order.

  2) Select a single image from the folder to be used as the default folder image.
     You can use the admin interface to select one, or you can create a text file called "folder.txt" within the folder with the 
     filename of the image you want as default in it.
     For this to work you must have "allowDefaultFolderImages" set to "true".
     (This setting will override the auto generated multi image opnes from above)

  3) You can let the gallery pick the first image from the folder and use that as the folder thumbnail.
     To do this, make sure that "useFirstAsFolderImage" is set to "true" and the above options are "false"
     
  4) if you turn all the above options off, then gallery will default to showing a folder icon.
     You can change this folder icon by using a tool found on my website.
  
  Please note that you will need to manually clear the cache when you change thumbnail settings.
  (delete files from cache folder)

*************************************/
  # creates a collage of small images for the folder thumbnail
  'useTinyThumbsForFolders' => true,
  # number of photos to read from the folder and include (e.g. 4,9,12...)
  # big files and big number = a long time for first image to be created - can be cached
  'maxTinyThumbsForFolders' => 4,
  # this makes the gallery read "folder.txt" file in the subfolder. it should only contain the filename you want to use as the folder image
  'allowDefaultFolderImages' => true,
  # this makes the script find the first image in the subfolder and use it as the folder image -overrides the tinyThumbs
  'useFirstAsFolderImage' => false, 
  # background colour to use for collage thumbnails, in case not enough images are there to fill the whole area
  'folderThumbBgColor' => '#777',


/*************************************
Auto Rotate Images
*************************************/
  # attempt to read EXIF rotation info and rotate any RESIZED image according to that
  # if you want large images roateted, then you must set them to be resized, otherwise they are left untouched 
  'autoRotate' => true,


/*************************************
Crop Thumbnails
*************************************/
  # crops all images to the max width and size 
  # theme can override this. (e.g. theme can set thumbs to be square)
  'cropImages' => false,


/*************************************
Caching and quality
**************************************
  You can turn off the thumbnail caching all together if you wish, but I would not recommend this 
  as it takes a lot longer for all the pages to load. 
  You may change the quality of the thumbnails if you wish - for this to take effect, 
  you may need to clear down the cache folder.
*************************************/
  # save the thumbnails (loads faster after first load - requires write permission to cachefolder)
  'cachethumbs' => true,
  # this is the folder the script will create and save thumbs in
  'cachefolder' => 'thumbs',
  # quality of thumbnails and cached images
  'cachequality' => 75,


/*************************************
Sorting and file names
**************************************
  You can choose whether you want ascending or descending sorting for files and folders...
  (useful when you want alphabetical, or you have date based albums)
  
  The 'ordernumber_separator' and 'ordernumber_separator_img' are something that you can set as you wish.
  By default they are set as two underscrores.
  In this case you can order all your folders and files by naming them like this:
  01__My_Photo.jpg , 02__Another_Photo.jpg , ...
  This would result photos showing as "My Photo" and "Another Photo"
  You can set different separartors for albums and images...
  anything before this will be removed from title.
  So if you have "IMG_6547.jpg" and you set this with just one "_" then your title will be "6547".
*************************************/
  # file sorting asc or desc
  'filesort' => 'desc',
  # folder sorting asc or desc
  'foldersort' => 'asc',
  # order folders with numbers in front of this (and remove from title)
  'ordernumber_separator' => '__',
  # order images with numbers in front of this (and remove from title)
  'ordernumber_separator_img' => '__',
  

/*************************************
Text Options
*************************************/
  # The gallery title shown in the title/breadcrumbs if visible as well as the browser title bar.
  'gallery_page_title' => "Portfolio",
  # If you wish to show the author of the images in the viewer, you can set the default here.
  # This can be overridden in the config.php array through the admin interface.
  'defaultAuthor' => "Fotografie Egmond",
  # text shown when nothing found
  'not_found_msg' => "Dit album bevat (nog) geen afbeeldingen...",
  # text shown when folder not found
  'not_folder_msg' => "Het opgevraagde album bestaat niet...",
  # text shown when folder requires login
  'login_required' => "Om dit album te kunnen bekijken moet u zijn ingelogd...",
  # displayed for a link to download the image if that is enabled
  'txtDownload' => 'Download',
  # displayed for a link to show exif info if that is enabled
  'txtImageInfo' => 'Image info',
  # displayed for a link to hide exif info if that is enabled
  'txtImageInfoHide' => 'Hide info',
  # displayed for a link to show social sharing options
  'txtShare' => 'Share this',
  # displayed for a link to hide social sharing options
  'txtShareHide' => 'Hide sharing',
  # showed in front of authors name if displayed
  'txtAuthor' => 'door',
  # shown in viewer before image count e.g. (Image 8 of 10)
  'txtImage' => 'Foto',
  # shown in viewer between current and total number e.g. (Image 8 of 10)
  'txtOf' => 'van',
  # add description to the top of the album - you can override for specific albums in config file via admin
  'albumDescriptionTop' => '',
  # add description to the bottom of the album - you can override for specific albums in config file via admin
  'albumDescriptionBottom' => '',
  # displayed as links when viewing large images on the page
  'txtNext' => 'Volgende',
  'txtPrev' => 'Vorige',


/*************************************
Paging
*************************************/
  # You can control if paging is on or off and how many images are shown per page.
  # e.g. The "photo" theme overrides these values to ensure an even spread of images that will fit to the layout.
  'paging' => false,
  # limit of items to show per page (10,15,20,25,30...)
  'limit' => 20,
  # show the paging links on top of gallery
  'displayLinksTop' => true,
  # show the paging links on bottom of gallery
  'displayLinksBottom' => true,
  # You can set the number of visible page numbers in the links list (1,3,5,7,9...)
  'showpages' => '5', 
  # let the javascript viewer link to all images in folder...
  # This controls if the viewer is allowed to "go further" than the end of the page.
  # If set to true, the page will load hidden links to the images from all previous and following pages, 
  # so that the viewer is able to slideshow or skip through all the images no matter what page they are on.
  'jsViewerFolderAll' => true, 

  
/*************************************
Image Resizing (Large Photos / Originals)
*************************************/
  # Control if uploaded images should be resized 
  #  - does not save original size on server - it resizes on the fly and saves the smaller version
  #  - use resizeLargeView to keep originals and resize just for viewing
  #  - if this is set to true, you can set resizeLargeView to false. no point to have it on.
  'resizeUploadedImages' => false, 
  # Make smaller copies of the originals in the thumb cache
  # and show them in the  viewer instead of originals 
  # (you can enable download link to give access to the full size)
  'resizeLargeView' => true,
  # Set the jpg quality for the original image resize 0-100
  'resizeQuality' => 90,
  # save the resizedLargeView images to cache - set to false if you just want to do on the fly when needed
  'cacheLargeView' => true,
  # Set the maximum width and height for the resized original image
  # - these are the maximun height and width, to make them fit into a specific area.
  # - aspect ration is always kept - smaller images will not be upscaled
  # - you can set same width and height to control the size in the same aspect ratio for portrait and landscape
  'resizeMaxSize' => array('width'=>1920,'height'=>1080),


/*************************************
Watermarking
**************************************
# Set the path to the image you want to use as a watermark. like your logo, or some text.
# Not all types of images work very well with watermarking.
# I suggest using a black on white JPG with mode '0' for best results 
# - but you are welcome to experiment with different files and modes. (as well just plain transparent PNG)
# - GIFs may not work well with all the "modes". experiment. (or just use a plain JPG / transparent PNG)
# You can also set which corner, and how far from the edge, the watermark will be placed... as well as controlling how visible it is (opacity).
#
# To Test Watermarking:
# While messing around with the watermarking, you should open a image direct in the browser with a URL like this:
# index.php?source=imageName.jpg&size=original
# Then you can make changes and refresh as many times as you wish, without constantly deleting cache etc.
#
*************************************/
  # You can add a watermark to any uploaded images if you set this to true
  'watermarkUploadedImages' => false,
  # add a watermark (image or text) to existing images (upload setting should be false)
  'watermarkImages' => false,
  # add a watermark to thumbnails (set to false to only watermark the large one)
  'watermarkThumbnailImages' => true,

  ##### Image Watermarking #####
  # if you want intelligent light/dark watermark based on image colour, 
  # use black on white image with mode auto and overlayPNG false
  'watermarkImage' => array(
      # path to watermark image (transparent PNG works - or also black on white JPG or GIF with variosu settings)
      # (in this example you could add the 'watermark' folder to the ignore list, so it is not shown in gallery)
      'path' => 'watermark/watermark.jpg',
      # Position: like CSS background position takes 'top','bottom','left','right' and 'center'... e.g. "bottom right"
      # also works with (X,Y) values with 'px' and '%' like "50% 50%", "20px 20px" or "20px 50%"
      'position' => 'bottom right',
      # Position: distance in px from edge of the image
      'margin' => 5,
      # assume PNG files have transparency etc. ignore other settings below (opacity, mode, etc) and just overlay the PNG on top
      'overlayPNG' => false,
      # opacity of watermark (0-100) - control how visible it is
      'opacity' => 40,
      # Watermarking mode - the type of image overlay
      # 0=AUTO 1=BURN 2=DODGE 3=PASTE 4=AVERAGE 5=AVG-FADE-LOGO 6=AVG-FADE-BG 7=LIGHTEN
      # ('auto' switches between 'burn and 'dodge' depending on average image colour)
      'mode' => 0,
      # sets the average color for image bg to be treated as dark or light 0-255 -- (used in the 'auto' mode check)
      'darknessThreshold' => 100,
    ),
  
  ##### Text Watermarking #####
  # use font to create text instead of an image
  'watermarkTextOnly' => false,
  'watermarkText' => array(
      # your copyright text to put on images
      'text' => '© jv2.net',
      # path to a TTF font - copy a TTF font to your server in a folder you can access
      'font' => 'watermark/verdana.ttf',
      # font size for copyright text
      'fontSize' => 30,
      # HEX color of text - leave blank for AUTOMATIC darken or lighten according to background
      'color' => '',
      # Position: like CSS background position takes 'top','bottom','left','right' and 'center'... e.g. "bottom right"
      # also works with (X,Y) values with 'px' and '%' like "50% 50%", "20px 20px" or "20px 50%"
      'position' => 'bottom right',
      # Position: distance in px from edge of the image
      'margin' => 10,
      # Angle of copyright text (range between 0-90 work for all positions, for others you will need to manually position)
      'angle' => 0,
      # Distance of shadow in px - 0 for no shadow
      'shadowDistance' => 0,
      # HEX color of shadow - leave blank for AUTOMATIC darken or lighten according to background
      'shadowColor' => '',
      # sets the average color for image bg to be treated as dark or light 0-255 -- (used in the 'auto' mode check)
      'darknessThreshold' => 100,
      # this sets the amount of auto color change for text  0-255
      'autoColorText' => 100,
      # this sets the amount of auto color change for shadow 0-255
      'autoColorShadow' => 70,
    ),



/*************************************
Miscellaneous Options
*************************************/
  # These are the image file extensions the gallery scans for.
  # If you want to add others, you will also need to edit the create thumb functionality to add that type.
  'accepted_img' => array( 'jpg', 'jpeg', 'gif', 'png' ),
  # These are the video file extensions the gallery scans for.
  # If you want to add others, you will also need to make sure the video player handles them
  'accepted_video' => array( 'mp4' ),
  # HTML header: charset
  'charset' => 'ISO-8859-1', 
  # HTML header: page language
  'pagelang' => 'en',
  # Often the PHP setups require you to define the time zone you are in - defaulted to 'Europe/London'.
  # For a list of PHP time zones, visit: http://php.net/manual/en/timezones.php
  'timeZone' => 'Europe/London',


/*************************************
Admin Options
*************************************/
  # Control if the user can upload images when logged in the admin interface
  'allowImageUpload' => true, 
  # Control if the user can delete images when logged in the admin interface
  'allowImageDelete' => true, 
  # Control if the user can create folders when logged in the admin interface
  'allowAlbumCreation' => true, 
  # Control if the user can delete folders (and images within them) when logged in the admin interface
  'allowAlbumDelete' => true, 
  # Control if the user can delete the whole gallery when logged in the admin interface
  'allowGalleryDelete' => false,
  # chmod value for setting write permissions for uploaded images and folders created from admin. Set to null to disable.
  'newFileAndDirChmod' => '0777',

);


/*************************************
Gallery Include Mode Setup
-- Standalone Gallery OR in YOUR TEMPLATE as an included php file
*************************************/

##### $includemode #####
# if you wish to use the gallery within an existing website (in the middle of your template) then set this true.
# You should still keep your index.php within the folder you have your images in. (e.g. gallery/index.php) 
# DO NOT rename this file. 
# The folder you set your gallery and index file in should be "below" the directory the page you want it on 
# is in. (e.g. page "pages/photos.php" and then gallery in "pages/gallery/index.php") 
# then use php include("gallery/index.php");  # in your own code.
# (Make sure you set all 4 options correctly for the include mode to work in your environment)

$includemode = true;

##### $galleryfolder #####
# Setting for sub directory where images and index are (MUST END IN /)
# You will need to set this correctly if you are using the include mode.
# (for the example setup explained above, this would be set as "gallery/")
# this must be a subfolder you can access from the url where you want to show the gallery

$galleryfolder = 'gallery/';

##### $includeJQuery #####
# If you are using the gallery as an "include" within your own website, and you already use jQuery,
# set this to false, so that we don't load jQuery twice for you.

$includeJQuery = false;

##### $urlinclude #####
# In some cases, you may be loading the gallery via a get paremeter - not just a standalone page.
# e.g. "page.php?view=gallery" instead of "gallery.php"
# In this case (for this example) set this option to: "view=gallery&"
# $urlinclude = "name=value&"

$urlinclude = ''; 



/*************************************
Misc Gallery Setup
*************************************/

##### Directory Scan #####
# use php5 scandir function to read folder contents if it is available
# by default the gallery now uses php5 scandir() function 
# you can turn off this here and it will default to the old dir() and while ->read().

$useScandirIfAvailable = true;

##### Ignore Folder List #####
# do not load these folders into the gallery
# if you wish to hide folders in your images directory (or sub directories) list them in this array with the 
# path relative to the main gallery image folder
# e.g. array('folderNameToIgnore','subFolder/folderNameToIgnore');

$ignoreFolders = array('watermark');


##### Special Characters #####
# "foreign" characters in file names
# turn these off if you are experiencing issues with images...
# or add to the map if you need more characters not to go through rawurlencode
$unEncodeChars = true;
$unEncodeCharsMap = array(
  '%E5'=>'å',
  '%E4'=>'ä',
  '%F6'=>'ö'
  );



/*************************************
Thumbnail Sizes
*************************************/
# This array defines the size options available for the gallery.
# They can also be overridden inside the theme.
# Default size for the gallery to show on first load must be set in the config array.
# if you mess about with these, you should be prepared to modify the themes as well if required

$thumbSizes = array(
  'large' => array("width"=>200,"height"=>133),
  'medium' => array("width"=>160,"height"=>107),
  'small' => array("width"=>100,"height"=>66),
);

# Size of folder icon - this is used in calculating positions etc when required
$folderIconSize = array("width"=>160,"height"=>133);




/*************************************
Theme Config
*************************************/
$themes = array(
  
  'simple'=> array(
    'name'=>'Simple Theme',
    'show'=>true,
    'theme-color'=>'#777',
    'gallery-padding'=>'0px 0px',
    'background-color'=>'#777',
    'overlay-background-color'=>'#000',
    'viewer-background-color'=>'#fff',
    'viewer-border-radius'=>'10px',
    'font-family'=>"'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif",
    'text-color'=>'#222',
    'header-text-color'=>'#222',
    'header-link-hover'=>'#222',
    'footer-text-color'=>'#222',
    'paging-link-text-color'=>'#222',
    'item-background-color'=>'#777',
    'folder-background-color'=>'#777',
    'item-background-image'=>'',
    'folder-background-image'=>'',
    'item-text-color'=>'#222',
    'folder-text-color'=>'#222',
    'item-border'=>'0px solid #888888',
    'folder-border'=>'0px solid #888888',
    'item-border-totalwidth'=>0, // IE7 fix - total width of borders
    'item-shadow'=>'0,0,0',
    'folder-shadow'=>'0,0,0',
    'item-shadow-opacity'=>'0.7',
    'folder-shadow-opacity'=>'0.9',
    'folder-font-weight'=>'bold',
    'folder-font-style'=>'italic',
    'button-next'=>'next',
    'button-prev'=>'prev',
    'loading-icon'=>'ajax-loading',
    'img-name-display-inside'=>false,
    'define-item-width'=>true,
    'item-highlight' => ' #gJv2 .newItem .imagetitle {color:#222;} ',
    'size-specific' => array(
      'small'=> array(
        'item-margin'=>'0 25px 15px 0',
        'item-padding'=>'0px',
        'item-padding-totalwidth'=>0, // IE7 fix - total width of padding
        'item-font-size'=>'8px',
        'item-border-radius'=>'0px',
        'item-shadow-position'=>'0px 0px 0px 0px',
        'item-image-shadow-position'=>'4px 3px 4px 0px',
        'title-shown-inside'=>'padding-top:4px',
        'title-shown-outside'=>'padding-bottom:4px;',
        ),
      'medium'=> array(
        'item-margin'=>'0 32px 12px 0',
        'item-padding'=>'0px',
        'item-padding-totalwidth'=>0, // IE7 fix - total width of padding
        'item-font-size'=>'12px',
        'item-border-radius'=>'0px',
        'item-shadow-position'=>'0px 0px 0px 0px',
        'item-image-shadow-position'=>'4px 5px 6px 0px',
        'title-shown-inside'=>'padding-top:10px',
        'title-shown-outside'=>'padding-bottom:10px;',
        ),
      'large'=> array(
        'item-margin'=>'0 40px 26px 0',
        'item-padding'=>'0px',
        'item-padding-totalwidth'=>0, // IE7 fix - total width of padding
        'item-font-size'=>'12px',
        'item-border-radius'=>'0px',
        'item-shadow-position'=>'0px 0px 0px 0px',
        'item-image-shadow-position'=>'4px 7px 8px 0px',
        'title-shown-inside'=>'padding-top:16px',
        'title-shown-outside'=>'padding-bottom:16px;',
        ),
      ),
    )
  
  );


##### Development Mode #####
# flags for development use only

# this turns on dev mode, and for example, doesn't output image headers for thumbs
define('DEV_MODE',false);

# this loads external JS file for gallery (if you have it available) "gallery.js"
define('DEV_MODE_JS',false);



#
#
#
#
#
#
#
#
#
#
# End of settings and themes.
#
#
#
#
#
#
#
#
#
#


/////////////////////////////////////////////////////////////////
// 
// The Gallery code starts here.
//
/////////////////////////////////////////////////////////////////

if(function_exists("date_default_timezone_set"))
  date_default_timezone_set($config['timeZone']);

if($includemode)
{
  $config['cachefolderSavePath'] = str_replace($galleryfolder,'',$config['cachefolder']);
}
else
{
  $galleryfolder = '';
  $config['cachefolderSavePath'] = $config['cachefolder'];
}

themeConfig();

if(!empty($config['subFolderTheme']) && (isset($_GET['f']) || (isset($_GET['source']) && strpos($_GET['source'],'/'))  || (isset($_GET['folder']) && strpos($_GET['folder'],'/'))      ) )
{
  $config['selectedTheme'] = $config['subFolderTheme'];
  themeConfig();
}
elseif($config['showThemeChanger'] && isset($_COOKIE['theme']))
{
  if(key_exists($_COOKIE['theme'],$themes))
    $config['selectedTheme'] = $_COOKIE['theme'];
  themeConfig();
}
if($config['showImageSizeOptions'] && isset($_COOKIE['size']))
{
  if($_COOKIE['size']=="large")
    $config['imgSize'] = "large";
  elseif($_COOKIE['size']=="medium")
    $config['imgSize'] = "medium";
  elseif($_COOKIE['size']=="small")
    $config['imgSize'] = "small";
}


$maxthumbwidth = $thumbSizes[$config['imgSize']]['width'];
$maxthumbheight = $thumbSizes[$config['imgSize']]['height'];

$fIconXratio = $maxthumbwidth / $folderIconSize['width'];
$fIconYratio = $maxthumbheight / $folderIconSize['height'];

if($fIconXratio < $fIconYratio)
  $restrictIconWidth = true;
else
  $restrictIconWidth = false;
  

if(!empty($galleryfolder))
{
  if(!endsWithSlash($galleryfolder)) $galleryfolder .= '/';
  $config['cachefoldername'] = $config['cachefolder'];
  if(!isset($_GET['source']))
    $config['cachefolder'] = $galleryfolder.$config['cachefolder'];
}

$self = $_SERVER['PHP_SELF']."?".$urlinclude;
$getimgurl = $galleryfolder."?";


$loggedIn = false;
if($loginEnabled)
{
  if( isset($_COOKIE['login']) && $_COOKIE['login'] == md5($galleryUsername.$galleryPassword) )
    $loggedIn = true;
}


function themeConfig()
{
  Global $config,$themes,$thumbSizes;
  
  if(key_exists('config',$themes[$config['selectedTheme']]))
    $config = array_merge($config,$themes[$config['selectedTheme']]['config']);
  if(key_exists('thumbSizes',$themes[$config['selectedTheme']]))
    $thumbSizes = array_merge($thumbSizes,$themes[$config['selectedTheme']]['thumbSizes']);

}




/////////////////////////////////////////////////////////////////
// Page CSS
/////////////////////////////////////////////////////////////////

function pageCSS()
{
  Global $config,$themes,$maxthumbwidth,$maxthumbheight,$getimgurl,$thumbSizes,$includemode;
  
  $theme = $themes[$config['selectedTheme']];
  $size = $themes[$config['selectedTheme']]['size-specific'][$config['imgSize']];
  
  $css = '';
  
  if(!$includemode)
  {
    $css.="
  body {
    margin:0px;padding:0px;
    background-color:".$theme['background-color'].";
    color:".$theme['text-color'].";
    font-family:".$theme['font-family'].";
    ".(isset($theme['background-image'])?'background-image:url('.$getimgurl.'img='.$theme['background-image'].');':'')."
    ".(isset($theme['background-position'])?'background-position:'.$theme['background-position'].';':'')."
    ".(isset($theme['background-repeat'])?'background-repeat:'.$theme['background-repeat'].';':'')."
  }
    ";
  }
  
  $css.= "
  /* [oypo / foundation modification]
  #gJv2 a { outline: 0; color:".$theme['text-color']."; }
  */
  #gJv2 #galleryPage {
    color:".$theme['text-color'].";
    font-family:".$theme['font-family'].";
    margin: 0px; padding:".$theme['gallery-padding'].";
  }
  /* [oypo / foundation modification]
  #gJv2 #header {
    float:left;margin:0px; padding:20px 20px 10px 20px;
    color:".$theme['header-text-color']."; font-size:24px; line-height:24px; text-align:left; letter-spacing:2px;
  }
  #gJv2 #header a { color:".$theme['header-text-color']."; text-decoration:none;}
  #gJv2 #header a:hover { color:".$theme['header-link-hover'].";}
  */
  #gJv2 #footerBreadcrumbs {
    text-align:center;  
  }
  
  #gJv2 #albumDescriptionTop , #gJv2 #albumDescriptionBottom {
    padding:10px 20px 10px 20px;
  }

  #gJv2 #options {
    float:right;
    margin:20px;
  }
  #gJv2 #optionsFooter {
  margin:5px 0px;
  }
  #gJv2 .themeSelector {
    font-size:0px;
    line-height:0px;
    display:block;
    float:right;
    width:10px; 
    height:10px;
    padding:0px;
    text-decoration:none;
    border:1px solid #777;
    margin-left:2px;
  }
  #gJv2 #optionsFooter .themeSelector {
    display:inline-block;float:none;
  }
  ";
  if($config['showRoundedBorders'])
  {
    foreach($themes as $th => $ths)
      $css.=" #gJv2 #theme-".$th." { background-color:".$ths['theme-color']."; } ";
  }
  $css.="
  
  #gJv2 #sizeLarge,#gJv2 #sizeMedium,#gJv2 #sizeSmall {
    font-size:0px;
    line-height:0px;
    display:block;float:right;
    padding:0px;margin-left:5px;
    text-decoration:none;
    background-color:#777;
  }
  #gJv2 #sizeLarge { width:12px; height:12px; font-size:0;line-height:0;margin-right:10px;}
  #gJv2 #sizeMedium { width:9px; height:9px; margin-top:3px; font-size:0;line-height:0;}
  #gJv2 #sizeSmall { width:6px; height:6px; margin-top:6px; font-size:0;line-height:0;}
  
  #gJv2 #optionsFooter #sizeLarge, #gJv2 #optionsFooter #sizeMedium, #gJv2 #optionsFooter #sizeSmall {
    float:none;
    display:inline-block;
  }
  #gJv2 #optionsFooter #sizeLarge {
    margin-right:0px;
  }
  ";
  if(!key_exists('doNotCenterAlignThumbs',$config) || $config['doNotCenterAlignThumbs']==false)
  {
  $css.="
  #gJv2 .imgWrap {
  width:".$thumbSizes[$config['imgSize']]['width']."px;
  height:".$thumbSizes[$config['imgSize']]['height']."px;
  text-align:center;
  }
  ";
  }
  $css.="
  #gJv2 #gFooter {
    height:30px; 
    margin:20px; 
    padding:2px 8px 0px 8px;
    color:".$theme['footer-text-color']."; 
    font-size:10px; 
    text-align:center; 
    letter-spacing:1px;
  }
  #gJv2 #gFooter a { color:".$theme['footer-text-color']."; text-decoration:none;}
  
  #gJv2 .item {
    ".((!$config['useOverlayJsViewer'] && isset($_GET['i']))?'display:inline-block;':'float:left;')."
    margin:".$size['item-margin'].";
    ";
  if($theme['define-item-width']) 
  {
  $css.="
    width:".($thumbSizes[$config['imgSize']]['width']+$size['item-padding-totalwidth']+$theme['item-border-totalwidth'])."px;
  ";
  }
  if($config['showShadows'])
  {
  $css.="
    box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
  ";
  }
  if($config['showRoundedBorders'])
  {
    $css.="
    -moz-border-radius:".$size['item-border-radius'].";
    -webkit-border-radius:".$size['item-border-radius'].";
    border-radius:".$size['item-border-radius'].";
    ";
  }
  $css.="
  }

  #gJv2 .folder {
    ";
  if($config['showShadows'])
  {
  $css.="
    box-shadow: ".$size['item-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
  ";
  }
  if($config['showRoundedBorders'])
  {
    $css.="
    -moz-border-radius:".$size['item-border-radius'].";
    -webkit-border-radius:".$size['item-border-radius'].";
    border-radius:".$size['item-border-radius'].";
    ";
  }
  $css.="
  }

  #gJv2 .image-thumbnail {
    color:".$theme['item-text-color'].";
    text-align:center; margin:0px; border:".$theme['item-border'].";
    background: ".$theme['item-background-color']." url(".$getimgurl."img=".$theme['item-background-image'].") top left no-repeat;
    padding:".$size['item-padding'].";
    ";
  if($config['showRoundedBorders'])
  {
    $css.="
    -moz-border-radius:".$size['item-border-radius'].";
    -webkit-border-radius:".$size['item-border-radius'].";
    border-radius:".$size['item-border-radius'].";
    ";
  }
  $css.="
  }
  
  #gJv2 .folder-thumbnail {
    color:".$theme['folder-text-color'].";
    font-weight:".$theme['folder-font-weight'].";
    font-style:".$theme['folder-font-style'].";
    text-align:center; margin:0px; border:".$theme['folder-border'].";
    background: ".$theme['folder-background-color']." url(".$getimgurl."img=".$theme['folder-background-image'].") top left no-repeat;
    padding:".$size['item-padding'].";
    ";
  if($config['showRoundedBorders'])
  {
    $css.="
    -moz-border-radius:".$size['item-border-radius'].";
    -webkit-border-radius:".$size['item-border-radius'].";
    border-radius:".$size['item-border-radius'].";
    ";
  }
  $css.="
  }
  
  #gJv2 .gImg {
  ";
  if($config['showShadows'])
  {
  $css.="
    box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
  ";
  }
  $css.="
  }
  #gJv2 .gFolderImg {
  ";
  if($config['showShadows'])
  {
  $css.="
    box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['folder-shadow'].",".$theme['folder-shadow-opacity'].");
  ";
  }
  $css.="
  }
  #gJv2 .galleryimage a { color:#fff; }
  #gJv2 .galleryimage .loading {
    height:".$maxthumbheight."px;
    width:".$maxthumbwidth."px;
    background: url(".$getimgurl."img=".$theme['loading-icon'].") 50% 50% no-repeat;
  }
  #gJv2 .imagetitle { 
    text-align:center; width:".$maxthumbwidth."px; margin:0 auto; overflow:hidden; text-overflow:ellipsis;
    font-size:".$size['item-font-size'].";
    ".(($themes[$config['selectedTheme']]['img-name-display-inside'])?$size['title-shown-inside']:$size['title-shown-outside'])."
  }
  #gJv2 #pageLinks { height:20px; color:".$theme['paging-link-text-color']."; font-size:12px; text-align:center; clear:both; }
  #gJv2 #pageLinks a { color:".$theme['paging-link-text-color']."; text-align:center; }
  #gJv2 .hidden { display:none; }
  
  #gJv2 .defaults {
    display:inline-block;
    padding:1px 3px;
    cursor:pointer;
  }
  #gJv2 .defaultUnchecked {
    background-color:#0a0;
    color:#000;
  }
  #gJv2 .defaultChecked {
    background-color:#a00;
    color:#fff;
  }
  #gJv2 .columnLayoutTable {
    border-collapse:collapse; 
    margin:0 auto;
  }
  #gJv2 .columnLayoutTable td {
    vertical-align:top;
    width:".($thumbSizes['large']['width']+10)."px;
    border-spacing:0px; 
  }

  #gJv2 #imgPageView {
    text-align:center;
    padding-bottom:10px;
  }
  #gJv2 #imgPageView img {
    color:".$theme['item-text-color'].";
    text-align:center; margin:0px; border:".$theme['item-border'].";
    background: ".$theme['item-background-color']." url(".$getimgurl."img=".$theme['item-background-image'].") top left no-repeat;
    padding:".$size['item-padding'].";
    ";
  if($config['selectedTheme']=='polaroid')
    $css.="padding-bottom:40px;";
  if($config['showRoundedBorders'])
  {
    $css.="
    -moz-border-radius:".$size['item-border-radius'].";
    -webkit-border-radius:".$size['item-border-radius'].";
    border-radius:".$size['item-border-radius'].";
    ";
  }
  if($config['showShadows'])
  {
  if($size['item-shadow-position']==0)
  $css.="
    box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-image-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
  ";
  else
  $css.="
    box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -moz-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
    -webkit-box-shadow: ".$size['item-shadow-position']." rgba(".$theme['item-shadow'].",".$theme['item-shadow-opacity'].");
  ";
  }
  $css.="
  }
  #gJv2 #imgPageViewFooter {
    margin:0 auto 20px auto;
  }
  #gJv2 #imgPageViewCount {
    text-align:center;
    margin:0 80px;
    font-size:12px;
  }
  #gJv2 #imgPageViewSlider {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
  }
  #gJv2 #imgPageViewTitle {
    padding-top:10px;
    text-align:center;
    font-size:20px;
  }
  #gJv2 #imgPageViewAuthor {
    text-align:center;
    font-size:12px;
  }
  #gJv2 #imgPageViewCaption {
    text-align:center;
    font-size:12px;
  }
  ";
    
  if($config['highlightNewItems'] && isset($theme['item-highlight']))
    $css.= $theme['item-highlight'];

  $css = str_replace(array("\n", "\r", "\t"), '', $css);
  return $css;
}

/////////////////////////////////////////////////////////////////
// Gallery Header and Footer
/////////////////////////////////////////////////////////////////

function printHeader()
{ 
  Global $config,$themes, $getimgurl , $includemode, $includeJQuery;
  
  $theme = $themes[$config['selectedTheme']];
  
$galleryPath = getBreadcrumbs();

$header = '';
if(!$includemode)
{
$header.= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="'.$config['pagelang'].'" xml:lang="'.$config['pagelang'].'">
<head>
<title>'.strip_tags($galleryPath).'</title>
<meta http-equiv="Content-Type" content="text/html;" charset="'.$config['charset'].'" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="imagetoolbar" content="false" />
';
}

if($includeJQuery)
  $header.= '<script type="text/javascript" src="'.$getimgurl.'js=jquery"></script>';
  
$header.= '
<script type="text/javascript" src="'.(DEV_MODE_JS?'gallery.js':$getimgurl.'js=js_viewer').'"></script>
<style type="text/css">
'.pageCSS().overlayCSS().'
</style>
';

if($config['enableVideo'])
{
  $header.= '
<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/c/video.js"></script>
  ';
}

if(isset($theme['externalCSS']))
  $header.= $theme['externalCSS'];

if(!$includemode)
{
$header.= '
</head>
<body>
';
}

$header.= '<div id="gJv2">
';

if($config['show_gallery_title_or_breadcrumbs'])
  $header.= '<div id="header">'.$galleryPath.'</div>';

if(($config['showThemeChanger'] || $config['showImageSizeOptions']) && !$config['showOptionsInFooter'] )
{
  $header.= '<div id="options">';

  if($config['showThemeChanger'])
    $header.= themeChangeLinks();
  
  if($config['showImageSizeOptions'])
    $header.= imageSizeOptionLinks();
  
  $header.= '</div>';
}

$header.= '<div style="clear:both;"></div>';

if(!isset($_GET['setup']) && isset($config['albumDescriptionTop']) && !empty($config['albumDescriptionTop']))
  $header.= '<div id="albumDescriptionTop">'.stripslashes($config['albumDescriptionTop']).'</div>';

$header.= '
<div id="galleryPage">
';

return $header;
}

function printFooter()
{
  Global $config , $version, $version_js_viewer,$showLoginLink, $loggedIn ,$galleryPage, $includemode , $self;
  
$footer = '<div style="clear:both;"></div>
</div>';

if(!isset($_GET['setup']) && isset($config['albumDescriptionBottom']) && !empty($config['albumDescriptionBottom']))
  $footer.= '<div id="albumDescriptionBottom">'.stripslashes($config['albumDescriptionBottom']).'</div>';

if($config['show_breadbrumbs_in_footer'])
  $footer.= '<div id="footerBreadcrumbs">'.getBreadcrumbs().'</div>';

$footer.= '
<div id="gFooter"><a target="_blank" href="http://quickgallery.jv2.net">JV2 Quick Gallery '.$version.'</a><br/>';

$flink = "&f=".(isset($galleryPage['f'])?$galleryPage['f']:'');

if($showLoginLink)
{
  if($loggedIn)
    $footer.= '<a href="'.$self.'setup=imgtext'.$flink.'">setup</a> - ';
  
  if(isset($_COOKIE['login']) || isset($_COOKIE['userlogin']))
    $footer.= '<a href="'.$self.'login=false'.$flink.'">logout</a>';
  else
    $footer.= '<a href="'.$self.'login=true'.$flink.'">login</a>';
}
elseif(isset($_COOKIE['userlogin']))
  $footer.= '<a href="'.$self.'login=false'.$flink.'">logout</a>';
  

if(($config['showThemeChanger'] || $config['showImageSizeOptions']) && $config['showOptionsInFooter'] )
{
  $footer.= '<div id="optionsFooter">';

  if($config['showThemeChanger'])
    $footer.= themeChangeLinks();
  
  if($config['showImageSizeOptions'])
    $footer.= imageSizeOptionLinks();
  
  $footer.= '</div>';
}

$footer.= '</div>';

if($config['useOverlayJsViewer'])
  $footer.='<script type="text/javascript"> $(function() { $(".gItem").galleryViewer(); });</script>';


$footer.='</div>
';
    
if(!$includemode)
{
$footer.= '
</body>
</html>
';
}

return $footer;
}

function themeChangeLinks()
{
  global $themes, $getimgurl;
  $links = '';
  foreach($themes as $theme => $ts)
  {
    if($ts['show'])
      $links.= '<a href="'.$getimgurl.'theme='.$theme.'" class="themeSelector" id="theme-'.$theme.'" title="'.$ts['name'].'"></a>';
  }
  return $links;
}

function imageSizeOptionLinks()
{
  global $getimgurl;
  return '<a href="'.$getimgurl.'size=large" id="sizeLarge" title="Large Images"></a><a href="'.$getimgurl.'size=medium" id="sizeMedium" title="Medium Images"></a><a href="'.$getimgurl.'size=small" id="sizeSmall" title="Small Images"></a>';
}

/////////////////////////////////////////////////////////////////
// Javascript Overlay CSS
/////////////////////////////////////////////////////////////////

function overlayCSS()
{
  Global $getimgurl, $config, $themes;
  
  $theme = $themes[$config['selectedTheme']];
  
$css = "

#gJv2overlay {
  z-index:1000;
  position:absolute;
  top:0; left:0;
  width:100%;
  height:100%;
  background-color:".$theme['overlay-background-color'].";
  display:none;
}
#gJv2imgViewer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1001;
  text-align: center;
  line-height: 0;
}
#gJv2imgViewer a img { border: none; }
#gJv2imgViewer #imgDivWrap {
  position: relative;
  background-color: ".$theme['viewer-background-color'].";
  display:inline-block;
  width:250px;
  margin: 0 auto;
  ";
  if($config['showRoundedViewerBorders'])
  {
    $css.="
    -webkit-border-radius: ".$theme['viewer-border-radius'].";
    -moz-border-radius: ".$theme['viewer-border-radius'].";
    border-radius: ".$theme['viewer-border-radius'].";
    ";
  }
  $css.="
}
#gJv2imgViewer #imgDiv { padding: 20px; width:250px; height:250px; }
#gJv2imgViewer #imgImg { margin: 0 auto 10px 10px; }
#gJv2imgViewer #imgLoading {
  position: absolute;
  top: 40%;
  left: 0%;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
  background: transparent url('".$getimgurl."img=".$theme['loading-icon']."') 50% 50% no-repeat;
}
#gJv2imgViewer #imgNav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}
#gJv2imgViewer #imgDivWrap > #imgNav { left: 0; }
#gJv2imgViewer #imgNav a { outline: none;}
#gJv2imgViewer #imgPrevious, #gJv2imgViewer #imgNext {
  width: 49%;
  height: 100%;
  zoom: 1;
  display: block;
}
#gJv2imgViewer #imgPrevious { 
  left: 0; 
  float: left;
}
#gJv2imgViewer #imgNext { 
  right: 0; 
  float: right;
}
#gJv2imgViewer #imgInfoBox {
  font: 12px ".$theme['font-family'].";
  background-color: ".$theme['viewer-background-color'].";
  margin: 30px auto 0 auto;
  line-height: 1.4em;
  overflow: auto;
  width: 100%;
  padding: 0 10px 10px 10px;
}
#gJv2imgViewer #imgInfoWrap {
  padding: 0 0 0 10px; 
  color: #666; 
}
#gJv2imgViewer #imgInfoWrap #imgInfo { 
  width: 70%; 
  float: left; 
  text-align: left; 
} 
#gJv2imgViewer #imgTitle { font-weight: bold; }
#gJv2imgViewer #imgCaption {
  display:block;
}
#gJv2imgViewer #imgAuthor {
  font-style:italic;
  font-size:10px;
  color:#666;
}
#gJv2imgViewer #imgCount {
  display: inline-block; 
  clear: left; 
}   
#gJv2imgViewer #viewExif , 
#gJv2imgViewer #viewShare ,
#gJv2imgViewer #downloadLink {
  display: inline-block;
  padding-left:10px;
} 
#gJv2imgViewer #viewExif a , #gJv2imgViewer #viewExif a:hover ,
#gJv2imgViewer #viewShare a , #gJv2imgViewer #viewShare a:hover,
#gJv2imgViewer #downloadLink a , #gJv2imgViewer #downloadLink a:hover {
  color:#666;
}
#gJv2imgViewer #viewerClose {
  width: 16px; 
  float: right;
  cursor:pointer;
  margin-left:5px;
  margin-right:10px;
}
#gJv2imgViewer #imgSlideShow {
  width: 16px; 
  float: right;
  cursor:pointer;
  margin-left:5px;
}
#gJv2imgViewer .stopped {
  padding:1px 4px 1px 4px;
  background-image: none;
}
#gJv2imgViewer .playing {
  padding:1px 20px 1px 4px;
  background: #eee url('".$getimgurl."img=playing') center right no-repeat;
}

#gJv2imgViewer #exifBg ,
#gJv2imgViewer #shareBg {
  position:absolute;
  top:".$config['borderSize']."px;
  left:".$config['borderSize']."px;
  background-color:#000;
  width:100px;
  height:100px;
}
#gJv2imgViewer #exifInfo ,
#gJv2imgViewer #shareInfo {
  position:absolute;
  top:".$config['borderSize']."px;
  left:".$config['borderSize']."px;
  padding:20px;
  text-align:left;
  font-size:12px;
  line-height:1.2em;
  color:#fff;
}

#gJv2videoPlayerWrap {
  padding:10px;
}

";

$css = str_replace(array("\n", "\r", "\t"), '', $css);
return $css;
}



/////////////////////////////////////////////////////////////////
// Gallery CODE
/////////////////////////////////////////////////////////////////

  $items = array();
  $folder = "";
  $subfolder = "";
  $sublink = "";
  $f = "";
  


// CLEAN GET VARS
foreach($_GET as $var => $val)
{
  $_GET[$var] = htmlspecialchars(strip_tags($val));
}



if (isset($_GET['source']))
{
  $source = addslashes($_GET['source']);
  $size = addslashes($_GET['size']);
  createThumb($source,$size);
  die();
}
else if (isset($_GET['folder']))
{
  $folder = $_GET['folder'];
  $size = addslashes($_GET['size']);
  createFolderThumb($folder,$size);
  die();
}
else if (isset($_GET['js']))
{
  $js = addslashes($_GET['js']);
  outputJS($js);
  die();
}
else if( isset($_GET['img']) )
{
  $img = addslashes($_GET['img']);
  getEncodedImage($img);
  die();   
}
else if( isset($_GET['theme']) )
{
  $theme = addslashes($_GET['theme']);
  changeTheme($theme);
  die();  
}
else if( isset($_GET['info']) )
{
  $info = addslashes($_GET['info']);
  imageInfo($info);
  die();  
}
else if( isset($_GET['share']) )
{
  $share = addslashes($_GET['share']);
  shareThis($share);
  die();  
}
else if( isset($_GET['download']) )
{
  $download = addslashes($_GET['download']);
  downloadImage($download);
  die();  
}
else if( isset($_GET['size']) )
{
  $size = addslashes($_GET['size']);
  changeSize($size);
  die();
}
else if( isset($_GET['userlogin']) )
{
  galleryLogin();
  die();
}
else if( isset($_GET['login']) )
{
  $login = addslashes($_GET['login']);
  if(isset($_POST['login']))
    galleryAdminLogin();
  elseif($login=="false")
    galleryLogout();
  else
  {
    $galleryPage = readFolder();
    echo printHeader();
    galleryAdminLoginForm();
    echo printFooter();
  }
  die();  
}
else if( isset($_GET['setup']) && isset($_POST['upload']) && (requireLogIn()==false || ( requireLogIn() && loggedIn() )) )
{
  processUploads();
}
else if( isset($_GET['setup']) )
{
  if(loggedIn())
  {
    $setup = addslashes($_GET['setup']);
    $galleryPage = readFolder();
    echo printHeader();
    gallerySetup($setup);
    echo printFooter();
  }
  else
  {
    header("Location: ".$_SERVER['PHP_SELF']);
  }
  die();  
}
else
{
  $galleryPage = readFolder();
  echo printHeader();
  echo printGallery();
  echo printFooter();
}


function readFolder()
{
  Global $galleryfolder, $config , $ignoreFolders , $useScandirIfAvailable;
  
  $galleryPage = array();
  
  if (isset($_GET['f']))
  {
    $galleryPage['f'] = html_entity_decode($_GET['f']);
    $galleryPage['folderPath'] = $galleryfolder.$galleryPage['f'].'/';
    $galleryPage['folder'] = './'.$galleryPage['folderPath'];
    $galleryPage['sublink'] = $galleryPage['f'].'/';
  }
  else
  {
    $galleryPage['folderPath'] = $galleryfolder; //getcwd()
    $galleryPage['folder'] = './'.$galleryPage['folderPath'];
    $galleryPage['sublink'] = '';
  }
  
  getAlbumConfig($galleryPage['folder']);

  $img_array = array();
  $folder_array = array();
  $video_array = array();
  $file_info = array();

  if(is_dir($galleryPage['folder']) && is_readable($galleryPage['folder']))
  {
    $files = array();
    
    // read files and folders
    if(function_exists('scandir') && $useScandirIfAvailable)
    {
      $files = scandir($galleryPage['folder']);
    }
    else
    {
      $galleryimg_dir = dir($galleryPage['folder']);
      while(($file = $galleryimg_dir->read()) !== false)
      {       
        $files[] = $file;
      }
    }
    
    // loop through files and folders
    foreach($files as $file)
    {
      if($file!="." && $file!=".." && is_readable($galleryPage['folder'].$file))
      {
        $file_ext = explode(".",$file);
        $file_ext = strtolower($file_ext[count($file_ext)-1]);

        $file_info[$file] = array(
          'created'=> filectime($galleryPage['folder'].$file)
          );

        if( in_array( $file_ext , $config['accepted_img'] ) )
        {
          $img_array[] = $file;
        }
        else if (is_dir($galleryPage['folder'].$file) && $file!="." && $file!=".." && $file!=$config['cachefolder'] && ((isset($config['cachefoldername']) && $file!=$config['cachefoldername']) || !isset($config['cachefoldername'])) && !in_array($galleryPage['folderPath'].$file,$ignoreFolders) ) 
        {
          $folder_array[] = $file;
        }
        else if($config['enableVideo'] && in_array( $file_ext , $config['accepted_video'] ) )
        {
          $key = substr($file,0,((strlen($file_ext)+1)*-1));
          $video_array[$key] = $file;
        }
      }
    }
    
    // sort the files and folders according to options
    if ($config['filesort'] == "desc") { rsort($img_array); } else { sort($img_array); }
    if ($config['foldersort'] == "desc") { rsort($folder_array); } else { sort($folder_array); }

    $items = array_merge($folder_array,$img_array);
    $total = sizeof($items);
  }
  else
  {
    $galleryPage['notFolder'] = true;
  }
  
  $galleryPage['img_array'] = $img_array;
  $galleryPage['folder_array'] = $folder_array;
  $galleryPage['video_array'] = $video_array;
  $galleryPage['file_info'] = $file_info;

  return $galleryPage;
  
}


function getAlbumConfig($folder)
{
  global $config, $thumbSizes, $theme, $themes, $imgText;

  if(strpos($folder,'./')!==0)
    $folder = './'.$folder;

  if(file_exists($folder."/config.php"))
  {
    $gallerySetup = array();
    include( $folder."/config.php" );
    $config = array_merge($config,$gallerySetup);
    
    $theme = $themes[$config['selectedTheme']];

    if(key_exists('config',$theme))
      $config = array_merge($config,$theme['config']);
    if(key_exists('thumbSizes',$theme))
      $thumbSizes = array_merge($thumbSizes,$theme['thumbSizes']);
  }
}


function printGallery()
{

  Global $config, $thumbSizes , $themes;
  Global $maxthumbheight, $vspace_folder , $restrictIconWidth;
  Global $items, $folder, $f, $subfolder, $sublink;
  Global $galleryfolder, $self, $getimgurl;
  Global $galleryPage,$imgSetup;
  
  $theme = $themes[$config['selectedTheme']];

  if(key_exists('config',$theme))
    $config = array_merge($config,$theme['config']);
  if(key_exists('thumbSizes',$theme))
    $thumbSizes = array_merge($thumbSizes,$theme['thumbSizes']);
  
  $gallery_code = '';
  
  if($config['cachethumbs'] == true)
  {
    $cache_error = null;
    if(!file_exists($config['cachefolder']) && @mkdir($config['cachefolder'], 0777)==false )
      $cache_error = 'Could not Create Directory "'.$config['cachefolder'].'".';
    elseif(!is_writable($config['cachefolder']) &&  @chmod($config['cachefolder'], 0777)==false )
      $cache_error = 'Could not make directory "'.$config['cachefolder'].'" writable.';
    
    if(!is_null($cache_error))
    {
      $gallery_code .= '<div style="font-size:10px;color:#ff0000;text-align:center;">';
      $gallery_code .= '<b>CACHE ERROR: <i>'.$cache_error.'</i></b><br/>';
      $gallery_code .= 'You have "cache thumbs" turned on, but your server does not allow the script to modify or create the folder.<br/>';
      $gallery_code .= 'Please create the folder "'.$config['cachefolder'].'" and make it writable (quicker), or turn off "cachethumbs" (slower). ';
      $gallery_code .= '</div>';
    }
  }
  
  

  $f = (isset($galleryPage['f'])?$galleryPage['f']:'');
  $folder = (isset($galleryPage['folder'])?$galleryPage['folder']:'');
  $sublink = (isset($galleryPage['sublink'])?$galleryPage['sublink']:'');
  $notFolder = (isset($galleryPage['notFolder'])?$galleryPage['notFolder']:'');
  $img_array = (isset($galleryPage['img_array'])?$galleryPage['img_array']:array());
  $folder_array = (isset($galleryPage['folder_array'])?$galleryPage['folder_array']:array());
  $items = array_merge($folder_array,$img_array);
  $total = sizeof($items);
    
  $imgSetup = getImgSetup($img_array,$folder);
  
  if(requireLogIn() && loggedIn()==false)
    $gallery_code.= galleryLoginForm();
  else
  {
  
    
   $loopstart = 0;
   $looplimit = $total;
    
    if($total < $looplimit)
      $looplimit = $total;

    if(isset($_GET['i']))
      $i = htmlspecialchars_decode(urldecode($_GET['i']));
    
    if($config['useOverlayJsViewer'] || $config['showImageSliderInImgView'])
    {

      // if a gallery folder is requested
      if(!empty($_GET['f']) && $config['show_backlink'])
      {
         // create backlink
        $backlink = '';
        $displayfolders = explode("/",$f);
        if(sizeof($displayfolders)>1)
        {
          array_pop($displayfolders);
          $backlink.= $self."f=";
          foreach($displayfolders as $fl)
            $backlink.= $fl."/";
          
          $backlink = substr($backlink, 0, -1);
        }
        else
        {
          $backlink = $self;
        }
        
        // render backlink in gallery
        $gallery_code .= '<div class="item">';
        $gallery_code .= '<div class="image-thumbnail"><div class="imgWrap">';
        $gallery_code .= '<a href="'.$backlink.'" title="&lt;&lt;">';
        $gallery_code .= '<img border="0" src="'.$getimgurl.'img=folder_up" alt="&lt;&lt;" '.($restrictIconWidth?'width="'.$thumbSizes[$config['imgSize']]['width'].'"':'height="'.$thumbSizes[$config['imgSize']]['height'].'"').' />';
        $gallery_code .= '</a></div>';
        $gallery_code .= '</div>';
        $gallery_code .= '<div class="imagetitle">&lt;&lt;</div>';
        $gallery_code .= '</div>'."\n";
      }
    
      if($notFolder)
        $gallery_code .= '<div style="text-align:center;padding:55px;">'.$config['not_folder_msg'].'</div>';
      elseif( sizeof($items) == 0 )
        $gallery_code .= '<div style="text-align:center;padding:55px;">'.$config['not_found_msg'].'</div>';
    
      for( $i=0; $i<$loopstart; $i++)
        $gallery_code .= createJsLinkRef($i);

      $gallery_code .= '<ul class="small-block-grid-2 large-block-grid-5">';
      for( $i=$loopstart; $i<$looplimit; $i++)
        $gallery_code .= displayItem($i);
      $gallery_code .= '</ul>'."\n";
    
      for( $i=$looplimit; $i<$total; $i++) 
        $gallery_code .= createJsLinkRef($i);
    }
  }
  
  return $gallery_code;

}




/*

function is modified for OYPO integration and foundation styling

*/
function getBreadcrumbs()
{
  Global $config, $self;
  
  if (isset($_GET['f']) && $config['show_breadcrumbs'])
  {
    $f = $_GET['f'];
    if(isset($_GET['setup']))
      $s = $_GET['setup'];
    else
      $s = '';
    if($s!='')
      $s = 'setup='.$s.'&';
    $displayfolders = explode("/",$f);
    
    // oypo addon - foundation 4 breadcrumb
    $breadcrumbs_code = '<ul class="breadcrumbs">';
    $breadcrumbs_code .= '<li><a href="/portfolio/">'.$config['gallery_page_title'].'</a></li>';
    
    if($displayfolders[0]==".")
      array_shift($displayfolders);
    for ($i=0; $i < sizeof($displayfolders); $i++)
    {
      if(isset($displayfolders[$i]) && $displayfolders[$i]!=null )
      { 
        // [oypo] $breadcrumbs_code .= ' '.$config['gallery_path_separator'].' <a href="?'.$s.'f='.$displayfolders[0];
        $breadcrumbs_code .= '<li><a href="/portfolio/'.$displayfolders[0].'/';
        $bc_path = "";
        for ($x=1; $x <= $i; $x++)
        {
          $breadcrumbs_code .= '/'.$displayfolders[$x];
          $bc_path .= '/'.$displayfolders[$x];
        }
        $breadcrumbs_code .= '">'.displayName($displayfolders[$i]).'</a></li>';
      }
    }
    $breadcrumbs_code .= '</ul>';

  } else {
    $breadcrumbs_code = '<ul class="breadcrumbs"><li>'.$config['gallery_page_title'].'</li></ul>';
  }
  
  return $breadcrumbs_code;
}

function encodeFilename($file)
{
  global $unEncodeChars, $unEncodeCharsMap;
  
  $file = rawurlencode($file);
  
  if($unEncodeChars)
    $file = str_replace( array_keys($unEncodeCharsMap) , $unEncodeCharsMap , $file ); 
  
  return $file;
}

function displayItem($i,$sizeOverride=null)
{
  Global $items, $folder, $f, $vspace_folder, $restrictIconWidth, $sublink, $config , $themes , $thumbSizes;
  Global $galleryfolder, $self, $getimgurl , $galleryPage;
  Global $imgSetup;
  
  if($sizeOverride!=null)
    $config['imgSize'] = $sizeOverride;

  $highlightClass = null;
  if($config['highlightNewItems'] && isset($galleryPage['file_info'][$items[$i]]))
  {
    if($galleryPage['file_info'][$items[$i]]['created'] > (time()-60*60*24*$config['highlightNewItemDays']) )
      $highlightClass = 'newItem';
  }

  // gallery folder
  if(is_dir($folder.'/'.$items[$i]) )
  {
    $wrapAdjust = '';
    
    // if default image for folder is set
    $folderImgFound = false;
    if($config['maxTinyThumbsForFolders'])
    {
      $folderImg = getFolderThumbnail($folder.$items[$i] ,$config['imgSize']);
      $wrapAdjust = imgVerticalInlineCssAdjust($folderImg);
      $folderImg = $folderImg['img'];
      $folderImgFound = true;
    }
    
    if(!$folderImgFound)
    {
      $folderImg = '<img border="0" src="'.$getimgurl.'img=folder" alt="'.stripslashes(displayName($items[$i])).'" '.($restrictIconWidth?'width="'.$thumbSizes[$config['imgSize']]['width'].'"':'height="'.$thumbSizes[$config['imgSize']]['height'].'"').' />';
    }
    

    // $gallery_code = '<li class="'.(!is_null($highlightClass)?' '.$highlightClass:'').'"><a class="th radius" href="'.$self.'f='.$sublink.encodeFilename($items[$i]).'/" title="'.stripslashes(displayName($items[$i])).'">';
    $gallery_code = '<li class="'.(!is_null($highlightClass)?' '.$highlightClass:'').'"><a class="th radius" href="/portfolio/'.$sublink.encodeFilename($items[$i]).'/" title="'.stripslashes(displayName($items[$i])).'">';
    $gallery_code .= $folderImg;
    $gallery_code .= '</a><div class="imagetitle">'.displayName($items[$i]).'</div></li>'."\n";
  }
  // gallery image
  else
  {
    $thumb = getThumbnail($folder,$items[$i],$config['imgSize']);
    $wrapAdjust = imgVerticalInlineCssAdjust($thumb);

    if($config['displayImgName'])
      $itemTitle = '<div class="imagetitle">'.(!empty($imgSetup[$items[$i]]['title'])?$imgSetup[$items[$i]]['title']:'&nbsp;').'</div>';
    
    $gallery_code = '<li class="item'.(!is_null($highlightClass)?' '.$highlightClass:'').'">';
      $gallery_code .= '<div class="image-thumbnail">';
        // oypo / foundation modification 
        // $gallery_code .= '<div class="loading"><div class="imgWrap"'.$wrapAdjust.'><a class="gItem" ';
        $gallery_code .= '<div class="loading"><div class="imgWrap" '.$wrapAdjust.'><a class="th radius gItem" ';

        if(!$config['useOverlayJsViewer'])
          $gallery_code .= 'href="'.$getimgurl.(!empty($f)?'f='.$f.'&':'').'i='.encodeFilename($items[$i]).'"';
        elseif($config['resizeLargeView'])
        {
          $cacheimagename = getThumbFilename($folder,$items[$i],'original');
          if(file_exists('./'.$cacheimagename)) 
            $gallery_code .= 'href="'.$cacheimagename.'"';
          else
            $gallery_code .= 'href="'.$getimgurl."source=".encodeFilename((!empty($galleryPage['f'])?$galleryPage['f']."/":'').$items[$i])."&size=original".'"';
        }
        else
          $gallery_code .= 'href="'.$galleryfolder.$sublink.encodeFilename($items[$i]).'"';

        $gallery_code .= ' orig="'.$galleryfolder.$sublink.encodeFilename($items[$i]).'"';

        if($config['enableVideo'])
        {
          $file_ext = explode(".",$items[$i]);
          $file_ext = strtolower($file_ext[count($file_ext)-1]);
          $key = substr($items[$i],0,((strlen($file_ext)+1)*-1));

          if(array_key_exists($key, $galleryPage['video_array']))
          {
            $gallery_code .= ' video="'.$galleryfolder.$sublink.encodeFilename($galleryPage['video_array'][$key]).'"';
          }
        }

        if($config['displayImgTitle'] && !empty($imgSetup[$items[$i]]['title']) )
          $gallery_code .= ' title="'.$imgSetup[$items[$i]]['title'].'"';
        if(!empty($imgSetup[$items[$i]]['caption']))
          $gallery_code .= ' caption="'.$imgSetup[$items[$i]]['caption'].'"';
        if($config['displayAuthor'] && !empty($imgSetup[$items[$i]]['author']) )
          $gallery_code .= ' author="'.$imgSetup[$items[$i]]['author'].'"';
        $gallery_code .= ' params="width='.$imgSetup[$items[$i]]['width'].',height='.$imgSetup[$items[$i]]['height'].'"';
        $gallery_code .= '>';
        $gallery_code .= $thumb['img'];
        $gallery_code .= '</a>';
        $gallery_code .= '</div></div>';
        if($config['displayImgName'] && $themes[$config['selectedTheme']]['img-name-display-inside'])
          $gallery_code .= $itemTitle;
      $gallery_code .= '</div>';
      if($config['displayImgName'] && !$themes[$config['selectedTheme']]['img-name-display-inside'])
        $gallery_code .= $itemTitle;
        
      // START oypo integration
      global $httpHostContextPrefix;

		$oypoFoto = $items[$i];
      $oypoFotoThumb = 'http://www.fotografie-egmond.nl/'.$folder.$oypoFoto;
		$oypoButtonAdd = $httpHostContextPrefix.'img/cart32.png';
		$oypoButtonRemove = $httpHostContextPrefix.'img/cart-accept32.png';
      
      // $gallery_code .= '<p>oypofoto '.$oypoFoto.'</p>';
      // $gallery_code .= '<p>folder '.$folder.'</p>';
		$gallery_code .= '<div class="buy-image" ><script language="JavaScript"
				src="http://www.oypo.nl/pixxer/api/orderbutton.asp
				?foto='.$oypoFoto.'
						&thumb='.$oypoFotoThumb.'
								&profielid=5B2122729FD04929
								&buttonadd='.$oypoButtonAdd.'
										&buttondel='.$oypoButtonRemove.'"></script></div>';
		// END oypo integration
      
    $gallery_code .= '</li>'."\n";   
    
  }
  
  return $gallery_code;
}

function imgVerticalInlineCssAdjust($thumb)
{
  global $config, $thumbSizes;

  $wrapHeight = $thumbSizes[$config['imgSize']]['height'];

  $wrapAdjust = '';
  if(isset($thumb['height']) && !is_null($thumb['height']) && $thumb['height'] < $wrapHeight)
  {
    $adjust = floor(($wrapHeight - $thumb['height']) / 2 );
    $wrapAdjust = ' style="padding-top:'.$adjust.'px;height:'.($wrapHeight-$adjust).'px;"';
  }
  return $wrapAdjust;
}

function createJsLinkRef($i)
{
  Global $items,$galleryfolder,$folder,$sublink;
  Global $imgSetup,$config;
  
  $gallery_code = '';
  
  if(!is_dir($folder."/".$items[$i]) )
  {
    $gallery_code .= '<span class="hidden"><a class="gItem" href="'.$galleryfolder.$sublink.encodeFilename($items[$i]).'" orig="'.$galleryfolder.$sublink.encodeFilename($items[$i]).'" ';
    if($config['displayImgTitle'] && !empty($imgSetup[$items[$i]]['title']) )
      $gallery_code .= ' title="'.$imgSetup[$items[$i]]['title'].'"';
    if(!empty($imgSetup[$items[$i]]['caption']))
      $gallery_code .= ' caption="'.$imgSetup[$items[$i]]['caption'].'"';
    if($config['displayAuthor'] && !empty($imgSetup[$items[$i]]['author']) )
      $gallery_code .= ' author="'.$imgSetup[$items[$i]]['author'].'"';
    $gallery_code .= ' params="width='.$imgSetup[$items[$i]]['width'].',height='.$imgSetup[$items[$i]]['height'].'"';
    $gallery_code .= $i.'</a></span>'."\n";   
  }
  
  return $gallery_code; 
}

function getImgSetup($img_array,$folder)
{
  Global $config,$themes,$thumbSizes,$imgText;
  
  $imgSetup = array();
  
  foreach($img_array as $image)
  {
    if($config['displayImgTitle'] || $config['displayImgName'])
    {
      if(!empty( $imgText[$image]['title'] ))
        $imgSetup[$image]['title'] = stripslashes($imgText[$image]['title']);
      else
        $imgSetup[$image]['title'] = getImageName($image);
    }
    else
    {
      $imgSetup[$image]['title'] = "&nbsp;";
    }
    
    if(!empty( $imgText[$image]['caption'] ))
    {
      $imgSetup[$image]['caption'] = stripslashes($imgText[$image]['caption']);
    }
    else
    {
      $commentsfile = getCommentsFileName($folder."/".$image);
      if(file_exists($commentsfile))
        $imgSetup[$image]['caption'] = getCommentsText($commentsfile,true);
    }
    
    if(!empty( $imgText[$image]['author'] ))
      $imgSetup[$image]['author'] = stripslashes($imgText[$image]['author']);
    else
      $imgSetup[$image]['author'] = $config['defaultAuthor'];
    
    $size = getimagesize($folder."/".$image);
    $imgSetup[$image]['width'] = $size[0];
    $imgSetup[$image]['height'] = $size[1];
  }

  return $imgSetup;
}


function getThumbFilename($folder,$image,$imgSize="small") 
{
  Global $maxthumbwidth, $maxthumbheight, $config, $thumbSizes, $galleryfolder;
  
  if(strpos($folder.$image,"../")!==false ) {die();}

  if(!endsWithSlash($folder) && $image!='')
    $folder .= '/';

  if(strpos($folder, './'.$galleryfolder)===0)
    $hashfolder = str_replace('./'.$galleryfolder, './', $folder);
  else
    $hashfolder = $folder;

  if($imgSize=='upload' || $imgSize=='original')
  {
    $maxthumbwidth = $config['resizeMaxSize']['width'];
    $maxthumbheight = $config['resizeMaxSize']['height'];
  }
  else
  {
    $maxthumbwidth = $thumbSizes[$imgSize]['width'];
    $maxthumbheight = $thumbSizes[$imgSize]['height'];
  }

  $size = getimagesize($folder.$image);
  $xratio = $maxthumbwidth/$size[0];
  $yratio = $maxthumbheight/$size[1];
  if($xratio < $yratio) 
  {
    $thumbwidth = $maxthumbwidth;
    $thumbheight = floor($size[1]*$xratio);
  }
  else
  {
    $thumbheight = $maxthumbheight;
    $thumbwidth = floor($size[0]*$yratio);
  }
  
  if(key_exists('type',$config) && $config['type']=='column')
    $hs = 'col-'.$imgSize;
  elseif($config['cropImages'])
    $hs = 'crop-'.$imgSize;
  elseif($imgSize=='original')
    $hs = 'img';
  else
    $hs = $imgSize;

  $modifed = filemtime($folder.$image);
  $filesize = filesize($folder.$image);
  $hash = 'thumb-'.$imgSize.'::'.$hashfolder.$image.$size[0].$size[1].$modifed.$filesize.$maxthumbwidth.$maxthumbheight.($config['cropImages']?'crop':'');
  $hash = md5($hash);
  $cacheimagename = $config['cachefolder']."/".$hs."_".$hash.".jpg";  
  
  return $cacheimagename;
}


function getThumbnail($folder,$image,$imgSize="small",$isFolder=false) 
{
  Global $galleryPage, $getimgurl, $galleryfolder;
  
  $thumb = array();
  $params = '';

  $cacheimagename = getThumbFilename($folder,$image,$imgSize);

  if(file_exists('./'.$cacheimagename))
  {
    $src = $cacheimagename;
    list($thumbWidth, $thumbHeight) = getimagesize($cacheimagename);
    $params = 'width="'.$thumbWidth.'" height="'.$thumbHeight.'"';
    $thumb['width'] = $thumbWidth;
    $thumb['height'] = $thumbHeight;
  }
  else 
    $src = $getimgurl."source=".encodeFilename((!empty($galleryPage['f'])?$galleryPage['f']."/":'').$image)."&size=".$imgSize;
  
  // oypo / foundation modification
  // $thumb['img'] = "<img class='gImg".($isFolder?" gFolderImg":"")."' border='0' src='".$src."' alt='".encodeFilename(displayName($image))."' ".$params."/>";
  $thumb['img'] = "<img border='0' src='".$src."' alt='".encodeFilename(displayName($image))."' ".$params."/>";


  return $thumb;
}
  

function getFolderImages($folder , $img_array=array() , $sf='')
{
  global $galleryPage, $maxthumbwidth, $maxthumbheight, $config, $getimgurl;
  
  if(strpos($folder,"../")!==false ) {die();}

  if(!endsWithSlash($folder))
    $folder .= '/';

  $folders = array(); 
  $galleryimg_dir = dir($folder);
  $i = 0;
  while(($i<$config['maxTinyThumbsForFolders'] && $file = $galleryimg_dir->read()) !== false)
  {
    $file_ext = explode(".",$file);
    $file_ext = strtolower($file_ext[count($file_ext)-1]);
    
    if( !is_dir($folder.$file) && in_array( $file_ext , $config['accepted_img'] ) )
    {
      if(count($img_array)<$config['maxTinyThumbsForFolders'])
        $img_array[] = $sf.$file;
      $i++;
    }
    elseif(is_dir($folder.$file) && $file!='.' && $file!='..')
    {
      $folders[] = $file;
    }
  }

  if(count($img_array)<$config['maxTinyThumbsForFolders'])
  {
    foreach($folders as $subfolder)
    {
      $img_array = getFolderImages($folder.$subfolder , $img_array , $sf.$subfolder.'/');
      if(count($img_array)>=$config['maxTinyThumbsForFolders'])
        break;
    }
  }
  
  return $img_array;
}

function getFolderThumbnail($folder,$imgSize="small") 
{
  Global $galleryPage, $galleryfolder, $maxthumbwidth, $maxthumbheight, $restrictIconWidth, $config, $getimgurl , $thumbSizes;

  $thumb = array();
  $params = '';

  $img_array = getFolderImages($folder);
  
  $folder = str_replace($galleryfolder,'',$folder);
  
  if(count($img_array)==0)
  {
    return array(
      'img' => '<img border="0" src="'.$getimgurl.'img=folder" alt="'.stripslashes(displayName($folder)).'" '.($restrictIconWidth?'width="'.$thumbSizes[$config['imgSize']]['width'].'"':'height="'.$thumbSizes[$config['imgSize']]['height'].'"').' />',
      'width' => null,
      'height' => null
    );
  }
  
  $hs = $imgSize;
  if(key_exists('type',$config) && $config['type']=='column')
    $hs = 'col-'.$imgSize;
  elseif($config['cropImages'])
    $hs = 'crop-'.$imgSize;
  
  $hash = md5(implode('',$img_array).$maxthumbwidth.$maxthumbheight);
  $cacheimagename = $config['cachefolder']."/".$hs."_".$hash.".jpg";  
  
  
  if(file_exists($cacheimagename))
  {
    $src = $cacheimagename;
    list($thumbWidth, $thumbHeight) = getimagesize($cacheimagename);
    $params = 'width="'.$thumbWidth.'" height="'.$thumbHeight.'"';
    $thumb['width'] = $thumbWidth;
    $thumb['height'] = $thumbHeight;
  }
  else
    $src = $getimgurl."folder=".encodeFilename($folder)."&size=".$imgSize;
  
  // oypo / foundation modification
  // $thumb['img'] = "<img class='gImg gFolderImg' border='0' src='".$src."' alt='".encodeFilename(displayName($folder))."' ".$params."/>";
  $thumb['img'] = "<img src='".$src."' alt='".encodeFilename(displayName($folder))."' ".$params."/>";

  return $thumb;
}
  

function createThumb($image,$size)
{
  $thumb = resizeImage($image,$size);
  
  //RETURN A JPG TO THE BROWSER 
  if(!DEV_MODE)
    header('Content-Type: image/jpeg');
  imagejpeg($thumb);
  imagedestroy($thumb);
}

function resizeUploadedImage($image)
{
  resizeImage($image,'upload');
}

function resizeImage($source,$size)
{
  Global $maxthumbwidth, $maxthumbheight, $config , $thumbSizes , $galleryfolder;
  
  $processImage = true;
  $thumb = null;
  $resizeUploadedImage = false;

  if($size=='upload')
  {
    $resizeUploadedImage = true;
  }
  else
  {
    $source = stripslashes(rawurldecode($source));
    $source = str_replace('&amp;','&',$source);
    
    if(strpos($source,"../")!==false ) {die();}
    
    if(strpos($source, './')!==0)
      $source = './'.$source;
  }

  $path = pathinfo($source);

  if($size!='original' && $config['watermarkImages'] && !$config['watermarkUploadedImages'] && $config['watermarkThumbnailImages'])
  {echo 3;
    $original = resizeImage($source,'original');
  }
  else
  {
    switch(strtolower($path["extension"]))
    {
      case "jpeg":
      case "jpg":
          $original=imagecreatefromjpeg($source);
          break;
      case "gif":
          $original=imagecreatefromgif($source);
          break;
      case "png":
          $original=imagecreatefrompng($source);
          break;
      default:
          break;      
    }
  }

  if($config['autoRotate'])
  {
    $orientation = getExifRotation($source);
    if($orientation)
      $original = rotateImage($original,$orientation);
  }

  if($size=='upload' || $size=='original')
  {
    $maxthumbwidth = $config['resizeMaxSize']['width'];
    $maxthumbheight = $config['resizeMaxSize']['height'];
  }
  else
  {
    $maxthumbwidth = $thumbSizes[$size]['width'];
    $maxthumbheight = $thumbSizes[$size]['height'];
  }

  if(!$resizeUploadedImage && $size!='original' && $config['cropImages'])
  {
    $width_orig = imagesx($original);
    $height_orig = imagesy($original);

    $thumb = imagecreatetruecolor($maxthumbwidth, $maxthumbheight);
    $ratio_orig = $width_orig/$height_orig;
    if($maxthumbwidth/$maxthumbheight > $ratio_orig)
    {
       $new_height = $maxthumbwidth/$ratio_orig;
       $new_width = $maxthumbwidth;
    }
    else
    {
       $new_width = $maxthumbheight*$ratio_orig;
       $new_height = $maxthumbheight;
    }
    
    $x_mid = $new_width/2;
    $y_mid = $new_height/2;
  
    $process = imagecreatetruecolor(round($new_width), round($new_height));
  
    imagecopyresampled($process, $original, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
   
    imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($maxthumbwidth/2)), ($y_mid-($maxthumbheight/2)), $maxthumbwidth, $maxthumbheight, $maxthumbwidth, $maxthumbheight);

    imagedestroy($process);
    imagedestroy($original);
  }
  else
  {
    
    $imageX = imagesx($original);
    $imageY = imagesy($original);

    if(($size=='original' || $resizeUploadedImage) && $imageX < $maxthumbwidth && $imageY < $maxthumbheight)
      $processImage = false;
    
    if($processImage)
    {
      $xratio = $maxthumbwidth / $imageX;
      $yratio = $maxthumbheight / $imageY;
    
      if($xratio < $yratio)
      {
        $thumb = imagecreatetruecolor($maxthumbwidth,ceil($imageY * $xratio));
        $thumb_width = $maxthumbwidth;
        $thumb_height = ceil($imageY * $xratio);
      }
      else
      {
        $thumb = imagecreatetruecolor(ceil($imageX * $yratio), $maxthumbheight);
        $thumb_width = ceil($imageX * $yratio);
        $thumb_height = $maxthumbheight;
      }
    
      imagecopyresampled($thumb, $original, 0, 0, 0, 0, imagesx($thumb)+1,imagesy($thumb)+1,$imageX,$imageY);
      imagedestroy($original);
    }
    else
      $thumb = $original;
  }
  
  
  if($size=='upload' || $size=='original')
    $thumb = addWatermark($thumb,$resizeUploadedImage);

  // save original
  if($resizeUploadedImage && $processImage)
  {
      imagejpeg($thumb,$source,$config['resizeQuality']);
  }
  // cache the thumbnail
  elseif( ($size!='original' && $config['cachethumbs']) || ($size=='original' && $config['cacheLargeView']) )
  {
    if(is_writable($config['cachefolder']))
    {
      $cacheimagename = getThumbFilename($source,'',$size);
      imagejpeg($thumb,'./'.$cacheimagename,$config['cachequality']);
    }
  }
    
  return $thumb;

}

function getExifRotation($imagePath)
{
  $exif = exif_read_data($imagePath);

  if(isset($exif['Orientation']))
    return $exif['Orientation'];
  else
    return false;
}

function rotateImage($img,$orientation)
{
  $rotation = array(
    1 => array('degrees'=>0,'mirror'=>false),
    2 => array('degrees'=>0,'mirror'=>true), 
    3 => array('degrees'=>180,'mirror'=>false), 
    4 => array('degrees'=>180,'mirror'=>true), 
    5 => array('degrees'=>270,'mirror'=>true), 
    6 => array('degrees'=>270,'mirror'=>false), 
    7 => array('degrees'=>90,'mirror'=>true), 
    8 => array('degrees'=>90,'mirror'=>false)
  );

  if($rotation[$orientation]['degrees'])
    $img = imagerotate($img, $rotation[$orientation]['degrees'], 0);

  if($rotation[$orientation]['mirror'])
    $img = mirrorImage($img);

  return $img;
}

function mirrorImage($img)
{
  $width = imagesx( $img );
  $height = imagesy ( $img );

  $src_x = $width-1;
  $src_y = 0;
  $src_width = -$width;
  $src_height = $height;

  $imgdest = imagecreatetruecolor($width,$height);

  if(imagecopyresampled($imgdest, $img, 0, 0, $src_x, $src_y, $width, $height, $src_width, $src_height ) )
    return $imgdest;

  return $img;
}


function coordinatesFromCSSpos($cssPos='',$settings=array())
{
  if(isset($settings['canvasWidth']))
    $canvasWidth=$settings['canvasWidth'];
  else
    $canvasWidth=0;
  if(isset($settings['canvasHeight']))
    $canvasHeight=$settings['canvasHeight'];
  else
    $canvasHeight=0;
  if(isset($settings['objectWidth']))
    $objectWidth=$settings['objectWidth'];
  else
    $objectWidth=null;
  if(isset($settings['objectHeight']))
    $objectHeight=$settings['objectHeight'];
  else
    $objectHeight=null;
  if(isset($settings['objectStartTop']))
    $objectStartTop=$settings['objectStartTop'];
  else
    $objectStartTop=true;
  if(isset($settings['margin']))
    $margin=$settings['margin'];
  else
    $margin=0;

  $ptx = $cssPos;
  $pty = $cssPos;
  $dstx = null;
  $dsty = null;

  // if position has 'px' or '%'
  if(strpos($cssPos,' ')!==false && (strpos($cssPos,'px')!==false || strpos($cssPos,'%')!==false))
  {
    $cssPos = explode(' ',$cssPos);
    $ptx = $cssPos[0];
    $pty = $cssPos[1];

    if(strpos($ptx,'%')!==false)
      $dstx = floor(($canvasWidth * intval($ptx)/100) - (is_null($objectWidth)?0:($objectWidth * intval($ptx)/100)));
    else
      $dstx = intval($ptx);

    if(strpos($pty,'%')!==false)
      $dsty = floor(($canvasHeight * intval($pty)/100) - (is_null($objectHeight)?0:(($objectHeight * intval($pty)/100)*($objectStartTop?1:-1))));
    else
      $dsty = $objectStartTop ? intval($pty) : intval($pty)+(is_null($objectHeight)?0:$objectHeight);
  }

  // work out x coordinate from left, right or center
  if(is_null($dstx))
  {
    if(strpos($ptx,'left')!==false)
      $dstx = $margin;
    elseif(strpos($ptx,'right')!==false)
      $dstx = $canvasWidth - $margin - (is_null($objectWidth)?0:$objectWidth);
    else
      $dstx = floor(($canvasWidth/2) - (is_null($objectWidth)?0:($objectWidth/2)));
  }

  // work out y coordinate from top, bottom or center
  if(is_null($dsty))
  {
    if(strpos($pty,'top')!==false)
      $dsty = $objectStartTop ? $margin : $margin+(is_null($objectHeight)?0:$objectHeight);
    elseif(strpos($pty,'bottom')!==false)
      $dsty = $canvasHeight - $margin - ((!$objectStartTop || is_null($objectHeight))?0:$objectHeight);
    else
      $dsty = floor(($canvasHeight/2) - (is_null($objectHeight)?0:(($objectHeight/2)*($objectStartTop?1:-1))));
  }

  return array('x'=>$dstx,'y'=>$dsty);
}

function addWatermark($imageData,$uploading=false)
{
  global $config;

  if(($config['watermarkImages'] && !$config['watermarkUploadedImages']) || ($uploading && $config['watermarkUploadedImages']) )
  {
    if($config['watermarkTextOnly'])
      $imageData = addWatermarkText($imageData);
    else
      $imageData = addWatermarkImage($imageData);
  }

  return $imageData;
}

function addWatermarkImage($original)
{
  Global $config;
  
  $src = $config['watermarkImage']['path'];
  $margin = $config['watermarkImage']['margin'];
  $mode = $config['watermarkImage']['mode'];
  $opacity = $config['watermarkImage']['opacity'];
  $path = pathinfo($config['watermarkImage']['path']);
  
  switch(strtolower($path["extension"]))
  {
    case "jpeg":
    case "jpg":
        $src = imagecreatefromjpeg($src);
        break;
    case "gif":
        $src = imagecreatefromgif($src);
        break;
    case "png":
        $src = imagecreatefrompng($src);
        break;
    default:
        break;      
  }
  
  $originalWidth = imagesx($original);
  $originalHeight = imagesy($original);
  
  $w = imagesx($src);
  $h = imagesy($src);
  
  $coord = coordinatesFromCSSpos($config['watermarkImage']['position'],array(
      'canvasWidth'=>$originalWidth,
      'canvasHeight'=>$originalHeight,
      'objectWidth'=>$w,
      'objectHeight'=>$h,
      'margin'=>$margin
    ));
  $dstx = $coord['x'];
  $dsty = $coord['y'];

  if($config['watermarkImage']['overlayPNG'] && strtolower($path["extension"])=='png')
  {
    imagesavealpha($original, true);
    imagealphablending($original, true);
    imagesavealpha($src, true);
    imagealphablending($src, true);
    imagecopy($original, $src, $dstx, $dsty, 0, 0, $w, $h);
    imageDestroy($src);
  }
  else
  {
    // if mode "auto" - work out average color
    if($mode=="0")
    { 
      $red = array(); 
      $green = array();
      $blue = array();

      $x2 = $dstx + $w;
      $y1 = $dsty;
      $y2 = $dsty + $h;

      for ($x=$dstx;$x<$x2;$x++)
      {
        for ($y=$y1;$y<$y2;$y++)
        {
          $colorindex = @imagecolorat($original,$x,$y);
          $colorrgb = @imagecolorsforindex($original,$colorindex);  
          $red[] = $colorrgb['red'];
          $green[] = $colorrgb['green'];
          $blue[] = $colorrgb['blue'];
        }
      }

      // work out average
      $avg_red = ceil( array_sum($red) / count($red) );
      $avg_green = ceil( array_sum($green) / count($green) );
      $avg_blue = ceil( array_sum($blue) / count($blue) );
      
      $average = ($avg_red + $avg_green + $avg_blue) / 3;
      
      if($average < $config['watermarkImage']['darknessThreshold'])
        $mode = "1"; // image is light - use DODGE
      else
        $mode = "2"; // image is dark - use BURN
    }
    
    $i = 0;
    $j = 0;
    $k = 0;
    $rgb = 0;
    $d = array();
    $s = array();
      
    for ($i=0; $i<$h; $i++)
    {
      for ($j=0; $j<$w; $j++)
      {
        $rgb = @imagecolorat($original,$dstx+$j,$dsty+$i);
        $d[0] = ($rgb >> 16) & 0xFF;
        $d[1] = ($rgb >> 8) & 0xFF;
        $d[2] = $rgb & 0xFF;
        
        $rgb = @imagecolorat($src,$j,$i);
        $s[0] = ($rgb >> 16) & 0xFF;
        $s[1] = ($rgb >> 8) & 0xFF;
        $s[2] = $rgb & 0xFF;
        
        // invert logo if image dark
        if(isset($average) && $average < $config['watermarkImage']['darknessThreshold'])
        {
          $s[0] = 255 - $s[0];
          $s[1] = 255 - $s[1];
          $s[2] = 255 - $s[2];
        }
        
        if($mode=="1")
        { // Image DODGE
          $d[0] += min($s[0],0xFF-$d[0])*$opacity/100;
          $d[1] += min($s[1],0xFF-$d[1])*$opacity/100;
          $d[2] += min($s[2],0xFF-$d[2])*$opacity/100;           
        }
        elseif($mode=="2")
        { // Image BURN       
          $d[0] -= max($d[0]-$s[0],0)*$opacity/100;
          $d[1] -= max($d[1]-$s[1],0)*$opacity/100;
          $d[2] -= max($d[2]-$s[2],0)*$opacity/100;         
        } 
        elseif($mode=="3")
        { // Image Paste
          $d[0] = $s[0];
          $d[1] = $s[1];
          $d[2] = $s[2];          
        }  
        elseif($mode=="4")
        { // AVERAGE
          $d[0] = ($s[0] + $d[0])/2;
          $d[1] = ($s[1] + $d[1])/2;
          $d[2] = ($s[2] + $d[2])/2;          
        }  
        elseif($mode=="5")
        { // Average Fade (opacity logo)
          $d[0] = ($s[0]*$opacity/100 + $d[0])/2;
          $d[1] = ($s[1]*$opacity/100 + $d[1])/2;
          $d[2] = ($s[2]*$opacity/100 + $d[2])/2;         
        }  
        elseif($mode=="6")
        { // Average Fade (opacity background)
          $d[0] = ($s[0] + $d[0]*$opacity/100)/2;
          $d[1] = ($s[1] + $d[1]*$opacity/100)/2;
          $d[2] = ($s[2] + $d[2]*$opacity/100)/2;         
        }               
        elseif($mode=="7")
        { // Lighten
          $d[0] += min($s[0]*$opacity/100,0xFF-$d[0]);
          $d[1] += min($s[1]*$opacity/100,0xFF-$d[1]);
          $d[2] += min($s[2]*$opacity/100,0xFF-$d[2]);          
        }                
        
        // change the pixel color
        imagesetpixel($original, $dstx+$j, $dsty+$i, imagecolorallocate($original,$d[0],$d[1],$d[2]) );
      }
    }
  }
  
  return $original;
}





function addWatermarkText($original)
{
  Global $config;
  
  $text_font = $config['watermarkText']['font'];
  $text_angle = $config['watermarkText']['angle'];  
  $text = $config['watermarkText']['text'];
  $font_size = $config['watermarkText']['fontSize'];
  $margin = $config['watermarkText']['margin'];
  $position =  $config['watermarkText']['position'];
  $text_color =  $config['watermarkText']['color'];
  $shadow_distance =  $config['watermarkText']['shadowDistance'];
  $shadow_color =  $config['watermarkText']['shadowColor'];
  $text_auto_color = $config['watermarkText']['autoColorText'];
  $shadow_auto_color = $config['watermarkText']['autoColorShadow'];
  
  
  // Get the boundingbox from imagettfbbox(), which is correct when angle is 0
  $bbox = imagettfbbox($font_size, 0, $text_font, $text);
  
  // Rotate the boundingbox
  $angle = $text_angle/ 180 * pi();
  for ($i=0; $i<4; $i++)
  {
    $x = $bbox[$i * 2];
    $y = $bbox[$i * 2 + 1];
    $bbox[$i * 2] = cos($angle) * $x - sin($angle) * $y;  // X
    $bbox[$i * 2 + 1] = sin($angle) * $x + cos($angle) * $y; // Y
  }
  
  // Variables which tells the correct width and height
  $bbox["left"] = 0- min($bbox[0],$bbox[2],$bbox[4],$bbox[6]);
  $bbox["top"] = 0- min($bbox[1],$bbox[3],$bbox[5],$bbox[7]);
  $bbox["width"] = max($bbox[0],$bbox[2],$bbox[4],$bbox[6]) -  min($bbox[0],$bbox[2],$bbox[4],$bbox[6]);
  $bbox["height"] = max($bbox[1],$bbox[3],$bbox[5],$bbox[7]) - min($bbox[1],$bbox[3],$bbox[5],$bbox[7]);
  
  $textarea = $bbox;
  
  
  $height_text = $textarea['height'];
  $width_text = $textarea['width'];
  
  $imageX = imagesx($original);
  $imageY = imagesy($original);

  $coord = coordinatesFromCSSpos($position,array(
      'canvasWidth'=>$imageX,
      'canvasHeight'=>$imageY,
      'objectWidth'=>$width_text,
      'objectHeight'=>$height_text,
      'objectStartTop'=>false,
      'margin'=>$margin
    ));
  $pos_x = $coord['x']; 
  $pos_y = $coord['y'];
  
  // manual adjustment for angles
  if($text_angle >= 0 && $text_angle <= 90)
    $pos_x += floor(($font_size * $text_angle / 90) * 0.5);
  elseif($text_angle >= 270 && $text_angle <= 360)
    $pos_y += floor($font_size * $text_angle / 360);
  
  if(($text_angle >= 0 && $text_angle <= 90) || ($text_angle >= 270 && $text_angle <= 360))
  {
  
    if($text_color == "" || $text_color == null )
    {
      
      $red = array(); 
      $green = array();
      $blue = array();

      $x2 = $pos_x + $width_text;
      $y1 = $pos_y - $height_text;
      $y2 = $pos_y;
      
      for ($x=$pos_x;$x<$x2;$x++)
      {
        for ($y=$y1;$y<$y2;$y++)
        {
          $colorindex = @imagecolorat($original,$x,$y);
          //echo $x." ".$y."<br>";
          $colorrgb = @imagecolorsforindex($original,$colorindex);  
          $red[] = $colorrgb['red'];
          $green[] = $colorrgb['green'];
          $blue[] = $colorrgb['blue'];
        }
      }
    
      // work out average
      $avg_red = ceil( array_sum($red) / count($red) );
      $avg_green = ceil( array_sum($green) / count($green) );
      $avg_blue = ceil( array_sum($blue) / count($blue) );
    
      $average = ($avg_red + $avg_green + $avg_blue) / 3;
      if ($average < $config['watermarkText']['darknessThreshold'])
      {
        $red = min($avg_red + $text_auto_color, 255); 
        $green = min($avg_green + $text_auto_color, 255);
        $blue = min($avg_blue + $text_auto_color, 255);
      }
      else
      {
        $red = max($avg_red - $text_auto_color, 0); 
        $green = max($avg_green - $text_auto_color, 0);
        $blue = max($avg_blue - $text_auto_color, 0);
      }
    
    }
    else
    {
      $rgb = hex2rgb($text_color,false);
      $red = $rgb[0]; 
      $green = $rgb[1];
      $blue = $rgb[2];
    }
    
    $color = ImageColorAllocate($original,$red,$green,$blue);
    
    if($shadow_distance > 0)
    {
      $shadow_x = $pos_x + $shadow_distance;
      $shadow_y = $pos_y + $shadow_distance;
  
      if($shadow_color == "" || $shadow_color == null )
      {
        if ($average < $config['watermarkText']['darknessThreshold'])
        {
          $red = min($red + $shadow_auto_color, 255); 
          $green = min($green + $shadow_auto_color, 255);
          $blue = min($blue + $shadow_auto_color, 255);
        }
        else
        {
          $red = max($red - $shadow_auto_color, 0); 
          $green = max($green - $shadow_auto_color, 0);
          $blue = max($blue - $shadow_auto_color, 0);
        } 
      }
      else
      {
        $rgb = hex2rgb($shadow_color,false);
        $red = $rgb[0]; 
        $green = $rgb[1];
        $blue = $rgb[2];
      }
      
      $shadow_color = ImageColorAllocate($original,$red,$green,$blue);  
      imagettftext($original,$font_size,$text_angle,$shadow_x,$shadow_y,$shadow_color,$text_font,$text);
    
    }
    
    if($text_angle >= 0 && $text_angle <= 90)
      $pos_x += floor(($font_size * $text_angle / 90) * 0.5);
  
    imagettftext($original,$font_size,$text_angle,$pos_x,$pos_y,$color,$text_font,$text);
  }
  
  return $original;
}


function hex2rgb($hex, $asString = true)
{
  // strip off any leading #
  if (0 === strpos($hex, '#'))
    $hex = substr($hex, 1);
  else if (0 === strpos($hex, '&H'))
    $hex = substr($hex, 2);
  
  // break into hex 3-tuple
  $cutpoint = ceil(strlen($hex) / 2)-1;
  $rgb = explode(':', wordwrap($hex, $cutpoint, ':', $cutpoint), 3);
  
  // convert each tuple to decimal
  $rgb[0] = (isset($rgb[0]) ? hexdec($rgb[0]) : 0);
  $rgb[1] = (isset($rgb[1]) ? hexdec($rgb[1]) : 0);
  $rgb[2] = (isset($rgb[2]) ? hexdec($rgb[2]) : 0);
  
  return ($asString ? "{$rgb[0]} {$rgb[1]} {$rgb[2]}" : $rgb);
}



function createFolderThumb($folder,$size)
{
  global $galleryPage, $maxthumbwidth, $maxthumbheight, $config, $getimgurl, $thumbSizes, $themes;
  
  $theme = $themes[$config['selectedTheme']];
  
  $maxthumbwidth = $thumbSizes[$size]['width'];
  $maxthumbheight = $thumbSizes[$size]['height'];
 
  $images = getFolderImages($folder);
  
  $imgNum = count($images);
  
  if($imgNum>0)
  {
    $divider = ceil(sqrt($imgNum));
   
    $thumbnail_width = ceil($maxthumbwidth/$divider);
    $thumbnail_height = ceil($maxthumbheight/$divider);
   
    $thumb = imagecreatetruecolor($maxthumbwidth, $maxthumbheight);
    
    if($config['folderThumbBgColor'] != '#000000')
    {
      $rgb = hex2rgb($config['folderThumbBgColor'],false);
      $colour = imagecolorallocate($thumb, $rgb[0], $rgb[1], $rgb[2]);
      imagefill($thumb, 0, 0, $colour);
    }

    foreach($images as $i => $source)
    {
      $source = $folder.'/'.$source;
      
      list($width_orig, $height_orig) = getimagesize($source); 
     
      $path = pathinfo($source);
     
      switch(strtolower($path["extension"]))
      {
        case "jpeg":
        case "jpg":
            $original=imagecreatefromjpeg($source);
            break;
        case "gif":
            $original=imagecreatefromgif($source);
            break;
        case "png":
            $original=imagecreatefrompng($source);
            break;
        default:
            break;           
      }
     
     
      $ratio_orig = $width_orig/$height_orig;
    
      if($thumbnail_width/$thumbnail_height > $ratio_orig)
      {
        $new_height = $thumbnail_width/$ratio_orig;
        $new_width = $thumbnail_width;
      }
      else
      {
        $new_width = $thumbnail_height*$ratio_orig;
        $new_height = $thumbnail_height;
      }
    
      $x_mid = $new_width/2;
      $y_mid = $new_height/2;
    
      $process = imagecreatetruecolor(round($new_width), round($new_height));
    
      imagecopyresampled($process, $original, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
     
      $x = ($thumbnail_width * ( $i%$divider )+1 ) -1;
      $y = ($thumbnail_height * ( ($i/$divider)%$divider )+1 ) -1;
     
      imagecopyresampled($thumb, $process, $x, $y, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
  
      imagedestroy($process);
      imagedestroy($original);
     
    }
    
    $thumb = addWatermark($thumb);

    //CACHE IMAGE
    if ($config['cachethumbs'] == true)
    {
      if(is_writable($config['cachefolderSavePath']))
      {
        $hs = $config['imgSize'];
        if(key_exists('type',$config) && $config['type']=='column')
          $hs = 'col-'.$size;
        elseif($config['cropImages'])
          $hs = 'crop-'.$config['imgSize'];
      
        $size = getimagesize($source);
        $modifed = filemtime($source);
        $filesize = filesize($source);
        $hash = md5(implode('',$images).$maxthumbwidth.$maxthumbheight);
        $cacheimagename = $config['cachefolderSavePath']."/".$hs."_".$hash.".jpg";
        imagejpeg($thumb,$cacheimagename,$config['cachequality']);
      }
    } 
    //RETURN A JPG TO THE BROWSER 
    if(!DEV_MODE)
      header('Content-type: image/jpeg');
    imagejpeg($thumb);
    imagedestroy($thumb);
  }
  
}



function getImageName($image)
{
  Global $config;

  $path_parts = pathinfo($image);
  if($config['displayImgNameAsFilename'])
  {
    return $path_parts['basename'];
  }
  else
  {
    $imagename = substr($path_parts['basename'], 0, -(strlen($path_parts['extension']) + ($path_parts['extension'] == '' ? 0 : 1)));
    $imagename = stripslashes(displayName($imagename,true));  
    return $imagename;
  }
}


function displayName($name,$imgSeparator=false)
{
  Global $config;
  
  if($config['displayImgNameAsFilename'])
  {
    return $name;
  }
  else
  {
    if($imgSeparator && isset($config['ordernumber_separator_img']))
      $sep = $config['ordernumber_separator_img'];
    else
      $sep = $config['ordernumber_separator'];
      
    if(!empty($sep) && strpos($name,$sep))
      $displayname = substr($name, (strpos($name,$sep)+strlen($sep)));
    else
      $displayname = $name;
    
    $displayname = str_replace("_"," ",$displayname); 
    
    if($config['addCamelCaseSpace'])
      $displayname = preg_replace( '/([a-z])([0-9|A-Z])/', "$1 $2", $displayname);

    return $displayname;
  }
}

function getCommentsFileName($getimage) 
{
  $path_parts = pathinfo($getimage);
  $path_parts['basename_we'] = substr($path_parts['basename'], 0, -(strlen($path_parts['extension']) + ($path_parts['extension'] == '' ? 0 : 1)));
  $commentsfile = $path_parts['dirname']."/".$path_parts['basename_we'].".txt";
  return $commentsfile;
}

function getCommentsText($commentsfile,$removeNL) 
{
  $fp = fopen($commentsfile, "r");
  $comments = fread($fp, filesize($commentsfile));
  fclose($fp);
  
  if($removeNL) 
  {
    $comments = str_replace("\n", " ", $comments);
    $comments = str_replace("\r", " ", $comments);
  }
  $comments = htmlentities(stripslashes($comments));
  
  return $comments;
}

function downloadImage($file)
{
  $path = pathinfo($file);
  
  if(strpos("..",$file) ) {die('download not allowed');}
  
  $file = "./".$file;
  
  if(!file_exists($file))
    die('Error: File not found.');
  else
  {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=".$path['basename']);
    header("Content-Type: application/".$path['extension']);
    header("Content-Transfer-Encoding: binary");
  
    // Read the file from disk
    readfile($file);
  }
}

function customCodeContentForImagePageView($link=null)
{
  // this content is displayed under the image when viewed on the page instead of js
  // here you can add your own custom code to add social sharing and commenting functionality if you wish
  // $link passed into the function contains the URL for the page - add your own domain and path
  // append your content to the $html variable, which is returned at the end of the function

  $html = 'KIIIIIIMMMMMMMMMMMM';
  # your code here

  return $html;
}

function shareThis($file)
{
  
  // add share functionality includes here and define path to your images... then use the file variable to define the photo.
  // if you want to hide the panel after sharing and can hook into js, the js function to call is removeShare()
  
  echo "You are trying to share file: ".$file;
  
}

function imageInfo($file)
{
  Global $galleryfolder , $config;
  
  $file = stripslashes(rawurldecode($file));
  $file = str_replace('&amp;','&',$file);
  
  if(strpos($file,"../")!==false ) {die();}

  $file = './'.$file;

  if(file_exists($file))
  {
    $info = "<table class='exif' style='margin-bottom:20px;'>";

    if($config['imageInfoFileLoc'])
    {
      $path_parts = pathinfo($file);
      $info .= "<tr><td>Filename:</td><td>".$path_parts['basename']."</td></tr>";
      $info .= "<tr><td>Location:</td><td>".$path_parts['dirname']."/</td></tr>";
    }

    $size = getimagesize($file);
    $info .= "<tr><td>Width X Height:</td><td>".$size[0]."px X ".$size[1]."px</td></tr>";
    $info .= "<tr><td>Size:</td><td>".number_format(filesize($file) / 1024)." KB</td></tr>";
    if($config['imageInfoModTime'])
      $info .= "<tr><td>Modified:</td><td>".date("Y-m-d H:i:s", filemtime($file))."</td></tr>";

    $info .= "</table>";

    // if exif is enabled and file supports it
    if($config['exif'] && exif_imagetype($file))
    {
      $data = exif_read_data($file, 0, true);
      
      // this prints out the EXIF info table
      // comment out lines you do not want to display by using // in front
        
      $info .= "<div style='float:left;margin-right:20px;'>";
      $info .= "<table class='exif'>";
      $info .= "<tr><td>DateTimeOriginal</td><td>".(isset($data['EXIF']['DateTimeOriginal'])?$data['EXIF']['DateTimeOriginal']:'')."</td></tr>";  
      $info .= "<tr><td>Make</td><td>"    .(isset($data['IFD0']['Make'])?$data['IFD0']['Make']:'')."</td></tr>";
      $info .= "<tr><td>Model</td><td>"   .(isset($data['IFD0']['Model'])?$data['IFD0']['Model']:'')."</td></tr>";  
      $info .= "<tr><td>FileName</td><td>"    .(isset($data['FILE']['FileName'])?$data['FILE']['FileName']:'')."</td></tr>";
      $info .= "<tr><td>MimeType</td><td>"    .(isset($data['FILE']['MimeType'])?$data['FILE']['MimeType']:'')."</td></tr>";  
      $info .= "<tr><td>Flash</td><td>"   .(isset($data['EXIF']['Flash'])?exif_flash($data['EXIF']['Flash']):'')."</td></tr>";
      $info .= "<tr><td>LightSource</td><td>".(isset($data['EXIF']['LightSource'])?exif_LightSource($data['EXIF']['LightSource']):'')."</td></tr>";
      $info .= "<tr><td>MeteringMode</td><td>"  .(isset($data['EXIF']['MeteringMode'])?exif_MeteringMode($data['EXIF']['MeteringMode']):'')."</td></tr>";
      $info .= "<tr><td>ExposureProgram</td><td>" .(isset($data['EXIF']['ExposureProgram'])?exif_ExposureProgram($data['EXIF']['ExposureProgram']):'')."</td></tr>";
      
      if(isset($data['GPS']))
      {
        $location = getGPS($data['GPS']);
        if(!is_null($location))
        {
          $title = urlencode('('.$data['FILE']['FileName']." taken on ".$data['EXIF']['DateTimeOriginal'].')');
          $info .= "<tr><td>Latitude</td><td>".$location['latitude']."</td></tr>";
          $info .= "<tr><td>Longitude</td><td>".$location['longitude']."</td></tr>";
          $info .= "<tr><td>Google Maps</td><td><a target='_blank' href='http://maps.google.com/maps?q=".$location['latitude'].",+".$location['longitude']."+".$title."&iwloc=A&hl=en'>View</a></td></tr>";
        }
      }
      $info .= "</table>";
      $info .= "</div>";
      $info .= "<div style='float:left;margin-right:20px;'>";
      $info .= "<table class='exif'>";
      $info .= "<tr><td>ExposureTime</td><td>"  .(isset($data['EXIF']['ExposureTime'])?$data['EXIF']['ExposureTime']:'')."</td></tr>";
      $info .= "<tr><td>ApertureFNumber</td><td>" .(isset($data['COMPUTED']['ApertureFNumber'])?$data['COMPUTED']['ApertureFNumber']:'')."</td></tr>";
      $info .= "<tr><td>FNumber</td><td>"   .(isset($data['EXIF']['FNumber'])?$data['EXIF']['FNumber']:'')."</td></tr>";
      $info .= "<tr><td>ExposureBiasValue</td><td>" .(isset($data['EXIF']['ExposureBiasValue'])?$data['EXIF']['ExposureBiasValue']:'')."</td></tr>";
      $info .= "<tr><td>FocalLength</td><td>"   .(isset($data['EXIF']['FocalLength'])?$data['EXIF']['FocalLength']:'')."</td></tr>";
      $info .= "<tr><td>ISOSpeedRatings</td><td>" .(isset($data['EXIF']['ISOSpeedRatings'])?$data['EXIF']['ISOSpeedRatings']:'')."</td></tr>";
      $info .= "<tr><td>ShutterSpeedValue</td><td>" .(isset($data['EXIF']['ShutterSpeedValue'])?$data['EXIF']['ShutterSpeedValue']:'')."</td></tr>";
      $info .= "<tr><td>ApertureValue</td><td>" .(isset($data['EXIF']['ApertureValue'])?$data['EXIF']['ApertureValue']:'')."</td></tr>";
      $info .= "<tr><td>BrightnessValue</td><td>" .(isset($data['EXIF']['BrightnessValue'])?$data['EXIF']['BrightnessValue']:'')."</td></tr>";
      $info .= "</table>";
      $info .= "</div>";
    }

    echo $info;

  }
  else
    echo 'Could not access file';

}



function exif_flash($tag)
{
  if($tag==0) $tag  = "No Flash";
  else if($tag==1) $tag   = "Flash";
  else if($tag==5) $tag   = "Flash, strobe return light not detected";
  else if($tag==7) $tag   = "Flash, strob return light detected";
  else if($tag==9) $tag   = "Compulsory Flash";
  else if($tag==13) $tag  = "Compulsory Flash, Return light not detected";
  else if($tag==15) $tag  = "Compulsory Flash, Return light detected";
  else if($tag==16) $tag  = "No Flash";
  else if($tag==24) $tag  = "No Flash";
  else if($tag==25) $tag  = "Flash, Auto-Mode";
  else if($tag==29) $tag  = "Flash, Auto-Mode, Return light not detected";
  else if($tag==31) $tag  = "Flash, Auto-Mode, Return light detected";
  else if($tag==32) $tag  = "No Flash";
  else if($tag==65) $tag  = "Red Eye";
  else if($tag==69) $tag  = "Red Eye, Return light not detected";
  else if($tag==71) $tag  = "Red Eye, Return light detected";
  else if($tag==73) $tag  = "Red Eye, Compulsory Flash";
  else if($tag==77) $tag  = "Red Eye, Compulsory Flash, Return light not detected";
  else if($tag==79) $tag  = "Red Eye, Compulsory Flash, Return light detected";
  else if($tag==89) $tag  = "Red Eye, Auto-Mode";
  else if($tag==93) $tag  = "Red Eye, Auto-Mode, Return light not detected";
  else if($tag==95) $tag  = "Red Eye, Auto-Mode, Return light detected";
  else $tag     = "Unknown: ".$tag;

  return $tag;
}

function exif_LightSource($tag)
{
  if($tag==0) $tag  = "Unknown or Auto";
  else if($tag==1) $tag   = "Daylight";
  else if($tag==2) $tag   = "Flourescent";
  else if($tag==3) $tag   = "Tungsten";
  else if($tag==10) $tag  = "Flash";
  else if($tag==17) $tag  = "Standard Light A";
  else if($tag==18) $tag  = "Standard Light B";
  else if($tag==19) $tag  = "Standard Light C";
  else if($tag==20) $tag  = "D55";
  else if($tag==21) $tag  = "D65";
  else if($tag==22) $tag  = "D75";
  else if($tag==255) $tag = "Other";
  else $tag     = "Unknown: ".$tag;

  return $tag;
}


function exif_MeteringMode($tag)
{
  if($tag==0) $tag  = "Unknown";
  else if($tag==1) $tag   = "Average";
  else if($tag==2) $tag   = "Center Weighted Average";
  else if($tag==3) $tag   = "Spot";
  else if($tag==4) $tag   = "Multi-Spot";
  else if($tag==5) $tag   = "Multi-Segment";
  else if($tag==6) $tag   = "Partial";
  else if($tag==255) $tag = "Other";
  else $tag     = "Unknown: ".$tag;

  return $tag;
}


function exif_ExposureProgram($tag)
{
  if($tag==1) $tag  = "Manual";
  else if($tag==2) $tag   = "Program";
  else if($tag==3) $tag   = "Aperature Priority";
  else if($tag==4) $tag   = "Shutter Priority";
  else if($tag==5) $tag   = "Program Creative";
  else if($tag==6) $tag   = "Program Action";
  else if($tag==7) $tag   = "Portrat";
  else if($tag==8) $tag   = "Landscape";
  else $tag     = "Unknown: ".$tag;

  return $tag;
}


function getGPS($gpsData)
{
  if(!isset($gpsData['GPSLatitude']) || !isset($gpsData['GPSLongitude']))
    return null;

  $lat = $gpsData['GPSLatitude']; 
  $log = $gpsData['GPSLongitude'];
  if (!$lat || !$log) return null;
  
  // latitude values
  $lat_degrees = divide($lat[0]);
  $lat_minutes = divide($lat[1]);
  $lat_seconds = divide($lat[2]);
  $lat_hemi = $gpsData['GPSLatitudeRef'];

  // longitude values
  $log_degrees = divide($log[0]);
  $log_minutes = divide($log[1]);
  $log_seconds = divide($log[2]);
  $log_hemi = $gpsData['GPSLongitudeRef'];

  $lat_decimal = toDecimal($lat_degrees, $lat_minutes, $lat_seconds, $lat_hemi);
  $log_decimal = toDecimal($log_degrees, $log_minutes, $log_seconds, $log_hemi);

  return array('latitude'=>$lat_decimal, 'longitude'=>$log_decimal);

}

function toDecimal($deg, $min, $sec, $hemi)
{
  $d = $deg + $min/60 + $sec/3600;
  
  if($hemi=='S' || $hemi=='W')
    $d = $d*=-1;
  
  return $d;
}

function divide($a)
{
// evaluate the string fraction and return a float // 
  $e = explode('/', $a);
// prevent division by zero //
  if (!$e[0] || !$e[1]) {
    return 0;
  } else{
  return $e[0] / $e[1];
  }
}





function endsWithSlash($s) 
{
  return (strrpos($s,'/') == strlen($s) - 1);
}  

function changeTheme($theme)
{
  setcookie("theme", $theme, time()+3600*24*365,"/");
  header("Location: ".$_SERVER["HTTP_REFERER"]);
}

function changeSize($size)
{
  setcookie("size", $size, time()+3600*24*365,"/");
  header("Location: ".$_SERVER["HTTP_REFERER"]);
}

function addPostArrayElement($name,$i="")
{
  return "\t".'"'.$name.'"=> "'.(addslashes($_POST[$name][$i])).'",'."\r\n";
}
function addPostElement($name,$q=true)
{
  return "\t".'"'.$name.'"=> '.($q?'"':'').(addslashes($_POST[$name])).($q?'"':'').','."\r\n";
}

function gallerySetup($setup)
{
  Global $galleryPage,$config,$getimgurl,$self;
  
  if($setup=="imgtext")
  {
    $baseUrl = $self.'setup=imgtext'.(!empty($galleryPage['f'])?'&f='.$galleryPage['f']:'');
    $baseLink = $self.'setup=imgtext';
    
    
    if(isset($_POST['save']))
    {
      if(empty($_POST['cachequality']))
        $_POST['cachequality']='90';
      
      $configFile = "<?php \r\n";
      
      $configFile.= '$gallerySetup = array('."\r\n";
      $configFile.= addPostElement("username");
      $configFile.= addPostElement("password");
      $configFile.= addPostElement("displayImgName","",false);
      $configFile.= addPostElement("displayImgTitle","",false);
      $configFile.= addPostElement("displayAuthor","",false);
      $configFile.= addPostElement("defaultAuthor");
      $configFile.= addPostElement("albumDescriptionTop");
      $configFile.= addPostElement("albumDescriptionBottom");
      $configFile.= addPostElement("cropImages","",false);
      $configFile.= addPostElement("cachethumbs","",false);
      $configFile.= addPostElement("cachequality");
      $configFile.= addPostElement("filesort");
      $configFile.= addPostElement("foldersort");
      $configFile.= addPostElement("ordernumber_separator");
      $configFile.= addPostElement("paging");
      $configFile.= addPostElement("limit");
      $configFile.= addPostElement("exif");
      $configFile.= ');'."\r\n\r\n";
      
      $configFile.= '$imgText = array('."\r\n\r\n";
      if(isset($_POST['image_name']))
      {
        foreach($_POST['image_name'] as $i => $image)
        {
          $configFile.= '"'.$image.'"';
          $configFile.= "\t".'=> array('."\r\n";
          $configFile.= addPostArrayElement("title",$i);
          $configFile.= addPostArrayElement("caption",$i);
          $configFile.= addPostArrayElement("author",$i);
          $configFile.= "\t".'),'."\r\n";
        }
      }
      $configFile.= "\r\n".');'."\r\n\r\n";
      $configFile.= '?>'."\r\n";

      $filename = $galleryPage['folder']."config.php";
      $handle = fopen($filename, 'w');
      if(!$handle)
        $msg = "Cannot open file ($filename)";
      if(fwrite($handle, $configFile) === FALSE)
        $msg = "Cannot write to file ($filename)";
      else
        $msg = "Data <b>saved</b> in '".$filename."'";
      fclose($handle);
      
      
      $filename = $galleryPage['folder']."folder.txt";
      if(isset($_POST['default']) && !empty($_POST['default']))
      {
        $handle = fopen($filename, 'w');
        if(!$handle)
          $msg2 = "Cannot open file ($filename)";
        if(fwrite($handle, $_POST['default']) === FALSE)
          $msg2 = "Cannot write to file ($filename)";
        else
          $msg2 = "Data <b>saved</b> in '".$filename."'";
        fclose($handle);

        if(isset($config['newFileAndDirChmod']) && !is_null($config['newFileAndDirChmod']))
          @chmod($filename,octdec($config['newFileAndDirChmod']));
      }
      else
      {
        if(file_exists($filename))
        {
          if(unlink($filename))
            $msg2 = 'Deleted '.$filename;
          else
            $msg2 = 'Error in deleting '.$filename;
        }
        else
          $msg2 = '';
      }
      
      echo '<div style="background-color:#666;color:#fff;padding:30px;">'.$msg.'<br>'.$msg2.'</div>';
    }
    elseif(isset($_POST['createfolder']) && !empty($_POST['newfolder']))
    {
      $dirName = trim($_POST['newfolder']);
      $dirName = str_replace(array(' '),array('_'),$dirName);
      $dirName = $galleryPage['folder'].$dirName;
      if(mkdir($dirName))
      {
        if(isset($config['newFileAndDirChmod']) && !is_null($config['newFileAndDirChmod']))
          @chmod($dirName,octdec($config['newFileAndDirChmod']));

        $msg = 'Folder "'.$dirName.'" created.';
      }
      else
        $msg = 'Could not create folder.';
        
      echo '<div style="background-color:#666;color:#fff;padding:30px;">'.$msg.'</div>';
      
      $galleryPage = readFolder();
    }
    elseif(isset($_GET['delete']) && !empty($_GET['delete']))
    {
      $location = $galleryPage['folder'].$_GET['delete'];
      if(file_exists($location))
      {
        if($config['allowAlbumDelete'] && is_dir($location))
        {
          if(rrmdir($location))
            $msg = 'Deleted: '.$location;
          else
            $msg = 'Could not delete '.$location;
        }
        elseif($config['allowImageDelete'])
        {
          if(unlink($location))
            $msg = 'Deleted: '.$location;
          else
            $msg = 'Could not delete '.$location.' (check file permissions on server)';
        }
        else
          $msg = 'Not allowed to delete... change options.';
      }
      else
        $msg = 'Could not find: '.$location;
        
      echo '<div style="background-color:#666;color:#fff;padding:30px;">'.$msg.'</div>';
      
      $galleryPage = readFolder();
    }
    elseif(isset($_POST['deleteGallery']) && $_POST['deleteGallery']=='true')
    {
      if(isset($_POST['deleteGalleryConfirm']) && $_POST['deleteGalleryConfirm']=='true')
      {
        // delete files
        foreach($galleryPage['img_array'] as $file)
        {
          unlink($galleryPage['folder'].$file);
        }
        
        // delete folders
        foreach($galleryPage['folder_array'] as $folder)
        {
          rrmdir($galleryPage['folder'].$folder);
        }
        
        // clear thumbs
        $cacheDir = dir($galleryPage['folder'].$config['cachefolder']);
        while(($cacheFile = $cacheDir->read()) !== false)
        {       
          if($cacheFile!="." && $cacheFile!="..")
            unlink($galleryPage['folder'].$config['cachefolder'].'/'.$cacheFile);
        }

        echo '<h1>Gallery Cleared!</h1>';
        
        $galleryPage = readFolder();
      }
      else
      {
        echo '
        <div style="font-weight:bold;margin-bottom:100px;">
        <h1>Are you sure you want to delete everything?</h1>
        <p>This will delete:</p>
        <ul>
          <li>All Photos currently visible in the gallery</li>
          <li>All Subfolders currently visible in the gallery</li>
          <li>All Cached thumbnail files</li>
        </ul>
        <form name="edit" method="post" action="'.$baseUrl.'">
            <input type="hidden" name="deleteGallery" value="true" />
            <input type="hidden" name="deleteGalleryConfirm" value="true" />
            <input type="submit" name="delete_gallery" value="Yes, DELETE ALL PHOTOS AND ALBUMS" />
          </form>
          
         <br/>
         <a href="'.$baseUrl.'">No, Cancel. Do not delete anything.</a>
        </div>';
      }
    }
    
    $unsetText = 'This is the Album image, click to unset';
    $setText = 'Set as the Album image';
    $uncheckedClass = "defaultUnchecked";
    $checkedClass = 'defaultChecked';
    
    $imgSetup = getImgSetup($galleryPage['img_array'],$galleryPage['folder']);
  
      if(isset($_GET['f']) && !empty($_GET['f']))
        $isSubFolder = true;
      else
        $isSubFolder = false;
    
      echo '
      <script type="text/javascript">
      function selectDefault(id)
      {
        if($("#check"+id).text()=="'.$setText.'")
        {
          $("#defaultImg").val( $("#img"+id).val() );
          $(".defaults").text("'.$setText.'").removeClass("'.$checkedClass.'").addClass("'.$uncheckedClass.'");
          $("#check"+id).text("'.$unsetText.' - NOT SAVED").addClass("'.$checkedClass.'");
        }
        else
        {
          $("#defaultImg").val("");
          $(".defaults").text("'.$setText.'").removeClass("'.$checkedClass.'").addClass("'.$uncheckedClass.'");
        }
      }
      </script>
      <form name="edit" method="post" action="'.$baseUrl.'">
      ';
      if($isSubFolder)
      {
        $filename = (($galleryPage['folder']=="./")?$galleryPage['folder']:$galleryPage['folder']."/")."folder.txt";
        if(file_exists($filename))
        {
          $default = file($filename);
          $default = rtrim($default[0]);
        }
        else
          $default = '';
        echo '<input type="hidden" name="default" id="defaultImg" value="'.$default.'" />';
      }
      
      echo '
      <div style="float:left;margin-right:40px;width:680px;">
      <table border="0" cellpadding="0" cellspacing="5" style="font-size:12px;">
      ';
      

        
      $i=0;
      foreach($galleryPage['img_array'] as $image)
      {
        $i++;
        if(isset($imgSetup[$image]['title']))
          $title = stripslashes($imgSetup[$image]['title']);
        else
          $title = '';
        if(isset($imgSetup[$image]['caption']))
          $caption = stripslashes($imgSetup[$image]['caption']);
        else
          $caption = '';
        if(isset($imgSetup[$image]['author']))
          $author = stripslashes($imgSetup[$image]['author']);
        else
          $author = '';
          
        $thumb = getThumbnail($galleryPage['folder'],$image,"small");
        echo '
        <tr>
          <td rowspan="4" style="text-align:center;">'.$thumb['img'].'
            <input type="hidden" name="image_name[]" value="'.$image.'" id="img'.$i.'" /></td>
          <td style="text-align:right;">Title:</td>
          <td ><input type="text" name="title[]" value="'.$title.'" size="40" /></td>
        </tr>
        <tr>
          <td style="text-align:right;">Caption:</td>
          <td><input type="text" name="caption[]" value="'.$caption.'" size="60"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">Author:</td>
          <td ><input type="text" name="author[]" value="'.$author.'" size="20"/></td>
          ';
        
        
        $showSetDefault = false;
        if($isSubFolder)
        {
          $showSetDefault = true;
          if($default==$image)
          {
            $class = $checkedClass;
            $text = $unsetText;
          }
          else
          {
            $class = $uncheckedClass;
            $text = $setText;
          }
        }
        
          echo '
          <tr>
            <td style="text-align:right;"></td>
            <td>'.($showSetDefault?'<span onclick="selectDefault('.$i.');" class="defaults '.$class.'" id="check'.$i.'">'.$text.'</span>':'').'
            <div style="float:right;">
            '.($config['allowImageDelete']?'<a href="'.$baseUrl.'&delete='.$image.'" onclick="return confirm(\'Are you sure you want to delete this image?\');">Delete</a>':'').'
            </div>
            </td>
          </tr>
          ';
        
          echo '
        </tr>
        <tr><td colspan="3" style="background-color:#666;font-size:5px;line-height:5px;">&nbsp;</td></tr>
        ';
      }
      
      echo '
      </table>
      </div>
      <div style="float:left;margin-right:20px;">
      <table border="0" cellpadding="0" cellspacing="5" style="font-size:12px;">
        <tr>
          <td colspan="2">Album Descrption:<br/>
          <i>Top</i><br/>
          <textarea name="albumDescriptionTop" cols="40" rows="4">'.stripslashes($config['albumDescriptionTop']).'</textarea><br/>
          <i>Bottom</i><br/>
          <textarea name="albumDescriptionBottom" cols="40" rows="4">'.stripslashes($config['albumDescriptionBottom']).'</textarea>
          </td>
        </tr>
        <tr>
          <td style="text-align:right;">Titles on page:</td>
          <td><select name="displayImgName">
              <option value="true" '.(isset($config['displayImgName']) && $config['displayImgName']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['displayImgName']) && !$config['displayImgName']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Titles in viewer:</td>
          <td><select name="displayImgTitle">
              <option value="true" '.(isset($config['displayImgTitle']) && $config['displayImgTitle']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['displayImgTitle']) && !$config['displayImgTitle']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Display Author:</td>
          <td><select name="displayAuthor">
              <option value="true" '.(isset($config['displayAuthor']) && $config['displayAuthor']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['displayAuthor']) && !$config['displayAuthor']?'selected':'').'>false</option>
          </select></td>
        </tr>
        
        <tr>
          <td style="text-align:right;">Default Author:</td>
          <td ><input type="text" name="defaultAuthor" value="'.(isset($config['defaultAuthor'])?$config['defaultAuthor']:'').'" size="20"/></td>
        </tr>
        
        <tr>
          <td style="text-align:right;">Crop Images:</td>
          <td><select name="cropImages">
              <option value="true" '.(isset($config['cropImages']) && $config['cropImages']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['cropImages']) && !$config['cropImages']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Cache Thumbs:</td>
          <td><select name="cachethumbs">
              <option value="true" '.(isset($config['cachethumbs']) && $config['cachethumbs']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['cachethumbs']) && !$config['cachethumbs']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Cache Quality:</td>
          <td ><input type="text" name="cachequality" value="'.$config['cachequality'].'" size="3"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">File Sort:</td>
          <td><select name="filesort">
              <option value="asc" '.(isset($config['filesort']) && $config['filesort']=="asc"?'selected':'').'>asc</option>
              <option value="desc" '.(isset($config['filesort']) && $config['filesort']=="desc"?'selected':'').'>desc</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Folder Sort:</td>
          <td><select name="foldersort">
              <option value="asc" '.(isset($config['foldersort']) && $config['foldersort']=="asc"?'selected':'').'>asc</option>
              <option value="desc" '.(isset($config['foldersort']) && $config['foldersort']=="desc"?'selected':'').'>desc</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Ordernumber Separator:</td>
          <td ><input type="text" name="ordernumber_separator" value="'.$config['ordernumber_separator'].'" size="5"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">Use Paging:</td>
          <td><select name="paging">
              <option value="true" '.(isset($config['paging']) && $config['paging']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['paging']) && !$config['paging']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr>
          <td style="text-align:right;">Limit:</td>
          <td ><input type="text" name="limit" value="'.(isset($config['limit'])?$config['limit']:'').'" size="5"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">Use EXIF:</td>
          <td><select name="exif">
              <option value="true" '.(isset($config['exif']) && $config['exif']?'selected':'').'>true</option>
              <option value="false" '.(isset($config['exif']) && !$config['exif']?'selected':'').'>false</option>
          </select></td>
        </tr>
        <tr><td >&nbsp;</td><td >&nbsp;</td></tr>
        <tr>
          <td style="text-align:right;">Username:</td>
          <td ><input type="text" name="username" value="'.(isset($config['username'])?$config['username']:'').'" size="10"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">Password:</td>
          <td ><input type="text" name="password" value="'.(isset($config['password'])?$config['password']:'').'" size="10"/></td>
        </tr>
      </table>
      
      <input type="submit" name="save" value="SAVE" />
      ';
      
      $galleryUrl = $self.(!empty($galleryPage['f'])?'f='.$galleryPage['f']:'');
      echo '
          <button type="button" onclick="window.location=\''.$galleryUrl .'\';return false;">DONE</button>
        </form>
        ';
     
        
        
      if($config['allowImageUpload'])
      {
        echo '
        <div id="uploads" style="margin-top:40px; width:300px;">
        <b>Upload Images:</b><br/>
        <form name="upload" id="uploadForm" method="post" action="'.$baseUrl.(!empty($galleryPage['f'])?'&f='.$galleryPage['f']:'').'" enctype="multipart/form-data">
        <input style="float:right;" type="submit" name="upload" value="Upload" />
        <input type="file" name="fileupload[]" class="fileupload" >
        <a style="float:right;padding:3px;background-color:#555;color:#fff;border:1px solid #000;text-decoration:none;line-height:12px;" href="#" onclick="javascript: return uploadAnother( this );">+</a>
        </form>
        </div>
        ';
      }
      
      if(count($galleryPage['folder_array'])>0)
      {
        echo '<div style="margin-top:40px;"><b>Sub folders:</b><br/>';
        foreach($galleryPage['folder_array'] as $folder)
        {
          $changeFLink = $baseLink.'&f='.(isset($_GET['f'])?$_GET['f'].'/':'').$folder;
          echo '<a href="'.$changeFLink.'">'.$folder.'</a> ';
          if($config['allowAlbumDelete'])
            echo '<span style="font-size:10px;">(<a href="'.$baseUrl.'&delete='.$folder.'" onclick="return confirm(\'Are you sure you want to delete this album?\');">Delete</a>)</span>';
          echo '<br/>';
        }
        echo '</div>';
      }
      
      
      if($config['allowAlbumCreation'])
      {
        echo '
        <div style="margin-top:40px;">
        <b>Create new sub folder:</b><br/>
          <form name="edit" method="post" action="'.$baseUrl.(!empty($galleryPage['f'])?'&f='.$galleryPage['f']:'').'">
            <input type="text" name="newfolder" value="" size="20" />
            <input type="submit" name="createfolder" value="Create Folder" />
          </form>
        </div>
        ';
      }
      
      if($config['allowGalleryDelete'])
      {
        echo '
        <div style="margin-top:40px;">
        <b>Delete gallery:</b><br/>
        <form name="edit" method="post" action="'.$baseUrl.'">
            <input type="hidden" name="deleteGallery" value="true" />
            <input type="submit" name="delete_gallery" value="Remove all files" />
          </form>
        </div>
        ';
      }
      
      echo '</div>';
      
  }
}




function galleryLogin()
{
  Global $galleryPage, $config;
  

  if(isset($_POST['login']))
  {
    if(isset($_POST['folder']))
      getAlbumConfig($_POST['folder']);
    
    if($_POST['username']==$config['username'] && $_POST['password']==$config['password'])
    {
      setcookie("userlogin", md5($config['username'].$config['password']), time()+3600*24*365,"/");
      header("Location: ".$_POST['referer']);
    }
    else
    {
      echo printHeader();
      echo '<div style="text-align:center;margin:30px;font-weight:bold;font-size:16px;">Error Logging in</div>';
      galleryLoginForm();
      echo printFooter();
    }
  }

}


function galleryAdminLogin()
{
  Global $galleryPage, $loginEnabled, $galleryUsername, $galleryPassword;
  
  if($loginEnabled)
  {
    if(isset($_POST['login']))
    {
      if($_POST['username']==$galleryUsername && $_POST['password']==$galleryPassword)
      {
        setcookie("login", md5($galleryUsername.$galleryPassword), time()+3600*24*365,"/");
        header("Location: ".$_POST['referer']);
      }
      else
      {
        echo printHeader();
        echo '<div style="text-align:center;margin:30px;font-weight:bold;font-size:16px;">Error Logging in</div>';
        galleryAdminLoginForm();
        echo printFooter();
      }
    }

  }
  else
  {
    echo "Login is not enabled";
  }
}
function galleryLogout()
{
  global $includemode;
  
  if($includemode)
  {
    echo '
    <script type="text/javascript">
    date = new Date();
    date.setDate(date.getDate() -1);
    document.cookie = escape("login") + "=;expires=" + date;
    document.cookie = escape("userlogin") + "=;expires=" + date;
    window.location.replace("'.$_SERVER['HTTP_REFERER'].'");
    </script>
    ';
  }
  else
  {
    setcookie("login", "", time()+3600*24*365,"/");
    setcookie("userlogin", "", time()+3600*24*365,"/");
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
}

function galleryAdminLoginForm()
{
  Global $loginEnabled,$getimgurl;
  
  if($loginEnabled)
  {
      echo '
      <form name="edit" method="post" action="'.$getimgurl.'login=true">
      <input type="hidden" name="referer" value="'.(!empty($_POST['referer'])?$_POST['referer']:(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'')).'" />
      <table border="0" cellpadding="0" cellspacing="15" style="font-size:12px;width:300px;margin:30px auto;">
        <tr>
          <td style="text-align:right;">Username:</td>
          <td><input type="text" name="username" value="" size="15"/></td>
        </tr>
        <tr>
          <td style="text-align:right;">Password:</td>
          <td ><input type="password" name="password" value="" size="15"/></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td ><input type="submit" name="login" value="LOGIN" /></td>
        </tr>
      </table>
      </form>
      ';
  }
  else
  {
    echo "Login is not enabled";
  }
  
}



function galleryLoginForm()
{
  Global $config,$self,$getimgurl;
  
  if(isset($_POST['folder']) && !empty($_POST['folder']))
  {
    $referer = $self."f=".$_POST['folder'];
    $folder = $_POST['folder'];
  }
  elseif(isset($_GET['f']) && !empty($_GET['f']))
  {
    $referer = $self."f=".$_GET['f'];
    $folder = $_GET['f'];
  }
  else
  {
    $referer = $self;
    $folder = '';
  }
  
  echo '<div style="text-align:center;">';
  echo $config['login_required'];
  echo '</div>';
  
  echo '
  <form name="edit" method="post" action="'.$getimgurl.'userlogin=true">
  <input type="hidden" name="referer" value="'.$referer.'" />
  <input type="hidden" name="folder" value="'.$folder.'" />
  <table border="0" cellpadding="0" cellspacing="15" style="font-size:12px;width:300px;margin:30px auto;">
    <tr>
      <td style="text-align:right;">Username:</td>
      <td><input type="text" name="username" value="" size="15"/></td>
    </tr>
    <tr>
      <td style="text-align:right;">Password:</td>
      <td ><input type="password" name="password" value="" size="15"/></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td ><input type="submit" name="login" value="LOGIN" /></td>
    </tr>
  </table>
  </form>
  ';
  
}


function requireLogIn()
{
  global $config,$galleryUsername,$galleryPassword;
  
  if(isset($_GET['f']))
    getImgSetup(array(),$_GET['f']);
  
  if($config['username']=='' && $config['password']=='')
    return false;
  else
    return true;
}

function loggedIn()
{
  global $config,$galleryUsername,$galleryPassword;
  
  if(isset($_GET['f']))
    getImgSetup(array(),$_GET['f']);
  
  if( isset($_COOKIE['userlogin']) && $_COOKIE['userlogin'] == md5($config['username'].$config['password']) )
    return true;
  elseif( isset($_COOKIE['login']) && $_COOKIE['login'] == md5($galleryUsername.$galleryPassword) )
    return true;
  else
    return false;
}



function processUploads(  )
{
  global $galleryPage,$config,$includemode,$self;
  
  $galleryPage = readFolder();
  
  if($config['allowImageUpload'])
  {
    
    $target_path = (($galleryPage['folder']=="./")?$galleryPage['folder']:$galleryPage['folder']."/");
      
    $errors = 0;
    while(list($key,$value) = each($_FILES['fileupload']['name']))
    {
      if(!empty($value))
      { 
        $target_file = $target_path.basename( $_FILES['fileupload']['name'][$key]);
        if(move_uploaded_file($_FILES['fileupload']['tmp_name'][$key], $target_file))
        {
          if(isset($config['newFileAndDirChmod']) && !is_null($config['newFileAndDirChmod']))
            @chmod($target_file,octdec($config['newFileAndDirChmod']));

          if($config['resizeUploadedImages'] || $config['watermarkUploadedImages'])
            resizeUploadedImage($target_file);
        }
        else
          $errors++;
      }
    }
    
    if($errors)
    {
      echo "<br>There was an error uploading one of the files, please try again!<br><br>";
      exit();
    }
    else
    {
      if($includemode)
      {
        $galleryUrl = $self.'setup=imgtext&f='.(!empty($_GET['f'])?$_GET['f']:'');
        echo '<script type="text/javascript">
        window.location=\''.$galleryUrl.'\';
        </script>';
      }
      else
      {
        header("Location: ?setup=imgtext&f=".(empty($_GET['f'])?'':$_GET['f']));
        exit();
      }
    }
  }
  else
  {
    echo "<br>File uploads not enabled in options<br><br>";
    exit();
  }
}


function rrmdir($dir)
{
  if(is_dir($dir))
  {
    $objects = scandir($dir);
    foreach ($objects as $object)
    {
      if($object != "." && $object != "..")
      {
        if(filetype($dir."/".$object) == "dir")
        {
          if(!rrmdir($dir."/".$object))
            return false;
        }
        else
        {
          if(!unlink($dir."/".$object))
            return false;
        }
      }
    }
    reset($objects);
    if(!rmdir($dir))
      return false;
  }
  
  return true;
} 



/////////////////////////////////////////////////////////////////
// ENCODED IMAGES
/////////////////////////////////////////////////////////////////

function getEncodedImage($img) 
{

$images = array(
"gallery-img-bg-black"=> array("image/jpeg", "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAQgAA/+4ADkFkb2JlAGTAAAAAAf/bAIQABQMDAwQDBQQEBQcFBAUHCAYFBQYICggICAgICgwKCwsLCwoMDAwMDAwMDA8PEBAPDxYVFRUWGBgYGBgYGBgYGAEFBgYKCQoTDAwTFBEOERQYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgY/8AAEQgAbQCHAwERAAIRAQMRAf/EAF0AAQEBAAMBAQEAAAAAAAAAAAAEAwECBwYFCAEBAAAAAAAAAAAAAAAAAAAAABABAAMBAQEAAgMAAAAAAAAAAGEDBAECUREhMUEiEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD4EAAAHXvvzwGfq/nAY2aefQT2a5BLbskEtu2QSW7pBJbukEdu6QSW7ZBJbtkEtuyQTetf+ufv+we5g473nAdPVvngMvengJ7NUgmt2SCW3bIJbd0gjt3SCS3dIJLd0gkt2yCS3bIJbdkgms1yCezT36DDujv54D+gfejnAYWaufQT2a5BLbskEtu2QSW7pBJbukEdu6QSW7pBJbtkEtuyQS2a5BPZq79BP70d+gy9Xd6Dp313oOAe527JBLbtkElu6QSW7pBJbukEdu6QS27ZBJbtkEtuyQTWapBP70yDH1f3oM+++9B1AAAB6xbukEd26QSW7pBJbtkElu2QS27JBNZrkE1mqQYe9HQZerfXQde970HAAAAAAPurd0gkt2yCW3Z/P7BLZrkE9mqQT+9PfoMfV3egz7670HAAAAAAAAAP37Nkgms1yCezT36DD3o70GXbPXQdfyAAAAAAAAAAACr3o6DH1d3oOnfXeg4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB//9k="),
"gallery-img-bg-white"=> array("image/jpeg", "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAASwAA/+4ADkFkb2JlAGTAAAAAAf/bAIQAAwICAgICAwICAwUDAwMFBQQDAwQFBgUFBQUFBggGBwcHBwYICAkKCgoJCAwMDAwMDA4ODg4OEBAQEBAQEBAQEAEDBAQGBgYMCAgMEg4MDhIUEBAQEBQREBAQEBARERAQEBAQEBEQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQ/8AAEQgAbQCHAwERAAIRAQMRAf/EAFsAAQEBAQEBAQEBAAAAAAAAAAADBAIBBwYFCAEBAAAAAAAAAAAAAAAAAAAAABABAAMBAQEBAQEAAAAAAAAAAAECAwRhQRExUREBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A/wBygA9isyCtMZkGnPm8Bsy5fAbceTwGzLmiPgNVMPAaKY+AvTEGimPgLUyBauQLVzBWlfwHQPiURM/wFaYzINGfPM/AbMuXwG3Hk8Bty5YgGnPDwGimINFMQXpiC9MgWrkCtcwVrQHUREA9AB8fz5ga8uXwG3Hk8Bty5Yj4DVnh+A0UxBemIL0xBemQLUyBauYKVoDuIiAegAAA+bY8ngNuXLEfAas8P8gGimINFMQXpiC9MgWrkC1cwUrQHcREA9AAAAAB+Mzw/PgNNMQXpiC9MQXpkC9cgVrmCtaA7isQD0AAAAAAAH5ymIL0xBemQLUyBauYKVoCkViAegAAAAAAAAA/k0yBemQK1zBWuYKRWIB6AAAAAAAAAAADLXMFa5g7isQDoAAAAAAAAAAAAAHMViAdAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//Z"),
"stripe-bg"=> array("image/png", "iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAIAAABv85FHAAAAVklEQVQImW3OIQ4EMQwEwR4SKTT/f5uRsaEthfjYnrRrXpoeZWZE3HuBtdY5Z+8NAOpuoKq+Qpn5wJeQmb2mHiF3H2NVpe4eY/8v4x25+xgDZGZjLCJ+2kZhURjdQ9AAAAAASUVORK5CYII="),
"blank"=> array("image/gif", "R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="),
"prev"=> array("image/gif", "R0lGODlhLQAtAPebAOrq6nt7e319fdfX19XV1UVFRbOzs6+vr8bGxru7u7+/v7CwsHd3d7W1tX9/f8LCwicnJ8fHx3p6eigoKHx8fLy8vL29vaysrKioqLGxsXh4eKGhoSoqKjg4OLKysq6urr6+vmRkZKOjo5aWlqCgoLi4uHZ2dn5+fqKiojAwMKampoiIiI2Nja2trcjIyM7OzpCQkEZGRpiYmFJSUsPDw83NzbS0tIKCgpqamsnJyWZmZikpKYSEhCsrK7a2tqqqqmFhYW9vb7m5uU9PT2lpaV1dXbq6ulZWVldXV8TExHJycv39/aenp8/Pz/v7+0BAQKmpqTU1NZOTky8vL5+fn2tra0hISDMzM0tLS05OToyMjG5ubp2dnaWlpcHBwUlJSczMzGhoaImJiVFRUS4uLj09PYCAgG1tbXV1dTw8PLe3t0dHR8DAwJycnF5eXqurq0NDQ2xsbIqKimBgYEpKSjk5OXFxcZKSksXFxYeHh3l5eWpqaltbW01NTVNTU0JCQkFBQZubmz8/P1lZWcvLy6SkpNjY2Do6OiwsLHNzc8rKyjY2No6OjlhYWIuLiy0tLTQ0NFpaWmJiYo+Pj4WFhZSUlJWVlXR0dDIyMmNjY////////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAJsALAAAAAAtAC0AAAj/ADUJHEiwoMGDCA9u2pSwocOHAhlCnEixosWLGDNq3Mhx4IAVmUKKHJmJCAsAHQkOIMlyZAAnKTWtzCSABIYDaiw8QOAiRwQECgJkGpByJoMRJKBkEKIgSQQXLiJ4Efqy40wljkZs+GEgAZskCMJ6oZApAEqOM7fc0IJDRIsGXh/QoBG07NmNM6tI4AGDi4oDPhKAUKCgAtW7GmcSQXNCjFYoCxqUMJKghAS7VkOGUbIXRpsuFxYYaODDgAbMaEPqCMLADAscKDC0WJAhwwcGqPGGDFElkQDHGzBcOED8jYnciUMCCXGGAQ8pVJjMXnDAOPKMM4vwCbGFgpY2Kj4Y/7Bh4ABus5kzIRlyBEgQM1JQXDBQQkiD0+hTZ5oBx8oYN0HcIIMKGZRQQQKHpTdEB4cI8sUgcdyAAwY2VGABWflx5EEmQ2AyRQqLADKGDifIgAFcGCK20QKZYNHDDhyQ0YEVRTBwhwoNVECWACpqREBIMUAAwQ5TlDFDHCts4IECNAhAU48Z/ZhJARBMwMEVBbghgQwXJIBADic8GZOUVE6ASB1Z7LGCCDY8QEgNDoiZEplVpvBEI2hU8oMRCLzQRJw8jhkSlRxAsgYQDnBxgAUR+AkolBiROUEPHfQRBiUkZACCCy+88KigU05ARhoznCEHCktGUAOccnZE5g52HqJhBwsiGAACAmCAEWagcw56JRyRXDJJIR5YgIciOTjJq6uD9hBFDEWYAIMICyTwwE/KQnoRmY90QMccGsCAwgdqgPDAA0Ity5GUMaRQRhaS6MEIFVwJYUEFl6m7kZRrRPGHHyFoIEcgXbRggA/30bQEqFik8QUSOjCQhyUkMDHcB8cZEpMmUrbEkgALb0wASB6HZJK2G6es8sostyxRywktFBAAOw=="),
"prev-black"=> array("image/gif", "R0lGODlhLQAtAPebABUVFYSEhIKCgigoKCoqKrq6ukxMTFBQUDk5OUREREBAQE9PT4iIiEpKSoCAgD09PdjY2Dg4OIWFhdfX14ODg0NDQ0JCQlNTU1dXV05OToeHh15eXtXV1cfHx01NTVFRUUFBQZubm1xcXGlpaV9fX0dHR4mJiYGBgV1dXc/Pz1lZWXd3d3JyclJSUjc3NzExMW9vb7m5uWdnZ62trTw8PDIyMktLS319fWVlZTY2NpmZmdbW1nt7e9TU1ElJSVVVVZ6enpCQkEZGRrCwsJaWlqKiokVFRampqaioqDs7O42NjQICAlhYWDAwMAQEBL+/v1ZWVsrKymxsbNDQ0GBgYJSUlLe3t8zMzLS0tLGxsXNzc5GRkWJiYlpaWj4+Pra2tjMzM5eXl3Z2dq6urtHR0cLCwn9/f5KSkoqKisPDw0hISLi4uD8/P2NjY6GhoVRUVLy8vJOTk3V1dZ+fn7W1tcbGxo6Ojm1tbTo6Onh4eIaGhpWVlaSkpLKysqysrL29vb6+vmRkZMDAwKampjQ0NFtbWycnJ8XFxdPT04yMjDU1NcnJyXFxcaenp3R0dNLS0svLy6WlpZ2dnXBwcHp6emtra2pqaouLi83NzZycnAAAAP///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yH5BAEAAJsALAAAAAAtAC0AAAj/ADUJHEiwoMGDCA9u2pSwocOHAhlCnEixosWLGDNq3Mhx4IAVmUKKHJmJCAsAHQkOIMlyZAAnKTWtzCSABIYDaiw8QOAiRwQECgJkGpByJoMRJKBkEKIgSQQXLiJ4Efqy40wljkZs+GEgAZskCMJ6oZApAEqOM7fc0IJDRIsGXh/QoBG07NmNM6tI4AGDi4oDPhKAUKCgAtW7GmcSQXNCjFYoCxqUMJKghAS7VkOGUbIXRpsuFxYYaODDgAbMaEPqCMLADAscKDC0WJAhwwcGqPGGDFElkQDHGzBcOED8jYnciUMCCXGGAQ8pVJjMXnDAOPKMM4vwCbGFgpY2Kj4Y/7Bh4ABus5kzIRlyBEgQM1JQXDBQQkiD0+hTZ5oBx8oYN0HcIIMKGZRQQQKHpTdEB4cI8sUgcdyAAwY2VGABWflx5EEmQ2AyRQqLADKGDifIgAFcGCK20QKZYNHDDhyQ0YEVRTBwhwoNVECWACpqREBIMUAAwQ5TlDFDHCts4IECNAhAU48Z/ZhJARBMwMEVBbghgQwXJIBADic8GZOUVE6ASB1Z7LGCCDY8QEgNDoiZEplVpvBEI2hU8oMRCLzQRJw8jhkSlRxAsgYQDnBxgAUR+AkolBiROUEPHfQRBiUkZACCCy+88KigU05ARhoznCEHCktGUAOccnZE5g52HqJhBwsiGAACAmCAEWagcw56JRyRXDJJIR5YgIciOTjJq6uD9hBFDEWYAIMICyTwwE/KQnoRmY90QMccGsCAwgdqgPDAA0Ity5GUMaRQRhaS6MEIFVwJYUEFl6m7kZRrRPGHHyFoIEcgXbRggA/30bQEqFik8QUSOjCQhyUkMDHcB8cZEpMmUrbEkgALb0wASB6HZJK2G6es8sostyxRywktFBAAOw=="),
"next"=> array("image/gif", "R0lGODlhLQAtAPeeAOrq6n19fdfX19XV1Xt7e2FhYX9/f5+fn0ZGRo2NjXNzc0lJSYCAgLq6ultbW1lZWWlpaV9fX8/Pz0VFRUtLS3p6esvLy15eXnl5eWRkZFZWVmxsbMXFxVBQUHx8fM7Ozp6enp2dnX5+ftPT09DQ0JycnJCQkMbGxrS0tJOTk2pqai0tLUxMTE1NTXFxcaKiolNTU1RUVEFBQcjIyMrKytLS0r6+vrGxsaSkpMDAwLa2tsnJyXd3d6urq0NDQ9HR0aWlpXh4eMHBwa6urs3NzXV1dW5ubpmZmVpaWnR0dG9vbzg4ONTU1Jqamjo6Oqenp6ysrJaWll1dXU5OTouLi8LCwsPDw7Ozs09PT5SUlJiYmEhISKGhoYODg2tra7i4uKqqqpKSkq+vr4yMjKmpqWVlZYSEhI+Pj3JycomJiYeHh2JiYsTExFdXV46OjqOjo4iIiLu7u9bW1lFRUb+/v7CwsGZmZlJSUqioqFhYWIWFhWdnZzIyMjAwMEdHR9jY2Dw8PJubm6ampr29vWBgYG1tbbW1tUBAQIKCglVVVUpKSrm5uURERKCgoHZ2dsfHx/v7+1xcXIqKij4+PszMzJWVlS8vLzc3N5eXl7KysmhoaP39/WNjY////////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAJ4ALAAAAAAtAC0AAAj/AD156kSwoMGDCBMqTDhwocOHECNKnEixosWLGDNqjDgADqePIENygpAAwMaDA0SqDBnA5EmCdUZuMOICQ5czJYAM0WFDiAdOLV92SsmpwIUCe1yISBACz5U4VjgEAOryJFEkczRc8FIhwYEeOnI8miGCqlCiMRCwaGMHgxsuQxqwsWChbNCXRLFMQnCHEwYTb24MOkGEiAGzeD9SuHRoSgEMYYCgoLPjw4fDd61+3MIHEIvHWZ7oqEKDhATMVTcSRWDJCYUCFaKQ+TL3BwnUZz9OWLFEUYEATaDEIVzjBwPEmjntXkIhA6IDdWzMkMCkxvHMqnWvcNJhAxUchqpY//gxYMT11BqJTugj4wGPKD0anPgwQo555Nk5+VnSQpOaF1fkUBoTctSAW2KcUIBABAQcAUUDHFBCwghMSGDXJrlxEoMDRZggyGQnWPCBBBLsMNUfQgnwkQYOKJDAC2I0kAMHM+xAg1ScCPCSipzAgEUBjnjVAwoN9GSFT5wQAMlJPCbSwgMQeHDGAXiIgcIXDSxSQZLoXcQjEjA8UEYSZqQAAhBgDHHDDUFwyeRHFzgQwR5oGDCGFge88QQYZPDg5kY8EhJBBl4kYYAkKQRywAs44FDEnxrxWEABdmxQhAFphHFECAdw0UgSkGbEYwQXrKGCAgGoYQImJYBwAAgKhLGKEY9SPCBFBkYE0UUCWTQRAgghxEpAlxbx6AAMGkRShhIV6OFGJU2UUIKwxFbE4wMtdLBhBsyaMUYKWhyBhqxefpTHAguwMMcDa2zAAwNpmJCCC+QWa+4WCCCwwBQaRACBAh7oQYUS9Vr7ERILTOCDDwhQcIcDuAbBQCEFV5QJJxd0sIAPMsjAyAIdtFHAqSpUbPBKKw0rFEECeITyRyRVu/LMNNdss0EN3eyQQDo7FBAAOw=="),
"next-black"=> array("image/gif", "R0lGODlhLQAtAPeeABUVFYKCgioqKigoKISEhJ6enoCAgGBgYIyMjLm5uXJycn9/f6SkpLa2tqampkVFRTQ0NDAwMKCgoIaGhpubm6GhobS0tLq6uoWFhZaWljExMTo6Oi8vL0tLSywsLDk5OYGBgYODg29vb6mpqWFhYWNjY2JiYq+vr5OTk2xsbJGRkUFBQV1dXVRUVD4+PlFRUWVlZT8/Py4uLi0tLYeHhzIyMtLS0qWlpaurq0lJSYuLi7KysrOzszc3NzU1NY6OjjY2NpCQkKysrIqKisfHx05OTisrK5WVlb6+vlpaWmZmZltbW7y8vIiIiDw8PFBQUEdHR3x8fD09PVhYWFZWVrCwsHR0dGdnZ3FxcUBAQDs7O6KiolxcXExMTHd3d3BwcLGxsXt7e1VVVZiYmK2trW1tbXp6epSUlLe3t15eXq6uro2NjVdXV0RERJqamk9PT2tra6ioqGlpaZ2dnSkpKaenp3h4eHNzc1NTU5mZmXZ2dsXFxUZGRsHBwQQEBLW1tVlZWUpKStDQ0F9fX319faOjo4mJiWpqaicnJ7u7u2hoaDMzMwICAsPDw8/Pz8jIyEJCQp+fn5eXl01NTZKSkri4uGRkZM3Nzb+/v3V1dTg4OKqqqpycnAAAAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAJ4ALAAAAAAtAC0AAAj/AD156kSwoMGDCBMqTDhwocOHECNKnEixosWLGDNqjCjAC6ePIENyyqAAwMaDAkSqDBnA5EmCb0aiUPFjQpQvJZK8yLHCRQhOLV92SsmpQIUCY36AUGCCTZc2TjYEAOryJNEbakZUOINBwYEWOWJo6gGCqlCiOBLwiJNnApY0Lx5ogQChbNCXRKv0SUCG0wQRXIpA+lCjhgGzeD9aeIQJTIEJZZJ0yAJEg4bDd61+RHOpEY/HcKbkkOKDQwTMVTcSTSBoj4UCGORQgTJXBgfUZz9esEHkT4EAMPC0ITxDxgLEmjntJmKBAqEDb1b0iGBkxvHMqnXb2HMChZUlgaRA/5AhwMP11BqJXnCExEETOS0efNDggY555Nk5VSKyQ5IdFl3EUJoRdMyAW2KcWJCABAQogccDGyzCgQdGRGAXI7lxggMDQ4gAyGQfQKBBBBEAMRUiQg3w0QgMIKAAC088EMMGPQDhg1ScDPCSipwIUUUBhnjVQgcP9OSET5wQ4MdJPG6ygwMZhPDFAWw80QEUD/CBQZLoXcTjDUI44IYOYaRAQhJivFBEETRwyeRHFTAgwRhrGHDHFQdwMYUYVDTh5kY8RiIBBWfoYEAmKVhyAAtLLDHEnxrxWEABeaAwhAF6lKGECQekMYgOkGbEowQVzHEEAgHYIYIiJZBwAAkIhLGKEY9bOLAFBSrQEIUCcMBgAgkmxEpAlxbxyIAQIxTiRhAYmIHFITCUUIKwxFbEowM7nLAhBcyGcUcKVyixhqxeflRHAw3woIYDc6DQxAJ6iJDCD+QWay4aCSTQABgjSJABAiGYYUUQ9Vr70Q0NXMAEEwlYQAYDuNKwACUFVzQJJxWc0AATSCCRSAMnxFHAqUdUbPBKKw0rFEEDeITyRyRVu/LMNNdss0EN3eyQQDo7FBAAOw=="),
"play"=> array("image/png", "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAURJREFUeNqkk79qhEAQxscQJY1NmusEsUlvaWklvkIeIm9he4VNeh9BfYFUB7EJIaKFWNjIoaJY+N/siHd4IMolH3zsrri/mdnZpcZxhP/ocbnQNA0oinon04+u6wxiaJoG6rqerOv6NqDvexzE2ShjL4OH5QIjohVFEcn4Rsp7vQuA6aLzPAdVVcW2bXchN4BLrVVVged5E4QANyGrACwDIY7jgCzLm5BVQJqmEEURJEkCp9MJJEmaILttxKiosixhGIZpLggC2LbtkPYedwEYHUUOD/CCcRwHlmVNmxmGMe4CHA4HME3zujmO4/2biC1E0TR9jVwUheH7PpzP51UAtXwLWC/P8584z7LsGIahgQd60dq7uckgCIInlmV/SCZfrut+k08veLazM6xyMwOSMgKfZzC2oVu4Iv92m4C/6FeAAQCnV9v8ZUoVfQAAAABJRU5ErkJggg=="),
"pause"=> array("image/png", "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAARdJREFUeNrEkzluhTAQhseRFdGRU6RJg+QzwEVS5AJpOAFNLpAiZ+EEkegi5QaIfV8jMoOeEWBCkVe8kazxfLZ///LCpmmCa+IOrgwuO47jAGPsHbvigj7R3csRs21bFRjHkZKwLEsMwwCu68ohYZqmoPEVUwX6vp9zXdeQ5/lSU1RVBWVZbpgi0HXdnJumgaIolpoiiiLwfX/DFIG2bedM9tM0XWqKOI4hDMMNUwRoZwqaGATBUkvR9ZxTB2ST3sZ6NxLYsz8d0EHR5L2DPTs9g385kFeEDwc0TVOujHM+syRJNpzJv4ALuWEYH7quP1GdZdm353mvyN6QPV7YF7JnXNMfCmB6wHZ/8vR/sCWHAjf7jb8CDACnmdm3NhOg5AAAAABJRU5ErkJggg=="),
"folder"=> array("image/png", "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"),
"folder_up"=> array("image/png", "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"),
"first_page"=> array("image/png", "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"),
"next_page"=> array("image/png", "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"),
"previous_page"=> array("image/png", "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"),
"last_page"=> array("image/png", "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAKT2lDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjanVNnVFPpFj333vRCS4iAlEtvUhUIIFJCi4AUkSYqIQkQSoghodkVUcERRUUEG8igiAOOjoCMFVEsDIoK2AfkIaKOg6OIisr74Xuja9a89+bN/rXXPues852zzwfACAyWSDNRNYAMqUIeEeCDx8TG4eQuQIEKJHAAEAizZCFz/SMBAPh+PDwrIsAHvgABeNMLCADATZvAMByH/w/qQplcAYCEAcB0kThLCIAUAEB6jkKmAEBGAYCdmCZTAKAEAGDLY2LjAFAtAGAnf+bTAICd+Jl7AQBblCEVAaCRACATZYhEAGg7AKzPVopFAFgwABRmS8Q5ANgtADBJV2ZIALC3AMDOEAuyAAgMADBRiIUpAAR7AGDIIyN4AISZABRG8lc88SuuEOcqAAB4mbI8uSQ5RYFbCC1xB1dXLh4ozkkXKxQ2YQJhmkAuwnmZGTKBNA/g88wAAKCRFRHgg/P9eM4Ors7ONo62Dl8t6r8G/yJiYuP+5c+rcEAAAOF0ftH+LC+zGoA7BoBt/qIl7gRoXgugdfeLZrIPQLUAoOnaV/Nw+H48PEWhkLnZ2eXk5NhKxEJbYcpXff5nwl/AV/1s+X48/Pf14L7iJIEyXYFHBPjgwsz0TKUcz5IJhGLc5o9H/LcL//wd0yLESWK5WCoU41EScY5EmozzMqUiiUKSKcUl0v9k4t8s+wM+3zUAsGo+AXuRLahdYwP2SycQWHTA4vcAAPK7b8HUKAgDgGiD4c93/+8//UegJQCAZkmScQAAXkQkLlTKsz/HCAAARKCBKrBBG/TBGCzABhzBBdzBC/xgNoRCJMTCQhBCCmSAHHJgKayCQiiGzbAdKmAv1EAdNMBRaIaTcA4uwlW4Dj1wD/phCJ7BKLyBCQRByAgTYSHaiAFiilgjjggXmYX4IcFIBBKLJCDJiBRRIkuRNUgxUopUIFVIHfI9cgI5h1xGupE7yAAygvyGvEcxlIGyUT3UDLVDuag3GoRGogvQZHQxmo8WoJvQcrQaPYw2oefQq2gP2o8+Q8cwwOgYBzPEbDAuxsNCsTgsCZNjy7EirAyrxhqwVqwDu4n1Y8+xdwQSgUXACTYEd0IgYR5BSFhMWE7YSKggHCQ0EdoJNwkDhFHCJyKTqEu0JroR+cQYYjIxh1hILCPWEo8TLxB7iEPENyQSiUMyJ7mQAkmxpFTSEtJG0m5SI+ksqZs0SBojk8naZGuyBzmULCAryIXkneTD5DPkG+Qh8lsKnWJAcaT4U+IoUspqShnlEOU05QZlmDJBVaOaUt2ooVQRNY9aQq2htlKvUYeoEzR1mjnNgxZJS6WtopXTGmgXaPdpr+h0uhHdlR5Ol9BX0svpR+iX6AP0dwwNhhWDx4hnKBmbGAcYZxl3GK+YTKYZ04sZx1QwNzHrmOeZD5lvVVgqtip8FZHKCpVKlSaVGyovVKmqpqreqgtV81XLVI+pXlN9rkZVM1PjqQnUlqtVqp1Q61MbU2epO6iHqmeob1Q/pH5Z/YkGWcNMw09DpFGgsV/jvMYgC2MZs3gsIWsNq4Z1gTXEJrHN2Xx2KruY/R27iz2qqaE5QzNKM1ezUvOUZj8H45hx+Jx0TgnnKKeX836K3hTvKeIpG6Y0TLkxZVxrqpaXllirSKtRq0frvTau7aedpr1Fu1n7gQ5Bx0onXCdHZ4/OBZ3nU9lT3acKpxZNPTr1ri6qa6UbobtEd79up+6Ynr5egJ5Mb6feeb3n+hx9L/1U/W36p/VHDFgGswwkBtsMzhg8xTVxbzwdL8fb8VFDXcNAQ6VhlWGX4YSRudE8o9VGjUYPjGnGXOMk423GbcajJgYmISZLTepN7ppSTbmmKaY7TDtMx83MzaLN1pk1mz0x1zLnm+eb15vft2BaeFostqi2uGVJsuRaplnutrxuhVo5WaVYVVpds0atna0l1rutu6cRp7lOk06rntZnw7Dxtsm2qbcZsOXYBtuutm22fWFnYhdnt8Wuw+6TvZN9un2N/T0HDYfZDqsdWh1+c7RyFDpWOt6azpzuP33F9JbpL2dYzxDP2DPjthPLKcRpnVOb00dnF2e5c4PziIuJS4LLLpc+Lpsbxt3IveRKdPVxXeF60vWdm7Obwu2o26/uNu5p7ofcn8w0nymeWTNz0MPIQ+BR5dE/C5+VMGvfrH5PQ0+BZ7XnIy9jL5FXrdewt6V3qvdh7xc+9j5yn+M+4zw33jLeWV/MN8C3yLfLT8Nvnl+F30N/I/9k/3r/0QCngCUBZwOJgUGBWwL7+Hp8Ib+OPzrbZfay2e1BjKC5QRVBj4KtguXBrSFoyOyQrSH355jOkc5pDoVQfujW0Adh5mGLw34MJ4WHhVeGP45wiFga0TGXNXfR3ENz30T6RJZE3ptnMU85ry1KNSo+qi5qPNo3ujS6P8YuZlnM1VidWElsSxw5LiquNm5svt/87fOH4p3iC+N7F5gvyF1weaHOwvSFpxapLhIsOpZATIhOOJTwQRAqqBaMJfITdyWOCnnCHcJnIi/RNtGI2ENcKh5O8kgqTXqS7JG8NXkkxTOlLOW5hCepkLxMDUzdmzqeFpp2IG0yPTq9MYOSkZBxQqohTZO2Z+pn5mZ2y6xlhbL+xW6Lty8elQfJa7OQrAVZLQq2QqboVFoo1yoHsmdlV2a/zYnKOZarnivN7cyzytuQN5zvn//tEsIS4ZK2pYZLVy0dWOa9rGo5sjxxedsK4xUFK4ZWBqw8uIq2Km3VT6vtV5eufr0mek1rgV7ByoLBtQFr6wtVCuWFfevc1+1dT1gvWd+1YfqGnRs+FYmKrhTbF5cVf9go3HjlG4dvyr+Z3JS0qavEuWTPZtJm6ebeLZ5bDpaql+aXDm4N2dq0Dd9WtO319kXbL5fNKNu7g7ZDuaO/PLi8ZafJzs07P1SkVPRU+lQ27tLdtWHX+G7R7ht7vPY07NXbW7z3/T7JvttVAVVN1WbVZftJ+7P3P66Jqun4lvttXa1ObXHtxwPSA/0HIw6217nU1R3SPVRSj9Yr60cOxx++/p3vdy0NNg1VjZzG4iNwRHnk6fcJ3/ceDTradox7rOEH0x92HWcdL2pCmvKaRptTmvtbYlu6T8w+0dbq3nr8R9sfD5w0PFl5SvNUyWna6YLTk2fyz4ydlZ19fi753GDborZ752PO32oPb++6EHTh0kX/i+c7vDvOXPK4dPKy2+UTV7hXmq86X23qdOo8/pPTT8e7nLuarrlca7nuer21e2b36RueN87d9L158Rb/1tWeOT3dvfN6b/fF9/XfFt1+cif9zsu72Xcn7q28T7xf9EDtQdlD3YfVP1v+3Njv3H9qwHeg89HcR/cGhYPP/pH1jw9DBY+Zj8uGDYbrnjg+OTniP3L96fynQ89kzyaeF/6i/suuFxYvfvjV69fO0ZjRoZfyl5O/bXyl/erA6xmv28bCxh6+yXgzMV70VvvtwXfcdx3vo98PT+R8IH8o/2j5sfVT0Kf7kxmTk/8EA5jz/GMzLdsAAAAgY0hSTQAAeiUAAICDAAD5/wAAgOkAAHUwAADqYAAAOpgAABdvkl/FRgAAAW1JREFUeNrEk7FKA0EURe8OrhKEhIApUiRNPiCfoB9htyBa+AGSQiVdGjshmNIIIiEkkG+wTzfbJWG/Ic0yM/ve7K7VyKpsUqTwde/CO9x74Xl5nuOQEThwjorLdDqNsyx7CYLgsaiPRqNPa+0FEYGZ0e/3vTIHp1mW3Y/H46eimCQJ2u02ut0ujDHlEYgInU7Hq9VqD8Ph8NnpxhgwM5gZSqndgDzP0Wg0UK/X7waDwZsDOPta6/IOkiSBtRZKKTSbTcRxfNPr9Y4dnIj2A5gZcRxDCIFWqwUhRCClTCqVCpgZRFQOcFmJCEIIeJ4HZoYxJtZan7h9LwAAfN9HGIbYbDYLAGfb7fa8Wq3+AfwoUSkFZobv+5BSYrVazSeTySUz565Ea225A601mBlhGCKKoo/ZbHYF4PvQWrs7gtYaUkpEUfQ+n8+vne4OrbVI07QcQERYr9evi8XitqgzM5bLJdI0xe/n8/79G78GADWG/Zxhn0a8AAAAAElFTkSuQmCC"),
"ajax-loading"=> array("image/gif", "R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH+GkNyZWF0ZWQgd2l0aCBhamF4bG9hZC5pbmZvACH5BAALAAAAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQACwABACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQACwACACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQACwADACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAALAAQALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkEAAsABQAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAALAAYALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkEAAsABwAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA"),
"ajax-loading-black"=> array("image/gif", "R0lGODlhEAALAPQAAAAAAP///yQkJC4uLhQUFPj4+P///9DQ0Hx8fJ6enkRERNzc3LS0tHR0dJqamkBAQNjY2Pr6+rCwsBgYGCYmJgoKCsbGxiIiIgwMDEhISF5eXjQ0NBAQEAAAAAAAAAAAACH+GkNyZWF0ZWQgd2l0aCBhamF4bG9hZC5pbmZvACH5BAALAAAAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQACwABACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQACwACACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQACwADACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAALAAQALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkEAAsABQAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAALAAYALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkEAAsABwAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA"),
"close"=> array("image/png", "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAdNJREFUeNqkUztrAkEQnnt4GlQIAYOFTQiYRhDsUqWRpLFIbWtxEB8IYmOjYO0PCFhLyrRJl8rKWkQlTQRtQsQHer4y35I9TjBIyMJ3Nzu738w3O7vKbrej/ww9Ho+Toig+tk3GHePsCOeT8cJ45ORTHR42zHA4/BCLxUIej8f4jQm1i8XCarVal71eD66a/lPCXTQaDc3nc4NxTLURiURC3W4XamsqAjAg25hOpwTkcjmS9iHfZrMxwAFX3W63BLA0mkwmVCqVRBr8MT/kQxDJkyUQpM9mM0omk9RoNETAfD4v/KhXVVVKp9PkcrkoEAiQ5NkKLMui9XpNPp+PEokEtdttGo1GIhB3iTKZDGmaJvbuKcAHA2RkG4/HYiOAbIZhCMB2dkPybAWyNkitVqt7ZF3XqV6viz+AIXmyC6J+ZC2Xyza5UChQNpu1iTIIkkierQATLFYqFUEuFovk9XoFTNMUWVOplNgjzwJQ+PZh7ZUvxw3uAiZQA6JzOH2r1crqdDpvbN5qqN3v95+z84o74GX5mtvtFjKdkD4+bGswGHzweT31+/2mgsfDki+CweA9b7rm+emRq/y1XC6bw+HwmVv/jgAnDD9e5h9f8pox+RZgALUbNpA+JaRlAAAAAElFTkSuQmCC"),
"x-x-x" => array("image/gif", "")
); 
  
header("Content-type: ".$images[$img][0] );
header("Cache-control: public");
echo base64_decode( $images[$img][1] ); 

}






/////////////////////////////////////////////////////////////////
// PAGING FUNCTION
/////////////////////////////////////////////////////////////////

function display_paging( $total, $limit, $pagenumber, $baseurl )
{
  Global $config, $self , $getimgurl;
  
  if($total < $limit)
    return '';

  // set up icons to be used
  $icon_path =  $getimgurl.'img=';
  $icon_param = ' style="border:0px;" ';
  $icon_first=  '<img '.$icon_param.' src="'.$icon_path.'first_page" alt="first" title="first" />';
  $icon_last= '<img '.$icon_param.' src="'.$icon_path.'last_page" alt="last" title="last" />';
  $icon_previous= '<img '.$icon_param.' src="'.$icon_path.'previous_page" alt="previous" title="previous" />';
  $icon_next= '<img '.$icon_param.' src="'.$icon_path.'next_page" alt="next" title="next" />';
  ///////////////////
  ///////////////////
  
  
  // do calculations
  $pages = ceil($total / $limit);
  $offset = ($pagenumber * $limit) - $limit;
  $end = $offset + $limit;

  // prepare paging links
  $html = '<div id="pageLinks">';
  // if first link is needed
  if($pagenumber > 1) { $previous = $pagenumber -1;
    $html .= '<a href="'.$baseurl.'1">'.$icon_first.'</a> ';
  }
  // if previous link is needed
  if($pagenumber > 2) {    $previous = $pagenumber -1;
    $html .= '<a href="'.$baseurl.''.$previous.'">'.$icon_previous.'</a> ';
  }
  // print page numbers
  if ($pages>=2) { $p=1;
    $html .= "| Page: ";
    $pages_before = $pagenumber - 1;
    $pages_after = $pages - $pagenumber;
    $show_before = floor($config['showpages'] / 2);
    $show_after = floor($config['showpages'] / 2);
    if ($pages_before < $show_before){
      $dif = $show_before - $pages_before;
      $show_after = $show_after + $dif;
    }
    if ($pages_after < $show_after){
      $dif = $show_after - $pages_after;
      $show_before = $show_before + $dif;
    }   
    $minpage = $pagenumber - ($show_before+1);
    $maxpage = $pagenumber + ($show_after+1);

    if ($pagenumber > ($show_before+1) && $config['showpages'] > 0) {
      $html .= " ... ";
    }
    while ($p <= $pages) {
      if ($p > $minpage && $p < $maxpage) {
        if ($pagenumber == $p) {
              $html .= " <b>".$p."</b>";
        } else {
            $html .= ' <a href="'.$baseurl.$p.'">'.$p.'</a>';
        }
      }
      $p++;
    }
    if ($maxpage-1 < $pages && $config['showpages'] > 0) {
      $html .= " ... ";
    }
  }
  // if next link is needed
  if($end < $total) { $next = $pagenumber +1;
    if ($next != ($p-1)) {
      $html .= ' | <a href="'.$baseurl.$next.'">'.$icon_next.'</a>';
    } else {$html .= ' | ';}
  }
  // if last link is needed
  if($end < $total) { $last = $p -1;
    $html .= ' <a href="'.$baseurl.$last.'">'.$icon_last.'</a>';
  }
  $html .= '</div>';
  // return paging links
  return $html;
}


function outputJS($js) 
{
  if($js == "js_viewer")
    galleryJavascript(); 
  elseif($js == "jquery")
    jQuery();
  
  die();
}

function galleryJavascript()
{
  global $config,$getimgurl,$config,$themes,$galleryfolder;
  
?> 

(function($) {
  $.fn.galleryViewer = function(setup)
  {
    var imgArr = new Array();
    setup = jQuery.extend({ <?php echo "
      galleryfolder:'".$galleryfolder."',
      overlayBgColor:'".$themes[$config['selectedTheme']]['overlay-background-color']."',
      overlayOpacity:".$config['opacity'].",
      imageBtnPrev:'".$getimgurl."img=".$themes[$config['selectedTheme']]['button-prev']."',
      imageBtnNext:'".$getimgurl."img=".$themes[$config['selectedTheme']]['button-next']."',
      imageBtnSlideShow:'".$getimgurl."img=play',
      imageBtnSlideShowPause:'".$getimgurl."img=pause',
      imageBtnClose:'".$getimgurl."img=close',
      imageBlank:'".$getimgurl."img=blank',
      containerBorderSize:".$config['borderSize'].",
      containerResizeSpeed:".$config['resizeSpeed'].",
      slideshow:".($config['slideshow']?'true':'false').",
      slideshowAutoStart:".($config['slideshowAutoStart']?'true':'false').",
      slideShowDuration:".$config['slideShowDuration'].",
      imageInfo:".($config['imageInfo']?'true':'false').",
      imageInfoLink:'".$getimgurl."info=',
      showShare:".($config['share']?'true':'false').",
      shareLink:'".$getimgurl."share=',
      showDownloadLink:".($config['downloadLink']?'true':'false').",
      downloadLink:'".$getimgurl."download=',
      txtDownload:'".$config['txtDownload']."',
      txtImageInfo:'".$config['txtImageInfo']."',
      txtImageInfoHide:'".$config['txtImageInfoHide']."',
      txtShare:'".$config['txtShare']."',
      txtShareHide:'".$config['txtShareHide']."',
      txtAuthor:'".$config['txtAuthor']."',
      txtImage:'".$config['txtImage']."',
      txtOf:'".$config['txtOf']."',"; ?>
      imageArray:imgArr,
      currentImage:0
    },setup);
    var dimensions = jQuery.extend({
        pWidth:0,
        pHeight:0,
        wWidth:0,
        wHeight:0,
        posTop:0,
        posLeft:0,
        scroll:0
    },dimensions);
    var imgElements = this;
    
    var resizing = false;
    var origImgWidth = 0;
    var origImgHeight = 0;
    var myPlayer = null;

    function executeLink()
    {
      initViewer(this,imgElements);
      return false;
    }
    
    function initViewer(elClicked,imgElements)
    {
      $('embed,object,select').css({'visibility':'hidden'});
      createViewer();
      setup.imageArray.length = 0;
      setup.currentImage = 0;
      
      for( var i = 0; i < imgElements.length; i++ )
      {
        setup.imageArray.push(new Array( 
          $(imgElements[i]).attr('href')
        , $(imgElements[i]).attr('title')
        , $(imgElements[i]).attr('caption')
        , $(imgElements[i]).attr('author')
        , $(imgElements[i]).attr('orig') 
        , $(imgElements[i]).attr('video') 
        ));
      }
      
      while( setup.currentImage < (setup.imageArray.length-1) && setup.imageArray[setup.currentImage][0] != $(elClicked).attr('href') )
      {
        setup.currentImage++;
      }
      viewImage();
    }
    
    function createViewer()
    {
      getWindowDimensions();
      
      $('<div id="gJv2overlay" />').appendTo("body").css({ backgroundColor:setup.overlayBgColor, opacity:setup.overlayOpacity, width:dimensions.pWidth, height:dimensions.pHeight }).click(function() {
          closeOverlay();
      }).fadeIn();
      
      viewer = '<div id="imgDivWrap">'             
             + '<div id="imgDiv"><img id="imgImg">'
             + '<div id="imgNav"><a href="#" id="imgPrevious"></a><a href="#" id="imgNext"></a></div>'
             + '<div id="imgLoading"></div>'
             + '</div>'
             + '<div id="imgInfoBox"><div id="imgInfoWrap">'
             + '<div id="viewerClose"></div><div id="imgSlideShow"></div>'
             + '<div id="imgInfo"><span id="imgTitle"></span><span id="imgAuthor"></span><span id="imgCaption"></span><span id="imgCount"></span></div>'
             + '</div></div><input type="hidden" id="imgCurrentOriginal" value="" /></div>';
      
      $('<div id="gJv2imgViewer" />').html(viewer).appendTo("body").css({ top:dimensions.posTop, left:dimensions.posLeft }).click(function() {
          closeOverlay();
      }).show();
      
      $("#imgInfoBox").click(function(event){
        event.stopPropagation();
      });

      //myPlayer = _V_("videoPlayer");

      if(setup.imageInfo)
      {
        $('<span id="viewExif"></span>').appendTo('#imgInfo');
        $('<a href="#" id="viewExifLinkRef">'+setup.txtImageInfo+'</a>').appendTo('#viewExif').click(function(event) {
            imageInfo();
            return false;
        });
      }
      
      if(setup.showShare)
      {
        $('<span id="viewShare"></span>').appendTo('#imgInfo');
        $('<a href="#" id="viewShareLinkRef">'+setup.txtShare+'</a>').appendTo('#viewShare').click(function(event) {
            showShare();
            return false;
        });
      }
      
      if(setup.showDownloadLink)
      {
        $('<span id="downloadLink"><a href="#" id="downloadLinkRef">'+setup.txtDownload+'</a></span>').appendTo('#imgInfo');
      }
      
      if(setup.slideshow)
      {
        var ssLink = $('<img src="'+setup.imageBtnSlideShow+'" />').appendTo("#imgSlideShow").click(function() {
          startSlideShow();
        }).show();
        
        if(setup.slideshowAutoStart)
          ssLink.trigger('click');
      }
      
      $('<img src="'+setup.imageBtnClose+'" />').appendTo("#viewerClose").click(function() {
        closeOverlay();
      }).show();
      
      // resizing window
      $(window).resize(function() {
          
        getWindowDimensions();
        $('#gJv2overlay').css({ width:dimensions.wWidth, height:dimensions.wHeight });
        
        if(resizing != true)
        {
          resizing = true;
          $.gDoTimeout( 'resize', 1000 , function(){
            resizeViewer(false);
            resizing = false;
          });
        }
        
        
      });
      
    }
    

    function getWindowDimensions()
    {
      dimensions.wWidth = $(window).width();
      dimensions.wHeight = $(window).height();
      dimensions.pWidth = $(document).width();
      dimensions.pHeight = $(document).height();
      dimensions.scroll = $(window).scrollTop();
      dimensions.posTop = dimensions.scroll + (dimensions.wHeight / 10);
      dimensions.posLeft = $(window).scrollLeft();
    }
    
    function videoPlayer()
    {
      $('#imgDiv').hide();

      if(myPlayer != null)
      {
        if(myPlayer.techName == "html5")
        {
          myPlayer.tag.src = "";
          myPlayer.tech.removeTriggers();
          myPlayer.load();
        }
        //myPlayer.tech.destroy();
        myPlayer.destroy();
        $(myPlayer.el).remove();
      }

      var code = '<div id="gJv2videoPlayerWrap"><video id="videoPlayer" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264" poster="'+setup.imageArray[setup.currentImage][0]+'" data-setup="{}"><source id="videoPlayerSrc" src="'+setup.imageArray[setup.currentImage][5]+'" type="video/mp4"></video></div>';
      $(code).prependTo('#imgDivWrap');
      $("#gJv2videoPlayerWrap").click(function(event){
        event.stopPropagation();
      });
      myPlayer = _V_("videoPlayer");
    }
    
    function viewImage()
    {
      removeImageInfo();
      $('#imgLoading').show();
      $('#imgImg, #imgNav, #imgInfoBox').hide();
      
      var preloadImage = new Image();
      preloadImage.onload = function() {

        if(setup.imageArray[setup.currentImage][5] != null)
        {
          videoPlayer();
        }
        else
        {
          $('#gJv2videoPlayerWrap').remove();
          myPlayer = null;
          $('#imgDiv').show();
          $('#imgImg').attr('src', setup.imageArray[setup.currentImage][0]);
        }
        origImgWidth = preloadImage.width;
        origImgHeight = preloadImage.height;
        resizeViewer(true);
        preloadImage.onload=function(){};
      };
      preloadImage.src = setup.imageArray[setup.currentImage][0];
      
    };
    
    function imageMaxSize(imgWidth,imgHeight)
    {
      var extraHeight = 60;
      var imgTotalMargin = (setup.containerBorderSize*4);
      var maxHeight = dimensions.wHeight - imgTotalMargin - extraHeight;
      var maxWidth = dimensions.wWidth - imgTotalMargin;

      if( imgHeight > maxHeight )
      {
        var newHeight = maxHeight;
        var newWidth =  Math.floor((newHeight / imgHeight) * imgWidth);

        if( newWidth > maxWidth )
        {
          newWidth = maxWidth;
          newHeight = Math.floor((newWidth / imgWidth) * imgHeight);
        }
        dimensions.imgHeight = newHeight;
        dimensions.imgWidth = newWidth;
      }
      else if( imgWidth > maxWidth )
      {
        var newWidth = maxWidth;
        var newHeight = Math.floor((newWidth / imgWidth) * imgHeight);
        
        if( newHeight > maxHeight )
        {
          newHeight = maxHeight;
          newWidth =  Math.floor((newHeight / imgHeight) * newWidth);
        }
        dimensions.imgHeight = newHeight;
        dimensions.imgWidth = newWidth;
      }
      else
      {
        dimensions.imgHeight = imgHeight;
        dimensions.imgWidth = imgWidth;
      }
    }
    

    function resizeViewer(initImg)
    {
      var extraHeight = 60;
      var imgMargin = (setup.containerBorderSize*2);

      imageMaxSize(origImgWidth,origImgHeight);

      var imgWrapWidth = (dimensions.imgWidth + imgMargin);
      var imgWrapHeight = (dimensions.imgHeight + imgMargin);
      
      dimensions.posTop = dimensions.scroll + ((dimensions.wHeight - imgWrapHeight)/2) - (extraHeight/2);
      if(dimensions.posTop < imgMargin)
        dimensions.posTop = imgMargin;
      $('#gJv2imgViewer').animate({ top: dimensions.posTop }, setup.containerResizeSpeed);

      if(!initImg)
        $('#imgImg').animate({ width:dimensions.imgWidth, height:dimensions.imgHeight }, setup.containerResizeSpeed);
      $('#imgDivWrap').animate({ width: imgWrapWidth });
      $('#imgNav').css({ height: imgWrapHeight });
      $('#imgDiv').animate({ width: dimensions.imgWidth, height: dimensions.imgHeight }, setup.containerResizeSpeed, function() { 
        if(initImg)
          showImg(dimensions.imgWidth,dimensions.imgHeight);
      });
      
      if(myPlayer != null)
      {
        myPlayer.width(dimensions.imgWidth);
        myPlayer.height(dimensions.imgHeight);
      }

      $('#imgInfoBox').css({ width: dimensions.imgWidth });
      $('#imgPrevious, #imgNext').css({ height: dimensions.imgHeight + (setup.containerBorderSize * 2) });
    };

    
    function showImg(w,h)
    {
      $('#imgLoading').hide();
      $('#imgImg').css({width:w,height:h}).fadeIn(function()
      {
        $('#imgNav').show();
        $('#imgPrevious, #imgNext').css({'background':'transparent url(' + setup.imageBlank + ') no-repeat'});
        
        if( setup.currentImage != 0 )
        {
          $('#imgPrevious').unbind().hover(function() {
            $(this).css({ 'background':'url('+setup.imageBtnPrev+') left 15% no-repeat' });
          },function() {
            $(this).css({ 'background':'transparent url('+setup.imageBlank+') no-repeat' });
          }).show().bind('click',function() {
            if(setup.sshowOn)
              stopSlideshow();
            setup.currentImage--;
            viewImage();
            return false;
          });
        }
        
        if( setup.currentImage != setup.imageArray.length-1 )
        {
          $('#imgNext').unbind().hover(function() {
            $(this).css({ 'background':'url('+setup.imageBtnNext+') right 15% no-repeat' });
          },function() {
            $(this).css({ 'background':'transparent url('+setup.imageBlank+') no-repeat' });
          }).show().bind('click',function() {
            if(setup.sshowOn)
              stopSlideshow();
            setup.currentImage++;
            viewImage();
            return false;
          });
        }
        
        
        $(document).keydown(function(objEvent) {
          eventKeyPress(objEvent);
        });
        
        $('#imgInfoBox').slideDown('fast');
        
        if( setup.imageArray[setup.currentImage][1] )
        {
          $('#imgTitle').html(setup.imageArray[setup.currentImage][1]).show();
          if(setup.imageArray[setup.currentImage][2]!=null)
            $('#imgCaption').html(setup.imageArray[setup.currentImage][2]).show();
          else
            $('#imgCaption').html('').show();
          if(setup.imageArray[setup.currentImage][3]!=null)
            $('#imgAuthor').html(' '+setup.txtAuthor+' '+setup.imageArray[setup.currentImage][3]).show();
          else
            $('#imgAuthor').html('').show();
            
          var origVal = setup.imageArray[setup.currentImage][4].replace(setup.galleryfolder,'');

          $('#imgCurrentOriginal').val(origVal);

          if(setup.showDownloadLink)
            $('#downloadLinkRef').attr('href',setup.downloadLink+origVal);

        }
        
        if( setup.imageArray.length > 1 )
          $('#imgCount').html(setup.txtImage+' '+(setup.currentImage+1)+' '+setup.txtOf+' '+setup.imageArray.length).show();
        
      });
      preloadNextPrev();
    };
    
    function imageInfo()
    {
      if($('#exifBg').length == 0)
      {
        removeShare();
        
        var src = $('#imgCurrentOriginal').val();
        src = escape(src);
        var w = $('#imgDiv').width();
        var h = $('#imgDiv').height();
        $('<div id="exifBg" />').css({ opacity:0.5, width:w, height:h }).appendTo('#imgNav');
        $('<div id="exifInfo" />').css({ width:(w-40), height:(h-40) }).load(setup.imageInfoLink+src.replace(setup.galleryfolder,'')).appendTo('#imgNav').bind('click',function(event){event.stopPropagation();removeImageInfo();});
        $('#viewExif a').text(setup.txtImageInfoHide);
      }
      else
      {
        removeImageInfo();
      }
    }
    
    function removeImageInfo()
    {
      $('#exifInfo').remove();
      $('#exifBg').remove();
      $('#viewExif a').text(setup.txtImageInfo);
    }
    
    function showShare()
    {
      if($('#shareBg').length == 0)
      {
        removeImageInfo();
        
        var src = $('#imgCurrentOriginal').val();
        src = escape(src);
        var w = $('#imgDiv').width();
        var h = $('#imgDiv').height();
        $('<div id="shareBg" />').css({ opacity:0.5, width:w, height:h }).appendTo('#imgNav');
        $('<div id="shareInfo" />').css({ width:(w-40), height:(h-40) }).load(setup.shareLink+src.replace(setup.galleryfolder,'')).appendTo('#imgNav').bind('click',function(event){event.stopPropagation();removeShare();});
        $('#viewShare a').text(setup.txtShareHide);
      }
      else
      {
        removeShare();
      }
    }
    
    function removeShare()
    {
      $('#shareInfo').remove();
      $('#shareBg').remove();
      $('#viewShare a').text(setup.txtShare);
    }
    
    function clearImage()
    {
      $('#imgTitle').html('');
      $('#imgCaption').html('');
      $('#imgAuthor').html('');
    }
    
    
    function nextSlide()
    {
      clearImage();
      setup.currentImage++;
      viewImage();
      if(setup.sshowOn && setup.currentImage < setup.imageArray.length-1)
      {
        $.gDoTimeout( 'sss', setup.slideShowDuration , function(){
          nextSlide();
        });
      }
      return false;
    }


    function startSlideShow()
    {
      setup.sshowOn = true;
      $("#imgSlideShow img").remove();
      $('<img src="'+setup.imageBtnSlideShowPause+'" />').appendTo("#imgSlideShow").click(function() {
        stopSlideshow();
      }).show();
      $.gDoTimeout( 'ss', setup.slideShowDuration , function(){
        nextSlide();
      });
    }
    
    
    function stopSlideshow()
    {
      setup.sshowOn = false;
      $.gDoTimeout( 'ss' );    
      $.gDoTimeout( 'sss' );
      $("#imgSlideShow img").remove();
      $('<img src="'+setup.imageBtnSlideShow+'" />').appendTo("#imgSlideShow").click(function() {
        startSlideShow();
      }).show();
    }
    
    function preloadNextPrev()
    {
      if ( (setup.imageArray.length -1) > setup.currentImage ) {
        objNext = new Image();
        objNext.src = setup.imageArray[setup.currentImage + 1][0];
      }
      if ( setup.currentImage > 0 ) {
        objPrev = new Image();
        objPrev.src = setup.imageArray[setup.currentImage -1][0];
      }
    }
    
    
    function closeOverlay()
    {
      $('#gJv2imgViewer').fadeOut(200,function() { 
        $(this).remove();
        $('#gJv2overlay').fadeOut(500,function() { $(this).remove(); });
      });
      $('embed, object, select').css({ 'visibility':'visible' });
    }
    
    
    function eventKeyPress(objEvent)
    {
      if( objEvent == null )
      {
        keycode = event.keyCode;
        escapeKey = 27;
      }
      else
      {
        keycode = objEvent.keyCode;
        escapeKey = objEvent.DOM_VK_ESCAPE;
      }
      
      if(keycode == escapeKey)
        closeOverlay();
      else if(keycode==39 && setup.currentImage!=(setup.imageArray.length-1) )
      {
        setup.currentImage++;
        viewImage();
        $(document).unbind();
      }
      else if(keycode==37 && setup.currentImage!=0)
      {
        setup.currentImage--;
        viewImage();
        $(document).unbind();
      }
    }
    
    
    return this.unbind('click').click(executeLink);
  };
  
})(jQuery);


  function uploadAnother( ref ) {
    var tempFile = window.document.createElement( 'INPUT' );
    tempFile.setAttribute( 'type', 'file' );
    tempFile.className = 'fileupload';
    tempFile.setAttribute( 'name', 'fileupload[]' );
    
    var tempForm = false;
    var tempParent = false;
    var ok = true;
    try {
      while( ok == true ) {
        if( tempParent == false ) {
          tempParent = ref.parentNode;
        } else if ( tempParent.nodeName.toLowerCase() == 'form'  ) {
          tempForm = tempParent;
          ok = false;
        } else {
          
          tempParent = tempParent.parentNode;
        }
      } // ends while
    } catch( e ) {};
    ok = null;
    
  
    tempForm.insertBefore( tempFile, ref );
  
    if (tempForm.length-1 >= 5){
      tempForm.removeChild(ref);
    } 
    
    return false;
  } // ends uploadAnother  


/*
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="gDoTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);

  
<?php 
}

?>
