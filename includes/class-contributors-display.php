<?php
/**
 * Fired during Contributors Display.
 * 
 *
 * @since      1.0.0
 * @author     Bhavesh Vala
 */
class Contributors_Display {

    public function __construct() {
        add_filter('the_content', array($this, 'display_contributors_box'));
    }

    public function display_contributors_box($content) {
        global $post;
        $contributors = get_post_meta($post->ID, '_contributors', true);
        if (!empty($contributors)) {
            $content .= '<div class="contributors-box">';
            $content .= '<h3>' . __('Contributors', 'contributors') . '</h3>';
            foreach ($contributors as $user_id) {
                $user_info = get_userdata($user_id);
                $gravatar = get_avatar($user_id, 32);
                $author_link = get_author_posts_url($user_id);
                $content .= '<p><a href="' . esc_url($author_link) . '">' . $gravatar . esc_html($user_info->display_name) . '</a></p>';
            }
            $content .= '</div>';
        }
        return $content;
    }
}