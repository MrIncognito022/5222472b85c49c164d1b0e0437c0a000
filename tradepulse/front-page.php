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
	$hero_bg_url = esc_url( get_template_directory_uri() . '/assets/images/tradepulse-hero.webp' );
}
?>

<main id="primary" class="site-main">
	<section class="hero hero--media">
		<div class="hero__background" aria-hidden="true" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"></div>

		<div class="hero__inner">
			<div class="hero__content">
				<span class="eyebrow">Markets, charts and risk</span>

				<h1><?php echo esc_html( get_bloginfo('name') ); ?></h1>

				<p class="hero__lede"><?php echo esc_html( get_bloginfo('description') ); ?></p>

				<div class="hero__actions">
					<a class="button button--primary" href="#latest">Read Latest Posts</a>
					<a class="button button--ghost" href="#topics">Browse Topics</a>
				</div>
			</div>

			<div class="session-card session-card--glass">
				<div class="session-card__header">
					<span>Today on the desk</span>
					<strong><?php echo date_i18n('M j'); ?></strong>
				</div>

				<ul>
					<li>Watch index breadth near the opening range.</li>
					<li>Dollar strength remains the key macro input.</li>
					<li>Define risk before chasing momentum.</li>
				</ul>
			</div>
		</div>
	</section>

	<div class="market-strip" aria-label="Sample market watchlist">
		<div class="ticker"><b>SPX</b><span>Index watch</span><em data-market-value="" data-base-value="0.42">+0.41%</em></div>
		<div class="ticker"><b>BTC</b><span>Crypto flow</span><em data-market-value="" data-base-value="1.18">+1.20%</em></div>
		<div class="ticker"><b>GOLD</b><span>Macro hedge</span><em data-market-value="" data-base-value="0.31">+0.35%</em></div>
		<div class="ticker"><b>EUR/USD</b><span>FX pulse</span><em data-market-value="" data-base-value="0.09">+0.11%</em></div>
		<div class="ticker"><b>WTI</b><span>Energy desk</span><em data-market-value="" data-base-value="0.64">+0.62%</em></div>
	</div>

	<section id="latest" class="section section--white">
		<div class="wrap">
			<div class="section-heading">
				<h2>Latest Analysis</h2>
				<p>Recent market posts with clear hierarchy and readable article previews.</p>
			</div>

			<div class="grid grid--two">
				<?php
				$tp_query = new WP_Query(array('posts_per_page' => 6));
				if ( $tp_query->have_posts() ) :
					while ( $tp_query->have_posts() ) : $tp_query->the_post();
						$thumb = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(),'medium') : get_template_directory_uri() . '/assets/images/post-fallback.webp';
						?>
						<article class="post-card will-reveal is-visible">
							<a class="post-card__image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
								<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
							</a>
							<div class="post-card__body">
								<div class="post-card__meta">
									<span><?php echo get_the_category_list(', '); ?></span>
									<span><?php echo get_the_date(); ?></span>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo wp_strip_all_tags( wp_trim_words( get_the_excerpt() ?: get_the_content(), 28 ) ); ?></p>
								<a class="read-more-link" href="<?php the_permalink(); ?>">Read analysis</a>
							</div>
						</article>
						<?php
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

