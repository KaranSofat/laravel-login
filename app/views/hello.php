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
    <script src="packages/angular/angular.min.js"></script> 
    <script src="component/app.js"></script>
</head>

<!-- apply angular app and controller to our body -->
<body ng-app="demoApp" ng-controller="mainController">
<div class="container">
<div class="col-sm-8 col-sm-offset-2">
    
    <!-- PAGE HEADER -->
    <div class="page-header"><h1>Register Here</h1></div>
   
    <!-- FORM -->
    <!-- pass in the variable if our form is valid or invalid -->
    <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate> <!-- novalidate prevents HTML5 validation since we will be validating ourselves -->
	 <p ng-show="errormessage" class="help-block">{{errormessage}}</p>
	        <!-- NAME -->
    <div class="form-group" ng-class="{ 'has-error' : userForm.first_name.$invalid && !userForm.first_name.$pristine }">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" ng-model="user.first_name" required>
        <p ng-show="userForm.first_name.$invalid && !userForm.first_name.$pristine " class="help-block">Your First name is required.</p>
    </div>
    
    <!-- USERNAME -->
    <div class="form-group" ng-class="{ 'has-error' : userForm.last_name.$invalid && !userForm.last_name.$pristine }">
        <label>Last name</label>
        <input type="text" name="last_name" class="form-control" ng-model="user.last_name"ng-minlength="3" ng-maxlength="8">
        <p ng-show="userForm.first_name.$invalid && !userForm.first_name.$pristine " class="help-block">Your First name is required.</p>
       
    </div>
        
    <!-- EMAIL -->
    <div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
        <label>Email</label>
        <input type="email" name="email" class="form-control" ng-model="user.email">
        <p ng-show="userForm.email.$invalid && !userForm.email.$pristine " class="help-block">Enter a valid email.</p>
    </div>
    <!-- Password -->
   

  <div class="form-group" ng-class="{ 'has-error' : userForm.password.$invalid && !userForm.password.$pristine }">
  	<label>Password</label>
    <input ng-model="user.password" class="form-control" password-validate required type="password" id="inputPassword" placeholder="Password">

    <div class="input-help">
      <h4>Password must meet the following requirements:</h4>
      <ul>
        <li ng-class="pwdHasUpperLetter">At least <strong>one Upper letter</strong></li>
        <li ng-class="pwdHasLowerLetter">At least <strong>one Lower letter</strong></li>
        <li ng-class="pwdHasNumber">At least <strong>one number</strong></li>
        <li ng-class="pwdValidLength">At least <strong>8 characters long</strong></li>
      </ul>
    </div>
   </div> 
     <!-- SUBMIT BUTTON -->
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div><!-- col-sm-8 -->
 </div><!-- /container -->
</body>
</html>
