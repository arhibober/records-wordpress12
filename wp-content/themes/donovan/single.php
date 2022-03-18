<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Donovan
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			donovan_post_navigation();

			donovan_related_posts();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
			{
				comments_template();				
				echo do_shortcode ("[bws_google_captcha]");
			}
			endif;
			global $wpdb;
			$sqlstr = "SELECT DATE_RECORD FROM wp_posts where id=".get_the_ID ();
			$dates = $wpdb->get_results ($sqlstr, ARRAY_A);
			if ((count ($dates) > 0) && (in_category ("rekordy")) && ($dates [0]["DATE_RECORD"] != "0000-00-00"))
				echo "Дата установления рекорда: ".$dates [0]["DATE_RECORD"];

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar ();
get_footer ();
