<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class ReportModel extends CI_Model
{

    
    function __construct()
    {
        parent::__construct();
        $this->load->model('AccountModel');
        $this->load->model('RentModel');
        $this->load->model('PaymentModel');
    }

    public function reporting($id) {

        $payments = $this->getById('payment', 'rent_id', $id);
        $rentDetail = $this->getRecordById('renting', 'id', $id);
        $timeInterval = $rentDetail->time_interval;
        $paymentTimes = $rentDetail->payment_times;

        $startDate =  new DateTime($rentDetail->start_date);
        
        $amountPaid = '';
        $amountDue = '';

        $test = array();
        $previousDate = '';
        $count = $paymentTimes;
        for($i=0; $i<=$count; $i++) {
            $amountDue = $amountDue + $rentDetail->amount;
            $previousDate = $startDate->format('Y-m-d');  //store date before increment

            $startDate->modify('+' . $timeInterval . ' day')->format('Y-m-d'); // increment date by time interval
            $date = date_format($startDate, 'Y-m-d'); //future date

            $paymentInDate = $this->getPaymentInBetween($previousDate, $date, $id);

            $totalAmountToPaid = $rentDetail->amount * ($paymentTimes + 1);
            //$amountDue can not be greater then amount to be paid
            if( $amountDue > $totalAmountToPaid ) {
                $amountDue = $totalAmountToPaid;
            }

            $object = new stdClass();
            $object->due = $rentDetail->amount;

            if( count($paymentInDate) > 0 ) {

                foreach ($paymentInDate as $item) {
                    $count++;
                    $object = new stdClass();
                    $amountPaid = $amountPaid + $item->paid;
                    $object->date = $item->date;
                    $object->amountPaid = $amountPaid;
                    $object->amountDue = $amountDue;
                    $object->due = '';
                    if($previousDate == $item->date) {
                        $object->due =  $rentDetail->amount;
                    }
                    $object->paid = $item->paid;

                    if($amountPaid >= $amountDue) {
                        $object->arrears = 'N';
                    } else {
                        $object->arrears = 'Y';
                    }

                    array_push($test, $object);
                }     

            } else {
                    
                $object->date = $previousDate;
                $object->amountPaid = $amountPaid;
                $object->amountDue = $amountDue;
                $object->paid = '';
                if($amountPaid >= $amountDue) {
                    $object->arrears = 'N';
                } else {
                    $object->arrears = 'Y';
                }                
                array_push($test, $object);
            }
        }   

        return $test;
    }


    function getById( $table, $param, $id ) {

        $this->db->select('*');
        $this->db->from( $table );
        $this->db->where( $param, $id );
        $quary_result=$this->db->get();
        $result=$quary_result->result();
        return $result;
    }


    function getRecordById( $table, $param, $id ) {

        $this->db->select('*');
        $this->db->from( $table );
        $this->db->where( $param, $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }

    function getPaymentInBetween($startDate, $endDate, $id) {
        $query = $this->db->query(
            "SELECT * FROM payment
            WHERE date < '". $endDate ."'
            AND date >= '". $startDate ."'
            AND rent_id = " . $id );

        $query->result();

        return $query->result();        

    }

}