<?php
    include '../../include/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["memebrId"]) != session_id()) {
        header("Location: ../login.php");
        die();
    }
    else
    {
        //Fetch User data
        $wardno=$_SESSION['wardno'];
        $name=$_SESSION['fullname'];
?>
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../images/fav.svg" type="image/x-icon">
        <link rel="stylesheet" href="../../styles/wm_houses.css">
        <title>Admin</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../include/ward_member/sidebar_houses.php'
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        Manage houses
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="" placeholder="Search..." id="">
                    </div>
                </div>
                <div class="request">
                    <a href="./houses_request.php">
                        View requests
                    </a>
                </div>
                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 70px;">House name</div>
                    <div style="margin-left: 124px;">House no.</div>
                    <div style="margin-left: 90px;">Members</div>
                    <div style="margin-left: 79px;">Locality</div>
                    <div style="margin-left: 105px;">Post office</div>
                    <div style="margin-left: 114px;">Ration card no.</div>
                    <div style="margin-left: 100px;">Category</div>
                </div>
                <div class="datas">
                <?php
                        $query="SELECT * FROM `tbl_house`";
                        $result=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=104px>1.</td>
                                <td width=238px><?php echo $row['house_name']; ?></td>
                                <td width=180px><?php echo $row['house_no']; ?></td>
                                <td width=160px>4</td>
                                <td width=176px><?php echo $row['locality']; ?></td>
                                <td width=208px><?php echo $row['post_office']; ?></td>
                                <td width=240px><?php echo $row['ration_no']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
    </html>
	<?php
}
?>