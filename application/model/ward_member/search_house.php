<?php
    include '../../config/dbcon.php';
    extract($_POST);

    //Houses search
    if(isset($_POST['item'])){
        $input=$_POST['item'];
        $wardno=$_POST['wardno'];
        $searchQuery="SELECT `house_name`, `house_no`, `locality`, `post_office`, `ration_no`, `category` FROM `tbl_house` WHERE (house_name LIKE '{$input}%' OR house_no LIKE '{$input}%' OR locality LIKE '{$input}%' OR post_office LIKE '{$input}%' OR ration_no LIKE '{$input}%' OR category LIKE '{$input}%') AND ward_no='$wardno'";
        $searchResult=mysqli_query($conn,$searchQuery);
        
        if(mysqli_num_rows($searchResult)>0){
            $i=1;
            while($row=mysqli_fetch_array($searchResult)){
            ?>
                <a href="./view_house.php?houseno=<?php echo $row['house_no'];?>" class="data">
                    <table>
                        <tr>
                            <td width=104px><?php echo $i; ?></td>
                            <td width=238px><?php echo $row['house_name']; ?></td>
                            <td width=180px><?php echo $row['house_no']; ?></td>
                            <td width=160px>4</td>
                            <td width=176px><?php echo $row['locality']; ?></td>
                            <td width=208px><?php echo $row['post_office']; ?></td>
                            <td width=240px><?php echo $row['ration_no']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                        </tr>
                    </table>
                </a>

        <?php
        $i=$i+1;
            }
        }else{
            echo '<b> No result found</b>';
        }
    }
?>