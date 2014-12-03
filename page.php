<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content-song" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); 
 the_content(); endwhile;?>
		</div>
		</div>
<?php
get_footer();
?>