<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rara_Business
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		$args = array (
            'post_type' => 'post',
            'category_name'   => 'blogs',
            'posts_per_page' => 6,
            'shoposts' => 6,
            'paged' => $paged
            );
      // The Query

          $wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) :

			/* Start the Loop */
			while ( $wp_query->have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
        
        <?php
        /**
         * @hooked rara_business_pagination
        */
        do_action( 'rara_business_after_posts_content' );
        ?> 
        
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
