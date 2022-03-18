<?php
/**
 * Template Name: Результат удаления рубрики
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				$wpdb->query ("DELETE FROM wp_terms where term_id=".$_POST ["rubrics"]);
				$wpdb->query ("DELETE FROM wp_term_relationships where term_taxonomy_id=".$_POST ["records"]);
				$wpdb->query ("DELETE FROM wp_term_taxonomity where term_id=".$_POST ["records"]);
				echo "Рубрика успешно удалена.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 