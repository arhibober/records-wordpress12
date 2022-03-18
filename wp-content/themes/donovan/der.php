<?php
	global $wpdb;
	global $user_ID;
	$sqlstr = "SELECT post_title, post_content, RECORD_DATE, REFERENCE FROM wp_posts where ID=".$_POST ["cur"];
	$posts = $wpdb->get_results ($sqlstr, ARRAY_A);
	echo "<form action='/records-wordpress2/add_record_toDB' method='POST'>
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
					$sqlstr = "SELECT term_id, name FROM wp_terms";
					$terms = $wpdb->get_results ($sqlstr, ARRAY_A);
					foreach ($terms as $term)
						if ($term ["term_id"] != 57)
						{
							$sqlstr = "SELECT object_id FROM wp_term relationships where object_id=".$_POST ["cur"]." and term_taxonomy_id=".$term ["term_id"];
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
								Введите дату установления рекорда:
							</td>
							<td>
								<input type='date' class='form-control' class='mydate' name='record_date' placeholder='Дата' value='".$_post [0]["record_date"]."'>
							</td>
						</tr>
						<tr>
							<td>
								Введите описание рекорда:
							</td>
							<td>
								<textarea width='60' height='10' name='record_text'>".
									$post [0]["post_content"].
								"</textarea>
							</td>
								</tr>
							</table>
							<input type='submit' value='OK'/>
						</form>";