<div class="container">
    <div class="headerarea">
        <img src="public/printHeader.jpg" alt="" width="100%">
    </div>
    <?php if (session()->getFlashdata('alertMessage')) : ?>
        <div class="container">
            <div class="alert alert-<?php echo session()->getFlashdata('alertType'); ?>" role="alert">
                <?php echo session()->getFlashdata('alertMessage'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="container mt-3" style="display:flex; justify-content:center;">
        <form class=" p-5 border shadow rounded" style="width: 70vw;" action="login-submit" method="POST" id="loginFormCCM" onsubmit="onLoginSubmit(event);">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                <div class="text-success">*Enter your dob in ddmmyyyy format. Ex: 01011999</div>
            </div>
            <div class="mb-3 form-check">
                New register, <a href="register" class="form-check-label">click here</a>
            </div>
            <div class="">
                <div class="g-recaptcha" data-sitekey="6LfgfNYoAAAAACKvCY0z3wIv9jZSDOc5Hgqa623G" data-action="LOGIN"></div>
                <input type="submit" class="btn btn-primary" value="Submit" style="margin-top: 10px;">
            </div>
        </form>
    </div>
</div>
<script>
    function onRecaptchaLoad() {
        // reCAPTCHA script loaded, enable the form submission
        document.getElementById("loginFormCCM").onsubmit = onLoginSubmit;
    }

    function onLoginSubmit(event) {
        event.preventDefault(); // Prevent the form from submitting automatically
        // Check if the reCAPTCHA widget is loaded
        if (typeof grecaptcha !== 'undefined') {
            // Check if the captcha response is empty
            var captchaResponse = grecaptcha.getResponse();
            if (document.getElementById("exampleInputEmail1").value == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Email is required!',
                });
            } else if (document.getElementById("exampleInputPassword1").value == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password is required!',
                });
            } else if (captchaResponse === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please complete the captcha!',
                });
            } else {
                // The user has completed the captcha, you can now submit the form
                document.getElementById("loginFormCCM").submit();
            }
        } else {
            console.error("reCAPTCHA script not loaded or initialized.");
        }
    }
</script>