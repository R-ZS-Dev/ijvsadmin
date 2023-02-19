<?php include 'classes/programming.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include 'include/title.php'; ?>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/style.css">
  <?php include 'include/favicon.php'; ?>
</head>
<body>
  <div class="container-scroller">
    <?php include 'include/index.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'include/leftsidenav.php'; ?>
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">For Archive</h4>
                  <p class="card-description text-center">
                    Edit Figure's
                  </p>
                  <?php if (isset($_GET['upmsg'])): ?>
                    <h3 class="text-success text-center"><?php echo $_GET['upmsg'] ?></h3>
                  <?php endif ?>
                    <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                        <div class="col-12">
                          <strong>Add Figures</strong>
                          <?php $archive_article_id = $_GET['view_fig']; ?>
                          <?php $arc_show = $conn->query("SELECT * FROM archive_figure WHERE archive_article_id='$archive_article_id'") ?>
                          <?php while($show_arc = $arc_show->fetch_array()) { ?>

                          <div class="mb-3 input-group repeatDiv" id="repeatDiv">
                            <textarea class="form-control" name="" rows="4"><?php echo $show_arc['fig_text'] ?></textarea>
                            <input type="file" class="form-control" name="" placeholder="Enter Figures"><br>
                            <img src="upload/<?php echo $show_arc['fig_img'] ?>" height="90" width="80">
                          </div>

                          <?php } ?>

                        </div>
                      <button type="submit" name="edit_fig" class="btn btn-primary mr-2 mt-4">Submit</button>
                      <button name="cancel_fig" class="btn btn-light mt-4">Cancel</button>
                    </form>
                    <?php if(isset($_POST['edit_fig'])) {
                          $id = $_GET['edit_fig'];
                          $fig_caption=$_POST['fig_text'];

                          $up_fig=$conn->query("UPDATE archive_figure SET fig_text = '$fig_caption WHERE id='$id'");

                          if ($up_fig) {
                            echo "<script>window.location='for-archive.php?upmsg=Figure Updated Successfully'</script>";
                          } else {
                            echo "<script>window.location='for-archive.php?upmsg=Figure Not Updated'</script>";
                          }
                      } ?>                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include 'include/adminfooter.php'; ?>
      </div>
    </div>
  </div>

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/file-upload.js"></script>
  <script src="js/nicEdit.js"></script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
