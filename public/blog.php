<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Bad+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <title>La Folle Agence</title>
</head>


        <body>

        <!-- Entête du site -->
        <header>
            <!-- Menu de navigation -->
            <?php
            include('../src/navbar.php');
            ?>
        </header>
            <div class="container-fluid">
                <div class="container" >
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

                            <h2>
                                <a href="#">Blog Post Title</a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php">Start Bootstrap</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                            <hr>
                            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                            <hr>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>

                            <!-- Second Blog Post -->
                            <h2>
                                <a href="#">Blog Post Title</a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php">Start Bootstrap</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                            <hr>
                            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                            <hr>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>

                            <!-- Third Blog Post -->
                            <h2>
                                <a href="#">Blog Post Title</a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php">Start Bootstrap</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                            <hr>
                            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                            <hr>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>

                            <!-- Pager -->
                            <ul class="pager">
                                <li class="previous">
                                    <a href="#">&larr; Older</a>
                                </li>
                                <li class="next">
                                    <a href="#">Newer &rarr;</a>
                                </li>
                            </ul>

                        </div>

                        <!-- Blog Sidebar Widgets Column -->
                        <div class="col-md-4">

                            <!-- Blog Search Well -->
                            <div class="well">
                                <h4>Blog Search</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                        </span>
                                </div>
                                <!-- /.input-group -->
                            </div>

                            <!-- Blog Categories Well -->
                            <div class="well">
                                <h4>Blog Categories</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <ul class="list-unstyled">
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                            <li><a href="#">Category Name</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                                <!-- /.row -->
                            </div>

                            <!-- Side Widget Well -->
                            <div class="well">
                                <h4>Side Widget Well</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                            </div>

                    </div>
                </div>
            </div>
                <!-- /.row -->


        <?php
        include('../src/footer.php');
        ?>