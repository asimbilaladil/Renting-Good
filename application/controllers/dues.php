<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dues extends CI_Controller
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

        $dues = $this->DuesModel->getDues();

        $accountIds = $this->DuesModel->getDuesByAccountIds($dues);

        if($accountIds == '') {
            $accountIds = 0;            
        }

        $data['details'] = $this->DuesModel->getDuesDetail($accountIds); 

        $this->loadView('website/dues', $data);
    }

    public function payment() {
        $data['accountId'] = $this->input->get('id', TRUE);

        $this->loadView('website/update-payment', $data);
    }

    public function insertPayment() {

        $data = array(
            'account_id' => $this->input->post('accountId', true),
            'paid' => $this->input->post('payment', true),
            'date' => date('Y-m-d')
        );

        $this->PaymentModel->insert($data);
        redirect('dues');
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
