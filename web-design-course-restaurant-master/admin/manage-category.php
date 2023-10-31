<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //display session message
            unset($_SESSION['add']); //removing session message
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove']; //display session message
            unset($_SESSION['remove']); //removing session message
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found']; //display session message
            unset($_SESSION['no-category-found']); //removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //display session message
            unset($_SESSION['update']); //removing session message
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //display session message
            unset($_SESSION['upload']); //removing session message
        }

        ?>
        <br><br>

        <!--button to add category-->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            //query to get category from database
            $sql = "SELECT * FROM tbl_category";
            //excute query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);

            $sn = 1;
            //check whether we have database or not
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php 
                            // if (!empty($image_name)) { 
                                if($image_name!= "")
                                {
                                    //Display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='error'>Image not Edit</div>";
                                }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No category Added</div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>

</div>
<?php include('partials/footer.php') ?>