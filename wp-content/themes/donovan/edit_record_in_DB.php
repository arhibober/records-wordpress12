<?php
/**
 * Template Name: Результат редактирования рекорда
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				$wpdb->query ("DELETE FROM wp_term_relationships WHERE object_id=".$_POST ["record_choose"])." AND term_taxonomy_id != 57";
				$sqlstr = "SELECT term_taxonomy_id FROM wp_term_relationships WHERE term_taxonomy_id != 57";
				$cats = $wpdb->get_results ($sqlstr, ARRAY_A);
				foreach ($cats as $cat)
					if ($_POST ["cat-".$cat ["term_taxonomy_id"]])
						$wpdb->query ("INSERT INTO wp_term_relationships VALUES (".$_POST ["record_choose"], $cat ["term_taxonomy_id"], 0)
				$wpdb->query ("UPDATE wp_posts SET post_title='".$_POST ["recorsman_name"]."' WHERE ID=".$_POST ["record_choose"]);
				$wpdb->query ("UPDATE wp_posts SET post_content='".$_POST ["record_text"]."' WHERE ID=".$_POST ["record_choose"]);
				$wpdb->query ("UPDATE wp_posts SET DATE_RECORD='".$_POST ["record_date"]."' WHERE ID=".$_POST ["record_choose"]);
				$wpdb->query ("UPDATE wp_posts SET REFERENCE='".$_POST ["link"]."' WHERE ID=".$_POST ["record_choose"]);
				echo "Рекорд успешно изменён.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 