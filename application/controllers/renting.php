<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renting extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        //error_reporting(0);
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

        $rendId = $this->RentModel->insert($data);

        $paymentData = array(
            'rent_id' => $rendId,
            'paid' => $this->input->post('amount', true),
            'date' => $this->input->post('startDate', true)
        );

        $this->PaymentModel->insert($paymentData);

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
