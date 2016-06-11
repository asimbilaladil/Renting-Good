<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-page-title center">
          <h1>Renting</h1>
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
          <li><a>Renting</a></li>
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
        <h6>Renting</h6>
          <form action="<?php echo site_url('renting/save') ?>" method="post">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder"> 
                  </br>                    
                  <select onchange="onDutyChange()" name="accountId" id="accountId" required>
                  <?php
                    foreach ($data['accounts'] as $account) {
                        echo '<option value="' . $account->account_id . '"> '. $account->account_number .' </option>';
                    }
                    
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">  
                </br>                 
                  <select name="goods" id="goods" placeholder="Goods" required>
                    <option value="" default selected>Goods</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">  
                  </br>                   
                  <select  name="customers" id="customers" required>
                    <option value="" default selected>Customers</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">  
                  </br>                   
                  <input type="date" id="startDate" name="startDate" placeholder="Start Date"required />
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">
                  </br>  
                  <select name="timeInterval" required>
                    <option value="7"> 7 Days </option>
                    <option value="14"> 14 Days </option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">
                  </br>
                  <input name="paymentTimes" type="number" placeholder="Payment Times" required/>  
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">  
                  </br>                   
                  <input name="amount" type="number" placeholder="Amount" required/>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </br>  
                <div class="cs-btn-submit">
                  <input type="submit" value="Add">
                </div>
              </div>
            </div>
          </form>
        </div>

        <!--Element Section End-->
   </div>
        <!--Element Section Start-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="cs-signup-form">
            <div class="cs-field-holder  col-sm-4">
              <h2>List of Renting</h2>
              <input name="name" type="text" placeholder="Search *" id="filterTable-input" data-type="search"   >
            </div>
            <table data-role="table" class=" table"  data-filter="true" data-input="#filterTable-input">
              <thead>
                <tr>
                  <th>Account No#</th>
                  <th>Customer</th>
                  <th>Good Manufacturer</th>
                  <th>Start Date</th>
                  <th>Time Interval</th>
                  <th>Payment Times</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($data['renting'] as $rent){
                  echo '<tr>
                  <td> '. $rent->account_number .' </td>
                  <td> '. $rent->fname .' </td>
                  <td> '. $rent->manufacturer .' </td>
                  <td> '. $rent->start_date .' </td>
                  <td> '. $rent->time_interval .' </td>
                  <td> '. $rent->payment_times .' </td>
                  <td> '. $rent->amount .' </td>
                  <td><a href="'. site_url('?id=' . $rent->id ) .' "><span class="icon-pencil"></span> </a> 
                                       <span>&nbsp;&nbsp;</span>
                                  <a href="'. site_url('?id=' . $rent->id ) .' "><span class="icon-trash"></span> </a> </td>
                  </tr>';
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>   
    </div>
  </div>
</div>
<script>
window.onload = function() {
  onDutyChange();
};

  function onDutyChange() {
  
      var state =  $('#accountId').val();
  
      $.post('<?php echo site_url('renting/getGoodsByAccount') ?>', {
          state: state
      }, function(data) {
         $('#goods').show().html(data);
      });
  
  
      $.post('<?php echo site_url('renting/getCustomerByAccount') ?>', {
          state: state
      }, function(data) {
         $('#customers').show().html(data);
      });    
  
  }
  
  
</script>
