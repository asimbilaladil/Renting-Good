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

}