<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class AccountModel extends CI_Model
{

    private $tableName;

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'account';
    }


    public function selectAll() {
        $this->db->select('*');
        $this->db->from( $this->tableName );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }


    function getUserById( $id ) {

        $this->db->select('*');
        $this->db->from( $this->tableName );
        $this->db->where('account_id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;;
    }


    function getGoodsByAccount( $id ) {

        $query = $this->db->query(
            'SELECT goods.manufacturer, goods.id
            FROM goods, account_goods
            WHERE goods.id = account_goods.good_id 
            AND account_goods.account_id = ' . $id);

        $query->result();

        return $query->result();
    }


    function getCustomerByAccount( $id ) {
        $query = $this->db->query(
            'SELECT customers.fname, customers.id
            FROM customers, account_customers
            WHERE customers.id = account_customers.customer_id 
            AND account_customers.account_id = ' . $id);

        $query->result();

        return $query->result();
    }

    function getGoodsByAccountId($id) {
        $query = $this->db->query(
            'SELECT goods.id 
            FROM goods, account, account_goods
            WHERE account.account_id = account_goods.account_id
            AND account_goods.good_id = goods.id
            AND account.account_id=' . $id);

        $query->result();

        return $query->result();
    }

    function searchAccountByCustomerName($query) {

        $query = $this->db->query(
            "SELECT account.account_number, account.account_id
            FROM account, account_customers, customers
            WHERE account.account_id = account_customers.account_id
            AND account_customers.customer_id = customers.id
            AND customers.fname LIKE '%". $query . "%'" );

        $query->result();

        return $query->result();

    }

}


