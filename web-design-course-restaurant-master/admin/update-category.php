<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            //get the id and all other  detail
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id= $id";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the row to check whether the id is valid or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //redirect to manage category
                $_SESSION['no-category-found'] = "<div class = 'error'>Category not Found </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location: ' . SITEURL . 'admin/manage-category.php');
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
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
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
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
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
                    $destination_path = "../images/category/" . $image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not and if the image is not uploaded then we will stop the process and redirect with message
                    if ($upload == false) {
                        //set message
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload image <div>";
                        //redirect to add category page
                        header("location:" . SITEURL . 'admin/manage-category.php');
                        //stop the process
                        die();
                    }
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //update database
            $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";
            $res2 = mysqli_query($conn, $sql2);
            //redirect

            if ($res2 == true) {
                $_SESSION['update'] = "<div class= 'success'> Category Updated </div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class= 'error'> Failed to Updated Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>


<?php include('partials/footer.php') ?>