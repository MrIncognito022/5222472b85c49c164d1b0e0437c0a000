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

	<section id="playbooks" class="section section--white section--bordered">
		<div class="wrap">
			<div class="section-heading">
				<h2>Editorial Focus</h2>
				<p>A practical publishing desk for traders who want context, levels, and risk before they act.</p>
			</div>

			<div class="focus-grid">
				<article class="focus-card">
					<span class="focus-card__label">Before the open</span>
					<h3>Daily Market Briefs</h3>
					<p>Session bias, key levels, major catalysts, and the conditions that would change the plan.</p>
					<div class="focus-card__meta"><span>Pre-market</span><span>5 min read</span></div>
				</article>

				<article class="focus-card">
					<span class="focus-card__label">During the week</span>
					<h3>Chart Setups</h3>
					<p>Trend structure, entry zones, invalidation points, and scenario notes for high-quality setups.</p>
					<div class="focus-card__meta"><span>Technical</span><span>Levels first</span></div>
				</article>

				<article class="focus-card">
					<span class="focus-card__label">Big picture</span>
					<h3>Macro &amp; Risk Notes</h3>
					<p>Rates, dollar, commodities, liquidity, volatility, and position-risk context behind larger moves.</p>
					<div class="focus-card__meta"><span>Cross-asset</span><span>Risk aware</span></div>
				</article>
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
				<h2>Create a better market routine.</h2>
				<p>Use this space for your newsletter, premium research, or daily watchlist signup.</p>
			</div>
			<a class="button button--primary" href="<?php echo esc_url( home_url('/') ); ?>?s=">Search the Archive</a>
		</div>
	</section>

</main>

<?php get_footer();

