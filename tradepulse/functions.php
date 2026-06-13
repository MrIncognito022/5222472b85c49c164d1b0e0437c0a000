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
}
add_action( 'wp_enqueue_scripts', 'tradepulse_assets' );

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

function tradepulse_fallback_menu() {
    $blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );

    echo '<ul id="primary-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'tradepulse' ) . '</a></li>';
    echo '<li><a href="' . esc_url( $blog_url ) . '">' . esc_html__( 'Blog', 'tradepulse' ) . '</a></li>';
    echo '</ul>';
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
