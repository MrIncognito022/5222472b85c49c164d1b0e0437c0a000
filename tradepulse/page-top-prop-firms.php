<?php
/**
 * Top prop firms page.
 *
 * @package TradePulse
 */

get_header();

$top_firms = array(
	array(
		'name'     => 'FTMO',
		'label'    => __( 'Best established CFD choice', 'tradepulse' ),
		'markets'  => __( 'Forex, indices, commodities, crypto CFDs', 'tradepulse' ),
		'program'  => __( '1-Step or 2-Step', 'tradepulse' ),
		'split'    => __( '80% to 90%', 'tradepulse' ),
		'capital'  => __( 'Up to $400K before scaling', 'tradepulse' ),
		'why'      => __( 'The strongest all-round combination of operating history, transparent documentation, structured evaluation, and established reward processing.', 'tradepulse' ),
		'caution'  => __( 'Check Standard versus Swing restrictions before choosing an account.', 'tradepulse' ),
		'url'      => 'https://ftmo.com/en/how-it-works/',
	),
	array(
		'name'     => 'The5ers',
		'label'    => __( 'Best for long-term scaling', 'tradepulse' ),
		'markets'  => __( 'Forex and CFDs', 'tradepulse' ),
		'program'  => __( 'High Stakes and other models', 'tradepulse' ),
		'split'    => __( '80% scaling up to 100%', 'tradepulse' ),
		'capital'  => __( 'Program-dependent scaling', 'tradepulse' ),
		'why'      => __( 'A compelling option for patient forex traders who prioritize unlimited evaluation time and long-term account growth.', 'tradepulse' ),
		'caution'  => __( 'The product lineup has different targets and loss rules; compare the exact model.', 'tradepulse' ),
		'url'      => 'https://the5ers.com/high-stakes/',
	),
	array(
		'name'     => 'FundedNext',
		'label'    => __( 'Best variety of challenge models', 'tradepulse' ),
		'markets'  => __( 'CFDs and futures programs', 'tradepulse' ),
		'program'  => __( 'Stellar models and Futures', 'tradepulse' ),
		'split'    => __( 'Advertised up to 95%', 'tradepulse' ),
		'capital'  => __( 'Advertised up to $300K simulated', 'tradepulse' ),
		'why'      => __( 'Broad program choice and flexible structures make it easier to match an evaluation to a trader’s preferred style.', 'tradepulse' ),
		'caution'  => __( 'Complex model and add-on choices require more careful rule checking.', 'tradepulse' ),
		'url'      => 'https://fundednext.com/package-comparison',
	),
	array(
		'name'     => 'Topstep',
		'label'    => __( 'Best dedicated futures specialist', 'tradepulse' ),
		'markets'  => __( 'Futures only', 'tradepulse' ),
		'program'  => __( 'Trading Combine', 'tradepulse' ),
		'split'    => __( '90% trader share', 'tradepulse' ),
		'capital'  => __( '$50K, $100K, and $150K paths', 'tradepulse' ),
		'why'      => __( 'A focused futures ecosystem with a long operating history, education, and a progression toward a live funded account.', 'tradepulse' ),
		'caution'  => __( 'Monthly fees and payout qualification rules should be reviewed carefully.', 'tradepulse' ),
		'url'      => 'https://www.topstep.com/our-program',
	),
);
?>

<main id="primary" class="firm-page">
	<section class="ranking-intro">
		<div class="wrap ranking-intro__grid">
			<div><strong><?php esc_html_e( 'Rules', 'tradepulse' ); ?></strong><span><?php esc_html_e( 'Fair and understandable', 'tradepulse' ); ?></span></div>
			<div><strong><?php esc_html_e( 'Payouts', 'tradepulse' ); ?></strong><span><?php esc_html_e( 'Practical withdrawal terms', 'tradepulse' ); ?></span></div>
			<div><strong><?php esc_html_e( 'Platforms', 'tradepulse' ); ?></strong><span><?php esc_html_e( 'Tools traders can rely on', 'tradepulse' ); ?></span></div>
			<div><strong><?php esc_html_e( 'Value', 'tradepulse' ); ?></strong><span><?php esc_html_e( 'Competitive account pricing', 'tradepulse' ); ?></span></div>
		</div>
	</section>

	<section class="section firm-rankings">
		<div class="wrap">
			<div class="section-heading">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Editor selections', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Best Prop Firm Coverage', 'tradepulse' ); ?></h2>
				</div>
				<p><?php esc_html_e( 'Our newest prop-firm guides and comparisons, presented in a clean ranked format.', 'tradepulse' ); ?></p>
			</div>

			<div class="firm-ranking-list">
				<?php foreach ( $top_firms as $index => $firm ) : ?>
					<article class="firm-ranking-card firm-ranking-card--data firm-ranking-card--<?php echo esc_attr( $index + 1 ); ?>">
						<div class="firm-ranking-card__rank"><span><?php esc_html_e( 'Rank', 'tradepulse' ); ?></span><strong><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></strong></div>
						<div class="firm-ranking-card__identity"><span><?php echo esc_html( substr( $firm['name'], 0, 2 ) ); ?></span><div><small><?php echo esc_html( $firm['label'] ); ?></small><h3><?php echo esc_html( $firm['name'] ); ?></h3></div></div>
						<div class="firm-ranking-card__content">
							<p><?php echo esc_html( $firm['why'] ); ?></p>
							<div class="firm-data-points">
								<span><small><?php esc_html_e( 'Markets', 'tradepulse' ); ?></small><?php echo esc_html( $firm['markets'] ); ?></span>
								<span><small><?php esc_html_e( 'Program', 'tradepulse' ); ?></small><?php echo esc_html( $firm['program'] ); ?></span>
								<span><small><?php esc_html_e( 'Profit share', 'tradepulse' ); ?></small><?php echo esc_html( $firm['split'] ); ?></span>
								<span><small><?php esc_html_e( 'Account range', 'tradepulse' ); ?></small><?php echo esc_html( $firm['capital'] ); ?></span>
							</div>
							<p class="firm-ranking-card__caution"><strong><?php esc_html_e( 'Before buying:', 'tradepulse' ); ?></strong> <?php echo esc_html( $firm['caution'] ); ?></p>
						</div>
						<a class="firm-ranking-card__action" href="<?php echo esc_url( $firm['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Check Terms', 'tradepulse' ); ?><span aria-hidden="true">&rarr;</span></a>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="research-note"><?php esc_html_e( 'This is an editorial ranking based on transparency, track record, program structure, trader fit, and public feedback. It is not a guarantee of funding or payout. Always verify current rules and regional eligibility.', 'tradepulse' ); ?></p>
		</div>
	</section>
</main>

<?php get_footer();
