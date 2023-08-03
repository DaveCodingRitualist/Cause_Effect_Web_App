<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Panel</title>
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
              
  .hi-admin{
    font-size: 1rem;
  }
  .juices {
  border-left: 10px solid rgb(255, 255, 255);
  border-right: 10px solid rgb(255, 255, 255);
  background: rgb(0, 92, 117);
}

.syrups {
  border-left: 10px solid rgb(117, 117, 133);
  border-right: 10px solid rgb(117, 117, 133);
  background: rgb(0, 92, 117);
}

.speedrail {
  border-left: 10px solid rgb(194, 159, 96);
  border-right: 10px solid rgb(194, 159, 96);
  background: rgb(0, 92, 117);
}

.pre_mixers {
  border-left: 10px solid rgb(71, 172, 121);
  border-right: 10px solid rgb(71, 172, 121);
}

.infusion {
  /* background-color:  rgb(147, 190, 190); */
  background: rgb(170, 107, 170);
 
}
.daily {
  /* background-color:  rgb(147, 190, 190); */
  background: rgb(202, 202, 65);
 
}

.atomizers {
  border-left: 10px solid rgb(102, 153, 153);
  border-right: 10px solid rgb(102, 153, 153);
}

.dusters {
  /* border-left: 10px solid rgb(202, 202, 65);
  border-right: 10px solid rgb(202, 202, 65); */
  background-color: rgb(143, 143, 107);
}

.tinctures {
  border-left: 10px solid rgb(170, 107, 170);
  border-right: 10px solid rgb(170, 107, 170);
}

.prep .garnishes {
  border-left: 10px solid rgb(143, 143, 107);
  border-right: 10px solid rgb(143, 143, 107);
}

.prep .sorbets {
  border-left: 10px solid rgb(255, 102, 102);
  border-right: 10px solid rgb(255, 102, 102);
}

.prep .others_ingrediens {
  border-left: 10px solid rgb(204, 153, 153);
  border-right: 10px solid rgb(204, 153, 153);
}
 
         ::-webkit-scrollbar{
    width: 15px;
    height: 5px;
}
::-webkit-scrollbar-thumb{
    background: grey;
    border-radius: 50px;
}
::-webkit-scrollbar-track{
    background: #0D0A13;
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
                                <div class="card bg-primary  text-white mb-4">
                                    <div class="card-body">MANAGER REPORT</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small bg-primary text-white stretched-link  " href="shift-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">SPEEDRAIL COUNT</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="rail-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">OPENING PROCEDURE</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="opening-report.php">View details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">CLOSING PROCEDURE</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  stretched-link text-white" href="closing-report.php">View details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success  text-white mb-4">
                                    <div class="card-body">DAILY ORDERS</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link  " href="daily-orders-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">WEEKLY ORDERS</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  text-white stretched-link" href="weekly-orders-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light text-dark mb-4">
                                    <div class="card-body">GLASSWARE AND SETUP</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-dark stretched-link" href="glass-report.php">View Details</a>
                                        <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card  daily text-white mb-4">
                                    <div class="card-body">DAILY ISSUES</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  stretched-link text-white" href="issues-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card  infusion text-white mb-4">
                                    <div class="card-body">SUPPLIES</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  stretched-link text-white" href="supplies-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card dusters  text-white mb-4">
                                    <div class="card-body">PREP</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  stretched-link text-white" href="prep-report.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">UPLOAD CONTENTS</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small  stretched-link text-white" href="upload-contents.php">Manage Contents</a>
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
        <script src="template/header.js"></script>
    </body>
</html>
