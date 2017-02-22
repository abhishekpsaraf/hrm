
function manageLeaves()
{  
	//alert("HHHHHH");// return false;
	var leave_id = $('#leave_id').val();
	//alert('===>'+role_id);
	var txt_leave = $('#txt_leave').val();
	var txt_leave_type = $('#txt_leave_type').val();
	var txt_leave_count = $('#txt_leave_count').val();
	var leave_date = $('#leave_date').val();
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
	if(leave_id=='')
	{
		ajaxUrl = "/cidemo/index.php/leavesController/addLeave/";
	}
	else if(leave_id!='')
	{
		ajaxUrl = "/cidemo/index.php/leavesController/updateLeave/";
	}
//alert('menu_id='+menu_id+'&txt_menu='+txt_menu+'&txt_menu_title='+txt_menu_title+'&txt_menu_url='+txt_menu_url+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&btn_login='+btn_login);

	//alert('==>'+menu_id);
	
	$.ajax({
	type: "POST",
	url: ajaxUrl, 
	data: 'leave_id='+leave_id+'&txt_leave='+txt_leave+'&txt_leave_type='+txt_leave_type+'&txt_leave_count='+txt_leave_count+'&leave_date='+leave_date+'&chk_status='+chk_status+'&chk_delete='+chk_delete+'&btn_login='+btn_login,
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		$('#leavesModal').modal('hide');
		alert(data);
		//loadLeaveList();		
	}
	});
}
//loadLeaveList();

function loadLeaveList()
{
	//alert("List");
	
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/leavesController/getLeaveList", 
	data: '',
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		//alert(data);
		
		//return false;
		var html = 'Paid Leaves <table class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Leave Title </th><th>Leave Type</th><th>Leave Count (In Days)</th><th>Status</th><th>Action</th></tr></thead><tbody>';
		
		var html1 = 'Holiday List <table class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Leave Title </th><th>Leave Date</th><th>Leave Type</th><th>Leave Count (In Days)</th><th>Status</th><th>Action</th></tr></thead><tbody>';
		
		 var j=0;
		 var k=0; 
		 var status=''; 
		 
		$.each(JSON.parse(data), function(idx, obj) {
			
			if(obj.status == '1')
			{
				status = '&nbsp;&nbsp;Active&nbsp;';
			}
			else if(obj.status=='0')
			{
				status = 'Inactive';
			}
			if(obj.leave_type=='Holiday')
			{
				j++;
				html1+='<tr><td>'+j+'</td><td>'+obj.leave_title+'</td><td>'+obj.leave_date+'</td><td>'+obj.leave_type+'</td><td>'+obj.leave_count+'</td><td>'+status+'</td><td><a href="#" class="btn btn-danger square-btn-adjust" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+obj.leave_id+')">Edit</a></td></tr>';
				
			}
			else if(obj.leave_type!='Holiday')
			{
				k++;
				html+='<tr><td>'+k+'</td><td>'+obj.leave_title+'</td><td>'+obj.leave_type+'</td><td>'+obj.leave_count+'</td><td>'+status+'</td><td><a href="#" class="btn btn-danger square-btn-adjust" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+obj.leave_id+')">Edit</a></td></tr>';
			}
			
			//alert(obj.role_access_alias);
		

		});
		html +='</tbody></table>';
		html1 +='</tbody></table>';
		html += html1;
		//alert(html);
		$('#listLeaveList').html(html);
		//window.location.href = "/cidemo/index.php/roleController/";

	}
	});// you have missed this bracket
}
function setLeavePopValues(val)
{
	//alert(val);
	$('#leave_id').val('');
	$('#txt_leave').val('');
	$('#txt_leave_type').val('');
	$('#txt_leave_count').val('');
	$('#leave_date').val('');
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/leavesController/getLeavePopUpValues/"+val, 
	data: val,
	dataType: "json",  
	cache:false,
	success: 
	function(data){ //alert(data);return false;

		$('#leave_id').val(data.leave_id);
		$('#txt_leave').val(data.leave_title);
		//$('#txt_leave_type').val(data.leave_type);
		$('#txt_leave_count').val(data.leave_count);
		$('#leave_date').val(data.leave_date);

		$('select[name="txt_leave_type"]').val(data.leave_type);
		if(data.status==1)
		{
			$('#chk_status').prop('checked','checked');
		}

	}
	});// you have missed this bracket
		
}

function applyLeaves()
{
	var user_id = $('#user_id').val();
	var txt_leave_type = $('#txt_leave_type').val();
	var leave_from = $('#leave_from').val();
	var leave_to = $('#leave_to').val();
	var txt_leave_count = $('#txt_leave_count').val();
	var txt_leave_reason = $('#txt_leave_reason').val();
	//alert(txt_leave_reason);
	var btn_login = $('#btn_login').val();
	var status = '0';
	var diffDays = dateDifferance(leave_from,leave_to);
	//var weekEnd= countWeekendDays(leave_from,leave_to);
	//alert(weekEnd);
	var msg = '';
	if(txt_leave_type=='')
	{
		msg += 'Please select Type \n';
	}
	if(leave_from=='')
	{
		msg += 'Please select Leave From Date \n';
	}
	if(leave_to=='')
	{
		msg += 'Please select Leave To Date \n';
	}
	if(txt_leave_count=='')
	{
		msg += 'Please fill Leave Days \n';
	}
	if(txt_leave_reason=='')
	{
		msg += 'Please fill Reason';
	}
	if(leave_from!='' && leave_to!='')
	{
		if(diffDays < 0)
		{
			msg += 'Leave From Date can not be greater than Leave To Date \n';
		}
	}
	alert(msg);
	$('#txt_leave_count').val(diffDays);
	//return false;
	if(msg=='')
	{
		$.ajax({
		type: "POST",
		url:"/cidemo/index.php/leavesController/submit_leave", 
		data: 'user_id='+user_id+'&leave_id='+txt_leave_type+'&leave_from='+leave_from+'&leave_to='+leave_to+'&leave_days='+txt_leave_count+'&leave_reason='+txt_leave_reason+'&status='+status+'&btn_login='+btn_login,
		dataType: "text",  
		cache:false,
		success: 
		function(data){ 
			//alert(data);
			loadAppliedLeaveList();	
		}
		});
	}
	//return false;
	
}

function dateDifferance(leave_from,leave_to)
{
	var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
	var firstDate = new Date(parseDate(leave_from));
	var secondDate = new Date(parseDate(leave_to));

	var diffDays = Math.round(((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
	return diffDays;
}

function countWeekendDays(fromDate,toDate)
{
	var weekendDayCount = 0;
	var firstDate = new Date(parseDate(fromDate));
	var toDate = new Date(parseDate(toDate));

    //while(fromDate < toDate){
        fromDate.setDate(fromDate.getDate() + 1);
        if(fromDate.getDay() === 0 || fromDate.getDay() == 6){
            ++weekendDayCount ;
        }
   // }

    return weekendDayCount ;
}

function parseDate(str) 
{
    var mdy = str.split('-');
    return (mdy[2]+"/"+mdy[1]+"/"+mdy[0]);
   // return (mdy[2]+'/'+mdy[0]-1+'/'+mdy[1]);
}


//loadAppliedLeaveList();
function loadAppliedLeaveList()
{
	var login_user_id = $('#login_user_id').val();
	//alert("==>"+login_user_id);
	//return false;
	$.ajax({
	type: "POST",
	url: "/cidemo/index.php/leavesController/getAppliedLeaveList/"+login_user_id, 
	data: '',
	dataType: "text",  
	cache:false,
	success: 
	function(data){ 
		//alert(data);
		
		//return false;
		var html = '<table class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Leave Type </th><th>Leave From</th><th>Leave To</th><th>Leave Days</th><th>Status</th></tr></thead><tbody>';

		 var j=0;
		 var k=0; 
		 var status=''; 
		if(data!=0)
		{ 
			$.each(JSON.parse(data), function(idx, obj) {
				
				if(obj.status == '1')
				{
					status = '&nbsp;&nbsp;Pending&nbsp;';
				}
				else if(obj.status=='2')
				{
					status = 'Send For Approval';
				}
				else if(obj.status=='0')
				{
					status = 'Cancle';
				}
				
				j++;
				html+='<tr><td>'+j+'</td><td>'+obj.leave_title+'</td><td>'+obj.leave_from+'</td><td>'+obj.leave_to+'</td><td>'+obj.leave_days+'</td><td><a href="#" class="btn btn-danger square-btn-adjust" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+obj.user_id+')">'+status+'</a></td></tr>';
		
			});
		}
		else
		{
			html+='<tr><td></td><td align="center" colspan="4">No Applied Leaves</td><td></td></tr>';
		}
		html +='</tbody></table>';
		//alert(html);
		//$('#listAppliedLeaveList').html(html);
	}
	});// you have missed this bracket
}

