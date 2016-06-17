<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="cs-page-title center">
          <h1>Customers</h1>
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
          <li><a href="#">Customers</a></li>
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
        <div class="page-sidebar col-lg-1 col-md-1 col-sm-12 col-xs-12">
        </div>
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
          <label for="add">You want to add new customer:</label>&nbsp;&nbsp;
          <a href="http://localhost/Renting-Good/index.php/Welcome/addCustomer">   <button type="button" class="btn btn-primary"> Add </button> </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="cs-signup-form">
            <div class="cs-field-holder  col-sm-4">
              <h2>List Of Customers</h2>
              <input name="name" type="text" placeholder="Search *" id="searchTerm" onkeyup="doSearch()">
            </div>
            <table id="dataTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($data['result'] as $key => $item) {
                      echo 
                          '<tr>
                              <td> '. $key .'</td>
                              <td> '. $item->fname." ".$item->lname .'</td>
                              <td><a href="'. site_url('welcome/editCustomer?id=' . $item->id ) .' "><span class="icon-pencil"></span> </a> 
                                       <span>&nbsp;&nbsp;</span>
                                  <a href="'. site_url('welcome/deleteCustomer?id=' . $item->id ) .' "><span class="icon-trash"></span> </a> 
                  
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