<?php
/**
 * Template Name: Добавить новый рекорд
 */
	get_header ();
?>
<script language="javascript">
	function overify (f)
	{
		if (f.recordsman_name.value.length == 0)
		{
			alert ("Вы не ввели идентификатора рекордсмена!")
			return false;
		}
		else
			return true;
	}
</script>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main"> 
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Добавьте новый рекорд</h1>
					<form action='/add_record_toDB' method='POST' onSubmit='return overify (this)'>
						<table>
							<tr>
								<td>
									Введите идентификатор рекордсмена (имя в случае человека, адрес в случае дома и. т. п..)
								</td>
								<td>
									<input type='text' name='recordsman_name'/>
								</td>
							</tr>
							<tr>
								<td>
									Выберите предмет или предметы рекорда, категории рекорда:
								</td>
								<td>";		
								$sqlstr = "SELECT term_id, name FROM wp_terms order by name asc";
								$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
								foreach ($terms as $term)
									if ($term ["term_id"] != 415)
										echo "<input type='checkbox' name='cat-".$term ["term_id"]."'/>".$term ["name"]."<br/>";
								echo "</td>
							</tr>
							<tr>
								<td>
									Введите дату установления рекорда:
								</td>
								<td>
									<input type='date' class='form-control mydate' name='record_date' placeholder='Дата'>
								</td>
						</tr>
							<tr>
								<td>
									Введите описание рекорда:
								</td>
								<td>
									<textarea width='60' height='10' name='record_text'></textarea>
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