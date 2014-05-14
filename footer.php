<?php
global $enough_current_theme_name;
?>
<footer role="contentinfo">
    <?php enough_prepend_footer(); ?>
    <address>
        <?php
        printf(
                '<small>&copy;%s %s <a href="%s" class="entry-rss">%s</a> and <a href="%s" class="comments-rss">%s</a></small>&nbsp;', date( "Y" ), get_bloginfo( 'name' ), get_bloginfo( 'rss2_url' ), __( "Entries <span>(RSS)</span>", "enough" ), get_bloginfo( 'comments_rss2_url' ), __( 'Comments <span>(RSS)</span>', "enough" )
        );
        if ( is_child_theme() ) {

            $enough_theme_name = 'Child theme ' . ucwords( $enough_current_theme_name ) . ' of ' . __( "enough Theme", "enough" );
        } else {

            $enough_theme_name = __( "enough Theme", "enough" );
        }

        printf( '&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;', 'http://www.tenman.info/wp3/enough', $enough_theme_name
        );
        ?>
    </address>
        <?php enough_append_footer(); ?>
</footer>
        <?php
        do_action( 'wp_print_footer_scripts' );
        do_action( 'wp_footer' );
        ?>
