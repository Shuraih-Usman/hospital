<?php require_once('config/config.php');?>
<?php require_once('includes/header.php');


  $stmt = $db->prepare('SELECT * FROM doctor WHERE id=?');
  $stmt->bind_param('s',$_SESSION['id']);
  $stmt->execute();
  $pat = $stmt->get_result()->fetch_array();



  ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Patient Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Patient Page</li>
    </ol>
  </nav>
</div>

<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="admin/uploads/<?php echo $pat['images'];?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $pat['fullname'];?></h2>
              <h3><?php echo $pat['rank'];?></h3>
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
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Patience Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">username</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['username'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"> Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['fullname'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['gender'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['department'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['rank'];?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['address'];?></div>
                  </div>


                  

                  

                </div>

                



               

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>



                    </main>



    

  <!-- ======= Footer ======= -->
<?php require_once('includes/footer.php');?>

</body>

</html>