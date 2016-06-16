<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-page-title center">
          <h1>Accounts</h1>
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
          <li><a>Home</a></li>
          <li><a>Accounts</a></li>
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
          <?php if (isset($_GET["message"] )) { ?>
          <?php if ($_GET["message"] == 'goods') { ?>
          <div class="alert alert-danger" id="alert" >
            <strong>Error!</strong> Account can't be deleted because accounts goods are on rent.
          </div>
          <?php } else if ($_GET["message"] == 'customers') {?>
          <div class="alert alert-danger" id="alert" >
            <strong>Error!</strong> Account can't be deleted because accounts customers are in rent record.
          </div>
          <?php } } ?>
          <div class="cs-signup-form">
            <h6>Add Account</h6>
            <form action="<?php echo site_url('Welcome/accounts') ?>" method="post">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <input name="accountNumber" type="text" value="<?php echo $data['accountNumber'] ?>">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <select name="goods[]" id="goods" multiple="multiple" class="form-control">
                    <?php
                      foreach($data['goods'] as $good) {
                        echo 
                        '
                          <option value="'. $good->id .'"> '. $good->manufacturer .' </option>
                        ';
                      }
                      
                      ?>
                    </select>                    
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <br>
                  <div class="cs-field-holder">
                    <select name="customers[]" id="customers" multiple="multiple" class="form-control">
                    <?php
                      foreach($data['customers'] as $customer) {
                        echo 
                        '
                          <option value="'. $customer->id .'"> '. $customer->fname . ' ' . $customer->lname .' </option>
                        ';
                      }
                      
                      ?>
                    </select>                    
                  </div>
                  <br>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <input name="startdate" type="date" type="text" required>
                  </div>
                    <br>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <select name="paymentTimes" id="paymentTimes" required>
                      <option value="7"> 7 days </option>
                      <option value="14"> 14 days </option>
                    </select>

                  </div>
                    <br>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <input name="timeInterval" placeholder="Payment Times" type="number" required>
                  </div>
                    <br>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-field-holder">
                    <input name="amount" placeholder="Amount" type="number" required>
                  </div>
                    <br>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-btn-submit">
                  <input type="submit" value="Add">
                </div>
              </div>
          </div>
          </form>
        </div>
        <!--Element Section Start-->
        <!--Element Section Start-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="cs-signup-form">
            <div class="cs-field-holder  col-sm-4">
              <h2>List Of Goods</h2>
              <input name="name" type="text" id="search" placeholder="Search *" >
            </div>
            <table class="table" id="table" >
              <thead>
                <tr>
                  <th>Account Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($data['accounts'] as $item) {
                      echo 
                          '<tr>
                              <td  class="col-lg-8 col-md-8 col-sm-8 col-xs-8" > '. $item->account_number .'</td>
                              <td  class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><a href="'. site_url('welcome/editAccount?id=' . $item->account_id ) .' "><span class="icon-pencil"></span> </a> 
                                       <span>&nbsp;&nbsp;</span>
                                  <a href="'. site_url('welcome/deleteAccount?id=' . $item->account_id ) .' "><span class="icon-trash"></span> </a> 
                                <span>&nbsp;&nbsp;</span>
                                 <a href="'. site_url('report?id=' . $item->account_id ) .' "><span class="icon-desktop"></span> </a> 
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