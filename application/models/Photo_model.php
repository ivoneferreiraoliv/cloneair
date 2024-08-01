<?php
class Photo_model extends CI_Model {
    public function get_photos_by_accommodation_id($accommodation_id) {
        $this->db->where('accommodation_id', $accommodation_id);
        $query = $this->db->get('accommodation_photos');
        return $query->result_array();
    }
    public function delete_photo($photo_id) {
        $this->db->where('id', $photo_id);
        return $this->db->delete('accommodation_photos');
    }
}
