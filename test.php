<?php
session_start();
//connection
include('config/db_connect.php');



if(isset($_POST['insertdata']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO student (`fname`,`lname`,`course`,`contact`) VALUES ('$fname','$lname','$course','$contact')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> PHP CRUD with Bootstrap Modal </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="test.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label> Course </label>
                            <input type="text" name="course" class="form-control" placeholder="Enter Course">
                        </div>

                        <div class="form-group">
                            <label> Phone Number </label>
                            <input type="number" name="contact" class="form-control" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2> PHP CRUD Bootstrap MODAL (POP UP Modal) </h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>
                </div>
            </div>
        </div>    
</div>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>