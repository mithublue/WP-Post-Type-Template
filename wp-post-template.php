<?php
/*
Plugin Name: WP Post Template
Plugin URI:
Description: A plugin to set template for any post type like pages.
Version: 1.0
Author: Mithu A Quayium
Author URI:
License: GPLv2
*/

class WPPT_Init {

    public function __construct() {
        add_action('add_meta_boxes', array( $this, 'wp_add_post_custom_template' ) );
        add_action('save_post', array( $this, 'wp_save_custom_post_template' ),10,2);
    }


    function wp_add_post_custom_template( $post_type ) {

        add_meta_box(
            'postparentdiv',
            __('WP Post Template','wppt'),
            array( $this, 'wp_custom_post_template_meta_box' ),
            $post_type,
            'side',
            'core'
        );
    }

    function wp_custom_post_template_meta_box( $post ) {

        $templates = get_page_templates();
        ?>
        <p><strong>Template</strong></p>
        <label class="screen-reader-text" for="page_template">Page Template</label>
        <?php if( is_array( $templates ) ) :?>
        <select name="page_template" id="page_template">
            <option value="default">Default Template</option>
            <?php foreach( $templates as $name => $path ):?>
                <option value="<?php echo $path; ?>"><?php echo $name; ?></option>
            <?php endforeach;?>
        </select>
        <?php endif; ?>
    <?php
    }

    function wp_save_custom_post_template( $post_id, $post) {
        if ($post->post_type !='page' && !empty($_POST['page_template'])) {

        }
    }
    public static function init() {
        new WPPT_Init();
    }

}

WPPT_Init::init();
