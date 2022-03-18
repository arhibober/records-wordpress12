<?php
/**
 * Template Name: Результат добавления личности
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				echo "INSERT INTO PEOPLE (NAME, PATRONYMIC, SURNAME, BIRTHDAY) VALUE ('".$_POST ["name1"]."', '".$_POST ["surname"]."','".$_POST ["patronymic"]."', '".$_POST ["birthday"]."')";
				$wpdb->query ("INSERT INTO PEOPLE (NAME, PATRONYMIC, SURNAME, BIRTHDAY) VALUES ('".$_POST ["name1"]."', '".$_POST ["surname"]."','".$_POST ["patronymic"]."', '".$_POST ["birthday"]."')");
				echo "Информация о человеке успешно добавлена.";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_footer (); 