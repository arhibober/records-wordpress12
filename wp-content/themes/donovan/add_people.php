<?php
/**
 * Template Name: Добавить новую личность
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main"> 
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Добавьте новую личность</h1>
					<form action='/add_people_to_DB' method='POST'>
						<table>
							<tr>
								<td>
									Введите фамилию личности
								</td>
								<td>
									<input type='text' name='surname'/>
								</td>
							</tr>							
							<tr>
								<td>
									Введите имя личности
								</td>
								<td>
									<input type='text' name='name1'/>
								</td>
							</tr>
							<tr>
								<td>
									Введите отчество личности
								</td>
								<td>
									<input type='text' name='patronymic'/>
								</td>
							</tr>
							<tr>
								<td>
									Введите дату рождения личности:
								</td>
								<td>
									<input type='date' class='form-control mydate' name='birthday' placeholder='Дата'>
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