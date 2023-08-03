<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                .par-form {
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
}

.form-title {
  width: 80vw;
  background: rgba(0, 0, 0, .3);
  margin: auto;
  color: #FFFFFF;
  padding: 10px 0px 10px 0px;
  text-align: center;
  border-radius: 15px 15px 0px 0px;
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
  background: rgba(255, 255, 255, .1);
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
  background: rgba(255, 255, 255, .1);
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
  padding-top: 1px;
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
  }
  .hi-admin{
    font-size: 1rem;
  }
        </style>
    <?php include('template/admin-header.php'); ?>
            <div id="layoutSidenav_content" class="my-bg">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 text-white">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">PREP</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">STOCK</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">REPORTS</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">END OVER</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                         </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
