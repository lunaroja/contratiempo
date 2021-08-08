<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/owl.theme.default.min.css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen, projection" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php wp_head(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/general.js"></script>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<div class="menu-wrapper">
  <div class="hamburger-menu"></div>
</div>
<div id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"></a>
</div>
<div id="mobile">
<nav id="menu" role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</nav>
<div id="search">
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="Buscar" />
		<button type="submit" class="submit" name="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
</form>
</div>
<div id="redes">
<a href="mailto:info@contratiempo.net"><i class="fas fa-envelope"></i></a><a href="https://twitter.com/revcontratiempo" target="_blank"><i class="fab fa-twitter"></i></a><a href="https://www.facebook.com/contratiempo" target="_blank"><i class="fab fa-facebook-f"></i></a><a href="https://www.instagram.com/contratiempochicago" target="_blank"><i class="fab fa-instagram"></i></a><a href="https://www.paypal.com/paypalme/contratiempochicago" target="_blank" class="donarbutton">DONAR</a>
</div>
</div>
</header>
<div id="container">
