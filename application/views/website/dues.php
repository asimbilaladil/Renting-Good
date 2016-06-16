<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-page-title center">
          <h1>Dues</h1>
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
          <li><a>Dues</a></li>
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
        <!--Element Section End-->
      </div>
      <!--Element Section Start-->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-signup-form">
          <div class="cs-field-holder  col-sm-4">
            <h2>List of Dues</h2>
            <input name="name" type="text" id="searchTerm" placeholder="Search *" onkeyup="doSearch()" >
          </div>
          <table class="table" id="dataTable" >
            <thead>
              <tr>
                <th>Account No#</th>
                <th>Start Date</th>
                <th>Time Interval</th>
                <th>Payment Times</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach ($data['details'] as $due) {
                echo '<tr>
                  <td> '. $due->account_number .' </td>
                  <td> '. $due->start_date .' </td>
                  <td> '. $due->time_interval .' </td>
                  <td> '. $due->payment_times .' </td>
                  <td> '. $due->amount .' </td>
                  <td> <a href="'. site_url('dues/payment?id=' . $due->account_id ) .' "> DUE </a> </td>             
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
<script></script>