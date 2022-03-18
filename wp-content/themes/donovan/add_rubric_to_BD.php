<?php
/**
 * Template Name: Результат добавления рубрики рекорда
 */
	get_header ();
	require_once ABSPATH . '/wp-admin/includes/taxonomy.php';
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				$my_cat = array
				(
					"cat_name" => $_POST ["rubric_name"],
					"category_parent" => $_POST ["accessor"],
				);
				echo " mc: ";
				print_r ($my_cat);
				$cat_id = wp_insert_category ($my_cat);
				echo "Новая рубрика рекорда успешно добавлена."
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 