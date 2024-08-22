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

    public function create_reservation($data) {
        return $this->db->insert('reservas', $data);
    }

    public function update_reservation_status($reservation_id, $status) {
        $this->db->where('id', $reservation_id);
        return $this->db->update('reservas', [
            'status' => $status, 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

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
        $this->db->update('reservas', ['status' => $status]);

        return $this->db->affected_rows() > 0;
    }

    public function get_reservation($reservation_id) {
        $this->db->where('id', $reservation_id);
        $query = $this->db->get('reservas');
        return $query->row(); // Retorna uma única linha como objeto
    }
    public function get_reservation_by_user_and_accommodation($user_id, $accommodation_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('accommodation_id', $accommodation_id);
        $query = $this->db->get('reservas');
        return $query->row(); // Retorna a reserva se existir
    }
}