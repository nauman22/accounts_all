
    <div id="block-reset" class="login-clean">
        <form id="form-reset" method="post" action="checkEmailPwd" method="POST">
            <h2 class="visually-hidden">Login Form</h2>
            <h3 class="text-center"><img src="../assets/img/Transparent%20logo.png" width="216px">Forgot your password ?</h3>
            <h4 class="text-bg-danger"><?php echo @$msg; ?></h4>
            <div class="form-group mb-3"><input class="form-control" type="text" required="" minlength="2" maxlength="48" name="userinput" placeholder="Phone or Email "></div>
            <div class="form-group mb-3"><button class="btn btn-primary d-block w-100" data-bss-hover-animate="pulse" id="reset-btn" type="submit" style="background-color: #003dff;" data-bs-target="#resetpage.html">Reset my password !</button></div>
        </form>
    </div>
  