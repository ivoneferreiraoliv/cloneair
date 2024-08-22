<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Notification_model'); // Carrega o modelo de notificações
    }

    // Método para marcar uma notificação como lida
    public function mark_as_read($notification_id) {
        // Verifica se a notificação existe
        $notification = $this->Notification_model->get_notification($notification_id);

        if ($notification) {
            // Marca a notificação como lida
            $this->Notification_model->mark_as_read($notification_id);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Notificação não encontrada.']);
        }
    }
}