<?php include 'classes/programming.php'; ?>
<?php if (isset($_POST['top_ten'])) {
  $title = $_POST['top_title'];
  $author_name = $_POST['top_co_authors_names'];
  $pages = $_POST['top_year_pages'];
  $abstract = $_POST['top_abstract'];
  $keyword = $_POST['top_keywords'];
  $citation = $_POST['top_citations'];
  $create_at = date("Y-m-d");

  $filename = $_FILES['top_pdf']['name'];
  $file_tmp_name = $_FILES['top_pdf']['tmp_name'];

  $top_insert = $conn->query("INSERT INTO top_cited_articles_table (top_title, top_co_authors_names, top_year_pages, top_abstract, top_keywords, top_pdf, top_citations, create_at) VALUES ('$title', '$author_name', '$pages', '$abstract', 'keyword', '$filename', '$citation', '$create_at')");
  if(move_uploaded_file($file_tmp_name, "upload/" .$filename))
    if($top_insert) {
      echo "<script>window.location='for-top10.php?ins_msg=Successfully Data Entered'</script>";
    }else{
      echo "<script>window.location='for-top10.php?ins_msg=Data Not Enter Successfully'</script>";
    }
  } 
?>

<?php if (isset($_POST['top_edit_cancel'])) {
  echo "<script>window.location='for-top10.php'</script>";
} ?>
<?php if (isset($_POST['top_cancel'])) {
  echo "<script>window.location='for-top10.php</script>";
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
                  <h4 class="card-title">For Top-10</h4>
                  <p class="card-description">
                    Fill the Top Ten Articles Form Carefully
                  </p>
                  <!-- Insert MSG -->
                  <?php if(isset($_GET['ins_msg'])): ?>
                    <h3 class="text-danger text-center"><?php echo $_GET['ins_msg']; ?></h3>
                  <?php endif ?>
                  <!-- Update MSG -->
                  <?php if (isset($_GET['upmes'])): ?>
                    <h3 class="text-danger text-center"><?php echo $_GET['upmes']; ?></h3>
                  <?php endif ?>

                  <?php if (!isset($_GET['edittopdata'])): ?>                    
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Article Title</label>
                      <input type="text" name="top_title" required="" class="form-control" placeholder="Enter Article Title..." >
                    </div>
                    <div class="form-group">
                      <label>Corresponding et al Authors</label>
                        <input type="text" name="top_co_authors_names" required="" class="form-control">
                      </div>
                    <div class="form-group">
                      <label>Inter J Vet Sci, 2018, 7(4): 178-181</label>
                      <input type="text" name="top_year_pages" required="" class="form-control" placeholder="Enter Article year & page num..." >
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Abstract</label>
                      <textarea class="form-control" required="" name="top_abstract" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <label>KeyWords</label>
                      <input type="text" class="form-control" required="" name="top_keywords" placeholder="KeyWords..." >
                    </div>
                    <div class="form-row">
                    <div class="form-group col-6">
                      <label>Upload PDF</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="file-upload-info" required="" name="top_pdf" placeholder="Upload Image">
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label>Citation</label>
                      <input type="text" class="form-control" required="" name="top_citations" placeholder="Enter Citation">
                    </div>
                    </div>
                    <button type="submit" name="top_ten" class="btn btn-primary mr-2">Submit</button>
                    <button name="top_cancel" class="btn btn-light">Cancel</button>
                  </form>
                <?php endif ?>

                <?php if (isset($_GET['edittopdata'])){ 
                    $id = $_GET['edit_top'];
                    $top_showdata = $conn->query("SELECT * FROM top_cited_articles_table WHERE id='$id'");
                    $top_show = $top_showdata->fetch_array();
                ?>
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Article Title</label>
                      <input type="text" name="top_title" value="<?php echo $top_show['top_title']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label>Corresponding et al Authors</label>
                        <input type="text" name="top_co_authors_names" value="<?php echo $top_show['top_co_authors_names']; ?>" class="form-control">
                      </div>
                    <div class="form-group">
                      <label>Inter J Vet Sci, 2018, 7(4): 178-181</label>
                      <input type="text" name="top_year_pages" value="<?php echo $top_show['top_year_pages']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Abstract</label>
                      <textarea class="form-control" name="top_abstract" rows="4"><?php echo $top_show['top_abstract']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>KeyWords</label>
                      <input type="text" class="form-control" name="top_keywords" value="<?php echo $top_show['top_keywords']; ?>" >
                    </div>
                    <div class="form-row">
                    <div class="form-group col-6">
                      <input type="hidden" class="file-upload-info" name="toppdf" value="<?php echo $top_show['id'] ?>" >
                      <label>Upload PDF</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="file-upload-info" name="top_pdf" placeholder="Upload Image"><br>
                        <input type="hidden" name="top_old_pdf" value="<?php echo $top_show['top_pdf']; ?>">
                        <a href="<?php echo "upload/".$top_show['top_pdf']; ?>"><?php echo $top_show['top_pdf']; ?></a>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label>Citation</label>
                      <input type="text" class="form-control" name="top_citations" value="<?php echo $top_show['top_citations']; ?>" placeholder="Enter Citation">
                    </div>
                    </div>
                    <button type="submit" name="edit_top" class="btn btn-primary mr-2">Edit Record</button>
                    <button name="top_edit_cancel" class="btn btn-light">Cancel</button>
                  </form>
                <?php } 
                    if (isset($_POST['edit_top'])) {
                      $id = $_GET['edit_top'];
                      $e_title = $_POST['top_title'];
                      $e_authar = $_POST['top_co_authors_names'];
                      $e_page = $_POST['top_year_pages'];
                      $e_abstract = $_POST['top_abstract'];
                      $e_keyword = $_POST['top_keywords'];
                      $e_citation = $_POST['top_citations'];
                      $e_top_pdf = $_POST['top_old_pdf'];

                      if ($_FILES['top_pdf']['name'] != "") {
                         $e_pdfloc = $_FILES['top_pdf']['name'];
                         $toppdfs = pathinfo($e_pdfloc. PATHINFO_EXTENSION);
                         $pdf_newname = time();
                         $e_pdftop = $pdf_newname.'.'.$toppdfs;
                         $top_folder = "upload/".$e_pdftop;
                         move_uploaded_file($_FILES['top_pdf']['tmp_name'],$top_folder);
                      }else{
                        $e_pdftop = $_POST['top_old_pdf'];
                      }
                      $e_pdfloc = $e_top_pdf;

                      $top_edit_q=$conn->query("UPDATE top_cited_articles_table SET top_title = '$e_title', top_co_authors_names = '$e_authar', top_year_pages = '$e_page', top_abstract = '$e_abstract', top_keywords = '$e_keyword', top_citations = '$e_citation', top_pdf = '$e_pdftop' WHERE id='$id'");
                      unlink("upload/".$e_top_pdf);
                      if ($top_edit_q) {
                        echo "<script>window.location='for-top10.php?upmes=Record Updated Successfully'</script>";
                      }else{
                        echo "<script>window.location='for-top10.php?upmes=Record Not Updated'</script>";
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Top10 Article Record</h4>
                  <!-- Delete MSG -->
                  <?php if (isset($_GET['top_del'])): ?>
                    <h3 class="text-danger text-center"><?php echo $_GET['top_pdf'] ?></h3>
                  <?php endif ?>
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
                                      Title
                                    </th>
                                    <th>
                                      Page<i>#</i>
                                    </th>
                                    <th>
                                      Citation
                                    </th>
                                    <th>
                                      PDF File
                                    </th>
                                    <th>
                                      Date
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
              <?php if(isset($_GET['top_del'])){
                $id = $_GET['top_del'];

                $top_del_select=$conn->query("SELECT * FROM top_cited_articles_table WHERE id='$id'");
                $topdels=$top_del_select->fetch_array();
                unlink("upload/".$topdels['top_pdf']);

                $top_delete=$conn->query("DELETE FROM top_cited_articles_table WHERE id='$id'");
                if ($top_delete) {
                  echo "<script>window.location='for-top10.php?del_msg=Record Deleted Successfully'</script>";
                }else{
                  echo "<script>window.location='for-top10.php?del_msg=Record Not Deleted</script>";
                  }
                } 
              ?>
                                <tbody>
                                  <?php $top_fet=$conn->query("SELECT * FROM top_cited_articles_table") ?>
                                  <?php while($top_data = $top_fet->fetch_array()){ ?>
                                  <tr>
                                    <td class="py-1">
                                      <?php echo $top_data['top_title']; ?>
                                    </td>
                                    <td>
                                      <?php echo $top_data['top_year_pages']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $top_data['top_citations']; ?>
                                    </td>                                    
                                    <td>
                                      <a href="upload/<?php echo $top_data['top_pdf']; ?>"><?php echo $top_data['top_pdf'] ?></a>
                                    </td>
                                    <td>
                                      <?php echo $top_data['create_at']; ?>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="?edittopdata=yes&edit_top=<?php echo $top_data['id'] ?>">Edit</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-danger" href="?top_del=<?php echo $top_data['id'] ?>">Delete</a> 
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
