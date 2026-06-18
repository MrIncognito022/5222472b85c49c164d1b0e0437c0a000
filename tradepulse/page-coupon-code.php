<?php
/**
 * Template Name: coupon code page
 *
 * @package TradePulse
 */

get_header();

$coupon_query = new WP_Query( array(
	'post_type'      => 'coupon',
	'post_status'    => 'publish',
	'posts_per_page' => 24,
) );
?>

<main id="primary" class="coupon-directory-page">
	<section class="coupon-directory-hero">
		<div class="coupon-directory-hero__inner">
			<span class="eyebrow"><?php esc_html_e( 'Trading deals', 'tradepulse' ); ?></span>
			<h1><?php esc_html_e( 'Most Popular Coupon Codes', 'tradepulse' ); ?></h1>
			<p><?php esc_html_e( 'Browse current trading firm discounts, promo codes, and limited-time offers. Click any coupon to reveal the code and visit the offer page.', 'tradepulse' ); ?></p>
		</div>
	</section>

	<section class="section coupon-directory-section">
		<div class="wrap">
			<?php if ( $coupon_query->have_posts() ) : ?>
				<div class="coupon-directory-grid">
					<?php
					while ( $coupon_query->have_posts() ) :
						$coupon_query->the_post();

						$coupon_id      = get_the_ID();
						$brand          = get_post_meta( $coupon_id, '_tradepulse_coupon_brand', true );
						$code           = get_post_meta( $coupon_id, '_tradepulse_coupon_code', true );
						$discount       = get_post_meta( $coupon_id, '_tradepulse_coupon_discount', true );
						$url            = get_post_meta( $coupon_id, '_tradepulse_coupon_url', true );
						$image_url      = get_post_meta( $coupon_id, '_tradepulse_coupon_image_url', true );
						$expires        = get_post_meta( $coupon_id, '_tradepulse_coupon_expires', true );
						$rating         = get_post_meta( $coupon_id, '_tradepulse_coupon_rating', true );
						$details        = get_post_meta( $coupon_id, '_tradepulse_coupon_details', true );
						$image          = has_post_thumbnail() ? get_the_post_thumbnail_url( $coupon_id, 'medium' ) : $image_url;
						$title          = get_the_title();
						$brand_label    = $brand ? $brand : sprintf( __( '%s Coupons', 'tradepulse' ), $title );
						$discount_label = $discount ? $discount : __( 'Deal', 'tradepulse' );
						$code_label     = $code ? $code : __( 'CODE', 'tradepulse' );
						$details_label  = $details ? $details : wp_strip_all_tags( get_the_excerpt() ? get_the_excerpt() : get_the_content() );
						$initials       = strtoupper( substr( preg_replace( '/[^A-Za-z0-9]/', '', $title ), 0, 3 ) );
						?>
						<article
							class="coupon-directory-card"
							tabindex="0"
							role="button"
							aria-label="<?php echo esc_attr( sprintf( __( 'View %s coupon code', 'tradepulse' ), $title ) ); ?>"
							data-offer-card
							data-offer-name="<?php echo esc_attr( $title ); ?>"
							data-offer-logo="<?php echo esc_url( $image ); ?>"
							data-offer-initials="<?php echo esc_attr( $initials ? $initials : 'TP' ); ?>"
							data-offer-rating="<?php echo esc_attr( $rating ? $rating : '4.5' ); ?>"
							data-offer-discount="<?php echo esc_attr( $discount_label ); ?>"
							data-offer-code="<?php echo esc_attr( $code_label ); ?>"
							data-offer-url="<?php echo esc_url( $url ? $url : get_permalink() ); ?>"
							data-offer-details="<?php echo esc_attr( $details_label ); ?>"
						>
							<span class="coupon-directory-card__badge"><?php echo esc_html( $discount_label ); ?> <?php esc_html_e( 'OFF', 'tradepulse' ); ?></span>
							<div class="coupon-directory-card__media">
								<?php if ( $image ) : ?>
									<img src="<?php echo esc_url( $image ); ?>" alt="">
								<?php else : ?>
									<span><?php echo esc_html( $initials ? $initials : 'TP' ); ?></span>
								<?php endif; ?>
							</div>
							<span class="coupon-directory-card__brand"><?php echo esc_html( $brand_label ); ?></span>
							<h2><?php echo esc_html( $title ); ?></h2>
							<button type="button" class="coupon-directory-card__code">
								<span><?php esc_html_e( 'Get Code', 'tradepulse' ); ?></span>
								<b><?php echo esc_html( $code_label ); ?></b>
							</button>
							<div class="coupon-directory-card__meta">
								<span><?php echo esc_html( $expires ? $expires : __( 'No Expires', 'tradepulse' ) ); ?></span>
								<i aria-hidden="true">&#9734;</i>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<div class="coupon-directory-empty">
					<h2><?php esc_html_e( 'No coupons published yet.', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'Add coupon posts in the WordPress dashboard and they will appear here automatically.', 'tradepulse' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

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
</main>

<?php
wp_reset_postdata();
get_footer();
