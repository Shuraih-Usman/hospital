<?php 
require_once("../config/config.php");
require_once("header.php");

$sql = "SELECT * FROM record WHERE id='".$_GET['record']."'";
$res = $db->query($sql);
$record = $res->fetch_assoc();


$sql = "SELECT * FROM patience WHERE id = '".$record['pt_id']."'";
$res = $db->query($sql);
$patience = $res->fetch_assoc();


$sql = "SELECT * FROM admin_tb WHERE id='".$record['d_id']."'";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$admin = $row['name'];

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

              <img src="uploads/<?php echo $record['images'];?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $patience['firstname'];?></h2>
              <h3><?php echo $patience['surname'].' '.$patience['middlename'];?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
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
require_once("footer.php");
?>