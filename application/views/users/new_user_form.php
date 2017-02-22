<?php //echo "----------->".$id; ?>
    
      
     <div class="row">
          <div class="col-md-12 col-sm-15 col-xs-12" style="">
           <div class="modal-dialog">
        <div class="modal-content">
        <div style="position: relative;padding: 60px;">
          <?php 
          $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform" ,"enctype"=>"multipart/form-data");
          echo form_open("UsersController/addUser", $attributes);?>
          <fieldset>
               <legend>Add User</legend>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
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
               <div class="col-lg-4 col-sm-4">
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
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Email</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_lname" name="txt_email" placeholder="Email" type="text" value="<?php echo set_value('txt_email'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_email'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
              
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Date of Birth</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <!--<div class='input-group date' id='datetimepicker1'>
                   <input class="form-control" type="text" id="	" name="dob" placeholder="Date of Birth">
                   <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="text-danger"><?php echo form_error('dob'); ?></span>
               </div>-->
					<div class="input-group date" id="dob" data-provide="datepicker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
               </div>
               </div>
               </div>
    
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
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
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Picture</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" type="file" name="picture" id="picture"/>
                    
                    <span class="text-danger"><?php echo form_error('picture'); ?></span>
               </div>
               </div>
               </div>
              
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Username</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
               <label for="txt_password" class="control-label">Password</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
               </div>
               </div>
               </div>
                              
               <div class="form-group">
               <div class="col-lg-12 col-sm-12 text-center">
					<input id="company_id" name="company_id" type="hidden" value="<?php echo $company_id; ?>" />
					<input id="company_branch_id" name="company_branch_id" type="hidden" value="<?php echo $company_branch_id; ?>" />
                    <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Submit" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-default" value="Cancel" />
               </div>
               </div>
          </fieldset>
          <?php echo form_close(); ?>
          <?php echo $this->session->flashdata('msg'); ?>
          </div>
          </div>
          </div>
          </div>
     </div>

<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                /* $(function () {
                $('#dob').datetimepicker();*/
            //});  
				
            });
            $('.datepicker').datepicker(function(){
				
				});
</script>

