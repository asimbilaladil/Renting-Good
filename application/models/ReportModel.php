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

        $previousDate = '';

        $datesArray = array();
        $paymentDates = array();

        //push normal dates
        for($i=0; $i<=$paymentTimes; $i++) {

            $previousDate = $startDate->format('Y-m-d');
            $nextDate = $startDate->modify('+' . $timeInterval . ' day')->format('Y-m-d');

            array_push($datesArray, $previousDate);
            array_push($datesArray, $nextDate);
        }

        //push payments dates
        foreach($payments as $payment) {
            //$paymentDate = new DateTime($payment->date);
            array_push($paymentDates, $payment->date);
            //array_push($paymentDates, $paymentDate->format('d-m-Y'));
        }

        //merge arrays
        $datesList = array_merge($datesArray, $paymentDates);

        //unique them
        $datesList = array_unique($datesList);

        //sort them
        usort($datesList, function($a1, $a2) {
           $v1 = strtotime($a1);
           $v2 = strtotime($a2);
           return $v1 - $v2; // $v2 - $v1 to reverse direction
        });

        $reporting = array();
        $preDate = $rentDetail->start_date;
        $totalAmountToPaid = $rentDetail->amount * ($paymentTimes + 1);
        foreach ($datesList as $date) {
            $object = new stdClass();
            $paymentItem = $this->getPaymentByIdAndDate('rent_id', $id, 'date', $date);

            

            if( $amountDue > $totalAmountToPaid) {
                $amountDue = $totalAmountToPaid;
            }

            $object->date = $date;
            $object->paid = '';
            $object->due = '';
            $object->arrears = 'N';
            if( count($paymentItem) > 0 ){
                $object->paid = $paymentItem->paid;
                $amountPaid = $amountPaid + $paymentItem->paid;
            }

            $diff = $this->dateDifference($preDate, $date);
            
            //normal days. If difference is $timeInterval i.e 7 or 14 or it 0 then it is normal day
            if($diff == $timeInterval || $diff == 0) {
                $preDate = $date;
                $object->due = $rentDetail->amount;
                $amountDue = $amountDue + $rentDetail->amount;
            }

            //if amount paid is greater then there is no arrears
            if($amountPaid < $amountDue) {
                $object->arrears = 'Y';
            }

            array_push( $reporting, $object);

        }
        
        return $reporting;

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


    function getPaymentByIdAndDate( $param1, $id ,$param2, $date ) {

        $this->db->select('*');
        $this->db->from( 'payment' );
        $this->db->where( $param1, $id );
        $this->db->where( $param2, $date );
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

    public function dateDifference($startDate, $todayDate) {
        $dStart = new DateTime($startDate);

        $dEnd   = new DateTime($todayDate);

/*        $dEnd->modify('+1 day');*/

        $dDiff  = $dStart->diff($dEnd);
        $diffInDays = (int)$dDiff->format("%r%a"); // use for point out relation: smaller/greater

        return $diffInDays;
    }

}