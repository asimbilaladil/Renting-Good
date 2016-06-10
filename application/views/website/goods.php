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
      <?php
        if ( $data['result'] == 1) {
        
            echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                           Goods add successfully!
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
            <h6>Add Goods</h6>
            <form action="<?php echo site_url('Welcome/goods') ?>" method="post">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <i class="icon-home"></i>
                    <input name="manufacturer" type="text" placeholder="Manufacturer *" required>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <i class="icon-home"></i>
                    <input name="model" type="text" placeholder="Model *" required>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <i class="icon-home"></i>
                    <input name="other" type="text" placeholder="Other *" required>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <i class="icon-home"></i>
                    <input name="serial" type="text" placeholder="Serial *" required>
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
        <!--Element Section Start-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="cs-signup-form">
            <div class="cs-field-holder  col-sm-4">
              <h2>List Of Goods</h2>
              <input name="name" type="text" placeholder="Search *" id="filterTable-input" data-type="search"   >
            </div>
            <table data-role="table" class=" table"  data-filter="true" data-input="#filterTable-input">
              <thead>
                <tr>
                  <th>Manufacturer</th>
                  <th>Model</th>
                  <th>Other</th>
                  <th>Serial</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($data['result'] as $item) {
                      echo 
                          '<tr>
                              <td> '. $item->manufacturer .'</td>
                              <td> '. $item->model .'</td>
                              <td> '. $item->other .'</td>
                              <td> '. $item->serial .'</td>
                              <td><a href="'. site_url('welcome/editGoods?id=' . $item->id ) .' "><span class="icon-pencil"></span> </a> 
                                       <span>&nbsp;&nbsp;</span>
                                  <a href="'. site_url('welcome/deleteGoods?id=' . $item->id ) .' "><span class="icon-trash"></span> </a> 
                  
                               </td>
                          </tr>';
                  
                  }
                  ?>                  
              </tbody>
            </table>
          </div>
        </div>
        <!--Element Section End-->
      </div>
    </div>
  </div>
</div>