<script src="public/js/cdn.jsdelivr.net_npm_sweetalert2@11.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>
<script src="public/js/code.jquery.com_jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        $('#userRegistrationFormSubmit').click(function(e) {
            const mobile = $('#mobile').val();
            const name = $('#fname').val();
            const email = $('#email').val();
            const dob = $('#dob').val();
            if (email == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Email is required!',
                });
            } else if (name == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Name is required!',
                });
            } else if (dob == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Date of birth is required!',
                });
            } else if (mobile.length != 10) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid mobile number!',
                });
            }
        });
    });
</script>
</body>

</html>