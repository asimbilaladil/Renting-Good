 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Add Customer</h1>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="border-bottom:1px solid #f4f4f4;" class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="cs-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Add Customer</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
                              <?php
            if ( $data['result'] == 1) {

                echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Customer add successfully!
                                                        </div>";
            } 
                  else if ( $data['result'] == 2) {

                echo "<div style='text-align: center;' class='alert alert-danger alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Invalid!
                                                        </div>";
            } 
        ?>
            <div class="row">
                 <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        
                    </div>
                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>Add Customer</h6>
                        <form action="<?php echo site_url('Welcome/addCustomer') ?>" method="post">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-user"></i>
                                    <input name="fname" type="text" placeholder="First Names *" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-user"></i>
                                    <input name="lname" type="text" placeholder="Last Name *" required>
                                </div>
                            </div>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-user"></i>
                                    <input name="pname" type="text" placeholder="Preferred Name *" required>
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-calendar"></i>
                                    <input name="dob" type="text" placeholder="Date of Birth *" required>
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="address1" type="text" placeholder="Address Line 1 *" required>
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="address2" type="text" placeholder="Address Line 2 *" required>
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="suburb" type="text" placeholder="Suburb *" required>
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="state" type="text" placeholder="State *" required>
                                </div>
                            </div>                            
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postcode" type="text" placeholder="Postcode *" required>
                                </div>
                            </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postalAddress1" type="text" placeholder="Postal Address Line 1" >
                                </div>
                            </div>   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postalAddress2" type="text" placeholder="Postal Address Line 2" >
                                </div>
                            </div>                                                                                                                                                                                                    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postalSuburb" type="text" placeholder="Postal Suburb" >
                                </div>
                            </div>   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postalState" type="text" placeholder="Postal State" >
                                </div>
                            </div>   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="postalPostcode" type="text" placeholder="Postal Postcode" >
                                </div>
                                </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="homePhoneNumber" type="text" placeholder="Home Phone Number *" required>
                                </div>
                            </div>   
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-work"></i>
                                    <input name="workPhoneNumber" type="text" placeholder="Work Phone Number *" required>
                                </div>
                            </div> 
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-phone"></i>
                                    <input name="mobilePhoneNumber" type="text" placeholder="Mobile Phone Number *" required>
                                </div>
                            </div> 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <textarea name="alert"  ></textarea>
                                    </div>
                            </div>                                                                                                                                                                          
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-btn-submit">
                                    <input type="submit" value="Add">
                                </div>
                                
                            </div>
                            </div>
                    
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>

    </div>
