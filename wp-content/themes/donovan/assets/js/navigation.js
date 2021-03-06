/**
 * Navigation Plugin
 * Includes responsiveMenu() function
 *
 * Copyright 2016 ThemeZee
 * Free to use under the GPLv2 and later license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Thomas Weichselbaumer (themezee.com)
 *
 * @package Donovan
 */

(function($) {

	/**--------------------------------------------------------------
	# Responsive Navigation for WordPress menus
	--------------------------------------------------------------*/
	$.fn.responsiveMenu = function( options ) {

		if ( options === undefined ) {
			options = {};
		}

		/* Set Defaults */
		var defaults = {
			menuClass: 'menu',
			toggleClass: 'menu-toggle',
			toggleText: '',
			minWidth: '60em'
		};

		/* Set Variables */
		var vars = $.extend( {}, defaults, options ),
			menuClass = vars.menuClass,
			toggleID = ( vars.toggleID ) ? vars.toggleID : vars.toggleClass,
			toggleClass = vars.toggleClass,
			toggleText = vars.toggleText,
			minWidth = vars.minWidth,
			$this = $( this ),
			$menu = $( '.' + menuClass );

		/*********************
		* Desktop Navigation *
		**********************/

		/* Set and reset dropdown animations based on screen size */
		if ( typeof matchMedia == 'function' ) {
			var mq = window.matchMedia( '(min-width: ' + minWidth + ')' );
			mq.addListener( widthChange );
			widthChange( mq );
		}
		function widthChange( mq ) {

			if ( mq.matches ) {

				/* Hide all sub menus on desktop navigation */
				$menu.find( 'li.menu-item-has-children ul.sub-menu' ).each( function() {
					$( this ).css( { display: 'none' } );
					$( this ).parent().find( 'a > .sub-menu-icon' ).removeClass( 'active' );
				} );

				/* Remove click event for dropdown animation of submenu icons*/
				$menu.find( 'li.menu-item-has-children > a > .sub-menu-icon' ).off( "click", "**" );

				/* Add dropdown animation for desktop navigation menu */
				$menu.find( 'li.menu-item-has-children' ).hover( function() {
					$( this ).children( 'ul.sub-menu' ).css( { visibility: 'visible', display: 'none' } ).slideDown( 300 );
				}, function() {
					$( this ).children( 'ul.sub-menu' ).css( { visibility: 'hidden' } );
				} );

				/* Make sure menu does not fly off the right of the screen */
				$menu.find( 'li ul.sub-menu li.menu-item-has-children' ).mouseenter( function() {
					if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 > $( window ).width() ) {
						$( this ).children( 'ul.sub-menu' ).css( { right: '100%', left: 'auto' } );
					}
				} );

				/* Add menu items with submenus to aria-haspopup="true" */
				$menu.find( 'li.menu-item-has-children' ).attr( 'aria-haspopup', 'true' ).attr( 'aria-expanded', 'false' );

				/* Properly update the ARIA states on focus (keyboard) and mouse over events */
				$menu.find( 'li.menu-item-has-children > a' ).on( 'focus.aria mouseenter.aria', function() {
					$( this ).parents( '.menu-item' ).attr( 'aria-expanded', true ).find( 'ul:first' ).css( { visibility: 'visible', display: 'block' } );
				} );

				/* Properly update the ARIA states on blur (keyboard) and mouse out events */
				$menu.find( 'li.menu-item-has-children > a' ).on( 'blur.aria  mouseleave.aria', function() {
					if( ! $(this).parent().next( 'li' ).length > 0 && ! $(this).next('ul').length > 0 ) {
						$( this ).closest( 'li.menu-item-has-children' ).attr( 'aria-expanded', false ).find( '.sub-menu' ).css( { display: 'none' } );
					}
				} );

			} else {

				/* Reset desktop navigation menu dropdown animation on smaller screens */
				$menu.find( 'li.menu-item-has-children ul.sub-menu' ).each( function() {
					$( this ).css( { display: 'block', visibility: 'visible' } );
				} );

				/* Remove Events */
				$menu.find( 'li.menu-item-has-children' ).off();
				$menu.find( 'li ul.sub-menu li.menu-item-has-children' ).off();

				/* Remove ARIA states on mobile devices */
				$menu.find( 'li.menu-item-has-children > a' ).off();

				/* Close all sub menus on mobile navigation */
				$menu.find( 'li.menu-item-has-children ul.sub-menu' ).each( function() {
					$( this ).hide();
					$( this ).parent().find( 'a > .sub-menu-icon' ).removeClass( 'active' );
				} );

				/* Add dropdown animation for submenus on mobile navigation */
				$menu.find( 'li.menu-item-has-children > a > .sub-menu-icon' ).on( 'click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					e.stopImmediatePropagation();
					$( this ).parent().next( 'ul.sub-menu' ).slideToggle();
					$( this ).toggleClass( 'active' );
				});

			}
		}

		/********************
		* Mobile Navigation *
		*********************/

		/* Add Menu Toggle Button for mobile navigation */
		$this.prepend( '<button id=\"' + toggleID + '\" class=\"' + toggleClass + '\">' + toggleText + '</button>' );

		/* Add dropdown slide animation for mobile devices */
		$( '#' + toggleID ).on( 'click', function() {
			$menu.slideToggle();
			$( this ).toggleClass( 'active' );
		});

	};

	/**--------------------------------------------------------------
	# Setup Navigation Menus
	--------------------------------------------------------------*/
	$( document ).ready( function() {

		/* Setup Main Navigation */
		$( '#main-navigation' ).responsiveMenu( {
			menuClass: 'main-navigation-menu',
			toggleClass: 'main-navigation-toggle',
			toggleText: donovan_menu_title,
			minWidth: '55em'
		} );

		/* Setup Top Navigation */
		$( '#top-navigation' ).responsiveMenu( {
			menuClass: 'top-navigation-menu',
			toggleClass: 'top-navigation-toggle',
			toggleText: donovan_menu_title,
			minWidth: '55em'
		} );
		
		//$temp = 
		//$(".searchandfilter label").next('ul.children').prev().parent().prepend('<span class="toggle"> +</span>');		
		$(".searchandfilter label").next('ul.children').prev().after('<span class="toggle"> +</span>');	
		/*$(".searchandfilter label").next('ul.children').css({'height':'0', 'transition':'none'});		*/	
		$(".searchandfilter label").next('.toggle').next('ul.children').toggle(100);
		
		/*$(".searchandfilter label").change(function() {
			var $input = $(this);
			//alert('!!!');
			$input.next(".children").toggle(1000);
			//$input.children(".toggle").toggleText(' +', ' -');
			//$input.children(".toggle").html() == " +" ? $input.children(".toggle").html(' -') : $input.children(".toggle").html(' +');
			//$("#output").html(".attr('checked'): " + $input.attr('checked') + "<br/>" + ".prop('checked'): " + $input.prop('checked') + "<br/>" + ".is(':checked'): " + //$input.is(':checked')) + "";
	  
		}).change();*/
		
		$(".searchandfilter label+.toggle").click(function(){
			$(this).html() == " +" ? $(this).html(' -') : $(this).html(' +');
			//$(this).parent('label').next('ul.children').toggle(1000);
			$(this).next('ul.children').toggle(100);
			//$(".searchandfilter label").next('ul.children').toggle(1000);
		});

	} );

}(jQuery));
