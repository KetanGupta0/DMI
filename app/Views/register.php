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
        <form class="p-5 border shadow rounded" style="width: 70vw;" id="userRegistrationForm" action="register-submit" method="POST" onsubmit="onRegisterSubmit(event)">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="fname" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="fname">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob" max="2005-12-31">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="number" name="mobile" class="form-control" id="mobile">
            </div>

            <div class="mb-3 form-check">
                If already registered <a href="login" class="form-check-label">login</a>
            </div>
            <div class="" id="userRegistrationFormSubmit">
                <div class="g-recaptcha" data-sitekey="6LfgfNYoAAAAACKvCY0z3wIv9jZSDOc5Hgqa623G" data-action="LOGIN"></div>
                <input type="submit" class="btn btn-primary" value="Submit" style="margin-top: 10px;">
                <!-- <button type="submit" class="btn btn-primary" id="registrationSubmit">Submit</button> -->
            </div>
        </form>
    </div>
</div>
<script>
    function onRecaptchaLoad() {
        // reCAPTCHA script loaded, enable the form submission
        document.getElementById("userRegistrationForm").onsubmit = onRegisterSubmit;
    }

    function onRegisterSubmit(event) {
        event.preventDefault(); // Prevent the form from submitting automatically
        // Check if the reCAPTCHA widget is loaded
        if (typeof grecaptcha !== 'undefined') {
            // Check if the captcha response is empty
            var captchaResponse = grecaptcha.getResponse();
            var email = document.getElementById('email').value;
            var name = document.getElementById('fname').value;
            var dob = document.getElementById('dob').value;
            var mobile = document.getElementById('mobile').value;
            if (email == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Email is required!',
                });
            } else if (name == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Name is required!',
                });
            } else if (dob == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Date of birth is required!',
                });
            } else if (mobile.length != 10) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid mobile number!',
                });
            } else if (captchaResponse === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please complete the captcha!',
                });
            } else {
                // The user has completed the captcha, you can now submit the form
                document.getElementById("userRegistrationForm").submit();
            }
        } else {
            console.error("reCAPTCHA script not loaded or initialized.");
        }
    }
</script>