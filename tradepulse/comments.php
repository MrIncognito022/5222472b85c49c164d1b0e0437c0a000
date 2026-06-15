<?php
/**
 * Comments template.
 *
 * @package TradePulse
 */

if ( post_password_required() ) {
	return;
}

$comment_count = get_comments_number();
?>

<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<header class="comments-header">
			<div>
				<span class="comments-eyebrow"><?php esc_html_e( 'Market discussion', 'tradepulse' ); ?></span>
				<h2 class="comments-title">
					<?php
					printf(
						/* translators: %s: Number of comments. */
						esc_html( _n( '%s Comment', '%s Comments', $comment_count, 'tradepulse' ) ),
						esc_html( number_format_i18n( $comment_count ) )
					);
					?>
				</h2>
			</div>
			<a class="comments-jump" href="#respond"><?php esc_html_e( 'Join discussion', 'tradepulse' ); ?></a>
		</header>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 52,
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && $comment_count ) : ?>
		<p class="no-comments"><?php esc_html_e( 'This discussion is now closed.', 'tradepulse' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_container'      => 'comment-respond',
			'class_form'           => 'comment-form',
			'class_submit'         => 'submit comment-submit',
			'title_reply'          => __( 'Share your perspective', 'tradepulse' ),
			'title_reply_before'   => '<div class="comment-form-heading"><span class="comments-eyebrow">' . esc_html__( 'Add to the conversation', 'tradepulse' ) . '</span><h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h3><p>' . esc_html__( 'Keep it useful, respectful, and focused on the market.', 'tradepulse' ) . '</p></div>',
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'tradepulse' ) . '</p>',
			'label_submit'         => __( 'Post comment', 'tradepulse' ),
		)
	);
	?>
</section>
