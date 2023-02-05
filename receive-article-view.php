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
                  <h4 class="card-title">Received Articles</h4>
                  <?php 
                    $id = $_GET['view_id'];
                    $rec_art = $conn->query("SELECT * FROM received_articles WHERE id='$id'");
                    $rec_show = $rec_art->fetch_array();
                  ?>
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <strong class="text-primary">Article Title:</strong> <br>
                      <span><?php echo $rec_show['article_title'] ?></span>
                    </div>
                    <div class="form-group">
                      <strong class="text-primary">Corresponding Email:</strong> <br>
                      <span><?php echo $rec_show['co_author_email'] ?></span>
                    </div>
                    <div class="form-group">
                      <strong class="text-primary">Department/Affiliation:</strong> <br>
                      <span><?php echo $rec_show['dept'] ?></span>
                    </div>
                    <div class="form-group">
                      <strong class="text-primary">Abstract:</strong> <br>
                      <textarea style="text-align:justify; font-size: 17px;" disabled class="form-control" rows="8"><?php echo $rec_show['abstract'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <strong class="text-primary">KeyWords:</strong> <br>
                      <span><?php echo $rec_show['keywords'] ?></span>
                    </div>
                    <div class="form-group">
                      <strong class="text-primary">Soft Form</strong> <br>
                      <span>PDF: <a href="upload/<?php echo $rec_show['pdf'] ?>"><?php echo $rec_show['pdf'] ?></a></span><br>
                      <span>Word File: <a href="upload/<?php echo $rec_show['potential_reviewer'] ?>"><?php echo $rec_show['potential_reviewer'] ?></a></span>
                    </div>
                    <button class="btn btn-light"><a href="submitted-articles.php">BACK</a></button>
                  </form>
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
</body>

</html>
