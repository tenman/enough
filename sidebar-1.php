<?php if ( is_dynamic_sidebar() ) { ?>
	<nav class="enough-sidebar">
		<ul>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</ul>
	</nav>
<?php
} else {

	if ( is_user_logged_in() && ! is_page() ) {
		echo '<nav class="enough-sidebar"><ul>';
		echo '<li><div class="link-to-sidebar-settings">';
		echo '<div>
					<h3>Sidebar</h3>
					<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Set Widgets', 'enough' ) . '</a><br />or</br />
					<a href="' . admin_url( 'customize.php?autofocus[control]=enough_post_one_column_bottom_sidebar' ) . '">' . __( 'Change 1 Columns', 'enough' ) . '</a>	
				</div>';

		echo '</div></li></ul></nav>';
	}
}