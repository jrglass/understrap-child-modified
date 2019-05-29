<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
<?php else : ?>
	<div class="col-lg-4 widget-area" id="right-sidebar" role="complementary">
<?php endif; ?>

    <div class="sidebar-banner banner-300x600 sticky-top">

        <!-- /1038303/STS_300_600 -->
        <div id='div-gpt-ad-1556225484509-0'>
            <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1556225484509-0'); });
            </script>
        </div>

    </div>

</div><!-- #right-sidebar -->
