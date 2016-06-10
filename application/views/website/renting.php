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
                  <select onchange="onDutyChange()" name="accountId" id="accountId">
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
                  <select name="goods" id="goods">
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">                   
                  <select  name="customers" id="customers">
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">                   
                  <input type="date" id="startDate" name="startDate" />
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">
                  <select name="timeInterval">
                    <option value="7"> 7 Days </option>
                    <option value="14"> 14 Days </option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">
                  <select name="paymentTimes">
                    <option value="1"> 1 Time </option>
                    <option value="2"> 2 Times </option>
                    <option value="3"> 3 Times </option>
                    <option value="4"> 4 Times </option>
                    <option value="5"> 5 Times </option>
                    <option value="6"> 6 Times </option>
                    <option value="7"> 7 Times </option>
                    <option value="8"> 8 Times </option>
                    <option value="9"> 9 Times </option>
                    <option value="10"> 10 Times </option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-field-holder">                   
                  <input name="amount" />
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
        <!--Element Section End-->
      </div>
    </div>
  </div>
</div>
<script>
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
