<?php include 'include/session.php'; ?>
<?php include 'classes/db_con.php'; ?>
<?php 
  if (isset($_POST['ijv_admin'])) {
      
      $ijv_email = $_POST['email'];
      $ijv_password = $_POST['password'];

      $admin_query="SELECT * FROM admin_login WHERE email='$ijv_email' AND password='$ijv_password'";
      $admin_result=$conn->query($admin_query);
      if ($rows = $admin_result->fetch_array()) {
        $_SESSION['ijv_sess'] = $rows['id'];
        echo "<script>window.location='dashboard.php'</script>";
      }else {
        echo "<script>window.location='index.php?admin_mes=Your Password or Email is Wrong!'</script>";
      }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include 'include/title.php'; ?>
  <link rel="stylesheet" href="css/style.css">
  <?php include 'include/favicon.php'; ?>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <?php if(isset($_GET['admin_mes'])): ?>
              <h3 class="text-danger"><?php echo $_GET['admin_mes'] ?></h3>
            <?php endif ?>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="">
                <img style="height: 60px !important; width: 60px !important;" src="images/logo400.png" alt="logo">
              </div>
              <h4 class="mt-2">Login! IJVS Admin Panel</h4>
              <form action="" method="POST" class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="ijv_admin" value="SIGN IN">
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="dashboard.php">SIGN IN</a> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
