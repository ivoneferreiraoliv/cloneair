<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_mssql_driver $db
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property Accommodation_model $Accommodation_model
 */
class Accommodations extends CI_Controller {
    
	public function search() {
        // Carrega o modelo
        $this->load->model('Accommodation_model');
        
        // Obtém a consulta de busca
        $query = $this->input->get('query');
        
        // Obtém os resultados da busca do modelo
        $data['accommodations'] = $this->Accommodation_model->search_accommodations($query);
        
        // Carrega a view com os resultados da busca
        $this->load->view('templates/header');
        $this->load->view('templates/search_results', $data);
        $this->load->view('templates/footer');
    }
}