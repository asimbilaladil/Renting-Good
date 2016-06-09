 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Goods</h1>
    
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
                        <li><a href="#">Goods</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
                      
       
            <div class="row">
                 <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        
                    </div>


                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>Add Goods</h6>
                        <form action="<?php echo site_url('Welcome/editGoods') ?>" method="post">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="manufacturer" type="text" placeholder="Manufacturer *" required value="<?php echo $data->manufacturer; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="model" type="text" placeholder="Model *" required value="<?php echo $data->model; ?>">
                                </div>
                            </div>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="other" type="text" placeholder="Other *" required value="<?php echo $data->other; ?>">
                                </div>
                            </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-home"></i>
                                    <input name="serial" type="text" placeholder="Serial *" required value="<?php echo $data->serial; ?>">
                                </div>
                            </div> 
                            <?php echo '  <input type="hidden" name="id" class="form-control" id="" placeholder="" value="'.$data->id.'" required>'; ?>                           
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
