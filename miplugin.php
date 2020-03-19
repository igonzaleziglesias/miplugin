<?php

/**
* Plugin Name:       PluginCasero
* Description:       Plugin de prueba
* Version:           1.2.1
* Author:            Yo
* Author URI:        no
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       pluginCasero
* Domain Path:       /languages
*/

function renym_content_replace( $content ) {
global $wpdb;
$registros = $wpdb -> get_results("SELECT tacos FROM wpgit_insultos");
$insultos = array();

   foreach ($registros as $valor){
       $insultos[] = $valor -> tacos;
   }
   return str_replace($insultos, '********', $content);
}
    add_filter( 'the_content', 'renym_content_replace' );
   
  function create_table(){
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'insultos';

// creamos la sentencia sql

    $sql = "CREATE TABLE $table_name (
    tacos varchar(30) NOT NULL,
    PRIMARY KEY (tacos)
    ) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

add_action('init','create_table');

function insertar_insultos(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'insultos';
   
    $wpdb -> insert($table_name,array('tacos' => 'pisapapeles'));
    $wpdb -> insert($table_name,array('tacos' => 'ramera'));
    $wpdb -> insert($table_name,array('tacos' => 'tu mama'));
   
}
add_action('init', 'insertar_insultos')
?>

