<?php
global $enough_wp_version, $enough_post_format_functionality;

if ( is_tax() or is_front_page() ) {

    $image                  = '';
    $enough_link            = get_permalink();
    $content                = get_the_content();
    $enough_video_thumbnail = '';

    if ( preg_match( '|http://youtu.be/([A-z0-9]+)|', $content, $regs ) ) {

        $enough_video = $regs[ 1 ];
    } else {
        $enough_video = '';
    }
    ?>			
    <article <?php post_class(); ?> <?php if ( is_single() ) {
        printf( 'role="%1$s"', 'main' );
    } ?> >
        <?php
        
        if ( ! post_password_required( ) && is_singular( ) ) {
            echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail() );
        }
        enough_article_title();

        $enough_post_format = get_post_format();

        if ( is_front_page() ) {

            if ( $enough_post_format === false ) {

                enough_posted_on( $diaplay = true );
            } else {

                enough_post_format_posted_on();
            }
        }
        ?>
        <br class="clear vspacer-1" />
        <div class="entry-content">
            <?php
            if ( !empty( $enough_video ) ) {

                $enough_video_thumbnail = 'http://i3.ytimg.com/vi/' . $enough_video . '/mqdefault.jpg';
                $enough_video_html      = '<div style="text-align:center;"><a href="%1$s" ><img src="%2$s" /></a></div>';

                printf( $enough_video_html, esc_url( $enough_link ), esc_url( $enough_video_thumbnail )
                );
            } else {

                enough_the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough' ) );
            }
            ?>
        </div>
        <br class="clear vspacer-1" />
        <?php
        enough_post_format_posted_in();
        ?>
        <br class="clear"  />
        <?php
        enough_prev_next_post( 'nav-below' );
        ?>		
        <br class="clear"  />
    </article>		
    <?php
} else {
    ?>
    <article <?php post_class(); ?> <?php if ( is_single() ) {
        printf( 'role="%1$s"', 'main' );
    } ?> >
        <?php
        enough_article_title();

        $enough_post_format = get_post_format();

        if ( $enough_post_format === false ) {
            enough_posted_on( $diaplay = true );
        } else {
            enough_post_format_posted_on();
        }
        if ( !post_password_required() ) {
            echo apply_filters( 'enough_post_thumbnail', get_the_post_thumbnail() );
        }
        ?>
        <div class="entry-content">
            <?php
            enough_the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'enough' ) );
            ?>
        </div>
        <br class="clear vspacer-1" />
        <?php
        enough_attachment_navigation();

        wp_link_pages( array(
            'before'      => '<div class="wp-link-pages">',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>'
        ) );

        if ( $enough_post_format === false ) {
            enough_posted_in();
        } else {
            enough_post_format_posted_in();
        }
        ?>
        <br class="clear"  />
        <?php
        enough_prev_next_post( 'nav-below' );

        if ( is_singular() ) {
            comments_template();
        } else {
            ?>
            <br class="clear"  />
            <?php
        }
        ?>
    </article>
        <?php
    }
    ?>