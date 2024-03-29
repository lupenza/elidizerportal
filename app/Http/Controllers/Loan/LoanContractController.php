<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\LoanContract;
use App\Models\Management\College;
use App\Traits\LoanTrait;
use Illuminate\Support\Facades\Auth;

class LoanContractController extends Controller
{
    use LoanTrait;
    
    public function index(Request $request){
        $requests  =$request->all();
        $filter   =Auth::user()->hasRole('Agent') ? true : false;

        $contracts =LoanContract::with('customer','student')
                    ->orderBy('start_date','DESC')
                    ->when($requests,function($query) use ($requests){
                        $query->withfilters($requests);
                    })
                    ->whereHas('customer',function ($query) use ($requests){
                        $query->withfilters($requests);
                    })
                    ->whereHas('student',function ($query) use ($requests ){
                        $query->withfilters($requests);
                    })
                    ->when($filter,function ($query){
                        $query->where('college_id',getCollegeId());
                    })
                    ->get();
        $universities =College::latest()->get();
        return view('loans.loan_contracts',compact('contracts','universities','requests'));
    }

    public function profile($uuid){
        $contract =LoanContract::with('customer','loan_approval','installments','payments','guarantors')->where('uuid',$uuid)->first();
        return view('loans.loan_contract_profile',compact('contract'));
    }

    public function generateExcelReport(Request $request){
        $requests  =$request->all();
        $contracts =LoanContract::with('customer','student')
                    ->latest()
                    ->when($requests,function($query) use ($requests){
                        $query->withfilters($requests);
                    })
                    ->whereHas('customer',function ($query) use ($requests){
                        $query->withfilters($requests);
                    })
                    ->whereHas('student',function ($query) use ($requests){
                        $query->withfilters($requests);
                    })
                    ->cursor();

        return self::exportLoanReport($contracts);
    }
}
