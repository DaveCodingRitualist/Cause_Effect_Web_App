<?php
session_start();
include('config/db_connect.php');
if(isset($_POST['delete'])){
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM tbl_users WHERE id = $id_to_delete";

  if(mysqli_query($conn, $sql)){
      //success
      header('location: manage-users.php');
  } {
      //failure
      echo 'query error: '. mysqli_error($conn);
  }
}
//check GET request id parameter
if(isset($_GET['id'])){

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  //make sql
  $sql = "SELECT * FROM tbl_users WHERE id = $id";

  //get the query result
  $result = mysqli_query($conn, $sql);

  //fetch result in array format
  $recipe = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>manage-users</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/0fba6da19b.js" crossorigin="anonymous"></script>
       
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');

            * {
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  box-sizing: border-box;
  /* color: #FFFFFF; */

  /* background: rgb(25, 39, 53); */
}

            .recipes{
            font-family: 'Open Sans Condensed', sans-serif;
            width: 100%;
            font-size: 1rem;
                    }
            .add-recipes-container{
                width: 80vw;
            }
            .my-bg{
            background: #0D0A13;
            width: 100%;
            margin: 0;
            height: 100%;
                }
                .add-recipe-btn{
                    margin-left: 1rem;
                }
                /* .par-form {
  color: #FFFFFF;
  font-size: .9rem;
  width: 150px;
  margin: auto;
  padding-top: .5rem;
  padding-bottom: .5rem;
  border-radius: 5px;
  margin-top: 1rem;
  text-align: center;
  background: rgba(255, 255, 255, .3);
  box-shadow: rgb(226, 168, 10);
} */

.form-title {
  width: 80vw;
  background: rgba(255, 255, 255, .3);
  margin: auto;
  color: white;
  padding: 10px 0px 10px 0px;
  text-align: center;
  border-radius: 10px 10px 0px 0px;
}

.form-body {
  width: 80vw;
  max-width: 100rem;
  height: auto;
  /* background: rgba(255, 255, 255, .1); */
  margin: auto;
  align-items: center;
  color: #FFFFFF;
  padding-bottom: 1rem;
  margin-top: 0;
  display: flex;
  flex-direction: column;
  z-index: -1;
  overflow: hidden;
}

.form-entry1 {
  width: 80vw;
  background: rgba(255, 255, 255, .2);
  height: 110px;
  margin-bottom: 5px;
  border-radius: 0px 0px 5px 5px;
  z-index: 0;
  padding-top: 10px;
  /* padding-bottom: 10px; */
  letter-spacing: 2px;
  align-items: center;
  justify-items: center;
}

.form-entry {
  width: 80vw;
  background: rgba(255, 255, 255, .2);
  height: 120px;
  margin-bottom: 5px;
  border-radius: 5px;
  z-index: 0;
  padding-top: 20px;
  letter-spacing: 2px;
  margin-top: 10px;
}

.input {
  /* background: rgba(255, 255, 255, .1); */
  border-top: none;
  border-left: none;
  border-right: none;
  height: 20px;
  border-bottom: 1px solid white;
  color: white;
  width: 280px;
  background: transparent;
  outline: none;
  padding-top: .2px;
  margin-top: .2px;
}

.juices-label, .input {
  background: none;
}

.form-container {
  padding-left: 20px;
  background: none;
}

.submit {
  color: white;
  background: rgb(0, 92, 117);
  font-size: 1rem;
  padding-top: 5px;
  padding-bottom: 5px;
  border-radius: 15px;
  border: none;
  margin-top: 10px;
  outline: none;
  cursor: pointer;
}

.submit:hover {
  border: 1px solid white;
} 
.recipes-form{
    margin: auto;
    align-items: center;
}
   .recipes-submit{
     width: 99%;
    border-radius: 5px;
    background-color: brown;
  }
  .hi-admin{
    font-size: 1rem;
  }
  .error{
    width: 100%;
    height: 20px;
    background-color: transparent;
    margin-top: 2px;
    color: red;
    
  }
  .table-card{
    background: rgba(255, 255, 255, .2);
  }
  section{
    font-family: 'Open Sans Condensed';
            width: 100%;
    font-weight: lighter;
            font-size: 1rem;
  }
  .manage-users2{
    margin-top: 100px;
  }
        </style>

<?php include('template/admin-header.php'); ?>
   
             <section class="recipes mb-3 pb-5">


             <?php
include 'inc/header-admin.php';

// Session::CheckSession();

// $logMsg = Session::get('logMsg');
// if (isset($logMsg)) {
//   echo $logMsg;
// }
// $msg = Session::get('msg');
// if (isset($msg)) {
//   echo $msg;
// }
// Session::set("msg", NULL);
// Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


 ?>
 <section class="manage-users container-fluid"> 

        <div class="border-none pb-2 ps-2 pe-2 ">
          <h3 class="text-muted"><i class="fas fa-users mr-2"></i>User list <span class="float-right">Welcome! <em>
            <span class="badge badge-lg badge-secondary text-white">
<?php
echo $_SESSION['User'];

 ?></span>

          </em></span></h3>
        </div> 

          <table id="example" class="table table-striped table-bordered" margin: auto;">
                  <thead class="bg-black">
                    <tr>
                      <th  class="text-center text-muted">SL</th>
                      <th  class="text-center text-muted">Name</th>
                      <th  class="text-center text-muted">Username</th>
                      <th  class="text-center text-muted">Email address</th>
                      <th  class="text-center text-muted">Mobile</th>
                      <th  class="text-center text-muted">Created</th>
                      <th  width='25%' class="text-center text-muted">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllUserData();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("id") == $value->id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      

                      <br>
                        <td class="text-muted"><?php echo $i; ?></td>
                        <td class="text-muted"><?php echo $value->name; ?></td>
                        <td class="text-muted"><?php echo $value->username; ?> <br>
                          <?php if ($value->roleid  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->roleid == '2') {
                          echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                        }?></td>
                        <td class="text-muted"><?php echo $value->email; ?></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                       
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>

                        <td>
                          <?php if ( Session::get("roleid") == '1') {?>
                            <a class="btn btn-success btn-sm
                            " href="profile.php?id=<?php echo $value->id;?>">View</a>
                            <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                             <?php if ($value->isActive == '0') {  ?>
                               <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                             <?php } elseif($value->isActive == '1'){?>
                               <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                             <?php } ?>




                        <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php  }elseif( Session::get("roleid") == '2'){ ?>
                          <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php }else{ ?>
                        

                          <div class="dropdown">
  <button class="btn btn-info pe-5 ps-5 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu ps-2 bg-dark" aria-labelledby="dropdownMenuButton1">
    <form action="manage-users.php" method="POST">
     
    <li> 
    <a onclick="return confirm('Are you sure To Delete ?')" class="dropdown-item text-primary fw-bold
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>
    </li>
    </form>
  </ul>
</div>


                        <?php } ?>

                        </td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>

        </div>
     
  <?php

  ?>

      
            </section>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
