<?php
require_once('admin_header.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login Form | Pending Deposit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
<div class="py-4">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h2>Admin Login Form</h2>
            <p>Use the form below to login using your credentials</p>
            <div class="py-3"></div>
            <form method="post" action="login.php"> <!-- Added action attribute -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="inputEmail3"
                               placeholder="User Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Secret Question</label>
                    <div class="col-sm-10">
                        <input type="text" name="sq" class="form-control" id="inputPassword3"
                               placeholder="Secret Question">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Secret Answer</label>
                    <div class="col-sm-10">
                        <input type="text" name="sa" class="form-control" id="inputPassword3"
                               placeholder="Secret Answer">
                    </div>
                </div>
                <!-- Login button -->
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="sign_in" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
