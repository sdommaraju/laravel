<?php

namespace App\Http\Controllers\Api;

use Request;

use App\Http\Requests;
use App\Http\Models\User;
use App\Http\Controllers\Api\BaseController;
use App\Http\Transformers\EmployeeTransformer;
use LucaDegasperi\OAuth2Server\Authorizer;
use App\Http\Models\Employee;
use App\Http\Models\Designation;


class EmployeeController extends BaseController
{
   public function __construct(Authorizer $authorizer){
        
        //$this->middleware('oauth-client',["only"=>["index"]]);
        $this->middleware('oauth-user',["except"=>["index"]]);
        $this->authorizer = $authorizer;
        
    }
    /**
     * @api {get} /employees Fetch All Employees.
     * @apiVersion 1.0.0
     * @apiName GetEmployees
     * @apiGroup Employee
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "data": [
     *       {
     *         "id": 2853,
     *         "employee_code": "660",
     *         "first_name": "Sashank",
     *         "last_name": "Palaparthi",
     *         "middle_name": "",
     *         "email_id": "spalaparthi@innominds.com",
     *         "employee_joiningdate": "2010-07-26"
     *       },
     *       {
     *         "id": 2854,
     *         "employee_code": "179",
     *         "first_name": "Viswanath",
     *         "last_name": "Paluri",
     *         "middle_name": "",
     *         "email_id": "vpaluri@innominds.com",
     *         "employee_joiningdate": "2005-08-01"
     *       }
     *       ]
     *      }
     *
     * @apiError EmployeeNotFound No Employees found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "EmployeeNotFound"
     *     }
     */
    public function index()
    {
       $employees = Employee::all();
        return $this->response->collection($employees, new EmployeeTransformer);
    }

    /**
     * @api {get} /employee/profile Get Employee Profile Details.
     * @apiVersion 1.0.0
     * @apiName GetProfile
     * @apiGroup Employee
     * @apiParam (AuthorizationHeader) {String} Accept Accept value. Allowed values: "application/vnd.myspace.v1+json"
     * @apiParam (AuthorizationHeader) {String} Authorization Token value (example "Bearer 4JosxlXfnoUyhGgBjAtyutO8FxIvRIADN0lp1TI2").
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "data": {
     *      "id": 3000,
     *      "employee_code": "462",
     *      "first_name": "Srinivasulu",
     *      "last_name": "Dommaraju",
     *      "middle_name": "",
     *      "email_id": "sdommaraju@innominds.com",
     *      "employee_joiningdate": "2008-10-13",
     *      "designation": {
     *         "designation_master_id": 8,
     *         "name": "Principal Engineer"
     *       },
     *       "department": {
     *         "department_master_id": 1,
     *         "name": "Engineering"
     *       },
     *       "practice": {
     *         "practise_master_id": 3,
     *         "name": "Application Development"
     *       },
     *       "competency": {
     *         "practise_secondary_master_id": 24,
     *         "name": "Open Source"
     *       }
     *     }
     *   }
     *
     * @apiError EmployeeNotFound No Employee found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "EmployeeNotFound"
     *     }
     */
    public function profile(Authorizer $authorizer){
        $user_id=$authorizer->getResourceOwnerId();
        
        $employee = Employee::find($user_id);
        return $this->response->item($employee, new EmployeeTransformer);
    }
    
    
}
