<?php
/*
Plugin Name: Herbal - Komunitas Diskusi
Plugin URI: https://herbaltv.co.id
Description: Fitur Diskusi
Author: Aryanto Herbal
Author URI: https://aryanto.id
Text Domain: sabai-discuss
Domain Path: /languages
Version: 1.4.8
*/
define('SABAI_PACKAGE_DISCUSS_PATH', dirname(__FILE__));

function sabai_wordpress_discuss_init()
{
    include_once SABAI_PACKAGE_DISCUSS_PATH . '/include/shortcodes.php';
}
add_action('init', 'sabai_wordpress_discuss_init');

function sabai_wordpress_discuss_addon_path($paths)
{
    $paths[] = array(SABAI_PACKAGE_DISCUSS_PATH . '/lib', '1.4.8');
    return $paths;
}
add_filter('sabai_sabai_addon_paths', 'sabai_wordpress_discuss_addon_path');

function is_sabai_discuss_question()
{
    return isset($GLOBALS['sabai_entity'])
        && $GLOBALS['sabai_entity']->getBundleType() === 'questions';
}

function is_sabai_discuss_category($slug = null)
{
    if (!isset($GLOBALS['sabai_entity'])
        || $GLOBALS['sabai_entity']->getBundleType() !== 'questions_categories'
    ) return false;
    
    return isset($slug) ? $GLOBALS['sabai_entity']->getSlug() === $slug : true;
}

function is_sabai_discuss_tag($slug = null)
{
    if (!isset($GLOBALS['sabai_entity'])
        || $GLOBALS['sabai_entity']->getBundleType() !== 'questions_tags'
    ) return false;
    
    return isset($slug) ? $GLOBALS['sabai_entity']->getSlug() === $slug : true;
}
