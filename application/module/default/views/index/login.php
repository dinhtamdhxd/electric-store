<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo "<title>$this->title</title>". $this->css. $this->js; ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Admin</b> LTE</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body card card-info card-outline login-card-body">
                <p class="login-box-msg">Login as an administrator</p>
                <?php echo $this->errors ?? ''; ?>
                <form action="index.php?module=default&controller=index&action=login" method="post" name="form-login">
                    <div class="input-group mb-3">
                        <input type="email" name="form[email]" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="form[password]" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?php echo Html::cmsInputHidden('form[token]', time()); ?>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    

</body>

</html>