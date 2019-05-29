<?php
/**
 * Destination Home/Landing Page
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php $upload_dir = wp_upload_dir(); ?>
<div class="map-wrapper">

     <a class="fancyboxforwp area-map" data-fancybox="gallery" href="<?php echo $upload_dir['baseurl']; ?>/2019/05/STS_Map_V2.png" target="_blank">

        <div class="map-banner" style="background-image: url('<?php echo $upload_dir['baseurl']; ?>/2019/05/SpoonGraphics-Topographic-Map-8.png')">

            <div class="overlay row align-items-center">

                <h2 class="col gilroy">Click here to view destination map</h2>

            </div>

        </div>

    </a>

</div>

<?php
$args = array(
    'post_type'         => 'page',
    'category_name'     => 'chile',
    'orderby'           => 'date',
    'order'             => 'ASC',
);

$de_query = new WP_Query( $args );

// The Loop
if ( $de_query->have_posts() ) : ?>

    <h1 class="country">Chile</h1>

	<div class="featured-pages row">

        <?php while ( $de_query->have_posts() ) : $de_query->the_post(); ?>

        <div class="col-lg-6 single-page">

            <a href="<?php the_permalink(); ?>">

                <?php the_post_thumbnail('main-thumbnail'); ?>

                <div class="page-meta">

                    <h2><?php the_title(); ?></h2>

                    <?php the_excerpt(); ?>

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
$args2 = array(
    'post_type'         => 'page',
    'category_name'     => 'argentina',
    'orderby'           => 'date',
    'order'             => 'DESC',
);

$de_query2 = new WP_Query( $args2 );

// The Loop
if ( $de_query2->have_posts() ) : ?>

    <h1 class="country">Argentina</h1>

    <div class="featured-pages row">

        <?php while ( $de_query2->have_posts() ) : $de_query2->the_post(); ?>

        <div class="col-lg-6 single-page">

            <a href="<?php the_permalink(); ?>">

                <?php the_post_thumbnail('main-thumbnail'); ?>

                <div class="page-meta">

                    <h2><?php the_title(); ?></h2>

                    <?php the_excerpt(); ?>

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