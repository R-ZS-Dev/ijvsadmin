<?php include 'classes/programming.php'; ?>
<?php  
  // if (isset($_POST['enter_inpress'])) {
  //     $data=array(
  //     'inpress_title' => trim($_POST['inpress_title']),
  //     'inp_co_authors_names' => trim($_POST['inp_co_authors_names']),
  //     'inpress_abstract' => trim($_POST['inpress_abstract']),
  //     'inpress_keywords' => trim($_POST['inpress_keywords']),
  //     'datetime' => date("Y-m-d")
  //   );
  //   $in_insert=$fun->insert_data('inpress_table', $data);
  //   if ($in_insert) {
  //     echo "<script>window.location='for-inpress.php?in_mes=Sucessfully Data Entered'</script>";
  //   }else{
  //     echo "<script>window.location='for-inpress.php?in_mes=Data Not Entered'</script>";
  //   }
  // }

  if (isset($_POST['enter_inpress'])) {
    $m_name = $_POST['inpress_title'];
    $in_author = $_POST['inp_co_authors_names'];
    $in_abs = $_POST['inpress_abstract'];
    $in_key = $_POST['inpress_keywords'];
    $create_at = date("Y-m-d");

    $filename = $_FILES['inpress_pdf']['name'];
    $file_tmp_name = $_FILES['inpress_pdf']['tmp_name'];

    $inpress_data = $conn->query("INSERT INTO inpress_table (inpress_title, inp_co_authors_names, inpress_abstract, inpress_keywords, inpress_pdf, create_at) VALUES ('$m_name', '$in_author', '$in_abs', '$in_key', '$filename', '$create_at')");
    if(move_uploaded_file($file_tmp_name, "upload/" .$filename))
    if ($inpress_data) {
      echo "<script>window.location='for-inpress.php?in_mes=Successfully Data Entered'</script>";
    }else{
      echo "<script>window.location='for-inpress.php?in_mes=Data Not Entered'</script>";
    }
  }
?>

<?php if (isset($_POST['edit_cancel'])) {
  echo "<script>window.location=for-inpress.php</script>";
} ?>
<?php if (isset($_POST['inpress_cancel'])) {
  echo "<script>window.location=for-inpress.php</script>";
} ?>

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
                  <h4 class="card-title">For In-Press</h4>
                  <p class="card-description">
                    Fill the InPress Form Carefully
                  </p>
                  <!-- Insert MSG -->
                  <?php if (isset($_GET['in_mes'])): ?>
                    <h3 class="text-danger text-center"><?php echo $_GET['in_mes'] ?></h3>
                  <?php endif ?>
                  <!-- Update MSG -->
                  <?php if (isset($_GET['upmes'])): ?>
                    <h3 class="text-success text-center"><?php echo $_GET['upmes'] ?></h3>
                  <?php endif ?>

                  <?php if (!isset($_GET['in_editform'])): ?>
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Article Title</label>
                      <input type="text" name="inpress_title" required="" class="form-control" placeholder="Enter Article Title..." >
                    </div>
                    <div class="form-group">
                      <label>Corresponding et al Author</label>
                      <input type="text" name="inp_co_authors_names" required="" class="form-control" placeholder="Enter Author's..." >
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Abstract</label>
                      <textarea name="inpress_abstract" required="" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Keywords</label>
                      <input type="text" name="inpress_keywords" required="" class="form-control" placeholder="Enter Keywords..." >
                    </div>
                    <div class="form-row">
                    <div class="form-group col-3">
                      <label>Upload PDF</label>
                      <div class="input-group col-xs-12">
                        <input type="file" required="" class="file-upload-info" name="inpress_pdf" placeholder="Upload Image">
                      </div>
                    </div>
                    </div>
                    <button type="submit" name="enter_inpress" class="btn btn-primary mr-2">Submit</button>
                    <button name="inpress_cancel" class="btn btn-light">Cancel</button>
                  </form>
                  <?php endif ?>

                  <?php if (isset($_GET['in_editform'])){ 
                    $id=$_GET['in_edit'];
                    $inpre_edit=$conn->query("SELECT * FROM inpress_table WHERE id='$id'");
                    $inpres_show=$inpre_edit->fetch_array();
                  ?>
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Article Title</label>
                      <input type="text" name="inpress_title" class="form-control" value="<?php echo $inpres_show['inpress_title'] ?>" >
                    </div>
                    <div class="form-group">
                      <label>Corresponding et al Author</label>
                      <input type="text" name="inp_co_authors_names" class="form-control" value="<?php echo $inpres_show['inp_co_authors_names'] ?>" >
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Abstract</label>
                      <textarea name="inpress_abstract" class="form-control" rows="4"><?php echo $inpres_show['inpress_abstract'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Keywords</label>
                      <input type="text" name="inpress_keywords" class="form-control" value="<?php echo $inpres_show['inpress_keywords'] ?>" >
                    </div>
                    <div class="form-row">
                    <div class="form-group col-3">
                      <input type="hidden" class="file-upload-info" name="pdffs" value="<?php echo $inpres_show['id']; ?>">
                      <label>Upload PDF</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="file-upload-info" name="inpress_pdf"><br>
                        <input type="hidden" name="old_pdf" value="<?php echo $inpres_show['inpress_pdf']; ?>">
                        <a href="<?php echo "upload/".$inpres_show['inpress_pdf']; ?>"><?php echo $inpres_show['inpress_pdf']; ?></a>
                      </div>
                    </div>
                    </div>
                    <button type="submit" name="in_edit" class="btn btn-primary mr-2">Edit Record</button>
                    <button name="edit_cancel" class="btn btn-light">Cancel</button>
                  </form>
                  <?php } 
                    if (isset($_POST['in_edit'])) {
                      $id = $_GET['in_edit'];
                      $m_name = $_POST['inpress_title'];
                      $in_author = $_POST['inp_co_authors_names'];
                      $in_abs = $_POST['inpress_abstract'];
                      $in_key = $_POST['inpress_keywords'];
                      $old_pdfs = $_POST['old_pdf'];

                      if ($_FILES["inpress_pdf"]["name"] != "") {
            
                        $location1=$_FILES["inpress_pdf"]["name"];
                        $rann = pathinfo($location1, PATHINFO_EXTENSION);
                        $rename = time();
                        $newname = $rename.'.'.$rann;
                        $folder = "upload/".$newname;
                        move_uploaded_file($_FILES["inpress_pdf"]["tmp_name"],$folder);   
                        }else{
                           $newname = $_POST['old_pdf'];
                        }
                        $location1 = $old_pdfs;

                      $in_update = $conn->query("UPDATE inpress_table SET inpress_title = '$m_name', inp_co_authors_names='$in_author', inpress_abstract='$in_abs', inpress_keywords='$in_key', inpress_pdf='$newname' WHERE id='$id'");
                        unlink("upload/".$old_pdfs);
                      if ($in_update) {
                        echo "<script>window.location='for-inpress.php?upmes=Record Updated Successfully'</script>";
                      }else{
                        echo "<script>window.location='for-inpress.php?upmes=Record Not Updated'</script>";
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">InPress Article Record</h4>
                  <!-- Del Msg -->
                  <?php if (isset($_GET['del_mes'])): ?>
                    <h3 class="text-danger text-center"><?php echo $_GET['del_mes']; ?></h3>
                  <?php endif ?>                  
                  <form action="" method="POST" class="form-sample">
                    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>
                                      Title
                                    </th>
                                    <th>
                                      File
                                    </th>
                                    <th>
                                      Month+Year
                                    </th>
                                    <th>
                                      Edit
                                    </th>
                                    <th>
                                      Delete
                                    </th>
                                  </tr>
                                </thead>

            <!-- Delete -->
            <?php 
              if (isset($_GET['in_del'])) {
              $id=$_GET['in_del'];

              $delinp = $conn->query("SELECT * FROM inpress_table WHERE id='$id'");
              $pdfindel=$delinp->fetch_array();
              unlink("upload/".$pdfindel['inpress_pdf']);

              $in_delt = $conn->query("DELETE FROM inpress_table WHERE id='$id'");
              if($in_delt){
                echo "<script>window.location='for-inpress.php?del_mes=Record Deleted Successfully'</script>";
              }else{
                echo "<script>window.location='for-inpress.php?del_mes=Record Not Deleted</script>";
                }
              }
            ?>

                                <tbody>
                                  <?php $inpress_fetch=$conn->query("SELECT * FROM inpress_table") ?>
                                  <?php while ($inp_data = $inpress_fetch->fetch_array()){ ?>
                                  <tr>
                                    <td class="py-1">
                                      <?php echo $inp_data['inpress_title'] ?>
                                    </td>
                                    <td>
                                      <a href="upload/<?php echo $inp_data['inpress_pdf']; ?>"><?php echo $inp_data['inpress_pdf']; ?></a>
                                    </td>
                                    <td>
                                      <?php echo $inp_data['create_at'] ?>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="?in_editform=yes&in_edit=<?php echo $inp_data['id'] ?>">Edit</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-danger" href="?in_del=<?php echo $inp_data['id'] ?>">Delete</a>
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
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <!-- <script>  
    CKEDITOR.replace('inp_co_authors_names'); 
  </script> -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/file-upload.js"></script>
</body>
</html>