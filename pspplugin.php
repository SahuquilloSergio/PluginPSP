<?php
/*
Plugin Name: WP FlamerUltimateEdition
Plugin URI:  http://link to your plugin homepage
Description: This plugin has no sense.
Version:     1.0
Author:      HueveraMortalNinja
Author URI:  http://link to your website
License:     GPL2 etc
License URI: https://link to your plugin license
*/
#Crear tabla cuando se active el plugin
function createTable() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'myPlugin';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        palabra tinytext NOT NULL
        PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    //always return
    return $content;
}
add_action('activated_plugin', 'createTable');
function filterwords($text){
	
	global $wpdb;
	
	$registros = $wpdb->get_results( "SELECT palabra FROM wp5_myPlugin");
	$filterWords = array();
	
	for ($i=0; i<=$registros.size(); $i++){
		$filterWords.add($registros[i])
	}
	
	$filterCount = sizeof($filterWords);
	
	for($i=0; $i<$filterCount; $i++){
			$text = preg_replace('/\b'.$filterWords[$i].'\b/ie',"str_repeat('*',strlen('$0'))",$text);
	}
	
	return $text;
}
add_filter( 'the_content', 'filterwords' );
?>