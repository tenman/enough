<?php
$enough_sidebar = enough_theme_option( 'enough_post_one_column_bottom_sidebar' );

if ( is_dynamic_sidebar() && 'yes' !== $enough_sidebar ) { ?>
	<nav class="enough-sidebar">
		<ul>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</ul>
	</nav>
<?php
} else {

	if ( is_super_admin() && ! is_page() && ! is_customize_preview() ) {

			echo '<nav class="enough-sidebar"><ul>';
			echo '<li><div class="link-to-sidebar-settings">';
			echo '<div>
						<h3>Sidebar</h3>
						<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Set Widgets', 'enough' ) . '</a><br />or</br />
						<a href="' . admin_url( 'customize.php?autofocus[control]=enough_post_one_column_bottom_sidebar' ) . '">' . __( 'Change 1 Columns', 'enough' ) . '</a>	
					</div>';

			echo '</div></li></ul></nav>';

	} 
	if ( is_super_admin() && ! is_page() && is_customize_preview() ) {
		echo '<nav class="enough-sidebar"><ul>';
			echo '<li><div class="link-to-sidebar-settings">';
			echo '<div class="fallback-navigation"><p class="alert">'.__('Sidebar Widget is not set. Please set the sidebar widget first in Dashboard / Appearance / Widgets', 'enough' ). '</p></div>';
			echo '<div class="fallback-navigation"><p class="alert">'.__('If you prefer 1 column layout, please set 1 column in \'Layout and Style of home page\'', 'enough' ). '</p></div>';

			echo '</div></li></ul></nav>';		
	}
}