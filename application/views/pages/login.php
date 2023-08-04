
    <div class="container" id="container-login" style="box-shadow: 0px 0px rgb(35,39,71);">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;../assets/img/dogs/login.png&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">LOGIN</h4>
                                    </div>
                                    <form class="user" action="login_check" if="form" name="form_cat" method="post"  enctype="multipart/form-data">
                                        <div class="mb-3"><input class="form-control form-control-user" type="email" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter Phone Number Or Email Address..." name="email" required="" minlength="3" maxlength="350"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="inputPassword" placeholder="Password" name="password" required="" minlength="2" maxlength="299"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" id="loign-bbtn" type="submit">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgetpwd">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
     <!--   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script type="text/javascript">

        </script>-->
        <script>
            window.onload = function(event) {

                // document.getElementById("RandomVid").src = "../assets/videos/"+Math.floor(Math.random() * 4 + 1).toString() + ".mp4";

                //Remove the code below in the real thing
                // alert(document.getElementById('RandomVid').src);
                //  document.getElementById("RandomVid_").src = "../assets/videos/"+Math.floor(Math.random() * 4 + 1).toString() + ".mp4";

                //Remove the code below in the real thing
                // alert(document.getElementById('RandomVid').src);

                var srcsList = ["../assets/videos/1.mp4", "../assets/videos/2", "../assets/videos/3","../assets/videos/4","../assets/videos/5","../assets/videos/6","../assets/videos/7"];
                var randomInt = Math.floor(Math.random() * srcsList.length);
                var randomSrc = srcsList[randomInt];
                var video = document.querySelector('video');

                //$('#RandomVid').attr('src', randomSrc + '.mp4');
                //$('[type="video/webm"]').attr('src', randomSrc + '.mp4');
                //document.getElementById('RandomVid').get(0).play();
                // document.getElementById('RandomVid_').get(0).play();
                //document.getElementById('RandomVid_').play();
                //video.muted = true;
                //video.play()
            }
        </script>
    