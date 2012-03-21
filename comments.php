<?php
/**
 * Comments template file for WordPress theme Enough
 *
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Enough
 */
?>
<ul class="wp-list-comments"><?php wp_list_comments(); ?></ul>
<br class="clear vspacer-3" />
<div class="pagenate-comment-links">
<?php paginate_comments_links();?>
</div>
<?php comment_form();?>