<?php
/**
 * Template Name: Результат добавления рекорда
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				$cats = array (585);
				$sqlstr = "SELECT term_id FROM wp_terms";
				$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
				foreach ($terms as $term)
				{
					//echo " tid: ".$term ["term_id"]." pctid: ".$_POST ["cat-".$term ["id"]];
					if ($_POST ["cat-".$term ["term_id"]] != "")
						array_push ($cats, $term ["term_id"]);
				}
				$post_data = array
				(
					"post_title"  => $_POST ["recordsman_name"],
					"post_content" => $_POST ["record_text"],
					"post_status" => "publish",
					"post_author" => 1,
					"post_category" => $cats
				);
				print_r ($post_data);
				$post_id = wp_insert_post ($post_data);
				if (strlen ($_POST ["record_date"] > 0))
					$wpdb->query ("UPDATE wp_posts SET DATE_RECORD='".$_POST ["record_date"]."' WHERE ID=".$post_id);
				else
					$wpdb->query ("UPDATE wp_posts SET DATE_RECORD='2001-01-01 00:00' WHERE ID=".$post_id);
				echo "Рекорд успешно добавлен.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 