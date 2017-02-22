var app = angular.module('myLeaves', ['ui.bootstrap']);



app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.controller('listView', function ($scope, $http, $timeout) {
	var login_user_id = $('#login_user_id').val();
    $http.get('/cidemo/index.php/leavesController/getAppliedLeaveList/'+login_user_id).success(function(data){
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() { 
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) { 
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});

var leavesApp = angular.module('myLeavesList', ['ui.bootstrap']);

leavesApp.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

leavesApp.controller('otherLeaves', function ($scope, $http, $timeout) {
	var login_user_id = $('#login_user_id').val();
	var typ = 'Other';
    $http.get('/cidemo/index.php/leavesController/getLeaveList/'+typ).success(function(data){ //alert(data);
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() { 
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) { 
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});

leavesApp.controller('holidayLeaves', function ($scope, $http, $timeout) {
	var login_user_id = $('#login_user_id').val();
	var typ = 'Holiday';
    $http.get('/cidemo/index.php/leavesController/getLeaveList/'+typ).success(function(data){ //alert(data);
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() { 
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) { 
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});

