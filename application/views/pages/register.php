
    <div class="container" id="registered-container">
        <div class="card shadow-lg o-hidden border-0 my-5" id="regirstered-card">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;../assets/img/dogs/signup.png&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" action="saveUser" method="POST">
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="First Name" name="first_name" required="" minlength="2" maxlength="300"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="exampleLastName" placeholder="Last Name" name="last_name" required="" minlength="2" maxlength="300"></div>
                                </div>
                                <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" required="" minlength="3" maxlength="350">
                                    <div><input class="form-control" type="tel" id="telephpne1" placeholder="Enter Phone Number" name="Phone" required="" minlength="5" maxlength="100"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password" minlength="7" maxlength="100" required=""></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password_repeat" minlength="7" maxlength="100" required=""></div>
                                </div><button class="btn btn-primary d-block btn-user w-100" id="register-btn" type="submit">Register Account</button>
                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="parrentId">
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="forgetpwd">Forgot Password?</a></div>
                            <div class="text-center"><a class="small" href="login">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  