<?php
/**
 * Top prop firms comparison page.
 *
 * @package TradePulse
 */

get_header();

$top_firms = array(
	array( 'name' => 'FTMO', 'logo' => 'ftmo.svg', 'markets' => 'Forex & CFDs', 'evaluation' => '1-Step / 2-Step', 'capital' => 'Up to $400K', 'split' => '80% - 90%', 'best' => 'Established all-rounder', 'url' => 'https://ftmo.com/en/how-it-works/' ),
	array( 'name' => 'The5ers', 'logo' => 'the5ers.svg', 'markets' => 'Forex & CFDs', 'evaluation' => 'Multiple models', 'capital' => 'Scaling programs', 'split' => 'Up to 100%', 'best' => 'Long-term scaling', 'url' => 'https://the5ers.com/high-stakes/' ),
	array( 'name' => 'FundedNext', 'logo' => 'fundednext.svg', 'markets' => 'CFDs & Futures', 'evaluation' => 'Stellar models', 'capital' => 'Up to $300K', 'split' => 'Up to 95%', 'best' => 'Program variety', 'url' => 'https://fundednext.com/package-comparison' ),
	array( 'name' => 'Topstep', 'logo' => 'topstep.svg', 'markets' => 'Futures', 'evaluation' => 'Trading Combine', 'capital' => '$50K - $150K', 'split' => '90%', 'best' => 'Futures specialists', 'url' => 'https://www.topstep.com/our-program' ),
	array( 'name' => 'E8 Markets', 'logo' => 'e8-markets.svg', 'markets' => 'Forex, Futures & Crypto', 'evaluation' => 'Signature / One / Pro', 'capital' => 'Up to $1M', 'split' => 'Up to 100%', 'best' => 'Flexible SimFi models', 'url' => 'https://e8markets.com/' ),
	array( 'name' => 'FundingPips', 'logo' => 'fundingpips.svg', 'markets' => 'FX, Metals & Crypto', 'evaluation' => '1-Step / 2-Step', 'capital' => '$5K - $100K', 'split' => 'Up to 100%', 'best' => 'Flexible reward cycles', 'url' => 'https://fundingpips.com/' ),
	array( 'name' => 'Alpha Futures', 'logo' => 'alpha-futures.svg', 'markets' => 'Futures', 'evaluation' => 'One-Step', 'capital' => '$25K - $150K', 'split' => '90%', 'best' => 'Simple futures path', 'url' => 'https://alpha-futures.com/' ),
	array( 'name' => 'Funded Trading Plus', 'logo' => 'funded-trading-plus.svg', 'markets' => 'Forex & CFDs', 'evaluation' => '1-Step / 2-Step', 'capital' => 'Scale to $2.5M', 'split' => '90%', 'best' => 'High scaling ceiling', 'url' => 'https://www.fundedtradingplus.com/' ),
);
?>

<main id="primary" class="firm-page firm-page--dark top-firms-page">
	<section class="section firm-rankings">
		<div class="wrap">
			<header class="top-firms-heading">
				<div>
					<span><?php esc_html_e( 'TradePulse comparison desk', 'tradepulse' ); ?></span>
					<h1><?php esc_html_e( 'Top Prop Firms', 'tradepulse' ); ?></h1>
				</div>
				<p><i aria-hidden="true"></i><?php esc_html_e( 'Program overview updated June 13, 2026', 'tradepulse' ); ?></p>
			</header>

			<div class="prop-table-shell">
				<div class="prop-table-glow" aria-hidden="true"></div>
				<p class="prop-table-swipe" aria-hidden="true"><span>&larr;</span><?php esc_html_e( 'Swipe to compare', 'tradepulse' ); ?><span>&rarr;</span></p>
				<div class="prop-table-scroll" tabindex="0" aria-label="<?php esc_attr_e( 'Scrollable top prop firm comparison', 'tradepulse' ); ?>">
					<table class="prop-firm-table">
						<thead>
							<tr>
								<th scope="col"><?php esc_html_e( 'Rank', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Firm', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Markets', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Evaluation', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Account Range', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Profit Share', 'tradepulse' ); ?></th>
								<th scope="col"><?php esc_html_e( 'Best For', 'tradepulse' ); ?></th>
								<th scope="col"><span class="screen-reader-text"><?php esc_html_e( 'Firm website', 'tradepulse' ); ?></span></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $top_firms as $index => $firm ) : ?>
								<tr class="prop-firm-row prop-firm-row--<?php echo esc_attr( ( $index % 4 ) + 1 ); ?>">
									<td data-label="<?php esc_attr_e( 'Rank', 'tradepulse' ); ?>"><span class="prop-rank"><i aria-hidden="true">#</i><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span></td>
									<th scope="row" data-label="<?php esc_attr_e( 'Firm', 'tradepulse' ); ?>">
										<span class="prop-firm-name"><span><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/firms/' . $firm['logo'] ); ?>" alt=""></span><strong><?php echo esc_html( $firm['name'] ); ?></strong></span>
									</th>
									<td data-label="<?php esc_attr_e( 'Markets', 'tradepulse' ); ?>"><?php echo esc_html( $firm['markets'] ); ?></td>
									<td data-label="<?php esc_attr_e( 'Evaluation', 'tradepulse' ); ?>"><?php echo esc_html( $firm['evaluation'] ); ?></td>
									<td data-label="<?php esc_attr_e( 'Account Range', 'tradepulse' ); ?>"><?php echo esc_html( $firm['capital'] ); ?></td>
									<td data-label="<?php esc_attr_e( 'Profit Share', 'tradepulse' ); ?>"><strong class="prop-split"><?php echo esc_html( $firm['split'] ); ?></strong></td>
									<td data-label="<?php esc_attr_e( 'Best For', 'tradepulse' ); ?>"><span class="prop-best"><?php echo esc_html( $firm['best'] ); ?></span></td>
									<td><a class="prop-table-action" href="<?php echo esc_url( $firm['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View', 'tradepulse' ); ?><span aria-hidden="true">&rarr;</span></a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

			<p class="research-note"><?php esc_html_e( 'Program terms, account sizes, reward shares, eligibility, and platform availability can change. Confirm the current rules on each firm\'s official website before purchasing an evaluation.', 'tradepulse' ); ?></p>
		</div>
	</section>
</main>

<?php get_footer();
