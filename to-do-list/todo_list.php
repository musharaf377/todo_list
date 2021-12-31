<?php
/*
   Plugin Name: Simple To Do List
   Plugin URI: http://
   description: A simple to do list WordPress Plugin
   Version: 1.0
   Author: MD. Musharaf Hossain
   Author URI: http://musharaf.com
   License: GPL2
   */

define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
//    echo PLUGIN_DIR_URI;
//    die();

function add_custom_menu()
{
    add_menu_page(
        'To Do List',
        'To Do List',
        'manage_options',
        'todo_list',
        'all_items_func',
        'dashicons-admin-plugins',
        61
    );

    add_submenu_page('todo_list', 'All Items', 'All Items', 'manage_options', 'todo_list', 'all_items_func');

    add_submenu_page('todo_list', 'Add New', 'Add New', 'manage_options', 'add_new_task', 'render_add_new_page');
}
add_action('admin_menu', 'add_custom_menu');

function handle_add_new_task_form()
{
    if (isset($_POST['add_new_task'])) {
        $name = $_POST['task_name'];
        $short_desc = $_POST['short_desc'];

        global $wpdb;
        $table_name = $wpdb->prefix . 'todolist';

        $inserted = $wpdb->insert(
            $table_name,
            array(
                'task_name' => $name,
                'short_desc' => $short_desc,
            ),
            array(
                '%s',
                '%s',
            )
        );

        if ($inserted) {
            echo '<div class="alert alert-success">Task added successfully</div>';
        } else {
            echo '<div class="alert alert-danger">Something went wrong!</div>';
            $wpdb->show_errors();
        }
    }
}

function render_add_new_page()
{
    handle_add_new_task_form();

    include_once PLUGIN_DIR_PATH . '/views/add-new.php';
}


function all_items_func()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todolist';
    $all_tasks = $wpdb->get_results("SELECT * FROM $table_name");

    include_once PLUGIN_DIR_PATH . '/views/all-items.php';
}

/**
 * custom css and js include  
 **/
function my_plugin_css_js()
{
    //ADD CSS
    wp_enqueue_style('main-css', PLUGIN_DIR_URI . 'assets/css/style.css', array(), '1.0', 'all');

    //ADD JS
    wp_enqueue_script('script', PLUGIN_DIR_URI . 'assets/js/script.js', array('jquery'), '1.0', true);

    //attach script file

    wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('admin_enqueue_scripts', 'my_plugin_css_js');

/**
 * custom plugin table create.
 */

//plugin activation and table create
function my_plugin_create_table()
{
    global $wpdb;

    $plugin_sql = "CREATE TABLE {$wpdb->prefix}todolist (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `task_name` varchar(222) NOT NULL,
            `short_desc` varchar(222) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($plugin_sql);
}

register_activation_hook(__FILE__, 'my_plugin_create_table');
