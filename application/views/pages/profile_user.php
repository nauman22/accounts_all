 <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                           <form action="user_img_update" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle bounce animated mb-3 mt-4 img-fluid img-thumbnail" id="profile-pics" src="<?php if(file_exists(user_img.$_SESSION['id'].".jpg")){ echo "../".user_img.$_SESSION['id'].".jpg?".time(); } else{ echo "../assets/user/img/TLF_profile_pic.jpg";}?>" width="100%" height="100%">
                                    <div class="mb-3">
                                        <p style="color: rgb(7,7,7);font-size: 11px;text-align: center;">Allow File Types:&nbsp; .Jpg .jpeg</p>
                                        <input type="file" name="file_upload" id="btnUploadfile" >
                                        <button class="btn btn-primary btn-sm" id="change-photo" type="submit">Change Photo</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row" style="text-align: left;">
                                        <div class="col-lg-12 offset-1 align-self-center" style="text-align: left;font-size: 20px;">
                                            <h1 style="text-align: left;font-size: 15px;color: rgb(0,0,0);font-family: Nunito, sans-serif;"><strong>Name:</strong><span style="font-size: 16px;">&nbsp; <?php echo $_SESSION['kin']; ?></span></h1>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align: left;">
                                        <div class="col-lg-12 offset-1 align-self-center" style="text-align: left;font-size: 20px;">
                                            <h1 style="text-align: left;font-size: 15px;color: rgb(0,0,0);font-family: Nunito, sans-serif;"><strong>User Id:</strong><span style="font-size: 16px;">&nbsp; <?php echo $_SESSION['id']; ?></span></h1>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align: left;">
                                        <div class="col-lg-12 offset-1 align-self-center" style="text-align: left;font-size: 20px;">
                                            <h1 style="text-align: left;font-size: 15px;color: rgb(0,0,0);font-family: Nunito, sans-serif;"><strong>Parent Id:</strong><span style="font-size: 16px;">&nbsp; <?php echo $_SESSION['parrentId']; ?></span></h1>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align: left;">
                                        <div class="col-lg-12 offset-1 align-self-center" style="text-align: left;font-size: 20px;">
                                            <h1 class="text-start" style="text-align: left;font-size: 15px;color: rgb(0,0,0);font-family: Nunito, sans-serif;"><strong>Email id:</strong><span style="font-size: 16px;">&nbsp; <?php echo $_SESSION['email']; ?></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="small fw-bold" style="color: rgb(0,0,0);">Total Deposit<span class="float-end" style="color: var(--bs-blue);">45$</span></h4>
                                    <h4 class="small fw-bold" style="color: rgb(8,8,8);">Total Earning&nbsp;<span class="float-end" style="color: var(--bs-success);">0.5$</span></h4>
                                    <h4 class="small fw-bold" style="color: rgb(0,0,0);">Total Balance&nbsp;<span class="float-end" style="color: var(--bs-blue);">45.5$</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">User Settings</p>
                                        </div>
                                        <div class="card-body">
                                          <form action="user_profile_update" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                   
                                                    <div class="co2">
                                                        <div class="mb-3"><label class="form-label" for="email" style="color: var(--bs-gray-900);"><strong>Email Address</strong></label><input class="form-control" readonly="readonly" type="email" id="email" value="<?php echo $_SESSION['email']; ?>" placeholder="user@example.com" name="email" minlength="3" maxlength="100" style="color: var(--bs-blue);"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col" id="Phone-col" style="text-align: center;"><label class="form-label" for="first_name" style="color: var(--bs-gray-900);"><strong>Phone Number</strong></label><input class="form-control" readonly="readonly" value="<?php echo $_SESSION['phone']; ?>" type="tel" name="tel" id="telephone-input" placeholder="+8105..." required="" minlength="7" maxlength="20" style="padding-left: 120px;margin-right: -121px;"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name" style="color: var(--bs-gray-900);"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="John" value="<?php echo $_SESSION['first_name']; ?>"  name="first_name" required="" minlength="2" maxlength="50" style="color: var(--bs-blue);"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name" style="color: var(--bs-gray-900);"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" placeholder="Doe"  value="<?php echo $_SESSION['last_name']; ?>" name="last_name" minlength="2"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" id="save-name-info" type="submit">Save Settings</button></div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Contact Settings</p>
                                        </div>
                                        <div class="card-body">
                                           <form action="user_kin_update" id="user_kin_update" name="user_kin_update"  method="post" enctype="multipart/form-data">
                                                <div class="mb-3"><label class="form-label" for="address" style="border-color: var(--bs-black);color: var(--bs-gray-900);"><strong>Next of Kin (Name, Identity Card Number and Relation)</strong></label><input class="form-control" type="text" id="kin" value="<?php echo $_SESSION['kin']; ?>" placeholder="Emy ...." name="kin" style="color: var(--bs-blue);"></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="city" style="color: var(--bs-gray-900);"><strong>USDT(TRC20) Address</strong></label><input class="form-control" type="text" id="city" placeholder="Los Angeles" name="city" value="<?php echo $_SESSION['city']; ?>" style="color: var(--bs-blue);"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="country" style="color: var(--bs-gray-900);"><strong>Country</strong></label><input class="form-control" type="text" id="country" placeholder="USA" value="<?php echo $_SESSION['country']; ?>" name="country" style="color: var(--bs-blue);"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" id="save-location-info" type="submit">Save&nbsp;Settings</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Password Settings</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                   <form action="user_pwd_update" id="user_pwd_update" name="user_pwd_update"  method="post" enctype="multipart/form-data">
                                        <div class="mb-3"><label class="form-label" for="signature" style="color: var(--bs-gray-900);margin-top: 10px;margin-left: 2px;"><strong>Old Password&nbsp;</strong><br></label><input class="form-control" type="password" id="old-password" required="" minlength="3" maxlength="100" placeholder="Enter Old Password"></div><label class="form-label" style="color: rgb(0,0,0);font-weight: bold;margin-top: 10px;margin-left: 2px;">New Password</label><input class="form-control" type="password" id="newpass" name="newpass" placeholder="Enter New Password" style="margin-bottom: 12px;"><label class="form-label" style="color: rgb(0,0,0);font-weight: bold;margin-top: 10px;margin-left: 2px;">Confirm Password</label><input class="form-control" type="password" id="confirmpwd" name="confirmpwd" placeholder="Confirm New Password">
                                        <div class="mb-3"></div>
                                        <div class="mb-3"><button class="btn btn-primary btn-sm" id="save-signature-info" type="submit">Save Settings</button></div>
                                    </form>
                                </div>
                                <div class="col">
                                    <div class="mb-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      