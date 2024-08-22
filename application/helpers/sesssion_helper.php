<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('load_user_data')) {
    function load_user_data() {
        $CI =& get_instance();
        $CI->load->library('session');

        // Verificar se o usuário está logado
        if ($CI->session->userdata('logado')) {
            // Carregar dados do usuário da sessão
            $data['username'] = $CI->session->userdata('username');
        } else {
            $data['username'] = 'Usuário';
        }

        // Disponibilizar os dados para todas as visualizações
        $CI->load->vars($data);
    }
}