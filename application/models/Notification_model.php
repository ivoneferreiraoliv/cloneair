<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Método para criar uma notificação
    public function create_notification($data) {
        // Verifica se a reserva existe e pega o status
        if (isset($data['reservation_id'])) {
            $this->db->select('status');
            $this->db->from('reservas');
            $this->db->where('id', $data['reservation_id']);
            $query = $this->db->get();
            $reservation = $query->row();

            // Define o tipo de notificação com base no status da reserva
            if ($reservation) {
                $data['type'] = ($reservation->status === 'confirmada') ? 'confirmed' : 'canceled';
            }
        }

        // Insere a notificação no banco de dados
        return $this->db->insert('notifications', $data);
    }
    
    // Método para obter notificações de um usuário
    public function get_user_notifications($user_id, $only_unread = false) {
        $this->db->where('user_id', $user_id);
    
        if ($only_unread) {
            $this->db->where('status', 'unread');
        }
    
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('notifications');
        return $query->result_array();
    }

    // Método para marcar uma notificação como lida
    public function mark_as_read($notification_id) {
        $this->db->where('id', $notification_id);
        $this->db->update('notifications', array('status' => 'read'));
    }

    // Método para obter uma notificação específica pelo ID
    public function get_notification($notification_id) {
        $this->db->where('id', $notification_id);
        $query = $this->db->get('notifications');
        return $query->row_array();
    }

    // Método para contar notificações não lidas de um usuário
    public function count_unread_notifications($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'unread');
        return $this->db->count_all_results('notifications');
    }
}