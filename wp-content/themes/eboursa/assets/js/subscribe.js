(function($) { $(function() { 
    $('.app-subscribe-form').on('submit', function(e) {
        e.preventDefault();

        var frm = $(this);
        var button = $(this).find('[type="submit"]');
        var email = frm.find('[name="email"]').val();

        if(email == undefined || !email.length) {
            frm.find('span.error').html('Subscription error, try again later').show();
        } else if(!validateEmail(email)) {
            frm.find('span.error').html('Wrong Email!').show();
        } else {
            frm.find('span.error').hide();

            button.prop('disabled', true);

            $.post('/wp-admin/admin-ajax.php?action=mailchimp_subscription', frm.serialize())
                .done(function(response) {
                    if(response.error || !response.result) {
                        console.error('Subscribe error:');
                        console.error(response.error ? response.errorMessage : response.message);

                        frm.find('span.error').html('Subscribe error').show();
                    } else {
                        frm.find('[name="email"]').val('');
                        frm.find('span.success').html('Successfully subscribed!').show();
                    }

                    button.prop('disabled', false);
                })
                .fail(function(xhr) {
                    console.error('Subscribe error:');
                    console.error(xhr.responseMessage);

                    frm.find('span.error').html('Something went wrong. Please, try again later.').show();

                    button.prop('disabled', false);
                });
        }
    });
}) })(jQuery);

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}