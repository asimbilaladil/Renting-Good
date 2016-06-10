<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renting extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $id = $this->session->userdata('id');
        $this->load->model('RentModel');
        $this->load->model('UserModel');
        $this->load->model('AccountModel');
        
        if ($this->session->userdata('id') > -1) {
            $this->load->model('RentModel');
            
        } else if ($this->session->userdata('id') == -1) {
            
            redirect('Login/');
        }
    }
    

    public function index() {

        $data['accounts'] = $this->AccountModel->selectAll();

        $data['renting'] = $this->RentModel->getRentingList();


        $this->loadView('website/renting', $data);
    }


    public function getGoodsByAccount() {
        $id = $this->input->post('state'); 

        $goods = $this->AccountModel->getGoodsByAccount($id);

        $html = '';

        foreach ($goods as $good) {
            $html = $html . ' <option value="' . $good->id . '"> '. $good->manufacturer .' </options> ';

        }
        
        echo $html;

    }


    public function getCustomerByAccount() {

        $id = $this->input->post('state'); 

        $customers = $this->AccountModel->getCustomerByAccount($id);

        $html = '';

        foreach ($customers as $customer) {
            $html = $html . ' <option value="' . $customer->id . '"> '. $customer->fname .' </options> ';

        }
        
        echo $html;
    }

    public function save() {
        print_r($this->input->post());
        $data = array(
            'customer_id' => $this->input->post('customers', true),
            'good_id' => $this->input->post('goods', true),
            'account_id' => $this->input->post('accountId', true),
            'start_date' => $this->input->post('startDate', true),
            'time_interval' => $this->input->post('timeInterval', true),
            'payment_times' => $this->input->post('paymentTimes', true),
            'amount' => $this->input->post('amount', true),
        );

        $this->RentModel->insert($data);

        redirect('renting');
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
