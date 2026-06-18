<?php
/**
 * Privacy policy page template.
 *
 * @package TradePulse
 */

$tradepulse_contact_email = get_option( 'admin_email' );

get_header();
?>

<main id="primary" class="privacy-page">
	<section class="privacy-hero">
		<div class="privacy-hero__inner">
			<div class="privacy-hero__content">
				<span class="eyebrow"><?php esc_html_e( 'Privacy Policy', 'tradepulse' ); ?></span>
				<h1><?php esc_html_e( 'How TradePulse handles your information.', 'tradepulse' ); ?></h1>
				<p><?php esc_html_e( 'This page explains what information may be collected when you browse TradePulse, how it is used, and the choices available to you.', 'tradepulse' ); ?></p>
				<div class="privacy-hero__chips" aria-label="<?php esc_attr_e( 'Privacy principles', 'tradepulse' ); ?>">
					<span><?php esc_html_e( 'Readable', 'tradepulse' ); ?></span>
					<span><?php esc_html_e( 'Transparent', 'tradepulse' ); ?></span>
					<span><?php esc_html_e( 'Affiliate-aware', 'tradepulse' ); ?></span>
				</div>
			</div>
			<div class="privacy-hero__panel">
				<span><?php esc_html_e( 'Last updated', 'tradepulse' ); ?></span>
				<strong><?php echo esc_html( date_i18n( 'F j, Y' ) ); ?></strong>
				<p><?php esc_html_e( 'We keep this policy readable and update it when site features, analytics, or affiliate disclosures change.', 'tradepulse' ); ?></p>
			</div>
		</div>
	</section>

	<section class="section privacy-section">
		<div class="wrap privacy-layout">
			<aside class="privacy-index" aria-label="<?php esc_attr_e( 'Privacy policy sections', 'tradepulse' ); ?>">
				<span><?php esc_html_e( 'Policy sections', 'tradepulse' ); ?></span>
				<a href="#privacy-overview"><?php esc_html_e( 'Overview', 'tradepulse' ); ?></a>
				<a href="#privacy-data"><?php esc_html_e( 'Information we collect', 'tradepulse' ); ?></a>
				<a href="#privacy-cookies"><?php esc_html_e( 'Cookies and analytics', 'tradepulse' ); ?></a>
				<a href="#privacy-affiliates"><?php esc_html_e( 'Affiliate links', 'tradepulse' ); ?></a>
				<a href="#privacy-rights"><?php esc_html_e( 'Your choices', 'tradepulse' ); ?></a>
				<a href="#privacy-contact"><?php esc_html_e( 'Contact', 'tradepulse' ); ?></a>
			</aside>

			<div class="privacy-content">
				<div class="privacy-summary">
					<div>
						<span><?php esc_html_e( 'Data', 'tradepulse' ); ?></span>
						<strong><?php esc_html_e( 'Only what helps the site work', 'tradepulse' ); ?></strong>
					</div>
					<div>
						<span><?php esc_html_e( 'Cookies', 'tradepulse' ); ?></span>
						<strong><?php esc_html_e( 'Used for function and measurement', 'tradepulse' ); ?></strong>
					</div>
					<div>
						<span><?php esc_html_e( 'Links', 'tradepulse' ); ?></span>
						<strong><?php esc_html_e( 'Affiliate offers may be tracked', 'tradepulse' ); ?></strong>
					</div>
				</div>

				<article id="privacy-overview" class="privacy-card">
					<span><?php esc_html_e( '01', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Overview', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'TradePulse publishes market commentary, prop firm comparisons, reviews, and coupon information. We aim to collect only the information needed to operate the website, improve content, respond to messages, and measure performance.', 'tradepulse' ); ?></p>
				</article>

				<article id="privacy-data" class="privacy-card">
					<span><?php esc_html_e( '02', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Information we collect', 'tradepulse' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Information you send through contact forms, email, comments, or other direct messages.', 'tradepulse' ); ?></li>
						<li><?php esc_html_e( 'Basic technical information such as browser type, device type, referring pages, and approximate location from server logs or analytics tools.', 'tradepulse' ); ?></li>
						<li><?php esc_html_e( 'Interaction data such as pages viewed, links clicked, and coupon or review pages visited.', 'tradepulse' ); ?></li>
					</ul>
				</article>

				<article id="privacy-cookies" class="privacy-card">
					<span><?php esc_html_e( '03', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Cookies and analytics', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'The site may use cookies or similar technologies for core WordPress functionality, comment sessions, analytics, security, and affiliate attribution. You can control cookies through your browser settings, though some features may not work as expected if cookies are disabled.', 'tradepulse' ); ?></p>
				</article>

				<article id="privacy-affiliates" class="privacy-card">
					<span><?php esc_html_e( '04', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Affiliate links and offers', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'Some links to prop firms, brokers, trading tools, or coupon offers may be affiliate links. If you click one of these links and make a purchase, TradePulse may earn a commission at no extra cost to you. Affiliate relationships do not remove your responsibility to verify fees, rules, risks, and current terms before buying.', 'tradepulse' ); ?></p>
				</article>

				<article id="privacy-rights" class="privacy-card">
					<span><?php esc_html_e( '05', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Your choices', 'tradepulse' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'You may request access, correction, or deletion of personal information you have sent to us.', 'tradepulse' ); ?></li>
						<li><?php esc_html_e( 'You may unsubscribe from emails if newsletter or alert features are added.', 'tradepulse' ); ?></li>
						<li><?php esc_html_e( 'You may disable cookies in your browser or use privacy tools to limit tracking.', 'tradepulse' ); ?></li>
					</ul>
				</article>

				<article id="privacy-contact" class="privacy-card privacy-card--contact">
					<span><?php esc_html_e( '06', 'tradepulse' ); ?></span>
					<h2><?php esc_html_e( 'Questions about privacy?', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'For privacy questions, corrections, or data requests, contact us using the email below.', 'tradepulse' ); ?></p>
					<p class="privacy-contact-email">
						<?php esc_html_e( 'For any queries, email us at', 'tradepulse' ); ?>
						<a href="<?php echo esc_url( 'mailto:' . $tradepulse_contact_email ); ?>"><?php echo esc_html( $tradepulse_contact_email ); ?></a>
					</p>
				</article>
			</div>
		</div>
	</section>
</main>

<?php get_footer();
