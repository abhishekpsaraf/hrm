<?php
if(isset($message))
{
echo $message;
}
//echo '<pre>===';print_r(getMenus());
?>
	<div ng-app="myLeaves"> 
	<div ng-controller="listView">
	<div class="row"> 
		<div class="col-md-12 col-sm-15 col-xs-12">

			<div class="panel panel-default">
				<div class="panel-heading" style="padding-top: 10px; padding-bottom: 0px; border-bottom-width: 1px; margin-bottom: 10px;">
					All Applied Leaves
				</div>
	<!--Table--->
		<div></div>
		
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
    
    <br/>
        <div></div>
	<div class="panel-body">
	<div class="col-md-12" ng-show="filteredItems > 0" class="table-responsive" id="listAppliedLeaveList" name="listAppliedLeaveList">
	<table class="table table-striped table-bordered table-hover">
	<thead>
	<tr>
	<!--<th>#</th>-->
	<th>Leave Type&nbsp;<a ng-click="sort_by('leave_title');"><i class="glyphicon glyphicon-sort"></i></a></th>
	<th>Leave From</th>
	<th>Leave To</th>
	<th>Leave Days</th>
	<th>Status</th>
	</tr></thead>
	<tbody>
	<tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
		
		<td>{{data.leave_title}}</td>
		<td>{{data.leave_from}}</td>
		<td>{{data.leave_to}}</td>
		<td>{{data.leave_days}}</td>
		<td ng-if="data.status=='1'"><a href="#" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+{{data.user_id}}+')"><i class="fa fa-edit"></i>&nbsp;&nbsp;Pending&nbsp;</a></td>
		<td ng-if="data.status=='2'"><a href="#" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+{{data.user_id}}+')"><i class="fa fa-edit"></i>Send For Approval</a></td>
		<td ng-if="data.status=='0'"><a href="#" data-toggle="modal" data-target="#leavesModal" onClick="setLeavePopValues('+{{data.user_id}}+')"><i class="fa fa-edit"></i>Cancle</a></td>
	</tr>
	 </tbody>
     </table>
	</div>
	<div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No Leaves found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            
            
        </div>
	</div>
	
	
	<!--Table Ends------>
				</div>                    
			</div>
			</div>                
		</div>          
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
 <!---Form-->
	<div id="leavesModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "leave_form", "id" => "leave_form","method"=>"post");
            echo form_open("LeavesController/", $attributes);?>

            <div class="modal-header">
               
                <h4 class="modal-title"><span id="rolePopupTitle" name="rolePopupTitle">Update Leave</span></h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <fieldset>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Leave Title</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_leave" name="txt_leave" placeholder="Leave Title" type="text" value="<?php echo set_value('txt_leave'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_leave'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Type</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <select class="form-control" id="txt_leave_type" name="txt_leave_type">
					<option selected="selected" value="">Select Type</option>
					<option value="Holiday">Holiday</option>
					<option value="Other">Other</option>				
					</select>
                    <span class="text-danger"><?php echo form_error('txt_leave_type'); ?></span>
               </div>
               </div>
               </div>
               
                <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Leave Count(In Days)</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_leave_count" name="txt_leave_count" placeholder="Leave Count" type="text" value="<?php echo set_value('txt_leave_count'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_leave_count'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
              
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Leave Date</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                  <div class="input-group date" id="leavedate" data-provide="datepicker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control" id="leave_date" name="leave_date">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
			   </div>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
               <label for="txt_status" class="control-label">Status</label>
               </div>
               <div class="col-lg-1 col-sm-1">
                    <input class="form-control" type="checkbox" id="chk_status" name="chk_status" value="" onclick="setCheckBoxValues()"/>
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
                    <input class="form-control" type="checkbox" id="chk_delete" name="chk_delete" value="" onclick="setCheckBoxValues()"/>
                    <span class="text-danger"><?php echo form_error('chk_delete'); ?></span>
               </div>
               </div>
               </div>
          </fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="leave_id" name="leave_id" type="hidden" value="" />
                 <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Submit" onclick="manageLeaves()"/>
                <!--<input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />-->
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
<script type="text/javascript">
// When the document is ready
//$('.leavedate').datepicker(function(){
//});
</script>
