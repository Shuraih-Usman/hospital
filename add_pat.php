<?php
require_once("config/config.php");
require_once("config/function.php");
require_once("includes/header.php");

if(isset($_POST['add']) and isset($_FILES['image'])) {

    

    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    

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
        $folder = "admin/uploads/";
        $fileName = uniqid() . '.' . $fileType;
        $targetFile = $folder . $fileName;
        if (move_uploaded_file($file_tmp, $targetFile)) {
            $sql = $db->prepare("INSERT INTO patience (firstname,surname,middlename,images,gender,addresss) VALUES(?,?,?,?,?,?)");
            $sql->bind_param('ssssss',$firstname,$surname,$middlename,ConvertLink($fileName),$gender,$address);
            if($sql->execute() === true ) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Patience Added Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to add the Patience.
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
  
    $db->close();
}

elseif (isset($_POST['submit']) and isset($_GET['edit'])) {

    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    

  
  
    
  if (empty($_FILES['image']['name'])) {
    $sql = $db->prepare("UPDATE patience SET firstname=?, surname=?, middlename=?, gender=?, addresss=?  WHERE id = ?");
          $sql->bind_param('sssssi', $firstname, $surname, $middlename, $gender, $address, $_GET['edit']);
          if ($sql->execute() === true) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Patience Edited Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to edit the patience.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            }
  }
  else
  {

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
        $folder = "admin/uploads/";
        $fileName = uniqid() . '.' . $fileType;
        $targetFile = $folder . $fileName;
        if (move_uploaded_file($file_tmp, $targetFile)) {
          $sql = $db->prepare("UPDATE patience SET firstname=?, surname=?, middlename=?, images=?, gender=?, addresss=? WHERE id = ?");
          $sql->bind_param('ssssi', $firstname, $surname, $middlename, ConvertLink($fileName), $gender, $address, $_GET['edit']);
          if ($sql->execute() === true) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Patience Edited Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to edit the Patience.
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
  $sql = "SELECT * FROM patience WHERE id = '".$_GET['edit']."'";
  $res = $db->query($sql);
  $row = $res->fetch_assoc();
}
?>
<main id="main" class="main">
<?php if (isset($_GET['edit'])) { ?> 
    <div class="pagetitle">
      <h1>Edit Patience</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Patience</li>
          <li class="breadcrumb-item active">Edit Patience</li>
        </ol>
      </nav>
    </div>
    <?php }
    else { ?> 
     <div class="pagetitle">
      <h1>Add Patience</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Patience</li>
          <li class="breadcrumb-item active">Add Patience</li>
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
              <h5 class="card-title">  <?php if (isset($_GET['edit'])) { echo "Edit Patience";} else{ echo  'Register Patience'; } ?>
              </h5>
              <?php if (isset($error)) { echo $error; } ?>
              <?php if (isset($success)) { echo $success; } ?>
              <!-- Multi Columns Form -->
              <form method="post" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="inputName5" name="firstname" value="<?php if (isset($_GET['edit'])) { echo $row['firstname'];}?>">
                </div>
                
                  <div class="col-md-6">
                  <label for="inputName5" class="form-label">Surname</label>
                  <input type="text" class="form-control" id="input5" name="surname" value="<?php if (isset($_GET['edit'])) { echo $row['surname'];}?>">
                </div>

                <div class="col-md-6">
                  <label for="inputName6" class="form-label">Middle Name</label>
                  <input type="text" class="form-control" id="inputName6" value="<?php if (isset($_GET['edit'])) { echo $row['middlename'];}?>" name="middlename">
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
                  <label for="" class="form-label">Image</label>
                  <input type="file" class="form-control" name="image">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address</label>
                  <textarea row="20" colspan="50" class="form-control" id="inputAddress2" name="address" value="">
                  <?php if (isset($_GET['edit'])) { echo $row['addresss'];}?>
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
require_once("includes/footer.php"); ?>