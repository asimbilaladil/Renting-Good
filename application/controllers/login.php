<?php
class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('UserModel');
    }



    function index() {
        
        if($this->input->post()) {
           
            $data = array (
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true) )
            );
            $result = $this->UserModel->user_login_check_info($data);

            //if query found any result i.e userfound
            if($result) {
                    
                    $data['id'] = $result->id;
                    //$data['message'] = 'Your are successfully Login && your session has been start';
                    $data['email'] = $result->email;
                    $data['password'] = $result->password;
                    $data['fullname'] = $result->fullname;
                    $this->session->set_userdata($data);
                   // redirect('welcome/goods');

                
            }else{
                $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
                redirect('login/');
            }


        } else {
            $this->load->view('common/header');
            $this->load->view('website/login');
            $this->load->view('common/footer');

        }

    }


}
?>