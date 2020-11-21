<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Profile - SB Admin</title>
        <?php $this->load->view('include/header'); ?>
    </head>
    <body class="sb-nav-fixed">
        <?php $this->load->view('include/top_menu'); ?>
        <div id="layoutSidenav">
            <?php $this->load->view('include/menu'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Profile</h1>


                        <div class="container-fluid">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-4 col-xlg-3 col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <center class="m-t-30"> <img src="<?php echo base_url(); ?>assets/img/a.jpg" class="" width="150" /> <br>


                                            </center>
                                        </div>
                                        <div>
                                            <hr> </div>
                                        <div class="card-body"> <small class="text-muted">Name </small>
                                            <h4 class="card-title m-t-10 user_name">Adil</h4><small class="text-muted p-t-30 db">Phone</small>
                                            <h6 class="user_mob">+91 654 784 547</h6> <small class="text-muted p-t-30 db">Email</small>
                                            <h6 class="user_email">71 Pilgrim Avenue Chevy Chase, MD 20815</h6>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xlg-9 col-md-7">
                                    <div class="card">
                                        <!--<button class="btn btn-primary">Update Profile</button>-->
                                        <div class="card-header">
                                            <i class="fas fa-user"></i>
                                            Update Profile <span class="pull-right float-right"><button class="btn btn-primary btn-sm pull-right">Change Password</button></span>
                                        </div>
                                        <div class="card-body">

                                            <form class="form-horizontal form-material">
                                                <div class="form-group">
                                                    <label for="firstName" class="col-md-12">First Name</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="First Name" class="form-control form-control-line" name="firstName" id="firstName">
                                                        <span class="errorMsg" id="firstNameError"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Last Name</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="lastName" id="lastName" value="" class="form-control form-control-line" placeholder="Last Name">
                                                        <span class="errorMsg" id="lastName"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Email</label>
                                                    <div class="col-md-12">
                                                        <input type="email" placeholder="123 456 7890" id="userEmail" name="userEmail" class="form-control form-control-line">
                                                        <span id="userEmailError" class="errorMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Mobile No.</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Mobile No." id="mobileNo" name="mobileNo" class="form-control form-control-line">
                                                        <span id="mobileNoError" class="errorMsg"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-primary" type="button" onclick="updateProfile();">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php $this->load->view('include/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('include/footer_link'); ?>
    </body>
    <script>
        $baseUrl = $(".baseURL").val();
        $(document).ready(function () {
            getUser();
        });
        function getUser() {
            var obj = new Object()
            $.ajax({
                url: $baseUrl + "profile/get_user",
                async: false,
                data: obj,
                type: 'get',
                success: function (r) {
                    data = JSON.parse(r)
                    if (data.status == true) {
                        console.log(data.user)
                        $('#firstName').val(data.user.first_name);
                        $('#lastName').val(data.user.last_name);
                        $('#userEmail').val(data.user.user_email);
                        $('#mobileNo').val(data.user.mobile_no);

                        $('.user_name').html(data.user.first_name + ' ' + data.user.last_name);
                        $('.user_mob').html(data.user.mobile_no);
                        $('.user_email').html(data.user.user_email);

                    } else {
                        showMessage('danger', r.message);
                    }
                }
            })
        }
        function updateProfile() {
            var obj = new Object()
            obj.firstName = $('#firstName').val().trim();
            obj.lastName = $('#lastName').val();
            obj.userEmail = $('#userEmail').val();
            obj.mobileNo = $('#mobileNo').val();
            $.ajax({
                url: $baseUrl + "profile/update_profile",
                async: false,
                data: obj,
                type: 'post',
                success: function (r) {
                    data = JSON.parse(r)
                    if (data.status == true) {
                        showMessage('success', data.msg);
                    } else {
                        showMessage('danger', data.msg);
                    }
                }
            })
        }
//        function LoginValidation() {
//            error = false;
//            $loginpassword = $("#password").val();
//            $userEmail = $('#userEmail').val();
//            if ($.trim($userEmail) == "" || $.trim($userEmail) == null) {
//                error = true;
//                $("#error_loginmobileNo").addClass("error_input");
//                $("#error_loginmobileNo").text("Mobile Number is required");
//            } else {
//                error = false;
//                $("#error_loginmobileNo").removeClass("error_input");
//                $("#error_loginmobileNo").text("");
//            }
//            if ($.trim($loginpassword) == "" || $.trim($loginpassword) == null) {
//                error = true;
//                $("#error_loginPassword").addClass("error_input");
//                $("#error_loginPassword").text("Password is required");
//            } else {
//                error = false;
//                $("#error_loginPassword").removeClass("error_input");
//                $("#error_loginPassword").text("");
//            }
//            return error;
//        }
    </script>
</html>
