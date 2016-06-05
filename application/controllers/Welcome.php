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
               
        error_reporting(0);
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
	public function signup() {

		if($this->input->post()) {

            $duties = $this->input->post('duties', true);
            $jks = $this->input->post('jks', true);

            $dutiesStr = "";
            $jksStr = "";

            foreach( $duties as $value ) {
                $dutiesStr = $dutiesStr . $value . "," ;
            }
            $dutiesStr = rtrim($dutiesStr, ',');  //remove last comma 


            foreach( $jks as $value ) {
                $jksStr = $jksStr . $value . "," ;
            }
            $jksStr = rtrim($jksStr, ',');  //remove last comma 

            $customFields = array();
            $customFields['result'] = $this->UserModel->getCustomFields();

            $token = $this->generateToken(); 
            $data = array (
                'first_name' => $this->input->post('firstName', true),
                'last_name' => $this->input->post('lastName', true),
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true)),
                'phone' => $this->input->post('phone', true),
                'type' => "User",
                'verified' => "false",
                'token' => $token,
                'pref_duty' => $dutiesStr,
                'pref_jk'=> $jksStr
                );

            $emailMessage = "Please verify your waaranet user" . $data['first_name'] . " " . $data['last_name'] . " by using this link \n".base_url()."index.php/Welcome/verify?token=".$token;

            //get inserted id of the user
            $userInsertedId = $this->UserModel->insert('user', $data);

            //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
            foreach( $customFields['result'] as $value ) {

                if( array_key_exists( $value->field_name, $this->input->post() ) ) {

                    $userCustomData = array (
                        'user_id' => $userInsertedId,
                        'customField_id' => $value->customField_id,
                        'key' => $value->field_name,
                        'value' => $this->input->post( $value->field_name , true)
                        );

                    $this->UserModel->insert('user_custom_data', $userCustomData);

                }     

            }
            $adminEmails = $this->UserModel->getSuperAdmin();
            foreach ($adminEmails  as $key => $value) {

                mail($value->email,"User Approval",$emailMessage);

            }
            

            redirect('Welcome/login');

		} else {



			$this->load->view('common/header');
			$this->load->view('website/signup',$data);
	        $this->load->view('common/footer');
    	}
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

    //genrate token for user verification
    public function generateToken($length = 15) {

	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}





    //Home controller
    public function home() {

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type == 'User' ) {


        $data['events'] = $this->UserModel->getUserWaaraCalendar($id); 
        $events = [];
        foreach( $data['events']  as $row ) {
             $subevent['title'] = $row->duty_name;
             $subevent['start'] = $row->start_date;
             $subevent['end'] = $row->end_date;
             $subevent['url'] = 'waara?id='.$row->id;
             array_push($events, $subevent);
        }
        $data['events'] = $events;  

            $this->load->view('common/header');
            $this->load->view('website/home',array('data' => $data));
            $this->load->view('common/footer');


        } else if ( $type == 'Super Admin' || $type == 'JK Admin') {

            redirect('Admin/');

        } else {

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


    public function waara(){


        if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);


            $data['result'] = $this->UserModel->getWaara($id);

            $this->load->view('common/header');
            $this->load->view('website/waara', array('data' => $data));
            $this->load->view('common/footer');
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
                    'serial' => $serial
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
    

    function editUser() {
        if(  $this->userLoginStatus() ){
            if($this->input->post()) {

                $id = $this->input->post('userId', true);

                $customfields = $this->UserModel->getAllfromTable('customfields');

                $customData = array();

                //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
                foreach( $customfields as $item ) {
                    if( array_key_exists( $item->field_name, $this->input->post() ) ) {

                        $customData = array( "value" => $this->input->post( $item->field_name, true) );
                                                // tablename           key      value   key    value               data   
                        $this->UserModel->updateWhere('user_custom_data', 'user_id', $id, 'key', $item->field_name, $customData);

                    }
                }


                $this->UserModel->update('user_custom_data' ,'user_id' , $id, $customData);

                $data = array (
                    "first_name" => $this->input->post('firstName', true),
                    "last_name" => $this->input->post('lastName', true),
                    "email" => $this->input->post('email', true),
                    "phone" => $this->input->post('phone', true)
                );

                

                $this->UserModel->update('user' ,'user_id' , $id, $data);

                redirect('Welcome/editUser');

            }

            

                $id = $this->session->userdata('user_id');
       
                $data['customFields'] = $this->UserModel->getCustomFieldByUserId( $id );

                $data['user'] = $this->UserModel->getUserById( $id );

                $this->loadView('website/editUser', $data);

        }
  
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
}
