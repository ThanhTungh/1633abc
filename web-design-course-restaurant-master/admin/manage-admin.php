<?php include('partials/menu.php'); ?>
<!-- Main content Section Starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manager Admin</h1>
        <br /><br />


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //display session message
            unset($_SESSION['add']); //removing session message
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //display session message
            unset($_SESSION['delete']); //removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //display session message
            unset($_SESSION['update']); //removing session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //display session message
            unset($_SESSION['user-not-found']); //removing session message
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; //display session message
            unset($_SESSION['pwd-not-match']); //removing session message
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; //display session message
            unset($_SESSION['change-pwd']); //removing session message
        }
        ?>
        <br><br><br>

        <!--button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            //query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //check whether the query is execute or not
            if ($res == TRUE) {
                //Count row whether we have data in databse or not
                $count = mysqli_num_rows($res); //function to get all the row in databse
                $sn=1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Using while loop to get all the data from database
                        //while loop willl run as long as we have data in database

                        //Get invidual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"  class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        
            <?php

                    }
                } else {
                }
            }
            ?>
            
        </table>
        <div class="clearfix"></div>
    </div>

</div>
<!-- Footer section starts -->
<?php include('partials/footer.php') ?>