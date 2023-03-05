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

// Define the table name
$table_name = $wpdb->prefix . 'announcements_table';

function ap_admin_actions_register_menu() {
    add_options_page("Announcement Plugin", "Announcement Plugin", 'manage_options', "ap", "ap_admin_page");
}

add_action('admin_menu', 'ap_admin_actions_register_menu');

function create_announcements_table() {
    global $wpdb;
    global $table_name;

    // Build the SQL query to check if the table exists
    $query = "SHOW TABLES LIKE '$table_name'";

    // Execute the query and get the results
    $results = $wpdb->get_results($query);

    // Check if any rows were returned
    if(count($results) > 0) {
        echo 'Table exists.';
    } else {
        // Create table with announcements
        $query = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        content text,
        date_post date,
        PRIMARY KEY (id)
        );";

        $wpdb->query($query);
    }
}

function get_announcements() {
    global $wpdb;
    global $table_name;

    // Build the SQL query to select all rows from the table
    $query = "SELECT * FROM $table_name";

    $results = $wpdb->get_results($query, ARRAY_A);

    return $results;
}

function delete_announcement($id_announcement) {
    global $wpdb;
    global $table_name;

    $wpdb->delete($table_name, array('id' => $id_announcement));
}

function ap_admin_page() {
    // get _POST variable from globals
    global $_POST;

    // Get a reference to the global $wpdb object
    global $wpdb;

    // Get global table name
    global $table_name;

    $announcment_type = 'create';
    $announcment_name = '';
    $announcment_content = '';

    // process changes from form changing days
    if(isset($_POST['ap_do_change'])) {
        if($_POST['ap_do_change'] == 'Y') {
            $apDays = $_POST['ap_days'];
            echo '<div class="notice notice-success is dismissible"><p>Settings saved.</p></div>';
            update_option('ap_days', $apDays);
        }
    }

    // create new announcement
    if(isset($_POST['ap_announcment_create'])) {
        if($_POST['ap_announcment_create'] == 'Y') {
            // Define the data to insert
            $data = array(
                'name' => $_POST['announcment_name'],
                'content' => $_POST['my_editor_id'],
                'date_post' => date('Ymd')
            );

            // Execute the insert query
            $wpdb->insert($table_name, $data);
        }
    }

    // delete announcement
    if(isset($_POST['delete_change'])) {
        delete_announcement($_POST['delete_change']);
    }

    // delete announcement
    if(isset($_POST['edit_change'])) {

        foreach($announcments as $row) {
            if ($row['id'] == $_POST['edit_change']) {
                $announcment_type =  'edit';
                $announcment_name = $row['name'];
                $announcment_content = '';
            }
            $row['name']
            <$row['date_post']

        }

    }

    // read current option value
    $apDays = get_option('ap_days');
    $announcments = get_announcements();

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
                <input type="hidden" name="ap_announcment_create" value="Y">

                <p class="form_text">Announcment name:
                    <input type="text" name="announcment_name" required>
                </p>
                
                <?php
                    // Set up the editor arguments
                    $editor_args = array(
                        'textarea_name' => 'my_editor_id',
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
        <table id="announcments_table" class="ap_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Date of post</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($announcments as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['date_post'] ?></td>
                            <td>
                                <form name="edit_form" method="post">
                                    <input type="hidden" name="edit_change" value="<?php echo $row['id'] ?>">
                                    <span class="submit"><input type="submit" value="Edit"></span>
                                </form>
                            </td>
                            <td>
                                <form name="delete_form" method="post">
                                    <input type="hidden" name="delete_change" value="<?php echo $row['id'] ?>">
                                    <span class="submit"><input type="submit" value="Delete"></span>
                                </form>
                            </td>
                        </tr>
                        <?php
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