<?php
include('membership_security.php');

include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

<style>
    label {
        color: black;
    }
</style>

<center>
    <div class="col-xl-6 col-md-6 mb-6">
        <div class="card border shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <legend style="color: black;">Form for membership</legend>
                        </div>
                        <hr>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Terms and condition</h5>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Agree</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="membership_access.php" class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" name="firstname" class="form-control" id="validationCustom01" required>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" name="lastname" class="form-control" id="validationCustom02" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustomUsername" class="form-label">Address</label>
                            <div class="input-group has-validation">
                                <input type="text" name="address" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="validationCustom03" class="form-label">Contact number</label>
                            <input type="number" name="contact" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" id="validationCustom03" required>
                        </div>
                        <div class="col-md-7">
                            <label for="validationCustom03" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="validationCustom03" required>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Membership join</label>
                            <input type="date" name="membership_start" class="form-control" id="validationCustom03" required>
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="proof" class="form-control" aria-label="file example" required>
                            <div class="invalid-feedback">Choose profile picture</div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Membership type</label>
                            <div class="col-md-9 col-xs-9">
                                <input type="radio" class="form-check-input" id="validationFormCheck2" name="type" value="Annual" required>
                                <label class="form-check-label" for="validationFormCheck2">Annual</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" id="validationFormCheck3" name="type" value="Senior/Student" required>
                                <label class="form-check-label" for="validationFormCheck3" value="Senior/Student">Senior/Student</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom03" class="form-label">Note/Comment</label>
                            <textarea type="text" name="note" class="form-control" id="validationCustom03" cols="2" rows="2" required></textarea>
                        </div>
                        &nbsp;
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" data-bs-toggle="modal" data-bs-target="#staticBackdrop" required>
                                <label class="form-check-label" for="invalidCheck3">
                                    Agree to terms and conditions
                                </label>
                            </div>
                        </div>
                        &nbsp;
                        <div class="col-12">
                            <button type="submit" name="register" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    &nbsp;
</center>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<script>
    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("myCheck");
        // Get the output text
        var text = document.getElementById("text");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>

<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>