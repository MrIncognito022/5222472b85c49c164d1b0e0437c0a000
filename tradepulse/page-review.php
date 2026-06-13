<?php
/**
 * Compact prop firm offers page.
 *
 * @package TradePulse
 */

get_header();

$firm_offers = array(
	array( 'name' => 'FTMO', 'logo' => 'ftmo.svg', 'score' => '4.8', 'discount' => '10%', 'code' => 'MATCH', 'url' => 'https://ftmo.com/en/how-it-works/' ),
	array( 'name' => 'The5ers', 'logo' => 'the5ers.svg', 'score' => '4.7', 'discount' => '15%', 'code' => 'MATCH', 'url' => 'https://the5ers.com/high-stakes/' ),
	array( 'name' => 'FundedNext', 'logo' => 'fundednext.svg', 'score' => '4.5', 'discount' => '20%', 'code' => 'MATCH', 'url' => 'https://fundednext.com/package-comparison' ),
	array( 'name' => 'Topstep', 'logo' => 'topstep.svg', 'score' => '4.1', 'discount' => '25%', 'code' => 'MATCH', 'url' => 'https://www.topstep.com/our-program' ),
);
?>

<main id="primary" class="firm-page firm-page--dark offer-page">
	<section class="section firm-feed">
		<div class="wrap">
			<div class="offer-showcase">
				<header class="offer-showcase__header">
					<h1><?php esc_html_e( 'Exclusive Prop Firm Offers', 'tradepulse' ); ?> <span aria-hidden="true">&#9830;</span></h1>
					<div class="offer-showcase__dots" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
				</header>

				<div class="offer-grid">
					<?php foreach ( $firm_offers as $index => $firm ) : ?>
						<a class="offer-card offer-card--<?php echo esc_attr( $index + 1 ); ?>" href="<?php echo esc_url( $firm['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<span class="offer-card__logo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/firms/' . $firm['logo'] ); ?>" alt="<?php echo esc_attr( $firm['name'] ); ?>"></span>
							<span class="offer-card__firm">
								<strong><?php echo esc_html( $firm['name'] ); ?></strong>
								<span class="offer-card__rating"><b><?php echo esc_html( $firm['score'] ); ?></b><i aria-label="Five star rating">&#9733;&#9733;&#9733;&#9733;&#9733;</i></span>
							</span>
							<span class="offer-card__deal">
								<span><b><?php echo esc_html( $firm['discount'] ); ?></b> <?php esc_html_e( 'OFF', 'tradepulse' ); ?> <i aria-hidden="true">&#127873;</i></span>
								<strong><?php echo esc_html( $firm['code'] ); ?> <i aria-hidden="true">&#9638;</i></strong>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>

			<p class="offer-disclaimer"><?php esc_html_e( 'Example offer labels for layout preview. Confirm current discount terms with each firm before publishing affiliate promotions.', 'tradepulse' ); ?></p>
		</div>
	</section>
</main>

<?php get_footer();
