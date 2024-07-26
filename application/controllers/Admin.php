<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property Accommodation_model $Accommodation_model
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Accommodation_model');
    }

    private function check_login() {
        if (!$this->session->userdata('logado') || $this->session->userdata('userlogado')->user_type !== 'admin') {
            redirect('admin/login');
        }
    }

    public function index() {
        $this->check_login();

        
        $data['accommodations'] = $this->Accommodation_model->get_accommodations();
        $data['userlogado'] = $this->session->userdata('userlogado');

        $this->load->view('admin/html-head-admin');
        $this->load->view('admin/home-admin', $data); 
        $this->load->view('admin/html-footer-admin');
    }

    public function pag_login() {
        $this->load->view('admin/html-head-admin');
        $this->load->view('admin/login-admin');
        $this->load->view('admin/html-footer-admin');
    }
        //auth
    public function login_admin() {
        $this->form_validation->set_rules('txt-username', 'Nome de Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-password', 'Senha', 'required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $this->pag_login();
        } else {
            $username = $this->input->post('txt-username');
            $password = $this->input->post('txt-password');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $userlogado = $this->db->get('users')->result();

            if (count($userlogado) == 1) {
                $dataSession['userlogado'] = $userlogado[0];
                $dataSession['logado'] = TRUE;
                $this->session->set_userdata($dataSession);
                redirect('admin'); 
            } else {
                $dataSession['userlogado'] = NULL;
                $dataSession['logado'] = FALSE;
                $this->session->set_userdata($dataSession);
                redirect('admin/login'); // Redireciona para a página de login
            }
        }
    }
    public function logout() {
        // Destrói a sessão do usuário
        $this->session->sess_destroy();

        // Redireciona o usuário para a página de login
        redirect('admin/login');
    }
//

    public function admin_accommodation(){
        $this->check_login();
        
        $data['accommodations'] = $this->Accommodation_model->get_accommodations();
        $this->load->view('admin/html-head-admin');
        $this->load->view('admin/admin-accommodation', $data);
        $this->load->view('admin/html-footer-admin');
    }

    public function create_accommodation() {
        $this->check_login();
    
        // Se a requisição for GET, exiba a página HTML
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->view('admin/html-head-admin');
            $this->load->view('admin/add_accommodation');
            $this->load->view('admin/html-footer-admin');
            return;
        }
    
        // Se a requisição for POST, processe os dados
        // Configurar as regras de validação do formulário
        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('description', 'Descrição', 'required');
        $this->form_validation->set_rules('location', 'Localização', 'required');
        $this->form_validation->set_rules('price_per_night', 'Preço por Noite', 'required');
        $this->form_validation->set_rules('num_rooms', 'Número de Quartos', 'required');
        $this->form_validation->set_rules('num_bathrooms', 'Número de Banheiros', 'required');
        $this->form_validation->set_rules('max_guests', 'Máximo de Hóspedes', 'required');
    
        // Verificar se a validação falhou
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }
    
        // Coletar os dados do formulário
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'location' => $this->input->post('location'),
            'price_per_night' => $this->input->post('price_per_night'),
            'num_rooms' => $this->input->post('num_rooms'),
            'num_bathrooms' => $this->input->post('num_bathrooms'),
            'max_guests' => $this->input->post('max_guests'),
            'created_at' => date('Y-m-d H:i:s')
        );
    
        // Inserir os dados no banco de dados
        if ($this->Accommodation_model->create_accommodation($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Adicionado com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar acomodação.']);
        }
    }
    
    public function edit_accommodation($id) {
        $this->check_login();
    
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $accommodation = $this->Accommodation_model->get_accommodation_by_id($id);
            if (!$accommodation) {
                echo json_encode(['status' => 'error', 'message' => 'Acomodação não encontrada.']);
                return;
            }
            $data['accommodation'] = $accommodation;
            $this->load->view('admin/html-head-admin');
            $this->load->view('admin/edit_accommodation', $data);
            $this->load->view('admin/html-footer-admin');
            return;
        }
    
        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('description', 'Descrição', 'required');
        $this->form_validation->set_rules('location', 'Localização', 'required');
        $this->form_validation->set_rules('price_per_night', 'Preço por Noite', 'required');
        $this->form_validation->set_rules('num_rooms', 'Número de Quartos', 'required');
        $this->form_validation->set_rules('num_bathrooms', 'Número de Banheiros', 'required');
        $this->form_validation->set_rules('max_guests', 'Máximo de Hóspedes', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }
    
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'location' => $this->input->post('location'),
            'price_per_night' => $this->input->post('price_per_night'),
            'num_rooms' => $this->input->post('num_rooms'),
            'num_bathrooms' => $this->input->post('num_bathrooms'),
            'max_guests' => $this->input->post('max_guests')
        );
    
        if ($this->Accommodation_model->update_accommodation($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Editado com sucesso!']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao editar acomodação.']);
            exit;
        }
    }
    public function delete_accommodation_ajax() {
        $this->check_login();
        
    
        $id = $this->input->post('id');
    
        if ($this->Accommodation_model->delete_accommodation($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Acomodação excluída com sucesso.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir acomodação.']);
        }
    }
}