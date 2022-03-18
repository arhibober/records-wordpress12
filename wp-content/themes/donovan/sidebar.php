<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Donovan
 */

// Check if Sidebar has widgets.
if (is_active_sidebar ("sidebar-1"))
{
	echo "<section id='secondary' class='sidebar widget-area clearfix' role='complementary'>";
	if (!dynamic_sidebar ("RightSidebar2"))
	{
	}
	if ((strstr ($_SERVER ["REQUEST_URI"], "/blog")) || (strstr ($_SERVER ["REQUEST_URI"], "/forum")) || (is_page ()) || (in_category ("blog")))		
	{

if (strstr (get_the_title (), "Форум")
)
{
	if (!dynamic_sidebar ("RightSidebar4"))

	{

	}
}

		if (!dynamic_sidebar ("RightSidebar3"))
		{
		}		if (get_the_title () == "Контакты")
		{
			echo "<h4>Отправить письмо</h4>";
			echo do_shortcode ('[contact-form-7 id="742" title="Обратная связь"]');
		}
	}
	else
	{
		//if ((substr_count ($_SERVER ["REQUEST_URI"], "/") != 3) && (substr_count ($_SERVER ["REQUEST_URI"], "/") != 6))
		//echo do_shortcode ('[searchandfilter taxonomies="category,post_tag"  submit_label="Отфильтровать" headings="Фильтр по категориям и хэштегам"]');
		echo "<h4>Фильтр по категориям, хэштегам и датам</h4>";
		echo do_shortcode ('[searchandfilter taxonomies="category,post_tag,post_date,DATE_RECORD" types="checkbox,checkbox,daterange" submit_label="Применить фильтр"  hierarchical="1" hide_empty="1" order_by="name" operators="or"]');
		echo "<div class='edit_links'>";
		if ((isset ($_GET ["order"])) && ($_GET ["order"] == "abc")
)			//{
			//echo " sruri: ".$_SERVER ["REQUEST_URI"];
			echo "<a href='".substr ($_SERVER ["REQUEST_URI"], 0, strlen ($_SERVER ["REQUEST_URI"]) - 10)."'>Рассортировать посты по дате</a>";				
		//}
		else
		{
			//echo " sruri: ".$_SERVER ["REQUEST_URI"];
			echo "<a href='".$_SERVER ["REQUEST_URI"];
			if ((strlen ($_GET ["s"]) > 0) || (strlen ($_GET ["post_date"] > 0)))
				echo "&";
			else
				echo "?";
			echo "order=abc'>Рассортировать посты по алфавиту</a>";							
		}
		echo "</div>";
	}
	dynamic_sidebar ("sidebar-1");
	global $user_ID;
	if ($user_ID > 0)			
		echo "<div class='edit_links'>
			<a href='/dobavit-novyj-rekord/'>Добавить новый рекорд</a><br/>
			<a href='/dobavit-rubriku-rekorda/'>Добавить рубрику рекорда</a><br/>
			<a href='/udalit-rekord/'>Удалить рекорд</a><br/>
			<a href='/udalit-rubriku/'>Удалить рубрику</a><br/>
		</div>";
	echo "</section><!-- #secondary -->";
}