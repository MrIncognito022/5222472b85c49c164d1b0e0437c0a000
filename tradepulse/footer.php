<?php
/**
 * Theme footer
 *
 * @package TradePulse
 */
?>
<footer class="site-footer">
    <div class="site-footer__main">
        <div class="site-footer__brand">
            <a class="brand brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <span class="brand__mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" role="img">
                        <path d="M4 16.5 9 11l3.5 3.5L20 6.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M4 19h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </span>
                <span class="brand__text">
                    <span class="brand__name"><?php bloginfo( 'name' ); ?></span>
                    <span class="brand__tagline">Trading Journal</span>
                </span>
            </a>
            <p><?php esc_html_e( 'Independent market commentary, technical setups, and macro notes for disciplined traders.', 'tradepulse' ); ?></p>
        </div>

        <div class="footer-column">
            <h2>Topics</h2>
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/stocks/' ) ); ?>">Stocks</a></li>
                <li><a href="<?php echo esc_url( home_url( '/crypto/' ) ); ?>">Crypto</a></li>
                <li><a href="<?php echo esc_url( home_url( '/forex/' ) ); ?>">Forex</a></li>
                <li><a href="<?php echo esc_url( home_url( '/future/' ) ); ?>">Future</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h2>Resources</h2>
            <ul>
                <li><a href="/contact-us">Contact Us
                </a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/coupons-deals">Coupons and Deals</a></li>
                <li><a href="/review">Reviews</a></li>
            </ul>
        </div>

        <div class="footer-column footer-column--newsletter">
            <h2>Stay Updated</h2>
            <p><?php esc_html_e( 'Get the latest trading notes and market analysis from the archive.', 'tradepulse' ); ?></p>
            <a class="footer-button" href="<?php echo esc_url( home_url( '/' ) ); ?>?s=">Search Archive</a>
        </div>
    </div>

    <div class="site-footer__bottom">
        <p>&copy; <?php echo date_i18n( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'tradepulse' ); ?></p>
        <p><?php esc_html_e( 'Educational commentary only. Not financial advice.', 'tradepulse' ); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
