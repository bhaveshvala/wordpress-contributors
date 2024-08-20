<?php
/**
 * Fired during Contributors_Unit_Tests and extends WP_UnitTestCase.
 * 
 *
 * @since      1.0.0
 * @author     Bhavesh Vala
 */
class Contributors_Unit_Tests extends WP_UnitTestCase {

    public function test_contributors_metabox() {
        $post_id = $this->factory->post->create();
        $user_ids = $this->factory->user->create_many(2);        
        update_post_meta($post_id, '_contributors', $user_ids);
        $this->assertEquals($user_ids, get_post_meta($post_id, '_contributors', true));
    }

    public function test_contributors_display() {
        $post_id = $this->factory->post->create();
        $user_id = $this->factory->user->create();        
        update_post_meta($post_id, '_contributors', array($user_id));        
        $post = get_post($post_id);
        $output = apply_filters('the_content', $post->post_content);
        $this->assertStringContainsString(get_author_posts_url($user_id), $output);
    }
}
