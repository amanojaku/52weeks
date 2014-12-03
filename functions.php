<?php

/*Template: Adamos*/
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


@ini_set( 'upload_max_size' , '64M' );

add_theme_support('post-thumbnails', array ('post','song'));
set_post_thumbnail_size( 140, 140, true );

/***********************************************************
Song cutom post type
************************************************************/

add_action( 'init', 'create_song_post_type' );
function create_song_post_type() {
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

