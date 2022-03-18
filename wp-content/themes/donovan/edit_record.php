<?php
/**
 * Template Name: Отредактировать рекорд
 */
	get_header ();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="post-content">
			<?php
				global $wpdb;
				global $user_ID;
				echo "<h1>Выберите рекорд для редактирования</h1>
				<select size='1' name='record-choose'>";
				$sqlstr = "SELECT ID, post_title, post_content, DATE_RECORD FROM wp_posts where ID in(select object_id from wp_term_relationships where term_taxonomy_id=57)";
				$posts = $wpdb->get_results ($sqlstr, ARRAY_A);
				foreach ($posts as $post)
					echo "<option value='".$post ["ID"]."'>".$post ["post_title"]."</option>";
				echo "</select>
				<div id='record-text'>
				<form action='/edit_record_inDB' method='POST'>
					<table>
						<tr>
							<td>
								Здесь Вы можете изменить идентификатор рекордсмена
							</td>
						<td>
							<input type='text' name='recordsman_name' value='".$posts [0]["post_title"]."'/>
						</td>
					</tr>
					<tr>
						<td>
							Здесь Вы можете изменить предметы и категории рекорда:
						</td>
						<td>";
						$sqlstr = "SELECT term_id, name FROM wp_terms where term_id != 2";
						$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
						foreach ($terms as $term)
						{
							$sqlstr = "SELECT object_id FROM wp_term_relationships where object_id=".$posts [0]["ID"]." and term_taxonomy_id=".$term ["term_id"];
							$trs = $wpdb->get_results ($sqlstr, ARRAY_A);
							echo "<input type='checkbox' name='cat-".$term ["term_id"]."'";
							if (count ($trs) > 0)
								echo " checked";
							echo "/>".$term ["name"]."<br/>";
						}
						echo "</td>
						</tr>
						<tr>
							<td>
								Здесь Вы можете изменить дату установления рекорда:
							</td>
							<td>
								<input type='date' class='form-control mydate' name='record_date' placeholder='Дата' value='".$_post [0]["DATE_RECORD"]."'>
							</td>
						</tr>
						<tr>
							<td>
								Здесь Вы можете изменить описание рекорда:
							</td>
							<td>
								<textarea width='60' height='10' name='record_text'>".
									$posts [0]["post_content"].
								"</textarea>
							</td>
						</tr>
					</table>
					<input type='submit' value='OK'/>
				</form>
			</div>";
		?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar ();
	get_footer ();