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

              foreach ($data['report'] as $item) {
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
        </div>
      </div>
    </div>
      
  </div>
</div>
<script>

    
</script>
