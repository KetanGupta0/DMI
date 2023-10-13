$(document).ready(function() {
    $('form').submit(function(e) {
        var errors = false;

        // Define an array of field IDs and corresponding error message elements
        var fields = [
            {id: 'ename',error: '.err-ename'},
            {id: 'hname',error: '.err-hname'},
            {id: 'dob',error: '.err-dob'},
            {id: 'fname',error: '.err-father'},
            {id: 'mname',error: '.err-mother'},
            {id: 'email',error: '.err-email'},
            {id: 'gender',error: '.err-gender'},
            {id: 'mobile',error: '.err-mobile'},
            {id: 'interCollege',error: '.err-inter-college'},
            {id: 'interMarks',error: '.err-inter-marks'},
            {id: 'interPassingYear',error: '.err-inter-passing'},
            {id: 'graduationCollege',error: '.err-grad-college'},
            {id: 'graduationMarks',error: '.err-grad-marks'},
            {id: 'graduationPassingYear',error: '.err-grad-passing'},
            {id: 'village',error: '.err-village'},
            {id: 'post',error: '.err-post'},
            {id: 'block',error: '.err-block'},
            {id: 'district', error: '.err-district'},
            {id: 'state',error: '.err-state'},
            {id: 'pin',error: '.err-pin'},
            {id: 'paymentDate',error: '.err-p-date'},
            {id: 'paymentRef',error: '.err-p-ref'}
        ];
        for (var i = 0; i < fields.length; i++) {
            var field = fields[i];
            var fieldValue = $('#' + field.id).val();

            if (fieldValue === '') {
                errors = true;
                $(field.error).html('This field is required!');
            } else {
                $(field.error).html('');
            }
        }
        var graduationCompleted = $('input[name="grad"]:checked').length > 0;
        if (!graduationCompleted) {
            $('.err-grad-completion').html('Please select either Yes or No');
            errors = true;
        } else {
            $('.err-grad-completion').html('');
        }
        var declarationChecked = $('#declaration').is(':checked');
        if (!declarationChecked) {
            $('.err-declaration').html('You must agree to the declaration');
            errors = true;
        } else {
            $('.err-declaration').html('');
        }
        var photoInput = $('#photo');
        var photoError = $('.err-photo');
        var photoFile = photoInput[0].files[0];
        if (photoFile) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Add more extensions if needed
            if (!allowedExtensions.exec(photoFile.name)) {
                errors = true;
                photoError.html('Invalid photo file format. Allowed formats: JPG, JPEG, PNG');
            } else if (photoFile.size > 1048576) { // 1MB
                errors = true;
                photoError.html('Photo file size must be less than 1MB');
            } else {
                photoError.html('');
            }
        } else {
            errors = true;
            photoError.html('Please select a photo file');
        }
        var signatureInput = $('#signature');
        var signatureError = $('.err-signature');
        var signatureFile = signatureInput[0].files[0];
        if (signatureFile) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Add more extensions if needed
            if (!allowedExtensions.exec(signatureFile.name)) {
                errors = true;
                signatureError.html('Invalid signature file format. Allowed formats: JPG, JPEG, PNG');
            } else if (signatureFile.size > 1048576) { // 1MB
                errors = true;
                signatureError.html('Signature file size must be less than 1MB');
            } else {
                signatureError.html('');
            }
        } else {
            errors = true;
            signatureError.html('Please select a signature file');
        }
        if (errors) {
            e.preventDefault();
        }
    });
     // Get the last segment of the current URL
     const currentURL = window.location.pathname;
     const segments = currentURL.split('/');

     if (segments.length > 1) {
         const lastSegment = segments[segments.length - 1];

         // Add the 'active' class to the corresponding navigation link
        //  if(lastSegment == 'index'){
        //     $('.first-link').addClass('active-link');
        //  } else {
        //     $('nav a[href*="' + lastSegment + '"]').addClass('active-link');
        //  }
         switch(lastSegment){
            case 'index': $('.first-link').addClass('active-link'); break;
            case 'enhancing': $('.second-link').addClass('active-link'); break;
         }
     }
});