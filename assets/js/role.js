//Angular JS code
var app = angular.module('myRoles', ['ui.bootstrap']);

app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.controller('roleListView', function ($scope, $http, $timeout) {
	var login_user_id = $('#login_user_id').val();
    $http.get('/cidemo/index.php/roleController/getRoleList').success(function(data){ 
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
     $scope.open = function () {
            $scope.showModal = true;
    };
    $scope.setRolePopValues = function (val) {
         
    $('#role_id').val('');
	$('#txt_role').val('');
	$('#chk_status').prop('checked','');
	$('select[name="role_access_type"]').val('');
	
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/roleController/getRolePopUpValues/"+val, 
	data: val,
	dataType: "json",  
	cache:false,
	success: 
	function(data){ 
		$('#role_id').val(data.role_id);
		$('#txt_role').val(data.role);
		$('select[name="role_access_type"]').val(data.role_access_id);
		if(data.status==1)
		{
			$('#chk_status').prop('checked','checked');
		}
		
	}
	});// you have missed this bracket
		
    };
});

//Ends

function setRolePopValues(val)
{
	$('#role_id').val('');
	$('#txt_role').val('');
	$('#chk_status').prop('checked','');
	$('select[name="role_access_type"]').val('');
	
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/roleController/getRolePopUpValues/"+val, 
	data: val,
	dataType: "json",  
	cache:false,
	success: 
	function(data){ 
		$('#role_id').val(data.role_id);
		$('#txt_role').val(data.role);
		$('select[name="role_access_type"]').val(data.role_access_id);
		if(data.status==1)
		{
			$('#chk_status').prop('checked','checked');
		}
		
	}
	});// you have missed this bracket
		
}
//loadRoleList();
function loadRoleList()
{
	//alert("List");
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/roleController/getRoleList", 
	data: '',
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		//alert(data);
		
		//return false;
		var html = '<table class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Role </th><th>Access Type</th><th>Status</th><th>Action</th></tr></thead><tbody>';
		 var j=0; 
		 var status=''; 
		 
		$.each(JSON.parse(data), function(idx, obj) {
			j++;
			if(obj.role_status == '1')
			{
				status = '&nbsp;&nbsp;Active&nbsp;';
			}
			else if(obj.role_status=='0')
			{
				status = 'Inactive';
			}
			/*if(obj.role_id!='')
			{
				$('#menuPopupTitle').html('Update Menu');
			}
			else if(obj.role_id=='')
			{
				$('#menuPopupTitle').html('Add Menu');
			}*/
			
			//alert(obj.role_access_alias);
			html+='<tr><td>'+j+'</td><td>'+obj.role+'</td><td>'+obj.role_access_alias+'</td><td>'+status+'</td><td><a href="#" class="btn btn-danger square-btn-adjust" data-toggle="modal" data-target="#roleModal" onClick="setRolePopValues('+obj.role_id+')">Edit</a></td></tr>';

		});
		html +='</tbody></table>';
		//alert(html);
		$('#listRoleList').html(html);
		//window.location.href = "/cidemo/index.php/roleController/";

	}
	});// you have missed this bracket
}

function setCheckBoxValues()
{
	if($('#chk_status'). prop("checked") == true)
	{
		$('#chk_status'). val('1');
	}
	else if($('#chk_status'). prop("checked") == false)
	{
		$('#chk_status'). val('0');
	}
	
	if($('#chk_delete'). prop("checked") == true)
	{
		$('#chk_delete'). val('1');
	}
	else if($('#chk_delete'). prop("checked") == false)
	{
		$('#chk_delete'). val('0');
	}
}

function manageRole()
{
	var role_id = $('#role_id').val();
	//alert('===>'+role_id);
	var txt_role = $('#txt_role').val();
	var role_access_type = $('#role_access_type').val();
	var chk_status = 0;
	var chk_delete = 0;
	var btn_login = $('#btn_login').val();
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
	if(role_id=='')
	{
		ajaxUrl = "/cidemo/index.php/roleController/addRole/";
	}
	else if(role_id!='')
	{
		ajaxUrl = "/cidemo/index.php/roleController/updateRole/";
	}
//alert('menu_id='+menu_id+'&txt_menu='+txt_menu+'&txt_menu_title='+txt_menu_title+'&txt_menu_url='+txt_menu_url+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&btn_login='+btn_login);

	//alert('==>'+menu_id);
	
	$.ajax({
	type: "POST",
	url: ajaxUrl, 
	data: 'role_id='+role_id+'&txt_role='+txt_role+'&role_access_type='+role_access_type+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&btn_login='+btn_login,
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		$('#roleModal').modal('hide');
		alert(data);
		loadRoleList();		
	}
	});
}
