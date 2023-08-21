<?php 
require_once("../config/config.php");
require_once("../config/function.php");
require_once("header.php");

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $rank = $_POST['rank'];
  $department = $_POST['department'];
  $image = $_FILES['image'];
    $file_name = $image['name'];
    $file_tmp = $image['tmp_name'];
    $file_size = $image['size'];
    $file_error = $image['error'];

    if (empty($file_name)) {
        $sql = $db->prepare("UPDATE doctor SET fullname=?, rank=?, department=? WHERE id = ?");
              $sql->bind_param('sssi', $name, $rank, $department, $_GET['edit']);
              if ($sql->execute() === true) {
                    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Doctor Edited Succesfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> ' ;
                } else {
                    $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Failed to edit the doctor.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> ' ;
                }
      }

      else
      {
    
    
        
        // Check if the uploaded file is an image
        $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($fileType, $allowedTypes)) {
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Only JPG, JPEG, PNG, and GIF files are allowed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> ';
        }
        elseif(!($file_size <= 1000000) ) {
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            File size must be less than 1MB!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> ';
        }
        else {
            $folder = "uploads/";
            $fileName = uniqid() . '.' . $fileType;
            $targetFile = $folder . $fileName;
            if (move_uploaded_file($file_tmp, $targetFile)) {
              $sql = $db->prepare("UPDATE doctor SET fullname=?, images=?, rank=?, department=? WHERE id = ?");
              $sql->bind_param('ssssi', $name, ConvertLink($fileName), $rank, $department, $_GET['edit']);
              if ($sql->execute() === true) {
                    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Doctor Edited Succesfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> ' ;
                } else {
                    $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Failed to edit the doctor.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> ' ;
                }
                
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to upload the image.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> '  ;
            }
        }
      }

  

}

$sql = "SELECT * FROM doctor WHERE id = '".$_GET['edit']."'";
  $res = $db->query($sql);
  $row = $res->fetch_assoc();
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Doctor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Doctor</li>
          <li class="breadcrumb-item active">Edit Doctor</li>
        </ol>
      </nav>
    </div>
  
    <!-- End Page Title -->
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-md-6 d-flex flex-column align-items-center justify-content-center">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php if (isset($_GET['edit'])) { echo "Edit Doctors";} else{ echo  'Register Doctors'; } ?>
              </h5>
              <?php if (isset($error)) { echo $error; } ?>
              <?php if (isset($success)) { echo $success; } ?>
              <!-- Multi Columns Form -->
              <form method="post" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="inputName5" name="name" value="<?php echo $row['fullname'];?>">
                </div>
                

                
                 

                <div class="col-12">
                  <label for="" class="form-label">Image</label>
                  <input type="file" class="form-control" name="image">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Rank</label>
                  <input type="text" class="form-control" id="inputAddress2" name="rank" value="<?php  echo $row['rank'];?>">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Department</label>
                  <input type="text" class="form-control" id="inputCity" name="department" value="<?php echo $row['department'];?>">
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                 
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
          </div>


</section>

</main>

























<?php

require_once("footer.php");

?>