<?php
/**
 * Plugin Name: Custom Meta Plugin
 * Description: Inserts custom meta details and HTML into the header and footer sections of posts and pages.
 * Version: 1.1
 * Author: Your Name
 */

// Add settings page in the admin menu
add_action('admin_menu', 'cmp_add_admin_menu');
add_action('admin_init', 'cmp_settings_init');

function cmp_add_admin_menu() {
    add_menu_page('Custom Meta Plugin', 'Custom Meta Plugin', 'manage_options', 'custom_meta_plugin', 'cmp_options_page');
}

function cmp_settings_init() {
    register_setting('pluginPage', 'cmp_settings');

    add_settings_section(
        'cmp_pluginPage_section',
        __('Global Meta Details', 'wordpress'),
        'cmp_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'cmp_keywords',
        __('Global Keywords', 'wordpress'),
        'cmp_keywords_render',
        'pluginPage',
        'cmp_pluginPage_section'
    );

    add_settings_field(
        'cmp_description',
        __('Global Description', 'wordpress'),
        'cmp_description_render',
        'pluginPage',
        'cmp_pluginPage_section'
    );

    add_settings_field(
        'cmp_footer_html',
        __('Global Footer HTML', 'wordpress'),
        'cmp_footer_html_render',
        'pluginPage',
        'cmp_pluginPage_section'
    );
}

function cmp_keywords_render() {
    $options = get_option('cmp_settings');
    ?>
    <input type='text' name='cmp_settings[cmp_keywords]' value='<?php echo $options['cmp_keywords']; ?>'>
    <?php
}

function cmp_description_render() {
    $options = get_option('cmp_settings');
    ?>
    <textarea name='cmp_settings[cmp_description]'><?php echo $options['cmp_description']; ?></textarea>
    <?php
}

function cmp_footer_html_render() {
    $options = get_option('cmp_settings');
    ?>
    <textarea name='cmp_settings[cmp_footer_html]'><?php echo $options['cmp_footer_html']; ?></textarea>
    <?php
}

function cmp_settings_section_callback() {
    echo __('Set global meta details and footer HTML that will be used if no custom data is provided for individual pages or posts.', 'wordpress');
}

function cmp_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Custom Meta Plugin</h2>
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}

// Add action to insert custom meta into the header
add_action('wp_head', 'insert_custom_meta');

// Add action to insert custom HTML into the footer
add_action('wp_footer', 'insert_custom_footer_html');

// Function to insert meta into the header
function insert_custom_meta() {
    if (is_singular()) {
        $keywords = get_post_meta(get_the_ID(), '_custom_keywords', true);
        $description = get_post_meta(get_the_ID(), '_custom_description', true);

        if (!$keywords) {
            $options = get_option('cmp_settings');
            $keywords = $options['cmp_keywords'];
        }

        if (!$description) {
            $options = get_option('cmp_settings');
            $description = $options['cmp_description'];
        }

        if ($keywords) {
            echo '<meta name="keywords" content="' . esc_attr($keywords) . '">';
        }

        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">';
        }
    }
}

// Function to insert custom HTML into the footer
function insert_custom_footer_html() {
    if (is_singular()) {
        $custom_html = get_post_meta(get_the_ID(), '_custom_footer_html', true);

        if (!$custom_html) {
            $options = get_option('cmp_settings');
            $custom_html = $options['cmp_footer_html'];
        }

        if ($custom_html) {
            echo $custom_html;
        }
    }
}

// Add custom fields for individual posts/pages
add_action('add_meta_boxes', 'cmp_add_custom_meta_box');
add_action('save_post', 'cmp_save_custom_meta_box_data');

function cmp_add_custom_meta_box() {
    add_meta_box(
        'cmp_custom_meta',
        __('Custom Meta Details', 'wordpress'),
        'cmp_custom_meta_box_html',
        ['post', 'page'],
        'normal',
        'high'
    );
}

function cmp_custom_meta_box_html($post) {
    $keywords = get_post_meta($post->ID, '_custom_keywords', true);
    $description = get_post_meta($post->ID, '_custom_description', true);
    $footer_html = get_post_meta($post->ID, '_custom_footer_html', true);
    ?>
    <p>
        <label for="cmp_keywords"><?php _e('Keywords', 'wordpress'); ?></label>
        <input type="text" id="cmp_keywords" name="cmp_keywords" value="<?php echo esc_attr($keywords); ?>">
    </p>
    <p>
        <label for="cmp_description"><?php _e('Description', 'wordpress'); ?></label>
        <textarea id="cmp_description" name="cmp_description"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <p>
        <label for="cmp_footer_html"><?php _e('Footer HTML', 'wordpress'); ?></label>
        <textarea id="cmp_footer_html" name="cmp_footer_html"><?php echo esc_textarea($footer_html); ?></textarea>
    </p>
    <?php
}

function cmp_save_custom_meta_box_data($post_id) {
    if (array_key_exists('cmp_keywords', $_POST)) {
        update_post_meta($post_id, '_custom_keywords', $_POST['cmp_keywords']);
    }

    if (array_key_exists('cmp_description', $_POST)) {
        update_post_meta($post_id, '_custom_description', $_POST['cmp_description']);
    }

    if (array_key_exists('cmp_footer_html', $_POST)) {
        update_post_meta($post_id, '_custom_footer_html', $_POST['cmp_footer_html']);
    }
}
?>
