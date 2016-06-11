<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class DuesModel extends CI_Model
{

    
    function __construct()
    {
        parent::__construct();
        $this->load->model('AccountModel');
        $this->load->model('RentModel');
        $this->load->model('PaymentModel');
    }
    
    public function getDues()
    {
        
        $rents     = $this->RentModel->selectAll();
        $todayDate = date('Y-m-d');
        
        $duesArray = array();
        
        foreach ($rents as $rent) {
            $dateDifference = $this->dateDifference($rent->start_date, $todayDate);
            
            $time = $dateDifference / $rent->time_interval; //konsi bari chal rahi hai time interval ki
            
            $time = (int)$time;

            if( $time > $rent->payment_times ) {
                $time = $rent->payment_times;
            }

            //payment times must be lesser then times
            //if ( $rent->payment_times >= $time && $time > 0) {
            if ( $time > 0) {

                $accounts = $this->PaymentModel->getById( 'rent_id', $rent->id );

                $amountPayable = $time * $rent->amount;

                $totalPaidAmount = '';

                foreach ( $accounts as $account ) {

                    $totalPaidAmount = $totalPaidAmount + $account->paid;
                }

                if( $totalPaidAmount < $amountPayable ) {
                    array_push($duesArray, $rent);
                }
            }
                    
        }
        
        return $duesArray;

    }

    public function getDuesByRentIds($data) {

        $accountId = '';

        foreach($data as $item) {
            $accountId = $accountId . $item->id . ',';
        }

        return $accountId = rtrim($accountId, ',');

    }

    public function getDuesDetail($accountIds) {
        $query = $this->db->query(
            'SELECT account.account_number, customers.fname, goods.manufacturer, renting.start_date, renting.amount, renting.time_interval, renting.payment_times
            FROM renting, account, customers, goods
            WHERE renting.account_id = account.account_id
            AND renting.good_id = goods.id
            AND renting.customer_id = customers.id 
            AND renting.id in (' . $accountIds . ')');

        $query->result();

        return $query->result();

    }

    public function dateDifference($startDate, $todayDate)
    {
        $dStart = new DateTime($startDate);
        $dEnd   = new DateTime($todayDate);
        $dDiff  = $dStart->diff($dEnd);
        $diffInDays = (int)$dDiff->format("%r%a"); // use for point out relation: smaller/greater

        return $diffInDays;
    }



}