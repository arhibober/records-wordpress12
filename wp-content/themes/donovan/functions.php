<?php
/**
 * Donovan functions and definitions
 *
 * @package Donovan
 */

/**
 * Donovan only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


if ( ! function_exists( 'donovan_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function donovan_setup() {

		// Make theme available for translation. Translations can be filed at https://translate.wordpress.org/projects/wp-themes/donovan
		load_theme_textdomain( 'donovan', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size( 1360, 765, true );

		// Register Navigation Menus.
		register_nav_menus( array(
			'primary' => esc_html__( 'Main Navigation', 'donovan' ),
			'social'  => esc_html__( 'Social Icons', 'donovan' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'donovan_custom_background_args', array(
			'default-color' => 'cccccc',
		) ) );

		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', apply_filters( 'donovan_custom_logo_args', array(
			'height' => 60,
			'width' => 300,
			'flex-height' => true,
			'flex-width' => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'donovan_custom_header_args', array(
			'header-text' => false,
			'width'	      => 2560,
			'height'      => 500,
			'flex-width'  => true,
			'flex-height' => true,
		) ) );

		// Add extra theme styling to the visual editor.
		add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/assets/css/custom-fonts.css' ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'donovan_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function donovan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'donovan_content_width', 910 );
}
add_action( 'after_setup_theme', 'donovan_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function donovan_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'donovan' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html_x( 'Sidebar will appear on posts and pages, except with the full width template.', 'widget area description', 'donovan' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'donovan_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function donovan_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'donovan-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	wp_enqueue_script( 'donovan-jquery-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20171005', true);

	// Passing Parameters to navigation.js.
	wp_localize_script( 'donovan-jquery-navigation', 'donovan_menu_title', donovan_get_svg( 'menu' ) . esc_html__( 'Menu', 'donovan' ) );

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4', true);

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'donovan_scripts' );


/**
 * Enqueue custom fonts.
 */
function donovan_custom_fonts() {

	// Register and Enqueue Theme Fonts.
	wp_enqueue_style( 'donovan-custom-fonts', get_template_directory_uri() . '/assets/css/custom-fonts.css', array(), '20180413' );

}
add_action( 'wp_enqueue_scripts', 'donovan_custom_fonts', 1 );


/**
 * Add custom sizes for featured images
 */
function donovan_add_image_sizes() {

	add_image_size( 'donovan-list-post', 600, 450, true );

}
add_action( 'after_setup_theme', 'donovan_add_image_sizes' );


/**
 * Add pingback url on single posts
 */
function donovan_pingback_url() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'donovan_pingback_url' );


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';

function exclude_category ($query)
{
    if ($query->is_home)
        $query->set ("category__not_in", array (1));
    return $query;
}
add_filter ("pre_get_posts", "exclude_category");

function list_categories_without_this_cat ()
{
	$categories_stripped_of_one = get_the_category_list (array ("exclude" => array (416)));
	return $categories_stripped_of_one;
}

function exclude_cats ($terms)
{
    $exclude_cats = array (416); //put term ids here to remove!
    if (!empty ($terms) && is_array ($terms))
        foreach ($terms as $key => $term)
            if (in_array ($term->term_id, $exclude_cats))
                unset ($terms[$key]);
    return $terms;
}

register_nav_menus
(
	array
	(
		"foot" => "Нижнее меню"      //Название другого месторасположения меню в шаблоне
	)
);

if (function_exists ("register_sidebars"))
	register_sidebar
	(
		array
		(
			"name" => "TopSidebar",
			"id" => "TopSidebar",
			"before_widget" => "<li>",
			"after_widget" => "</li>",
			"before_title" => "<h2>",
			"after_title" => "</h2>"
		)
	);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "RightSidebar2",
				"id" => "RightSidebar2",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "RightSidebar3",
				"id" => "RightSidebar3",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "TopSidebar1",
				"id" => "TopSidebar1",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "LeftSidebar",
				"id" => "LeftSidebar",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "FooterSidebar1",
				"id" => "FooterSidebar1",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);

if (function_exists ("register_sidebars"))
		register_sidebar
		(
			array
			(
				"name" => "RightSidebar4",
				"id" => "RightSidebar4",
				"before_widget" => "<li>",
				"after_widget" => "</li>",
				"before_title" => "<h2>",
				"after_title" => "</h2>"
			)
		);
		
		/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2018.10.05
 * лицензия: MIT
*/
function dimox_breadcrumbs ()
{
	/* === ОПЦИИ === */
	$text ["home"] = "Главная"; // текст ссылки "Главная"
	$text ["category"] = "%s"; // текст для страницы рубрики
	$text ["search"] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
	$text ["tag"] = 'Записи с тегом "%s"'; // текст для страницы тега
	$text ["author"] = 'Статьи автора %s'; // текст для страницы автора
	$text ["404"] = "Ошибка 404"; // текст для страницы 404
	$text ["page"] = "Страница %s"; // текст 'Страница N'
	$text ["cpage"] = 'Страница комментариев %s'; // текст 'Страница комментариев N'
	$wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
	$wrap_after = "</div><!-- .breadcrumbs -->"; // закрывающий тег обертки
	$sep = '<span class="breadcrumbs__separator"> › </span>'; // разделитель между "крошками"
	$before = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
	$after = "</span>"; // тег после текущей "крошки"
	$show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	$show_last_sep = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
	/* === КОНЕЦ ОПЦИЙ === */
	global $post;
	$home_url = home_url ("/");
	$link = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
	$link .= '<meta itemprop="position" content="%3$s" />';
	$link .= "</span>";
	$parent_id = ($post) ? $post->post_parent : "";
	$home_link = sprintf ($link, $home_url, $text ["home"], 1);
	if ((is_home ()) || (is_front_page ()))
	{
		if ($show_on_home)
			echo $wrap_before.$home_link.$wrap_after;
	}
	else
	{
		$position = 0;
		echo $wrap_before;
		if ($show_home_link)
		{
			$position += 1;
			echo $home_link;
		}
    if (is_category ())
	{
		$parents = get_ancestors (get_query_var ("cat"), "category");
		foreach (array_reverse ($parents) as $cat)
		{
			$position += 1;
			if ($position > 1)
				echo $sep;
			echo sprintf ($link, get_category_link ($cat), get_cat_name ($cat), $position);
		}
		if (get_query_var ("paged"))
		{
			$position += 1;
			$cat = get_query_var ("cat");
			echo $sep.sprintf ($link, get_category_link ($cat), get_cat_name ($cat), $position );
			echo $sep.$before.sprintf ($text ["page"], get_query_var ("paged")).$after;
		}
		else
		{
			if ($show_current)
			{
				if ($position >= 1)
					echo $sep;
				echo $before.sprintf ($text ["category"], single_cat_title ("", false)).$after;
			}
			elseif ($show_last_sep) echo $sep;
      }
    }
		elseif ( is_search ())
		{
			if (($show_home_link) && ($show_current) || (!$show_current) && ($show_last_sep))
				echo $sep;
			if ($show_current)
				echo $before.sprintf ($text ["search"], get_search_query ()) . $after;
		}
		elseif (is_year ())
		{
			if ($show_home_link && $show_current)
				echo $sep;
			if ($show_current)
				echo $before.get_the_time ("Y").$after;
			elseif ($show_home_link && $show_last_sep)
				echo $sep;
		}
		elseif (is_month ())
		{
			if ($show_home_link)
				echo $sep;
			$position += 1;
			echo sprintf ($link, get_year_link (get_the_time ("Y")), get_the_time ("Y"), $position);
			if ($show_current)
				echo $sep.$before.get_the_time ("F").$after;
			elseif ($show_last_sep)
				echo $sep;
    }
	elseif (is_day ())
	{
		if ($show_home_link)
			echo $sep;
		$position += 1;
		echo sprintf ($link, get_year_link (get_the_time ("Y")), get_the_time ("Y"), $position).$sep;
		$position += 1;
		echo sprintf ($link, get_month_link (get_the_time ("Y"), get_the_time ("m")), get_the_time ("F"), $position);
		if ($show_current)
			echo $sep.$before.get_the_time ("d").$after;
		elseif ($show_last_sep)
			echo $sep;
    }
	elseif ((is_single ()) && (!is_attachment ()))
	{
		if (get_post_type () != "post")
		{
			$position += 1;
			$post_type = get_post_type_object (get_post_type ());
			if ($position > 1)
				echo $sep;
			echo sprintf ($link, get_post_type_archive_link ($post_type->name), $post_type->labels->name, $position);
			if ($show_current)
				echo $sep.$before.get_the_title ().$after;
			elseif ($show_last_sep)
				echo $sep;
		}
		else
		{
			$cat = get_the_category (); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors ($catID, "category");
			$parents = array_reverse ($parents);
			$parents [] = $catID;
			foreach ($parents as $cat)
			{
				$position += 1;
				if ($position > 1)
					echo $sep;
				echo sprintf ($link, get_category_link ($cat), get_cat_name ($cat), $position);
			}
			if (get_query_var ("cpage"))
			{
				$position += 1;
				echo $sep.sprintf ($link, get_permalink (), get_the_title (), $position).$sep.$before.sprintf ($text ["cpage"], get_query_var ("cpage")).$after;
			}
			else
			{
				if ($show_current)
					echo $sep.$before.get_the_title ().$after;
				elseif ($show_last_sep)
					echo $sep;
			}
		}
    }
	elseif (is_post_type_archive ())
	{
		$post_type = get_post_type_object (get_post_type ());
		if (get_query_var ("paged"))
		{
			$position += 1;
			if ($position > 1)
				echo $sep;
			echo sprintf ($link, get_post_type_archive_link ($post_type->name), $post_type->label, $position).$sep.$before.sprintf ($text ["page"], get_query_var ("paged")). $after;
		}
		else
		{
        if ($show_home_link && $show_current)
			echo $sep;
        if ($show_current)
			echo $before.$post_type->label.$after;
        elseif ($show_home_link && $show_last_sep)
			echo $sep;
      }
    }
	elseif (is_attachment ())
	{
		$parent = get_post ($parent_id);
		$cat = get_the_category ($parent->ID);
		$catID = $cat [0]->cat_ID;
		$parents = get_ancestors ($catID, "category");
		$parents = array_reverse( $parents );
		$parents[] = $catID;
		foreach ($parents as $cat)
		{
			$position += 1;
			if ($position > 1)
				echo $sep;
			echo sprintf ($link, get_category_link ($cat), get_cat_name ($cat), $position);
		}
		$position += 1;
		echo $sep.sprintf ($link, get_permalink ($parent), $parent->post_title, $position);
		if ($show_current)
			echo $sep.$before.get_the_title (). $after;
		elseif ($show_last_sep)
			echo $sep;
    }
	elseif (is_page () && !$parent_id)
	{
		if ($show_home_link && $show_current) echo $sep;
		if ($show_current)
			echo $before.get_the_title ().$after;
      elseif ($show_home_link && $show_last_sep)
		echo $sep;
    }
	elseif (is_page () && $parent_id)
	{
		$parents = get_post_ancestors (get_the_ID ());
		foreach (array_reverse ($parents) as $pageID)
		{
			$position += 1;
			if ($position > 1)
				echo $sep;
			echo sprintf ($link, get_page_link ($pageID), get_the_title ($pageID), $position);
		}
		if ($show_current)
			echo $sep.$before.get_the_title ().$after;
		elseif ($show_last_sep)
			echo $sep;
    }
	elseif (is_tag ())
	{
		if (get_query_var ("paged"))
		{
			$position += 1;
			$tagID = get_query_var ("tag_id");
			echo $sep.sprintf ($link, get_tag_link ($tagID), single_tag_title ("", false ), $position).$sep.$before.sprintf ($text ["page"], get_query_var ( "paged")).$after;
		}
		else
		{
			if ($show_home_link && $show_current)
				echo $sep;
			if ($show_current)
				echo $before.sprintf ($text ["tag"], single_tag_title ("", false)).$after;
			elseif ($show_home_link && $show_last_sep)
				echo $sep;
		}
    }
	elseif (is_author ())
	{
		$author = get_userdata (get_query_var ("author"));
		if (get_query_var ("paged"))
		{
			$position += 1;
			echo $sep.sprintf ($link, get_author_posts_url ($author->ID), sprintf ($text ["author"], $author->display_name), $position).$sep.$before.sprintf ($text ["page"], get_query_var ("paged")).$after;
		}
		else
		{
			if ($show_home_link && $show_current)
				echo $sep;
			if ($show_current)
				echo $before.sprintf ($text ["author"], $author->display_name).$after;
			elseif ($show_home_link && $show_last_sep)
				echo $sep;
		}
    }
	elseif (is_404 ())
	{
		if ($show_home_link && $show_current)
			echo $sep;
		if ($show_current)
			echo $before.$text ["404"].$after;
		elseif ($show_last_sep)
			echo $sep;
    }
	elseif ((has_post_format ()) && ! (is_singular ()))
	{
		if ($show_home_link && $show_current)
			echo $sep;
		echo get_post_format_string (get_post_format ());
    }
    echo $wrap_after;
  }
} // end of dimox_breadcrumbs()

add_filter
(
	"bbp_no_breadcrumb",
	function ($arg)
	{
		return true;
	}
);