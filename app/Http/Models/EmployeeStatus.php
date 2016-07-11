<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class EmployeeStatus extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mys_employee_status';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['employee_id'];

	protected $casts = [
	    'is_admin' => 'boolean',
	];
	
	public function designation()
	{
	    return $this->hasOne('App\Http\Models\Designation','designation_master_id', 'desgination_id')->select(array('designation_master_id', 'name'));
	}
	
}
