<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/images/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&family=Big+Shoulders+Display:wght@500;700;900&display=swap" rel="stylesheet">
		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clearfix" role="banner">
				<div class="container">
					<div class="top-header clearfix">
						<!-- logo -->
						<a class="logo" href="<?php echo home_url(); ?>">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/images/JP_logo_white.png" alt="JPES">
						</a>
						<!-- /logo -->
						<div class="top-nav">
							<div class="navbar-social">
							
								<a class="fa fa-twitter" href="#"></a>
                                <a class="fa fa-facebook" href="#"></a>
                                <a class="fa fa-linkedin" href="#"></a>
								
							</div>
							<div class="contact-us">
								<a href="<?php echo get_page_link(29); ?>">Kontakt</a>
							</div>
						</div>
					</div>
					<div class="navbar-move">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-header" aria-expanded="false" aria-controls="navbar-header">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="javascript:void(0);">MENU</a>
						</div>

						<!-- nav -->
						<nav class="navigation" role="navigation">
							<?php edexNavigation(); ?>
						</nav>
						<!-- /nav -->
					</div>
				</div>
			</header>
			<!-- /header -->
