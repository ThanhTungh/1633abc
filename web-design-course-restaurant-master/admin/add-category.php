<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //display session message
            unset($_SESSION['add']); //removing session message
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //display session message
            unset($_SESSION['upload']); //removing session message
        }

        ?>
        <br><br>
        <!--Category form start here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Category form end here -->
        <?php
        //check whether the button is click or not
        if (isset($_POST['submit'])) {
            //get the value from category form
            $title = $_POST['title'];

            //for radio input we need  to check whether the button is seelect or not
            if (isset($_POST['featured'])) {
                //get the value from form
                $featured = $_POST['featured'];
            } else {
                //set the degfault value
                $featured = 'no';
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'no';
            }

            //check whether the image is selected or not and set value for image name accoridingly
            //print_r($_FILES['image']);

            //die();//break the code here
            if (isset($_FILES['image']['name'])) {
                //upload the image
                //to upload image we need image name , source path and destination path
                $image_name = $_FILES['image']['name'];
                //upload the image only if image selected
                if ($image_name != "") {

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not and if the image is not uploaded then we will stop the process and redirect with message
                    if ($upload == false) {
                        //set message
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload image <div>";
                        //redirect to add category page
                        header("location:" . SITEURL . 'admin/add-category.php');
                        //stop the process
                        die();
                    }
                }
            } else {
                //dont upload the image and set the image_name value as blank
                $image_name = "";
            }

            ///create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name = '$image_name',
                    featured='$featured',
                    active='$active'
                ";
            //execute the query and save in database
            $res = mysqli_query($conn, $sql);
            //check whether the data successfully inserted or not
            if ($res == true) {
                //query execute and category  add
                $_SESSION['add'] = "<div class='success'> Category add successfully </div>";
                //redirect to manage category page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                //redirect to manage category page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>