<?php
require_once("../config/config.php");
require_once("../config/function.php");
require_once("header.php");


if(isset($_POST['add']) and isset($_FILES['image'])) {

    

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rank = $_POST['rank'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];


    
    $sql = $db->prepare("SELECT id FROM doctor WHERE username = ?");
    $sql->bind_param('s', $username);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
      $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-octagon me-1"></i>
      Username already exists in the database
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } 

  elseif  (empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_FILES['image']['name']) || empty($_POST['rank']) || empty($_POST['department']) || empty($gender))  {
        $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        All fields are required
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
   
    }
    else {
    $image = $_FILES['image'];
    $file_name = $image['name'];
    $file_tmp = $image['tmp_name'];
    $file_size = $image['size'];
    $file_error = $image['error'];
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
            $sql = $db->prepare("INSERT INTO doctor (fullname,username,passwords,images,rank,department,gender,address) VALUES(?,?,?,?,?,?,?,?)");
            $sql->bind_param('ssssssss',$name,$username,$password,ConvertLink($fileName),$rank,$department,$gender,$address);
            if($sql->execute() === true ) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Doctor Added Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to add the doctor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            }
            $sql->close();
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to upload the image.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> '  ;
        }
    }
  }
    $db->close();
}

elseif (isset($_POST['submit']) and isset($_GET['edit'])) {

  $name = $_POST['name'];
  $rank = $_POST['rank'];
  $department = $_POST['department'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $image = $_FILES['image'];
    $file_name = $image['name'];
    $file_tmp = $image['tmp_name'];
    $file_size = $image['size'];
    $file_error = $image['error'];

  
  
    
  if (empty($file_name)) {
    $sql = $db->prepare("UPDATE doctor SET fullname=?, rank=?, department=?, gender=?, address=? WHERE id = ?");
          $sql->bind_param('sssssi', $name, $rank, $department, $gender, $address, $_GET['edit']);
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
          $sql = $db->prepare("UPDATE doctor SET fullname=?, images=?, rank=?, department=?, gender=?, address=? WHERE id = ?");
          $sql->bind_param('ssssssi', $name, ConvertLink($fileName), $rank, $department, $gender, $address, $_GET['edit']);
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

if (isset($_GET['edit'])) {
  $sql = "SELECT * FROM doctor WHERE id = '".$_GET['edit']."'";
  $res = $db->query($sql);
  $row = $res->fetch_assoc();
}
?>
<main id="main" class="main">
<?php if (isset($_GET['edit'])) { ?> 
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
    <?php }
    else { ?> 
     <div class="pagetitle">
      <h1>Add Doctor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Doctor</li>
          <li class="breadcrumb-item active">Add Doctor</li>
        </ol>
      </nav>
    </div>
    <?php } ?>
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
                  <input type="text" class="form-control" id="inputName5" name="name" value="<?php if (isset($_GET['edit'])) { echo $row['fullname'];}?>">
                </div>
                <?php if (isset($_GET['edit'])) { ?>

                <?php  } else {?>
                  <div class="col-md-6">
                  <label for="inputName5" class="form-label">Username</label>
                  <input type="text" class="form-control" id="input5" name="username">
                </div>

                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword5" name="password">
                </div> <?php }?>
                <div class="col-12">
                  <label for="" class="form-label">Image</label>
                  <input type="file" class="form-control" name="image">
                </div>
                <fieldset class="col-md-6">
                <label for="inputName6" class="form-label">Gender</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Male">
                      <label class="form-check-label" for="gridRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="Female">
                      <label class="form-check-label" for="gridRadios2">
                        Female
                      </label>
                    </div>
                    
                  
                </fieldset>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Rank</label>
                  <input type="text" class="form-control" id="inputAddress2" name="rank" value="<?php if (isset($_GET['edit'])) { echo $row['rank'];}?>">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Department</label>
                  <input type="text" class="form-control" id="inputCity" name="department" value="<?php if (isset($_GET['edit'])) { echo $row['department'];}?>">
                </div>

                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address</label>
                  <textarea row="20" colspan="50" class="form-control" id="inputAddress2" name="address" value="">
                  <?php if (isset($_GET['edit'])) { echo $row['address'];}?>
    </textarea>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="<?php if (isset($_GET['edit'])) { echo 'submit';} else {echo'add';}?>">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
          </div>


</section>

</main>
          <?php
require_once("footer.php"); ?>