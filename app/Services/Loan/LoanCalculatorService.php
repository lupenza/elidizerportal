<?php

namespace App\Services\Loan;
use App\Models\Loan\LoanApplication;

class LoanCalculatorService
{
    // public function __construct()
    // {
        
    // }

    public static function calculator($data){
        $amount =$data['amount'];
        $plan   =$data['plan'];

        $details['total_amount']       =$amount*1.25;
        $details['installment_amount'] =$details['total_amount']/$plan;
        $details['start_date']          =date('Y-m-d');
        $details['end_date']           =date('Y-m-d', strtotime("+".$plan." months", strtotime($details['start_date'])));
        $details['interest_amount']    =$details['total_amount'] - $amount;
        $details['amount']             =$amount;
        $details['plan']               =$plan;

        return $details;


    }


    public function loanCode() { 
        do
        {
            $token = $this->char_string(4);
            $code = 'EL'. $token . substr(strftime("%Y", time()),2);
            $user_code = LoanApplication::where('loan_code',$code)->first();
        }
        while(!empty($user_code));
        return $code;
    }

    private function char_string($length){    
        $token = "";
        $codeAlphabet = "ELDIZERFINANCE";
        $codeAlphabet.= "0123456789875532423458609543";

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }

}
