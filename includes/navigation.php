<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../">Homepage</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="contacts.php">Contact Us</a></li>
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query); 
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'admin'){
                        echo "<li><a href='admin'>CMS Admin</a></li>";
                    }
                }
                if(!isset($_SESSION['username'])){
                    echo "<li><a href='registration.php'>Register</a></li>";
                }
                if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 'admin')){
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }
                ?> 
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>