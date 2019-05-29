<?php
/**
 * Partial template for content in home-page.php template
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php if ( have_rows( 'intro' ) ) : ?>

    <?php while ( have_rows( 'intro' ) ) : the_row(); ?>

        <div class="intro-text">

            <?php the_sub_field( 'intro_text' ); ?>

        </div>

    <?php endwhile;

endif; ?>

<?php if ( have_rows( 'sweetpstakes' ) ) : ?>

	<?php while ( have_rows( 'sweetpstakes' ) ) : the_row(); ?>

        <?php $background_image = get_sub_field( 'background_image' ); ?>

        <div class="sweepstakes-wrapper">

            <a href="<?php the_sub_field( 'link' ); ?>">

                <div class="sweepstakes-banner" style="background-image: url('<?php echo $background_image['url']; ?>')">

                    <h3 class="main-text gilroy"><?php the_sub_field( 'main_text' ); ?></h3>

                    <div class="overlay row align-items-center">

                        <h2 class="col gilroy"><?php the_sub_field( 'button_text' ); ?></h2>

                    </div>

                </div>

            </a>

        </div>

	<?php endwhile; ?>

<?php endif; ?>

<?php
$pagearray1 = array( 7, 34 );
$args = array(
    'post_type'         => 'page',
    'post__in'          => $pagearray1,
    'orderby'           => 'date',
    'order'             => 'ASC',
);

$hp_query = new WP_Query( $args );

// The Loop
if ( $hp_query->have_posts() ) : ?>

	<div class="featured-pages row">

        <?php while ( $hp_query->have_posts() ) : $hp_query->the_post(); ?>

        <div class="col-lg-6 single-page">

            <a href="<?php the_permalink(); ?>">

                <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'main-thumbnail'); ?>

                <div class="page-meta row align-items-center" style="background-image: url('<?php echo $featured_img_url ?>');">

                    <div class="col">

                        <h2 class="gilroy"><?php the_title(); ?></h2>

                    </div>

                </div>

            </a>

        </div>

        <?php endwhile; ?>

	</div>

	<?php /* Restore original Post Data */
	wp_reset_postdata();

else :

	// no posts found

endif; ?>

<div class="responsive-banner banner-two">

    <!-- /1038303/STS_1195_300 -->
    <div id='div-gpt-ad-1556225236001-1'>
        <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1556225236001-1'); });
        </script>
    </div>

</div>

<?php
$pagearray2 = array( 9, 70);
$args2 = array(
    'post_type'         => 'page',
    'post__in'          => $pagearray2,
    'orderby'           => 'date',
    'order'             => 'DESC',
);

$hp_query2 = new WP_Query( $args2 );

// The Loop
if ( $hp_query2->have_posts() ) : ?>

    <div class="featured-pages row">

        <?php while ( $hp_query2->have_posts() ) : $hp_query2->the_post(); ?>

        <div class="col-lg-6 single-page">

            <a href="<?php the_permalink(); ?>">

                <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'main-thumbnail'); ?>

                <div class="page-meta row align-items-center" style="background-image: url('<?php echo $featured_img_url ?>');">

                    <div class="col">

                        <h2 class="gilroy"><?php the_title(); ?></h2>

                    </div>

                </div>

            </a>

        </div>

        <?php endwhile; ?>

	</div>

	<?php
    /* Restore original Post Data */
	wp_reset_postdata();

else :

	// no posts found

endif; ?>