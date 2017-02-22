//Angular JS code
var app = angular.module('myMenus', ['ui.bootstrap']);

app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});
var siteUrl;
//app.loadLeftMenu();
app.controller('menuListView', function ($scope, $window,$http) {
	var login_user_id = $('#login_user_id').val();
	siteUrl = $('#siteUrl').val();
	
	$scope.loadMenuList = function() {
		$http.get(siteUrl+'/menuController/getMenuList/').success(function(data){ //alert("==="+data);
			$scope.list = data;
			$scope.currentPage = 1; //current page
			$scope.entryLimit = 5; //max no of items to display in a page
			$scope.filteredItems = $scope.list.length; //Initially for no filter  
			$scope.totalItems = $scope.list.length;
			
		});
	};
	$window.onload  = function () {
		$scope.loadMenuList();
  	};
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
     $scope.open = function () {
            $scope.showModal = true;
    };
    $scope.setMenuPopValues = function (val) {
         
		$('#menu_id').val('');
		$('#txt_menu').val('');
		$('#txt_menu_title').val('');
		$('#txt_menu_url').val('');	
		$('#chk_status').prop('checked','');
		$('#chk_delete').prop('checked','');
		$('select[name="parent_menu_title"]').val('');
		
		if(val!='')
		{
			$('#menuPopupTitle').html('Update Menu');
		}
		else if(val=='')
		{
			$('#menuPopupTitle').html('Add Menu');
		}
		$.ajax({
		type: "POST",
		url: siteUrl+"/menuController/getMenuPopUpValues/"+val, 
		data: val,
		dataType: "json",  
		cache:false,
		success: 
		function(data){
			$('#menu_id').val(data.menu_id); 
			$('#txt_menu').val(data.menu);
			$('#txt_menu_title').val(data.menu_title);
			$('#txt_menu_url').val(data.menu_url);
			$('select[name="parent_menu_title"]').val(data.parent_menu_id);
			if(data.status==1)
			{
				
				$('#chk_status').prop('checked','checked');
			}
			if(data.is_delete==1)
			{
				
				$('#chk_delete').prop('checked','checked');
			}
			
		}
		});// you have missed this bracket
    };
    $scope.manageMenu = function () {
      
    // alert(siteUrl);return false;      
    var menu_id = $('#menu_id').val();
	var txt_menu = $('#txt_menu').val();
	var txt_menu_title = $('#txt_menu_title').val();
	var txt_menu_url = $('#txt_menu_url').val();
	var chk_status = 0;
	var chk_delete = 0;
	var btn_login = $('#btn_login').val();
	var parent_menu_title = $('#parent_menu_title').val();
	//alert(parent_menu_title);
	if($('#chk_status'). prop("checked") == true)
	{
		chk_status = 1;
	}
	else if($('#chk_status'). prop("checked") == false)
	{
		chk_status = 0;
	}
	
	if($('#chk_delete'). prop("checked") == true)
	{
		chk_delete = 1;
	}
	else if($('#chk_delete'). prop("checked") == false)
	{
		chk_delete = 0;
	}
	
	var ajaxUrl = '';
	if(menu_id=='')
	{
		ajaxUrl = siteUrl+"/menuController/addMenu/";
	}
	else if(menu_id!='')
	{
		ajaxUrl = siteUrl+"/menuController/updateMenu/";
	}
	
	$.ajax({
	type: "POST",
	url: ajaxUrl, 
	data: 'menu_id='+menu_id+'&txt_menu='+txt_menu+'&txt_menu_title='+txt_menu_title+'&txt_menu_url='+txt_menu_url+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&parent_menu_title='+parent_menu_title+'&btn_login='+btn_login,
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		$('#menuModal').modal('hide');
		alert(data);
		$scope.loadMenuList();
		//loadMenuList();		
	}
	});
           
    };
});

//Ends

//loadSideMenu();
//loadMenuList();
function manageMenu()
{
	
	var menu_id = $('#menu_id').val();
	var txt_menu = $('#txt_menu').val();
	var txt_menu_title = $('#txt_menu_title').val();
	var txt_menu_url = $('#txt_menu_url').val();
	var chk_status = 0;
	var chk_delete = 0;
	var btn_login = $('#btn_login').val();
	var parent_menu_title = $('#parent_menu_title').val();
	//alert(parent_menu_title);
	if($('#chk_status'). prop("checked") == true)
	{
		chk_status = 1;
	}
	else if($('#chk_status'). prop("checked") == false)
	{
		chk_status = 0;
	}
	
	if($('#chk_delete'). prop("checked") == true)
	{
		chk_delete = 1;
	}
	else if($('#chk_delete'). prop("checked") == false)
	{
		chk_delete = 0;
	}
	
	var ajaxUrl = '';
	if(menu_id=='')
	{
		ajaxUrl = "/cidemo/index.php/menuController/addMenu/";
	}
	else if(menu_id!='')
	{
		ajaxUrl = "/cidemo/index.php/menuController/updateMenu/";
	}
	
	$.ajax({
	type: "POST",
	url: ajaxUrl, 
	data: 'menu_id='+menu_id+'&txt_menu='+txt_menu+'&txt_menu_title='+txt_menu_title+'&txt_menu_url='+txt_menu_url+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&parent_menu_title='+parent_menu_title+'&btn_login='+btn_login,
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		$('#menuModal').modal('hide');
		alert(data);
		//loadMenuList();		
	}
	});
}

function loadSideMenu()
{
	//alert("jjjjj");
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/menuController/setSideMenu/", 
	data: '',
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		//$("ul").append(data);
	}
	});// you have missed this bracket
}
