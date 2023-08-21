<?php require_once('config/config.php');?>
<?php require_once('includes/header.php');
if (isset($_GET['id'])) {

  $stmt = $db->prepare('SELECT * FROM patience WHERE id=?');
  $stmt->bind_param('s',$_GET['id']);
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
              <h2><?php echo $pat['firstname'];?></h2>
              <h3><?php echo $pat['surname'].' '.$pat['middlename'];?></h3>
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
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['firstname'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Surname / Middle Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['surname'].' '.$pat['middlename'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['gender'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $pat['addresss'];?></div>
                  </div>


                  

                  

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
$sql = "SELECT COUNT(*) AS all_patience
FROM patience";
$res = $db->query($sql);
$row = $res->fetch_assoc();
$allpost = $row['all_patience'];
$allpages = ceil($allpost / $limit);

// select
$sql ="SELECT * FROM patience
ORDER BY id
DESC LIMIT $start, $limit";
$res = $db->query($sql);


?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Patience Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Patience</li>
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
                  <th scope="col">First Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Middle Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Address</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Add Record</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              while($row = $res->fetch_assoc()) { ?>

             


            <tr>
            <th scope="row"><?php echo $row['id'];?></th>
              <th scope="row"><img src="admin/uploads/<?php echo $row['images'];?>"/></th>
              <td><a href="patient.php?id=<?php echo $row['id'];?>" class="text-primary fw-bold"><?php echo $row['firstname'];?> </a></td>
              <td><?php echo $row['surname'];?></td>
              <td><?php echo $row['middlename'];?></td>
              
              <td><?php echo $row['gender'];?></td>
              <td><?php echo $row['addresss'];?></td>
              <td><a href="add_pat.php?edit=<?php echo $row['id'];?>"> <i class="bi bi-pencil-square"></i>   </a></td>
              <td><a href="add_rec.php?pt=<?php echo $row['id'];?>"> <i class="bi bi-calendar-plus"></i>   </a></td>
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







</div>
</section>


                    </main>











            
          

<?php
}

?>



    

  <!-- ======= Footer ======= -->
<?php require_once('includes/footer.php');?>

</body>

</html>