<?php
/**
 * The template for displaying single posts
 *
 * @package Donovan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php donovan_post_image_single(); ?>

	<div class="post-content">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<?php donovan_entry_meta(); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">

			<?php 
				if (function_exists ("dimox_breadcrumbs"))
					dimox_breadcrumbs ();
				the_content ();
				if (strlen (get_the_content ()) == 0)
				{
					the_title ();
					echo "<br/>
						<img src='/wp-content/uploads/2018/12/logo_n_100_.png' class='emptylogo' alt='' title=''>";
				}
			?>

			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'donovan' ),
				'after'  => '</div>',
			) ); ?>

		</div><!-- .entry-content -->

		<?php do_action( 'donovan_author_bio' ); ?>

	</div><!-- .post-content -->

	<footer class="entry-footer post-details">
		<?php donovan_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article>
