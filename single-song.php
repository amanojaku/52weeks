<?php
/**
 * The Template for displaying all single song posts.
 *
 * @package adamos
 * @since adamos 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content-song" class="site-content" role="main">
				
				<?php while ( have_posts() ) : the_post(); 
					?><div class="weekly_song song_list"><?php
						$week = get_post_meta(get_the_ID(), 'week_field', true);
                			echo '<div class = "week">Week '.$week.': </div>';	?>
						
							<div class = "title_container">
								
						
								<?php 
								if ( has_post_thumbnail() ) {
                       				$image = wp_get_attachment_image_src(get_post_thumbnail_id());
                        			echo '<div class = "weekly_image" style = "background:url('.$image[0].')"></div>';
                        		} ?>
								<div class = "title_content">
                        			<span class = "title">
										<?php the_title(); ?>
									</span> <br>
									<span class = "artist">
									<?php echo '<br>'.get_post_meta(get_the_ID(), 'artist_field', true); ?>
									</span>
								</div>
							</div>
					</div>
					<?php the_content();
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );

			 	endwhile; // end of the loop. ?>


			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->


<?php get_footer(); ?>