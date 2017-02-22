<?php
if(isset($message))
{
echo $message;
}
//echo '<pre>===';print_r(getMenus());
?>

<div class="row"> 
                    <div class="col-md-12 col-sm-15 col-xs-12">
               
                    <div class="">
                       <!---Form-->
                       <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "leave_form", "id" => "leave_form","method"=>"post");
            echo form_open("LeavesController/", $attributes);?>

            <div class="modal-header">
               
                <h4 class="modal-title"><span id="rolePopupTitle" name="rolePopupTitle">Add Leave</span></h4>
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
					<option selected="selected" value="Other">Select Type</option>
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
                    <label for="txt_username" class="control-label">Leave Count (In Days)</label>
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
                  <!-- <input class="form-control" type="text" id="leave_date" name="leave_date" placeholder="DD-MM-YYYY">
                    <span class="text-danger"><?php //echo form_error('leave_date'); ?></span>-->
                    
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
            </div>
        </div>
 <script type="text/javascript">
// When the document is ready
/*$('.leavedate').datepicker(function(){
});*/
</script>
