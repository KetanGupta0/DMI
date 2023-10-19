<div class="container">
    <!-- <div class="headerarea">
        <img src="public/printHeader.jpg" alt="" width="100%">
    </div> -->
    <!-- <div class="thim-login container">
        <h2 class="title">Login with your site account</h2>
        <form name="loginpopupform" action="https://coaching.thimpress.com/demo-therapist/wp-login.php" method="post">
            <p class="login-username">
                <input type="text" name="log" class="input required" value="" size="20" placeholder="Username">
            </p>
            <p class="login-password">
                <input type="password" name="pwd" class="input required" value="" size="20" placeholder="Password">
            </p>
            <input type="hidden" id="thimpress-nonce" name="thimpress-nonce" value="60da78d82b"><input type="hidden" name="_wp_http_referer" value="/demo-therapist/testimonials/i-can-be-unstoppable/">
            <p class="login-remember">
                <label><input name="rememberme" type="checkbox" value="forever">Remember me </label>
            </p>
            <a class="lost-pass-link" href="#" title="Lost Password">Lost your password?</a>
            <p class="login-submit">
                <input type="submit" name="wp-submit" class="button button-primary" value="Login">
                <input type="hidden" name="redirect_to" value="index.html">
                <input type="hidden" name="is_theme_thimpress" value="1">
            </p>
        </form>
    </div> -->
    <section class="content-area">
        <!-- <div class="container mt-3" style="display:flex; justify-content:center; position:relative; padding-top: 140px;">
            <form class=" p-5 border shadow rounded" style="width: 70vw;" action="login-submit" method="POST">
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
        </div> -->
        <div class="thim-login" style="padding-top: 140px;">
            <?php if (session()->getFlashdata('alertMessage')) : ?>
                <div class="container">
                    <div class="alert alert-<?php echo session()->getFlashdata('alertType'); ?>" role="alert">
                        <?php echo session()->getFlashdata('alertMessage'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <h2 class="title">Login Form</h2>
            <form name="loginpopupform" action="login-submit" method="post">
                <p class="login-username">
                    <input type="email" name="email" class="input required" value="" size="20" placeholder="Email ID">
                </p>
                <p class="login-password">
                    <input type="password" name="password" class="input required" value="" size="20" placeholder="Password">
                    <marquee behavior="alternate" direction="">
                        <div class="text-success"><i>Enter your dob in ddmmyyyy format. Ex: 01011999</i></div>
                    </marquee>
                </p>
                <p>
                    Create new account <a class="lost-pass-link" href="#" title="Lost Password">here</a>
                </p>
                <p class="login-submit">
                    <input type="submit" name="wp-submit" class="button button-primary" value="Login">
                    <input type="hidden" name="redirect_to" value="index.html">
                    <input type="hidden" name="is_theme_thimpress" value="1">
                </p>
            </form>
        </div>
    </section>
</div>