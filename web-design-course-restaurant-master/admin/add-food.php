<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //display session message
            unset($_SESSION['upload']); //removing session message
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="title of Food"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >
                        <?php
                                //create php code to display category  from database
                                //1. create sql to get active category from database
                                $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";
                                //executing query
                                $res = mysqli_query($conn, $sql);
                                //Couunt rows to check whether we have category or not
                                $count = mysqli_num_rows($res);
                                //if count > 0 we have category if not
                                if($count >0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //get the value
                                        $id= $row['id'];
                                        $title= $row['title'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
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
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>

            </table>
        </form>

        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //add food to database
                //1.get the data from form
                $title= $_POST['title'];
                $description= $_POST['description'];
                $price= $_POST['price'];
                $category= $_POST['category'];
                
                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = 'no';
                }
                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = 'no';
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    //check whether  the imaege is select or not and upload image only if selected
                    if($image_name !="")
                    {
                        //source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        //destination path for the image to be upload
                        $dst = "../images/food/" . $image_name;

                        //upload the image
                        $upload = move_uploaded_file($src, $dst);
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
                }
                else
                {
                    $image_name = "";
                }
                //2.insert into database selected
                // for nummerical value we not need to pass value inside quotes '' but for string value it is compulsory to add quote ''
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title', 
                    description = '$description', 
                    price = '$price', 
                    category_id = '$category', 
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";
                
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether data inserted or not
                if($res2 ==true)
                {
                    $_SESSION['add'] = "<div class = 'success'> food added successfully</div>";
                    header("location:" . SITEURL . 'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class = 'error'> Failed to add food</div>";
                    header("location:" . SITEURL . 'admin/manage-food.php');
                }

                //redirect with message to manage food
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>