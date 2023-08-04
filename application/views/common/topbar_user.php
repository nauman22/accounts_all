
        <div class="d-flex flex-column" id="content-wrapper1" style="width: 100%;height: 100%;">
            <nav class="navbar navbar-light navbar-expand-md" id="navbar-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item text-center" style="text-align: center;margin-left: 10px;margin-right: 10px;margin-top: 10px;">
                                <div><span>Your Id</span><span><br><span style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);"> <?php echo $_SESSION['id']; ?></span><br><br></span></div>
                            </li>
                            <li class="nav-item text-center" style="text-align: center;margin-right: 10px;margin-left: 10px;margin-top: 10px;">
                                <div><span>Your Plan&nbsp;</span>
                                    <div></div><span style="color: rgb(3,3,3);"> <?php echo $_SESSION['plan']; ?></span>
                                </div>
                            </li>
                            <li class="nav-item text-center" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
                                <div style="text-align: center;"><span>Parent ID</span><span class="text-center"><br><span style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);"><?php echo $_SESSION['parrentId']; ?></span><br></span></div>
                            </li>
                        </ul>
                        <ul class="navbar-nav text-center flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span style="color: rgb(133,135,150);font-weight: bold;"></span><span class="text-center" style="text-align: center;font-size: 18px;margin-top: 0px;color: rgb(0,0,0);"></span></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item text-center dropdown no-arrow mx-1" style="margin-right: 3px;">
                                <div class="nav-item dropdown no-arrow" style="margin-top: 15px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-share-alt fa-fw"></i><span style="color: rgb(6,6,6);">Share</span></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Share profile Link (copy link)</h6>
                                        
                                          
                                           
                                        <div>
                                        <input class=".text-info form-control " type="text" value="<?php echo "https://topleadfunds.com/Welcome/register?id=".$_SESSION['id']; ?> ">
                                        </div>
                                    </div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['first_name']; ?></span><img class="border rounded-circle img-profile img-fluid img-thumbnail" style=" width: 62px;"src="<?php if(file_exists(user_img.$_SESSION['id'].".jpg")){ echo "../".user_img.$_SESSION['id'].".jpg?".time(); } else{ echo "../assets/user/img/TLF_profile_pic.jpg";}?>"></a>
                                    <div class="dropdown-menu dropdown-menu-end text-center shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item logout" href="#" onclick="logout();return false;"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>