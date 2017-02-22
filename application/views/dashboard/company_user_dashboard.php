<?php
if(isset($message))
{
echo $message;
}
//-echo '<pre>===';print_r(getMenus());
//echo "----AAAAAA-----";
?>
<div ng-app="myUsers"> 
<div ng-controller="listView">
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Users</h3>
            </div>
            <div class="col-md-2" style="border-bottom-width: 10px; padding-bottom: 10px; border-left-width: 5px; margin-left: 15px;">PageSize:
            <select ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total Leaves</h5>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			<!--<th>#</th>-->
			<th>Full Name&nbsp;<a ng-click="sort_by('fname');"><i class="glyphicon glyphicon-sort"></i></a></th>
			<th>Username</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Designation</th>
			<th>Reporting Person</th>
			<th>Status</th>
			<th>Menus</th>
			<th>Leaves</th>
			</tr>
			</thead>
			<tbody>
			<tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
			<td>{{data.fname}} {{data.lname}}</td>
			<td>{{data.username}}</td>
			<td>{{data.email}}</td>
			<td>{{data.mobile}}</td>
			<td>{{data.user_role}}</td>
			<td >{{data.assigned_username}}</td>
			<td ng-if="data.user_status=='Inactive'"><a href="#" data-toggle="modal" data-target="#myModal" ng-click="setPopValues(data.id)"><i class="fa fa-edit"></i>{{data.user_status}}</a></td>
			<td ng-if="data.user_status=='Active'"><a href="#" data-toggle="modal" data-target="#myModal" ng-click="setPopValues(data.id)"><i class="fa fa-edit"></i>{{data.user_status}}&nbsp;&nbsp;</a></td>
			<td><a href="#"  data-toggle="modal" data-target="#myMenu" ng-click="setPopValues(data.id)"><i class="fa fa-edit"></i> Access</a></td>
			<td><a href="#"  data-toggle="modal" data-target="#myLeaves" ng-click="setPopValues(data.id)"><i class="fa fa-edit"></i>Access</a></td>
			</tr>
		 </tbody>
		 </table>
		 <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No User found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            
            
        </div>
            </div>
            
            <!-- /.box-body -->
          </div>
 </div>
 </div>
<!-- modal form -->
<div id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "contact_form", "id" => "contact_form","method"=>"post");
            echo form_open("UsersController/updateUser", $attributes);?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <fieldset>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">First Name</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_fname" name="txt_fname" placeholder="Firstname" type="text" value="<?php echo set_value('txt_fname'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_fname'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Last Name</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_lname" name="txt_lname" placeholder="Lastname" type="text" value="<?php echo set_value('txt_lname'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_lname'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Email</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_email" name="txt_email" placeholder="Email" type="text" value="<?php echo set_value('txt_email'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_email'); ?></span>
               </div>
               </div>
               </div>
               
                <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Mobile</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_mobile" name="txt_mobile" placeholder="Mobile" type="text" value="<?php echo set_value('txt_mobile'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_mobile'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Designation</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <select class="form-control" id="user_designation" name="user_designation">
					<option selected="selected" value="0">select Designation</option>
					<?php $userDesignation = getUserDesignation();
						//echo '<pre>';print_r($userDesignation);exit;
						for($i=0;$i<count($userDesignation);$i++)
						{
							echo "<option value=".$userDesignation[$i]['role_id'].">".$userDesignation[$i]['role']."</option>";
							
							//echo "<option value='test'>'ttttt'</option>";
						}			
					?>					
					</select>
                    <span class="text-danger"><?php //echo form_error('txt_menu_title'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Reporting Person</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <select class="form-control" id="reporting_person" name="reporting_person">
					
					<?php //$roleAccess = getRoleAccess();
						//\\echo '<pre>';print_r($menus);
						/*for($i=0;$i<count($roleAccess);$i++)
						{
							echo "<option value=".$roleAccess[$i]['role_access_id'].">".$roleAccess[$i]['role_access']."</option>";
						}*/						
					?>					
					</select>
                    <span class="text-danger"><?php //echo form_error('txt_menu_title'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Username</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php //echo set_value('txt_username'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
               <label for="txt_password" class="control-label">Password</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php //echo set_value('txt_password'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
               </div>
               </div>
               </div>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
               <label for="txt_status" class="control-label">Status</label>
               </div>
               <div class="col-lg-1 col-sm-1">
                    <input class="checkbox" type="checkbox" id="chk_status" name="chk_status" value="" />
                    <span class="text-danger"><?php echo form_error('chk_status'); ?></span>
               </div>
               </div>
               </div>
          </fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="txt_id" name="txt_id" type="hidden" value="" />
            <input id="company_id" name="company_id" type="hidden" value="<?php echo $company_id; ?>" />
			<input id="company_branch_id" name="company_branch_id" type="hidden" value="<?php echo $company_branch_id; ?>" />
                 <input id="btn_login" name="btn_login" type="button" class="btn btn-default" value="Submit" ng-click="updateUser();"/>
                <input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
</div>
<!--Model form Ends--->

<div id="myMenu" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "contact_form", "id" => "contact_form","method"=>"post");
            echo form_open("UsersController/assignMenu", $attributes);?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Assign Menu</h4>
            </div>
             <div class="modal-body" id="myModalBody">
               <fieldset>
             <?php //Get Menus from Helper 
						
				$menus = getMenus();
				$menuLi = '';
				for($i=0;$i<count($menus);$i++)
				{
					$menuLi = '<li>'.$menus[$i]['menu'].'<ul>';
					$parentMenu = getParentMenus($menus[$i]['menu_id']);
					for($j=0;$j<count($parentMenu);$j++)
					{
$menuLi .='<li><input class="" type="checkbox" id="chk_menu'.$parentMenu[$j]['menu_id'].'" name="chk_menu[]" value="'.$parentMenu[$j]['menu_id'].'" />&nbsp;&nbsp;'.$parentMenu[$j]['menu'].'</li>';
					}
					$menuLi .= '</ul></li>';
					echo $menuLi;
				} ?>
             
				</fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="txt_id" name="txt_id" type="hidden" value="" />
            <input class="form-control" id="assignMenusId" name="assignMenusId" type="hidden" value="" />
                 <input id="btn_login" name="btn_login" type="button" class="btn btn-default" value="Submit" ng-click="assignMenu();"/>
                <input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
</div>     
   
   
<div id="myLeaves" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "contact_form", "id" => "contact_form","method"=>"post");
            echo form_open("UsersController/assignLeaves", $attributes);?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Assign Leaves</h4>
            </div>
             <div class="modal-body" id="myModalBody">
               <fieldset>
             <?php //Get Menus from Helper 
				
				
				$leaveType = getLeaveType('');
				
				echo '<table class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Leave Type</th><th>Days</th></tr></thead><tbody>';
				//echo count($leaveType);
				if(count($leaveType)==0)
				{
					//echo 'No Leaves are assigned';
					echo '<tr><td></td><td>No Leaves are assigned</td><td></td></tr>';	
				}
				for($i=0;$i<count($leaveType);$i++)
				{
					
					echo '<tr><td>'.'<input class="" type="checkbox" id="chk_leaves'.$leaveType[$i]['leave_id'].'" name="chk_leaves[]" value="'.$leaveType[$i]['leave_id'].'" />'.'</td><td>'.$leaveType[$i]['leave_title'].'</td><td>'.$leaveType[$i]['leave_count'].'</td></tr>';					
					
				}
				echo '</tbody></table>';
				
				?>
             
				</fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="txt_id" name="txt_id" type="hidden" value="" />
            <input class="form-control" id="assignLeavesId" name="assignLeavesId" type="hidden" value="" />
                 <input id="btn_login" name="btn_login" type="button" class="btn btn-default" value="Submit" ng-click="assignLeaves();"/>
                <input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
</div>    

