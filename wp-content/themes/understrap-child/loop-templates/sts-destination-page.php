<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-header">

        <h2 class="gilroy"><?php the_title(); ?></h2>

        <?php if ( get_field( 'author_name' ) ): ?>

            <span class="author">Words:</span> <span class="author-name"><?php the_field( 'author_name' ); ?></span>

        <?php else :

            // Show No Author Name

        endif; ?>

        <div class="intro-copy">

            <p><?php the_field( 'intro_text' ); ?></p>

        </div>

    </div>

    <div class="entry-content">

        <?php if( is_page( array( 57, 480, 593 ) ) ) :

            // Remove stats from city destinations

        else :

            if ( have_rows( 'destination_stats' ) ) : ?>

                <div class="stats row">

                <?php while ( have_rows( 'destination_stats' ) ) : the_row(); ?>

                    <div class="stats-single col-xl-6">

                        <div class="row align-items-center">

                            <div class="col">

                                <h3>Details</h3>

                                <img class="stats-underline" src="<?php echo get_stylesheet_directory_uri(); ?>/img/stats-border.png" />

                                <?php //vars
                                $skiable_acres = get_sub_field( 'skiable_acres' );
                                $total_runs = get_sub_field( 'total_runs' );
                                $vertical_drop = get_sub_field( 'vertical_drop' );
                                $airport_miles = get_sub_field( 'distance_to_airport' );
                                $website = get_sub_field( 'website' );
                                ?>

                                <h4 class="gilroy-medium first">Skiable Acres:</h4> <h4 class="gilroy"><?php echo $skiable_acres; ?></h4>

                                <div class="hr-line"></div>

                                <h4 class="gilroy-medium">Runs:</h4> <h4 class="gilroy"><?php echo $total_runs; ?></h4>

                                <div class="hr-line"></div>

                                <h4 class="gilroy-medium">Vertical Drop:</h4> <h4 class="gilroy"><?php echo $vertical_drop; ?> feet</h4>

                                <div class="hr-line"></div>

                                <h4 class="gilroy-medium">Distance To Airport:</h4> <h4 class="gilroy"><?php echo $airport_miles; ?> miles</h4>

                                <div class="hr-line"></div>

                                <h4 class="gilroy-medium">Website:</h4> <h4 class="gilroy"><a href="http://<?php echo $website; ?>"><?php echo $website; ?></a></h4>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

                    <div class="col-xl-6 advertisement">

                        <div class="responsive-banner banner-570-365 ">
                            <!-- /1038303/STS_570_365 -->
                            <div id="div-gpt-ad-1556225518646-0">
                                <script>
                                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1556225518646-0'); });
                                </script>
                            </div>
                        </div>

                    </div>

                </div>

            <?php endif;

        endif; ?>

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<a class="footer-button" href="<?php echo get_site_url(); ?>/destinations">Back To Destinations</a>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
