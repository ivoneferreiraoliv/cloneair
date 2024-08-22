<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property Accommodation_model $Accommodation_model
 * @property Category_model $Category_model
 * @property Photo_model $Photo_model
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload'); 
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Accommodation_model');
        $this->load->model('Category_model');
        $this->load->model('Photo_model');
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

    public function admin_accommodation() {
        $this->check_login();

        $data['accommodations'] = $this->Accommodation_model->get_accommodations();
        $data['userlogado'] = $this->session->userdata('userlogado');

        $this->load->view('admin/html-head-admin');
        $this->load->view('admin/admin-accommodation', $data); 
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

public function create_accommodation() {
    $this->check_login();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $data['categories'] = $this->Category_model->get_categories();
        $this->load->view('admin/html-head-admin');
        $this->load->view('admin/add_accommodation', $data);
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
        'max_guests' => $this->input->post('max_guests'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    );

    if ($this->Accommodation_model->create_accommodation($data)) {
        $accommodation_id = $this->db->insert_id();
        $categories = $this->input->post('categories');

        if (!empty($categories)) {
            foreach ($categories as $category_id) {
                $this->db->insert('accommodations_categories', array(
                    'accommodation_id' => $accommodation_id,
                    'category_id' => $category_id
                ));
            }
        }

        // Processar o upload das fotos
        $this->load->library('upload');
        $files = $_FILES;
        $count = count($_FILES['photos']['name']);
        for($i = 0; $i < $count; $i++) {
            $_FILES['photo']['name'] = $files['photos']['name'][$i];
            $_FILES['photo']['type'] = $files['photos']['type'][$i];
            $_FILES['photo']['tmp_name'] = $files['photos']['tmp_name'][$i];
            $_FILES['photo']['error'] = $files['photos']['error'][$i];
            $_FILES['photo']['size'] = $files['photos']['size'][$i];

            $this->upload->initialize($this->set_upload_options());

            if ($this->upload->do_upload('photo')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];

                $this->db->insert('accommodation_photos', array(
                    'accommodation_id' => $accommodation_id,
                    'photo' => $file_name
                ));
            } else {
                $error = $this->upload->display_errors();
                log_message('error', 'Upload error: ' . $error);
                echo json_encode(['status' => 'error', 'message' => $error]);
                return;
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Adicionado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar acomodação.']);
    }
}
private function set_upload_options() {   
    $config = array();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '2048'; // 2MB
    $config['overwrite'] = FALSE;

    return $config;
}
    
public function edit_accommodation($id) {
    $this->check_login();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $accommodation = $this->Accommodation_model->get_accommodation_by_id($id);
        $photos = $this->Photo_model->get_photos_by_accommodation_id($id);
        if (!$accommodation) {
            echo json_encode(['status' => 'error', 'message' => 'Acomodação não encontrada.']);
            return;
        }
        $data['accommodation'] = $accommodation;
        $data['photos'] = $photos;
        $data['categories'] = $this->Category_model->get_categories();
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
        'max_guests' => $this->input->post('max_guests'),
        'updated_at' => date('Y-m-d H:i:s')
    );

    if ($this->Accommodation_model->update_accommodation($id, $data)) {
        // Verificar se há categorias selecionadas
        $categories = $this->input->post('categories');
        if (!empty($categories)) {
            $this->db->where('accommodation_id', $id);
            $this->db->delete('accommodations_categories');
            foreach ($categories as $category_id) {
                $this->db->insert('accommodations_categories', array(
                    'accommodation_id' => $id,
                    'category_id' => $category_id
                ));
            }
        }

        // Verificar se há fotos para upload
        if (isset($_FILES['photos']) && $_FILES['photos']['name'][0] != '') {
            $files = $_FILES;
            $count = count($_FILES['photos']['name']);
            for($i = 0; $i < $count; $i++) {
                $_FILES['photo']['name'] = $files['photos']['name'][$i];
                $_FILES['photo']['type'] = $files['photos']['type'][$i];
                $_FILES['photo']['tmp_name'] = $files['photos']['tmp_name'][$i];
                $_FILES['photo']['error'] = $files['photos']['error'][$i];
                $_FILES['photo']['size'] = $files['photos']['size'][$i];

                $this->upload->initialize($this->set_upload_options());
                if ($this->upload->do_upload('photo')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $this->db->insert('accommodation_photos', array(
                        'accommodation_id' => $id,
                        'photo' => $file_name
                    ));
                } else {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload error: ' . $error);
                    echo json_encode(['status' => 'error', 'message' => $error]);
                    return;
                }
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Editado com sucesso!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao editar acomodação.']);
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


    public function delete_photo() {
        $this->check_login();
        $photo_id = $this->input->post('photo_id');

        $this->load->model('Photo_model');
        if ($this->Photo_model->delete_photo($photo_id)) {
            echo json_encode(['status' => 'success', 'message' => 'Foto excluída com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir foto.']);
        }

    }
   
}