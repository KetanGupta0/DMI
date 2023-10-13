<?php
if (session('logged_in')) {
    $userData = session()->get();
    $userName = $userData['name'];
    $userEmail = $userData['email'];
    $userMobile = $userData['mobile'];
    $userStatus = $userData['status'];
    $userDob = $userData['dob'];
}
?>
<?php if (session()->getFlashdata('alertMessage')) : ?>
    <script src="public/js/cdn.jsdelivr.net_npm_sweetalert2@11.js"></script>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?php echo session()->getFlashdata('alertMessage'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>

<?php endif; ?>
<div class="form-layout container" <?php if ($userStatus == 2) echo 'style="display: none;"'; ?>>
    <form action="application/submit" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="headerarea">
                <img src="public/printHeader.jpg" alt="" width="100%">
            </div>
            <div class="row form-row">
                <div class="col">
                    <input type="text" class="form-control" name="ename" id="ename" placeholder="Full Name in English" aria-label="Full Name in English" value="<?php if (session('logged_in')) echo $userName; ?>" disabled>
                    <div class="text-danger err err-ename"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="hname" id="hname" placeholder="Full Name in Hindi (Use google translate)" aria-label="Full Name in Hindi">
                    <div class="text-danger err err-hname"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <div style="display: flex;">
                        <label for="dob" style="flex: 3;">Date of Birth</label>&nbsp;<input class="form-control" style="flex: 7;" type="date" name="dob" id="dob" value="<?php if (session('logged_in')) echo $userDob; ?>" disabled>
                    </div>
                    <div class="text-danger err err-dob"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Father's Name" aria-label="Father's Name">
                    <div class="text-danger err err-father"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="mname" id="mname" placeholder="Mother's Name" aria-label="Mother's Name">
                    <div class="text-danger err err-mother"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email ID" aria-label="Email ID" name="email" id="email" value="<?php if (session('logged_in')) echo $userEmail; ?>" disabled>
                    <div class="text-danger err err-email"></div>
                </div>
                <div class="col">
                    <!-- <input type="text" class="form-control" placeholder="Gender" aria-label="Gender" name="gender" id="gender"> -->
                    <div class="text-danger err err-gender"></div>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Mobile" aria-label="Mobile" name="mobile" id="mobile" value="<?php if (session('logged_in')) echo $userMobile; ?>" disabled>
                    <div class="text-danger err err-mobile"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col"><strong>Educationl Qualifications</strong></div>
                <div class="col">
                    <label for="grad">Graduation Completed: </label>&nbsp;&nbsp;&nbsp;<label for="yes">Yes</label>&nbsp;&nbsp;<input type="radio" name="grad" class="gradCompletion" value="Yes">&nbsp;&nbsp;&nbsp;<label for="no">No</label>&nbsp;<input type="radio" name="grad" class="gradCompletion" value="No">&nbsp;&nbsp;&nbsp;<span class="text-danger err err-grad-completion"></span>
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name of the exam passed</th>
                            <th>Year of passing</th>
                            <th>Name of college</th>
                            <th>% Marks</th>
                        </tr>
                        <tr>
                            <th>Intermediate/10+2</th>
                            <td><input type="number" name="interPassingYear" id="interPassingYear">
                                <div class="text-danger err err-inter-passing"></div>
                            </td>
                            <td><input type="text" name="interCollege" id="interCollege">
                                <div class="text-danger err err-inter-college"></div>
                            </td>
                            <td><input type="number" name="interMarks" id="interMarks">
                                <div class="text-danger err err-inter-marks"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Graduation</th>
                            <td><input type="number" name="graduationPassingYear" id="graduationPassingYear" disabled>
                                <div class="text-danger err err-grad-passing"></div>
                            </td>
                            <td><input type="text" name="graduationCollege" id="graduationCollege" disabled>
                                <div class="text-danger err err-grad-college"></div>
                            </td>
                            <td><input type="number" name="graduationMarks" id="graduationMarks" disabled>
                                <div class="text-danger err err-grad-marks"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row form-row">
                <div class="col"><strong>Correspondence Address</strong></div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <input type="text" class="form-control" name="village" id="village" placeholder="Village/Ward" aria-label="Village/Ward">
                    <div class="text-danger err err-village"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="post" id="post" placeholder="Post Office" aria-label="Post Office">
                    <div class="text-danger err err-post"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="block" id="block" placeholder="Block Anchal" aria-label="Block Anchal">
                    <div class="text-danger err err-block"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <!-- <input type="text" class="form-control" name="state" id="state" placeholder="State" aria-label="State"> -->
                    <select class="form-control" name="state" id="state">
                        <option value="">Select State</option>
                        <option value="Bihar">Bihar</option>
                    </select>
                </div>
                <div class="col">
                    <!-- <input type="text" class="form-control" name="district" id="district" placeholder="District" aria-label="District"> -->
                    <select class="form-control" name="district" id="district">
                        <option value="">Select District</option>
                    </select>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="pin" id="pin" placeholder="Pin No." aria-label="Pin No.">
                    <div class="text-danger err err-pin"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <label for="photo">Passport Size Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    <div class="text-danger err err-photo"></div>
                </div>
                <div class="col">
                    <label for="signature">Signature</label>
                    <input type="file" class="form-control" id="signature" name="signature">
                    <div class="text-danger err err-signature"></div>
                </div>
            </div>
            <div class="row form-row">
                <div class="col"><input type="checkbox" name="declaration" id="declaration">&nbsp;&nbsp;<i>I hereby declare that the information given by me in the application is ture, complete and correct to the best of my knowledge and belief and that nothing has been concealed or distorted.</i></div>
                <div class="text-danger err-declaration"></div>
            </div>
        </div>
        <div class="btn btn-primary submit-btn" style="width: fit-content;">Proceed</div>
    </form>
</div>
<div class="printable-area container" <?php if ($userStatus == 1) echo 'style="display: none;"'; ?>>
    <div class="printing-Block" style="width: 290mm; height: auto;">
        <div class="headerarea">
            <img src="public/printHeader.jpg" alt="" width="100%">
            <img src="public/img/logo2.jpg" alt="" height="120px" class="qr">
        </div>
        <div class="maindata">
            <div class="top-heading">
                <span class="appID">Application No. - <span class="aid"></span></span>
                <span class="banner">Application Form</span>
                <span class="helper">(To be filled by the applicant)</span>
            </div>
            <div class="date">
                Date: <span class="today">01-10-2023</span>
            </div>
            <div class="mid-data" style="position: relative;">
                <div class="image-block" style="border: 3px solid black; position: absolute; top: 3%; right: 7%"></div>
                <div class="wrapper">
                    <div class="column">1. Full Name (in English): <span class="stuNameEng">Ketan Gupta</span></div>
                    <div class="column">2. Full Name (in Hindi): <span class="stuNameHin">Ketan Gupta</span></div>
                    <div class="column">3. Date of Birth:
                        <span class="studob">
                            <div class="box d1"></div>
                            <div class="box d2"></div>
                            <div class="box m1"></div>
                            <div class="box m2"></div>
                            <div class="box y1"></div>
                            <div class="box y2"></div>
                            <div class="box y3"></div>
                            <div class="box y4"></div>
                        </span>
                    </div>
                    <div class="column">4. Father's Name: <span class="stuFatherName">Demo</span></div>
                    <div class="column">5. Mother's Name: <span class="stuMotherName">Demo</span></div>
                    <div class="column">6. Email Address: <span class="stuEmail">Demo</span></div>
                </div>
                <div class="column dual">
                    <div class="grp1">7. Gender (Male/Female/Others): <span class="stuGender box">Demo</span></div>
                    <div class="grp2">8. Mobile No:
                        <span class="stuMobile">
                            <div class="box n1"></div>
                            <div class="box n2"></div>
                            <div class="box n3"></div>
                            <div class="box n4"></div>
                            <div class="box n5"></div>
                            <div class="box n6"></div>
                            <div class="box n7"></div>
                            <div class="box n8"></div>
                            <div class="box n9"></div>
                            <div class="box n10"></div>
                        </span>
                    </div>
                </div>
                <div class="column dual">
                    <div class="edu">9. Educational Qualification</div>
                    <div class="ugStatus">Graduation Completed (✓) <span style="margin: 0 20px;"></span>Yes <div class="box ugsy"></div> No <div class="box ugsn"></div>
                    </div>
                </div>
                <div class="column" style="display: flex; justify-content: center;">
                    <table class="table table-bordered border border-dark border-2 text-center" style="width: 90%;">
                        <tr>
                            <th>Name of the Exam Passed</th>
                            <th>Year of Passing</th>
                            <th>Name of College</th>
                            <th>%Marks</th>
                        </tr>
                        <tr>
                            <th>Intermediate / 10+2</th>
                            <td class="ipy"></td>
                            <td class="icn"></td>
                            <td class="ipm"></td>
                        </tr>
                        <tr>
                            <th>Graduation</th>
                            <td class="upy"></td>
                            <td class="ucn"></td>
                            <td class="upm"></td>
                        </tr>
                    </table>
                </div>
                <div class="column trio">
                    <div class="add">10. Correspondence Address: </div>
                    <div class="add-grp1">
                        <div class="vill">
                            <div class="text-cont">Village/Ward</div> <span class="stuVill">Demo</span>
                        </div>
                        <div class="post">
                            <div class="text-cont">Post Office</div> <span class="stuPost">Demo</span>
                        </div>
                    </div>
                    <div class="add-grp2">
                        <div class="block">
                            <div class="text-cont">Block/Anchal</div> <span class="stuBlock">Demo</span>
                        </div>
                        <div class="dist">
                            <div class="text-cont">District</div> <span class="stuDist">Demo</span>
                        </div>
                    </div>
                    <div class="add-grp3">
                        <div class="state">
                            <div class="text-cont">State</div> <span class="stuState">Demo</span>
                        </div>
                        <div class="pin">
                            <div class="text-cont">PIN No.</div>
                            <span class="stuPin">
                                <div class="box p1"></div>
                                <div class="box p2"></div>
                                <div class="box p3"></div>
                                <div class="box p4"></div>
                                <div class="box p5"></div>
                                <div class="box p6"></div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="payRef">
                        <div class="text-cont">11. Payment Reference No.:</div> <span class="prn"></span>
                    </div>
                    <div class="payDate">
                        <div class="text-cont">Payment Date:</div><span class="pd"></span>
                    </div>
                </div>
                <div class="column">
                    <div class="fw-bold">12. Paid Amount:</div>
                </div>
                <div class="column declaration">
                    I hereby declare that the information given by me in the Application is true, complete and correct to the best of my knowledge and belief and that nothing has been concealed or distorted.
                </div>
                <div class="column sig">
                    <div class="signature"></div>
                    <div class="sig-helper">Applicant Signature</div>
                </div>
            </div>
        </div>
        <div class="footerarea">
            <img src="public/printFooter.jpg" alt="" width="100%">
        </div>
    </div>
    <div class="print-container" <?php if ($userStatus == 1) echo 'style="display: none;"'; ?>>
        <span class="btn Application-print-btn">Print</span>
    </div>
</div>
<script src="public/js/code.jquery.com_jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        $.post("fetch-states", function(res) {
            $('#state').html(`<option value="">Select State</option>`);
            $.each(res, function(key, value) {
                $('#state').append(`<option data-id="${value.id}" value="${value.name}">${value.name}</option>`)
            });
        }).fail(function(err) {
            console.log(err);
        });

        function isValidFile(file) {
            var allowedFormats = ['image/jpeg', 'image/png', 'image/gif'];
            if (allowedFormats.indexOf(file.type) === -1) {
                return false;
            }
            var maxSizeInBytes = 1 * 1024 * 1024;
            if (file.size > maxSizeInBytes) {
                return false;
            }
            return true;
        }
        $("#pin").on("input", function() {
            var data = $(this).val();
            if (data.length >= 6) {
                $(this).val(data.slice(0, 6));
            }
        });
        $(document).on('change', '.gradCompletion', function() {
            if ($(this).val() == 'No') {
                $('#graduationPassingYear').prop('disabled', true);
                $('#graduationPassingYear').val('');
                $('#graduationCollege').prop('disabled', true);
                $('#graduationCollege').val('');
                $('#graduationMarks').prop('disabled', true);
                $('#graduationMarks').val('');
            } else {
                $('#graduationPassingYear').prop('disabled', false);
                $('#graduationCollege').prop('disabled', false);
                $('#graduationMarks').prop('disabled', false);
                $('#graduationPassingYear').val('');
                $('#graduationCollege').val('');
                $('#graduationMarks').val('');
            }
        });

        function printing() {
            $.ajax({
                url: "fetch-record",
                type: "post",
                data: {},
                success: function(response) {
                    $('.form-layout').remove();

                    function formatNumberWithZeros(number, length) {
                        var formattedNumber = number.toString();
                        while (formattedNumber.length < length) {
                            formattedNumber = '0' + formattedNumber;
                        }
                        return formattedNumber;
                    }
                    var myNumber = response.application_id;
                    var formattedNumber = formatNumberWithZeros(myNumber, 3);
                    $('.aid').html('CCM/2023/' + formattedNumber);
                    var dateObject = new Date(response.application_date);
                    var day = dateObject.getDate();
                    var month = dateObject.getMonth() + 1;
                    var year = dateObject.getFullYear();
                    var formattedDate = (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + year;
                    $('.today').html(formattedDate);
                    $('.stuNameEng').html(response.applicant_name_english);
                    $('.stuNameHin').html(response.applicant_name_hindi);
                    var dateString = response.applicant_dob;
                    var dob = new Date(dateString);
                    var day1 = Math.floor(dob.getDate() / 10);
                    var day2 = dob.getDate() % 10;
                    var month1 = Math.floor((dob.getMonth() + 1) / 10);
                    var month2 = (dob.getMonth() + 1) % 10;
                    var year = dob.getFullYear().toString().split('');
                    $('.d1').html(day1);
                    $('.d2').html(day2);
                    $('.m1').html(month1);
                    $('.m2').html(month2);
                    $('.y1').html(year[0]);
                    $('.y2').html(year[1]);
                    $('.y3').html(year[2]);
                    $('.y4').html(year[3]);
                    $('.stuFatherName').html(response.applicant_father);
                    $('.stuMotherName').html(response.applicant_mother);
                    $('.stuEmail').html(response.applicant_email);
                    $('.stuGender').html(response.applicant_gender);
                    $('.n1').html(response.applicant_mobile[0]);
                    $('.n2').html(response.applicant_mobile[1]);
                    $('.n3').html(response.applicant_mobile[2]);
                    $('.n4').html(response.applicant_mobile[3]);
                    $('.n5').html(response.applicant_mobile[4]);
                    $('.n6').html(response.applicant_mobile[5]);
                    $('.n7').html(response.applicant_mobile[6]);
                    $('.n8').html(response.applicant_mobile[7]);
                    $('.n9').html(response.applicant_mobile[8]);
                    $('.n10').html(response.applicant_mobile[9]);
                    if (response.applicant_ug_status == "No") {
                        $('.ugsn').html('✓');
                    } else {
                        $('.ugsy').html('✓');
                        $('.upy').html(response.ug_passing_year);
                        $('.ucn').html(response.ug_college_name);
                        $('.upm').html(response.ug_marks);
                    }
                    $('.ipy').html(response.inter_passing_year);
                    $('.icn').html(response.inter_college_name);
                    $('.ipm').html(response.inter_marks);
                    $('.stuVill').html(response.applicant_village);
                    $('.stuPost').html(response.applicant_post);
                    $('.stuBlock').html(response.applicant_block);
                    $('.stuDist').html(response.applicant_district);
                    $('.stuState').html(response.applicant_state);
                    $('.p1').html(response.applicant_pin[0]);
                    $('.p2').html(response.applicant_pin[1]);
                    $('.p3').html(response.applicant_pin[2]);
                    $('.p4').html(response.applicant_pin[3]);
                    $('.p5').html(response.applicant_pin[4]);
                    $('.p6').html(response.applicant_pin[5]);
                    $('.image-block').html(`<img src="public/img/uploads/${response.applicant_photo}" alt="" height="250" width="230">`);
                    $('.signature').html(`<img src="public/img/uploads/${response.applicant_signature}" alt="" height="50" width="250">`);
                    $('.printable-area').show();
                    $('.print-container').show();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        $('.Application-print-btn').click(function() {
            $('.print-container').hide();
            $('.form-layout').hide();
            $('.nav').hide();
            window.print();
            $('.nav').show();
            $('.print-container').show();
        });

        function formSetup() {
            $.ajax({
                url: "fetch-record",
                type: "post",
                data: {},
                success: function(res) {
                    // console.log(res);
                    if (res.status_flag == 2) {
                        printing();
                    } else {
                        $('.form-layout').show();
                        $('.print-container').hide();
                        $('.printable-area').hide();
                    }
                }
            });
        }
        var session = <?php echo json_encode(session('logged_in')); ?>;
        if (session) {
            formSetup();
        }
        $('#state').on('change', function() {
            let state = $(this).val();
            if (state != '') {
                let id = $(this).find('option:selected').data('id');
                $('#district').html(`<option value="">Select District</option>`);
                $.post("fetch-cities", {
                    id: id
                }, function(res) {
                    $.each(res,function(key, value){
                        $('#district').append(`<option value="${value.name}">${value.name}</option>`);
                    });
                }).fail(function(err) {
                    console.log(err);
                });
            }
        });
        $(".submit-btn").click(function(e) {
            $(".text-danger").text("");
            var hname = $("#hname").val().trim();
            if (hname === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter your full name in Hindi!',
                })
                return;
            }
            var hname = $("#fname").val().trim();
            if (hname === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter your father name!',
                })
                return;
            }
            var hname = $("#mname").val().trim();
            if (hname === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter your mother name!',
                })
                return;
            }
            var gender = $("#gender").val();
            if (gender === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please choose your gender!',
                })
                return;
            }
            var gradCompletion = $("input[name='grad']:checked").val();
            if (typeof gradCompletion === "undefined") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please specify if you have completed graduation!',
                })
                return;
            }
            var interPassingYear = $("#interPassingYear").val().trim();
            var interCollege = $("#interCollege").val().trim();
            var interMarks = $("#interMarks").val().trim();
            if (!interPassingYear || !interCollege || !interMarks) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill in all details for Intermediate/10+2!',
                })
                return;
            }
            if (gradCompletion === "Yes") {
                var gradPassingYear = $("#graduationPassingYear").val().trim();
                var gradCollege = $("#graduationCollege").val().trim();
                var gradMarks = $("#graduationMarks").val().trim();
                if (!gradPassingYear || !gradCollege || !gradMarks) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please fill in all details for graduation!',
                    })
                    return;
                }
            }
            var village = $("#village").val().trim();
            var post = $("#post").val().trim();
            var block = $("#block").val().trim();
            var district = $("#district").val();
            var state = $("#state").val();
            var pin = $("#pin").val().trim();
            if (!village || !post || !block || !district || !state || !pin) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill in all details for correspondence address!',
                })
                return;
            }
            var photoInput = $("#photo")[0];
            if (photoInput.files.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please upload a passport size photo!',
                });
                return;
            }
            var photoFile = photoInput.files[0];
            if (!isValidFile(photoFile)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid file format or size for passport size photo. Please upload a valid file!',
                });
                return;
            }
            var signatureInput = $("#signature")[0];
            if (signatureInput.files.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please upload a signature!',
                });
                return;
            }
            var signatureFile = signatureInput.files[0];
            if (!isValidFile(signatureFile)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid file format or size for the signature. Please upload a valid file!',
                });
                return;
            }
            var declaration = $("#declaration").prop("checked");
            if (!declaration) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please accept the declaration!',
                })
                return;
            }
            var formData = new FormData();
            formData.append('hname', $('#hname').val());
            formData.append('fname', $('#fname').val());
            formData.append('mname', $('#mname').val());
            formData.append('gender', $('#gender').val());
            formData.append('grad', gradCompletion);
            formData.append('interPassingYear', $('#interPassingYear').val());
            formData.append('interCollege', $('#interCollege').val());
            formData.append('interMarks', $('#interMarks').val());
            formData.append('graduationPassingYear', $('#graduationPassingYear').val());
            formData.append('graduationCollege', $('#graduationCollege').val());
            formData.append('graduationMarks', $('#graduationMarks').val());
            formData.append('village', $('#village').val());
            formData.append('post', $('#post').val());
            formData.append('block', $('#block').val());
            formData.append('district', $('#district').val());
            formData.append('state', $('#state').val());
            formData.append('pin', $('#pin').val());
            formData.append('photo', $('#photo')[0].files[0]);
            formData.append('signature', $('#signature')[0].files[0]);
            $.ajax({
                url: "application/submit",
                type: "post",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.msg == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Form submitted successfully',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        printing();
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.responseText,
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>