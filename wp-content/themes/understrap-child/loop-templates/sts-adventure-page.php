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

    <div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

    <footer class="entry-footer">

		<a class="footer-button" href="<?php echo get_site_url(); ?>/adventures">Back To Adventures</a>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
