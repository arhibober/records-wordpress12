<?php
/**
 * Template Name: Результат удаления рекорда
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				$wpdb->query ("DELETE FROM wp_posts where id=".$_POST ["records"]);
				$wpdb->query ("DELETE FROM wp_postmeta where post_id=".$_POST ["records"]);
				$wpdb->query ("DELETE FROM wp_term_relationships where object_id=".$_POST ["records"]);
				echo "Рекорд успешно удалён.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 