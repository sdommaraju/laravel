<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mys_employee';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['email_id'];

	protected $casts = [
	    'is_admin' => 'boolean',
	];
	
	public function designation()
	{
	    return $this->hasOne('App\Http\Models\Designation','designation_master_id', 'designation_id')->select(array('designation_master_id', 'name'));;
	}
	public function hr()
	{
	    return $this->hasOne('App\Http\Models\EmployeeHr','employee_id', 'id');
	}
	public function status()
	{
	    return $this->hasOne('App\Http\Models\EmployeeStatus','employee_id', 'id');
	}
}
