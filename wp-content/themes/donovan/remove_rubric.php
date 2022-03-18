<?php
/**
 * Template Name: Удалить рубрику
 */
	get_header ();
?>
<script language="javascript">
	function overify (f)
	{
		if (confirm ("Вы уверены, что хотите удалить рубрику \"" + f.rubrics.options[f.rubrics.selectedIndex].text + "\"?"))
			return true;
		else
			return false;
	}
</script>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Здесь вы можете удалить лишнюю рубрику</h1>
					<form action='/remove_rubric_from_DB' method='POST' onSubmit='return overify (this);'>
						<table>
							<tr>
								<td>
									Выберите подлежащую удалению рубрику
								</td>
								<td>";
									$sqlstr = "SELECT term_id, name FROM wp_terms WHERE term_id!=416";
									$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
									echo "<select size='1' name='rubrics'>";
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