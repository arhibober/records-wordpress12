<?php
/**
 * Template Name: Удалить рекорд
 */
	get_header ();
?>
<script language="javascript">
	function overify (f)
	{
		if (confirm ("Вы уверены, что хотите удалить рекорд \"" + f.records.options[f.records.selectedIndex].text + "\"?"))
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
				echo "<h1>Здесь вы можете удалить лишний рекорд</h1>
					<form action='/remove_record_from_DB' method='POST' onSubmit='return overify (this);'>
						<table>
							<tr>
								<td>
									Выберите подлежащий удалению рекорд
								</td>
								<td>";
									$sqlstr = "SELECT ID, post_title FROM wp_posts WHERE ID IN(SELECT object_id FROM wp_term_relationships WHERE term_taxonomy_id=585)";
									$posts = $wpdb->get_results ($sqlstr, ARRAY_A);
									echo "<select size='1' name='records'>";
									foreach ($posts as $post)
										echo "<option value='".$post ["ID"]."'>".$post ["post_title"]."</option>";
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