<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id');
        if( $id != NULL  ) {
            $this->load->model('RentModel');
            $this->load->model('UserModel');
            $this->load->model('AccountModel');
            $this->load->model('ReportModel');

        } else {

            redirect('Login/');
        }
    }
    

    public function index() {
        
        $id = $this->input->get('id', true);

        $data['report'] = $this->ReportModel->reporting($id);

        $data['rendDetail'] = $this->RentModel->getRentDetailById($id);

        $this->loadView('website/report', $data);
    }


    /**
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {
        //error_reporting(0);
        $this->load->view('common/header');
        $this->load->view($view, array('data' => $data));
        $this->load->view('common/footer');

    }    
}
