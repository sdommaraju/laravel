<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class EmployeeHr extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mys_employee_hr_details';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['employee_id'];

	protected $casts = [
	    'is_admin' => 'boolean',
	];
	
	public function department()
	{
	    return $this->hasOne('App\Http\Models\Department','department_master_id', 'department_id')->select(array('department_master_id', 'name'));
	}
	public function practice()
	{
	    return $this->hasOne('App\Http\Models\Practice','practise_master_id', 'practice_id')->select(array('practise_master_id', 'name'));
	}
	public function competency()
	{
	    return $this->hasOne('App\Http\Models\Competency','practise_secondary_master_id', 'competency_id')->select(array('practise_secondary_master_id', 'name'));
	}
}
