<?php
/*
 * Header template file
 */
?>

<!DOCTYPE html>

<html <?php language_attributes() ?> class="no-js">

<head>

	<meta charset="<?php bloginfo('charset') ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if(is_singular() && pings_open(get_queried_object())): ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url') ?>">

	<?php endif ?>

	<?php wp_head() ?>

</head>

<?php
$logo = '

';
?>

<body <?php body_class() ?>>

	<div id="page" class="site">

	<header class="" id="header" role="banner">
				
		<section id="navigation" class="topNav">

			<!-- DESKTOP MENU -->
			<div class='container-fluid g-0'>
				<div class='row g-0'>
					<div class='col'>
						<div class="menuDesktop d-flex align-items-center justify-content-between">

							<section id="logo" class="">

								<!-- logo -->
								<a href="/">
									<?php echo $logo; ?>
								</a>

							</section>

							<div class="mobileMenu" id="nav-icon">
								<span></span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</div>
							<div class="desktopNav">
								<?php if(has_nav_menu('primary')): ?>
								
									<nav role="navigation">  
										<div>
											<?php
												wp_nav_menu( array('theme_location' => 'primary',
												'menu_class' => 'primary-menu',
												));
											?>
										</div>
									</nav>
								
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- MOBILE MENU -->
			<div class="menuContainer">
				<div class="menu">
					<div class="content">
						<?php
							wp_nav_menu( array('theme_location' => 'primary',
								'menu_class' => 'primary-menu',
							));
						?>
					</div>
				</div>
			</div>

			
			
		</section>
			
	</header>