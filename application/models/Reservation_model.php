<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_reservations() {
        $query = $this->db->get('reservas');
        return $query->result();
    }

    // Método para criar uma nova reserva
    public function create_reservation($data) {
        return $this->db->insert('reservas', $data);
    }

    // Método para atualizar o status da reserva
    public function update_reservation_status($reservation_id, $status) {
        $this->db->where('id', $reservation_id);
        return $this->db->update('reservas', [
            'status' => $status, 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Método para verificar se as datas estão disponíveis
    public function is_date_available($accommodation_id, $start_date, $end_date) {
        $this->db->from('reservas');
        $this->db->where('accommodation_id', $accommodation_id);
        $this->db->where('status', 'confirmada');
        $this->db->where('checkin_date <=', $end_date);
        $this->db->where('checkout_date >=', $start_date);

        $query = $this->db->get();
        return $query->num_rows() == 0; // Retorna true se não houver conflito
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        $this->db->update('reservas', array('status' => $status));
        
        // Verifica se a atualização afetou alguma linha
        if ($this->db->affected_rows() > 0) {
            return true; // Retorna verdadeiro se a atualização foi bem-sucedida
        } else {
            return false; // Retorna falso se nenhuma linha foi afetada
        }

}
}