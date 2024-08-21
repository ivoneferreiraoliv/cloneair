<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends CI_Controller {

	public function __construct() {
	parent::__construct();
	$this->load->model('Reservation_model');
	}

	public function index() {
	$data['reservations'] = $this->Reservation_model->get_all_reservations();
	
		$this->load->view('admin/html-head-admin');
        $this->load->view('admin/reservas', $data); 
        $this->load->view('admin/html-footer-admin');
	}

	public function update_status_ajax() {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
	
		// Verifica se os parâmetros foram recebidos corretamente
		if ($id && $status) {
			// Chama o método do modelo para atualizar o status
			$update = $this->Reservation_model->update_status($id, $status);
			
			// Verifica o resultado da atualização
			if ($update) {
				// Retorna sucesso se a atualização ocorreu
				echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso.']);
			} else {
				// Retorna erro se algo deu errado na atualização
				echo json_encode(['success' => false, 'message' => 'Falha ao atualizar o status.']);
			}
		} else {
			// Retorna erro se os parâmetros estão ausentes ou inválidos
			echo json_encode(['success' => false, 'message' => 'Parâmetros inválidos fornecidos.']);
		}
}
}