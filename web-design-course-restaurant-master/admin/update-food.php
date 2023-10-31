<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            //get the id and all other  detail
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql2 = "SELECT * FROM tbl_food WHERE id= $id";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count the row to check whether the id is valid or not
            $count = mysqli_num_rows($res2);
            if ($count == 1) {
                //get all the data
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                //redirect to manage category
                $_SESSION['no-food-found'] = "<div class = 'error'>Food not Found </div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        } else {
            header('location: ' . SITEURL . 'admin/manage-food.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if ($current_image != "") {
                        //Display the image
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                    <?php
                    } else {
                        //display message
                        echo "<div class='error'> Image Not Added.</div>";
                    }
                    ?>
                </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to display category  from database
                            //1. create sql to get active category from database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";
                            //executing query
                            $res = mysqli_query($conn, $sql);
                            //Couunt rows to check whether we have category or not
                            $count = mysqli_num_rows($res);
                            //if count > 0 we have category if not
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the value
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category Found</option>
                            <?php
                            }
                            //2. display on drop down
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image
            if (isset($_FILES['image']['name'])) {
                //get the image detail
                $image_name = $_FILES['image']['name'];
                //check whether the image is available or not
                if ($image_name != "") {
                    //image available
                    //remove current image
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not and if the image is not uploaded then we will stop the process and redirect with message
                    if ($upload == false) {
                        //set message
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload image <div>";
                        //redirect to add category page
                        header("location:" . SITEURL . 'admin/manage-food.php');
                        //stop the process
                        die();
                    }
                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //update database
            $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";
            $res3 = mysqli_query($conn, $sql3);
            //redirect

            if ($res3 == true) {
                $_SESSION['update'] = "<div class= 'success'> Food Updated </div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class= 'error'> Failed to Updated Food</div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>