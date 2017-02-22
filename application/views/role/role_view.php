<?php
if(isset($message))
{
echo $message;
}
//echo '<pre>===';print_r(getMenus());
?>
<div ng-app="myRoles"> 
<div ng-controller="roleListView">
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Roles</h3>
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
            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total Roles</h5>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
				<!--<th>#</th>-->
				<th>Role&nbsp;<a ng-click="sort_by('role');"><i class="glyphicon glyphicon-sort"></i></a></th>
				<th>Access Type</th>
				<th>Status</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
				<td>{{data.role}}</td>
				<td>{{data.role_access_alias}}</td>
				<td ng-if="data.status=='0'">Inactive</td>
				<td ng-if="data.status=='1'">Active&nbsp;&nbsp;</td>
				<td><a href="#" data-toggle="modal" data-target="#roleModal" ng-click="setRolePopValues(data.role_id)"><i class="fa fa-edit"></i>Edit</a></td>
				</tr>
			</tbody>
		 </table>
		 <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No Menus found</h4>
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
 
 <!---Form-->
<div id="roleModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "role_form", "id" => "role_form","method"=>"post");
            echo form_open("roleController/", $attributes);?>

            <div class="modal-header">
               
                <h4 class="modal-title"><span id="rolePopupTitle" name="rolePopupTitle">Update Role</span></h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <fieldset>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Role</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_role" name="txt_role" placeholder="Role" type="text" value="<?php echo set_value('txt_role'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_role'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Role Access</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <select class="form-control" id="role_access_type" name="role_access_type">
					<option selected="selected" value="0">select Role Acess</option>
					<?php $roleAccess = getRoleAccess();
						//\\echo '<pre>';print_r($menus);
						for($i=0;$i<count($roleAccess);$i++)
						{
							echo "<option value=".$roleAccess[$i]['role_access_id'].">".$roleAccess[$i]['role_access']."</option>";
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
               <label for="txt_status" class="control-label">Status</label>
               </div>
               <div class="col-lg-1 col-sm-1">
                    <input class="checkbox" type="checkbox" id="chk_status" name="chk_status" value="" onclick="setCheckBoxValues()"/>
                    <span class="text-danger"><?php echo form_error('chk_status'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
               <label for="txt_status" class="control-label">Delete</label>
               </div>
               <div class="col-lg-1 col-sm-1">
                    <input class="checkbox" type="checkbox" id="chk_delete" name="chk_delete" value="" onclick="setCheckBoxValues()"/>
                    <span class="text-danger"><?php echo form_error('chk_delete'); ?></span>
               </div>
               </div>
               </div>
          </fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="role_id" name="role_id" type="hidden" value="" />
                 <input id="btn_login" name="btn_login" type="button" class="btn btn-default" value="Submit" onclick="manageRole()"/>
                <input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
                       <!---Ends--->
                    </div>                    
                    </div>
                </div>                
           </div>          
        </div>
    </div>
            </div>
        </div>
</div>

