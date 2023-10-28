<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMI</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/landing.css">
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>
</head>

<body>
    <div class="nav" style="z-index: 100;">
        <a href="https://www.dmi.ac.in" class="btn">Home</a>
        <a href="index1" class="btn hindi">Hindi</a>
        <a href="index2" class="btn english">English</a>
        <?php if (session('logged_in')) : ?>
            <!-- User is logged in, show logout button -->
            <a href="form" class="btn english">Apply/Print</a>
            <!-- <span class="btn apply">Apply</span> -->
            <a href="logout" class="btn logout">Logout</a>
        <?php else : ?>
            <!-- User is not logged in, show apply button -->
            <a href="login" class="btn">Login/Register</a>
        <?php endif; ?>
    </div>