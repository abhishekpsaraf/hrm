<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter Modal Contact Form Example</title>
    <!--load bootstrap css-->
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- modal form -->
<div id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $attributes = array("name" => "contact_form", "id" => "contact_form");
            echo form_open("modal_contact/submit", $attributes);?>

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
                    <input class="form-control" id="txt_lname" name="txt_email" placeholder="Email" type="text" value="<?php echo set_value('txt_email'); ?>" />
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
          </fieldset>

                <div id="alert-msg"></div>
            </div>
            <div class="modal-footer">
                 <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Submit" />
                <input class="btn btn-default" type="button" data-dismiss="modal" value="Close" />
            </div>
            <?php echo form_close(); ?>            
        </div>
    </div>
</div>
<!--Model form Ends--->     
<!--load jquery & bootstrap js files-->
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript">
$('#submit').click(function() {
    var form_data = {
        name: $('#name').val(),
        email: $('#email').val(),
        subject: $('#subject').val(),
        message: $('#message').val()
    };
    $.ajax({
        url: "<?php echo site_url('modal_contact/submit'); ?>",
        type: 'POST',
        data: form_data,
        success: function(msg) {
            if (msg == 'YES')
                $('#alert-msg').html('<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
            else if (msg == 'NO')
                $('#alert-msg').html('<div class="alert alert-danger text-center">Error in sending your message! Please try again later.</div>');
            else
                $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
        }
    });
    return false;
});
</script>
</body>
</html>
