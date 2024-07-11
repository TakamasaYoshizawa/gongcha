<?php //通常ページとAMPページの切り分け
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit;

if (!is_amp()) {
   get_header();
 } else {
   cocoon_template_part('tmp/amp-header');
 }
?>

<?php //投稿ページ内容
cocoon_template_part('tmp/single-contents'); ?>

<?php
$post_id = get_the_ID();
?>
<!-- <button id="favorite-button-<?php echo $post_id; ?>" class="favorite-button" data-post-id="<?php echo $post_id; ?>">Add to Favorites</button> -->

<!-- <?php 
global $wpdb;
$get_data = $wpdb->get_results('SELECT * FROM wp_gongcha ORDER BY id ASC');

foreach($get_data as $data){
 echo $data->id;
}

?> -->
<?php get_footer(); ?>

