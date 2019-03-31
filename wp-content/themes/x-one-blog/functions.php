<?php
/**
 * X-One Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package X-One_Blog
 */

if ( ! function_exists( 'x_one_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function x_one_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on X-One Blog, use a find and replace
		 * to change 'x-one-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'x-one-blog', get_template_directory() . '/languages' );

        $args = array(
            'flex-width'    => true,
            'width'         => 1063,
            'flex-height'    => true,
            'height'        => 200,
            'default-image' => get_template_directory_uri() . '/images/header.png',
        );
        add_theme_support( 'custom-header', $args );
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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'x-one-blog' ),
		) );
        function register_footer_menu() {
            register_nav_menu('footer-menu',__( 'Footer Menu' ));
        }

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'x_one_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'x_one_blog_setup' );
add_action( 'init', 'register_footer_menu' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function x_one_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'x_one_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'x_one_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function x_one_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'x-one-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'x-one-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'x_one_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function x_one_blog_scripts() {
	wp_enqueue_style( 'x-one-blog-style', get_stylesheet_uri() );

	wp_enqueue_script( 'x-one-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'x-one-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'x_one_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}











function wpb_load_widget() {
    register_widget( 'xone_article' );
    register_widget( 'xone_newsletter' );
    register_widget( 'xone_repeating' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

class xone_article extends WP_Widget {


    function __construct() {
        parent::__construct(
            'xone_article',
            __('X-One Articles', 'xone_article_domain'),
            array( 'description' => __( '' ), )
        );
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'whichArticle' ] ) ) $whichArticle = $instance[ 'whichArticle' ];
        else $whichArticle = 1;
        if ( isset( $instance[ 'articleImage' ] ) ) $articleImage = $instance[ 'articleImage' ];
        else $articleImage = false;
        if ( isset( $instance[ 'articleComment' ] ) ) $articleComment = $instance[ 'articleComment' ];
        else $articleComment = false;
        if ( isset( $instance[ 'commentText' ] ) ) $commentText = $instance[ 'commentText' ];
        else $commentText = "Leave a comment";
        if ( isset( $instance[ 'contentLimit' ] ) ) $contentLimit = $instance[ 'contentLimit' ];
        else $contentLimit = "limited";
        ?>
        <p>
            <input class="" id="<?php echo $this->get_field_id( 'articleImage' ); ?>" name="<?php echo $this->get_field_name( 'articleImage' ); ?>" type="checkbox" <?php if($articleImage) echo "checked"?> />
            <label for="<?php echo $this->get_field_id( 'articleImage' ); ?>"><?php _e( 'Show article image' ); ?></label>
        </p><p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'articleComment' ); ?>" name="<?php echo $this->get_field_name( 'articleComment' ); ?>" type="checkbox" <?php if($articleComment) echo "checked"?> />
            <label for="<?php echo $this->get_field_id( 'articleComment' ); ?>"><?php _e( 'Show "Leave a comment"' ); ?></label>
        </p><p>
            <label for="<?php echo $this->get_field_id( 'whichArticle' ); ?>"><?php _e( 'Order' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'whichArticle' ); ?>" name="<?php echo $this->get_field_name( 'whichArticle' ); ?>" type="number" value="<?php echo esc_attr( $whichArticle ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'commentText' ); ?>"><?php _e( '"Leave a comment" message' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'commentText' ); ?>" name="<?php echo $this->get_field_name( 'commentText' ); ?>" type="text" value="<?php echo esc_attr( $commentText ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'contentLimit' ); ?>"><?php _e( 'Content character limit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'contentLimit' ); ?>" name="<?php echo $this->get_field_name( 'contentLimit' ); ?>">
                <option <?php if($contentLimit == "full") echo "selected " ?>value="full">Show full article</option>
                <option <?php if($contentLimit == "limited") echo "selected " ?>value="limited">Limited (200 characters)</option>
            </select>
        </p>

        <?php
    }
    public function widget( $args, $instance ) {
        if ( !isset( $instance[ 'whichArticle' ] ) ) $instance[ 'whichArticle' ] = 1;
        echo "<div class='xoneArticleBox'>";
        $n = 1;
        $recent_posts = wp_get_recent_posts();
        foreach( $recent_posts as $recent ){
            if($n == $instance[ 'whichArticle' ]) {
                $catName = get_the_category( $recent["ID"]);
                if($instance[ 'articleImage' ]) echo "<a href='".$recent["guid"]."'>".get_the_post_thumbnail( $recent["ID"], array(420, 320))."</a>";
                echo "<a href=".get_category_link( $catName[0]->term_id )."><div class='artCategory'>".$catName[0]->name."</div></a>";
                echo "<a href='".$recent["guid"]."'><div class='artTitle'>".$recent["post_title"] ."</div><div class='artContent'>";
                if ($instance[ 'contentLimit' ] == "limited"){
                    $pos=strpos($recent["post_content"], ' ', 210);
                    echo substr($recent["post_content"],0,$pos );
                }
                else echo $recent["post_content"];
                echo "</a></div>";
                if($instance[ 'articleComment' ]){
                    echo "<div class='artComment'><a href='".$recent["guid"]."#comments'>";
                    if(!$instance[ 'commentText' ]) echo "Leave a comment";
                    else echo $instance[ 'commentText' ];
                    echo "</a></div>";
                }
                //echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
            }
            $n++;
        }
        echo "</div>";
        wp_reset_query();

    }
}

class xone_newsletter extends WP_Widget {

    function __construct() {
        parent::__construct(
            'xone_newsletter',
            __('X-One Newsletter Form', 'xone_newsletter_domain'),
            array( 'description' => __( '' ), )
        );
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'headingText' ] ) ) $headingText = $instance[ 'headingText' ];
        else $headingText = "Sign up for our newsletter!";
        if ( isset( $instance[ 'inputText' ] ) ) $inputText = $instance[ 'inputText' ];
        else $inputText = "Enter a valid email address";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'headingText' ); ?>"><?php _e( 'Heading:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'headingText' ); ?>" name="<?php echo $this->get_field_name( 'headingText' ); ?>" type="text" value="<?php echo esc_attr( $headingText ); ?>" />
            <label for="<?php echo $this->get_field_id( 'inputText' ); ?>"><?php _e( 'Input:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'inputText' ); ?>" name="<?php echo $this->get_field_name( 'inputText' ); ?>" type="text" value="<?php echo esc_attr( $inputText ); ?>" />
        </p>

        <?php
    }
    public function widget( $args, $instance ) {
        echo '
        <div class="xoneNewsletterFormOuter">
        <div class="xoneNewsletterForm">
        <div class="xoneNewsletterHeading">';
            if(isset ($instance[ 'headingText' ]) && $instance[ 'headingText' ]!= "Sign up for our newsletter!") echo $instance[ 'headingText' ];
            else echo "Sign up for our newsletter!";
        echo '</div>
        <div class="newsletterInner">
        <div class="tnp tnp-subscription">
        <form method="post" action="?na=s" onsubmit="return newsletter_check(this)">
        
        <input type="hidden" name="nlang" value="">
        <div class="tnp-field tnp-field-email"><input class="tnp-email" type="email" name="ne" placeholder="';
            if(isset ($instance[ 'inputText' ]) && $instance[ 'inputText' ]!= "Enter a valid email address") echo $instance[ 'inputText' ];
            else echo "Enter a valid email address";
        echo '" required></div>
        <div class="tnp-field tnp-field-button"><input class="tnp-submit" type="submit" value="">
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        ';
        wp_reset_query();


    }
}

class xone_repeating extends WP_Widget {


    function __construct() {
        parent::__construct(
            'xone_repeating',
            __('X-One Infinite Articles', 'xone_repeating_domain'),
            array( 'description' => __( '' ), )
        );
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'offset' ] ) ) $offset = $instance[ 'offset' ];
        else $offset = 0;
        if ( isset( $instance[ 'parity' ] ) ) $parity = $instance[ 'parity' ];
        else $parity = 0;
        if ( isset( $instance[ 'articleImage' ] ) ) $articleImage = $instance[ 'articleImage' ];
        else $articleImage = false;
        if ( isset( $instance[ 'articleComment' ] ) ) $articleComment = $instance[ 'articleComment' ];
        else $articleComment = false;
        if ( isset( $instance[ 'commentText' ] ) ) $commentText = $instance[ 'commentText' ];
        else $commentText = "Leave a comment";
        if ( isset( $instance[ 'contentLimit' ] ) ) $contentLimit = $instance[ 'contentLimit' ];
        else $contentLimit = "limited";
        if ( isset( $instance[ 'spaceBetween' ] ) ) $spaceBetween = $instance[ 'spaceBetween' ];
        else $spaceBetween = 0;
        ?>
        <p>
            <input class="" id="<?php echo $this->get_field_id( 'articleImage' ); ?>" name="<?php echo $this->get_field_name( 'articleImage' ); ?>" type="checkbox" <?php if($articleImage) echo "checked"?> />
            <label for="<?php echo $this->get_field_id( 'articleImage' ); ?>"><?php _e( 'Show articles images' ); ?></label>
        </p><p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'articleComment' ); ?>" name="<?php echo $this->get_field_name( 'articleComment' ); ?>" type="checkbox" <?php if($articleComment) echo "checked"?> />
            <label for="<?php echo $this->get_field_id( 'articleComment' ); ?>"><?php _e( 'Show "Leave a comment"' ); ?></label>
        </p><p>
            <label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php _e( 'Article offset' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" type="number" value="<?php echo esc_attr( $offset ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'commentText' ); ?>"><?php _e( '"Leave a comment" message' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'commentText' ); ?>" name="<?php echo $this->get_field_name( 'commentText' ); ?>" type="text" value="<?php echo esc_attr( $commentText ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'spaceBetween' ); ?>"><?php _e( 'Space between posts (px)' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'spaceBetween' ); ?>" name="<?php echo $this->get_field_name( 'spaceBetween' ); ?>" min=0 type="number" value="<?php echo esc_attr( $spaceBetween ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'contentLimit' ); ?>"><?php _e( 'Content character limit' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'contentLimit' ); ?>" name="<?php echo $this->get_field_name( 'contentLimit' ); ?>">
                <option <?php if($contentLimit == "full") echo "selected " ?>value="full">Show full articles</option>
                <option <?php if($contentLimit == "limited") echo "selected " ?>value="limited">Limited (200 characters)</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'parity' ); ?>"><?php _e( 'Articles selection' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'parity' ); ?>" name="<?php echo $this->get_field_name( 'parity' ); ?>">
                <option <?php if($parity == 0) echo "selected " ?>value=0>Both</option>
                <option <?php if($parity == 1) echo "selected " ?>value=1>Even only</option>
                <option <?php if($parity == 2) echo "selected " ?>value=2>Odd only</option>
            </select>
        </p>
        <?php
    }
    public function widget( $args, $instance ) {
        if ( !isset( $instance[ 'offset' ] ) ) $instance[ 'offset' ] = 0;
        if ( !isset( $instance[ 'parity' ] ) ) $instance[ 'parity' ] = 0;
        $n = 0;
        $recent_posts = wp_get_recent_posts();
        foreach( $recent_posts as $recent ){
            if($n >= $instance[ 'offset' ] && (($instance[ 'parity' ] == 0) || (($instance[ 'parity' ] == 1) && ($n%2 == 0)) || (($instance[ 'parity' ] == 2) && ($n%2 == 1)))) {
                echo "<div class='xoneArticleBox xoneInfiniteArticles' style='margin-top:".$instance[ 'spaceBetween' ]."px'>";
                $catName = get_the_category( $recent["ID"]);
                if($instance[ 'articleImage' ]) echo "<a href='".$recent["guid"]."'>".get_the_post_thumbnail( $recent["ID"], array(420, 320))."</a>";
                echo "<a href=".get_category_link( $catName[0]->term_id )."><div class='artCategory'>".$catName[0]->name."</div></a>";
                echo "<a href='".$recent["guid"]."'><div class='artTitle'>".$recent["post_title"] ."</div><div class='artContent'>";
                if ($instance[ 'contentLimit' ] == "limited"){
                    $pos=strpos($recent["post_content"], ' ', 210);
                    echo substr($recent["post_content"],0,$pos );
                }
                else echo $recent["post_content"];
                echo "</a></div>";
                if($instance[ 'articleComment' ]){
                    echo "<div class='artComment'><a href='".$recent["guid"]."#comments'>";
                    if(!$instance[ 'commentText' ]) echo "Leave a comment";
                    else echo $instance[ 'commentText' ];
                    echo "</a></div>";
                }
                echo "</div>";
            }
            $n++;

        }

        wp_reset_query();

    }
}