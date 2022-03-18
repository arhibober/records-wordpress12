<?php
/**
 * Template Name: Результат добавления улицы
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				$wpdb->query ("INSERT INTO STREETS (OLD_NAME, NEW_NAME) VALUES ('".$_POST ["old_name"]."', '".$_POST ["new_name"]."')");
				echo "Информация об улице успешно добавлена.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_footer (); 