<?php
/**
 * Heli Home/Landing Page
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php $upload_dir = wp_upload_dir(); ?>

<?php
$args = array(
    'post_type'         => 'page',
    'category_name'     => 'heli',
    'orderby'           => 'date',
    'order'             => 'ASC',
);

$de_query = new WP_Query( $args );

// The Loop
if ( $de_query->have_posts() ) : ?>

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