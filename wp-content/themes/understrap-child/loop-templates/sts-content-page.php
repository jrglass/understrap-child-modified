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

    </div>

    <div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
