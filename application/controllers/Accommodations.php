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
        $this->load->library('session');
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

        $config['suffix'] = '?category=' . $category . '&query=' . urlencode($search_query);
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

        $offset = $page;

        $data['accommodations'] = $this->Accommodation_model->get_accommodations($config['per_page'], $offset, $category, $search_query);
        $data['search_query'] = $search_query;
        $data['total_accommodations'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header.php'); 
        $this->load->view('templates/search_results.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function detalhes($id = null) {
        if ($id === null) {
            show_404();
        }

        $accommodation = $this->Accommodation_model->get_accommodation_by_id($id);

        if (!$accommodation) {
            show_404();
        }

        $this->session->set_userdata('selected_accommodation_id', $id);

        // Verifica se o ID foi armazenado na sessão corretamente
        if (!$this->session->userdata('selected_accommodation_id')) {
            show_error('ID da acomodação não encontrado na sessão.');
        }

        $reservation = $this->session->userdata('reservation');
        $data['accommodation'] = $accommodation;
        $data['reservation'] = $reservation;

        $this->load->view('templates/header');
        $this->load->view('templates/detalhes_accommodations', $data);
        $this->load->view('templates/footer');
    }

    public function definir_reserva() {
        $checkin_date = $this->input->post('checkin_date');
        $checkout_date = $this->input->post('checkout_date');
        $guests = $this->input->post('guests');

        $accommodation_id = $this->session->userdata('selected_accommodation_id');

        if (!$accommodation_id) {
            show_error('ID da acomodação não encontrado na sessão.');
        }

        $accommodation = $this->Accommodation_model->get_accommodation_by_id($accommodation_id);

        if (!$accommodation) {
            show_404();
        }

        $this->session->set_userdata('reservation', [
            'accommodation_id' => $accommodation_id,
            'price_per_night' => $accommodation->price_per_night,
            'checkin_date' => $checkin_date,
            'checkout_date' => $checkout_date,
            'guests' => $guests,
        ]);

        redirect('accommodations/reservar');
    }

    public function reservar() {
        $reservation = $this->session->userdata('reservation');

        if (!$reservation) {
            redirect('accommodations');
        }

        $accommodation = $this->Accommodation_model->get_accommodation_by_id($reservation['accommodation_id']);

        if (!$accommodation) {
            show_404();
        }

        $checkin_date = isset($reservation['checkin_date']) ? DateTime::createFromFormat('d/m/Y', $reservation['checkin_date']) : null;
        $checkout_date = isset($reservation['checkout_date']) ? DateTime::createFromFormat('d/m/Y', $reservation['checkout_date']) : null;

        if ($checkin_date && $checkout_date) {
            $days = $checkout_date->diff($checkin_date)->days;

            if ($days == 0) {
                $days = 1;
            }

            $total_price = ($accommodation->price_per_night * $days) + 50 + 30;

            $reservation['total_price'] = $total_price;
        } else {
            $reservation['total_price'] = $accommodation->price_per_night + 50 + 30;
            $days = 1;
        }

        $guests = isset($reservation['guests']) ? $reservation['guests'] : 'N/A';

        $this->session->set_userdata('reservation', $reservation);

        $data['accommodation'] = $accommodation;
        $data['reservation'] = $reservation;
        $data['days'] = $days;
        $data['guests'] = $guests;

        $this->load->view('templates/header');
        $this->load->view('templates/checkout', $data);
        $this->load->view('templates/footer');
    }
}
