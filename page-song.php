<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content-song" class="site-content" role="main">

		  	<?php $query = new WP_Query( array( 'post_type' => 'song', 'order' => 'ASC') );
    
     		while ($query -> have_posts()) : $query -> the_post(); ?>

     			  <div class="weekly_song song_list">
            <article>
              <?php
                $week = get_post_meta(get_the_ID(), 'week_field', true);
                echo '<div class = "week">Week '.$week.': </div>';
                $quote = get_post_meta(get_the_ID(), 'quote_field', true);
             ?>
             <a href="<?php the_permalink(); ?>"><div class ="song"><?php echo '".....'. $quote. '....."'; ?></div>
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
            </a>
            <br>
        </article>
    </div>          


				

			</div>
    <?php endwhile; ?>
		</div><!-- #primary .content-area -->


<?php get_footer(); ?>