<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yala_Mag
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <?php 
  if ( function_exists( 'wp_body_open' ) )
    wp_body_open();
  ?>
 <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'yala-mag' ); ?></a>
<!-- preloader -->
<?php if(get_theme_mod('yala_mag_preloader_enable')):?>
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span><span></span>
			</div>
		</div>
	</div>
	<!--  End Preloader -->
<?php endif;?>
<!-- End preloader -->
<!-- Start Header -->
<header class="header">
	<!-- Start Topbar -->
	<?php if(get_theme_mod('yala_mag_top_header_enable')):?>
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-12">
						<?php if(get_theme_mod('yala_mag_top_header_date_enable')):?>
							<!-- Date Time -->
							<div class="date"><span><i class="fa fa-calendar"></i><?php esc_html_e( 'Today:', 'yala-mag' );?> </span><?php echo esc_html( date( get_option('date_format') ) ); ?></div>
							<!--/ End Date Time -->
						<?php endif;?>
					</div>
						<div class="col-lg-7 col-12">
							<div class="top-right">
								<?php if(get_theme_mod('yala_mag_top_header_top_menu_enable')):?>
									<!-- Top Nav -->
									<?php
									if ( has_nav_menu( 'top-menu' ) ){
										wp_nav_menu( array(
											'theme_location'    => 'top-menu',
											'depth'             => 1,
											'container' 		=> 'ul',
											'menu_class'        => 'top-nav',
											'fallback_cb'       => 'yala_mag_navwalker::fallback',
											'walker'            => new yala_mag_navwalker(),
										));
									}
									?>
									<!--/ End Top Nav -->
								<?php endif;?>

								<?php if(get_theme_mod('yala_mag_top_header_searchform_enable')):?>
									<!-- Search Form -->
									<div class="search-form">
										<form class="form" action="<?php echo esc_url(home_url('/'));?>" method="POST">
											<input type="text" class="form-control" placeholder="<?php esc_attr_e('Search','yala-mag');?> ..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
											<button type="submit"><i class="fa fa-search"></i></button>
										</form>
									</div>
									<!--/ End Search Form -->
								<?php endif;?>
							</div>
						</div>
				</div>
			</div>
		</div>
	<?php endif;?>
	<!--/ End Topbar -->
	<!-- Header Inner -->
	<div class="header-inner">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="logo">
						<?php 
						
							the_custom_logo();
						   
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
							$new_blog_description = get_bloginfo( 'description', 'display' );
							if ( $new_blog_description || is_customize_preview() ) :
							?>
							<p class="site-description pb-5"><?php echo $new_blog_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;?>
					</div>
					
					<div class="mobile-nav"></div>
				</div>
				
				<div class="col-12">
					<div class="menu-bar-main">
						<!-- Main Menu -->
						<div class="main-menu">
							<nav class="navbar navbar-expand-lg">
								<?php
								if ( has_nav_menu( 'primary' ) ) :
									wp_nav_menu( array(
										'theme_location'    => 'primary',
										'depth'             => 5,
										'container_class'   => 'navbar-collapse',
										'menu_class'        => 'nav menu navbar-nav',
										'fallback_cb'       => 'yala_mag_navwalker::fallback',
										'walker'            => new yala_mag_navwalker(),
									));
									?>
									<?php else : ?>
										<div class="navbar-collapse">
											<ul class="nav menu navbar-nav">
												<li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>"><?php esc_html_e('Add a menu','yala-mag'); ?></a></li>
											</ul>
										</div>
								<?php endif; ?>
							</nav>
						</div>
						<!--/ End Main Menu -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Header Inner -->
</header>
<!--/ End Header -->

<?php if( ! is_home() && (!is_front_page())):?>
<!-- Breadcrumbs -->
<?php 
$header_bg_img = get_header_image();
if(!empty($header_bg_img)):?>
	<section class="breadcrumbs" data-stellar-background-ratio="0.5" style="background: url(<?php echo esc_url(get_header_image());?>)">
<?php else:?>
	<section class="breadcrumbs" data-stellar-background-ratio="0.5">
	<?php endif;?>	
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
				if ( is_archive() ) {
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
				} else if ( is_search() ) {
					echo '<h1 class="entry-title">';
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Result For: %s', 'yala-mag' ), '<span>' . get_search_query() . '</span>' );
					echo '</h1>';
				}

				else {
					echo '<h1 class="entry-title">';
					echo esc_html( get_the_title() );
					echo '</h1>';
				}?>
				<?php breadcrumb_trail(); ?>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->
<?php endif;?>


<div id="content" class="site-content">