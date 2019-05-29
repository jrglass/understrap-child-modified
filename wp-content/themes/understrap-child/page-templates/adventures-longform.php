<?php
/**
 * Template Name: Adventures Longform
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

    <?php $adventure_hero_image = get_field( 'adventure_hero_image' ); ?>

    <div class="adventures-hero d-none d-lg-block" style="background-image: url('<?php echo $adventure_hero_image['url']; ?>'); background-position: <?php the_field( 'hero_image_position' ); ?> !important;">

        <div class="overlay row align-items-center">

            <div class="col meta">

                <h1 class="gilroy"><?php the_title(); ?></h1>

                <div class="line-break"></div>

                <?php the_excerpt(); ?>

                <span class="author">Words:</span> <span class="author-name"><?php the_field( 'author_name' ); ?></span>

            </div>

        </div>

    </div>

    <div class="adventures-hero-small d-lg-none">

        <img src="<?php echo $adventure_hero_image['url']; ?>" />

    </div>

    <div class="col adventures-hero-small-meta d-lg-none">

        <h1 class="gilroy"><?php the_title(); ?></h1>

        <div class="line-break"></div>

        <?php the_excerpt(); ?>

        <span class="author">Words:</span> <span class="author-name"><?php the_field( 'author_name' ); ?></span>

    </div>

    <div class="responsive-banner banner-one">

        <!-- /1038303/STS_1195_300 -->
        <div id='div-gpt-ad-1556225236001-0'>
            <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1556225236001-0'); });
            </script>
        </div>

    </div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/sts-adventure', 'page' ); ?>

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
