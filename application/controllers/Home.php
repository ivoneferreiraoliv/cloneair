<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property Accommodation_model $Accommodation_model
 * 
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accommodation_model');
    }

    public function index() {
        // Carregar dados das acomodações com fotos
        $data['accommodations'] = $this->Accommodation_model->get_accommodations_with_photos();
        
        // Carregar as views e passar os dados
        $this->load->view('templates/header.php');
        $this->load->view('templates/home.php', $data);
        $this->load->view('templates/footer.php');
    }
}