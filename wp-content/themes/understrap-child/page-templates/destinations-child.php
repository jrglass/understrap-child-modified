<?php
/**
 * Template Name: Destinations Single Page
 *
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

    <?php $hero_image = get_field( 'hero_image' ); ?>

    <div class="home-intro">

        <img src="<?php echo $hero_image['url']; ?>" />

    </div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

            <div class="col-12 sweepstakes-promo">

                <hr class="sweepstakes">

                <div class="sweepstakes-link">

                    <a href="/sweepstakes">

                        <h3 class="gilroy">Enter Sweepstakes</h3>

                    </a>

                </div>

            </div>

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/sts-destination', 'page' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
