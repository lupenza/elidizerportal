<?php

namespace App\Models\Loan;

use App\Models\Management\College;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Management\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use  App\Models\Management\Device;

class LoanApplication extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['customer_id','college_id','amount','loan_amount','plan','installment_amount','interest_rate','interest_amount','fees_amount',
    'level','loan_code','uuid','start_date','loan_type','device_id','initial_deposit'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function loan_contract(){
        return $this->hasOne(LoanContract::class,'loan_application_id','id');
    }

    public function loan_approval(){
        return $this->hasOne(LoanApproval::class);
    }

    public function college(){
        return $this->hasOne(College::class,'id','college_id');
    }

    public function guarantors(){
      return $this->hasMany(Guarantor::class);
    }

    public function scopeWithFilters($query,$request){
        
        $start_date        =$request['application_start_date'] ?? null;
        $end_date          =$request['application_end_date'] ?? null;
        $college_id        =$request['college_id'] ?? null;
        $contract_status   =$request['status'] ?? null;
    
        return $query->when($start_date,function($query) use ($start_date,$end_date){
            if ($start_date != null || $end_date != null) {
                if ($start_date != null && $end_date != null)
                    $query->whereBetween('created_at', [$start_date, $end_date]);
    
                else if ($start_date != null)
                    $query->where('created_at', '>=', $start_date);
    
                else if ($end_date != null)
                    $query->where('created_at', '<=', $end_date);
            }
            })
            ->when($contract_status,function($query) use ($contract_status){
                $query->where('level',$contract_status);
            })
            ->when($college_id,function($query) use ($college_id){
                $query->where('college_id',$college_id);
            });
           
           
     }

     public function getlevelFormattedAttribute(){
        switch ($this->level) {
          case 'Application':
            $label ="<span class='badge bg-info text-white'>".$this->level."</span>";
            break;
          case 'Rejected by Agent':
            $label ="<span class='badge bg-danger text-white'>".$this->level."</span>";
            break;
          case 'Rejected by Admin':
            $label ="<span class='badge bg-danger text-white'>".$this->level."</span>";
            break;
          case 'Approved By Agent':
            $label ="<span class='badge bg-success text-white'>".$this->level."</span>";
            break;
          case 'Granted':
            $label ="<span class='badge bg-success text-white'>".$this->level."</span>";
            break;
          case 'CLOSED':
            $label ="<span class='badge bg-info text-white'>".$this->level."</span>";
            break;
          default:
          $label ="<span class='badge bg-info text-white'>".$this->level."</span>";
            break;
        }
    
        return $label;
      }

      public function getLoanTypeFormatAttribute(){
        if ($this->loan_type == 1) {
          return "<span class='badge bg-success text-white'>Cash</span>";
        } else {
          return "<span class='badge bg-success text-white'>Pay Later</span>";
        }
        
      }

      public function get_device(){
        return $this->hasOne(Device::class,'id','device_id');
      }
}
