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
 * @package ACF_Gutenberg_Block
 */

get_header();
?>

	<main id="primary" class="site-main row">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="h1 page-title screen-reader-text"><?php single_post_title(); ?></h1>
					<h2 class="h2 page-title screen-reader-text"><?php single_post_title(); ?></h2>
					<h3 class="h3 page-title screen-reader-text"><?php single_post_title(); ?></h3>
					<h4 class="h4 page-title screen-reader-text"><?php single_post_title(); ?></h4>
					<h5 class="h5 page-title screen-reader-text"><?php single_post_title(); ?></h5>
					<h6 class="h6 page-title screen-reader-text"><?php single_post_title(); ?></h6>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
