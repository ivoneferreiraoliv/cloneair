<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Pagination $pagination
 * @property Accommodation_model $Accommodation_model
 * @property Category_model $Category_model
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accommodation_model');
        $this->load->model('Category_model');
        $this->load->library('pagination');
    }

    public function index($page = 0) {
        $category_id = $this->input->get('category');
        $search_query = $this->input->get('query');
        
        // Configuração da paginação
        $config = array();
        $config['base_url'] = base_url('home/index');
        $config['total_rows'] = $this->Accommodation_model->count_all_accommodations($category_id, $search_query);
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
    
        // Adiciona os parâmetros de categoria e busca na URL
        $config['suffix'] = '?category=' . $category_id . '&query=' . urlencode($search_query);
        $config['first_url'] = $config['base_url'] . $config['suffix'];
    
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
        $data['accommodations'] = $this->Accommodation_model->get_accommodations($config['per_page'], $offset, $category_id, $search_query);
        $data['categories'] = $this->Category_model->get_all_categories();
        $data['search_query'] = $search_query;
        $data['total_accommodations'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();
        $category_name = $this->Category_model->get_category_by_id($category_id); 
        $data['category_name'] = $category_name;
    
        // Armazena o URL atual na sessão
        $current_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
        $this->session->set_userdata('previous_accommodations_url', $current_url);
        
        // Carrega as views
        $this->load->view('templates/header.php'); 
        $this->load->view('templates/home', $data); 
        $this->load->view('partials/accommodation_list', $data);
        $this->load->view('templates/footer.php');
    }
    public function detalhe($id) {
        // Busca os dados da acomodação pelo ID
        $accommodation = $this->Accommodation_model->get_accommodation_by_id($id);
        $this->session->set_userdata('previous_url', $_SERVER['HTTP_REFERER']);
        // Verifica se a acomodação existe, se não, mostra a página 404
        if (empty($accommodation)) {
            show_404();
        }
    
        // Processa as fotos da acomodação
        if (empty($accommodation->photos)) {
            $accommodation->photos = ['default.jpg'];
        } else {
            if (is_string($accommodation->photos)) {
                $accommodation->photos = explode(',', $accommodation->photos);
            } elseif (!is_array($accommodation->photos)) {
                $accommodation->photos = ['default.jpg'];
            } else {
                $accommodation->photos = array_map('trim', $accommodation->photos);
            }
        }
    
        // Armazena as informações necessárias na sessão
        $this->session->set_userdata('reservation', [
            'accommodation_id' => $accommodation->id,
            'price_per_night' => $accommodation->price_per_night,
            'checkin_date' => $this->input->post('checkin_date'),
            'checkout_date' => $this->input->post('checkout_date'),
            'guests' => $this->input->post('guests')
        ]);
    
        // Prepara os dados para a view
        $data['accommodation'] = $accommodation;
    
        // Carrega as views com os dados necessários
        $this->load->view('templates/header');
        $this->load->view('templates/detalhes_accommodations', $data);
        $this->load->view('templates/footer');
    }
}