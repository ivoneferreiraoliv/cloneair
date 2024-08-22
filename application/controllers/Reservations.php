<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reservation_model');
        $this->load->model('Notification_model'); // Carrega o modelo de notificações
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
    
        if ($id && $status) {
            // Atualiza o status da reserva
            $update = $this->Reservation_model->update_status($id, $status);
    
            if ($update) {
                // Recupera a reserva para obter informações do usuário
                $reservation = $this->Reservation_model->get_reservation($id);
    
                if ($reservation) {
                    $message = '';
                    $type = '';
    
                    if ($status == 'confirmada') {
                        $message = 'Sua reserva foi confirmada!';
                        $type = 'confirmed';
                    } elseif ($status == 'cancelada') {
                        $message = 'Sua reserva foi cancelada.';
                        $type = 'canceled';
                    }
    
                    // Cria a notificação para o usuário
                    if (!empty($message)) {
                        // Log de debug para ver se a mensagem está sendo criada corretamente
                        log_message('debug', 'Criando notificação: ' . print_r([
                            'user_id' => $reservation->user_id,
                            'message' => $message,
                            'type' => $type,
                            'reservation_id' => $id,
                            'status' => 'unread',
                            'created_at' => date('Y-m-d H:i:s')
                        ], true));
    
                        // Tenta criar a notificação
                        $notification_created = $this->Notification_model->create_notification([
                            'user_id' => $reservation->user_id,
                            'message' => $message,
                            'type' => $type,
                            'reservation_id' => $id,
                            'status' => 'unread',
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
    
                        if ($notification_created) {
                            echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso e notificação criada.']);
                        } else {
                            $db_error = $this->db->error();
                            log_message('error', 'Erro ao criar notificação: ' . $db_error['message']);
                            echo json_encode(['success' => false, 'message' => 'Status atualizado, mas falha ao criar a notificação.']);
                        }
                    } else {
                        echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso, mas nenhuma notificação necessária.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Reserva não encontrada.']);
                }
            } else {
                $db_error = $this->db->error();
                log_message('error', 'Erro ao atualizar reserva: ' . $db_error['message']);
                echo json_encode(['success' => false, 'message' => 'Falha ao atualizar o status.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Parâmetros inválidos fornecidos.']);
        }
    }}