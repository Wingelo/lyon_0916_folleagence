//Scroll down button
$(document).ready(function() {
    $('#anchor').on('click', function() {
        var page = $(this).attr('href');
        var speed = 1400;
        $('html, body').animate( { scrollTop:
        $(page).offset().top }, speed );
        return false;
    });


//Scroll top button
    //Scroll top button appearing after px
   /* $(function(){
        $(window).scroll(function () {//Au scroll dans la fenetre on déclenche la fonction
            if ($(this).scrollTop() > 500) { //si on a défilé de plus de 600px du haut vers le bas
                $('#scroll-top-button').fadeIn(600);
            }else{
                $('.#scroll-top-button').fadeOut(600);
                //$('#scroll-top-button').animate({'opacity':'1'}); //on passe l'opacité de la div "scroll-top-button" à 1.
            //} else if ($(this).scrollTop() <= 500){
              //  $('#scroll-top-button').animate({'opacity':'0'});//sinon on retire la classe "appear" à <div id="scroll-top-button">
            }
        });
    });*/


    //Scroll top slow
    $('#scroll-top-arrow').on('click', function() {
        var page = $(this).attr('href');
        var speed = 1400;
        $('html, body').animate( { scrollTop:
        $(page).offset().top }, speed );
        return false;
    });


    //Carousel

    $(function(){
        $('.item:first-child').addClass('active');
    });

}); // END DOCUMENT READY