<?php
/**
 * adamos functions and definitions
 *
 * @package adamos
 * @since adamos 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since adamos 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'adamos_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since adamos 1.0
 */
function adamos_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on adamos, use a find and replace
	 * to change 'adamos' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'adamos', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'adamos' ),
	) );
	
	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size( 'frontpage-thumbnail', 460, 160, true);
	add_image_size( 100, 300, true);
	add_image_size( 'featured', 650, 300, true );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // adamos_setup
add_action( 'after_setup_theme', 'adamos_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since adamos 1.0
 */
function adamos_register_custom_background() {
	$args = array(
		'default-color' => 'EEE',
	);

	$args = apply_filters( 'adamos_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'adamos_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since adamos 1.0
 */
function adamos_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'adamos' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'adamos' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar(array(
			'name' => 'Left Footer Column',
			'id'   => 'left_column',
			'description'   => 'Widget area for footer left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Center  Footer Column',
			'id'   => 'center_column',
			'description'   => 'Widget area for footer center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Footer Column',
			'id'   => 'right_column',
			'description'   => 'Widget area for footer right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', 'adamos_widgets_init' );


/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );



/**
 * Enqueue scripts and styles
 */
function adamos_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	wp_enqueue_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );
		
	wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
}
add_action( 'wp_enqueue_scripts', 'adamos_scripts' );


/**
 * Implement home slider
 */

function adamos_add_scripts() {
    wp_enqueue_script('flexslider', get_template_directory_uri('stylesheet_directory').'/js/jquery.flexslider-min.js', array('jquery'));
    wp_enqueue_script('flexslider-init', get_template_directory_uri('stylesheet_directory').'/js/flexslider-init.js', array('jquery', 'flexslider'));
}
add_action('wp_enqueue_scripts', 'adamos_add_scripts');

function adamos_add_styles() {
    wp_enqueue_style('flexslider', get_template_directory_uri('stylesheet_directory').'/js/flexslider.css');
}
add_action('wp_enqueue_scripts', 'adamos_add_styles');

/**
 * Implement the Custom Logo feature
 */
function adamos_theme_customizer( $wp_customize ) {
   
   $wp_customize->add_section( 'adamos_logo_section' , array(
    'title'       => __( 'Logo', 'adamos' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

   $wp_customize->add_setting( 
   		'adamos_logo',
		array(
			'sanitize_callback' => 'adamos_sanitize_upload',
		)
	);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'adamos_logo', array(
    'label'    => __( 'Logo', 'adamos' ),
    'section'  => 'adamos_logo_section',
    'settings' => 'adamos_logo',
) ) );


}
add_action('customize_register', 'adamos_theme_customizer');


/**
 * Adds the individual section for featured text box top
 */
function adamos_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'featured_section_top',
        array(
			'title'       => __( 'Featured Text Area', 'adamos' ),
    		'description' => __( 'This is a settings section to change the homepage featured text area.', 'adamos' ),
            'priority' => 150,
        )
    );
	
	$wp_customize->add_setting(
    'featured_textbox',
    array(
        'default' => __( 'Default Featured Text', 'adamos' ),
		'sanitize_callback' => 'adamos_sanitize_text',
    )
);

$wp_customize->add_control(
    'featured_textbox',
    array(
		'label'    => __( 'Featured Text Header', 'adamos' ),
        'section' => 'featured_section_top',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
		'featured_textbox_text',
		array(
			'default' => __( 'Default Featured Text', 'adamos' ),
			'sanitize_callback' => 'adamos_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		'featured_textbox_text',
		array(
			'label'    => __( 'Featured sub text', 'adamos' ),
			'section' => 'featured_section_top',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting( 'header_one_url',
    array(
        'default' => __( 'Featured sub text url', 'adamos' ),
		'sanitize_callback' => 'adamos_sanitize_url',
    ) );
	
	$wp_customize->add_control(
		'header_one_url',
		array(
			'label'    => __( 'Featured sub text url', 'adamos' ),
			'section' => 'featured_section_top',
			'type' => 'text',
		)
	);
}
add_action( 'customize_register', 'adamos_customizer' );


/**
 * Adds the individual section for featured text box 1
 */
function featured_text_one_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'featured_section_one',
        array(
			'title' => __( 'Featured Text Box 1', 'adamos' ),
            'description' => __( 'This is a settings section to change the homepage featured text area.', 'adamos' ),
            'priority' => 155,
        )
    );
	
	$wp_customize->add_setting(
    'featured_textbox_header_one',
    array(
        'default' => __( 'Default featured text Header', 'adamos' ),
		'sanitize_callback' => 'adamos_sanitize_text',
    )
	);
	
	$wp_customize->add_control(
		'featured_textbox_header_one',
		array(
			'label' => __( 'Featured Header Text', 'adamos' ),
			'section' => 'featured_section_one',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'featured_textbox_text_one',
		array(
			'default' => __( 'Default featured text', 'adamos' ),
			'sanitize_callback' => 'adamos_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		'featured_textbox_text_one',
		array(
			'label' => __( 'Featured Text', 'adamos' ),
			'section' => 'featured_section_one',
			'type' => 'text',
		)
	);

}
add_action( 'customize_register', 'featured_text_one_customizer' );

/**
 * Adds the individual section for featured text box 2
 */
function featured_text_two_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'featured_section_two',
        array(
			'title' => __( 'Featured Text Box 2', 'adamos' ),
            'description' => __( 'This is a settings section to change the homepage featured text area.', 'adamos' ),
            'priority' => 160,
        )
    );
	
	$wp_customize->add_setting(
    'featured_textbox_header_two',
    array(
       'default' => __( 'Default featured text Header', 'adamos' ),
		'sanitize_callback' => 'adamos_sanitize_text',
    )
	);
	
	$wp_customize->add_control(
		'featured_textbox_header_two',
		array(
			'label' => __( 'Featured Header text', 'adamos' ),
			'section' => 'featured_section_two',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'featured_textbox_text_two',
		array(
			'default' => __( 'Default featured text', 'adamos' ),
			'sanitize_callback' => 'adamos_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		'featured_textbox_text_two',
		array(
			'label' => __( 'Featured text', 'adamos' ),
			'section' => 'featured_section_two',
			'type' => 'text',
		)
	);
}
add_action( 'customize_register', 'featured_text_two_customizer' );

/**
 * Adds the individual section for featured text box 3
 */
function featured_text_three_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'featured_section_three',
        array(
			'title' => __( 'Featured Text Box 3', 'adamos' ),
            'description' => __( 'This is a settings section to change the homepage featured text area.', 'adamos' ),
            'priority' => 165,
        )
    );
	
	$wp_customize->add_setting(
    'featured_textbox_header_three',
    array(
		'default' => __( 'Default featured text Header', 'adamos' ),
		'sanitize_callback' => 'adamos_sanitize_text',
    )
	);
	
	$wp_customize->add_control(
		'featured_textbox_header_three',
		array(
			'label' => __( 'Featured Header text', 'adamos' ),
			'section' => 'featured_section_three',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'featured_textbox_text_three',
		array(
			'default' => __( 'Default featured text', 'adamos' ),
			'sanitize_callback' => 'adamos_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		'featured_textbox_text_three',
		array(
			'label' => __( 'Featured text', 'adamos' ),
			'section' => 'featured_section_three',
			'type' => 'text',
		)
	);
}
add_action( 'customize_register', 'featured_text_three_customizer' );


/**
 * Implement excerpt for homepage slider
 */
function adamos_get_slider_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 150);
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
return $excerpt;
}

/**
 * sanitize customizer text input
 */
 function adamos_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function adamos_sanitize_url( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function adamos_sanitize_upload($input){
	return esc_url_raw($input);	
}


add_filter( 'wp_title', 'adamos_wp_title' );

/**
 * Implement excerpt for homepage thumbnails
 */
function adamos_content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 */
function adamos_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'adamos' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}

/**
 * Implement the Custom Header feature
 */
add_theme_support( 'custom-header' );
function adamos_custom_header_setup() {
$args = array(
		'default-image'          => '',
		'default-text-color'     => 'FFF',
		'width'                  => 2000,
		'height'                 => 400,
		'flex-height'            => true,
		'wp-head-callback'       => 'adamos_header_style',
		'admin-head-callback'    => 'adamos_admin_header_style',
		'admin-preview-callback' => 'adamos_admin_header_image',
	);

	$args = apply_filters( 'adamos_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
}
}
add_action( 'after_setup_theme', 'adamos_custom_header_setup' );


if ( ! function_exists( 'adamos_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see adamos_custom_header_setup().
 *
 * @since adamos 1.0
 */
function adamos_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		.site-header img {
			display: block;
		}
	<?php endif;

		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		.site-header hgroup {
			background: none;
			padding: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // adamos_header_style

if ( ! function_exists( 'adamos_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see adamos_custom_header_setup().
 *
 * @since adamos 1.0
 */
function adamos_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #000;
		border: none;
		min-height: 200px;
	}
	#headimg h1 {
		font-size: 20px;
		font-family: 'open_sansbold', sans-serif;
		font-weight: normal;
		padding: 0.8em 0.5em 0;
	}
	#desc {
		padding: 0 2em 2em;
	}
	#headimg h1 a,
	#desc {
		color: #FFF;
		text-decoration: none;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // adamos_admin_header_style

if ( ! function_exists( 'adamos_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see adamos_custom_header_setup().
 *
 * @since adamos 1.0
 */
function adamos_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // adamos_admin_header_image

/***********************************************************
Song cutom post type
************************************************************/

@ini_set( 'upload_max_size' , '64M' );


add_theme_support('post-thumbnails', array ('post','song'));
set_post_thumbnail_size( 140, 140, true );

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'song',
    array(
      'labels' => array(
        'name' => __( 'Song' ),
        'singular_name' => __( 'Song' ),
        ),
        'supports' => array( 'title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail' ),
      'public' => true,
      'has_archive' => true
      )
    
  );
}

/*Week Number Meta Box*/
add_action( 'add_meta_boxes', 'add_week_metabox' );

	function add_week_metabox() {
    add_meta_box(
    	'week_field', 
    	'Week Number', 
    	'week_callback', 
    	'song', 
    	'normal', 
    	'high'
    );
}

function week_callback(){
	wp_nonce_field( basename( __FILE__ ), 'week_nonce' );
    $value = get_post_meta( $_GET['post'], "week_field", true );
    echo '<input type="text" id="week_field" name="week_field" value="' . esc_attr( $value ) . '" size="2" />'; 
}
/*Artist save*/
function save_week_details( $post_id ) {
    
    // Check save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'week_nonce' ] ) && wp_verify_nonce( $_POST[ 'week_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'week_field' ] ) ) {
        update_post_meta( $post_id, 'week_field', $_POST[ 'week_field' ]  );
    }
}

add_action( 'save_post', 'save_week_details' );


/* Quote Meta box*/
add_action( 'add_meta_boxes', 'add_quote_metabox' );

function add_quote_metabox() {
    add_meta_box(
    	'quote_field', 
    	'Quote', 
    	'quote_callback', 
    	'song', 
    	'normal', 
    	'high'
    );
}

function quote_callback(){
 	wp_nonce_field( basename( __FILE__ ), 'quote_nonce' );
    $value = get_post_meta( $_GET['post'], "quote_field", true );
    
    echo '<input type="text" id="quote_field" name="quote_field" value="' . esc_attr( $value ) . '" size="125" />'; 
}
 
/*Quote save*/
function save_quote_details( $post_id ) {
    
    // Check save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'quote_nonce' ] ) && wp_verify_nonce( $_POST[ 'quote_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'quote_field' ] ) ) {
        update_post_meta( $post_id, 'quote_field', $_POST[ 'quote_field' ]  );
    }
}

add_action( 'save_post', 'save_quote_details' );

//*Artist meta box*/
add_action( 'add_meta_boxes', 'add_artist_metabox' );

	function add_artist_metabox() {
    add_meta_box(
    	'artist_field', 
    	'Artist', 
    	'artist_callback', 
    	'song', 
    	'normal', 
    	'high'
    );
}

function artist_callback(){
	wp_nonce_field( basename( __FILE__ ), 'artist_nonce' );
    $value = get_post_meta( $_GET['post'], "artist_field", true );
    echo '<input type="text" id="artist_field" name="artist_field" value="' . esc_attr( $value ) . '" size="125" />'; 
}
/*Artist save*/
function save_artist_details( $post_id ) {
    
    // Check save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'artist_nonce' ] ) && wp_verify_nonce( $_POST[ 'artist_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'artist_field' ] ) ) {
        update_post_meta( $post_id, 'artist_field', $_POST[ 'artist_field' ]  );
    }
}

add_action( 'save_post', 'save_artist_details' );


add_theme_support( 'post-thumbnails' );

/*Image meta box*/
/*add_action( 'add_meta_boxes', 'add_image_metabox' );

	function add_image_metabox() {
    add_meta_box(
    	'image_field', 
    	'Image', 
    	'image_callback', 
    	'song', 
    	'normal', 
    	'high'
    );
}

function image_callback(){
	wp_nonce_field( basename( __FILE__ ), 'image_nonce' );
    $value = get_post_meta( $_GET['post'], "image_field", true );
    echo '<input type="text" id="image_field" name="image_field" value="' . esc_attr( $value ) . '" size="125" />'; 
}*/

/*Function to get week number of posts*/
