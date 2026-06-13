<?php
/**
 * Theme header.
 *
 * @package TradePulse
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="site-header__top">
		<div class="site-header__top-inner">
			<span><?php esc_html_e( 'Market Brief', 'tradepulse' ); ?></span>
			<span><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?> <strong id="tradepulse-clock"><?php echo esc_html( date_i18n( 'H:i' ) ); ?></strong></span>
			<span><?php esc_html_e( 'Stocks', 'tradepulse' ); ?> <strong data-market-value>+0.42%</strong></span>
			<span><?php esc_html_e( 'Crypto', 'tradepulse' ); ?> <strong data-market-value>+1.18%</strong></span>
			<span><?php esc_html_e( 'Gold', 'tradepulse' ); ?> <strong data-market-value>+0.31%</strong></span>
		</div>
	</div>
	<div class="site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="brand__mark" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" role="img">
					<path d="M4 16.5 9 11l3.5 3.5L20 6.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M4 19h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</span>
			<span class="brand__text">
				<span class="brand__name"><?php bloginfo( 'name' ); ?></span>
				<span class="brand__tagline"><?php esc_html_e( 'Trading Journal', 'tradepulse' ); ?></span>
			</span>
		</a>

		<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'tradepulse' ); ?>">
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
				<span class="menu-toggle__icon" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Menu', 'tradepulse' ); ?></span>
			</button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'tradepulse_fallback_menu',
				'depth'          => 1,
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav>

		<form role="search" method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="tradepulse-header-search"><?php esc_html_e( 'Search for:', 'tradepulse' ); ?></label>
			<input id="tradepulse-header-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search analysis', 'tradepulse' ); ?>">
			<button type="submit"><?php esc_html_e( 'Search', 'tradepulse' ); ?></button>
		</form>
	</div>
</header>
