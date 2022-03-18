<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Donovan
 */

get_header(); ?>

	<div id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

		<?php
			if (function_exists ("dimox_breadcrumbs"))
				dimox_breadcrumbs ();
			if ((isset ($_GET ["order"])) && ($_GET ["order"] == "abc"))
				query_posts ($query_string.'&orderby=title&order=asc');
			/*else
				$args = array (
					"orderby" => "post_date",
					"order" => "ASC",
				); // задаем условия выборки постов*/
			//$my_query = new WP_Query($args);
			if (have_posts ()) : ?>
				<header class="archive-header">
					<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</header><!-- .archive-header -->
			<div id="post-wrapper" class="post-wrapper">

			<?php while (have_posts ()) : the_post();

				get_template_part( 'template-parts/content', esc_attr( donovan_get_option( 'blog_content' ) ) );

			endwhile; ?>

			</div>

			<?php
			donovan_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
