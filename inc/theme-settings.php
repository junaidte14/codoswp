<?php

class CODOSWPSettingsPage{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_theme_options_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_theme_options_page(){
        add_theme_page("CODOSWP", "CODOSWP Options", "manage_options", "codoswp-theme-options", array($this, "codoswp_theme_option_page"));
    }

    /**
     * Options page callback
     */
    public function codoswp_theme_option_page(){
        // Set class property
        $this->options = get_option( 'codoswp_options_name' );
        ?>
        <div class="wrap">
            <h1>CODOSWP Theme Settings</h1>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'codoswp_options_group' );
                do_settings_sections( 'codoswp-theme-options' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init(){        
        register_setting(
            'codoswp_options_group', // Option group
            'codoswp_options_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'general_settings_section', // ID
            'General Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'codoswp-theme-options' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'codoswp-theme-options', // Page
            'general_settings_section' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'codoswp-theme-options', 
            'general_settings_section'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ){
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info(){
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback(){
        printf(
            '<input type="text" id="id_number" name="codoswp_options_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback(){
        printf(
            '<input type="text" id="title" name="codoswp_options_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new CODOSWPSettingsPage();