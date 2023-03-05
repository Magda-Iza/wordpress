<?php
/**
 * Plugin Name: Announcement Plugin
 * Plugin URI: https://example.com/plugins/Announcement Plugin/
 * Description: Add announcement at the top of each post.
 * Version: 1.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Izabela Rosińska i Magdalena Brejna
 * Author URI: https://github.com/Magda-Iza
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

function ap_admin_actions_register_menu() {
    add_options_page("Announcement Plugin", "Announcement Plugin", 'manage_options', "ap", "ap_admin_page");
}

add_action('admin_menu', 'ap_admin_actions_register_menu');

class Announcement {
    public $name;
    public $content;
    public $id;
    public $dateOfPost;
}

function ap_admin_page() {
    // get _POST variable from globals
    global $_POST;

    // process changes from form changing days
    if(isset($_POST['ap_do_change'])) {
        if($_POST['ap_do_change'] == 'Y') {
            $apDays = $_POST['ap_days'];
            echo '<div class="notice notice-success is dismissible"><p>Settings saved.</p></div>';
            update_option('ap_days', $apDays);
        }
    }

//    // process changes from form changing days
//    if(isset($_POST['ap_do_change'])) {
//        if($_POST['ap_do_change'] == 'Y') {
//            $apDays = $_POST['ap_days'];
//            echo '<div class="notice notice-success is dismissible"><p>Settings saved.</p></div>';
//            update_option('ap_days', $apDays);
//        }
//    }

    // read current option value
    $apDays = get_option('ap_days');
    $announcments = get_option('announcments');

//    // Get the current post's content
//    $content = get_post_field('post_content', $post_id);

    //display admin page
    ?>
    <div class="wrap">
        <h1>Announcement Plugin</h1>

        <br>
        <h2>Set period</h2>
        <form name="ap_form" method="post">
            <input type="hidden" name="ap_do_change" value="Y">
            <p class="form_text">Announcment is considered current for
                <input type="number" name="ap_days" min="0" max="30" value="<?php echo $apDays ?>"> days
                <span class="submit"><input type="submit" value="Submit"></span>
            </p>
        </form>

        <br>
        <form name="announcment_create_form" method="post">
            <h3>Create new announcment</h3>
            <form method="POST">
                <input type="hidden" name="announcment_date_of_post" value="<?php echo date('Ymd') ?>>

                <p class="form_text">Announcment name:
                    <input type="text" name="announcment_name">
                </p>
                
                <?php
                    // Set up the editor arguments
                    $editor_args = array(
                        'textarea_name' => 'my_editor',
                        'media_buttons' => true,
                        'textarea_rows' => 10,
                    );

                    // Output the editor
                    wp_editor('', 'my_editor_id', $editor_args);
                ?>
                <input type="submit" name="submit" value="Create">
            </form>
        </form>

        <br>
        <h2>Announcments</h2>
        <table id="announcments_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Id</th>
                    <th>Date of post</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($announcments)) {
                    for ($index = 0; $index < count($announcments); $index++) {
                        ?>
                        <tr>
                        <td value="<?php echo $announcments[$index]->id ?>"></td>
                        <td value="<?php echo $announcments[$index]->name ?>"></td>
                        <td value="<?php echo $announcments[$index]->dateOfPost ?>"></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

function ap_register_styles() {
    //register style
    wp_register_style('ap_styles', plugins_url('/css/style.css', __FILE__));
    //enable style (load in meta of html)
    wp_enqueue_style('ap_styles');
}

add_action('init', 'ap_register_styles');

?>