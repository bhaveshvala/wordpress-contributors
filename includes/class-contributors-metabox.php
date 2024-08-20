<?php
/**
 * Fired during Contributors Metabox.
 * 
 *
 * @since      1.0.0
 * @author     Bhavesh Vala
 */
class Contributors_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_contributors_metabox'));
        add_action('save_post', array($this, 'save_contributors_meta'));
    }

    public function add_contributors_metabox() {
        add_meta_box(
            'contributors_metabox',
            __('Contributors', 'contributors'),
            array($this, 'render_contributors_metabox'),
            'post',
            'side',
            'high'
        );
    }

    public function render_contributors_metabox($post) {
        $users = get_users();
        $selected_contributors = get_post_meta($post->ID, '_contributors', true) ?: array();

        foreach ($users as $user) {
            echo '<label>';
            echo '<input type="checkbox" name="contributors[]" value="' . esc_attr($user->ID) . '"' . checked(in_array($user->ID, $selected_contributors), true, false) . '>';
            echo esc_html($user->display_name);
            echo '</label><br>';
        }
    }

    public function save_contributors_meta($post_id) {
        if (isset($_POST['contributors'])) {
            $contributors = array_map('intval', $_POST['contributors']);
            update_post_meta($post_id, '_contributors', $contributors);
        } else {
            delete_post_meta($post_id, '_contributors');
        }
    }
}
