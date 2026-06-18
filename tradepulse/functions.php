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
 * Register reviews as simple editorial posts.
 */
function tradepulse_register_review_post_type() {
    register_post_type( 'review', array(
        'labels' => array(
            'name'               => __( 'Reviews', 'tradepulse' ),
            'singular_name'      => __( 'Review', 'tradepulse' ),
            'menu_name'          => __( 'Reviews', 'tradepulse' ),
            'add_new'            => __( 'Add New', 'tradepulse' ),
            'add_new_item'       => __( 'Add New Review', 'tradepulse' ),
            'edit_item'          => __( 'Edit Review', 'tradepulse' ),
            'new_item'           => __( 'New Review', 'tradepulse' ),
            'view_item'          => __( 'View Review', 'tradepulse' ),
            'all_items'          => __( 'All Reviews', 'tradepulse' ),
            'search_items'       => __( 'Search Reviews', 'tradepulse' ),
            'not_found'          => __( 'No reviews found.', 'tradepulse' ),
            'not_found_in_trash' => __( 'No reviews found in Trash.', 'tradepulse' ),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-welcome-write-blog',
        'has_archive'  => false,
        'rewrite'      => array( 'slug' => 'reviews', 'with_front' => false ),
        'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
    ) );
}
add_action( 'init', 'tradepulse_register_review_post_type' );

/**
 * Register coupon posts for deals and promo codes.
 */
function tradepulse_register_coupon_post_type() {
    register_post_type( 'coupon', array(
        'labels' => array(
            'name'               => __( 'Coupons', 'tradepulse' ),
            'singular_name'      => __( 'Coupon', 'tradepulse' ),
            'menu_name'          => __( 'Coupons', 'tradepulse' ),
            'add_new'            => __( 'Add New', 'tradepulse' ),
            'add_new_item'       => __( 'Add New Coupon', 'tradepulse' ),
            'edit_item'          => __( 'Edit Coupon', 'tradepulse' ),
            'new_item'           => __( 'New Coupon', 'tradepulse' ),
            'view_item'          => __( 'View Coupon', 'tradepulse' ),
            'all_items'          => __( 'All Coupons', 'tradepulse' ),
            'search_items'       => __( 'Search Coupons', 'tradepulse' ),
            'not_found'          => __( 'No coupons found.', 'tradepulse' ),
            'not_found_in_trash' => __( 'No coupons found in Trash.', 'tradepulse' ),
        ),
        'public'       => true,
        'show_in_rest' => false,
        'menu_icon'    => 'dashicons-tickets-alt',
        'has_archive'  => false,
        'rewrite'      => array( 'slug' => 'coupon', 'with_front' => false ),
        'supports'     => array( 'title', 'thumbnail', 'revisions' ),
    ) );
}
add_action( 'init', 'tradepulse_register_coupon_post_type' );

function tradepulse_coupon_fields() {
    return array(
        '_tradepulse_coupon_brand'     => array(
            'label'       => __( 'Brand / Firm Name', 'tradepulse' ),
            'type'        => 'text',
            'required'    => true,
            'placeholder' => __( 'E8 Markets', 'tradepulse' ),
            'help'        => __( 'This appears as the small brand label on the coupon card.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_code'      => array(
            'label'       => __( 'Coupon Code', 'tradepulse' ),
            'type'        => 'text',
            'required'    => true,
            'placeholder' => __( 'MATCH30', 'tradepulse' ),
            'help'        => __( 'This is revealed in the popup and copy button.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_discount'  => array(
            'label'       => __( 'Discount', 'tradepulse' ),
            'type'        => 'text',
            'required'    => true,
            'placeholder' => __( '30%', 'tradepulse' ),
            'help'        => __( 'Write only the discount value, for example 30% or 10%.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_url'       => array(
            'label'       => __( 'Offer Website URL', 'tradepulse' ),
            'type'        => 'url',
            'required'    => true,
            'placeholder' => 'https://example.com',
            'help'        => __( 'The popup button links to this website.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_image_url' => array(
            'label'       => __( 'Logo / Coupon Image URL', 'tradepulse' ),
            'type'        => 'url',
            'required'    => false,
            'placeholder' => 'https://example.com/logo.png',
            'help'        => __( 'Optional. You can also use the Featured Image box.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_expires'   => array(
            'label'       => __( 'Expiry Text', 'tradepulse' ),
            'type'        => 'text',
            'required'    => false,
            'placeholder' => __( 'No Expires', 'tradepulse' ),
            'help'        => __( 'Shown below the coupon button.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_rating'    => array(
            'label'       => __( 'Rating', 'tradepulse' ),
            'type'        => 'number',
            'required'    => false,
            'placeholder' => '4.7',
            'help'        => __( 'Optional rating from 0 to 5.', 'tradepulse' ),
        ),
        '_tradepulse_coupon_details'   => array(
            'label'       => __( 'Popup Details', 'tradepulse' ),
            'type'        => 'textarea',
            'required'    => true,
            'placeholder' => __( 'Describe the offer, limits, account type, or important conditions.', 'tradepulse' ),
            'help'        => __( 'This text appears inside the coupon popup.', 'tradepulse' ),
        ),
    );
}

function tradepulse_coupon_meta_keys() {
    $keys = array();

    foreach ( tradepulse_coupon_fields() as $key => $field ) {
        $keys[ $key ] = $field['type'];
    }

    return $keys;
}

function tradepulse_coupon_meta_box() {
    add_meta_box(
        'tradepulse_coupon_details',
        __( 'Coupon Information - Required Fields', 'tradepulse' ),
        'tradepulse_coupon_meta_box_render',
        'coupon',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tradepulse_coupon_meta_box' );

function tradepulse_coupon_meta_box_render( $post ) {
    wp_nonce_field( 'tradepulse_coupon_meta_save', 'tradepulse_coupon_meta_nonce' );
    ?>
    <div class="tradepulse-coupon-admin-fields">
        <p class="tradepulse-coupon-admin-fields__note">
            <?php esc_html_e( 'Fill these fields, publish the coupon, and it will appear automatically on the Coupon Code page. Use the post title as the main coupon title.', 'tradepulse' ); ?>
        </p>
        <?php foreach ( tradepulse_coupon_fields() as $key => $field ) : ?>
            <?php
            $value       = get_post_meta( $post->ID, $key, true );
            $type        = $field['type'];
            $is_required = ! empty( $field['required'] );
            ?>
            <div class="tradepulse-coupon-admin-field<?php echo $is_required ? ' is-required' : ''; ?><?php echo 'textarea' === $type ? ' is-wide' : ''; ?>">
                <label for="<?php echo esc_attr( $key ); ?>">
                    <?php echo esc_html( $field['label'] ); ?>
                    <?php if ( $is_required ) : ?>
                        <span><?php esc_html_e( 'Required', 'tradepulse' ); ?></span>
                    <?php endif; ?>
                </label>
                <?php if ( 'textarea' === $type ) : ?>
                    <textarea id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" rows="5" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" <?php echo $is_required ? 'required' : ''; ?>><?php echo esc_textarea( $value ); ?></textarea>
                <?php else : ?>
                    <input
                        id="<?php echo esc_attr( $key ); ?>"
                        name="<?php echo esc_attr( $key ); ?>"
                        type="<?php echo esc_attr( 'number' === $type ? 'number' : $type ); ?>"
                        value="<?php echo esc_attr( $value ); ?>"
                        placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"
                        <?php echo 'number' === $type ? 'min="0" max="5" step="0.1"' : ''; ?>
                        <?php echo $is_required ? 'required' : ''; ?>
                    >
                <?php endif; ?>
                <small><?php echo esc_html( $field['help'] ); ?></small>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function tradepulse_save_coupon_meta( $post_id ) {
    if ( ! isset( $_POST['tradepulse_coupon_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tradepulse_coupon_meta_nonce'] ) ), 'tradepulse_coupon_meta_save' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    foreach ( tradepulse_coupon_meta_keys() as $key => $type ) {
        $value = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';

        if ( 'url' === $type ) {
            $value = esc_url_raw( $value );
        } elseif ( 'textarea' === $type ) {
            $value = sanitize_textarea_field( $value );
        } else {
            $value = sanitize_text_field( $value );
        }

        if ( '' === $value ) {
            delete_post_meta( $post_id, $key );
        } else {
            update_post_meta( $post_id, $key, $value );
        }
    }
}
add_action( 'save_post_coupon', 'tradepulse_save_coupon_meta' );

function tradepulse_coupon_title_placeholder( $title, $post ) {
    if ( 'coupon' === $post->post_type ) {
        return __( 'Enter coupon title, e.g. Get 30% off E8 Markets plans', 'tradepulse' );
    }

    return $title;
}
add_filter( 'enter_title_here', 'tradepulse_coupon_title_placeholder', 10, 2 );

function tradepulse_coupon_admin_assets( $hook ) {
    $screen = get_current_screen();

    if ( ! $screen || 'coupon' !== $screen->post_type || ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
        return;
    }
    ?>
    <style>
        .tradepulse-coupon-admin-fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            padding: 6px 0 4px;
        }

        .tradepulse-coupon-admin-fields__note {
            grid-column: 1 / -1;
            margin: 0;
            padding: 12px 14px;
            border-left: 4px solid #00a884;
            background: #f0fbf8;
            color: #1d3f3a;
            font-weight: 600;
        }

        .tradepulse-coupon-admin-field {
            padding: 14px;
            border: 1px solid #dcdcde;
            border-radius: 6px;
            background: #fff;
        }

        .tradepulse-coupon-admin-field.is-required {
            border-color: #00a884;
        }

        .tradepulse-coupon-admin-field label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
            color: #1d2327;
            font-weight: 700;
        }

        .tradepulse-coupon-admin-field label span {
            padding: 2px 7px;
            border-radius: 999px;
            color: #007a60;
            background: #e4f8f3;
            font-size: 11px;
            line-height: 1.5;
        }

        .tradepulse-coupon-admin-field input,
        .tradepulse-coupon-admin-field textarea {
            width: 100%;
            max-width: none;
        }

        .tradepulse-coupon-admin-field small {
            display: block;
            margin-top: 7px;
            color: #646970;
        }

        .tradepulse-coupon-admin-field.is-wide {
            grid-column: 1 / -1;
        }

        @media (max-width: 782px) {
            .tradepulse-coupon-admin-fields {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('post');

            if (!form) {
                return;
            }

            var title = document.getElementById('title');

            if (title) {
                title.required = true;
            }

            form.addEventListener('submit', function (event) {
                var firstInvalid = form.querySelector('.tradepulse-coupon-admin-field [required]:invalid, #title:invalid');

                if (!firstInvalid) {
                    return;
                }

                event.preventDefault();
                firstInvalid.focus();
                window.alert('<?php echo esc_js( __( 'Please fill all required coupon fields before publishing.', 'tradepulse' ) ); ?>');
            });
        });
    </script>
    <?php
}
add_action( 'admin_enqueue_scripts', 'tradepulse_coupon_admin_assets' );

function tradepulse_create_coupon_code_page() {
    if ( get_option( 'tradepulse_coupon_code_page_created' ) ) {
        return;
    }

    if ( ! get_page_by_path( 'coupon-code' ) ) {
        wp_insert_post( array(
            'post_title'  => __( 'Coupon Code', 'tradepulse' ),
            'post_name'   => 'coupon-code',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ) );
    }

    update_option( 'tradepulse_coupon_code_page_created', '1' );
}
add_action( 'admin_init', 'tradepulse_create_coupon_code_page' );

function tradepulse_maybe_flush_coupon_rewrites() {
    if ( '1.0' === get_option( 'tradepulse_coupon_rewrite_version' ) ) {
        return;
    }

    flush_rewrite_rules();
    update_option( 'tradepulse_coupon_rewrite_version', '1.0' );
}
add_action( 'admin_init', 'tradepulse_maybe_flush_coupon_rewrites' );

/**
 * Store contact form messages privately in the dashboard.
 */
function tradepulse_register_contact_message_post_type() {
    register_post_type( 'contact_message', array(
        'labels' => array(
            'name'          => __( 'Contact Messages', 'tradepulse' ),
            'singular_name' => __( 'Contact Message', 'tradepulse' ),
            'menu_name'     => __( 'Contact Messages', 'tradepulse' ),
            'all_items'     => __( 'All Messages', 'tradepulse' ),
            'view_item'     => __( 'View Message', 'tradepulse' ),
            'search_items'  => __( 'Search Messages', 'tradepulse' ),
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-email-alt2',
        'capability_type'     => 'post',
        'exclude_from_search' => true,
        'supports'            => array( 'title', 'editor', 'custom-fields' ),
    ) );
}
add_action( 'init', 'tradepulse_register_contact_message_post_type' );

/**
 * Handle front-end contact form submissions.
 */
function tradepulse_handle_contact_form() {
    $redirect = wp_get_referer() ? wp_get_referer() : home_url( '/contact-us/' );

    if ( ! isset( $_POST['tradepulse_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tradepulse_contact_nonce'] ) ), 'tradepulse_contact_submit' ) ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect ) . '#contact-form' );
        exit;
    }

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if (
        '' === $name ||
        '' === $email ||
        '' === $message ||
        ! is_email( $email ) ||
        strlen( $name ) > 80 ||
        strlen( $email ) > 120 ||
        strlen( $message ) > 3000
    ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect ) . '#contact-form' );
        exit;
    }

    $contact_page = get_page_by_path( 'contact-us' );
    $comment_id = wp_insert_comment( array(
        'comment_post_ID'      => $contact_page ? (int) $contact_page->ID : 0,
        'comment_author'       => $name,
        'comment_author_email' => $email,
        'comment_content'      => $message,
        'comment_type'         => 'comment',
        'comment_approved'     => 0,
        'comment_agent'        => 'TradePulse contact form',
    ) );

    if ( ! $comment_id ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect ) . '#contact-form' );
        exit;
    }

    wp_mail(
        get_option( 'admin_email' ),
        sprintf( __( 'New TradePulse contact message from %s', 'tradepulse' ), $name ),
        sprintf( "Name: %s\nEmail: %s\n\n%s", $name, $email, $message ),
        array( 'Reply-To: ' . $name . ' <' . $email . '>' )
    );

    wp_safe_redirect( add_query_arg( 'contact_status', 'success', $redirect ) . '#contact-form' );
    exit;
}
add_action( 'admin_post_tradepulse_contact_submit', 'tradepulse_handle_contact_form' );
add_action( 'admin_post_nopriv_tradepulse_contact_submit', 'tradepulse_handle_contact_form' );

function tradepulse_maybe_flush_review_rewrites() {
    if ( '1.0' === get_option( 'tradepulse_simple_review_rewrite_version' ) ) {
        return;
    }

    flush_rewrite_rules();
    update_option( 'tradepulse_simple_review_rewrite_version', '1.0' );
}
add_action( 'admin_init', 'tradepulse_maybe_flush_review_rewrites' );

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
    $theme_version = wp_get_theme()->get( 'Version' );
    $style_path    = get_stylesheet_directory() . '/style.css';
    $script_path   = get_template_directory() . '/assets/js/theme.js';
    $style_version = file_exists( $style_path ) ? filemtime( $style_path ) : $theme_version;
    $script_version = file_exists( $script_path ) ? filemtime( $script_path ) : $theme_version;

    wp_enqueue_style( 'tradepulse-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'tradepulse-style', get_stylesheet_uri(), array( 'tradepulse-fonts' ), $style_version );
    wp_enqueue_script( 'tradepulse-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $script_version, true );
    wp_localize_script( 'tradepulse-theme', 'tradepulseMarket', array(
        'endpoint' => esc_url_raw( rest_url( 'tradepulse/v1/market-data' ) ),
    ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
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

function tradepulse_review_card( $post_id = null ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    ?>
    <article <?php post_class( 'post-card review-post-card', $post_id ); ?>>
        <a class="post-card__image" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
            <?php tradepulse_featured_image( $post_id, 'medium' ); ?>
        </a>
        <div class="post-card__body">
            <div class="post-card__meta">
                <span><?php esc_html_e( 'Prop Firm Review', 'tradepulse' ); ?></span>
                <span><?php echo esc_html( get_the_date( '', $post_id ) ); ?></span>
            </div>
            <h3><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h3>
            <p><?php echo esc_html( get_the_excerpt( $post_id ) ); ?></p>
            <a class="read-more-link" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php esc_html_e( 'Read review', 'tradepulse' ); ?></a>
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
