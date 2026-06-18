<?php
/**
 * Contact page template.
 *
 * @package TradePulse
 */

$tradepulse_contact_email = get_option( 'admin_email' );

get_header();
?>

<main id="primary" class="contact-page">
	<section class="contact-hero">
		<div class="contact-hero__inner">
			<div class="contact-hero__content">
				<span class="eyebrow"><?php esc_html_e( 'Contact TradePulse', 'tradepulse' ); ?></span>
				<h1><?php esc_html_e( 'Let\'s talk markets, partnerships, and research.', 'tradepulse' ); ?></h1>
				<p><?php esc_html_e( 'Send questions about prop firms, market coverage, coupon listings, partnerships, or editorial feedback. We read every note and keep the conversation practical.', 'tradepulse' ); ?></p>
				<div class="contact-hero__chips" aria-label="<?php esc_attr_e( 'Common contact topics', 'tradepulse' ); ?>">
					<span><?php esc_html_e( 'Prop firms', 'tradepulse' ); ?></span>
					<span><?php esc_html_e( 'Coupons', 'tradepulse' ); ?></span>
					<span><?php esc_html_e( 'Editorial', 'tradepulse' ); ?></span>
				</div>
			</div>
			<div class="contact-hero__panel" aria-label="<?php esc_attr_e( 'Response details', 'tradepulse' ); ?>">
				<span><?php esc_html_e( 'Typical reply', 'tradepulse' ); ?></span>
				<strong><?php esc_html_e( '1-2 business days', 'tradepulse' ); ?></strong>
				<p><?php esc_html_e( 'For urgent corrections, include the page URL and a short summary in your message.', 'tradepulse' ); ?></p>
				<div class="contact-hero__stats">
					<div><b><?php esc_html_e( 'Fast', 'tradepulse' ); ?></b><small><?php esc_html_e( 'Corrections', 'tradepulse' ); ?></small></div>
					<div><b><?php esc_html_e( 'Clear', 'tradepulse' ); ?></b><small><?php esc_html_e( 'Partnerships', 'tradepulse' ); ?></small></div>
				</div>
			</div>
		</div>
	</section>

	<section class="section contact-section">
		<div class="wrap contact-layout">
			<div class="contact-card contact-card--form">
				<div class="contact-card__heading">
					<span><?php esc_html_e( 'Send a message', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'How can we help?', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'Share the details clearly. Short, specific messages are easiest for us to route.', 'tradepulse' ); ?></p>
				</div>

				<?php if ( isset( $_GET['contact_status'] ) && 'success' === $_GET['contact_status'] ) : ?>
					<p id="contact-form" class="contact-form__notice contact-form__notice--success"><?php esc_html_e( 'Thanks. Your message was sent and saved successfully.', 'tradepulse' ); ?></p>
				<?php elseif ( isset( $_GET['contact_status'] ) && 'error' === $_GET['contact_status'] ) : ?>
					<p id="contact-form" class="contact-form__notice contact-form__notice--error"><?php esc_html_e( 'Please check your name, email, and message, then try again.', 'tradepulse' ); ?></p>
				<?php else : ?>
					<span id="contact-form"></span>
				<?php endif; ?>

				<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="tradepulse_contact_submit">
					<?php wp_nonce_field( 'tradepulse_contact_submit', 'tradepulse_contact_nonce' ); ?>
					<p>
						<label for="contact-name"><?php esc_html_e( 'Name', 'tradepulse' ); ?></label>
						<input id="contact-name" name="name" type="text" autocomplete="name" maxlength="80" placeholder="<?php esc_attr_e( 'Your name', 'tradepulse' ); ?>" required>
					</p>
					<p>
						<label for="contact-email"><?php esc_html_e( 'Email', 'tradepulse' ); ?></label>
						<input id="contact-email" name="email" type="email" autocomplete="email" maxlength="120" placeholder="<?php esc_attr_e( 'you@example.com', 'tradepulse' ); ?>" required>
					</p>
					<p class="contact-form__full">
						<label for="contact-message"><?php esc_html_e( 'Message', 'tradepulse' ); ?></label>
						<textarea id="contact-message" name="message" rows="6" maxlength="3000" placeholder="<?php esc_attr_e( 'Tell us what you need...', 'tradepulse' ); ?>" required></textarea>
					</p>
					<div class="contact-form__actions">
						<button class="button button--primary" type="submit"><?php esc_html_e( 'Send Message', 'tradepulse' ); ?></button>
					</div>
					<p class="contact-form__email-note">
						<?php esc_html_e( 'For any queries, email us at', 'tradepulse' ); ?>
						<a href="<?php echo esc_url( 'mailto:' . $tradepulse_contact_email ); ?>"><?php echo esc_html( $tradepulse_contact_email ); ?></a>
					</p>
				</form>
			</div>

			<aside class="contact-card contact-card--details">
				<div class="contact-side-intro">
					<span><?php esc_html_e( 'Contact desk', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Route your note faster.', 'tradepulse' ); ?></h2>
				</div>
				<div class="contact-detail">
					<span><?php esc_html_e( 'Editorial', 'tradepulse' ); ?></span>
					<h3><?php esc_html_e( 'Market coverage', 'tradepulse' ); ?></h3>
					<p><?php esc_html_e( 'Send chart ideas, correction notes, and feedback on research categories.', 'tradepulse' ); ?></p>
				</div>
				<div class="contact-detail">
					<span><?php esc_html_e( 'Commercial', 'tradepulse' ); ?></span>
					<h3><?php esc_html_e( 'Deals and partnerships', 'tradepulse' ); ?></h3>
					<p><?php esc_html_e( 'Share coupon updates, prop firm details, affiliate questions, and sponsorship ideas.', 'tradepulse' ); ?></p>
				</div>
				<div class="contact-detail">
					<span><?php esc_html_e( 'Useful links', 'tradepulse' ); ?></span>
					<div class="contact-links">
						<a href="<?php echo esc_url( home_url( '/top-prop-firms/' ) ); ?>"><?php esc_html_e( 'Top Prop Firms', 'tradepulse' ); ?></a>
						<a href="<?php echo esc_url( home_url( '/review/' ) ); ?>"><?php esc_html_e( 'Reviews', 'tradepulse' ); ?></a>
						<a href="<?php echo esc_url( home_url( '/trading/' ) ); ?>"><?php esc_html_e( 'Trading Topics', 'tradepulse' ); ?></a>
					</div>
				</div>
			</aside>
		</div>
	</section>
</main>

<?php get_footer();
