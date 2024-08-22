<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationsLoader {

    public function load_notifications() {
        $CI =& get_instance();
        $CI->load->model('Notification_model');

        $user_id = $CI->session->userdata('user_id');
        if ($user_id) {
            $notifications = $CI->Notification_model->get_user_notifications($user_id);
            $unread_count = $CI->Notification_model->count_unread_notifications($user_id);

            // Disponibilizando as notificações para as views
            $CI->load->vars('notifications', $notifications);
            $CI->load->vars('unread_count', $unread_count);
        }
    }
}