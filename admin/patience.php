<?php 
require_once("../config/config.php");
require_once("header.php");

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
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              while($row = $res->fetch_assoc()) { ?>

             


            <tr>
            <th scope="row"><?php echo $row['id'];?></th>
              <th scope="row"><img src="uploads/<?php echo $row['images'];?>"/></th>
              <td><a href="#" class="text-primary fw-bold"><?php echo $row['firstname'];?> </a></td>
              <td><?php echo $row['surname'];?></td>
              <td><?php echo $row['middlename'];?></td>
              
              <td><?php echo $row['gender'];?></td>
              <td><?php echo $row['addresss'];?></td>
              <td><a href="add_patience.php?edit=<?php echo $row['id'];?>"> <i class="bi bi-pencil-square"></i>   </a></td>
              <td><a href="add_record.php?pt=<?php echo $row['id'];?>"> <i class="bi bi-calendar-plus"></i>   </a></td>
              <td><a href="#" class="link" data-id="<?php echo $row['id'];?>"> <i class="bi bi-x-circle-fill"></i>   </a></td>
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



                    <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        You are about to delete this Patience.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>


<!-- HTML code for the modal dialog -->
<div class="modal fade" id="SuccessModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title color-green">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your deletion was successful.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>




<!-- HTML code for the modal dialog -->
<div class="modal fade" id="errorModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Unable to delete the patience</br>
       Patience Does not exists.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- HTML code for the modal dialog -->
<div class="modal fade" id="error2Modal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Unable to delete the patience</br>
       ID was not specified.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<script>
  // Get all links with the class "link"
  var links = document.querySelectorAll('.link');

  // Attach a click event listener to each link
  links.forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior

      var id = this.getAttribute('data-id'); // Get the ID from the "data-id" attribute

      // Update the Delete button's data-id attribute with the ID
      var deleteButton = document.getElementById('deleteButton');
      deleteButton.setAttribute('data-id', id);

      // Show the modal dialog
      var modal = new bootstrap.Modal(document.getElementById('basicModal'));
      modal.show();
    });
  });

  // Attach a click event listener to the Delete button
  var deleteButton = document.getElementById('deleteButton');
  deleteButton.addEventListener('click', function(event) {
    var id = this.getAttribute('data-id'); // Get the ID from the button's data-id attribute

    // Construct the URL with the clicked ID
    var url = 'pat_delete.php?id=' + id;

    // Perform the deleting request
    window.location.href = url;
  });

</script>



<script>
  // Check if the URL has the success=1 parameter
  var urlParams = new URLSearchParams(window.location.search);
  var successParam = urlParams.get('suc');
  
  // If the success parameter is present and its value is 1, show the success modal
  if (successParam === '1') {
    // Wait for the page to load completely
    window.addEventListener('load', function() {
      var SuccessModal = new bootstrap.Modal(document.getElementById('SuccessModal'));
      SuccessModal.show();
    });
  } else if (successParam === '2') {
    window.addEventListener('load', function() {
      var ErrorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      ErrorModal.show();
    });
  } else if (successParam === '3') {
    window.addEventListener('load', function() {
      var Error2Modal = new bootstrap.Modal(document.getElementById('error2Modal'));
      Error2Modal.show();
    });
  }
</script>

















<?php 
require_once("footer.php");
?>