<script>
  document.title = "Password Update";
</script>
<?php
  require_once 'header.php';
  require_once 'securedlogin.php';
  require_once '../config.php';

  $status="Update";
  $crrpasserr=$nwpasserr=$cmpasserr="";
  if(isset($_POST['update'])){
      $crrpass = $_POST['crrpass'];
      $nwpass = $_POST['nwpass'];
      $cmpass = $_POST['cmpass'];
      if(empty($crrpass)){
        $crrpasserr="Field Cannot Be Empty";
      }
      if(empty($nwpass)){
        $nwpasserr="Field Cannot Be Empty";
      }
      if(empty($cmpass)){
        $cmpasserr="Field Cannot Be Empty";
      }

      if($nwpass != $cmpass){
        $cmpasserr = $nwpasserr = "Password Does Not Match";
      }

      if(empty($crrpasserr) && empty($nwpasserr) && empty($cmpasserr)){
        $sql = "SELECT password FROM admin ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if($row['password'] == md5($crrpass)){
            if($row['password'] == md5($nwpass)){
                $status = "Failed. Password Already Exists.";
            }
            else{
              $sql = "UPDATE admin SET password = md5('$nwpass') ";
              $result = mysqli_query($conn, $sql);
              $status = "Password Successfully Updated ";
            }
        }
        else{
          $status = "Failed To Update Password. Try Again";
        }
      }
  }
?>

<section >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <form method="post">
                  <h2 class="fw-bold mb-2 text-uppercase">Password</h2>
                  <p class="text-white-50 mb-5"><?= $status ?></p>

                  <div class="form-outline form-white mb-4">
                    <span class="text-danger" id="crrpasserr"><?= $crrpasserr ?></span>
                    <input type="password" id="crrtypePasswordX" name="crrpass" class="form-control form-control-lg" />
                    <label class="form-label" for="crrtypePasswordX">Current Password</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <span class="text-danger" id="nwpasserr"><?= $nwpasserr ?></span>
                    <input type="password" id="nwtypePasswordX" name="nwpass" class="form-control form-control-lg" />
                    <label class="form-label" for="nwtypePasswordX">New Password</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <span class="text-danger" id="cmpasserr"><?= $cmpasserr ?></span>
                    <input type="password" id="cmtypePasswordX" name="cmpass" class="form-control form-control-lg" />
                    <label class="form-label" for="cmtypePasswordX">Confirm Password</label>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" type="submit" name="update">Update</button>
              </form>

            </div>

            <div>
              <p class="mb-0"><a href="dashboard.php" class="text-white-50 fw-bold">Dashboard</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  require_once 'footer.php';
?>