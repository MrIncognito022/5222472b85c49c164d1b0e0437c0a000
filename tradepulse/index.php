<?php
/**
 * Main index template — displays a simple posts grid
 */

get_header();

?>

<main class="page-shell">
	<div class="wrap">
		<section class="section">
			<div class="grid grid--two">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						tradepulse_card();
					endwhile;

					the_posts_pagination();
				else :
					echo '<p>No posts found.</p>';
				endif;
				?>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();

