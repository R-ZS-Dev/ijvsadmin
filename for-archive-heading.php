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
                  <h4 class="card-title">For Archive Heading</h4>
                  <form action="" method="POST" class="forms-sample">
                    <div class="form-row">
                      <div class="col-4">
                        <label>Enter Year</label>
                        <input type="text" class="form-control" placeholder="2012">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Enter Month January-March</label>
                      <input type="text" class="form-control" placeholder="Enter January-March..." >
                    </div>       
                    <div class="form-group">
                      <label>Enter Volume #</label>
                      <input type="text" class="form-control" placeholder="Enter Article Title..." >
                    </div>             
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Archive Heading Record</h4>
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
                                      Volume#
                                    </th>
                                    <th>
                                      Edit
                                    </th>
                                    <th>
                                      Delete
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td class="py-1">
                                      ID
                                    </td>
                                    <td>
                                      Volume
                                    </td>
                                    <td>
                                      Edit Button
                                    </td>
                                    <td>
                                      Article Delete
                                    </td>
                                  </tr>
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
