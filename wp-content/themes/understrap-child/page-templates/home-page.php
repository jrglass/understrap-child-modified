<?php
/**
 * Template Name: Home Page
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

    <?php if ( have_rows( 'intro' ) ) : ?>

	<?php while ( have_rows( 'intro' ) ) : the_row(); ?>

		<?php $background_image = get_sub_field( 'background_image' ); ?>
        <?php $intro_logo = get_sub_field( 'intro_logo' ); ?>
        <?php $upload_dir = wp_upload_dir(); ?>

        <div class="home-intro row align-items-start justify-content-center d-none d-lg-block" style="background-image: url('<?php echo $background_image['url']; ?>')">

            <div class="col hero-logo-wrapper">

                <img src="<?php echo $intro_logo['url']; ?>" />

            </div>

        </div>

        <div class="home-intro-small d-lg-none">

            <img class="intro-bg-small" src="<?php echo $background_image['url']; ?>" />

            <img class="intro-logo-small" src="<?php echo $intro_logo['url']; ?>" />

        </div>

	<?php endwhile; ?>

<?php endif; ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'home' ); ?>

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
