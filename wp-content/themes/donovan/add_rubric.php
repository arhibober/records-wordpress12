<?php
/**
 * Template Name: Добавить новую рубрику
 */
	get_header ();
?>
<script language="javascript">
	function overify (f)
	{
		if (f.rubric_name.value.length == 0)
		{
			alert ("Вы не ввели название рубрики!")
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
				echo "<h2>Добавьте новую рубрику рекорда</h2>
					<form action='/add_rubric_toDB' method='POST' onSubmit='return overify (this)'>
						<table>
							<tr>
								<td>
									Введите название предмета/категории рекордов
								</td>
								<td>
									<input type='text' name='rubric_name'/>
								</td>
							</tr>
							<tr>
								<td>
									Здесь Вы можете выбрать рубрику-предка для данной рубрики:
								</td>
								<td>
									<select size='1' name='accessor'>
										<option value='0'>Не указана</option>";		
										$sqlstr = "SELECT term_id, name FROM wp_terms where term_id != 416";
										$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
										foreach ($terms as $term)
											echo "<option value='".$term ["term_id"]."'>".$term ["name"]."</option>";
									echo "</select>
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