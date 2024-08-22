<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function login() {
        $this->load->view('templates/header');
        $this->load->view('templates/login'); 
        $this->load->view('templates/footer');
    }

    public function process_login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Senha', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $this->db->where('email', $email);
            $userlogado = $this->db->get('users')->row(); // Use 'row()' para obter um único objeto
    
            // Se encontrar um usuário
            if ($userlogado && password_verify($password, $userlogado->password)) {
                // Armazenar o ID do usuário na sessão
                $dataSession = array(
                    'user_id' => $userlogado->id,
                    'userlogado' => $userlogado,
                    'username' =>$userlogado->username,
                    'logado' => TRUE
                );
                
                $this->session->set_userdata($dataSession);
                
                redirect('home'); // Redireciona para a página inicial após o login bem-sucedido
            } else {
                $this->session->set_flashdata('error', 'E-mail ou senha inválidos.');
                redirect('auth/login'); // Redireciona para a página de login
            }
        }
    }

    public function registrar(){
        $this->load->view('templates/header');
        $this->load->view('templates/registrar'); 
        $this->load->view('templates/footer');
    }

    public function process_register(){
        // Carregar a biblioteca de validação de formulário
        $this->load->library('form_validation');

        // Definir regras de validação
        $this->form_validation->set_rules('username', 'Nome de Usuário', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirme a Senha', 'required|matches[password]');
        $this->form_validation->set_rules('first_name', 'Primeiro Nome', 'required');
        $this->form_validation->set_rules('last_name', 'Último Nome', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Se a validação falhar, recarregar o formulário de registro com erros
            $this->load->view('templates/header');
            $this->load->view('templates/registrar'); 
            $this->load->view('templates/footer');
        } else {
            // Se a validação for bem-sucedida, inserir os dados no banco de dados
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'user_type' => 'User', // Definir o tipo de usuário como "User"
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->User_model->adicionar($data)) {
                // Redirecionar para a página de login com mensagem de sucesso
                $this->session->set_flashdata('success', 'Registro realizado com sucesso! Você pode entrar agora.');
                redirect('auth/login');
            } else {
                // Exibir mensagem de erro
                $this->session->set_flashdata('error', 'Ocorreu um erro ao registrar. Tente novamente.');
                redirect('auth/registrar');
            }
        }
    }


    public function logout() {
        // Destroi a sessão
        $this->session->sess_destroy();
        // Redireciona para a página de login
        redirect('auth/login');
    }
   
}
