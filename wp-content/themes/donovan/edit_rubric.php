<?php
/**
 * Template Name: Отредактировать рубрику
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Выберите рубрики для редактирования</h1>
				<select size='1' name='rubric-choose'>";
				$sqlstr = "SELECT term_id, name FROM wp_terms where ID term_id != 57)";
				$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
				foreach ($terms as $term)
					echo "<option value='".$term ["term_id"]."'>".$post ["name"]."</option>";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 