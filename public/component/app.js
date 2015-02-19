 
// create angular app
    var demoApp = angular.module('demoApp', []);

    // create angular controller
    demoApp.controller('mainController', function($scope,Auth) {


        //initilize  user
        $scope.user = {};
        // function to submit the form after all validation has occurred            
        $scope.submitForm = function(isValid) {
         if(!isValid){

           $scope.errormessage  = "Input Error, please provide right inputs";
         
          }
         else{
           
            var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
            if(iOS == false){
                iOS  = '1'; 
            }else{
                iOS  = '0';
            }
            $scope.user.isIos = iOS; 

             Auth.Register(JSON.stringify($scope.user)).then(function(response){
               console.log(response);
             
             });

         }

        
            
        };

    });
   
   demoApp.directive('passwordValidate', function() {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            ctrl.$parsers.unshift(function(viewValue) {

                scope.pwdValidLength = (viewValue && viewValue.length >= 8 ? 'valid' : undefined);
                scope.pwdHasUpperLetter = (viewValue && /[A-Z]/.test(viewValue)) ? 'valid' : undefined;
                scope.pwdHasNumber = (viewValue && /\d/.test(viewValue)) ? 'valid' : undefined;
                scope.pwdHasLowerLetter = (viewValue && /[a-z]/.test(viewValue)) ? 'valid' : undefined;

                if(scope.pwdValidLength && scope.pwdHasUpperLetter && scope.pwdHasNumber && scope.pwdHasLowerLetter) {
                    ctrl.$setValidity('pwd', true);
                    return viewValue;
                } else {
                    ctrl.$setValidity('pwd', false);                    
                    return undefined;
                }

            });
        }
    };
});




 //factory for authentication and login signup 
demoApp.factory('Auth',function($http,$q){

  return{
    login:function(item){

           var Url = 'login';
           var defer = $q.defer();

           $http.post(Url,item).
              success(function (data, status, headers, config) {
                  defer.resolve(data);
              }).
              error(function (data, status, headers, config) {
                  defer.reject();
              });

            return defer.promise;
    },

    logout:function(){
       storageService.remove('loggedIn');
    },

    Register:function(item){
           var Url = '/{test}/public/app/register';
           var defer = $q.defer();

           $http.post(Url,item).
              success(function (data, status, headers, config) {
                  defer.resolve(data);
              }).
              error(function (data, status, headers, config) {
                  defer.reject();
              });

            return defer.promise;

    },

    auth_token:function(){
      var user_data =  storageService.get('user_data');
      var data = JSON.parse(user_data);
      return  data[0].auth_token;
    }

  }

})