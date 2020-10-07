<?php
//code added by rehan
add_action('admin_enqueue_scripts', 'wb_220517_add_admin_scripts');
function wb_220517_add_admin_scripts($hook){
    if ($hook !== 'post-new.php' && $hook !== 'post.php') {
        return;
    }
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}

add_action('save_post', 'wb_220517_save_meta_box');
function wb_220517_save_meta_box($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'wb_220517_nonce')) {
        return;
    } 
    if (isset($_POST['wb_additional_file'])) {
        $filename_url = $_POST['wb_additional_file'];
        update_post_meta($post_id, 'wb_additional_file', $filename_url);
    }
}

add_action('add_meta_boxes', 'wb_220517_register_meta_boxes');
function wb_220517_register_meta_boxes($post){
    add_meta_box('additional-file', __('Additional File', 'textdomain'), 'wb_220517_file_callback', ['event', 'event-recurring'], 'normal', 'high');
}

function wb_220517_file_callback($post){
    $i=0;
    wp_nonce_field('wb_220517_nonce', 'meta_box_nonce');
    $fileLink = get_post_meta($post->ID, "wb_additional_file", true);
    ?>

    <div class="fileurl">

    <?php   $myArray = explode(',', $fileLink);
    if (!empty($fileLink)) {
        foreach ($myArray as $key=>$url) {
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
    ?> 
            <div class="file-info">
                <a style="margin-right:10px;" href="<?php echo $url?>">
                    <?php if($source){
                        ?>
                        <img width="20" style="position:relative;top:6px;margin-top:5px;margin-right:10px;" src=<?php  echo $source ?>>
                        <?php
                    }
                    ?>
                    <?php echo $name ?>
                </a>
                <img class="removelink" width="20" style="margin-top:5px;margin-right:10px;position:relative;top:6px" src="<?php echo get_template_directory_uri()."/images/remove.png" ?>">
            </div>
            <?php
        }
    } else {
        echo '<span class="file_attach">No file is attached</span>';
    } 
    ?>   
</div>
<span class="file_attach" style="display:none;">No file is attached</span>
<input type="hidden" class="file_urls" name="wb_additional_file">
<input id="upload_button" type="button" value="Upload File" style=" margin-left: 10px;" />
<style>
.fileurl{
    display:inline-block;
}
</style>
<script>
jQuery(document).ready(function ($) {
    var frame;
    jQuery(document).on('click','.removelink', function() {
      jQuery(this).parent().remove();
        if(jQuery('.file-info').length){
        }
        else{
            jQuery('.file_attach').show();
        }
    });
    jQuery(document).on('click','#publish', function() {
        var image = "";
        jQuery('.file-info').each(function(i, obj) {
            if(i==0){
                image =   jQuery(this).find('a').attr('href');
            }else{
                image =  image +','+ jQuery(this).find('a').attr('href');
            }
        });
        jQuery('.file_urls').val(image);

    });
    jQuery('#upload_button').click(function(e) {
        e.preventDefault();
        frame = wp.media({
          title: 'Select or Upload File',
          button: {
            text: 'Use this File'
          },
          multiple: true  // Set to true to allow multiple files to be selected
        }).on( 'select', function() {
            var j=0;   
            var selection  = frame.state().get('selection');
            selection.map( function( attachment ) {
            attachment = attachment.toJSON();
            var path  =attachment.url;
            var fullpath= path
            path = path.substring(path.lastIndexOf("/")+ 1);
            path = (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
            var extension = path.substr( (path.lastIndexOf('.') +1) );
            var currentpath = window.location.origin;
            if (extension == "docx") {        
                var imageurl = currentpath+"/rppm/wp-content/themes/codoswp/images/doc.png";             
            } else if (extension == "pdf") {              
                var imageurl = currentpath+"/rppm/wp-content/themes/codoswp/images/pdf.png";
            } else if (extension == "pptx") {
               var imageurl = currentpath+"/rppm/wp-content/themes/codoswp/images/pptx.png";
            } else if (extension == "xlsx") {            
              var imageurl = currentpath+"/rppm/wp-content/themes/codoswp/images/xlxs.png";
            }
            $('.file-info').each(function(i, obj) { 
                var   image =   jQuery(this).find('a').attr('href');
                if(fullpath == image){
                    fullpath = fullpath.substring(fullpath.lastIndexOf("/")+ 1);
                    j=1;
                }
            });
            if(j=="1"){
               alert('Sorry, '+fullpath+' is already added.');
            }
            else{
                console.log(extension);
                if(extension == "docx" || extension == "pdf" || extension == "pptx" || extension == "xlsx"){
                    jQuery('.file_attach').hide();
                    var elements = '<div class="file-info"><a href='+attachment.url+' style="margin-right:10px;"><img width="20" style="position:relative;top:6px;margin-top:5px;margin-right:10px;" src='+imageurl+'>'+ path +' </a><img class="removelink" width="20" style="margin-top:5px;margin-right:10px;position:relative;top:6px" src="<?php echo get_template_directory_uri()."/images/remove.png" ?>"></div>';
                    jQuery('.fileurl').append(elements);
                }else{
                    alert('Sorry, you can only upload .docx, .pdf, .pptx or .xlsx files.');
                }
            }
        });
        }).open();
    });
});
</script>
<?php
}

//code added by <junaid class="junaid.hassan@iengineering com"></junaid>

add_action('add_meta_boxes', 'codoswp_custom_event_fields_register_meta_boxes');
function codoswp_custom_event_fields_register_meta_boxes($post){
    add_meta_box('codoswp_custom_event_fields', __('Event Details', 'codoswp'), 'codoswp_custom_event_fields_callback', ['event', 'event-recurring'], 'side', 'high');
}

function codoswp_custom_event_fields_callback($post){
    wp_nonce_field('codoswp_custom_event_fields_nonce', 'codoswp_custom_event_fields_meta_box_nonce');
    //echo get_post_meta($post->ID, "codoswp_custom_event_fields_country", true);
    $codoswp_custom_event_fields_country = esc_html(get_post_meta($post->ID, "codoswp_custom_event_fields_country", true));
    $codoswp_custom_event_fields_state_province = esc_html(get_post_meta($post->ID, "codoswp_custom_event_fields_state_province", true));
    $codoswp_custom_event_fields_city = esc_html(get_post_meta($post->ID, "codoswp_custom_event_fields_city", true));
    $codoswp_custom_event_fields_mode = esc_html(get_post_meta($post->ID, "codoswp_custom_event_fields_mode", true));
    ?>
    <table>
        <tr>
            <td>
                <?php echo __('Country', 'codoswp');?>
            </td>
            <td>
                <input type="text" name="codoswp_custom_event_fields_country" value="<?php echo $codoswp_custom_event_fields_country;?>">
            </td>
        </tr>
        <tr>
            <td>
                <?php echo __('State/Province', 'codoswp');?>
            </td>
            <td>
                <input type="text" name="codoswp_custom_event_fields_state_province" value="<?php echo $codoswp_custom_event_fields_state_province;?>">
            </td>
        </tr>
        <tr>
            <td>
                <?php echo __('City', 'codoswp');?>
            </td>
            <td>
                <input type="text" name="codoswp_custom_event_fields_city" value="<?php echo $codoswp_custom_event_fields_city;?>">
            </td>
        </tr>
        <tr>
            <td>
                <?php echo __('Mode', 'codoswp');?>
            </td>
            <td>
                <input type="text" name="codoswp_custom_event_fields_mode" value="<?php echo $codoswp_custom_event_fields_mode;?>">
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post', 'codoswp_custom_event_fields_save_meta_box');
function codoswp_custom_event_fields_save_meta_box($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['codoswp_custom_event_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['codoswp_custom_event_fields_meta_box_nonce'], 'codoswp_custom_event_fields_nonce')) {
        return;
    } 
    //echo 'inside';die();
    if (isset($_POST['codoswp_custom_event_fields_country'])) {
        update_post_meta($post_id, 'codoswp_custom_event_fields_country', $_POST['codoswp_custom_event_fields_country']);
    }
    if (isset($_POST['codoswp_custom_event_fields_state_province'])) {
        update_post_meta($post_id, 'codoswp_custom_event_fields_state_province', $_POST['codoswp_custom_event_fields_state_province']);
    }
    if (isset($_POST['codoswp_custom_event_fields_city'])) {
        update_post_meta($post_id, 'codoswp_custom_event_fields_city', $_POST['codoswp_custom_event_fields_city']);
    }
    if (isset($_POST['codoswp_custom_event_fields_mode'])) {
        update_post_meta($post_id, 'codoswp_custom_event_fields_mode', $_POST['codoswp_custom_event_fields_mode']);
    }
}