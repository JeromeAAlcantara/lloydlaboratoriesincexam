<?php
require ('db.php');
include ('auth.php');
$output = '';

  if(isset($_POST['download']))
  {
    $query = "SELECT * FROM users_tbl ORDER BY last_name ASC";
  }
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
      $output .= '
      <table role="presentation" border="1">
          <tr>
            <th colspan = "5">USERS REPORT</th>
          </tr>
          <tr>
            <th>EMPLOYEE NUMBER</th>
            <th>USER LEVEL</th>
            <th>NAME</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
          </tr>
      ';
      while($row = mysqli_fetch_array($result))
      {
        $output .= '
          <tr>
            <td align="center">'.$row["employee_id"].'</td>
            <td align="center">'.$row["user_level"].'</td>
            <td align="center">' . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . '</td>
            <td align="center">'.$row["username"].'</td>
            <td align="center">'.$row["password"].'</td>
          </tr>
        ';
      }
      $output .= '</table>';
      header("Content-Type: application/xls");
      header("Content-Disposition:attachment; filename=lloydusersreport.xls");
      echo $output;
    }
?>
