<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ARSH GROUP</title>


        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="../css/buttons.dataTables.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <!--<link href="https://cdn.datatables.net/colreorder/1.5.6/css/colReorder.dataTables.min.css" rel="stylesheet" />-->
        <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

        <script type="text/javascript" src="../js/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
        <!--<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <script src="../js/scripts.js"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script> 


        <script src="https://malsup.github.io/jquery.form.js"></script> 
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style type="text/css">
            #myVideo {
                position: fixed;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
            }

            /* Add some content at the bottom of the video/page */
            .content {
                position: fixed;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                color: #f1f1f1;
                width: 100%;
                padding: 20px;
            }

            /* Style the button used to pause/play the video */
            #myBtn {
                width: 200px;
                font-size: 18px;
                padding: 10px;
                border: none;
                background: #000;
                color: #fff;
                cursor: pointer;
            }

            #myBtn:hover {
                background: #ddd;
                color: black;
            }  body{
                height: 100vh;
            } 
            .container{
                height: 100%;
            }
        </style>
    </head>
    <body>
    <div class="vid-container">
    <video autoplay="autoplay" muted loop id="myVideo">
        <source id="RandomVid" src="../assets/videos/1.mp4" type="video/mp4">
    </video>  
    <div class="inner-container">

   <video autoplay="autoplay" muted loop id="myVideo">
        <source id="RandomVid_" src="../assets/videos/1.mp4" type="video/mp4">
    </video> 
    <img src="../assets/videos/Live-Background.svg" style="width: 100%;">
    <body class="bg-primary opacity-100">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container  align-items-center justify-content-center" style="margin-top:10%;" >
                        <div class="row justify-content-center mt-4 ">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg   mt-3 " style="background: rgba(0, 0, 0, 0.5);">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body" >
                                        <form action="login" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                                            <div class="form-floating mb-3 ">
                                                <input class="form-control" name="email" required="required" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label style="color: blue;" for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="pwd" required="required"  id="inputPassword" type="password" placeholder="Password" />
                                                <label style="color: blue;" for="inputPassword">Password</label>
                                            </div>

                                            <div class="d-grid ">
                                               <button type="submit" class="btn btn-primary" style="background: rgba(0, 0, 0, 0.9);" >Login</button>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <?php if(@$msg) { ?>
                                        <div class="small" style="color:aliceblue;"><?php echo @$msg; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!--<div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PakSol 2022</div>
                           <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>  
                        </div>
                    </div>
                </footer>
            </div> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script type="text/javascript">

        </script>
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
    </body>
</html>
