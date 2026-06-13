<?php
/**
 * Prop firm reviews page.
 *
 * @package TradePulse
 */

get_header();

$firm_reviews = array(
	array(
		'name'       => 'FTMO',
		'initials'   => 'FT',
		'logo'       => 'ftmo.svg',
		'best_for'   => __( 'Established CFD evaluation', 'tradepulse' ),
		'score'      => '4.8',
		'verdict'    => __( 'Excellent', 'tradepulse' ),
		'summary'    => __( 'A trusted, structured choice for forex and CFD traders.', 'tradepulse' ),
		'facts'      => array( __( '1-Step or 2-Step', 'tradepulse' ), __( '80% to 90% rewards', 'tradepulse' ), __( 'Up to $400K allocation', 'tradepulse' ) ),
		'strength'   => __( 'Clear rules and an established payout record.', 'tradepulse' ),
		'caution'    => __( 'News rules differ between Standard and Swing accounts.', 'tradepulse' ),
		'official'   => 'https://ftmo.com/en/how-it-works/',
		'reviews'    => 'https://www.trustpilot.com/review/ftmo.com',
	),
	array(
		'name'       => 'The5ers',
		'initials'   => '5R',
		'logo'       => 'the5ers.svg',
		'best_for'   => __( 'Scaling-focused forex traders', 'tradepulse' ),
		'score'      => '4.7',
		'verdict'    => __( 'Excellent', 'tradepulse' ),
		'summary'    => __( 'A strong forex option built around flexible programs and scaling.', 'tradepulse' ),
		'facts'      => array( __( 'Two-step High Stakes', 'tradepulse' ), __( '80% to 100% split', 'tradepulse' ), __( 'Unlimited trading time', 'tradepulse' ) ),
		'strength'   => __( 'Excellent scaling and flexible evaluation time.', 'tradepulse' ),
		'caution'    => __( 'Targets and loss rules vary by program.', 'tradepulse' ),
		'official'   => 'https://the5ers.com/high-stakes/',
		'reviews'    => 'https://www.trustpilot.com/review/the5ers.com',
	),
	array(
		'name'       => 'FundedNext',
		'initials'   => 'FN',
		'logo'       => 'fundednext.svg',
		'best_for'   => __( 'Flexible challenge selection', 'tradepulse' ),
		'score'      => '4.5',
		'verdict'    => __( 'Very Good', 'tradepulse' ),
		'summary'    => __( 'A flexible platform with multiple CFD and futures challenge models.', 'tradepulse' ),
		'facts'      => array( __( 'Multiple Stellar models', 'tradepulse' ), __( 'Rewards up to 95%', 'tradepulse' ), __( 'Up to $300K simulated', 'tradepulse' ) ),
		'strength'   => __( 'Broad challenge selection and competitive rewards.', 'tradepulse' ),
		'caution'    => __( 'Add-ons make some plans harder to compare.', 'tradepulse' ),
		'official'   => 'https://fundednext.com/package-comparison',
		'reviews'    => 'https://www.trustpilot.com/review/fundednext.com',
	),
	array(
		'name'       => 'Topstep',
		'initials'   => 'TS',
		'logo'       => 'topstep.svg',
		'best_for'   => __( 'Dedicated futures traders', 'tradepulse' ),
		'score'      => '4.1',
		'verdict'    => __( 'Very Good', 'tradepulse' ),
		'summary'    => __( 'A focused futures program with a clear path toward live funding.', 'tradepulse' ),
		'facts'      => array( __( 'Futures-only program', 'tradepulse' ), __( '90% trader share', 'tradepulse' ), __( '50K from $49 monthly', 'tradepulse' ) ),
		'strength'   => __( 'Purpose-built futures platform and education.', 'tradepulse' ),
		'caution'    => __( 'Review monthly fees and payout conditions.', 'tradepulse' ),
		'official'   => 'https://www.topstep.com/our-program',
		'reviews'    => 'https://www.trustpilot.com/review/topstep.com',
	),
);
?>

<main id="primary" class="firm-page firm-page--dark">
	<section id="latest-reviews" class="section firm-feed">
		<div class="wrap">
			<div class="section-heading firm-dashboard-heading">
				<div>
					<span class="firm-dashboard-heading__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3 15 9l6 .9-4.5 4.4 1.1 6.2L12 17.6l-5.6 2.9 1.1-6.2L3 9.9 9 9z"/></svg></span>
					<span class="eyebrow"><?php esc_html_e( 'Verified review library', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Latest Firm Reviews', 'tradepulse' ); ?></h2>
				</div>
				<p><span class="live-dot"></span><?php esc_html_e( 'Firm data checked June 13, 2026', 'tradepulse' ); ?></p>
			</div>

			<div class="prop-review-grid">
				<?php foreach ( $firm_reviews as $index => $firm ) : ?>
					<article class="prop-review-card prop-review-card--<?php echo esc_attr( $index + 1 ); ?>">
						<header class="prop-review-card__identity">
							<span class="prop-review-card__logo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/firms/' . $firm['logo'] ); ?>" alt="<?php echo esc_attr( $firm['name'] ); ?>"></span>
							<div class="prop-review-card__name"><span><?php echo esc_html( $firm['best_for'] ); ?></span><h3><?php echo esc_html( $firm['name'] ); ?></h3></div>
							<div class="prop-review-card__score"><strong><?php echo esc_html( $firm['score'] ); ?></strong><span><span class="rating-stars" aria-hidden="true">★★★★★</span> <?php echo esc_html( $firm['verdict'] ); ?></span></div>
						</header>
						<div class="prop-review-card__main">
							<p class="prop-review-card__summary"><?php echo esc_html( $firm['summary'] ); ?></p>
							<ul class="prop-review-card__facts">
								<?php foreach ( $firm['facts'] as $fact ) : ?><li><?php echo esc_html( $fact ); ?></li><?php endforeach; ?>
							</ul>
						</div>
						<aside class="prop-review-card__verdict">
							<div class="prop-review-card__notes">
								<p><strong><?php esc_html_e( 'Best feature', 'tradepulse' ); ?></strong><?php echo esc_html( $firm['strength'] ); ?></p>
								<p><strong><?php esc_html_e( 'Watch closely', 'tradepulse' ); ?></strong><?php echo esc_html( $firm['caution'] ); ?></p>
							</div>
							<footer class="prop-review-card__footer">
								<a href="<?php echo esc_url( $firm['official'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Official Terms', 'tradepulse' ); ?> &rarr;</a>
								<a href="<?php echo esc_url( $firm['reviews'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Customer Reviews', 'tradepulse' ); ?></a>
							</footer>
						</aside>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="research-note"><?php esc_html_e( 'Scores are TradePulse editorial assessments, not financial guarantees. Prices, rules, eligibility, and payout terms can change; verify every condition with the firm before purchasing.', 'tradepulse' ); ?></p>
		</div>
	</section>
</main>

<?php get_footer();
