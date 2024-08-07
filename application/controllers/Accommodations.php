<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property Accommodation_model $Accommodation_model
 */
class Accommodations extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Accommodation_model'); // Certifique-se de que o modelo está sendo carregado aqui
        $this->load->library('pagination');
    }
    
	public function search($page = 0) {
        $category = $this->input->get('category');
        $search_query = $this->input->get('query');
    
        // Configuração da paginação
        $config = array();
        $config['base_url'] = base_url('accommodations/search');
        $config['total_rows'] = $this->Accommodation_model->count_all_accommodations($category, $search_query);
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
    
        // Pega os dados de acomodações
        $data['accommodations'] = $this->Accommodation_model->get_accommodations($config['per_page'], $offset, $category, $search_query);
        $data['search_query'] = $search_query;
        $data['total_accommodations'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
    
        // Carrega as views
        $this->load->view('templates/header.php'); 
        $this->load->view('templates/search_results.php', $data);
        $this->load->view('templates/footer.php');
    }
}