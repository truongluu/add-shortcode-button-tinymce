<?php
/**
 * Created by PhpStorm.
 * User: xuantruong
 * Date: 12/27/15
 * Time: 1:39 PM
 */

class Add_Shortcode_Tinymce {
    protected $settings;
    protected  $lang_path;

    function __construct() {
        add_action( 'plugins_loaded', [ $this, 'plugins_loaded' ], 0 );
        add_action( 'init', [ $this, 'init' ] );
        add_action( 'admin_head', [ $this, 'global_shortcode_js' ] );
        add_action( 'admin_head', [ $this, 'admin_head' ] );
        add_action( 'admin_footer', [ $this, 'admin_footer' ] );


    }

    function admin_footer() {
        ?>
        <div id="box-shortcode-tiny-mce-dialog" style="display: none;">
            <form action="">
                <p>
                    <label style="width: 130px;display:inline-block" for="text-color"><input type="checkbox" id="check-color" value="1"><?php _e( 'Text color' ); ?></label>
                    <input type="color" name="text-color" id="text-color" value="#ffffff">
                </p>
                <p>
                    <label style="width: 130px;display:inline-block" for="background-color"><input type="checkbox" id="check-bgcolor" value="1"><?php _e( 'Background color' ); ?></label>
                    <input type="color" name="background-color" id="background-color" value="#e44474">
                </p>
                <p>
                    <label style="width: 130px;display:inline-block" for="border-color"><input type="checkbox" id="check-bordercolor" value="1"><?php _e( 'Border color' ); ?></label>
                    <input type="color" name="border-color" id="border-color" value="#fff">
                </p>
                <p style="text-align: center">
                    <input type="submit" id="box-shortcode-apply" value="<?php _e( 'Apply');?>" class="button-primary">
                </p>
            </form>
        </div>
        <?php
    }
    function  global_shortcode_js() {

    }

    function admin_head() {
        add_filter('mce_external_plugins', [ $this, 'add_tinymce_plugin' ] );
        add_filter('mce_buttons', [ $this, 'add_tinymce_button' ] );
    }

    function add_tinymce_plugin( $plugin_array ) {
        $plugin_array['box_shortcode'] = ADD_SHORTCODE_BUTTON_TINYMCE_PATH . 'res/js/add-shortcode-button.js';
        return $plugin_array;
    }

    function add_tinymce_button( $buttons ) {
        array_push( $buttons, 'box_shortcode' );
        return $buttons;
    }

    function init() {
        add_shortcode( 'info_box', [ $this, 'infobox_shortcode' ] );

    }

    function infobox_shortcode( $attrs, $content ) {
        $attrs = shortcode_atts( [
            'tcolor' => '',
            'bgcolor' => '',
            'bordercolor' => ''
        ], $attrs );
        extract( $attrs );
        $infobox = '';
        $infobox_filter = [];
        !empty( $tcolor ) and $infobox_filter[] = "color: $tcolor!important" ;
        !empty( $bgcolor ) and $infobox_filter[] = "background-color: $bgcolor!important" ;
        !empty( $bordercolor ) and $infobox_filter[] = "border: 1px solid $bordercolor!important" ;
        if( $content ) {
            $infobox = '<div class="infobox" style="' . implode( ';', $infobox_filter ) . '"; >' . $content . '</div>';
        }
        return $infobox;
    }

    function plugins_loaded() {
        // Load resources
        $this->plugin_localization();
    }


    function plugin_activate() {

    }

    function plugin_deactivate() {

    }

    // Localization
    function plugin_localization() {
        load_plugin_textdomain( 'add-shortcode-button-tinymce', false, basename( ADD_SHORTCODE_BUTTON_TINYMCE_BASE ) . '/locale' );
    }
}