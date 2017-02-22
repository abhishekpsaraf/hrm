var app = angular.module('myCompany', ['ui.bootstrap']);

app.controller('companySignUp', function ($scope, $http, $timeout) { //alert("HEEEEEEEEEEE");
	$scope.loadCountry = function(){  
	$http.get("/cidemo/index.php/CompanyController/getLocationList/").success(function(data){  
			$scope.countries = data;  
	   });  
    };
    $scope.loadState = function(){  //alert($scope.tbl_country);
    $http.get("/cidemo/index.php/CompanyController/getStateList/"+$scope.tbl_country)  
           .success(function(data){  //alert(data);
                $scope.states = data; 
                 
           }); 
           
           //$scope.states = ''; 
           //$scope.cities= '';
    }; 
    $scope.loadCity = function (){ //alert($scope.tbl_state);
	$http.get("/cidemo/index.php/CompanyController/getCityList/"+$scope.tbl_state)  
	   .success(function(data){  //alert(data);
			$scope.cities = data;  
	   }); 
	   
	   $scope.cities  = ''; 
	}; 
});


