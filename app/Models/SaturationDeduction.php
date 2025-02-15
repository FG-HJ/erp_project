<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaturationDeduction extends Model
{
    protected $fillable = [
        'employee_id',
        'deduction_option',
        'title',
        'amount',
        'created_by',
    ];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id')->first();
    }

    public function deduction_option()
    {
        return $this->hasOne('App\Models\DeductionOption', 'id', 'deduction_option')->first();
    }
    public static $saturationDeductiontype = [
        'fixed'=>'Fixed',
        'percentage'=> 'Percentage',
    ];
    public function updatedata($data){
        $imss['amount']=$data['imss'];
        $isr['amount']=$data['isr'];
        $subsidio['amount']=$data['subsidio'];
        $this->where("title", "IMSS")->update($imss);
        $this->where("title", "ISR")->update($isr);
        $this->where("title", "Subsidio")->update($subsidio);
    }
}
