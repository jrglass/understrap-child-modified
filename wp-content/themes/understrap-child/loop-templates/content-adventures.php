<?php
/**
 * Adventures Home/Landing Page
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php
$pagearray1 = array( 40, 36 );
$args = array(
    'post_type'         => 'page',
    'post__in'          => $pagearray1,
    'orderby'           => 'date',
    'order'             => 'ASC',
);

$av_query = new WP_Query( $args );

// The Loop
if ( $av_query->have_posts() ) : ?>

        <?php while ( $av_query->have_posts() ) : $av_query->the_post(); ?>

        <div class="featured-pages row">

            <div class="col-lg-6 page-image">

                <a href="<?php the_permalink(); ?>">

                    <?php the_post_thumbnail('main-thumbnail'); ?>

                </a>

            </div>

            <div class="col-lg-6 page-meta">

                <div class="grey-line"></div>

                <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

                <?php the_excerpt(); ?>

                <span class="author">Words</span>
                <span class="author-name"><?php the_field( 'author_name' ); ?></span>

            </div>

        </div>

        <?php endwhile; ?>

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
$pagearray2 = array( 43, 38);
$args2 = array(
    'post_type'         => 'page',
    'post__in'          => $pagearray2,
    'orderby'           => 'date',
    'order'             => 'DESC',
);

$av_query2 = new WP_Query( $args2 );

// The Loop
if ( $av_query2->have_posts() ) : ?>

        <?php while ( $av_query2->have_posts() ) : $av_query2->the_post(); ?>

        <div class="featured-pages row">

            <div class="col-lg-6 page-image">

                <a href="<?php the_permalink(); ?>">

                    <?php the_post_thumbnail('main-thumbnail'); ?>

                </a>

            </div>

            <div class="col-lg-6 page-meta">

                <div class="grey-line"></div>

                <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

                <?php the_excerpt(); ?>

                <span class="author">Words</span>
                <span class="author-name"><?php the_field( 'author_name' ); ?></span>

            </div>

        </div>

        <?php endwhile; ?>

	<?php
    /* Restore original Post Data */
	wp_reset_postdata();

else :

	// no posts found

endif; ?>