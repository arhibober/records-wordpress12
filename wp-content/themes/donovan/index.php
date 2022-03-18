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
 * @package Donovan
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				if (function_exists ("dimox_breadcrumbs"))
					dimox_breadcrumbs ();
			//echo " go: ".$_GET ["order"];
			if ((isset ($_GET ["order"])) && ($_GET ["order"] == "abc"))
				query_posts ($query_string.'&orderby=title&order=asc');
			if ( have_posts() ) :

				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile;

				donovan_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
