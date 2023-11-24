<?php

/**
 * Plugin Name: Calculadora de Leads
 * Plugin URI: https://agencialaf.com
 * Description: Descrição do Calculadora de Leads.
 * Version: 0.0.2
 * Author: Ingo Stramm
 * Text Domain: cl
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('CL_DIR', plugin_dir_path(__FILE__));
define('CL_URL', plugin_dir_url(__FILE__));

function cl_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

require_once 'tgm/tgm.php';
require_once 'classes/classes.php';
require_once 'scripts.php';
require_once 'functions.php';
require_once 'shortcode.php';
require_once 'post-type.php';
require_once 'cmb.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/calculadora-leads/main/info.json',
    __FILE__,
    'cl'
);
