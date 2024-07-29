<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property User_model $User_model
 * @property CI_Pagination $pagination
 */

class Users extends CI_Controller {

	public function __construct() {
        parent::__construct(); 
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('User_model');
		$this->load->library('pagination');
    }

    private function check_login() {
        if (!$this->session->userdata('logado') || $this->session->userdata('userlogado')->user_type !== 'admin') {
            redirect('admin/login');
        }
    }
	public function listar_admin($offset = 0) {
        $this->check_login();
		// Configuração da paginação
		$config['base_url'] = base_url('users/listar_admin');
		$config['total_rows'] = $this->User_model->get_total_users();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
	
		// Estilização da paginação
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Primeiro';
		$config['last_link'] = 'Último';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
	
		$this->pagination->initialize($config);
	
		// Obter usuários com paginação
		$users = $this->User_model->get_users($config['per_page'], $offset);
		foreach ($users as $user) {
			$user->created_at = date('d/m/Y', strtotime($user->created_at));
			$user->updated_at = date('d/m/Y', strtotime($user->updated_at));
		}
		$data['users'] = $users;
		$data['userlogado'] = $this->session->userdata('userlogado');
		$data['links_paginacao'] = $this->pagination->create_links();
	
		$this->load->view('admin/html-head-admin');
		$this->load->view('admin/admin_users', $data); 
		$this->load->view('admin/html-footer-admin');
	}


	public function adicionar() {
        $this->check_login();

        // Se a requisição for GET, exiba a página HTML
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->view('admin/html-head-admin');
            $this->load->view('admin/add_user');
            $this->load->view('admin/html-footer-admin');
            return;
        }

        // Se a requisição for POST, processe os dados
        // Configurar as regras de validação do formulário
        $this->form_validation->set_rules('username', 'Nome de Usuário', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('first_name', 'Primeiro Nome', 'required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'required');
        $this->form_validation->set_rules('user_type', 'Tipo de Usuário', 'required');

        // Verificar se a validação falhou
        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            exit;
        }

        // Coletar os dados do formulário
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Hash da senha
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'user_type' => $this->input->post('user_type'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Inserir os dados no banco de dados
        if ($this->User_model->adicionar($data)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Usuário adicionado com sucesso!']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar usuário.']);
        }
        exit;
    }

	public function editar($id) {
		$this->check_login();
	
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$user = $this->User_model->get_user_by_id($id);
			if (!$user) {
				echo json_encode(['status' => 'error', 'message' => 'Usuário não encontrado.']);
				return;
			}
			$data['user'] = $user;
			$this->load->view('admin/html-head-admin');
			$this->load->view('admin/edit_user', $data);
			$this->load->view('admin/html-footer-admin');
			return;
		}
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Carrega o modelo de usuário
			$this->load->model('User_model');
	
			// Obtém os dados do formulário
			$data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				// Adicione outros campos conforme necessário
			);
	
			// Atualiza os dados do usuário
			$update = $this->User_model->update_user($id, $data);
	
			// Verifica se a atualização foi bem-sucedida
			if ($update) {
				// Resposta de sucesso
				echo json_encode(['status' => 'success', 'message' => 'Usuário atualizado com sucesso.']);
			} else {
				// Resposta de erro
				echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o usuário.']);
			}
			return;
		}
	}

	public function excluir() {
        $this->check_login();
        
    
        $id = $this->input->post('id');
    
        if ($this->User_model->excluir($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Usuário excluída com sucesso.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir usuário.']);
        }
    }

}

