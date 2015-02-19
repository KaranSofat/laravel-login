<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <!-- CSS ===================== -->
    <!-- load bootstrap -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="style.css">
    
    <!-- JS ===================== -->
    <!-- load angular -->
    <script src="bower_components/jquery-2.1.3.min/index.js"></script> 
    <script src="js/index.js"></script>
</head>

<!-- apply angular app and controller to our body -->
<body>
<div class="page-spinner-bar">
  <img src="img/loading.gif">
</div>

<div class="container">
   <div class="col-sm-8 col-sm-offset-2" id ="register_form" style="display:none;">
    
    <!-- PAGE HEADER -->
    <div class="page-header"><h1>Register Here</h1></div>
    <ul class="error_later"></ul>
    <!-- FORM -->
    <!-- pass in the variable if our form is valid or invalid -->
    <form name="userForm" id="registerform"> 
	        <!-- NAME -->
        <div class="form-group" >
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
        </div>
        
        <!-- USERNAME -->
        <div class="form-group" >
            <label>Last name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
           
        </div>
        
        <!-- EMAIL -->
        <div class="form-group" >
            <label>Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email ">
            <p class="help-block email_error" style="display:none;">Enter a valid email.</p>
           </div>
        <!-- Password -->
       

           <div class="form-group" >
        	 <label>Password</label>
             <input class="form-control" id="password" name = "password" required type="password" id=" inputPassword" placeholder="Password">
             <div class="pass_error" style="display:none;">
               <h4>Password must meet the following requirements:</h4>
                  <ul>
                    <li>At least <strong>one Upper letter</strong></li>
                    <li >At least <strong>one Lower letter</strong></li>
                    <li >At least <strong>one number</strong></li>
                    <li >At least <strong>8 characters long</strong></li>
                  </ul>
              </div>
           </div> 
         <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
     </div><!-- col-sm-8 -->
   
    <div class="col-sm-8 col-sm-offset-2" id ="login_form"> 

       <form name="userloginForm" id="loginform"> 
        <div class="page-header"><h1>Please Login to continue...</h1></div>
        <ul class="error_login"></ul>
       
        <div class="form-group" >
            <label>Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email ">
        </div>
        <!-- Password -->
       

       <div class="form-group" >
            <label>Password</label>
            <input class="form-control" id="password" name = "password" required type="password" id=" inputPassword" placeholder="Password">
        </div>

         <button type="submit" id="loginbutton" class="btn btn-primary">Login</button>
         <a href="javascript:void()" class="register_user"> Register here </a>
     </div>

 </div><!-- /container -->
</body>
</html>
