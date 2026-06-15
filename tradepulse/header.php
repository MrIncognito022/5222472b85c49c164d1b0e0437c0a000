<?php
/**
 * Theme header.
 *
 * @package TradePulse
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<link rel="icon" type="image/png" href="/favicon.png">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $tradepulse_header_markets = tradepulse_market_data(); ?>
<header class="site-header">
	<div class="site-header__top">
		<div class="site-header__top-inner">
			<span><?php esc_html_e( 'Market Brief', 'tradepulse' ); ?></span>
			<span><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?> <strong id="tradepulse-clock"><?php echo esc_html( date_i18n( 'H:i' ) ); ?></strong></span>
			<span><?php esc_html_e( 'Stocks', 'tradepulse' ); ?> <strong data-market-change="stocks" class="<?php echo esc_attr( tradepulse_market_change_class( $tradepulse_header_markets['markets']['stocks']['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $tradepulse_header_markets['markets']['stocks']['change'] ) ); ?></strong></span>
			<span><?php esc_html_e( 'Crypto', 'tradepulse' ); ?> <strong data-market-change="crypto" class="<?php echo esc_attr( tradepulse_market_change_class( $tradepulse_header_markets['markets']['crypto']['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $tradepulse_header_markets['markets']['crypto']['change'] ) ); ?></strong></span>
			<span><?php esc_html_e( 'Gold ETF', 'tradepulse' ); ?> <strong data-market-change="gold" class="<?php echo esc_attr( tradepulse_market_change_class( $tradepulse_header_markets['markets']['gold']['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $tradepulse_header_markets['markets']['gold']['change'] ) ); ?></strong></span>
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
			<ul id="primary-menu" class="primary-menu">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tradepulse' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/review/' ) ); ?>"><?php esc_html_e( 'Review', 'tradepulse' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/top-prop-firms/' ) ); ?>"><?php esc_html_e( 'Top Prop Firms', 'tradepulse' ); ?></a></li>
				<li class="menu-item-has-children">
					<a href="<?php echo esc_url( home_url( '/trading/' ) ); ?>"><?php esc_html_e( 'Trading', 'tradepulse' ); ?></a>
					<ul class="sub-menu">
						<li><a href="<?php echo esc_url( home_url( '/forex/' ) ); ?>"><?php esc_html_e( 'Forex', 'tradepulse' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/future/' ) ); ?>"><?php esc_html_e( 'Future', 'tradepulse' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/stocks/' ) ); ?>"><?php esc_html_e( 'Stocks', 'tradepulse' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/crypto/' ) ); ?>"><?php esc_html_e( 'Crypto', 'tradepulse' ); ?></a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<form role="search" method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="tradepulse-header-search"><?php esc_html_e( 'Search for:', 'tradepulse' ); ?></label>
			<input id="tradepulse-header-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search analysis', 'tradepulse' ); ?>">
			<button type="submit"><?php esc_html_e( 'Search', 'tradepulse' ); ?></button>
		</form>
	</div>
</header>
