<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class PaymentModel extends CI_Model
{
    
    public $tableName;
    
    function __construct()
    {
        parent::__construct();
        $this->tableName = 'payment';
    }
    
    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $quary_result = $this->db->get();
        $result = $quary_result->result();
        return $result;
    }
    
    function getById( $param, $id ) {

        $this->db->select('*');
        $this->db->from( $this->tableName );
        $this->db->where( $param, $id );
        $quary_result=$this->db->get();
        $result=$quary_result->result();
        return $result;
    }

    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert($data)
    {
        if ($this->db->insert($this->tableName, $data)) {
            return $this->db->insert_id();
        }
        return -1;
    }
}