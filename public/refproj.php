<!DOCTYPE HTML>
    <html>
        <head>
            <meta charset="utf-8" name="viewport">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="css/style.css">
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

        <section class="container-fluid">
            <div class="container">
                <div class="image_contact">
                    <img src="">
                </div>
                <div class="row">
                    <h1></h1>
                </div>
            </div>
        </section>

        <section class="bandeau container-fluid"></section>

        <section class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="">
                        <h3></h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <p></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bandeau container-fluid"></section>

        <section class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="">
                        <h3></h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <div class="projet1"></div>
                    </div>
                    <div class="">
                        <div class="projet2"></div>
                    </div>
                    <div class="">
                        <div class="projet3"></div>
                    </div>
                </div>
            </div>
        </section>


        <?php
        include('../src/footer.php');
        ?>