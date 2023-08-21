<?php
require_once("../config/config.php");
require_once("../config/function.php");
require_once("header.php");
$sql = "SELECT * FROM admin_tb
WHERE id='".$_SESSION['id']."'";
$res = $db->query($sql);
$res = $res->fetch_assoc();

$admin = $res['id'];

if (isset($_GET['pt'])) {
$sql = "SELECT * FROM patience WHERE id = '".$_GET['pt']."'";
    $res = $db->query($sql);
    $res = $res->fetch_assoc();
    
    $image = $res['images'];
    $fullname= $res['firstname'].' '.$res['surname'];
    $gender = $res['gender'];



}

if (isset($_GET['edit'])) {
$sql = "SELECT * FROM record WHERE id = '".$_GET['edit']."'";
    $res = $db->query($sql);
    $res = $res->fetch_assoc();

$sql2 = "SELECT * FROM patience WHERE id = '".$_GET['edit']."'";
    $res2 = $db->query($sql2);
    $res2 = $res2->fetch_assoc();

    $image = $res2['images'];
    $fullname= $res2['firstname'].' '.$res2['surname'];
    $gender = $res2['gender'];
}

    
if(isset($_POST['add']) and isset($_GET['pt'])) {

  

    

    
    $sickness = $_POST['sickness'];
    $drug = $_POST['drug'];
    $des = $_POST['description'];
    $pt_id = $_GET['pt'];
    $date = date('Y-m-d H:i:s');
    
    
            $sql = $db->prepare("INSERT INTO record (fullname,sickness,drug,descriptions,pt_id,dates,images,d_id) VALUES(?,?,?,?,?,?,?,?)");
            $sql->bind_param('ssssssss',$fullname,$sickness,$drug,$des,$pt_id,$date,$image,$admin);
            if($sql->execute() === true ) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Record Added Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to add the Recordfddfd.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            }
            $sql->close();
    $db->close();
}

elseif (isset($_POST['submit']) and isset($_GET['edit'])) {

  $name = $_POST['name'];
  $sickness = $_POST['sickness'];
  $drug = $_POST['drug'];
  $des = $_POST['description'];
  $id = $_GET['edit'];

  
  
    
  
    $sql = $db->prepare("UPDATE record SET fullname=?, sickness=?, drug=?, descriptions=?, d_id=? WHERE id = ?");
          $sql->bind_param('sssssi', $name, $sickness, $drug, $des, $admin, $_GET['edit']);
          if ($sql->execute() === true) {
                $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Record Edited Succesfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Failed to edit the record.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> ' ;
            }


 
  
 

}


?>
<main id="main" class="main">
<?php if (isset($_GET['edit'])) { ?> 
    <div class="pagetitle">
      <h1>Edit Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Record</li>
          <li class="breadcrumb-item active">Edit Records</li>
        </ol>
      </nav>
    </div>
    <?php }
    else { ?> 
     <div class="pagetitle">

      <h1>Add Patience Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Records</li>
          <li class="breadcrumb-item active">Patience Records</li>
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
              <h5 class="card-title">  <?php if (isset($_GET['edit'])) { echo "Edit Doctors";} else{ echo  'Add Record'; } ?>
              </h5>
              <?php if (isset($error)) { echo $error; } ?>
              <?php if (isset($success)) { echo $success; } ?>
              <!-- Multi Columns Form -->
              <form method="post" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Patience Name</label>
                  <input type="text" class="form-control" id="inputName5" name="name" value="<?php  echo $fullname;?>">
                </div>
               
                  <div class="col-md-4">
                  <label for="inputName5" class="form-label">Gender</label>
                  <input type="text" class="form-control" id="input5" value="<?php  echo $gender;?>" disabled>
                </div>

                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Sickness</label>
                  <input type="text" class="form-control" id="inputPassword5" name="sickness" value="<?php if (isset($_GET['edit'])) { echo $res['sickness'];}?>">
                </div> 
                <div class="col-6">
                  <label for="" class="form-label">Drug</label>
                  <input type="text" class="form-control" name="drug" value="<?php if (isset($_GET['edit'])) { echo $res['drug'];}?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Prescription / Description</label>
                  <textarea row="80" colspan="60" class="form-control" id="inputAddress2" name="description" value=""><?php if (isset($_GET['edit'])) { echo $res['descriptions'];}?> </textarea>
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