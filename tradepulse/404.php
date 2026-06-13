<?php
/**
 * Not found template.
 *
 * @package TradePulse
 */

get_header();
?>

<main id="primary" class="archive-shell error-page">
	<div class="error-page__content">
		<span class="error-page__code"><?php esc_html_e( 'Error 404', 'tradepulse' ); ?></span>
		<h1 class="page-title"><?php esc_html_e( 'This page moved off the chart.', 'tradepulse' ); ?></h1>
		<p><?php esc_html_e( 'The link may be outdated. Search the journal to find the analysis you need.', 'tradepulse' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</main>

<?php get_footer();
