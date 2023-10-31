<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
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
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //display session message
            unset($_SESSION['update']); //removing session message
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //display session message
            unset($_SESSION['upload']); //removing session message
        }
        if (isset($_SESSION['no-food-found'])) {
            echo $_SESSION['no-food-found']; //display session message
            unset($_SESSION['no-food-found']); //removing session message
        }
        ?>
        <!--button to add food-->
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title </th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            //query to get category from database
            $sql = "SELECT * FROM tbl_food";
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
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php 
                            // if (!empty($image_name)) { 
                                if($image_name!= "")
                                {
                                    //Display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
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
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                //cach 2 dung echo trong php
            
                echo "<tr><td colspan='7'><div class='error'>No Food Added</div></td></tr>";
            }
            ?>
        </table>
    </div>

</div>
<?php include('partials/footer.php') ?>