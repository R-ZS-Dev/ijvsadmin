<?php include "classes/all_function.php"; ?>
<?php 
if (isset($_POST['save'])) {
  $in=$fun->insert_data("vvolume",array('volumeNo' => $_POST['volumeNo'],'yyear_id' => $_POST['yyear_id']));
  if ($in) {
    $fun->redirect("volume.php?mes=Success");
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
                        <select class="form-control" name="yyear_id">
                          <?php foreach ($fun->fetch_data("yyear") as $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['yearNo'] ?></option>
                            
                          <?php endforeach ?>
                        </select>
                        <label for="">Volume</label>
                        <input type="text" name="volumeNo" class="form-control" required>
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
                                      Volume
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; foreach ($fun->fetch_data("vvolume") as $value): ?>
                                  <tr>
                                    <td class="py-1">
                                      <?php echo $i++ ?>
                                    </td>
                                    <td>
                                      <?php echo $fun->one_value("yyear",array('id' => $value['yyear_id']))['yearNo'] ?>
                                    </td>
                                    <td>
                                      <?php echo $value['volumeNo'] ?>
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
