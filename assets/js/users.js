//alert("USERS");
//Angular JS code
var app = angular.module('myUsers', ['ui.bootstrap']);

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
app.controller('listView', function ($scope, $window, $http) {
	var login_user_id = $('#login_user_id').val();
	var company_id = $('#company_id').val();
	siteUrl = $('#siteUrl').val();
	$scope.loadUserList = function() {
		$http.get(siteUrl+'/UsersController/getUserInformation/').success(function(data){ //alert(data);
			$scope.list = data;
			$scope.currentPage = 1; //current page
			$scope.entryLimit = 5; //max no of items to display in a page
			$scope.filteredItems = $scope.list.length; //Initially for no filter  
			$scope.totalItems = $scope.list.length;
			
		});
	};
	$window.onload = function() {
		$scope.loadUserList();
	}	
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
    $scope.setPopValues = function (val){
		//alert("----->"+val);
		$('#txt_id').val('');
		$('#txt_fname').val('');
		$('#txt_lname').val('');
		$('#txt_email').val('');
		$('#txt_mobile').val('');
		$('#txt_username').val('');
		$('#txt_password').val('');
		$('#chk_status').prop('checked','');
		$('select[name="user_designation"]').val('');
		$('select[name="reporting_person"]').val('');
		$('input[name^="chk_menu"]').each(function() {
		$(this). prop("checked",'');
		});
		$('input[name^="chk_leaves"]').each(function() {
		$(this). prop("checked",'');
		});
		
		$.ajax({
		type: "POST",
		url: siteUrl+"/UsersController/getPopUpValues/"+val, 
		data: val,
		dataType: "json",  
		cache:false,
		success: 
		function(data){ 
			$('#txt_id').val(data.id);
			$('#txt_fname').val(data.fname);
			$('#txt_lname').val(data.lname);
			$('#txt_email').val(data.email);
			$('#txt_mobile').val(data.mobile);
			$('#txt_username').val(data.username);
			$('#txt_password').val(data.password);
			//alert(data.reporting_person_id);
			$('select[name="user_designation"]').val(data.role_id);
			var reptUser = getReportingUserList(data.id,data.reporting_person_id);
			if(data.status==1)
			{
				$('#chk_status').prop('checked','checked');
			}
			if(data.user_menu_access!='')
			{
				var menuChk = data.user_menu_access.split(',');
				
				for(var i=0;i<menuChk.length;i++)
				{
					//alert(menuChk[i]);
					$('#chk_menu'+menuChk[i]).prop('checked','checked');
				}
				
			}
			if(data.user_leaves_access!='')
			{
				var leavesChk = data.user_leaves_access.split(',');
				
				for(var i=0;i<leavesChk.length;i++)
				{
					//alert(menuChk[i]);
					$('#chk_leaves'+leavesChk[i]).prop('checked','checked');
				}
				
			}
			
		}
		});// you have missed this bracket
	};
	 $scope.updateUser = function (){
		var txt_id = $('#txt_id').val();
		var txt_fname = $('#txt_fname').val();
		var txt_lname = $('#txt_lname').val();
		var txt_email = $('#txt_email').val();
		var txt_mobile = $('#txt_mobile').val();
		var txt_username = $('#txt_username').val();
		var txt_password = $('#txt_password').val();
		var user_designation = $('#user_designation').val();
		var reporting_person = $('#reporting_person').val();
		var company_id = $('#company_id').val();
		var company_branch_id = $('#company_branch_id').val();
		var chk_status = 0;//$('#chk_status').val();
		var btn_login = $('#btn_login').val();
		
		if($('#chk_status'). prop("checked") == true)
		{
			chk_status = 1;
		}
		else if($('#chk_status'). prop("checked") == false)
		{
			chk_status = 0;
		}
	
		$.ajax({
		type: "POST",
		url: siteUrl+"/UsersController/updateUser/", 
		data: 'txt_id='+txt_id+'&txt_fname='+txt_fname+'&txt_lname='+txt_lname+'&txt_lname='+txt_lname+'&txt_email='+txt_email+'&txt_mobile='+txt_mobile+'&txt_username='+txt_username+'&txt_password='+txt_password+'&reporting_person='+reporting_person+'&user_designation='+user_designation+'&company_id='+company_id+'&company_branch_id='+company_branch_id+'&chk_status='+chk_status+'&btn_login='+btn_login,
		dataType: "text",  
		cache:false,
		success: 
		function(data){ 
			$('#myModal').modal('hide');
			alert(data);
			$scope.loadUserList();
			//loadUserList();		
		}
		});
		};
	$scope.assignMenu = function (){
		
		var txt_id = $('#txt_id').val();
		var menuVal ='';
		$('input[name^="chk_menu"]').each(function() {
		//$(this).val('');
		if($(this). prop("checked")==true)
		{
			menuVal += $(this).val()+',';
		}
		});
		menuVal = menuVal.replace(/^,|,$/g,'');
		
		//alert(menuVal);
		//return false;
		$.ajax({
		type: "POST",
		url: "../UsersController/assignMenu/"+txt_id, 
		data: "menuVal="+menuVal,
		dataType: "text",  
		cache:false,
		success: 
		function(data){ 
			$('#myMenu').modal('hide');
			alert(data);		
		}
		});// you have missed this bracket
		
	};
  $scope.assignLeaves = function (){
		
		var txt_id = $('#txt_id').val();
		var leavesVal ='';
		$('input[name^="chk_leaves"]').each(function() {
		//$(this).val('');
		if($(this). prop("checked")==true)
		{
			leavesVal += $(this).val()+',';
		}
		});
		leavesVal = leavesVal.replace(/^,|,$/g,'');
		
		//alert(menuVal);
		//return false;
		$.ajax({
		type: "POST",
		url: "../UsersController/assignLeaves/"+txt_id, 
		data: "leavesVal="+leavesVal,
		dataType: "text",  
		cache:false,
		success: 
		function(data){ 
			$('#myLeaves').modal('hide');
			alert(data);		
		}
		});// you have missed this bracket
			
		};
});

function getReportingUserList(val,selectedVal)
{
	var selVal= '';
	$.ajax({
	type: "POST",
	url: "../UsersController/getAssignUserInformation/"+val, 
	data: val,
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		//alert(data);
		var rPerson = "<option value='0'>select Reporting Person</option>";
		$.each(JSON.parse(data), function(idx, obj) {
		if(obj.id===selectedVal)
		{
			selVal= "selected=selected";
		}
		else
		{
			selVal= "";
		}
		//alert(selectedVal+'='+obj.id);
		rPerson += "<option value="+obj.id+" "+selVal+">"+obj.fname+" "+obj.lname+"</option>";
		});
		$('#reporting_person').html(rPerson);
	}
	});// you have missed this bracket
	
}
