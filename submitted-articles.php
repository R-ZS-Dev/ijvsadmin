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
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Submitted Articles</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        View
                                    </th>
                                    <th>
                                        Delete
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    if (isset($_GET['view_id'])) {
                                    $id = $_GET['view_id'];
                                    $view_data=$conn->query("SELECT * FROM received_articles WHERE id='$id'");
                                    }                                      
                                   ?>
                                  <?php
                                    $rec_data=$conn->query("SELECT * FROM received_articles");
                                    while($show_rec = $rec_data->fetch_array()){ ?>
                                  <tr>
                                    <td class="py-1">
                                        <?php echo $show_rec['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $show_rec['create_at']; ?>
                                    </td>
                                    <td>
                                        <?php echo $show_rec['article_title'] ?>
                                    </td>
                                    <td>
                                        <a href="receive-article-view.php?view_id=<?php echo $show_rec['id'] ?>">Click & View</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="">Delete</a>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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
