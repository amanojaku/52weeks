<?php
/*
 * Template Name: Custom Home Page
 * Description: A home page with featured slider and widgets.
 *
 * @package adamos
 * @since adamos 1.0
 */

get_header(); ?>
        
    <div id="primary_home" class="content-area">
		<div id="content" class="fullwidth" role="main">
            <div class="section_thumbnails group">

                <?php $query = new WP_Query( array( 'post_type' => 'song', 'showposts'=>'1') ); ?>
                <?php while ($query -> have_posts()) : $query -> the_post(); ?>
    
                    <div class="weekly_song">
                        <article>
                            <?php
                                $week = get_post_meta(get_the_ID(), 'week_field', true);
                                echo '<div class = "week">Week '.$week.': </div>';
                                $quote = get_post_meta(get_the_ID(), 'quote_field', true);
                            ?>
                            <div class = "song">
                                <a href="<?php the_permalink(); ?>"><?php echo '".....'. $quote. '....."'; ?>
                            </div>
                                
                        
                            <?php 
                                if ( has_post_thumbnail() ) {
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id());
                                    echo '<div class = "weekly_image" style = "background:url('.$image[0].')"></div>';
                                } ?>
                                <div class = "title">
                                    
                                    <?php the_title(); ?>
                                     
                                    <span class = "artist">
                                    <?php echo '<br>'.get_post_meta(get_the_ID(), 'artist_field', true); ?>
                                    </span>
                                
                                </div>
                                </a>
                        </article>
                    </div>          
                <?php endwhile; ?>

            </div>
  
<!-- Links to other pages - edit the lines:
 <a href="<?php echo get_permalink( get_page_by_path( 'your page name here' ) ); ?>/">
 To link to your pages
 -->

            <div class="section group">
	            <div class="col span_1_of_3">         
                    <div class="featuretext">

                        <a href="<?php echo get_permalink( get_page_by_path( 'song' ) ); ?>">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-music fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
		                <h3><?php echo get_theme_mod( 'featured_textbox_header_one' ); ?></h3>
                        <p><?php echo get_theme_mod( 'featured_textbox_text_one' ); ?></p>
	                </div>
                </div>
    
                <div class="col span_1_of_3">         
                    <div class="featuretext">
                        <a href="<?php echo get_permalink( get_page_by_path( 'the-basics' ) ); ?>">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
        		        <h3><?php echo get_theme_mod( 'featured_textbox_header_two' ); ?></h3>
                        <p><?php echo get_theme_mod( 'featured_textbox_text_two' ); ?></p>
        	        </div>
                </div>
            
                <div class="col span_1_of_3">         
                    <div class="featuretext">
                        <a href="<?php echo get_permalink( get_page_by_path( 'about' ) ); ?>">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
        	            <h3><?php echo get_theme_mod( 'featured_textbox_header_three' ); ?></h3>
                        <p><?php echo get_theme_mod( 'featured_textbox_text_three' ); ?></p>
        	        </div>
                </div>
            </div>
    
        </div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>