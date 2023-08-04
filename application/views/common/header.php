<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no"  />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title></title>
    
       
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
<!--<script src="../assets/demo/chart-area-demo.js"></script> -->
<!--<script src="../assets/demo/chart-bar-demo.js"></script>  -->


<script src="https://malsup.github.io/jquery.form.js"></script> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">
.btn-label {
    position: relative;
    left: -12px;
    display: inline-block;
    padding: 6px 12px;
    background: rgba(0, 0, 0, 0.15);
    border-radius: 3px 0 0 3px;
}

.btn-labeled {
    padding-top: 0;
    padding-bottom: 0;
}

.btn {
    margin-bottom: 10px;
}

</style>
</head>
<body class="sb-nav-fixed ">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?php echo base_url(); ?>index">PakSol</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
        <div class="small" style="color: antiquewhite;"><?php echo $_SESSION['name']; ?></div>
            
            <!--<input class="form-control " type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>-->
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarDropdown">
              <!--  <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
              <!--  <li><hr class="dropdown-divider" /></li>  -->
                <li><a class="dropdown-item" id="btn_logout" href="#">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">      
               <!-- <div class="sb-sidenav-menu-heading">Core</div>    -->
               
                <?php 
                 //  print_r($user_rights);
                  // exit();
                for($i=0; $i<count($user_rights); $i++){
                    ?>
                   <?php if($user_rights[$i]['show_menu'] == 1 ) { ?>
                <a class="nav-link <?php if($user_rights[$i]['menu_id']==$menu_id) {echo "active"; } ?>" href="<?php echo base_url().$user_rights[$i]['link']; ?>">
                    <div class="sb-nav-link-icon"><i class="<?php echo $user_rights[$i]['icon'];  ?>"></i></div>
                   <?php echo $user_rights[$i]['name']; ?>
                </a>
                 <?php }  } ?>
               
                <!--<div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> -->
                <!--<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>-->
                <!--<div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div> -->
       <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            PakSol
        </div> -->
        
    </nav>
    
</div>
<script type="text/javascript">
   $("#btn_logout").click(function(){
        //href="<?php echo base_url(); ?>logout"
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
           // buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure you want to logout?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = "<?php echo base_url(); ?>logout";
        } })

    })
    function chk_month(e){
        if(e.checked){
            alert("hello checked");
        }
    }
     $('input:checkbox[name=chk_month]').change(function(){

                if(this.checked)
                $('#colour').removeAttr('disabled');
                else 
                $('#colour').attr('disabled','disabled');

        });
    $("input:checkbox[name=chk_month]:checked").each(function(){
    alert("Hello")
    yourArray.push($(this).val());
});
</script>

