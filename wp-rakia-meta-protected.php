<?php
/*
 Plugin Name: WPRakia METAPROTECTED Lite
 Plugin URI: https://github.com/wprakia/metaprotected
 Description: Protect meta where WP fails :)
 Author: Slavco Mihajloski
 Version: 1.0
 Author URI: https://medium.com/websec
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wp_rakia_action_is_protected_meta($protected, $meta_key, $meta_type){
    
    if ( $protected ) return $protected;
    
    return wp_rakia_meta_key_protected_start($meta_key);
    
}

add_action("is_protected_meta", "wp_rakia_action_is_protected_meta", 100, 3);


function wp_rakia_meta_key_protected_start($meta_key = "", $delimiter = "_"){
    
    if ( is_scalar($meta_key) && strpos($meta_key, $delimiter) !== FALSE ){
        
        if ( strpos($meta_key, $delimiter) === 0 ) return true;
        
        $tmp = explode($delimiter, $meta_key);
        
        if ( is_array($tmp) && sizeof($tmp) > 0 ){
            
            $tmp_part = $tmp[0];
            $tmp_part = preg_replace("/[^a-zA-Z0-9\$\.\-_:|]/", "", $tmp_part);
            
            if ( strlen($tmp_part) === 0 ){
                
                return true;
                
            }
            
        }
        
    }
    
    return false;
    
}
