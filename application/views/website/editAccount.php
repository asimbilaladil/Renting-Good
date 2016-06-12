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
        <div class="alert alert-danger" id="alert" style="display:none">
  <strong>Alert!</strong>Indicates a dangerous or potentially negative action.
</div>
          <div class="cs-signup-form">
            <h6>Add Account</h6>
            <form action="<?php echo site_url('Welcome/editAccount') ?>" method="post" onsubmit="return checkAssignItems();">
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
                      <?php
                      foreach($data['selectedgoods'] as $good) {
                        echo 
                        '
                          <option value="'. $good->id .'" selected> '. $good->manufacturer .' </option>
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

                        if ( in_array( $customer->id,  $data['selectedCustomerIds'] ) ){
                              echo  ' <option selected value="'. $customer->id .'"> '. $customer->fname . ' ' . $customer->lname .' </option>';
                        } else {

                              echo  ' <option value="'. $customer->id .'"> '. $customer->fname . ' ' . $customer->lname .' </option>';
                        }
                       
                      }
                      
                      ?>

                    </select>                    
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-btn-submit">
                  <input type="submit" value="Update" >
                </div>
              </div>
          </div>
          <input type="hidden" value="<?php echo $_GET['id']; ?>" name="accountNumber">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var checkAssignItems  = function  () {
  var rentCustomers =  <?php  echo json_encode( $data['getAssignedAccountCustomers']); ?> ;
  var rentGoods =  <?php  echo json_encode( $data['getAssignedAccountGoods']); ?> ;

    var customers = document.getElementById("customers");
    var goods = document.getElementById("goods");

    

   var checkCustomers = getAssignTextbyValue(customers, rentCustomers);
   var checkGoods =getAssignTextbyValue(goods, rentGoods);

    if( checkCustomers == true && checkGoods == true){
      return true;
    } else {
        var alertMessage1 = alertMessage2 = "";
        if(checkGoods != true){
            alertMessage1 = "You can't deselect these goods: "+ checkGoods + "<br>"; 
        }  
        if ( checkCustomers != true){
             alertMessage2 =  "You can't deselect these customers:"+checkCustomers ;
        } 
        document.getElementById("alert").style.display = "block";
        document.getElementById("alert").innerHTML =alertMessage1 + alertMessage2;
        return false;
    }

  }
  var getAssignTextbyValue  = function  ( selectBox, assignedAccountArray) {
        
      var selectedItems = [];
      var selectBoxOptions = [];
      var message = '';
      var count = 0;
      for ( var i = 0; i < selectBox.length; i++ ) {

          selectBoxOptions.push(selectBox.options[i]);

          if (selectBox.options[i].selected) selectedItems.push(selectBox.options[i].value);
          
      }  
      for ( var i in assignedAccountArray){

        if( selectedItems.indexOf(assignedAccountArray[i]) > -1 ){
            count++;
        } else {
            for( var c in selectBoxOptions){

              if ( selectBoxOptions[c].value == assignedAccountArray[i] ){
                    message = message + " " + selectBoxOptions[c].text;
              }

            }
        }
    }  
    return ( count == assignedAccountArray.length ) ?   true :  message;

        

  }

</script>