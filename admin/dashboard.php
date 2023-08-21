<?php 
require_once("../config/config.php");
require_once("header.php");

// doctor total
$sql = "SELECT COUNT(*) AS total_doctors FROM doctor";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$total_doctors = $row['total_doctors'];

// patience total

$sql = "SELECT COUNT(*) AS total_patience FROM patience";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$total_patience = $row['total_patience'];

// records total

$sql = "SELECT COUNT(*) AS total_record FROM record";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$total_record = $row['total_record'];

// record query loop

$sql = "SELECT record.*, COALESCE(admin_tb.username, doctor.username) AS adc_name
 FROM record 
 LEFT JOIN admin_tb ON record.d_id = admin_tb.id
 LEFT JOIN doctor ON record.d_id = doctor.id
 ORDER BY record.id DESC LIMIT 10 ";
$rec_res = $db->query($sql);

// Patience query loop

$sql = "SELECT * FROM patience ORDER BY id DESC LIMIT 5";
$respat = $db->query($sql);

// Record query loop

$sql = "SELECT * FROM record ORDER BY id DESC LIMIT 5";
$resrec = $db->query($sql);



?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title"> Doctors <span>| Registered</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $total_doctors;?></h6>
                  <span class="text-success small pt-1 fw-bold">Total</span> <span class="text-muted small pt-2 ps-1">Doctors</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Patience <span>| Registered</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $total_patience;?></h6>
                  <span class="text-success small pt-1 fw-bold">Total</span> <span class="text-muted small pt-2 ps-1">Patience</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Records <span>| Added</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $total_record;?></h6>
                  <span class="text-danger small pt-1 fw-bold">Total</span> <span class="text-muted small pt-2 ps-1">Records</span>

                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

   

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title"> Patience <span>| Recent added</span></h5>

              <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"><div class="dataTable-top"><div class="dataTable-dropdown"><label><select class="dataTable-selector"><option value="5">5</option><option value="10" selected="">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select> entries per page</label></div><div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div></div><div class="dataTable-container"><table class="table table-borderless datatable dataTable-table">
                <thead>
                  <tr><th scope="col" data-sortable="" style="width: 10.8992%;"><a href="#" class="dataTable-sorter">#</a></th><th scope="col" data-sortable="" style="width: 23.9782%;"><a href="#" class="dataTable-sorter">First Name</a></th><th scope="col" data-sortable="" style="width: 40.1907%;"><a href="#" class="dataTable-sorter">Surname</a></th><th scope="col" data-sortable="" style="width: 9.80926%;"><a href="#" class="dataTable-sorter">Gender</a></th><th scope="col" data-sortable="" style="width: 15.1226%;"><a href="#" class="dataTable-sorter">Status</a></th></tr>
                </thead>



                <tbody>
                  <?php foreach ($respat as $row) {
                    echo '
                    
                    <tr>
                    <th scope="row"><a href="#">#'.$row['id'].'</a></th><td>'.$row['firstname'].'</td><td><a href="#" class="text-primary">'.$row['surname'].'</a></td><td>'.$row['gender'].'</td><td><span class="badge bg-success">Approved</span></td></tr>';
                  }
                  ?>
                 
                   
                    
                    
                    </tbody>
              </table></div><div class="dataTable-bottom"><div class="dataTable-info">Showing 1 to 5 of 5 entries</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"></ul></nav></div></div>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Top Selling <span>| Today</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sickness</th>
                    <th scope="col">Drug</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>

              <?php  
              foreach ($resrec as $row) {
                echo '<tr>
                <th scope="row"><a href="show_record.php?record='.$row['id'].'"><img src="uploads/'.$row['images'].'" alt=""></a></th>
                <td><a href="show_record.php?record='.$row['id'].'" class="text-primary fw-bold">'.$row['fullname'].'</a></td>
                <td>'.$row['sickness'].'</td>
                <td class="fw-bold">'.$row['drug'].'</td>
                <td>'.to_time_ago( strtotime($row['dates']) - 5).'</td>
              </tr>';
              }
              ?>
                  
                 
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- Recent Activity -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Recent Record <span> | Added</span></h5>

          <div class="activity">
<?php 


while ($row = $rec_res->fetch_assoc() ) {
 
echo ' <div class="activity-item d-flex">
<div class="activite-label">'.to_time_ago( strtotime($row['dates']) - 5).'</div>
<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
<div class="activity-content">
   <a href="show_record.php?record='.$row['id'].'" class="fw-bold text-dark">'.$row['fullname'].'</a> Record was added by '.$row['adc_name'].'
</div>
</div>
';
}
?>
           <!-- End activity item-->

          </div>

        </div>
      </div><!-- End Recent Activity -->

      <!-- Budget Report -->
     
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

    </div><!-- End Right side columns -->

  </div>
</section>

</main>

<?php 
require_once("footer.php");
?>