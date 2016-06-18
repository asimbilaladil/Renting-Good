<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-page-title center">
          <h1>Report</h1>
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
          <li><a>Report</a></li>
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

      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-signup-form">

         
<div class="col-sm-3">
</div>
    <h2 class="col-sm-6 ">Rent  & Own Australia Pty Ltd</h2>
    
  </div>  
  <div class="col-sm-3">
</div>      
  <h6 class="col-sm-8 ">ABN : 30  608 347 182 - ACL : 481594</h6>
</br>
</br>
</br>
        <div class="form-group">

    <label class="col-sm-4 control-label">Consumer Lease Statement - Account</label>
    <div class="col-sm-4">
     <label class="col-sm-6 control-label"><?php  echo  $data['rentDetail']->account_number;?></label>
    </div>
  </div>


<div class="form-group">

    <label class="col-sm-4 control-label">Date</label>
    <div class="col-sm-4">
     <label class="col-sm-6 control-label"><?php echo date("d-m-y");    ?></label>
    </div>
  </div>
<div class="form-group">

    <label class="col-sm-4 control-label"><?php echo $data['rentDetail']->payment_times;    ?>  Payments </label>
    <br>
    <label class="col-sm-4 control-label"> of  $<?php echo $data['rentDetail']->amount;    ?> </label>

  </div>
  
  <?php  foreach ($data['customers'] as $customer) {

  ?>
<div class="form-group">
    <label class="col-sm-4 control-label"><?php echo $customer->fname. " " .$customer->lname;?></label>


<br>

    <label class="col-sm-4 control-label"><?php echo $customer->address1; ?></label>
<br>
    <label class="col-sm-4 control-label"><?php echo $customer->postcode; ?></label>

  </div> 
  <?php } ?> 

<div class="form-group">
<h4 class="col-sm-4 "> List of Goods:</h4>
<br>

  <?php  foreach ($data['goods'] as $good) {

  ?>
    <label class="col-sm-4 control-label"><?php echo $good->manufacturer;?></label>
<br>

  <?php } ?>  
  </div> 
          
          <table data-role="table" class=" table"  data-filter="true" data-input="#filterTable-input">
            <thead>
              <tr>
                <th>Date</th>
                <th>$ Due</th>
                <th>$ Paid</th>
                <th>Arrears Y/N</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $totalPaid = 0;
             $totalDue = 0;
              foreach ($data['report'] as $item) {
                $totalPaid =  $totalPaid + $item->paid;
                $totalDue = $totalDue + $item->due;
                $formatDate = new DateTime($item->date);
                echo '<tr>
                <td> ' . $formatDate->format('d-m-Y') . ' </td>
                <td> ' . $item->due . ' </td>
                <td> ' . $item->paid . ' </td>
                <td> ' . $item->arrears . ' </td>
                </tr>
                ';

              }

            ?>
            </tbody>
          </table>
<div class="form-group">

    <label class="col-sm-4 control-label">Total of  Rental  Payments  Made <?php echo "$".$totalPaid;  ?> </label>

  </div>          
<div class="form-group">

    <label class="col-sm-4 control-label">Balance of  Account at  <?php echo date("d-m-y") . " $".($totalDue-$totalPaid); ?>  </label>

  </div>  
        
        </div>
      </div>
    </div>
      
  </div>
</div>
<script>

    
</script>
