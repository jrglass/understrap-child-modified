<?php
/**
 * Template Name: Destinations Page
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

    <?php if ( have_rows( 'hero_setup' ) ) : ?>

        <?php while ( have_rows( 'hero_setup' ) ) : the_row(); ?>

            <?php $hero_image = get_sub_field( 'hero_image' ); ?>

            <div class="home-intro row align-items-center" style="background-image: url('<?php echo $hero_image['url']; ?>'); background-position:<?php the_sub_field( 'hero_image_alignment' ); ?> !important;">

                <div class="col">

                    <h1 class="gilroy"><?php the_sub_field( 'headline' ); ?></h1>

                    <h3><?php the_sub_field( 'hero_sub-head' ); ?></h3>

                    <?php
                    //vars
                    $hero_button_link = get_sub_field('hero_button_link');
                    $link_url = $hero_button_link['url'];
                    ?>
                    <a class="button" href="<?php echo esc_url($link_url); ?>"><?php the_sub_field( 'hero_button_text' ); ?></a>

                </div>

            </div>

            <div class="home-intro-small d-lg-none">

                <img src="<?php echo $hero_image['url']; ?>" />

            </div>

            <div class="home-intro-small-meta d-lg-none">

                <h1 class="gilroy"><?php the_sub_field( 'headline' ); ?></h1>

                <h3><?php the_sub_field( 'hero_sub-head' ); ?></h3>

                <?php
                //vars
                $hero_button_link = get_sub_field('hero_button_link');
                $link_url = $hero_button_link['url'];
                ?>
                <a class="button" href="<?php echo esc_url($link_url); ?>"><?php the_sub_field( 'hero_button_text' ); ?></a>

            </div>

        <?php endwhile; ?>

    <?php endif; ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'destinations' ); ?>

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
