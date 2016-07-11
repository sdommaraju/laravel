<?php 

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Http\Models\Employee;
use App\Http\Models\Designation;

class EmployeeTransformer extends TransformerAbstract {
    public function transform(Employee $employee) {
        return [
            'id' => $employee->id,
            'employee_code' => $employee->employee_code,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'middle_name' => $employee->middle_name,
            'email_id' => $employee->email_id,
            'employee_joiningdate' => $employee->employee_joiningdate,
            'designation' => $employee->status->designation,
            'department' => $employee->hr->department,
            'practice' => $employee->hr->practice,
            'competency' => $employee->hr->competency,
        ];
    }
    
}