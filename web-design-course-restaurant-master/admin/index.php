<?php include('partials/menu.php') ?>
<!-- Main content Section Starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //display session message
            unset($_SESSION['login']); //removing session message
        }
        ?>
        <br><br>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Category
        </div>

        <div class="clearfix"></div>
    </div>

</div>
<!-- Footer section starts -->
<?php include('partials/footer.php') ?>