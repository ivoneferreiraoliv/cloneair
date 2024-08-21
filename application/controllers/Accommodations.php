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
        $this->load->model('Accommodation_model');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->model('Reservation_model');
        
        
    }
    
    private function check_login() {
        if (!$this->session->userdata('logado')) {
            redirect('auth/login');
        }
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
        $this->check_login();

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

    public function process_payment() {
        $this->load->library('form_validation');
        
        // Regras de validação
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
        
        if ($this->input->post('payment_method') === 'credit_card') {
            $this->form_validation->set_rules('card_name', 'Card Name', 'required');
            $this->form_validation->set_rules('card_number', 'Card Number', 'required');
            $this->form_validation->set_rules('card_expiry', 'Card Expiry', 'required');
            $this->form_validation->set_rules('card_cvc', 'Card CVC', 'required');
        }
        
        if ($this->form_validation->run() === FALSE) {
            // Responder com erros de validação
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }
        
        $payment_method = $this->input->post('payment_method');
        $reservation = $this->session->userdata('reservation');
        
        if (!$reservation) {
            echo json_encode(['status' => 'error', 'message' => 'Nenhuma informação de reserva encontrada na sessão.']);
            return;
        }
        
        // Obtenha o user_id da sessão
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Usuário não está logado.']);
            return;
        }
    
        // Verifique a disponibilidade das datas
        $checkin_date = DateTime::createFromFormat('d/m/Y', $reservation['checkin_date'])->format('Y-m-d');
        $checkout_date = DateTime::createFromFormat('d/m/Y', $reservation['checkout_date'])->format('Y-m-d');
        
        $is_available = $this->Reservation_model->is_date_available($reservation['accommodation_id'], $checkin_date, $checkout_date);
        
        if (!$is_available) {
            echo json_encode(['status' => 'error', 'message' => 'As datas selecionadas já estão reservadas.']);
            return;
        }
        
        // Simulação de processamento de pagamento
        if ($payment_method === 'credit_card') {
            // Simulação de processamento de pagamento com cartão de crédito
            $card_name = $this->input->post('card_name');
            $card_number = $this->input->post('card_number');
            $card_expiry = $this->input->post('card_expiry');
            $card_cvc = $this->input->post('card_cvc');
        
            // Simulação de sucesso ou falha com 50/50
            $payment_status = (rand(0, 1) === 1) ? 'success' : 'error';
        } elseif ($payment_method === 'pix') {
            // Simulação de processamento de pagamento com PIX
            $payment_status = (rand(0, 1) === 1) ? 'success' : 'error';
        } else {
            $payment_status = 'error';
        }
        
        // Salvar a reserva no banco de dados com status "pendente"
        $reservation_data = [
            'user_id' => $user_id,
            'accommodation_id' => $reservation['accommodation_id'],
            'checkin_date' => $checkin_date,
            'checkout_date' => $checkout_date,
            'guests' => $reservation['guests'],
            'total_price' => $reservation['total_price'],
            'status' => 'pendente', 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $reservation_id = $this->Reservation_model->create_reservation($reservation_data);
        
        // Atualizar o status da reserva se o pagamento for bem-sucedido
        if ($payment_status === 'success') {
            $this->Reservation_model->update_reservation_status($reservation_id, 'confirmed');
        }
        
        // Retornar resposta JSON
        echo json_encode(['status' => $payment_status, 'message' => $payment_status === 'success' ? 'Reserva confirmada!' : 'Falha no pagamento. Tente novamente.']);
    }
}
