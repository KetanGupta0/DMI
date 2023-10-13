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
        <form class="p-5 border shadow rounded w-50" id="userRegistrationForm" action="register-submit" method="POST">
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
                Already have account? <a href="login" class="form-check-label">Click here</a>
            </div>
            <div class="" id="userRegistrationFormSubmit">
                <button type="submit" class="btn btn-primary" id="registrationSubmit">Submit</button>
            </div>
        </form>
    </div>
</div>