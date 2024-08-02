<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property Accommodation_model $Accommodation_model
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accommodation_model');
        $this->load->library('pagination');
    }

    public function index($page = 0) {
        // Configuração da paginação
        $config = array();
        $config['base_url'] = base_url('home/index');
        $config['total_rows'] = $this->Accommodation_model->count_all_accommodations();
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;

        // Customização da paginação
        $config['full_tag_open'] = '<ul class="pagination pagination-primary m-4">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Calcula o offset
        $offset = $page;

        // Obtém as acomodações para a página atual
        $data['accommodations'] = $this->Accommodation_model->get_accommodations($config['per_page'], $offset);

        // Passa a paginação para a view
        $data['pagination'] = $this->pagination->create_links();

        // Carregar as views e passar os dados
        $this->load->view('templates/header.php');
        $this->load->view('templates/home.php', $data);
        $this->load->view('templates/footer.php');
    }
}