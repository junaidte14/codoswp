<?php
/*
 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!
 * You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
 * Your file would be named single-event.php
 */
/*
 * This page displays a single event, called during the the_content filter if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Events::output()
 */
global $EM_Event;
/* @var $EM_Event EM_Event */
echo $EM_Event->output_single();
//var_dump($EM_Event);
$fileLink = get_post_meta(get_the_ID(), "wb_additional_file", true);
// var_Dump($fileLink);?>

<div class="fileurl">

<?php $myArray = explode(',', $fileLink);
foreach ($myArray as $url) {
    if ($url) {
        $name = basename($url);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if ($ext == "docx") {
            $source =  get_template_directory_uri()."/images/doc.png";
        } elseif ($ext == "pdf") {
            $source =  get_template_directory_uri()."/images/pdf.png";
        } elseif ($ext == "pptx") {
            $source =  get_template_directory_uri()."/images/pptx.png";
        } elseif ($ext == "xlsx") {
            $source =  get_template_directory_uri()."/images/xlxs.png";
        }
        //    echo $ext;?> 
        <div class="file-info">
            <a style="margin-right:10px;" href="<?php echo $url?>">
                <img width="20" style="position:relative;top:6px;margin-top:5px;margin-right:10px;" src=<?php  echo $source ?>>
                <?php echo $name ?>
            </a>
        </div>

        <?php
    }
} ?>   
<a href="<?php echo get_site_url()."/recurring-event/?id=".get_the_ID() ?> ">Want to see previous files click here</a>

</div>

