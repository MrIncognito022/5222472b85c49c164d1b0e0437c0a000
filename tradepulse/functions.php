<?php
/**
 * TradePulse theme setup (Optimized for WordPress Default Image Sizes).
 *
 * @package TradePulse
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function tradepulse_setup() {
    load_theme_textdomain( 'tradepulse', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );

    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'tradepulse' ),
    ) );
}
add_action( 'after_setup_theme', 'tradepulse_setup' );

/**
 * Create the theme's core landing pages and post categories once.
 */
function tradepulse_create_content_pages() {
    $setup_version = '1.0';

    if ( get_option( 'tradepulse_content_setup_version' ) === $setup_version ) {
        return;
    }

    $pages = array(
        'trading'        => __( 'Trading', 'tradepulse' ),
        'stocks'         => __( 'Stocks', 'tradepulse' ),
        'forex'          => __( 'Forex', 'tradepulse' ),
        'crypto'         => __( 'Crypto', 'tradepulse' ),
        'future'         => __( 'Future', 'tradepulse' ),
        'review'         => __( 'Review', 'tradepulse' ),
        'top-prop-firms' => __( 'Top Prop Firms', 'tradepulse' ),
    );

    foreach ( $pages as $slug => $title ) {
        if ( ! get_page_by_path( $slug ) ) {
            wp_insert_post( array(
                'post_title'  => $title,
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_type'   => 'page',
            ) );
        }
    }

    $categories = array(
        'stocks'         => __( 'Stocks', 'tradepulse' ),
        'forex'          => __( 'Forex', 'tradepulse' ),
        'crypto'         => __( 'Crypto', 'tradepulse' ),
        'futures'        => __( 'Futures', 'tradepulse' ),
        'review'         => __( 'Review', 'tradepulse' ),
        'top-prop-firms' => __( 'Top Prop Firms', 'tradepulse' ),
    );

    foreach ( $categories as $slug => $name ) {
        if ( ! term_exists( $slug, 'category' ) ) {
            wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
        }
    }

    update_option( 'tradepulse_content_setup_version', $setup_version );
}
add_action( 'admin_init', 'tradepulse_create_content_pages' );

/**
 * Register widget areas
 */
function tradepulse_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Front Page Widgets', 'tradepulse' ),
        'id'            => 'front-page-widgets',
        'description'   => esc_html__( 'Widgets displayed on the front page', 'tradepulse' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'tradepulse_widgets_init' );

function tradepulse_assets() {
    wp_enqueue_style( 'tradepulse-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'tradepulse-style', get_stylesheet_uri(), array( 'tradepulse-fonts' ), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'tradepulse-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_localize_script( 'tradepulse-theme', 'tradepulseMarket', array(
        'endpoint' => esc_url_raw( rest_url( 'tradepulse/v1/market-data' ) ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'tradepulse_assets' );

/**
 * Return the Twelve Data API key from wp-config.php or the theme setting.
 */
function tradepulse_market_api_key() {
    if ( defined( 'TRADEPULSE_TWELVE_DATA_API_KEY' ) && TRADEPULSE_TWELVE_DATA_API_KEY ) {
        return (string) TRADEPULSE_TWELVE_DATA_API_KEY;
    }

    return (string) get_option( 'tradepulse_twelve_data_api_key', '' );
}

/**
 * Register the market data setting under Appearance > TradePulse Market Data.
 */
function tradepulse_market_data_settings() {
    register_setting( 'tradepulse_market_data', 'tradepulse_twelve_data_api_key', array(
        'sanitize_callback' => 'tradepulse_sanitize_market_api_key',
    ) );

    add_theme_page(
        __( 'TradePulse Market Data', 'tradepulse' ),
        __( 'Market Data', 'tradepulse' ),
        'manage_options',
        'tradepulse-market-data',
        'tradepulse_market_data_settings_page'
    );
}
add_action( 'admin_menu', 'tradepulse_market_data_settings' );

function tradepulse_sanitize_market_api_key( $api_key ) {
    delete_transient( 'tradepulse_market_data_v1' );
    delete_transient( 'tradepulse_market_data_v2' );
    return sanitize_text_field( $api_key );
}

function tradepulse_market_data_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'TradePulse Market Data', 'tradepulse' ); ?></h1>
        <p><?php esc_html_e( 'Optional: enter a free Twelve Data API key for a unified feed. Without one, TradePulse uses delayed/public Nasdaq, CoinGecko, and Frankfurter data. Results are cached for 30 minutes.', 'tradepulse' ); ?></p>
        <form method="post" action="options.php">
            <?php settings_fields( 'tradepulse_market_data' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="tradepulse-twelve-data-api-key"><?php esc_html_e( 'Twelve Data API key', 'tradepulse' ); ?></label></th>
                    <td><input id="tradepulse-twelve-data-api-key" class="regular-text" type="password" name="tradepulse_twelve_data_api_key" value="<?php echo esc_attr( get_option( 'tradepulse_twelve_data_api_key', '' ) ); ?>" autocomplete="off"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Fetch and cache market data for the homepage dashboard.
 */
function tradepulse_market_data() {
    $fallback = array(
        'is_live'    => false,
        'status'     => 'demo',
        'status_label' => __( 'Demo', 'tradepulse' ),
        'status_message' => __( 'Market data demo', 'tradepulse' ),
        'primary_key' => 'stocks',
        'updated_at' => '',
        'chart'      => array( 128, 119, 124, 103, 108, 83, 90, 62, 70, 45, 53, 28, 39, 18, 24, 8 ),
        'markets'    => array(
            'stocks' => array( 'label' => 'SPY', 'name' => 'S&P 500 ETF', 'price' => '--', 'change' => null ),
            'crypto' => array( 'label' => 'BTC', 'name' => 'Bitcoin', 'price' => '--', 'change' => null ),
            'forex'  => array( 'label' => 'EUR/USD', 'name' => 'Euro / Dollar', 'price' => '--', 'change' => null ),
            'gold'   => array( 'label' => 'GLD', 'name' => 'Gold ETF', 'price' => '--', 'change' => null ),
            'oil'    => array( 'label' => 'USO', 'name' => 'Oil ETF', 'price' => '--', 'change' => null ),
        ),
    );
    $api_key = tradepulse_market_api_key();

    $cached = get_transient( 'tradepulse_market_data_v2' );
    if ( is_array( $cached ) ) {
        return $cached;
    }

    if ( ! $api_key ) {
        $public_data = tradepulse_public_market_data( $fallback );
        set_transient( 'tradepulse_market_data_v2', $public_data, 30 * MINUTE_IN_SECONDS );
        return $public_data;
    }

    $symbols = array(
        'stocks' => 'SPY',
        'crypto' => 'BTC/USD',
        'forex'  => 'EUR/USD',
        'gold'   => 'GLD',
        'oil'    => 'USO',
    );
    $data = $fallback;
    $successful = 0;

    foreach ( $symbols as $key => $symbol ) {
        $url = add_query_arg( array(
            'symbol' => $symbol,
            'apikey' => $api_key,
        ), 'https://api.twelvedata.com/quote' );
        $response = wp_remote_get( $url, array( 'timeout' => 8 ) );

        if ( is_wp_error( $response ) ) {
            continue;
        }

        $quote = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( ! is_array( $quote ) || isset( $quote['code'] ) || empty( $quote['close'] ) ) {
            continue;
        }

        $price = (float) $quote['close'];
        $change = isset( $quote['percent_change'] ) ? (float) $quote['percent_change'] : null;
        $decimals = in_array( $key, array( 'forex' ), true ) ? 4 : 2;
        $data['markets'][ $key ]['price'] = number_format_i18n( $price, $decimals );
        $data['markets'][ $key ]['change'] = $change;
        $successful++;
    }

    $chart_url = add_query_arg( array(
        'symbol'     => 'SPY',
        'interval'   => '30min',
        'outputsize' => 24,
        'order'      => 'ASC',
        'apikey'     => $api_key,
    ), 'https://api.twelvedata.com/time_series' );
    $chart_response = wp_remote_get( $chart_url, array( 'timeout' => 8 ) );

    if ( ! is_wp_error( $chart_response ) ) {
        $series = json_decode( wp_remote_retrieve_body( $chart_response ), true );
        if ( ! empty( $series['values'] ) && is_array( $series['values'] ) ) {
            $closes = array_map( static function( $item ) {
                return isset( $item['close'] ) ? (float) $item['close'] : 0.0;
            }, $series['values'] );
            $closes = array_values( array_filter( $closes ) );

            if ( count( $closes ) > 1 ) {
                $data['chart'] = $closes;
            }
        }
    }

    if ( $successful ) {
        $data['is_live'] = true;
        $data['status'] = 'live';
        $data['status_label'] = __( 'Cached live', 'tradepulse' );
        $data['status_message'] = __( 'Market data online', 'tradepulse' );
        $data['updated_at'] = current_time( 'timestamp' );
        set_transient( 'tradepulse_market_data_v2', $data, 30 * MINUTE_IN_SECONDS );
    } else {
        $data = tradepulse_public_market_data( $fallback );
        set_transient( 'tradepulse_market_data_v2', $data, 30 * MINUTE_IN_SECONDS );
    }

    return $data;
}

/**
 * Public no-key fallback: delayed ETF quotes, Bitcoin, and EUR/USD.
 */
function tradepulse_public_market_data( $data ) {
    $nasdaq_symbols = array( 'stocks' => 'SPY', 'gold' => 'GLD', 'oil' => 'USO' );
    $successful = 0;

    foreach ( $nasdaq_symbols as $key => $symbol ) {
        $response = wp_remote_get(
            'https://api.nasdaq.com/api/quote/' . rawurlencode( $symbol ) . '/info?assetclass=etf',
            array(
                'timeout' => 8,
                'headers' => array( 'User-Agent' => 'Mozilla/5.0', 'Accept' => 'application/json' ),
            )
        );
        if ( is_wp_error( $response ) ) {
            continue;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $quote = isset( $body['data']['primaryData'] ) ? $body['data']['primaryData'] : array();
        if ( empty( $quote['lastSalePrice'] ) ) {
            continue;
        }

        $price = (float) preg_replace( '/[^0-9.\-]/', '', $quote['lastSalePrice'] );
        $change = isset( $quote['percentageChange'] ) ? (float) preg_replace( '/[^0-9.\-]/', '', $quote['percentageChange'] ) : null;
        $data['markets'][ $key ]['price'] = number_format_i18n( $price, 2 );
        $data['markets'][ $key ]['change'] = $change;
        $successful++;
    }

    $crypto_response = wp_remote_get(
        'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&include_24hr_change=true',
        array( 'timeout' => 8, 'headers' => array( 'User-Agent' => 'TradePulse/1.1', 'Accept' => 'application/json' ) )
    );
    if ( ! is_wp_error( $crypto_response ) ) {
        $crypto = json_decode( wp_remote_retrieve_body( $crypto_response ), true );
        if ( isset( $crypto['bitcoin']['usd'] ) ) {
            $data['markets']['crypto']['price'] = number_format_i18n( (float) $crypto['bitcoin']['usd'], 2 );
            $data['markets']['crypto']['change'] = isset( $crypto['bitcoin']['usd_24h_change'] ) ? (float) $crypto['bitcoin']['usd_24h_change'] : null;
            $successful++;
        }
    }

    $chart_response = wp_remote_get(
        'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=1&interval=hourly',
        array( 'timeout' => 8, 'headers' => array( 'User-Agent' => 'TradePulse/1.1', 'Accept' => 'application/json' ) )
    );
    if ( ! is_wp_error( $chart_response ) ) {
        $chart = json_decode( wp_remote_retrieve_body( $chart_response ), true );
        if ( ! empty( $chart['prices'] ) ) {
            $data['chart'] = array_map( static function( $point ) {
                return isset( $point[1] ) ? (float) $point[1] : 0.0;
            }, $chart['prices'] );
            $data['primary_key'] = 'crypto';
        }
    }

    $end_date = gmdate( 'Y-m-d' );
    $start_date = gmdate( 'Y-m-d', strtotime( '-7 days' ) );
    $forex_response = wp_remote_get(
        'https://api.frankfurter.app/' . $start_date . '..' . $end_date . '?from=EUR&to=USD',
        array( 'timeout' => 8, 'headers' => array( 'User-Agent' => 'TradePulse/1.1', 'Accept' => 'application/json' ) )
    );
    if ( ! is_wp_error( $forex_response ) ) {
        $forex = json_decode( wp_remote_retrieve_body( $forex_response ), true );
        if ( ! empty( $forex['rates'] ) ) {
            $rates = array_values( $forex['rates'] );
            $latest = end( $rates );
            $previous = count( $rates ) > 1 ? $rates[ count( $rates ) - 2 ] : null;
            $latest_rate = isset( $latest['USD'] ) ? (float) $latest['USD'] : 0.0;
            $previous_rate = isset( $previous['USD'] ) ? (float) $previous['USD'] : 0.0;
            if ( $latest_rate ) {
                $data['markets']['forex']['price'] = number_format_i18n( $latest_rate, 4 );
                $data['markets']['forex']['change'] = $previous_rate ? ( ( $latest_rate - $previous_rate ) / $previous_rate ) * 100 : null;
                $successful++;
            }
        }
    }

    if ( $successful ) {
        $data['status'] = 'delayed';
        $data['status_label'] = __( 'Delayed', 'tradepulse' );
        $data['status_message'] = __( 'Public market data', 'tradepulse' );
        $data['updated_at'] = current_time( 'timestamp' );
    }

    return $data;
}

function tradepulse_market_change( $change ) {
    if ( null === $change ) {
        return '--';
    }

    return sprintf( '%s%.2f%%', $change >= 0 ? '+' : '', $change );
}

function tradepulse_market_change_class( $change ) {
    return null !== $change && $change < 0 ? ' is-negative' : '';
}

/**
 * Convert market values into an SVG path inside the homepage chart viewport.
 */
function tradepulse_market_chart_paths( $values, $width = 420, $height = 150, $padding = 8 ) {
    $values = array_values( array_map( 'floatval', (array) $values ) );
    if ( count( $values ) < 2 ) {
        return array( 'line' => '', 'area' => '', 'last_x' => 0, 'last_y' => 0 );
    }

    $min = min( $values );
    $max = max( $values );
    $range = max( $max - $min, 0.00001 );
    $step = ( $width - ( 2 * $padding ) ) / ( count( $values ) - 1 );
    $points = array();

    foreach ( $values as $index => $value ) {
        $x = $padding + ( $index * $step );
        $y = $height - $padding - ( ( $value - $min ) / $range * ( $height - ( 2 * $padding ) ) );
        $points[] = array( round( $x, 2 ), round( $y, 2 ) );
    }

    $line = 'M' . implode( ' L', array_map( static function( $point ) {
        return $point[0] . ' ' . $point[1];
    }, $points ) );
    $last = end( $points );
    $area = $line . ' L' . ( $width - $padding ) . ' ' . ( $height - $padding ) . ' L' . $padding . ' ' . ( $height - $padding ) . ' Z';

    return array( 'line' => $line, 'area' => $area, 'last_x' => $last[0], 'last_y' => $last[1] );
}

function tradepulse_register_market_data_route() {
    register_rest_route( 'tradepulse/v1', '/market-data', array(
        'methods'             => 'GET',
        'callback'            => 'tradepulse_market_data_response',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'tradepulse_register_market_data_route' );

function tradepulse_market_data_response() {
    $data = tradepulse_market_data();
    $data['chart_paths'] = tradepulse_market_chart_paths( $data['chart'] );
    $data['updated_label'] = $data['updated_at']
        ? sprintf( __( 'Updated %s', 'tradepulse' ), date_i18n( 'M j, H:i', $data['updated_at'] ) )
        : __( 'Market data unavailable', 'tradepulse' );

    foreach ( $data['markets'] as &$market ) {
        $market['change_label'] = tradepulse_market_change( $market['change'] );
        $market['is_negative'] = null !== $market['change'] && $market['change'] < 0;
    }

    return rest_ensure_response( $data );
}

function tradepulse_excerpt_length() {
    return 22;
}
add_filter( 'excerpt_length', 'tradepulse_excerpt_length' );

function tradepulse_excerpt_more() {
    return '...';
}
add_filter( 'excerpt_more', 'tradepulse_excerpt_more' );

function tradepulse_posted_meta() {
    $categories = get_the_category_list( esc_html__( ', ', 'tradepulse' ) );

    if ( $categories ) {
        echo '<span>' . wp_kses_post( $categories ) . '</span>';
    }

    echo '<span>' . esc_html( get_the_date() ) . '</span>';
}

// Use default WP image sizes for featured images
function tradepulse_featured_image( $post_id = null, $size = 'medium' ) {
    $post_id = $post_id ? $post_id : get_the_ID();

    if ( has_post_thumbnail( $post_id ) ) {
        // Automatically generates responsive srcset
        echo get_the_post_thumbnail( $post_id, $size );
        return;
    }

    $fallback = get_template_directory_uri() . '/assets/images/post-fallback.svg';
    echo '<img src="' . esc_url( $fallback ) . '" alt="' . esc_attr__( 'Trading market chart illustration', 'tradepulse' ) . '">';
}

function tradepulse_card( $post_id = null, $large = false ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $classes = 'post-card' . ( $large ? ' post-card--large' : '' );
    ?>
    <article <?php post_class( $classes, $post_id ); ?>>
        <a class="post-card__image" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
            <?php tradepulse_featured_image( $post_id, $large ? 'large' : 'medium' ); ?>
        </a>
        <div class="post-card__body">
            <div class="post-card__meta">
                <?php tradepulse_posted_meta(); ?>
            </div>
            <h3><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h3>
            <p><?php echo esc_html( get_the_excerpt( $post_id ) ); ?></p>
            <a class="read-more-link" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php esc_html_e( 'Read analysis', 'tradepulse' ); ?></a>
        </div>
    </article>
    <?php
}

/**
 * Remove redundant archive label prefixes from headings.
 */
function tradepulse_archive_title( $title ) {
    if ( is_category() ) {
        return single_cat_title( '', false );
    }

    if ( is_tag() ) {
        return single_tag_title( '', false );
    }

    if ( is_author() ) {
        return get_the_author();
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'tradepulse_archive_title' );
