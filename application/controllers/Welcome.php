<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    

    public function __construct(){
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('UserModel');

        if( $this->session->userdata('id') > -1  ) {
            $this->load->model('UserModel');

        } else if ($this->session->userdata('id') == -1  ) {

           redirect('Login/');

        }
               
      }

    public function index()
    {
  
    }
    public function login()
    {
        $this->load->view('common/header');
        $this->load->view('website/login');
        $this->load->view('common/footer');
    }


        //when admin login button is click
    public function user_login_check() {
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));

        $result = $this->UserModel->user_login_check_info($email, $password);

        //if query found any result i.e userfound
        if($result) {

            $data['id'] = $result->id;
            //$data['message'] = 'Your are successfully Login && your session has been start';
            $data['email'] = $result->email;
            $data['password'] = $result->password;
            $data['fullname'] = $result->fullname;
            $this->session->set_userdata($data);
            redirect('Welcome/goods');

        }else{
            $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($data);
            redirect('Welcome/login');
        }

    }

    public function verify(){

         if( $this->input->get() ) {

            $token = $this->input->get('token', TRUE);


            $data = array (
                "verified" => 'true',
                "status" => 'true'
            );

            $this->UserModel->update( 'user', 'token', $token, $data );
           
            redirect('Welcome/login');

        }
    } 

    public function editGoods(){

        if($this->input->post()) {

            $manufacturer = $this->input->post('manufacturer', TRUE);
            $model = $this->input->post('model', TRUE);
            $other = $this->input->post('other', TRUE);
            $serial = $this->input->post('serial', TRUE);
            $id = $this->input->post('id', true);
            $data = array (
                "manufacturer" => $manufacturer, 
                "model" => $model,
                "other" => $other, 
                "serial" => $serial              
            );
            $this->UserModel->update('goods','id',$id, $data);
            
            redirect('Welcome/goods');


        } else {

            $id = $this->input->get('id', TRUE);
            $data = $this->UserModel->getrecordById('goods','id',$id);
            $this->load->view('common/header');
            $this->load->view('website/editGoods', array('data' => $data));
            $this->load->view('common/footer');          

        }   
   

    }

    public function deleteGoods(){
    
    if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);

            $data['result'] = $this->UserModel->delete('id',$id,'goods');

            redirect('welcome/goods');


        }    

    }
    public function deleteCustomer(){
    
    if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);

            $data['result'] = $this->UserModel->delete('id',$id,'customers');

            redirect('welcome/customers');


        }    

    }    
    public function editCustomer(){

        if($this->input->post()) {

            $fname = $this->input->post('fname', TRUE);
            $lname = $this->input->post('lname', TRUE);
            $pname = $this->input->post('pname', TRUE);
            $dob = $this->input->post('dob', TRUE);
            $address1 = $this->input->post('address1', TRUE);
            $address2 = $this->input->post('address2', TRUE);            
            $suburb = $this->input->post('suburb', TRUE);
            $state = $this->input->post('state', TRUE);
            $postcode = $this->input->post('postcode', TRUE);
            $postalAddress1 = $this->input->post('postalAddress1', TRUE);
            $postalAddress2 = $this->input->post('postalAddress2', TRUE);
            $postalSuburb = $this->input->post('postalSuburb', TRUE);                     
            $postalState = $this->input->post('postalState', TRUE);
            $postalPostcode = $this->input->post('postalPostcode', TRUE);
            $homePhoneNumber = $this->input->post('homePhoneNumber', TRUE);
            $workPhoneNumber = $this->input->post('workPhoneNumber', TRUE);
            $mobilePhoneNumber = $this->input->post('mobilePhoneNumber', TRUE);
            $alert = $this->input->post('alert', TRUE);      

            $data = array(
                'fname' => $fname,
                'lname' => $lname,
                'pname' => $pname,
                'dob' => $dob,
                'address1' => $address1,
                'address2' => $address2,
                'suburb' => $suburb,
                'state' => $state,
                'postcode' => $postcode,
                'postalAddress1' => $postalAddress1,
                'postalAddress2' => $postalAddress2,
                'postalSuburb' => $postalSuburb,
                'postalState' => $postalState,
                'postalPostcode' => $postalPostcode,
                'homePhoneNumber' => $homePhoneNumber,
                'workPhoneNumber' => $workPhoneNumber,
                'mobilePhoneNumber' => $mobilePhoneNumber,
                'alert' => $alert                                 
                );

            $this->UserModel->update('customers','id',$id, $data);
            
            redirect('Welcome/customers');


        } else {

            $id = $this->input->get('id', TRUE);
            $data = $this->UserModel->getrecordById('customers','id',$id);
            $this->load->view('common/header');
            $this->load->view('website/editCustomer', array('data' => $data));
            $this->load->view('common/footer');          

        }   
   

    }    
    
    /**
     * logout
     */
  
    public function logout() {

        $this->session->sess_destroy();

        redirect('Login');

    }  

    public function goods(){

            if( $this->input->post()  ){

                $manufacturer = $this->input->post('manufacturer', TRUE);
                $model = $this->input->post('model', TRUE);
                $other = $this->input->post('other', TRUE);
                $serial = $this->input->post('serial', TRUE);

                $data = array(
                    'manufacturer' => $manufacturer,
                    'model' => $model,
                    'other' => $other,
                    'serial' => $serial,
                    'assigned' => 0
                    );

                
                $data['result'] = $this->UserModel->insert( 'goods', $data );

                $this->load->view('common/header');
                $this->load->view('website/goods', array('data' => $data));
                $this->load->view('common/footer');

            } else {
                
                $data['result'] = $this->UserModel->getGoods();
                $this->load->view('common/header');
                $this->load->view('website/goods', array('data' => $data));
                $this->load->view('common/footer');
            }

    }    
    public function userLoginStatus()
    {
        
        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type == 'User' ) {
            return true;
        }
        redirect('Welcome/login');
            
    }

    public function customers(){

                
        $data['result'] = $this->UserModel->getCustomer();
        $this->load->view('common/header');
        $this->load->view('website/customers', array('data' => $data));
        $this->load->view('common/footer');
            
    }    
    public function addCustomer(){
            
        if( $this->input->post()  ){

            $fname = $this->input->post('fname', TRUE);
            $lname = $this->input->post('lname', TRUE);
            $pname = $this->input->post('pname', TRUE);
            $dob = $this->input->post('dob', TRUE);
            $address1 = $this->input->post('address1', TRUE);
            $address2 = $this->input->post('address2', TRUE);            
            $suburb = $this->input->post('suburb', TRUE);
            $state = $this->input->post('state', TRUE);
            $postcode = $this->input->post('postcode', TRUE);
            $postalAddress1 = $this->input->post('postalAddress1', TRUE);
            $postalAddress2 = $this->input->post('postalAddress2', TRUE);
            $postalSuburb = $this->input->post('postalSuburb', TRUE);                     
            $postalState = $this->input->post('postalState', TRUE);
            $postalPostcode = $this->input->post('postalPostcode', TRUE);
            $homePhoneNumber = $this->input->post('homePhoneNumber', TRUE);
            $workPhoneNumber = $this->input->post('workPhoneNumber', TRUE);
            $mobilePhoneNumber = $this->input->post('mobilePhoneNumber', TRUE);
            $alert = $this->input->post('alert', TRUE);      

            $data = array(
                'fname' => $fname,
                'lname' => $lname,
                'pname' => $pname,
                'dob' => $dob,
                'address1' => $address1,
                'address2' => $address2,
                'suburb' => $suburb,
                'state' => $state,
                'postcode' => $postcode,
                'postalAddress1' => $postalAddress1,
                'postalAddress2' => $postalAddress2,
                'postalSuburb' => $postalSuburb,
                'postalState' => $postalState,
                'postalPostcode' => $postalPostcode,
                'homePhoneNumber' => $homePhoneNumber,
                'workPhoneNumber' => $workPhoneNumber,
                'mobilePhoneNumber' => $mobilePhoneNumber,
                'alert' => $alert                                 
                );

            $data['result'] = $this->UserModel->insert( 'customers', $data );

            $this->load->view('common/header');
            $this->load->view('website/addCustomer', array('data' => $data));
            $this->load->view('common/footer');

        } else {
            

            $this->load->view('common/header');
            $this->load->view('website/addCustomer', array('data' => null));
            $this->load->view('common/footer');
        }               

    }        
    




    public function sendPasswordLink () {
        if($this->input->post()){
             $email = $this->input->post('email', true); 
             $result = $this->UserModel->getUserByEmail($email);
             if( $result ){
                $message = "Please click on the url to reset your password \n" . base_url() . "index.php/Welcome/resetPassword?token=".$result->token;
                mail($result->email, "Reset your password", $message);
                redirect('Welcome/login');
             } else {
                redirect('Welcome/login');

             }
        }
    } 

    public function resetPassword () {
        if($this->input->post()){
            $token = $this->input->post('token', true);  
            $password = $this->input->post('newPassword', true); 

            $data = array (
                "password" => md5($password)
            );
            $this->UserModel->updatePassword( $token, $data);
           
            redirect('Welcome/login');

        } else {
            $this->loadView("website/resetPassword", null);
        }

    }


    public function accounts(){
        
        if($this->input->post()){
            
            $accountNumber = $this->input->post('accountNumber', true);
            $accountData = array(
                'account_number' => $accountNumber
            );

            $accountId = $this->UserModel->insert( 'account', $accountData );

            $goods = $this->input->post('goods', true);

            //iterate every good in post request
            foreach($goods as $good) {

                $goodItem = array(
                    'account_id' => $accountId,
                    'good_id' => $good
                );
                //insert in account_good table and getId
                $this->UserModel->insert( 'account_goods', $goodItem );

                //update good table and change assign value to 1 
                $this->UserModel->update( 'goods', 'id', $good, array('assigned' => '1'));

            }

            $customers = $this->input->post('customers', true);

            foreach($customers as $customer) {

                $customerItem = array(
                    'account_id' => $accountId,
                    'customer_id' => $customer
                );

                $this->UserModel->insert( 'account_customers', $customerItem );
            }
        
            
        } 

        $accountNumber = $this->UserModel->getAccountNumber(12);

        $goods = $this->UserModel->getAllfromTableWhere('goods', 'assigned', '0');
        $customers = $this->UserModel->getAllfromTable('customers');
        $accounts = $this->UserModel->getAllfromTable('account');

        $data['accountNumber'] = $accountNumber;
        $data['goods'] = $goods;
        $data['customers'] = $customers;
        $data['accounts'] = $accounts;

        $this->loadView('website/accounts', $data);           
            
    }


    public function deleteAccount(){
    
    if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);

            $data['result'] = $this->UserModel->delete('account_id',$id,'account');

            redirect('welcome/accounts');


        }    

    }


    public function editAccount(){

        $id = $this->input->get('id', TRUE);

        $account = $this->UserModel->getrecordById('account', 'account_id', $id);

        $goods = $this->UserModel->getAllfromTableWhere('goods', 'assigned', '0');
        $customers = $this->UserModel->getAllfromTable('customers');
        $accounts = $this->UserModel->getAllfromTable('account');

        $data['accountNumber'] = $account->account_number;
        $data['goods'] = $goods;
        $data['customers'] = $customers;
        $data['accounts'] = $accounts;


        $this->loadView('website/editAccount', $data);

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