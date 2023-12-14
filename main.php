<?php
require('includes/db.php');
include('includes/auth.php');
?>

<!--CODES START-->

    <!-- ADD NEW ENTRY START -->
    <?php
    if (isset($_POST['addrecord'])) {
        $employeeid = $_POST['employeeid'];
        $userlevel = $_POST['userlevel'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $existingPolicyCheck = mysqli_query($conn, "SELECT employee_id FROM users_tbl WHERE employee_id = '$employeeid'");
        if (mysqli_num_rows($existingPolicyCheck) > 0) {
            echo "<script>
                    alert('USER IS ALREADY EXISTING!');
                    location.href='main.php';
                </script>";
            exit();
        }

        $query = mysqli_query($conn, "INSERT into users_tbl SET 
            employee_id = '$employeeid', 
            user_level = '$userlevel',
            first_name = '$firstname',
            middle_name ='$middlename',  
            last_name = '$lastname', 
            username = '$username', 
            password = md5('$password');
            ") or die(mysqli_error($conn));

        if ($query) {
            echo "<script>
                        location.href='main.php';
                    </script>";
        } else {
            echo "<script>
                        alert('INVALID');
                        location.href='main.php';
                    </script>";
        }
    }
    ?>
    <!-- ADD NEW ENTRY END -->

    <!-- EDIT USER START -->
    <?php
    if (isset($_POST['update'])) {
        $employeeidupdate = $_POST['employeeidupdate'];
        $userlevelupdate = $_POST['userlevelupdate'];
        $firstnameupdate = $_POST['firstnameupdate'];
        $middlenameupdate = $_POST['middlenameupdate'];
        $lastnameupdate = $_POST['lastnameupdate'];
        $usernameupdate = $_POST['usernameupdate'];
        $passwordupdate = md5($_POST['passwordupdate']);
        $updateid = $_POST['ID'];

        $query = mysqli_query($conn, "UPDATE users_tbl SET employee_id = '$employeeidupdate', user_level = '$userlevelupdate', first_name = '$firstnameupdate', middle_name = '$middlenameupdate', last_name = '$lastnameupdate', username = '$usernameupdate', password = '$passwordupdate' WHERE id = '$updateid' ") or die(mysqli_error());

        if ($query) {
            echo "<script>
                    location.href='main.php';
                </script>";
        } else {
            echo "<script>
                    alert('FAILED');
                    location.href='main.php';
                </script>";
        }
    }
?>

    <!-- EDIT USER END -->

    <!-- DELETE USER START -->
    <?php
        if (isset($_POST['delete'])) 
        {
            $ID2 = $_POST['ID2'];
            $query = mysqli_query($conn, "DELETE FROM users_tbl WHERE id = '$ID2' ") or die(mysqli_error());

            if ($query) {
                echo "<script>
                        location.href='main.php';
                    </script>";
            }
        }
    ?>
    <!-- DELETE USER END -->

<!--CODES END-->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>LLOYD LABORATORIES INC.</title>
    <link rel="icon" type="image/x-icon" href="images/lloyd.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>LLOYD LABORATORIES INC.</h1>
    </header>

    <nav>
        <ul>
            <li><a class="" data-toggle="modal" data-target="#logoutmodal"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </nav>

    <!--MODALS START-->
        <!--LOGOUT MODAL START-->
        <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
                    </div>
                    <div class="modal-body" style="text-align:center">
                        <form role="form" method="POST">
                            <h4>Are you sure you want to log out?</h4>
                    </div>
                    <div>
                        <center>
                            <div>
                                <a href="includes/logout.php" class="btn btn-danger" name="btn-logout">Yes</a>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">No</i></button>
                            </div>
                            <br>
                        </center>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--LOGOUT MODAL END-->

        <!--ADD NEW RECORD START-->
        <div class="modal fade" id="add_record" role="dialog">
                    <form method="POST">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ADD NEW RECORD</h4><button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                </div>
                                <!-- <form action="" method="POST" enctype="multipart/form-data">-->
                                <div class="modal-body">
                                    <center>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" name="employeeid" placeholder="EMPLOYEE ID" required>
                                            <select name="userlevel" class="form-control" required>
                                                <option value="none" disabled selected style="display: none;">USER LEVEL</option>
                                                <option value='admin'>ADMIN</option>
                                                <option value='local'>LOCAL</option>
                                            </select>
                                        </div>

                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" name="firstname" placeholder="FIRST NAME" required>
                                            <span class="input-group-addon" style="width:10px; text-align:left;"><i class="fa fa-edit"></i> </span>
                                            <input type="text" class="form-control" name="middlename" placeholder="MIDDLE NAME">
                                            <span class="input-group-addon" style="width:10px; text-align:left;"><i class="fa fa-edit"></i> </span>
                                            <input type="text" class="form-control" name="lastname" placeholder="LAST NAME">
                                        </div>

                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" name="username" placeholder="USERNAME" required>
                                            <span class="input-group-addon" style="width:10px; text-align:left;"><i class="fa fa-edit"></i> </span>
                                            <input type="password" class="form-control" name="password" placeholder="PASSWORD" required>
                                        </div>

                                        <button type="submit" name="addrecord" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-upload"></span> Submit</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <!--ADD NEW RECORD END-->

        <!--MODALS END-->

    <br>

    <!--ADD BUTTON START-->
    <div class="addbutton">
        <button class="btn btn-success" data-toggle='modal' data-target='#add_record' data-backdrop='static' data-keyboard='false'><span class="glyphicon glyphicon-plus"></span>ADD NEW RECORD</button>
    </div>
    <!--ADD BUTTON END-->

    <br>

    <!--SEARCH BAR START-->
    <div class="searchbar">
            <form action="" method="GET" class="search-bar">
                <input type="text" class="searchbaruser" name="recordsearch" placeholder="Search...">
                <button type="submit"><img src="images/search.png"></button>
            </form>
        </div>
    </div>
    <!--SEARCH BAR END-->

    <br>


    <main>
        <!--TABLE START-->
        <?php
        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        if (isset($_GET['recordsearch'])) {
            $filtervalues = $_GET['recordsearch'];
            $query = "SELECT * FROM users_tbl WHERE CONCAT(employee_id, 
            user_level, first_name, middle_name, last_name) LIKE '%$filtervalues%' ORDER BY last_name ASC";
        } else {
            $query = "SELECT * FROM users_tbl ORDER BY last_name ASC";
        }

        $result = mysqli_query($conn, $query) or die(mysqli_error());
        $rowCount = mysqli_num_rows($result);

        ?>
        <div class="table-responsive">
            <table class="content-table" id="dataTables-example">
                <thead>
                    <tr>
                        <th>EMPLOYEE ID</th>
                        <th>USER LEVEL</th>
                        <th>FULL NAME</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rowCount > 0) {
                        $query .= " LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($conn, $query) or die(mysqli_error());

                        while ($row = mysqli_fetch_array($result)) 
                        {
                            $userlevel = $row['user_level'];

                            echo " 
                                    <td style='text-transform: uppercase; '>" . $row['employee_id'] . "</td>
                                    <td style='text-transform: uppercase; '>" . $row['user_level'] . "</td>
                                    <td style='text-transform: uppercase; '>" . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . "</td>
                                    <td style='text-transform: uppercase;'>
                                        <a href='' data-toggle='modal' data-target='#edit" . $row['id'] . "'  data-backdrop='static' data-keyboard='false'><button name='view' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span>EDIT</button></a>
                                        <a href='' data-toggle='modal' data-target='#delete" . $row['id'] . "' data-backdrop='static' data-keyboard='false'><button name='delete' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span>DELETE</button></a>
                                    </td>
                                    </tr>
                                 ";

                            echo "<div class='modal fade' id='edit" . $row['id'] . "' role='dialog'>
                                    <div class='modal-dialog modal-lg'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            EDIT DETAILS
                                            </div>
                                
                                            <form action='' method='POST' enctype='multipart/form-data'>
                                                <div class='modal-body'> 
                                                    <center>
                                                        <div class='form-group input-group'>
                                                            <input type='text' class='form-control' name='employeeidupdate' value=". $row['employee_id'] ." placeholder='EMPLOYEE ID' required>
                                                            <select name='userlevelupdate' class='form-control' required>
                                                                <option value='none' disabled selected style='display: none;'>USER LEVEL</option>
                                                                <option value='admin' " . (($userlevel == 'admin') ? 'selected' : '') . ">ADMIN</option>
                                                                <option value='local' " . (($userlevel == 'local') ? 'selected' : '') . ">LOCAL</option>
                                                            </select>
                                                        </div>
            
                                                        <div class='form-group input-group'>
                                                            <input type='text' class='form-control' name='firstnameupdate' value=". $row['first_name'] ." placeholder='FIRST NAME' required>
                                                            <span class='input-group-addon' style='width:10px; text-align:left;'><i class='fa fa-edit'></i> </span>
                                                            <input type='text' class='form-control' name='middlenameupdate' value=". $row['middle_name'] ." placeholder='MIDDLE NAME'>
                                                            <span class='input-group-addon' style='width:10px; text-align:left;'><i class='fa fa-edit'></i> </span>
                                                            <input type='text' class='form-control' name='lastnameupdate' value=". $row['last_name'] ." placeholder='LAST NAME'>
                                                        </div>
            
                                                        <div class='form-group input-group'>
                                                            <input type='text' class='form-control' name='usernameupdate' value=". $row['username'] ." placeholder='USERNAME' required>
                                                            <span class='input-group-addon' style='width:10px; text-align:left;'><i class='fa fa-edit'></i> </span>
                                                            <input type='password' class='form-control' name='passwordupdate' placeholder='PASSWORD' required>
                                                        </div>
                                        
                                                            <input type='text' style='display:none' value='" . $row['id'] . "' name='ID'>
                                    
                                                            <div>
                                                                <button type='submit' name='update' class='btn btn-primary btn-block'><span class='glyphicon glyphicon-upload'></span> Update</button>
                                                            </div>
                                                    </center>  
                                                </div>
                                            </form>
                                
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                            echo "<div class='modal fade' id='delete" . $row["id"] . "' role='dialog'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                        </div>

                                        <form action='' method='POST' enctype='multipart/form-data'>
                                            <div class='modal-body'>
                                                <center>
                                                    <div class='form-group input-group'>
                                                        <center><label for=''><h4>This user will no longer have access to the system after being deleted. Proceed?</h4></label><br></center>
                                                    </div>

                                                    <div>
                                                        <button type='submit' name='delete' class='btn btn-danger btn-block'><span class='glyphicon glyphicon-upload'></span>Delete</button>
                                                    </div>
                                                </center>
                                                <input type='text' style='display:none' value='" . $row["id"] . "' name='ID2'>
                                            </div>
                                        </form>

                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="4">
                                <center>No Record Found</center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!--TABLE END-->

            <br>

            <div class="float-right">
                <form action="includes/download.php" method="POST">
                    <button type="submit" name="download" class="btn btn-success" data-dismiss="modal"> DOWNLOAD REPORT</button>
                </form>
            </div>

            <br>

            <!-- PAGES START -->
            <div class="pagination" id="pagination">
                <?php
                $queryCount = "SELECT COUNT(*) as total FROM users_tbl;";

                $resultCount = mysqli_query($conn, $queryCount);
                $rowCountData = mysqli_fetch_assoc($resultCount);
                $totalRecords = $rowCountData['total'];

                $totalPages = ceil($totalRecords / $limit);
                $nextThree = min($page + 3, $totalPages);
                echo "<a class='page-link' href='?page=" . max($page - 1, 1) . "'>&laquo; Previous</a>";
                for ($i = max($page - 1, 1); $i <= $nextThree; $i++) {
                    $active = ($i == $page) ? "active" : "";
                    echo "<a class='page-link $active' href='?page=$i'>$i</a>";
                }
                echo "<a class='page-link' href='?page=$totalPages'>Last &raquo;&raquo;</a>";
                ?>
            <!-- PAGES END-->
            </div>
    </main>


    <footer>
        <p>&copy; 2023 MY EXAM WEBSITE</p>
    </footer>

</body>

</html>

<!-- SCRIPTS START -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/login.js"></script>



