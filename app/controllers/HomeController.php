<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	//login user view

	public function dashboard(){

		return View::make('dash');
	}
    

    public function RegisterUser(){
            //get json input
            $input = Input::all();

            $model= new User;		 
		   //validate user 
		    if($model->validate($input)){
		    	//if validated save 
		    	$ip = '14.96.201.5';//$_SERVER['REMOTE_ADDR'];
		    	
				$model->first_name =  Input::get('first_name');	
				$model->last_name  =  Input::get('last_name');	
				$model->email      =  Input::get('email');
				$model->password   =  Hash::make(Input::get('password'));
				$model->location   =  $this->getlocation();
				$model->ip         =  $ip;
				$model->ios     =  Input::get('device');

				if($model->save()){

					echo json_encode(array('status'=>'success'));
				}
				
		  }
		  else
		  {
		  	//if validation not true
			 echo json_encode(array('error'=>$model->errors()));
		  }	 
      
    }


    //login user


    public function loginuser(){

      if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
			{
                 //login succes 
			    echo json_encode(array('status'=>200));
			}
			else
			{ 
                //login error , log attempts   
                $this->putinlogs(); 
		    }


    }


    //logs for login attempt

    public function putinlogs(){

         $ip = $_SERVER['REMOTE_ADDR'];

         $logs =  Logs::where('ip',$ip)->first();
            if(isset($logs->id)){
             if($logs->login_attempt == 3){
              //send email to admin regadring auth attempt
              $email =  Mail::send('emails.error', array('email'=>Input::get('email')), function($message)
						{   
							$message->from('us@example.com', 'Laravel');
						    $message->to('admin@example.com', 'John Smith')->subject('Fail login attempt!');
						});
		               if($email){
                            
                        //using fake email so will not come here

		               }else
		               {
		               	  //set attempt to 0 for next cycle
		               	    $log  = Logs::find($logs->id);
			                $log->login_attempt = 0;
			                if($log->save()){
			                   $log->touch(); 
			                   $error = 403;
			                }
		               }
               }
               else{
               	//if user has attempted before. add to attempt. not using any time attempt here.
               	$log  = Logs::find($logs->id);
                $log->login_attempt = $log->login_attempt + 1;
                if($log->save()){
                   $log->touch(); 
                   $error = 404;
                }  

               }

		     }
		     else
		     {
		     	//new user attempt
			      $log  = new Logs;
			      $log->ip            = $ip;
			      $log->location      = $this->getlocation(); 
			      $log->login_attempt = 1;
  			      if($log->save()){
			      	$error = 404;
			      }  

		     }
              //return response status
             echo json_encode(array('status'=>$error));

    }

    //get location

    public function getlocation(){
                //get geolocation
    	        $ip = $_SERVER['REMOTE_ADDR'];
		    	
	            $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));

	            return $details->geoplugin_countryCode;
	
    }

    //logout user
    public function logoutuser(){

    	    Auth::logout();
    		return Redirect::to('/');

    }

}
