<?php /* Template Name: state_record */ ?>
<?php
get_header();
?>
<div class="codoswp-container">

    <main id="primary" class="site-main">
        <?php
            $statename = $_GET["id"];
            $country_check = $_GET["state_country"];
            if ($country_check == "state") {
                $args = array(
                    'post_type' => array('iep_publication'),
                    'meta_query' => array(
                        array(
                            'key'   => 'state_name',
                            'value' => $statename,
                            'compare' => 'LIKE',
                        ),
                    ));
            } else {
                $args = array(
                'post_type' => array('iep_publication'),
                'meta_query' => array(
                    array(
                        'key'   => 'country_name',
                        'value' => $statename,
                        'compare' => 'LIKE',
                    ),
                ));
            }
        
                $loopcount =  get_posts($args);
                $total_state = count($loopcount);
                echo "Total Document Found ".$total_state;
        ?>
    </main><!-- #site-content -->
    
</div>

<?php
get_footer();
