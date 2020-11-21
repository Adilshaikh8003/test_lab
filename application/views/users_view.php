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
                <input type="hidden" id="userId" name="userId">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                        <div class="card mb-4">
                            <!--                            <div class="card-body">
                                                            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                                            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                                            .
                                                        </div>-->   
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!--<i class="fas fa-table mr-1"></i>-->
                                <!--List-->
                                <h6 class="m-0 font-weight-bold text-primary">List <span class="float-right"><a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-icon-split">
                                            <span class="text">Add user</span>
                                        </a></span></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userTbl" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last name</th>
                                                <th>Email</th>
                                                <th>mobile no.</th>
                                                <th>Reg. date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
<!--                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Reg. date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>-->
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!--// add user model-->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-primary ">
                                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                                <button class="close " type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="user"  method="post" action="#">
                                    <div class="form-group">
                                        <input type="text" name="firstName" class="form-control form-control-user" id="firstName" placeholder="First Name">
                                        <span class="errMsg" id="firstNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lastName" class="form-control form-control-user" id="lastName" placeholder="Last Name">
                                        <span class="errMsg" id="lastNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" onchange="checkemailAddress();" name="userEmail" id="userEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        <span class="errMsg" id="adminEmailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobileNo" class="form-control form-control-user" id="mobileNo" placeholder="Mobile No.">
                                        <span class="errMsg" id="lastNameError"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="saveUser();" type="button" >Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// edit user model-->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-primary ">
                                <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                <button class="close " type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="user"  method="post" action="#">

                                    <div class="form-group">
                                        <input type="text" name="editfirstName" class="form-control form-control-user" id="editfirstName" placeholder="First Name">
                                        <span class="errMsg" id="editfirstNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="editlastName" class="form-control form-control-user" id="editlastName" placeholder="Last Name">
                                        <span class="errMsg" id="editlastNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" disabled="disabled" class="form-control form-control-user" name="edituserEmail" id="edituserEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        <span class="errMsg" id="editadminEmailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="editmobileNo" class="form-control form-control-user" id="editmobileNo" placeholder="Mobile No.">
                                        <span class="errMsg" id="lastNameError"></span>
                                    </div>
                                    <!--<input type="submit"  class="btn btn-primary btn-user btn-block btnLogIn" value="Login"/>-->
                                    <!--<hr>-->
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="saveEditUser();" type="button" >Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('include/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('include/footer_link'); ?>
    </body>
    <script>
        $baseUrl = $(".baseURL").val();
        $(document).ready(function () {
            listUsers();
        });
//        function getUser() {
//            var obj = new Object()
//            $.ajax({
//                url: $baseUrl + "profile/get_user",
//                async: false,
//                data: obj,
//                type: 'get',
//                success: function (r) {
//                    data = JSON.parse(r)
//                    if (data.status == true) {
//                        console.log(data.user)
//                        $('#firstName').val(data.user.first_name);
//                        $('#lastName').val(data.user.last_name);
//                        $('#userEmail').val(data.user.user_email);
//                        $('#mobileNo').val(data.user.mobile_no);
//
//                        $('.user_name').html(data.user.first_name + ' ' + data.user.last_name);
//                        $('.user_mob').html(data.user.mobile_no);
//                        $('.user_email').html(data.user.user_email);
//
//                    } else {
//                        showMessage('danger', r.message);
//                    }
//                }
//            })
//        }
//        function updateProfile() {
//            var obj = new Object()
//            obj.firstName = $('#firstName').val().trim();
//            obj.lastName = $('#lastName').val();
//            obj.userEmail = $('#userEmail').val();
//            obj.mobileNo = $('#mobileNo').val();
//            $.ajax({
//                url: $baseUrl + "profile/update_profile",
//                async: false,
//                data: obj,
//                type: 'post',
//                success: function (r) {
//                    data = JSON.parse(r)
//                    if (data.status == true) {
//                        showMessage('success', data.msg);
//                    } else {
//                        showMessage('danger', data.msg);
//                    }
//                }
//            })
//        }
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

        function listUsers() {
            $('#userTbl').DataTable({
                ajax: $baseUrl + "users/get_admin_users",
                "iDisplayLength": 10,
                "columns": [
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "email"},
                    {"data": "mobile_no"},
                    {"data": "created_at"},
                    {"data": "user_id",
                        "render": function (data, type, full, meta) {
                            var htmlAction = '';
                            htmlAction += '<a href="#" title="Update user" class="teal-text"  onclick="getUserId(' + data + ');" ><i  class="fas fa-fw fa-pencil teal-text"></i></a>&nbsp;&nbsp;'
                            htmlAction += '<a href="#" title="Delete user" onclick="deleteUser(' + data + ');" class="teal-text"  ><i   class="fas fa-fw fa-trash teal-text "></i></a>&nbsp;&nbsp;'
                            return htmlAction;
                        }
                    }
                ]
            });
        }

        function getUserId(id) {
        }

        function getUserId(id) {
            $('#userId').val(id);
            var obj = new Object()
            obj.userId = id;
            $.ajax({
                url: $baseUrl + "users/get_user_details",
                async: false,
                data: obj,
                type: 'GET',
                success: function (r) {
                    var data = JSON.parse(r);
                    $('#editModal').modal('show');
                    console.log(data.data[0])
                    if (data.data[0].status == true) {
                        $('#editfirstName').val(data.data[0].user.first_name)
                        $('#editlastName').val(data.data[0].user.last_name)
                        $('#edituserEmail').val(data.data[0].user.user_email)
                        $('#editmobileNo').val(data.data[0].user.mobile_no)
                    } else {
                    }
                }
            })
        }

        function deleteUser(id) {
            alertify.confirm("Are you sure you want delete this user?",
                    function () {
                        var obj = new Object();
                        obj.userId = id;
                        $.ajax({
                            url: $baseUrl + "users/delete_admin_user",
                            async: false,
                            data: obj,
                            type: 'POST',
                            success: function (data) {
                                showMessage('success', 'User delete successfully.');
//                                $('#userTbl').DataTable().ajax.reload();
                            },
                            error: function (data) {
                                showMessage('danger', 'Please try again.');
                            }
                        });
                    });
        }

        function validateEmail($email) {
            var emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            return emailReg.test($email);
        }

        function validateUserForm() {
            var flag = true;
            var adminEmail = $('#userEmail').val();
            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();

            if (adminEmail == '') {
                $('#adminEmailError').html('Email is required');
                flag = false;
            } else if (!validateEmail(adminEmail)) {
                $('#adminEmailError').html('Please enter valid email');
                flag = false;
            } else {
                $('#adminEmailError').html('');
            }

            if (firstName == '') {
                $('#firstNameError').html('First Name is required');
                flag = false;
            } else {
                $('#firstNameError').html('');
            }
            if (lastName == '') {
                $('#lastNameError').html('Last Name is required');
                flag = false;
            } else {
                $('#lastNameError').html('');
            }
            return flag;
        }

        function saveUser() {
            if (validateUserForm()) {
                var obj = new Object()
                obj.userEmail = $('#userEmail').val()
                obj.firstName = $('#firstName').val()
                obj.lastName = $('#lastName').val()
                obj.mobileNo = $('#mobileNo').val()
                $.ajax({
                    url: $baseUrl + "users/save_user",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (r) {
                        var data = JSON.parse(r);
                        console.log(data.status)
                        if (data.status == true) {
                            $('#addModal').modal('hide');
                            $('#userTbl').DataTable().ajax.reload();
                            showMessage('success', data.msg);
                        } else {
                            showMessage('danger', data.msg);
                        }
                    }
                })
            }
        }

        function saveEditUser() {
            if (validateEditUserForm()) {
                var obj = new Object()
                obj.userEmail = $('#edituserEmail').val()
                obj.firstName = $('#editfirstName').val()
                obj.lastName = $('#editlastName').val()
                obj.mobileNo = $('#editmobileNo').val()
                obj.userId = $('#userId').val();
                $.ajax({
                    url: $baseUrl + 'users/save_edit_user',
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (r) {
                        var data = JSON.parse(r);
                        console.log(data.status)
                        if (data.status == true) {
                            $('#editModal').modal('hide');
                            $('#userTbl').DataTable().ajax.reload();
                            showMessage('success', data.msg);
                        } else {
                            showMessage('danger', data.msg);
                        }
                    }
                })
            }
        }

        function validateEditUserForm() {
            var flag = true;
            var adminEmail = $('#edituserEmail').val();
            var firstName = $('#editfirstName').val();
            var lastName = $('#leditastName').val();

            if (adminEmail == '') {
                $('#editadminEmailError').html('Email is required');
                flag = false;
            } else if (!validateEmail(adminEmail)) {
                $('#editadminEmailError').html('Please enter valid email');
                flag = false;
            } else {
                $('#editadminEmailError').html('');
            }

            if (firstName == '') {
                $('#editfirstNameError').html('First Name is required');
                flag = false;
            } else {
                $('#editfirstNameError').html('');
            }
            if (lastName == '') {
                $('#editlastNameError').html('Last Name is required');
                flag = false;
            } else {
                $('#editlastNameError').html('');
            }
            return flag;
        }

        function  checkemailAddress() {
            var obj = new Object()
            obj.userEmail = $('#userEmail').val();
            $.ajax({
                url: $baseUrl + "users/check_email",
                async: false,
                data: obj,
                type: 'POST',
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data.msg);
                    if (data.status == true) {
                        $("#adminEmailError").removeClass("error_input");
                        $("#adminEmailError").text("");
                    } else {
                        $("#adminEmailError").addClass("error_input");
                        $("#adminEmailError").text(data.msg);
                        $("#adminEmailError").focus();
                    }
                }
            });
        }
    </script>
</html>
