<?php
/**
 * Template Name: Sweepstakes Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
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

    <?php if ( have_rows( 'hero_setup' ) ) : ?>

        <?php while ( have_rows( 'hero_setup' ) ) : the_row(); ?>

            <?php $hero_image = get_sub_field( 'hero_image' ); ?>

            <div class="home-intro row align-items-center" style="background-image: url('<?php echo $hero_image['url']; ?>'); background-position:<?php the_sub_field( 'hero_image_alignment' ); ?> !important;">

                <div class="col">

                    <h1 class="gilroy"><?php the_sub_field( 'headline' ); ?></h1>

                    <h3><?php the_sub_field( 'hero_sub-head' ); ?></h3>

                </div>

            </div>

            <div class="home-intro-small d-lg-none">

                <img src="<?php echo $hero_image['url']; ?>" />

            </div>

            <div class="col home-intro-small-meta d-lg-none">

                <h1 class="gilroy"><?php the_sub_field( 'headline' ); ?></h1>

                <h3><?php the_sub_field( 'hero_sub-head' ); ?></h3>

            </div>

        <?php endwhile; ?>

    <?php endif; ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-lg-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content-sweeps', 'page' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_template_part( 'sidebar-templates/sts-sidebar', 'right' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
