<?php
if(isset($message))
{
echo $message;
}
//echo '<pre>===';print_r(getMenus());
?>

<div class="row"> 
                    <div class="col-md-12 col-sm-15 col-xs-12">
               
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           All Leaves
                        </div>
                        <!--Table--->
                        <div class="panel-body">
                            <div class="table-responsive" id="listLeaveList" name="listLeaveList">
                              
                            </div>
                        </div>
                        <!--Table Ends------>
                    </div>                    
                    </div>
                </div>                
           </div>          
        </div>
                 <!-- /. ROW  -->
               
                 <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->



 <!---Form-->
<div id="roleModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "role_form", "id" => "role_form","method"=>"post");
            echo form_open("roleController/", $attributes);?>

            <div class="modal-header">
               
                <h4 class="modal-title"><span id="rolePopupTitle" name="rolePopupTitle">Update Leave</span></h4>
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

