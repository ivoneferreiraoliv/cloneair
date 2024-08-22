<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'load_session_data',
    'filename' => 'session_hook.php',
    'filepath' => 'hooks',
    'params'   => array()
);
$hook['post_controller_constructor'][] = array(
    'class'    => 'NotificationsLoader',
    'function' => 'load_notifications',
    'filename' => 'NotificationsLoader.php',
    'filepath' => 'hooks'
);