$(document).ready(function(){

  $('#registerform').submit(function(e){
   //prevent default
   e.preventDefault();
  //get email and password for check
   var email     =  $('#email').val();
   var password  =  $('#password').val();
  //check if both email and passwords are correct
   if(IsEmail(email) && Isvalidpass(password)){
     //if valid serialize form
     var input =  $('#registerform').serialize();
     var iOS   =  (navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
     //send ajax
     $.ajax({
		    type:'post',
		    url:'app/register',
		    data:input+"&device="+iOS,
		    beforeSend:function(){
		        launchpreloader();
		    },
		    complete:function(){
		        stopPreloader();
		    },
		    success:function(result){
		         var result = JSON.parse(result);
		         //if error
		         if(result.error){
		         	$error = [];
		         	$.each(result.error, function(key,val){
		         	 li = "<li>"+val+"</li>";
		         	 $error.push(li);
		         	})
		         	$('.error_later').html($error);
		         
		         }else if(result.status){
		         	//register success show login
                   $('#login_form').show();
                   $('#register_form').hide();
		         }else
		         {
		         	//server error
		         	$('.error_later').html('<li>Server Error, Please try again</li>');
		         }
		    }
      });

   }else{
   
   //email error 
     if(!IsEmail(email)){
        $('.email_error').show();
      }

     //pass error
     if(!Isvalidpass(password)){
        $('.pass_error').show();
     }
     return;
   }

   

  })

//check password validation on key up
 $('#password').bind('keyup',function(){
   var pass  = $(this).val();
   console.log(pass);
    //pass error
     if(!Isvalidpass(pass)){
        $('.pass_error').show();
     }else{
     	$('.pass_error').hide();
     }
 })

//login user 

$('#loginform').submit(function(e){

	 e.preventDefault();
	
     var input =  $('#loginform').serialize();
     $.ajax({
		    type:'post',
		    url:'app/login',
		    data:input,
		    beforeSend:function(){
		        launchpreloader();
		    },
		    complete:function(){
		        stopPreloader();
		    },
		    success:function(result){
		         var result = JSON.parse(result);
		         //login success
		         if(result.status == '200'){
		         	//take user to his dashboard
		            document.location.href = '/dashboard';
                 
                 }
                 //login fail and attempt is first - three
		         else if(result.status  == '404'){
		           $('.error_login').html("<li>login failed,wrong email or password </li>");

		         }else if(result.status  == '403'){
		         	//attempt greater than 3. disable login button
		         	$('.error_login').html("<li>User blocked for two minutes. Try after 2 minutes.</li>");
		         	$('#loginbutton').prop('disabled',true);
		         	setInterval(function(){
		         	   $('#loginbutton').removeAttr('disabled');
		         	},120000);
                    
		         }else
		         {
		         	$('.error_login').html('<li>Server Error, Please try again</li>');
		         }
		    }
      });


})

$('.register_user').on('click',function(){

   $('#register_form').show();
   $('#login_form').hide();


})


//test email
  function IsEmail(email) {
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   return regex.test(email);
 }

 //test password 
 function Isvalidpass(pass){

   var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/;
   return regex.test(pass);

 }

 function launchpreloader(){
   $('.page-spinner-bar').show();
 }

 function stopPreloader(){
   $('.page-spinner-bar').hide();
 }
 


})