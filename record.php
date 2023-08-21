

<?php

require_once('config/config.php');
require_once('includes/header.php');

if (isset($_GET['id'])) {

  $sql = "SELECT * FROM record WHERE id='".$_GET['id']."'";
$res = $db->query($sql);
$record = $res->fetch_assoc();


$sql = "SELECT * FROM patience WHERE id = '".$record['pt_id']."'";
$res = $db->query($sql);
$patience = $res->fetch_assoc();


$sql = $db->prepare("SELECT record.*, COALESCE(admin_tb.username, doctor.username) AS adc_name
 FROM record
 LEFT JOIN admin_tb ON record.d_id = admin_tb.id
 LEFT JOIN doctor ON record.d_id = doctor.id
 WHERE record.id=?
 ");
 $sql->bind_param('s',$_GET['id']);
 $sql->execute();
 $admin = $sql->get_result()->fetch_array();
 $admin =  $admin['adc_name'];

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Record Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Patience Record</li>
    </ol>
  </nav>
</div>

<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="admin/uploads/<?php echo $record['images'];?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $patience['firstname'];?></h2>
              <h3><?php echo $patience['surname'].' '.$patience['middlename'];?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>

              <!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
  Open Modal
</button>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Overview</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" tabindex="-1" role="tab">Record Details</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" tabindex="-1" role="tab">Drug Prescription</button>
                </li>

                

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Patience Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patience['firstname'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surname / Middle Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patience['surname'].' '.$patience['middlename'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patience['gender'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $patience['addresss'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Created on</div>
                    <div class="col-lg-9 col-md-8"><?php echo $record['dates'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Record open by</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin;?></div>
                  </div>

                  

                </div>

                <div class="tab-pane fade show active profile-overview" id="profile-edit" role="tabpanel">

                  <!-- Profile Edit Form -->
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Sickness</div>
                    <div class="col-lg-9 col-md-8"><?php echo $record['sickness'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Drug</div>
                    <div class="col-lg-9 col-md-8"><?php echo $record['drug'];?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Assigned Doctor</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Record date</div>
                    <div class="col-lg-9 col-md-8"><?php echo $record['dates'];?></div>
                  </div>
                  <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade show active profile-overview" id="profile-settings" role="tabpanel">

                  <!-- Settings Form -->
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Description</div>
                    <div class="col-lg-9 col-md-8"><?php echo $record['descriptions'];?></div>
                  </div>
                  
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>



                    </main>

 <?php
} else {

    
$limit = 10;
$Cpage = isset($_GET['p']) ? $_GET['p'] : 1;
$start = ($Cpage - 1) * $limit;
$sql = "SELECT COUNT(*) AS all_records
FROM record";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$allpost = $row['all_records'];
$allpages = ceil($allpost / $limit);

// select
$sql ="SELECT * FROM record
ORDER BY id
DESC LIMIT $start, $limit";
$res = $db->query($sql);


?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Records Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Records</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
      <div class="row">
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
       <h5 class="card-title">All Our  <span> Patience</span></h5>

            <table class="table table-borderless">
              <thead>
                <tr>
                <th scope="col">ID</th>
                  <th scope="col">Image</th>
                  <th scope="col"> Name</th>
                  <th scope="col">Sickness</th>
                  <th scope="col">datetime</th>
                  <th scope="col">Edit</th>
                  
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              while($row = $res->fetch_assoc()) { ?>

             


            <tr>
            <th scope="row"><?php echo $row['id'];?></th>
              <th scope="row"><img src="admin/uploads/<?php echo $row['images'];?>"/></th>
              <td><a href="record.php?id=<?php echo $row['id'];?>" class="text-primary fw-bold"><?php echo $row['fullname'];?> </a></td>
              <td><?php echo $row['sickness'];?></td>
              <td><?php echo $row['dates'];?></td>
             
              <td><a href="edit_rec.php?id=<?php echo $row['id'];?>"> <i class="bi bi-pencil-square"></i>   </a></td>
            </tr>
       <?php   } ?>


  
            
          </tbody>
        </table>
        
        <nav>
    <ul class="pagination justify-content-center">
        <?php
        // display previous page link
        if ($Cpage > 1) {
            echo '<li class="page-item"><a class="page-link" href="?p=' . ($Cpage - 1) . '">Previous</a></li>';
        }

        // display numbered page links
        $start_link = max(1, $Cpage - 1);
        $end_link = min($allpages, $Cpage + 1);
        for ($i = $start_link; $i <= $end_link; $i++) {
            if ($i == $Cpage) {
                // highlight the current page
                echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
            } else {
                // display numbered link
                echo '<li class="page-item"><a class="page-link" href="?p=' . $i . '">' . $i . '</a></li>';
            }
        }

        // display next page link
        if ($Cpage < $allpages) {
            echo '<li class="page-item"><a class="page-link" href="?p=' . ($Cpage + 1) . '">Next</a></li>';
        }
        ?>
    </ul>
</nav>

</div>

      </div>

    </div>
  </div><!-- End Top Selling -->







 



<?php
} 

require_once('includes/footer.php');

?>