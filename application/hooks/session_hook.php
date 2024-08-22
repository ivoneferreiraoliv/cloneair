<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function load_session_data() {
    $CI =& get_instance();
    $CI->load->vars(array(
        'username' => $CI->session->userdata('username')
    ));
}
