<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden   = array('password', 'remember_token');


	protected $fillable = array('email', 'first_name','last_name','password','location','ip','ios');

	 private $rules = array(
         'first_name' => 'required|min:4',
         'last_name' => 'required|min:4',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
    );

     
     private $errors;
     
	 public function validate($data){
		 
        $v = Validator::make($data, $this->rules);
        if($v->fails()) {
           
        $this->errors= $v->errors();
        
        return false;
        }
        return true;
       
    }
	 public function errors()
    {
        return $this->errors;
    }

}
