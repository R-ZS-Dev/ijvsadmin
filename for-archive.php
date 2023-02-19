<?php include 'classes/programming.php'; ?>
<?php 
  if (isset($_POST['enter_archive'])) {
    $title = $_POST['article_title']; $co_author = $_POST['corresponding_email']; $dept = ($_POST['departments']);
    $abs =$_POST['article_abstract']; $rec_date = $_POST['received_date']; $rev_date = $_POST['revised_date'];
    $acc_date = $_POST['accepted_date']; $online_date = $_POST['available_online_date'];
    $contr_author = $_POST['contribution_authors_text']; $art_keyword = $_POST['article_keywords'];
    $art_doi = $_POST['article_doi']; $all_auth = $_POST['all_authors']; $intro = ($_POST['introduction']);
    $material_and_method = ($_POST['materials_and_methods']); $res = ($_POST['results']);
    $diss = ($_POST['discussion']); $concl = $_POST['conclusions']; $ack = $_POST['acknowledgements'];
    $interest = $_POST['conflict_of_interest']; $ref = ($_POST['reference']); $vol = $_POST['vvolume_id'];
    $iss = 1; $p_no = $_POST['yyear_id']; $p_num = $_POST['page_num']; $submit_time = date("Y-m-d");

    $pdfname = $_FILES['pdf_file']['name'];
    $filepdfname = $_FILES['pdf_file']['tmp_name'];

    $epubname = $_FILES['epub_file']['name'];
    $fileepubname = $_FILES['epub_file']['tmp_name'];

    $flipname = $_FILES['flip_file']['name'];
    $flipfilename = $_FILES['flip_file']['tmp_name'];

    move_uploaded_file($filepdfname, "upload/". $pdfname);
    move_uploaded_file($fileepubname, "upload/". $epubname);
    move_uploaded_file($flipfilename, "upload/". $flipname);
    

 $query="INSERT INTO archive_table (article_title, corresponding_email, departments, article_abstract, received_date, revised_date, accepted_date, available_online_date, contribution_authors_text, article_keywords, article_doi, all_authors, introduction, materials_and_methods, results, discussion, conclusions, acknowledgements, conflict_of_interest, reference, vvolume_id, issue, yyear_id, page_num, pdf_file, epub_file, flip_file, submit_time) VALUES ('$title','$co_author','$dept','$abs','$rec_date','$rev_date','$acc_date','$online_date','$contr_author','$art_keyword','$art_doi','$all_auth','$intro','$material_and_method','$res','$diss','$concl','$ack','$interest','$ref','$vol','$iss','$p_no','$p_num','$pdfname','$epubname','$flipname', '$submit_time')";
    $ins_archive = $conn->query($query);


    $las_q=$conn->query("SELECT id FROM archive_table ORDER BY id DESC");
    $las_id=$las_q->fetch_array()['id'];



    foreach ($_POST['figureText'] as $key => $value) {
      $figureImage = time().$_FILES['figureImage']['name'][$key];
      $figureImageTmp = $_FILES['figureImage']['tmp_name'][$key]; 
      move_uploaded_file($figureImageTmp, "upload/". $figureImage);
      $fir_q=$conn->query("INSERT INTO archive_figure (fig_img, fig_text,archive_article_id) VALUES('$figureImage','$value','$las_id')");

    }


    if($ins_archive){
      echo "<script>window.location='for-archive.php?ins_msg=Data Entered Successfully'</script>";
    } else {
      echo "<script>window.location='for-archive.php?ins_msg=Data Not Inserted'</script>";
    }
  }
?>

<?php 
    if (isset($_POST['arcancel'])) {
      echo "<script>window.location='for-archive.php'</script>";
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
                  <h4 class="card-title">For Archive</h4>
                  <?php if (isset($_GET['ins_msg'])): ?>
                    <h2 class="text-success text-center"><?php echo $_GET['ins_msg'] ?></h2>
                  <?php endif ?>

                  <?php if (isset($_GET['upmsg'])): ?>
                    <h2 class="text-success text-center"><?php echo $_GET['upmsg'] ?></h2>
                  <?php endif ?>

                  <?php if (!isset($_GET['arc_editform'])): ?>

                  <p class="card-description">
                    Fill the Archive Form Carefully
                  </p>

                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <strong>Article Title</strong>
                      <input type="text" name="article_title" class="form-control" placeholder="Enter Article Title..." >
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Corresponding Email</strong>
                      <input type="email" name="corresponding_email" class="form-control" placeholder="Corresponding  Authors Email...">
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Department/Affiliation</strong>
                      <textarea name="departments" class="form-control"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Abstract</strong>
                        <textarea name="article_abstract" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-row">
                      <div class="col-4">
                        <strong>Received</strong>
                        <input type="date" name="received_date" class="form-control">
                      </div>
                      <div class="col-4">
                        <strong>Revised</strong>
                        <input type="date" name="revised_date" class="form-control">
                      </div>
                      <div class="col-4">
                        <strong>Accepted</strong>
                        <input type="date" name="accepted_date" class="form-control">
                      </div>
                      <div class="col-6 mt-2">
                        <strong>Available online</strong>
                        <input type="date" name="available_online_date" class="form-control">
                      </div>
                      <!-- <div class="col-6 mt-2">
                        <strong>Published</strong>
                        <input type="date" name="" class="form-control">
                      </div> -->
                      <div class="col-12 mt-2">
                        <strong>Authors Contribution</strong>
                        <input type="text" name="contribution_authors_text" class="form-control" placeholder="Contribution Authors text" >
                      </div>
                      <div class="col-12 mt-2">
                        <strong>Keywords</strong>
                        <input type="text" name="article_keywords" class="form-control" placeholder="Enter Keywords" >
                      </div>
                      <div class="col-6 mt-2">
                        <strong>DOI</strong>
                        <input type="text" name="article_doi" class="form-control" placeholder="DOI">
                      </div>
                      <div class="col-6 mt-2">
                        <strong>Author's Name</strong>
                        <input type="text" name="all_authors" class="form-control" placeholder="All Author Names">
                      </div>
                    </div>
                    <div id="sample" class="form-group mt-2">
                      <strong>Introduction</strong>
                      <textarea name="introduction" class="form-control"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>MATERIALS AND METHODS</strong>
                      <textarea name="materials_and_methods" class="form-control"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>RESULTS</strong>
                      <textarea name="results" class="form-control"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>DISCUSSION</strong>
                      <textarea name="discussion" class="form-control"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>CONCLUSIONS</strong>
                      <textarea name="conclusions" class="form-control" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                      <strong>Acknowledgements</strong>
                      <textarea name="acknowledgements" class="form-control" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                      <strong>Conflict of Interest</strong>
                      <textarea type="text" name="conflict_of_interest" class="form-control" placeholder="The authors declare no conflict of interest" rows="8"></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>REFERENCE</strong>
                      <textarea name="reference" class="form-control" placeholder="Aghamohammadi M, Haine D, David F, Kelton DF, Barkema HW, Henk Hogeveen H, Keefe GP and Dufour S, 2018. Herd-level mastitis-associated costs on Canadian dairy farms. Frontiers in Veterinary Science 14: 100. https://doi.org/10.3389/fvets.2018.00100"></textarea>
                    </div>
                    <div class="form-row">
                    
                    
                    <div class="col-6">
                      <div class="form-group">
                        <strong>Select Year</strong>
                        <select class="form-control" name="yyear_id" aria-label="Default select example">
                         <?php foreach ($fun->fetch_data("yyear") as $value): ?>
                           <option value="<?php echo $value['id'] ?>"><?php echo $value['yearNo'] ?></option>
                         <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <strong>Select Volume <i>#</i></strong>
                        <select class="form-control" name="vvolume_id" aria-label="Default select example">
                          <?php foreach ($fun->fetch_data("vvolume") as $value): ?>
                           <option value="<?php echo $value['id'] ?>"><?php echo $value['volumeNo'] ?></option>
                         <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <!-- <div class="form-group">
                        <strong>Issue <i>#</i></strong>
                          <input type="text" name="issue" class="form-control" placeholder="No. 4">
                      </div> -->
                    </div>
                    <div class="col-6">
                        <strong>Page Num</strong>
                        <input type="text" name="page_num" class="form-control" placeholder="Pages: 1-9">
                    </div>                    
                    </div>
                    <div class="form-row">
                      <div class="col-4">
                        <div class="form-group">
                          <strong>Upload PDF</strong>
                          <input type="file" name="pdf_file" accept=".pdf" class="form-control">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <strong>Upload ePub File</strong>
                          <input type="file" name="epub_file" class="form-control">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <strong>Upload Text Flip File</strong>
                          <input type="file" name="flip_file" class="form-control">
                        </div>
                      </div>
                      <div class="col-12">
                        <strong>Add Figures</strong>
                        <div class="mb-3 input-group repeatDiv" id="repeatDiv">
                          <textarea class="form-control" name="figureText[]" rows="4"></textarea>
                          <input type="file" class="form-control" name="figureImage[]" placeholder="Enter Figures">
                        </div>
                        <button type="button" class="btn btn-info" id="repeatDivBtn" data-increment="1">Add More Figure</button>
                      </div>
                    </div>                    
                    <button type="submit" name="enter_archive" class="btn btn-primary mr-2 mt-4">Submit</button>
                    <button class="btn btn-light mt-4">Cancel</button>
                  </form>

                  <?php endif ?>

<!-- Edit Record -->

                  <?php 
                    if (isset($_GET['arc_editform'])){
                      $id = $_GET['ar_edit'];
                      $disparch = $conn->query("SELECT * FROM archive_table WHERE id='$id'");
                      $editarchive = $disparch->fetch_array();
                  ?>
                  <p class="card-description text-center">
                    Edit the Archive Article Record
                  </p>

                    <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <strong>Article Title</strong>
                      <input type="text" name="article_title" class="form-control" value="<?php echo $editarchive['article_title'] ?>" >
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Corresponding Email</strong>
                      <input type="email" name="corresponding_email" class="form-control" value=" <?php echo $editarchive['corresponding_email'] ?>">
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Department/Affiliation</strong>
                      <textarea name="departments" class="form-control"><?php echo $editarchive['departments'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>Abstract</strong>
                        <textarea name="article_abstract" class="form-control" rows="4"><?php echo $editarchive['article_abstract'] ?></textarea>
                    </div>
                    <div class="form-row">
                      <div class="col-4">
                        <strong>Received</strong>
                        <input type="date" name="received_date" value="<?php echo $editarchive['received_date'] ?>" class="form-control">
                      </div>
                      <div class="col-4">
                        <strong>Revised</strong>
                        <input type="date" name="revised_date" value="<?php echo $editarchive['received_date'] ?>" class="form-control">
                      </div>
                      <div class="col-4">
                        <strong>Accepted</strong>
                        <input type="date" name="accepted_date" value="<?php echo $editarchive['accepted_date'] ?>" class="form-control">
                      </div>
                      <div class="col-6 mt-2">
                        <strong>Available online</strong>
                        <input type="date" name="available_online_date" value="<?php echo $editarchive['available_online_date'] ?>" class="form-control">
                      </div>
                      <!-- <div class="col-6 mt-2">
                        <strong>Published</strong>
                        <input type="date" name="" class="form-control">
                      </div> -->
                      <div class="col-12 mt-2">
                        <strong>Authors Contribution</strong>
                        <input type="text" name="contribution_authors_text" class="form-control" value="<?php echo $editarchive['contribution_authors_text'] ?>" >
                      </div>
                      <div class="col-12 mt-2">
                        <strong>Keywords</strong>
                        <input type="text" name="article_keywords" class="form-control" value="<?php echo $editarchive['article_keywords'] ?>" >
                      </div>
                      <div class="col-6 mt-2">
                        <strong>DOI</strong>
                        <input type="text" name="article_doi" class="form-control" value="<?php echo $editarchive['article_doi'] ?>">
                      </div>
                      <div class="col-6 mt-2">
                        <strong>Author's Name</strong>
                        <input type="text" name="all_authors" class="form-control" value="<?php echo $editarchive['all_authors'] ?>">
                      </div>
                    </div>
                    <div id="sample" class="form-group mt-2">
                      <strong>Introduction</strong>
                      <textarea name="introduction" class="form-control"><?php echo $editarchive['introduction'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>MATERIALS AND METHODS</strong>
                      <textarea name="materials_and_methods" class="form-control"><?php echo $editarchive['materials_and_methods'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>RESULTS</strong>
                      <textarea name="results" class="form-control"><?php echo $editarchive['results'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>DISCUSSION</strong>
                      <textarea name="discussion" class="form-control"><?php echo $editarchive['discussion'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>CONCLUSIONS</strong>
                      <textarea name="conclusions" class="form-control" rows="8"><?php echo $editarchive['conclusions'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <strong>Acknowledgements</strong>
                      <textarea name="acknowledgements" class="form-control" rows="8"><?php echo $editarchive['acknowledgements'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <strong>Conflict of Interest</strong>
                      <textarea type="text" name="conflict_of_interest" class="form-control" placeholder="The authors declare no conflict of interest" rows="8"><?php echo $editarchive['conflict_of_interest'] ?></textarea>
                    </div>
                    <div id="sample" class="form-group">
                      <strong>REFERENCE</strong>
                      <textarea name="reference" class="form-control" placeholder="Aghamohammadi M, Haine D, David F, Kelton DF, Barkema HW, Henk Hogeveen H, Keefe GP and Dufour S, 2018. Herd-level mastitis-associated costs on Canadian dairy farms. Frontiers in Veterinary Science 14: 100. https://doi.org/10.3389/fvets.2018.00100"><?php echo $editarchive['reference'] ?></textarea>
                    </div>
                    <div class="form-row">
                                        
                    <div class="col-6">
                      <div class="form-group">
                        <strong>Select Year</strong>
                        <select class="form-control" name="yyear_id" aria-label="Default select example">
                          <?php 
                             $yidshow = $conn->query("SELECT * FROM yyear");
                                while($yearids = $yidshow->fetch_array()) { ?>
                          ?>  
                           <option value="<?php echo $yearids['id'] ?>"><?php echo $yearids['yearNo']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <strong>Select Volume <i>#</i></strong>
                        <select class="form-control" name="vvolume_id" aria-label="Default select example">
                          <?php 
                              $vshow =$conn->query("SELECT * FROM vvolume");
                              while($volshow = $vshow->fetch_array()) {
                          ?>
                           <option value="<?php echo $volshow['id'] ?>"><?php echo $volshow['volumeNo']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <!-- <div class="form-group">
                        <strong>Issue <i>#</i></strong>
                          <input type="text" name="issue" class="form-control" placeholder="No. 4">
                      </div> -->
                    </div>
                    <div class="col-6">
                        <strong>Page Num</strong>
                        <input type="text" name="page_num" class="form-control" value="<?php echo $editarchive['page_num'] ?>">
                    </div>                    
                    </div>
                    <div class="form-row">
                      <div class="col-4">
                        <div class="form-group">

                          <input type="hidden" value="<?php echo $editarchive['id']; ?>">
                          <strong>Upload PDF</strong>
                          <input type="file" name="pdf_file" accept=".pdf" class="form-control"><br>
                          <input type="hidden" name="old_pdf" value="<?php echo $editarchive['pdf_file']; ?>">
                          <a href="<?php echo "upload/".$editarchive['pdf_file']; ?>"><?php echo $editarchive['pdf_file']; ?></a>

                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">

                          <input type="hidden" value="<?php echo $editarchive['id']; ?>">
                          <strong>Upload ePub File</strong>
                          <input type="file" name="epub_file" accept=".epub" class="form-control"><br>
                          <input type="hidden" name="old_epub" value="<?php echo $editarchive['epub_file']; ?>">
                          <a href="<?php echo "upload/".$editarchive['epub_file']; ?>"><?php echo $editarchive['epub_file']; ?></a>

                        </div>
                      </div>
                       <div class="col-4">
                        <div class="form-group">

                          <input type="hidden" value="<?php echo $editarchive['id']; ?>">
                          <strong>Upload Text Flip File</strong>
                          <input type="file" name="flip_file" class="form-control">
                          <input type="hidden" name="old_flip" value="<?php echo $editarchive['flip_file']; ?>">
                          <a href="<?php echo "upload/".$editarchive['flip_file']; ?>"><?php echo $editarchive['flip_file']; ?></a>

                        </div>
                      </div> 
                    </div>                    
                    <button type="submit" name="ar_edit" class="btn btn-primary mr-2 mt-4">Edit Record</button>
                    <button name="arcancel" class="btn btn-light mt-4">Cancel</button>
                  </form>

<?php } 
  if(isset($_POST['ar_edit'])) {
    $id = $_GET['ar_edit'];
    $title = $_POST['article_title']; $co_author = $_POST['corresponding_email']; $dept = ($_POST['departments']);
    $abs =$_POST['article_abstract']; $rec_date = $_POST['received_date']; $rev_date = $_POST['revised_date'];
    $acc_date = $_POST['accepted_date']; $online_date = $_POST['available_online_date'];
    $contr_author = $_POST['contribution_authors_text']; $art_keyword = $_POST['article_keywords'];
    $art_doi = $_POST['article_doi']; $all_auth = $_POST['all_authors']; $intro = ($_POST['introduction']);
    $material_and_method = ($_POST['materials_and_methods']); $res = ($_POST['results']);
    $diss = ($_POST['discussion']); $concl = $_POST['conclusions']; $ack = $_POST['acknowledgements'];
    $interest = $_POST['conflict_of_interest']; $ref = ($_POST['reference']); $p_num = $_POST['page_num']; $submit_time = date("Y-m-d"); $year_id = $_POST['yyear_id']; $volume_id = $_POST['vvolume_id']; $old_pdfs = $_POST['old_pdf']; $epub_files = $_POST['old_epub']; $flip_files = $_POST['old_flip'];

                      if ($_FILES["pdf_file"]["name"] != "") {
                        $location1=$_FILES["pdf_file"]["name"];
                        $rann = pathinfo($location1, PATHINFO_EXTENSION);
                        $rename = time();
                        $newname = $rename.'.'.$rann;
                        $folder = "upload/".$newname;
                        move_uploaded_file($_FILES["pdf_file"]["tmp_name"],$folder);   
                        }else{
                           $newname = $_POST['old_pdf'];
                        }

                        if ($_FILES["epub_file"]["name"] != "") {
                        $location2=$_FILES["epub_file"]["name"];
                        $rann = pathinfo($location2, PATHINFO_EXTENSION);
                        $rename = time();
                        $newname1 = $rename.'.'.$rann;
                        $folder = "upload/".$newname1;
                        move_uploaded_file($_FILES["epub_file"]["tmp_name"],$folder);   
                        }else{
                           $newname1 = $_POST['old_epub'];
                        }

                        if ($_FILES["flip_file"]["name"] != "") {
                        $location3=$_FILES["flip_file"]["name"];
                        $rann = pathinfo($location3, PATHINFO_EXTENSION);
                        $rename = time();
                        $newname2 = $rename.'.'.$rann;
                        $folder = "upload/".$newname2;
                        move_uploaded_file($_FILES["flip_file"]["tmp_name"],$folder);   
                        }else{
                           $newname2 = $_POST['old_epub'];
                        }



                        $location1 = $old_pdfs;
                        $location2 = $epub_files;
                        $location3 = $flip_files;

    $q_editarc=$conn->query("UPDATE archive_table SET article_title = '$title', corresponding_email = '$co_author', departments = '$dept', article_abstract = '$abs', received_date = '$rec_date', revised_date = '$rev_date', accepted_date = '$acc_date' , available_online_date = '$online_date', contribution_authors_text = '$contr_author', article_keywords = '$art_keyword', article_doi = '$art_doi', all_authors = '$all_auth', introduction = '$intro', materials_and_methods = '$material_and_method', results = '$res', discussion = '$diss', conclusions = '$concl', acknowledgements = '$ack', conflict_of_interest = '$interest', reference = '$ref', page_num = '$p_num', yyear_id = '$year_id', vvolume_id = '$volume_id', pdf_file='$newname', epub_file = '$newname1', flip_file = '$newname2'  WHERE id='$id'");

      unlink("upload/".$old_pdfs);
      unlink("upload/".$epub_files);
      unlink("upload/".$flip_files);

    if ($q_editarc) {
      echo "<script>window.location='for-archive.php?upmsg=Record Updated Successfully'</script>";
    } else {
      echo "<script>window.location='for-archive.php?upmsg=Record Not Updated'</script>";
    }
  }
?>


                </div>
              </div>
            </div>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Archive Article Record</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="text-center">
                                      Co-Arthur<i></i>
                                    </th>
                                    <th class="text-center">
                                      Page<i>#</i>
                                    </th>
                                    <th>
                                      AcpDate
                                    </th>
                                    <th>
                                      Edit Article
                                    </th>
                                    <th>
                                      Edit Fig
                                    </th>
                                    <th>
                                      Delete
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $arc_show = $conn->query("SELECT * FROM archive_table") ?>
                                  <?php while($show_arc = $arc_show->fetch_array()) { ?>
                                  <tr>                                  
                                    <td class="py-1">
                                      <?php echo $show_arc['corresponding_email']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $show_arc['page_num']; ?>
                                    </td>
                                    <td>
                                      <?php echo $show_arc['accepted_date']; ?>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="?arc_editform=yes&ar_edit=<?php echo $show_arc['id']; ?>">Edit Article</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-warning" href="fig_edit.php?view_fig=<?php echo $show_arc['id'] ?>">Edit Fig</a>
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

  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>  
    CKEDITOR.replace('departments');
    CKEDITOR.replace('introduction');
    CKEDITOR.replace('materials_and_methods');
    CKEDITOR.replace('results');
    CKEDITOR.replace('discussion');
    CKEDITOR.replace('reference');
  </script>

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/file-upload.js"></script>
  <script src="js/nicEdit.js"></script>

<script>
  document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function () {

      $("#repeatDivBtn").click(function () {

        $newid = $(this).data("increment");
        $repeatDiv = $("#repeatDiv").wrap('<div/>').parent().html();
        $('#repeatDiv').unwrap();
        $($repeatDiv).insertAfter($(".repeatDiv").last());
        $(".repeatDiv").last().attr('id',   "repeatDiv" + '_' + $newid);
        $("#repeatDiv" + '_' + $newid).append('<div class="input-group-append"><button type="button" class="btn btn-danger removeDivBtn" data-id="repeatDiv'+'_'+ $newid+'">Remove</button></div>');
        $newid++;
        $(this).data("increment", $newid);
      });

      $(document).on('click', '.removeDivBtn', function () {

        $divId = $(this).data("id");
        $("#"+$divId).remove();
        $inc = $("#repeatDivBtn").data("increment");
        $("#repeatDivBtn").data("increment", $inc-1);

      });
    });
    </script>
</body>

</html>
