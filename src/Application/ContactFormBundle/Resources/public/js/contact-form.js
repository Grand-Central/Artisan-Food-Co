$(function() {
    $('body').on('submit', '#application_contact_form', function(e){

        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $contactForm = $('#application_contact_form');

        // prevent double submission
        if ($contactForm.data('submitted') === true) {
            //previously submitted - don't submit again
            return $contactForm;
        } else {
            //mark it so that the next submit can be ignored
            $contactForm.data('submitted', true);
        }

        //remove previous alert messages (so users definitely knows it was submitted)
        $contactForm.find('.help-block').remove();

        //container to load ajax response
        var container = $contactForm.closest('#application_contact_form_container');

        //button to append the loading spinner to
        var $btn = $contactForm.find('.btn-form-ajax');
        if($btn.length < 1){
            $btn = $contactForm.find('.btn-primary');
        }

        //post
        $.ajax({
            type: 'POST',
            url: $contactForm.attr('action'),
            data: $contactForm.serialize(),
            cache: false,
            beforeSend: function(){
                $btn.val('Sending...').attr('disabled', 'disabled');
            },
            success: function(data){
                container.replaceWith(data);
            },
            error: function(xhr, status, error){
                $btn.val('Submit').removeAttr('disabled');
                container.replaceWith(xhr.responseText);
            }
        });
    });
});
