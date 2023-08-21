
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_FILES['image'])){
    $image = $_FILES['image'];
}
  

  // File properties
  $file_name = $image['name'];
  $file_tmp = $image['tmp_name'];
  $file_size = $image['size'];
  $file_error = $image['error'];

  // Get file extension
  $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

  // Allowed file extensions
  $allowed = array('jpg', 'jpeg', 'png');

  // Check if file extension is allowed
  if(in_array($file_ext, $allowed)) {
    // Check for file errors
    if($file_error === 0) {
      // Check file size (in bytes)
      if($file_size <= 1000000) {
        // Set file destination folder
        $file_destination = '../uploads/' . $file_name;
        // Upload file to destination folder
        if(move_uploaded_file($file_tmp, $file_destination)) {
          echo 'File uploaded successfully!';
        } else {
          echo 'Error uploading file!';
        }
      } else {
        echo 'File size must be less than 1MB!';
      }
    } else {
      echo 'Error uploading file!';
    }
  } else {
    echo 'Invalid file type!';
  }
}
?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" value="Upload">
</form>
