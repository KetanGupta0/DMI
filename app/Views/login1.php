<div class="container">
    <section class="content-area">
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
