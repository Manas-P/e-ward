<?php
session_start();
if (isset($_SESSION["adminId"]) != session_id()) {
    header("Location: ../pages/login.php");
    die();
}
else
{
	?>
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/fav.svg" type="image/x-icon">
        <title>Admin</title>
    </head>
    <body>
	    hi Admin
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Ward Number</th>
                <th>House Number</th>
                <th>Ration Number</th>
            </tr>
            <?php
                include '../include/dbcon.php';
                $query="SELECT * FROM `tbl_registration` WHERE `status`=0";
                $result=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $row["fname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phno"]; ?></td>
                <td><?php echo $row["wardno"]; ?></td>
                <td><?php echo $row["houseno"]; ?></td>
                <td><?php echo $row["rationno"]; ?></td>
                <td><a href="../php/approve.php?apprId=<?php echo $row["rid"]; ?>">Approve</a></td>
                <td><a href="../php/reject.php?rejId=<?php echo $row["rid"]; ?>">Reject</a></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <a href="../php/logout.php">Logout</body>
    </body>
    </html>
	<?php
}
?>