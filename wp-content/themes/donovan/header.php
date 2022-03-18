<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Donovan
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php wp_head(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body <?php body_class(); ?>>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'donovan' ); ?></a>

		<?php do_action( 'donovan_header_bar' ); ?>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div class="header-main container clearfix">

				<div id="logo" class="site-branding clearfix">
					<div class="logo-text">

						<?php donovan_site_title(); ?>
						<?php donovan_site_description(); ?>
					</div>
					<?php donovan_site_logo(); ?>

				</div><!-- .site-branding -->

				<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>

			</div><!-- .header-main -->

			<?php get_template_part( 'template-parts/header/navigation', 'main' );
				if (!dynamic_sidebar ("TopSidebar1"))
				{
				}

			//donovan_header_image();
			//echo " sruri: ".$_SERVER ["REQUEST_URI"];
			if ((is_front_page ()) && (!strstr ($_SERVER ["REQUEST_URI"], "page")))
				echo "<div id='main_video'>
					<video autoplay muted loop id='myVideo'>
						<source src='/wp-content/uploads/2018/11/КРХ заставка чистая + без СЧЕТА (8 Мбпс).mp4' type='video/mp4'/>
						Your browser does not support the video tag.
					</video><br/>
					<button onclick='myFunction ()' id='myBtn'>Остановить</button>
					<button onclick='enableMute ()' type='button' id='myBtn1'>Включить звук</button>
				</div>";
			?>

			<?php donovan_breadcrumbs(); ?>
			<script>
				//alert (0);
				var video = document.getElementById ("myVideo");
				var btn = document.getElementById ("myBtn");
				var btn1 = document.getElementById ("myBtn1");
				function myFunction ()
				{
					if (video.paused)
					{
						video.play ();
						btn.innerHTML = "Остановить";
					}
					else
					{
						video.pause ();
						btn.innerHTML = "Запустить";
					}
				}
				
				function enableMute ()
				{ 
					//alert (1);
					if (!video.muted)
					{
						//alert (2);
						video.muted = true;
						btn1.innerHTML = "Включить звук";
					}
					else
					{
						//alert (3);
						video.muted = false;
						btn1.innerHTML = "Отключить звук";
					}
				}
			</script>
		</header><!-- #masthead -->
		<div id="content" class="site-content container">