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
        
        $accounts = $this->AccountModel->selectAll();
        $todayDate = date('Y-m-d');
        
        $duesArray = array();
        
        foreach ($accounts as $account) {
            $dateDifference = $this->dateDifference($account->start_date, $todayDate);
            
            $time = $dateDifference / $account->time_interval; //konsi bari chal rahi hai time interval ki
            
            $time = (int)$time;

            if( $time > $account->payment_times ) {
                $time = $account->payment_times;
            }

            //payment times must be lesser then times
            //if ( $rent->payment_times >= $time && $time > 0) {
            if ( $time > 0) {

                $payments = $this->PaymentModel->getById( 'account_id', $account->account_id );

                $amountPayable = ($time+1) * $account->amount; // add 1 in time to count the 1st payment that is drop in the table when renting

                $totalPaidAmount = '';

                foreach ( $payments as $payment ) {

                    $totalPaidAmount = $totalPaidAmount + $payment->paid;
                }

                if( $totalPaidAmount < $amountPayable ) {
                    array_push($duesArray, $account);
                }
            }
                    
        }
        
        return $duesArray;

    }

    public function getDuesByAccountIds($data) {

        $accountId = '';

        foreach($data as $item) {
            $accountId = $accountId . $item->account_id . ',';
        }

        return $accountId = rtrim($accountId, ',');

    }

    public function getDuesDetail($accountIds) {
        $query = $this->db->query(
            'SELECT account.account_id, account.account_number, account.amount, account.start_date, account.payment_times, account.time_interval
                FROM account
                WHERE account.account_id in (' . $accountIds . ')');

        $query->result();

        return $query->result();

    }

    public function dateDifference($startDate, $todayDate)
    {
        $dStart = new DateTime($startDate);

        $dEnd   = new DateTime($todayDate);

        $dEnd->modify('+1 day');

        $dDiff  = $dStart->diff($dEnd);
        $diffInDays = (int)$dDiff->format("%r%a"); // use for point out relation: smaller/greater

        return $diffInDays;
    }



}