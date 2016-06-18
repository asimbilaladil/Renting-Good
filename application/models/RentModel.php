<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class RentModel extends CI_Model
{

    public $tableName;

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'renting';
    }


    public function selectAll() {
        $this->db->select('*');
        $this->db->from( $this->tableName );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }


    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert( $data ){

        if ($this->db->insert($this->tableName, $data) ) {

            return $this->db->insert_id();

        } 

        return -1 ;

    }

    function getRentDetailById($id) {
        $query = $this->db->query(
            'SELECT account.account_number, customers.fname, customers.lname, goods.manufacturer, account.payment_times, account.start_date, account.time_interval, account.amount, account.account_id
                FROM account, customers, goods, account_customers, account_goods
                WHERE account.account_id = account_customers.account_id
                AND account_customers.customer_id = customers.id
                AND account.account_id = account_goods.account_id
                AND account_goods.good_id = goods.id
                AND account.account_id = ' . $id );

        $query->result();

        return $query->row();            
    } 


    function getRentingList() {
        $query = $this->db->query(
            'SELECT account.account_number, customers.fname, goods.manufacturer, renting.payment_times, renting.start_date, renting.time_interval, renting.amount, renting.id
                FROM account, customers, goods, renting
                WHERE renting.account_id = account.account_id 
                AND renting.customer_id = customers.id
                AND renting.good_id = goods.id');

        $query->result();

        return $query->result();        
    }

    function getCustomersById( $id ) {

        $query = $this->db->query( 'SELECT fname,lname,address1 , postcode from customers where id in (select customer_id from  account_customers where account_id = ' . $id .')' );
        $query->result();

        return $query->result();  
    }

    function getGoodsById( $id ) {

        $query = $this->db->query( 'SELECT manufacturer from goods where id in (select good_id from  account_goods where account_id = ' . $id .')' );
        $query->result();

        return $query->result();  
    }
    

}