<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Mtlspl</title>
        <?php $this->load->view('include/header'); ?>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">

                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>

                                    <div class="card-body">
                                        <div id="alert-msg" class="alert"> </div>
                                        <form>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="userEmail" name="userEmail" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="password" name="password" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                     <a class="small" href="#">Forget password</a>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#"></a>
                                                <a class="btn btn-primary" id="loginbtn" onclick="login();" type="button">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <!--                                    <div class="card-footer text-center">
                                                                            <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                                                        </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php $this->load->view('include/footer'); ?>
        </div>
        <?php $this->load->view('include/footer_link'); ?>
    </body>
    <script>
        $baseUrl = $(".baseURL").val();
        function login() {
//    if (LoginValidation()) {
            var obj = new Object()
            obj.password = $("#password").val()
            obj.userEmail = $('#userEmail').val()
            $.ajax({
                url: $baseUrl + "welcome/login",
                async: false,
                data: obj,
                type: 'POST',
                success: function (r) {
                    if (r.status == 'true') {
                        $url = $baseUrl + 'dashboard';
                        location.href = $url;
                        showMessage('success', r.message);
                    } else {
                        showMessage('danger', r.message);
                    }
                }
            })
//    }
        }

        function LoginValidation() {
            error = false;
            $loginpassword = $("#password").val();
            $userEmail = $('#userEmail').val();
            if ($.trim($userEmail) == "" || $.trim($userEmail) == null) {
                error = true;
                $("#error_loginmobileNo").addClass("error_input");
                $("#error_loginmobileNo").text("Mobile Number is required");
            } else {
                error = false;
                $("#error_loginmobileNo").removeClass("error_input");
                $("#error_loginmobileNo").text("");
            }
            if ($.trim($loginpassword) == "" || $.trim($loginpassword) == null) {
                error = true;
                $("#error_loginPassword").addClass("error_input");
                $("#error_loginPassword").text("Password is required");
            } else {
                error = false;
                $("#error_loginPassword").removeClass("error_input");
                $("#error_loginPassword").text("");
            }
            return error;
        }
    </script>
</html>
