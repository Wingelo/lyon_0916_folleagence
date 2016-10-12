$(document).ready(function() {
    $('#contact_form').bootstrapValidator({

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Remplissez votre nom svp'
                    }
                }
            },
            last_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Remplissez votre prénom svp'
                    }
                }
            },
            mail: {
                validators: {
                    notEmpty: {
                        message: 'Remplissez votre adresse email svp'
                    },
                    emailAddress: {
                        message: 'Merci de renseignez une adresse email valide'
                    }
                }
            },
            tel: {
                validators: {
                    notEmpty: {
                        message: 'Remplissez votre numéro de téléphone svp'
                    },
                    phone: {
                        country: 'FR',
                        message: 'Merci de renseignez un numéro valide'
                    }
                }
            },

            comment: {
                validators: {
                    stringLength: {
                        min: 10,
                        max: 500,
                        message:'Entrez svp au moins 10 caractères et pas plus de 200'
                    },
                    notEmpty: {
                        message: 'Fournissez svp une description de votre projet'
                    }
                }
            }
        }
    })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
            $('#contact_form').data('bootstrapValidator').resetForm();


            e.preventDefault();


            var $form = $(e.target);


            var bv = $form.data('bootstrapValidator');


            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});