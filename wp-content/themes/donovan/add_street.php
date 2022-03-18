<?php
/**
 * Template Name: Добавить новую улицу
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main"> 
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Добавьте новую улицу</h1>
					<form action='/add_street_to_DB' method='POST'>
						<table>
							<tr>
								<td>
									Введите старое название улицы
								</td>
								<td>
									<input type='text' name='old_name'/>
								</td>
							</tr>							
							<tr>
								<td>
									Введите новое название улицы
								</td>
								<td>
									<input type='text' name='new_name'/>
								</td>
							</tr>
						</table>
						<input type='submit' value='OK'/>
					</form>";
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer (); 