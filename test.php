<?php
include_once ('core/init.php');
$con = DB::getInstance();
//$result = mysqli_query($con,"SELECT * FROM users");

$result = $con->get('users', '1');
echo "<table border='1'>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
        echo "<td>" . $row['FirstName'] . "</td>";
        echo "<td>" . $row['LastName'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

//mysqli_close($con);