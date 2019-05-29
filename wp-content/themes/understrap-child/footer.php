<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

                    <div class="smm-logo">

                        <?php $upload_dir = wp_upload_dir(); ?>

                        <a href="https://stormmtn.com" target="_blank">

                            <img src="<?php echo $upload_dir['baseurl']; ?>/2019/04/smm-logo-white.png" />

                        </a>

                    </div>

                        <?php wp_nav_menu(
                            array(
                                'theme_location'  => 'footer',
                                'container_class' => '',
                                'container_id'    => 'footer-nav',
                                'menu_class'      => 'footer-menu',
                                'fallback_cb'     => '',
                                'menu_id'         => 'footer-menu',
                                'depth'           => 2,
                                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                            )
                        ); ?>

                    <div class="copyright">

                        <span>© Copyright - 2019 Storm Mountain Media - All Rights Reserved</span>

                    </div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

