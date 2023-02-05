<?php include "classes/all_function.php"; ?>
<?php 
if (isset($_POST['save'])) {
  $in=$fun->insert_data("yyear",array('yearNo' => $_POST['yearNo']));
  if ($in) {
    $fun->redirect("year.php?mes=Success");
  }
}
 ?>
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
                  <h4 class="card-title">Year</h4>
                  <form action="" method="POST" class="forms-sample">
                    <div class="form-row">
                      <div class="col-4">
                        <label>Enter Year</label>
                        <select class="form-control" name="yearNo">
                          <option value="<?php echo date("Y") ?>"><?php echo date("Y") ?></option>
                            <?php for ($i=date("Y")-1; $i>=1990; $i--) { ?>
                              <option value="<?php echo $i ?>"><?php echo $i ?></option>
                           <?php } ?>
                        </select>
                      </div>
                    </div>             
                    <button type="submit" name="save" class="btn btn-primary mr-2">Submit</button>
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
                                      #
                                    </th>
                                    <th>
                                      Year
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
                                  <?php $i=1; foreach ($fun->fetch_data("yyear") as $value): ?>
                                  <tr>
                                    <td class="py-1">
                                      <?php   echo $i++ ?>
                                    </td>
                                    <td>
                                      <?php echo $value['yearNo'] ?>
                                    </td>
                                    <td>
                                      Edit Button
                                    </td>
                                    <td>
                                      Article Delete
                                    </td>
                                  </tr>
                                  <?php endforeach ?>
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