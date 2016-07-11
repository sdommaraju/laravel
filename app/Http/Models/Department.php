<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mys_department_master';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	
}
