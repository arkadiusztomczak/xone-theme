<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package X-One_Blog
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer xoneFooter">
        <div class="footerInner">

        <?php
        wp_nav_menu( array( 'theme_location' => 'footer-menu' ) );
?>
            <div class="footerSocials">
                <?php
        $menu_name = 'footer-menu';
        $locations = get_nav_menu_locations();
        $menu_id = $locations[ $menu_name ] ;
        $menu = wp_get_nav_menu_object($menu_id);
        $show = get_field('show_social_links', $menu);
        if($show[0] == "show"){
            echo get_field('follow_text', $menu);
            $showed = get_field('SocialButtons', $menu);
            if(in_array('facebook', $showed)){
                echo "<a href=".get_field('facebook_link', $menu)."><div class='xoneSocials facebook'></div></a>";
            }
            if(in_array('twitter', $showed)){
                echo "<a href=".get_field('twitter_link', $menu)."><div class='xoneSocials twitter'></div></a>";
            }
            if(in_array('instagram', $showed)){
                echo "<a href=".get_field('instagram_link', $menu)."><div class='xoneSocials instagram'></div></a>";
            }
        }

        ?>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
