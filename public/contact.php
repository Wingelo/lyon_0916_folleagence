<!DOCTYPE HTML>
    <html>
        <head>
            <meta charset="utf-8" name="viewport">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
            <link rel="stylesheet" href="css/style.css">
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
                            <h3>Contact</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <p></p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="bootstrap-iso">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <form method="post">
                                <div class="form-group ">
                                    <label class="control-label requiredField" for="name">
                                        Nom:
                                        <span class="asteriskField">
            *
           </span>
                                    </label>
                                    <input class="form-control" id="name" name="name" type="text"/>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label requiredField" for="name1">
                                        Prénom:
                                        <span class="asteriskField">
            *
           </span>
                                    </label>
                                    <input class="form-control" id="name1" name="name1" type="text"/>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label requiredField" for="email">
                                        Email
                                        <span class="asteriskField">
            *
           </span>
                                    </label>
                                    <input class="form-control" id="email" name="email" type="text"/>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="subject">
                                        Sujet:
                                    </label>
                                    <input class="form-control" id="subject" name="subject" type="text"/>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="message">
                                        Message:
                                    </label>
                                    <textarea class="form-control" cols="40" id="message" name="message" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary " name="submit" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        <?php
        include('../src/footer.php');
        ?>