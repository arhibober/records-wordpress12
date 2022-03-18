<?php
/**
 * Template Name: Результат редактирования рубрики рекорда
 */
	get_header ();
	require_once ABSPATH . '/wp-admin/includes/taxonomy.php';
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				$wpdb->query ("UPDATE wp_terms SET name='".$_POST ["rubric_name"]."' WHERE term_id=".$_POST ["rubric_choose"]);
				$wpdb->query ("UPDATE wp_term_taxonomy SET parent='".$_POST ["accessor"]."' WHERE term_id=".$_POST ["rubric_choose"]);
				echo "Рубрика рекорда успешно отредактирована."
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 