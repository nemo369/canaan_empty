<?php
defined('ABSPATH') || die();


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title h1 inner-width mb-10">', '</h1>' ); ?>
	</header><!-- .entry-header -->


	<div class="entry-content prose inner-width">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'canaan' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
