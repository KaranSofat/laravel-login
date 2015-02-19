<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <!-- CSS ===================== -->
    <!-- load bootstrap -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="flags.css">
    
    <!-- JS ===================== -->
    <!-- load angular -->
    <script src="bower_components/jquery-2.1.3.min/index.js"></script> 
    <script src="js/index.js"></script>
</head>

<!-- apply angular app and controller to our body -->
<body>


<div class="container">
  
 <div  alt="Czech Republic" /></div>

 <div class="jumbotron">
  <h1>Welcome {{ucwords(Auth::user()->first_name .' '.Auth::user()->last_name) }} </h1>
  <p class="flag flag-{{strtolower(Auth::user()->location)}}"></p>
  <p><a class="btn btn-primary btn-lg" href="{{URL::to('logout')}}" role="button">Logout</a></p>
</div>
 </div><!-- /container -->
</body>
</html>
