<?php
class MySite extends Timber\Site {

    /** Add timber support. */
    public function __construct() {
        //add_action( 'acf/init', array( $this, 'my_acf_op_init' ), 5 ); // only with pro
        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'widgets_init', array( $this, 'ula_widgets_init' ) );

        add_filter( 'auto_update_theme', '__return_false' );
        parent::__construct();
    }


    /** only with pro */
    public function my_acf_op_init() {

        // Check function exists.
        if( function_exists('acf_add_options_page') ) {

            // Add parent.
            $parent = acf_add_options_page(array(
                'page_title'  => __('Theme General Settings'),
                'menu_title'  => __('Theme Settings'),
                'redirect'    => false,
            ));

            // Add sub page.
            $child = acf_add_options_page(array(
                'page_title'  => __('Social Settings'),
                'menu_title'  => __('Social'),
                'parent_slug' => $parent['menu_slug'],
            ));
        }
    }


    public function theme_supports() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            )
        );

        add_theme_support( 'menus' );


        register_nav_menus(array(
            'masthead'    => 'Main Menu',    //???????????????? ?????????????????????????????????? ???????? ?? ??????????????
            'footer' => 'Footer Menu',      //???????????????? ?????????????? ?????????????????????????????????? ???????? ?? ??????????????
            'aside' => 'Aside Menu'
        ));


        add_shortcode( 'foobar', 'foobar_shortcode' );

        function foobar_shortcode( $atts ){
            return 'Hi. I\'m shortcode';
        }
    }


    public function ula_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Primary Sidebar', 'ula' ),
            'id'            => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Secondary Sidebar', 'ula' ),
            'id'            => 'sidebar-2',
            'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li></ul>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }

}
