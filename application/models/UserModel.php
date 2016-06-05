<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function user_login_check_info($user_email, $user_password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $user_email);
        $this->db->where('password', $user_password);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;
    }
    
    /**
     * Get Goods from db Method
     */

    public function getGoods (){
        $this->db->select('*');
        $this->db->from('goods');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }
    /**
     * Get Customer from db Method
     */

    public function getCustomer (){
        $this->db->select('*');
        $this->db->from('customers');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }    

    /**
     * Delete Method 
     */
    public function delete ( $whereParam1, $whereParam2, $tableName ){

        $this->db->delete( $tableName , array( $whereParam1 => $whereParam2) ); 
    } 
    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert( $tableName ,$data ){

        if ($this->db->insert($tableName, $data) ) {

            return $this->db->insert_id();

        } 

        return -1 ;

    }   

    /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param dataObject
     */
    public function update( $tableName, $whereParam1, $whereParam2 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }
    /*
    * Get record from table using single condition
    */
    function getrecordById( $tableName, $whereParam1, $whereParam2  ) {

        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereParam1, $whereParam2 );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }

//----------




    public function changePassword ($id, $oldPassword, $newPassword){
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where( 'password', $oldPassword );
        $this->db->where( 'user_id', $id );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        if( $result ){
            $data = array ( 'password' => $newPassword);
            $this->db->where( 'password', $oldPassword );
            $this->db->where( 'user_id', $id );
            $result = $this->db->update( 'user' ,$data);
            if ( $result ) {

                return true;

            } else {
                return false;
            }
        } else  {
            return 2;
        }



    }  

    public function getAllfromTable( $tableName ) {
        $this->db->select('*');
        $this->db->from( $tableName );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }

        /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param whereParam3
     * @param whereParam4
     * @param dataObject
     */
    public function updateWhere( $tableName, $whereParam1, $whereParam2, $whereParam3, $whereParam4 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }
    /*
    SELECT customfields.field_lable, customfields.field_name, customfields.input_type
    FROM customfields, user_custom_data
    WHERE user_custom_data.customField_id = customfields.customField_id
    AND user_custom_data.user_id = 10   
    */
    public function getCustomFieldByUserId( $id ) {

        $query = $this->db->query('SELECT customfields.field_lable, customfields.field_name, customfields.input_type, user_custom_data.value
            FROM customfields, user_custom_data
            WHERE user_custom_data.customField_id = customfields.customField_id
            AND user_custom_data.user_id = ' . $id );

        $query->result();

        return $query->result();

    } 
    
    function getUserById( $id ) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    } 

    function getUserByEmail( $email ) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }

    public function updatePassword( $token ,$data ){

        $this->db->where( "token", $token );
        $result = $this->db->update( "user" ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }



}