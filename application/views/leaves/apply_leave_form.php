<?php
if(isset($message))
{
echo $message;
}
//echo '<pre>===';print_r(getMenus());
//echo $user_leaves_access;
?>

<div class="row"> 
                    <div class="col-md-12 col-sm-15 col-xs-12">
               
                    <div class="">
                       <!---Form-->
                       <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "add_leave_form", "id" => "add_leave_form","method"=>"post");
            echo form_open("LeavesController/list_applied_leaves", $attributes);?>

            <div class="modal-header">
               
                <h4 class="modal-title"><span id="rolePopupTitle" name="rolePopupTitle">Leave Application</span></h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <fieldset>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Name</label>
               </div>
               <div class="col-lg-8 col-sm-8">
					 <label for="txt_username"><?php echo $fname.' '.$lname; ?></label>
                    <input class="form-control" id="user_id" name="user_id" type="hidden" value="<?php echo $id; ?>" />
                    <span class="text-danger"><?php echo form_error('user_id'); ?></span>
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
					<?php 
					if($user_leaves_access!='')
					{
						$leaveType = getLeaveType($user_leaves_access);
						//echo '<pre>';print_r($leaveType);
						for($i=0;$i<count($leaveType);$i++)
						{
							
							echo '<option value="'.$leaveType[$i]['leave_id'].'">'.$leaveType[$i]['leave_title'].'</option>';
						}
					}
					?>				
					</select>
                    <span class="text-danger"><?php echo form_error('txt_leave_type'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
              
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Leave From</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                  <!-- <input class="form-control" type="text" id="leave_date" name="leave_date" placeholder="DD-MM-YYYY">
                    <span class="text-danger"><?php //echo form_error('leave_date'); ?></span>-->
                    
               <div class="input-group date" id="leaveFromDate" data-provide="datepicker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control" id="leave_from" name="leave_from">
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
                    <label for="txt_username" class="control-label">Leave To</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                  <!-- <input class="form-control" type="text" id="leave_date" name="leave_date" placeholder="DD-MM-YYYY">
                    <span class="text-danger"><?php //echo form_error('leave_date'); ?></span>-->
                    
               <div class="input-group date" id="leaveToDate" data-provide="datepicker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control" id="leave_to" name="leave_to">
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
                    <label for="txt_username" class="control-label">Leave Days</label>
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
                    <label for="txt_username" class="control-label">Reason</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <textarea class="form-control" id="txt_leave_reason" name="txt_leave_reason" placeholder="Leave Reason"><?php echo set_value('txt_leave_reason'); ?></textarea>
                    <span class="text-danger"><?php echo form_error('txt_leave_reason'); ?></span>
               </div>
               </div>
               </div>
               
                <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-3 col-sm-3">
                    <label for="txt_username" class="control-label">Available Leave</label>
               </div>
               <div class="col-lg-8 col-sm-8">
					 <label for="txt_username"></label>
                    <input class="form-control" id="avl_leave" name="avl_leave" type="hidden" value="<?php echo $id; ?>" />
                    <span class="text-danger"><?php //echo form_error('txt_leave'); ?></span>
               </div>
               </div>
               </div>
            
          </fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
            <input class="form-control" id="leave_id" name="leave_id" type="hidden" value="" />
                 <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Submit" onclick="applyLeaves()"/>
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
            </div>
        </div>
 <script type="text/javascript">
// When the document is ready
/*$('.leaveFromDate').datepicker(function(){
});

$('.leaveToDate').datepicker(function(){
});*/
</script>
