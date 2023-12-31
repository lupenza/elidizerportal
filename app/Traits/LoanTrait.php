<?php
namespace App\Traits;
use Rap2hpoutre\FastExcel\FastExcel;



trait LoanTrait
{
    public function exportLoanReport($contracts){
        return (new FastExcel($this->loanGenerator($contracts)))->download('LoanReport.xlsx',function($contract){
            
            return [
            'Full name'      =>ucwords($contract->customer?->first_name.' '.$contract->customer?->middle_name.' '.$contract->customer?->last_name),
            'Other Name'     =>ucwords($contract->customer?->other_name),
            'Phone Number'   =>$contract->customer?->phone_number,
            'Gender'         =>$contract->customer?->gender?->name,
            'ID Number'      =>$contract->customer?->id_number,
            'DOB'            =>$contract->customer?->dob,
            'Email'          =>$contract->customer?->email,
            'Region'         =>$contract->customer->region?->name,
            'District'       =>$contract->customer?->district?->name,
            'Ward'           =>$contract->customer?->ward?->name,
            'Street'         =>$contract->customer?->street,
            'Residence Since'     =>$contract->customer?->resident_since,
            'College'             =>$contract->college?->name,
            'College Location'    =>$contract->college?->location,
            'Student Study Year'  =>$contract->student?->study_year,
            'Student Reg ID'      =>$contract->student?->student_reg_id,
            'Student Course'      =>$contract->student?->course,
            'HESLB Status'        =>$contract->student?->heslb_status,
            'Loan Start Date'     =>date('d-M-Y',strtotime($contract->start_date)),
            'Loan Expected End Date' =>date('d-M-Y',strtotime($contract->expected_end_date)),
            'Loan Code'           =>$contract->contract_code,
            'Request Amount'      =>$contract->amount,
            'Total Loan Amount'   =>$contract->loan_amount,
            'Installment Amount'  =>$contract->installment_amount,
            'Loan Plan'           =>$contract->plan,
            'Loan Status'         =>$contract->status,
            'Total Paid In'       =>$contract->current_balance,
            'Outstanding Balance' =>$contract->outstanding_amount,
            'Interest Rate'       =>$contract->interest_rate,
            'Interest Amount'     =>$contract->interest_amount,
            'Fees Amount'         =>$contract->fees_amount,
            'Past Due Days'       =>$contract->past_due_days,
            'Past Due Amount'     =>$contract->past_due_amount,
            'Penalt Amount'       =>$contract->penalt_amount,
            'Penalt Amount Paid'  =>$contract->penalt_amount_paid,
           
            ];
        });
    }

    function loanGenerator($loans) {
        foreach ($loans as $loan) {
            yield $loan;
        }
    }

    public function exportLoanApplicationReport($loans){
        return (new FastExcel($this->loanGenerator($loans)))->download('LoanApplicationReport.xlsx',function($loan){
            
            return [
            'Full name'      =>ucwords($loan->customer?->first_name.' '.$loan->customer?->middle_name.' '.$loan->customer?->last_name),
            'Other Name'     =>ucwords($loan->customer?->other_name),
            'Phone Number'   =>$loan->customer?->phone_number,
            'Gender'         =>$loan->customer?->gender?->name,
            'ID Number'      =>$loan->customer?->id_number,
            'DOB'            =>$loan->customer?->dob,
            'Email'          =>$loan->customer?->email,
            'Region'         =>$loan->customer?->region?->name,
            'District'       =>$loan->customer?->district?->name,
            'Ward'           =>$loan->customer?->ward?->name,
            'Street'         =>$loan->customer?->street,
            'Residence Since'     =>$loan->customer?->resident_since,
            'College'             =>$loan->college?->name,
            'College Location'    =>$loan->college?->location,
            'Student Study Year'  =>$loan->customer?->student?->study_year,
            'Student Reg ID'      =>$loan->customer?->student?->student_reg_id,
            'Student Course'      =>$loan->customer?->student?->course,
            'HESLB Status'        =>$loan->customer?->student?->heslb_status,
            'Loan Start Date'     =>date('d-M-Y',strtotime($loan->created_at)),
            'Request Amount'      =>$loan->amount,
            'Total Loan Amount'      =>$loan->loan_amount,
            'Plan'                   =>$loan->plan,
            'Installment Amount'     =>$loan->installment_amount,
            'Interest Rate'          =>$loan->interest_rate,
            'Interest Rate'          =>$loan->interest_amount,
            'Fees Amount'            =>$loan->fees_amount,
            'Status'                 =>$loan->level,
            'Loan Code'              =>$loan->loan_code,
            ];
        });
    }
}
