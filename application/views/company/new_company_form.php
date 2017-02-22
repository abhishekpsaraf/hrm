<?php if(isset($message))
{
	echo $message;
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HR Management</title>
	<!-- BOOTSTRAP STYLES-->
	<!-- <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet" /> -->
     <!--<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
      <!--<link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet" />-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    
    <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/company.js"></script>
    
</head>
<body>
<div ng-app="myCompany">
<div ng-controller="companySignUp">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <!--  <a class="navbar-brand" href="index.html">Binary admin</a> -->
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <a href="<?php echo base_url(); ?>" class="btn btn-danger square-btn-adjust">Login</a> </div>
        </div>
        <div class="container">
     <div class="row">
          <div class="col-lg-6 col-sm-6 well" style="margin-left: 330px; padding-top: 19px; margin-top: 50px;">
          <?php  
          $attributes = array("class" => "form-horizontal", "id" => "companyform", "name" => "companyform" ,"enctype"=>"multipart/form-data");
          echo form_open("CompanyController/addCompany", $attributes);?>
          <fieldset>
               <legend>Company Registration</legend>
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Name</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_cname" name="txt_cname" placeholder="Company Name" type="text" value="<?php echo set_value('txt_cname'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_cname'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Registration No.</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_creg" name="txt_creg" placeholder="Company Registration No." type="text" value="<?php echo set_value('txt_creg'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_creg'); ?></span>
               </div>
               </div>
               </div>
               
			  <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                     <label for="txt_username" class="control-label">Type</label>
               </div>
               <div class="col-lg-8 col-sm-8">
              <select class="form-control" id="txt_ctype" name="txt_ctype">
               <option selected="selected" value="">Select Company Type</option>
				<?php 
					$companyType = getCompanyType();
					if($companyType!='')
					{
						for($i=0;$i<count($companyType);$i++)
						{
							
							echo '<option value="'.$companyType[$i]['type_id'].'">'.$companyType[$i]['type_name'].'</option>';
						}
					}
				?>	
				</select>
				  <span class="text-danger"><?php echo form_error('txt_ctype'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group" ng-init="loadCountry()">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                     <label for="txt_coutry_id" class="control-label">Location</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <select class="form-control" id="txt_coutry_id" name="txt_coutry_id"  ng-model="tbl_country" class="form-control" ng-change="loadState()">
                <option value="">Select Country</option>  
                <option ng-repeat="country in countries" value="{{country.country_id}}">{{country.country_name}}</option>
				</select>
				  <span class="text-danger"><?php echo form_error('txt_coutry_id'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                     <label for="txt_coutry_id" class="control-label">State</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <select class="form-control" id="txt_state_id" name="txt_state_id"  ng-model="tbl_state" class="form-control" ng-change="loadCity()">
                <option value="">Select State</option>  
                <option ng-repeat="state in states" value="{{state.state_id}}">{{state.state_name}}</option>
				</select>
				  <span class="text-danger"><?php echo form_error('txt_state_id'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                     <label for="txt_city_id" class="control-label">City</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <select class="form-control" id="txt_city_id" name="txt_city_id"  ng-model="tbl_city" class="form-control">
                <option value="">Select City</option>  
                <option ng-repeat="city in cities" value="{{city.city_id}}">{{city.city_name}}</option>
				</select>
				  <span class="text-danger"><?php echo form_error('txt_city_id'); ?></span>
               </div>
               </div>
               </div>
               
               
               <div class="form-group">
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_company_email" class="control-label">Email</label>
               </div>
               <div class="col-lg-8 col-sm-8">
                    <input class="form-control" id="txt_company_email" name="txt_company_email" placeholder="Email" type="text" value="<?php echo set_value('txt_company_email'); ?>" />
                    <span class="text-danger"><?php echo form_error('txt_company_email'); ?></span>
               </div>
               </div>
               </div>
               
               <div class="form-group">
              
               <div class="row colbox">
               <div class="col-lg-4 col-sm-4">
                    <label for="txt_username" class="control-label">Date of Start</label>
               </div>
               <div class="col-lg-8 col-sm-8">
               <!--<div class='input-group date' id='datetimepicker1'>
                   <input class="form-control" type="text" id="	" name="dob" placeholder="Date of Birth">
                   <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="text-danger"><?php //echo form_error('dos'); ?></span>
               </div>-->
					<div class="input-group date" id="dos" name="dos" data-provide="datepicker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control" id="txt_dos" name="txt_dos">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
                    <span class="text-danger"><?php echo form_error('txt_dos'); ?></span>
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
                    <label for="txt_username" class="control-label">Company Logo</label>
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
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
    
     <!--<script src="<?php //echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>-->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
  
<script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>

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
   
</body>
</html>
