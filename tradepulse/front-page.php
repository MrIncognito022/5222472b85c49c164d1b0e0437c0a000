<?php
/**
 * Front Page Template for Tradepulse — recreated from original HTML
 */

get_header();

// Determine hero background: use latest post featured image if available, else fallback
$hero_bg_url = '';
$latest = get_posts(array('posts_per_page' => 1, 'post_status' => 'publish'));
if ( ! empty( $latest ) ) {
	if ( has_post_thumbnail( $latest[0]->ID ) ) {
		$hero_bg_url = get_the_post_thumbnail_url( $latest[0]->ID, 'large' );
	}
}
if ( ! $hero_bg_url ) {
	$hero_bg_url = get_template_directory_uri() . '/assets/images/tradepulse-hero.svg';
}

$market_data = tradepulse_market_data();
$chart_paths = tradepulse_market_chart_paths( $market_data['chart'] );
$primary_key = isset( $market_data['primary_key'] ) ? $market_data['primary_key'] : 'stocks';
$primary_market = $market_data['markets'][ $primary_key ];
$stocks = $market_data['markets']['stocks'];
$crypto = $market_data['markets']['crypto'];
$forex = $market_data['markets']['forex'];
$gold = $market_data['markets']['gold'];
$oil = $market_data['markets']['oil'];
?>

<main id="primary" class="site-main">
	<section class="hero hero--media">
		<div class="hero__background" aria-hidden="true" style="--hero-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"></div>

		<div class="hero__inner">
			<div class="hero__content">
				<div class="hero__status<?php echo 'demo' === $market_data['status'] ? ' is-demo' : ''; ?>" data-market-status><span></span><b><?php echo esc_html( $market_data['status_message'] ); ?></b></div>

				<h1>Trading analysis written for the <span>next decision.</span></h1>

				<p class="hero__lede">Concise market notes, technical setups, and macro context for active traders who want a clear plan before the session starts.</p>

				<div class="hero__actions">
					<a class="button button--primary" href="#latest">Explore Latest Analysis <span aria-hidden="true">&rarr;</span></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/trading/' ) ); ?>">Browse Markets</a>
				</div>

				<div class="hero__markets" aria-label="Markets covered">
					<span><i class="hero__market-dot hero__market-dot--green"></i>Stocks</span>
					<span><i class="hero__market-dot hero__market-dot--blue"></i>Forex</span>
					<span><i class="hero__market-dot hero__market-dot--violet"></i>Crypto</span>
					<span><i class="hero__market-dot hero__market-dot--amber"></i>Futures</span>
				</div>
			</div>

			<div class="hero-dashboard">
				<div class="hero-dashboard__top">
					<div>
						<span class="hero-dashboard__label">Market pulse</span>
						<strong data-market-primary-name><?php echo esc_html( $primary_market['name'] ); ?></strong>
					</div>
					<span class="hero-dashboard__live<?php echo 'demo' === $market_data['status'] ? ' is-demo' : ''; ?>" data-market-live><i></i><b><?php echo esc_html( $market_data['status_label'] ); ?></b></span>
				</div>

				<div class="hero-dashboard__quote">
					<strong data-market-primary-price><?php echo esc_html( $primary_market['price'] ); ?></strong>
					<span data-market-primary-change class="<?php echo esc_attr( tradepulse_market_change_class( $primary_market['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $primary_market['change'] ) ); ?></span>
				</div>

				<div class="hero-dashboard__chart" aria-hidden="true">
					<svg viewBox="0 0 420 150" preserveAspectRatio="none">
						<defs>
							<linearGradient id="hero-chart-fill" x1="0" y1="0" x2="0" y2="1">
								<stop offset="0" stop-color="#42e8ba" stop-opacity=".32"/>
								<stop offset="1" stop-color="#42e8ba" stop-opacity="0"/>
							</linearGradient>
						</defs>
						<path class="hero-dashboard__gridline" d="M0 30H420M0 75H420M0 120H420"/>
						<path class="hero-dashboard__area" data-market-chart-area d="<?php echo esc_attr( $chart_paths['area'] ); ?>"/>
						<path class="hero-dashboard__line" data-market-chart-line d="<?php echo esc_attr( $chart_paths['line'] ); ?>"/>
						<circle data-market-chart-point cx="<?php echo esc_attr( $chart_paths['last_x'] ); ?>" cy="<?php echo esc_attr( $chart_paths['last_y'] ); ?>" r="4"/>
					</svg>
				</div>

				<div class="hero-dashboard__watchlist">
					<div><span><i class="hero-dashboard__symbol hero-dashboard__symbol--btc">B</i><b><?php echo esc_html( $crypto['label'] ); ?></b></span><strong data-market-price="crypto"><?php echo esc_html( $crypto['price'] ); ?></strong><em data-market-change="crypto" class="<?php echo esc_attr( tradepulse_market_change_class( $crypto['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $crypto['change'] ) ); ?></em></div>
					<div><span><i class="hero-dashboard__symbol hero-dashboard__symbol--fx">FX</i><b><?php echo esc_html( $forex['label'] ); ?></b></span><strong data-market-price="forex"><?php echo esc_html( $forex['price'] ); ?></strong><em data-market-change="forex" class="<?php echo esc_attr( tradepulse_market_change_class( $forex['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $forex['change'] ) ); ?></em></div>
					<div><span><i class="hero-dashboard__symbol hero-dashboard__symbol--gold">G</i><b><?php echo esc_html( $gold['label'] ); ?></b></span><strong data-market-price="gold"><?php echo esc_html( $gold['price'] ); ?></strong><em data-market-change="gold" class="<?php echo esc_attr( tradepulse_market_change_class( $gold['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $gold['change'] ) ); ?></em></div>
				</div>

				<div class="hero-dashboard__footer">
					<span data-market-updated><?php echo esc_html( $market_data['updated_at'] ? sprintf( __( 'Updated %s', 'tradepulse' ), date_i18n( 'M j, H:i', $market_data['updated_at'] ) ) : __( 'Market data unavailable', 'tradepulse' ) ); ?></span>
					<a href="#latest">View desk notes &rarr;</a>
				</div>
			</div>
		</div>
	</section>

	<div class="market-strip" aria-label="<?php esc_attr_e( 'Market watchlist', 'tradepulse' ); ?>">
		<?php foreach ( $market_data['markets'] as $market_key => $market ) : ?>
			<div class="ticker"><b><?php echo esc_html( $market['label'] ); ?></b><span data-market-price="<?php echo esc_attr( $market_key ); ?>"><?php echo esc_html( $market['price'] ); ?></span><em data-market-change="<?php echo esc_attr( $market_key ); ?>" class="<?php echo esc_attr( tradepulse_market_change_class( $market['change'] ) ); ?>"><?php echo esc_html( tradepulse_market_change( $market['change'] ) ); ?></em></div>
		<?php endforeach; ?>
	</div>

	<section id="latest" class="section section--white">
		<div class="wrap">
			<div class="section-heading">
				<h2>Latest Analysis</h2>
				<p>Recent market posts with clear hierarchy and readable article previews.</p>
			</div>

			<div class="grid grid--two">
				<?php
				$tp_query = new WP_Query( array( 'posts_per_page' => 6 ) );
				if ( $tp_query->have_posts() ) :
					while ( $tp_query->have_posts() ) :
						$tp_query->the_post();
						tradepulse_card();
					endwhile;
				else :
					?>
					<p>No posts found.</p>
					<?php
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	<section id="playbooks" class="section section--white section--bordered home-offers">
		<div class="wrap">
			<?php
			$tradepulse_offers = array(
				array( 'name' => 'E8 Markets', 'logo' => 'e8-markets.svg', 'initials' => 'E8', 'rating' => '4.8', 'discount' => '10%', 'code' => 'TRADE2WIN', 'class' => '1', 'url' => 'https://e8markets.com/', 'details' => 'Use this promo code for eligible E8 Markets plans and review the latest account rules.' ),
				array( 'name' => 'Alpha Capital', 'logo' => 'alpha-futures.svg', 'initials' => 'AC', 'rating' => '4.4', 'discount' => '40%', 'code' => 'MATCH40', 'class' => '1', 'url' => 'https://alphacapitalgroup.uk/', 'details' => 'Use this promo code at checkout for an evaluation discount on eligible Alpha Capital accounts.' ),
				array( 'name' => 'Goat Funded', 'logo' => 'funded-trading-plus.svg', 'initials' => 'GFT', 'rating' => '4.3', 'discount' => '50%', 'code' => 'MATCH', 'class' => '2', 'url' => 'https://goatfundedtrader.com/', 'details' => 'Apply the code before payment to unlock the listed Goat Funded Trader promotional saving.' ),
				array( 'name' => 'The5ers', 'logo' => 'the5ers.svg', 'initials' => '5', 'rating' => '4.7', 'discount' => '10%', 'code' => 'MATCH', 'class' => '3', 'url' => 'https://the5ers.com/', 'details' => 'Use the code on eligible The5ers programs and confirm current terms before purchasing.' ),
				array( 'name' => 'FundingPips', 'logo' => 'fundingpips.svg', 'initials' => 'FP', 'rating' => '4.3', 'discount' => '20%', 'code' => 'MATCH', 'class' => '4', 'url' => 'https://fundingpips.com/', 'details' => 'Enter this coupon during checkout for a FundingPips discount where promotions are available.' ),
				array( 'name' => 'Hola Prime', 'logo' => 'fundednext.svg', 'initials' => 'HP', 'rating' => '4.0', 'discount' => '50%', 'code' => 'MATCH50', 'class' => '2', 'url' => 'https://holaprime.com/', 'details' => 'Copy the code and check Hola Prime offer availability on the official checkout page.' ),
				
				array( 'name' => 'FTMO', 'logo' => 'ftmo.svg', 'initials' => 'FT', 'rating' => '4.6', 'discount' => '15%', 'code' => 'TRADE15', 'class' => '3', 'url' => 'https://ftmo.com/', 'details' => 'Copy the code and verify whether the FTMO checkout currently accepts promotional codes.' ),
				array( 'name' => 'FundedNext', 'logo' => 'fundednext.svg', 'initials' => 'FN', 'rating' => '4.5', 'discount' => '25%', 'code' => 'NEXT25', 'class' => '4', 'url' => 'https://fundednext.com/', 'details' => 'Apply the coupon to eligible FundedNext challenges and confirm current promotion terms.' ),
				array( 'name' => 'Topstep', 'logo' => 'topstep.svg', 'initials' => 'TS', 'rating' => '4.6', 'discount' => '30%', 'code' => 'STEP30', 'class' => '1', 'url' => 'https://www.topstep.com/', 'details' => 'Use the code on eligible Topstep checkout flows and confirm the offer before purchase.' ),
				array( 'name' => 'Alpha Futures', 'logo' => 'alpha-futures.svg', 'initials' => 'AF', 'rating' => '4.2', 'discount' => '35%', 'code' => 'ALPHA35', 'class' => '2', 'url' => 'https://alpha-futures.com/', 'details' => 'Copy this coupon for Alpha Futures and review account terms before starting an evaluation.' ),
				array( 'name' => 'Funded Plus', 'logo' => 'funded-trading-plus.svg', 'initials' => 'FTP', 'rating' => '4.4', 'discount' => '20%', 'code' => 'PLUS20', 'class' => '3', 'url' => 'https://www.fundedtradingplus.com/', 'details' => 'Use this code for eligible Funded Trading Plus plans and verify current conditions.' ),
				array( 'name' => 'E8 Markets Pro', 'logo' => 'e8-markets.svg', 'initials' => 'E8', 'rating' => '4.8', 'discount' => '12%', 'code' => 'E8MATCH', 'class' => '4', 'url' => 'https://e8markets.com/', 'details' => 'Copy the code for E8 Markets Pro offers and check the official site for live terms.' ),
			);
			?>

			<div class="section-heading">
				<h2><?php esc_html_e( 'Coupon and deals', 'tradepulse' ); ?></h2>
				<p><?php esc_html_e( 'Current trading firm discounts and promo codes collected in one quick board.', 'tradepulse' ); ?></p>
			</div>

			<div class="offer-showcase" data-offer-slider aria-label="<?php esc_attr_e( 'Exclusive trading discounts', 'tradepulse' ); ?>">
				<header class="offer-showcase__header">
					<div class="offer-showcase__controls" aria-label="<?php esc_attr_e( 'Offer slider controls', 'tradepulse' ); ?>">
						<button class="offer-slider__button" type="button" data-offer-prev aria-label="<?php esc_attr_e( 'Previous offers', 'tradepulse' ); ?>">&lsaquo;</button>
						<div class="offer-showcase__dots" data-offer-dots></div>
						<button class="offer-slider__button" type="button" data-offer-next aria-label="<?php esc_attr_e( 'Next offers', 'tradepulse' ); ?>">&rsaquo;</button>
					</div>
				</header>

				<div class="offer-grid" data-offer-track>
					<?php foreach ( $tradepulse_offers as $offer_index => $offer ) : ?>
						<article class="offer-card offer-card--<?php echo esc_attr( $offer['class'] ); ?>" tabindex="0" role="button" aria-label="<?php echo esc_attr( sprintf( __( 'View %s coupon details', 'tradepulse' ), $offer['name'] ) ); ?>" data-offer-card data-offer-name="<?php echo esc_attr( $offer['name'] ); ?>" data-offer-logo="<?php echo esc_url( get_template_directory_uri() . '/assets/images/firms/' . $offer['logo'] ); ?>" data-offer-initials="<?php echo esc_attr( $offer['initials'] ); ?>" data-offer-rating="<?php echo esc_attr( $offer['rating'] ); ?>" data-offer-discount="<?php echo esc_attr( $offer['discount'] ); ?>" data-offer-code="<?php echo esc_attr( $offer['code'] ); ?>" data-offer-url="<?php echo esc_url( $offer['url'] ); ?>" data-offer-details="<?php echo esc_attr( $offer['details'] ); ?>"<?php echo $offer_index >= 8 ? ' hidden' : ''; ?>>
							<span class="offer-card__logo">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/firms/' . $offer['logo'] ); ?>" alt="">
								<b aria-hidden="true"><?php echo esc_html( $offer['initials'] ); ?></b>
							</span>
							<div class="offer-card__firm">
								<strong><?php echo esc_html( $offer['name'] ); ?></strong>
								<span class="offer-card__rating"><b><?php echo esc_html( $offer['rating'] ); ?></b><i aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</i></span>
							</div>
							<div class="offer-card__deal">
								<span><b><?php echo esc_html( $offer['discount'] ); ?></b> <?php esc_html_e( 'OFF', 'tradepulse' ); ?></span>
								<strong><?php echo esc_html( $offer['code'] ); ?> <i aria-hidden="true"></i></strong>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="coupon-modal" data-coupon-modal hidden>
				<div class="coupon-modal__backdrop" data-coupon-close></div>
				<div class="coupon-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="coupon-modal-title" tabindex="-1">
					<button class="coupon-modal__close" type="button" data-coupon-close aria-label="<?php esc_attr_e( 'Close coupon details', 'tradepulse' ); ?>">&times;</button>
					<h3 id="coupon-modal-title"><?php esc_html_e( 'Promo Code', 'tradepulse' ); ?></h3>
					<div class="coupon-modal__card">
						<div class="coupon-modal__brand">
							<span class="coupon-modal__logo"><img data-coupon-logo alt=""><b data-coupon-initials aria-hidden="true"></b></span>
							<strong data-coupon-name></strong>
							<span class="coupon-modal__rating"><b data-coupon-rating></b><i aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</i></span>
						</div>
						<div class="coupon-modal__deal">
							<div class="coupon-modal__discount"><span data-coupon-discount></span><em><?php esc_html_e( 'OFF', 'tradepulse' ); ?></em></div>
							<div class="coupon-modal__code-panel">
								<span><?php esc_html_e( 'Promo code', 'tradepulse' ); ?></span>
								<div class="coupon-modal__code-row">
									<b data-coupon-code></b>
									<button class="coupon-modal__copy" type="button" data-coupon-copy><span data-coupon-copy-label><?php esc_html_e( 'Copy Code', 'tradepulse' ); ?></span></button>
								</div>
								<p data-coupon-details></p>
							</div>
						</div>
						<p class="coupon-modal__status" data-coupon-status aria-live="polite"><?php esc_html_e( 'Ready to copy.', 'tradepulse' ); ?></p>
					</div>
					<a class="coupon-modal__action" href="#" target="_blank" rel="noopener noreferrer" data-coupon-link><?php esc_html_e( 'Use Code at', 'tradepulse' ); ?> <span data-coupon-link-name></span> <i aria-hidden="true">&rarr;</i></a>
				</div>
			</div>
		</div>
	</section>

	<section id="topics" class="section section--white">
		<div class="wrap">
			<div class="section-heading">
				<h2>Browse Topics</h2>
				<p>Direct readers to your main research categories without clutter.</p>
			</div>

			<div class="category-cloud">
				<?php
				$cats = get_categories(array('hide_empty'=>1));
				foreach($cats as $c) {
					echo '<a href="' . esc_url( get_category_link($c) ) . '">' . esc_html($c->name) . '</a>';
				}
				?>
			</div>
		</div>
	</section>

	<section class="section section--white">
		<div class="wrap newsletter">
			<div>
				<h2>Compare the top prop firms.</h2>
				<p>Review leading funded trading programs, account sizes, profit splits, evaluation rules, and the best fit for your trading style.</p>
			</div>
			<a class="button button--primary" href="<?php echo esc_url( home_url( '/top-prop-firms/' ) ); ?>">View Top Prop Firms</a>
		</div>
	</section>

</main>

<?php get_footer();
