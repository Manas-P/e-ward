<?php
    include '../../../config/dbcon.php';
    session_start();
    //Check login
    if (isset($_SESSION["sessionId"]) != session_id()) {
        header("Location: ../login/login.php");
        die();
    }
    else
    {
        //Fetch User data
        $wardno=$_SESSION['wardno'];
?>
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../public/assets/images/fav.svg" type="image/x-icon">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../../public/assets/css/ward_member/wm_e_doc.css">
        <title>Ward <?php echo $wardno; ?> || E-Documents</title>
    </head>
    <body>
	    <section class="main">
            <!-- ==========Sidebar============= -->
            <?php
                include '../../layout/ward_member/sidebar_e_document.php';
            ?>
            <!-- ==========Sidebar End============= -->
            <div class="container">
                <div class="header">
                    <div class="title">
                        E-Documents
                    </div>
                    <div class="search">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="str" d="M8.25 14.25C11.5637 14.25 14.25 11.5637 14.25 8.25C14.25 4.93629 11.5637 2.25 8.25 2.25C4.93629 2.25 2.25 4.93629 2.25 8.25C2.25 11.5637 4.93629 14.25 8.25 14.25Z" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="str" d="M15.7498 15.75L12.4873 12.4875" stroke="#B1B1B1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                        <input type="text" name="hsearch" placeholder="Search..." id="live-search" autocomplete="off" >
                    </div>
                </div>

                <!-- content -->
                <div class="add-doc">
                    Add document
                </div>

                <div class="headings">
                    <div>Slno.</div>
                    <div style="margin-left: 61px;">Document name</div>
                    <div style="margin-left: 493px;">Uploaded file</div>
                    <div style="margin-left: 153px;">Action</div>
                </div>
                <div class="datas">
                    <?php
                        $tblQuery="SELECT `id`, `doc_name`, `file` FROM `tbl_e_doc` WHERE `wardno`='$wardno'";
                        $tblQueryResult=mysqli_query($conn,$tblQuery);
                        $i=1;
                        while($docData=mysqli_fetch_array($tblQueryResult)){
                    ?>
                    <div class="data">
                        <table>
                            <tr>
                                <td width=101px><?php echo $i ?>.</td>
                                <td width=647px><?php echo $docData['doc_name']; ?></td>
                                <td width=277px>
                                    <a class="view" href="../../../model/viewPdf.php?pdf=<?php echo $docData['file']; ?>" target="_blank">View document</a>
                                </td>
                                <td width=379px>
                                    <a class="delete" href="../../../model/ward_member/delete_e_doc.php?id=<?php echo $docData['id'];?>">Delete document</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        $i=$i+1;
                        }
                        if(mysqli_num_rows($tblQueryResult)==0){
                    ?>
                    <div class="no-result">
                        No records
                    </div>
                    <?php
                        }
                    ?>
                </div>
                
            </div>
        </section>

        <!-- =========== Modal ============ -->
        <div class="overlay modal-hidden"></div>
        <!-- form to add street lights-->
        <div class="box modal-box modal-hidden">
            <div class="title"> Add document </div>
            <div class="modal-close-btn">
                <img src="../../../../public/assets/images/close.svg" alt="close button">
            </div>
            <!-- Add task -->
            <form action="../../../model/ward_member/upload_doc.php" method="post" id="add-doc" enctype="multipart/form-data">
                <div class="inputs">
                    <div class="input docName">
                        <div class="label"> Document name </div>
                        <input type="text" name="docName" id="doc-name" placeholder="Corporation water request" autocomplete="off">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="input edoc">
                        <div class="label"> Upload document </div>
                        <input type="file" name="edocFile" id="up-doc" accept="application/pdf">
                        <div class="error error-hidden">
                        </div>
                    </div>
                    <div class="button dBtn cursor-disable">
                        <input type="submit" value="Add document" name="add-doc" id="add-doc-btn" class="primary-button disabled">
                    </div>
                </div>
            </form>
        </div>


        <!-- Error Toast -->
        <?php
        if (isset($_SESSION['error'])) {
            $msg=$_SESSION['error'];
          echo " <div class='alertt alert-visible'>
                        <div class='econtent'>
                            <img src='../../../../public/assets/images/warning.svg' alt='warning'>
                            <div class='text'>
                                $msg
                            </div>
                        </div>
                        <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                    </div>";
          unset($_SESSION['error']);
        }?>

        <!-- Success toast -->
        <?php
            if (isset($_SESSION['success'])) {
                $msg=$_SESSION['success'];
                echo " <div class='alertt alert-visible' style='border-left: 10px solid #1BBD2B;'>
                            <div class='econtent'>
                                <img src='../../../../public/assets/images/check.svg' alt='success'>
                                <div class='text'>
                                    $msg
                                </div>
                            </div>
                            <img src='../../../../public/assets/images/close.svg' alt='close' class='alert-close'>
                        </div>";
                unset($_SESSION['success']);
        }?>

        <!-- ==========Loading============= -->
        <?php
            include '../../includes/loading.php';
        ?>
        <!-- ==========Loading End============= -->

        <script src="../../../../public/assets/js/wm_e_doc.js"></script>
        <script src="../../../../public/assets/js/toast.js"></script>
    </body>
    </html>
<?php
    }
?>