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
        <form class=" p-5 border shadow rounded w-50" action="login-submit" method="POST">
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
                Don't have account? <a href="register" class="form-check-label">Click here</a>
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>