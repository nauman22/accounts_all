
       

          <div id="layoutSidenav_content">
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                        
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <h1 class="display-1">401</h1>
                                    <p class="lead">Unauthorized</p>
                                    <p>Access to this resource is denied.</p>
                                    <p>Please contact to Admin for further information.</p>
                                    <!--<a href="index.html">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Dashboard
                                    </a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           
        </div>
        </div>


<footer class="py-4  mt-auto d-none d-md-block" >
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; PakSol 2022</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<div class="title_message d-block d-md-none" >
<style type="text/css">


    .nav_ {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 55px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        background-color: #ffffff;
        display: flex;
        overflow-x: auto;
    }

    .nav__link {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-grow: 1;
        min-width: 50px;
        overflow: hidden;
        white-space: nowrap;
        font-family: sans-serif;
        font-size: 13px;
        color: #444444;
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
        transition: background-color 0.1s ease-in-out;
    }

    .nav__link:hover {
        background-color: #eeeeee;
    }
    .nav_select {
        background-color: #eeeeee;  
        color: #009578;
    }
    .nav__link--active {
        color: #009578;
    }

    .nav__icon {
        font-size: 50px;
    }
    @media screen and (max-width: 600px) {
        #title_message {
        visibility: hidden;
        clear: both;
        float: left;
        margin: 10px auto 5px 20px;
        width: 28%;
        display: none;
    }
    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<nav class="nav_">

    <?php 
  
    //print_r($user_rights);
   // exit();
    for($i=0; $i<count($user_rights); $i++){
       
        ?>
        <?php if($user_rights[$i]['show_menu'] == 1 ) { ?>
            <a class="nav__link <?php if($user_rights[$i]['menu_id']==$menu_id) { echo "  nav_select ";} ?>" href="<?php echo base_url().$user_rights[$i]['link']; ?>" >
                <i class="<?php echo $user_rights[$i]['icon'];  ?>"><?php echo $user_rights[$i]['name']; ?></i>
                <span class="nav__text"><?php echo $user_rights[$i]['name']; ?></span>
            </a>
            <?php } 
        if($i == 3){
            break;
        }
    } ?>

    <!-- <a href="#" class="nav__link">
    <i class="material-icons nav__icon">settings</i>
    <span class="nav__text">Settings</span>
    </a>  -->
</nav>
</body>
<script type="text/javascript">
    $(".btn_month").click(function(){
        var month = $(this).attr("data-val") 
        // alert(month);
        // return;
        window.location.href = 'index?month='+month; 
    })
    $("#btn_cancel").click(function(){

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            // buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure you want to cancel?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $("#id").val("");
                document.getElementById("form").reset();
        } })

    })
    
    
    $(document).on("click",".btnDownloadFeedetail",function(){
          var class_ = $("#class").val(); 
           var year  = $("#year").val();
        var month = $("#month").val(); 
        
        window.open("fee_report/"+class_+"/"+year+"/"+month,"_blank")
        
    })
     
     $(document).on("click",".btnDownloadFeeNotPaid",function(){
          var class_ = $("#class").val(); 
           var year  = $("#year").val();
        var month = $("#month").val(); 
        
        window.open("fee_report_not_paid/"+class_+"/"+year+"/"+month,"_blank")
        
    })
    $(document).on("click",".btnDownloadFeeOverAll",function(){
          var class_ = $("#class").val(); 
           var year  = $("#year").val();
        var month = $("#month").val(); 
        
        window.open("fee_report_overall/"+class_+"/"+year+"/"+month,"_blank")
        
    })
    $(document).on("click",".btnfeesubmit",function(){
       // alert("Hello");
        var stdid  = $(this).attr("data-stdid");
        var year  = $("#year").val();
        var month = $("#month").val();
        var fee = $("#fee_"+stdid).val();
        console.log("stdid"+stdid)
        console.log("year"+year)
        console.log("month"+month)
        console.log("fee"+fee)

        if(stdid == "" || stdid=="0"){
            Swal.fire({
                icon: 'error',
                title: 'Contact Admin!',
                text: "Please login again, if this persist Contact Admin with error code #03412",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
        }

        if(year == "0"){
            Swal.fire({
                icon: 'error',
                title: 'Select Year!',
                text: "Please Select Year First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
        }

        if(month =="0"){
            Swal.fire({
                icon: 'error',
                title: 'Select Month!',
                text: "Please Select Month First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
        }
        if(fee ==""){
            Swal.fire({
                icon: 'error',
                title: 'FEE AMOUNT!',
                text: "Please Enter Fee amount First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
        }


        $.ajax({

            url : 'fee_crud',
            type : 'POST',
            data : {
                'stdid' : stdid,
                'year'  :year,
                'month':month ,
                'fee':fee 
            },
            dataType:'json',
            success : function(data) {
                if(data['status']==true){
                   Swal.fire(
                'Saved Successfully',
                'Thank You.',
                'success'
            )   
                } else{
                   Swal.fire({
                icon: 'error',
                title: 'FEE NOT SAVED!',
                text: "Please LOGIN again or contact Admin with code #9009",
                // footer: '<a href="">Why do I have this issue?</a>'
            })   
                }
            }
        });

    })
    $(document).on("click", ".btn_edit, .btn_del  ", function(){
        var isdelete =0;
        var menu_id  = $(this).attr("data-menu_id");
        var row_id = $(this).attr("data-row_id");
        var button_id = $(this).attr("data-button_id");
        if(button_id == 2){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                // buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure you want to Delete this?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({

                        url : 'crud',
                        type : 'POST',
                        data : {
                            'menu_id' : menu_id,
                            'row_id'  :row_id,
                            'button_id':button_id
                        },
                        dataType:'json',
                        success : function(data) {
                            /*console.log(data);
                            console.log(data[0]['id']);
                            console.log(data[0]['name']);
                            console.log(data[0]['description']);
                            console.log(data[0]['remarks']);*/
                            if(button_id == 1){
                                if(menu_id == 2){
                                    $("#id").val(data[0]['id']);             
                                    $("#company_id").val(data[0]['company_id']);             
                                    $("#date").val(data[0]['date']);             
                                    $("#type").val(data[0]['type_id']);             
                                    $("#account").val(data[0]['bank_id']);             
                                    $("#head").val(data[0]['head_id']);             
                                    $("#category").val(data[0]['category_id']);             
                                    $("#mode").val(data[0]['mode_id']);             
                                    $("#emp").val(data[0]['user_id']);             
                                    $("#amount").val(data[0]['amount']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 3){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 4){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 6){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 8){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 10){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#father_name").val(data[0]['father_name']);             
                                    $("#cnic").val(data[0]['cnic']);             
                                    $("#desig").val(data[0]['desig']);             
                                    $("#dob").val(data[0]['dob']);             
                                    $("#cell_no").val(data[0]['cell_no']);             
                                    $("#guardian_cell").val(data[0]['guardian_cell']);             
                                    $("#home_cell").val(data[0]['home_cell']);             
                                    $("#emergency_cell").val(data[0]['emergency_cell']);             
                                    $("#address").val(data[0]['address']);             
                                    $("#salary").val(data[0]['salary']);             
                                    $("#bank_name").val(data[0]['bank_name']);             
                                    $("#bank_account_no").val(data[0]['bank_account_no']);             
                                    $("#iban").val(data[0]['iban']);             
                                    $("#pwd").val(data[0]['pwd']);             
                                    $("#note").val(data[0]['note']);             
                                    $("#email").val(data[0]['email']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 12){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#address").val(data[0]['address']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 14){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#address").val(data[0]['address']);             
                                    $("#iban").val(data[0]['iban']);             
                                    $("#account_no").val(data[0]['account_no']);             
                                    $("#swift").val(data[0]['swift']);             
                                    $("#description").val(data[0]['description']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 15){
                                    $("#id").val(data[0]['id']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#address").val(data[0]['address']);             
                                    $("#longitude").val(data[0]['longitude']);             
                                    $("#purchasing_date").val(data[0]['purchasing_date']);             
                                    $("#seller_name").val(data[0]['seller_name']);             
                                    $("#seller_address").val(data[0]['seller_address']);             
                                    $("#seller_cnic").val(data[0]['seller_cnic']);             
                                    $("#seller_cell").val(data[0]['seller_cell']);             
                                    $("#remarks").val(data[0]['remarks']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                                else if(menu_id == 20){
                                    if(data[0]['class'].length > 0){
                                data[0]['class']= data[0]['class'].toUpperCase();
                            } 
                                    $("#id").val(data[0]['id']);             
                                    $("#class").val(data[0]['class']);             
                                    $("#name").val(data[0]['name']);             
                                    $("#fname").val(data[0]['fname']);             
                                    $("#dob").val(data[0]['dob']);             
                                    $("#bform").val(data[0]['bform']);             
                                    $("#fnic").val(data[0]['fnic']);             
                                    $("#address").val(data[0]['address']);             
                                    $("#reqFee").val(data[0]['reqFee']);             
                                    $("#adm_date").val(data[0]['adm_date']);             
                                    $("#cell").val(data[0]['cell']);             
                                    $("#section").val(data[0]['section']);             
                                    $("#remarks").val(data[0]['remarks']);             
                                    $("#status").val(data[0]['status']); 
                                    window.scrollTo({ top: 0, behavior: 'smooth' });              
                                }
                            }
                            else if(button_id == 2){
                                Swal.fire(
                                    'Record Deleted Successfully',
                                    'Thank You.',
                                    'success'
                                )
                                $('#datatablesSimple').DataTable().ajax.reload(); 
                            }
                            // alert('Data: '+data);
                        },
                        error : function(request,error)
                        {
                            alert("Request: "+JSON.stringify(request));
                        }
                    });
            } })
        }
        else{
            $.ajax({

                url : 'crud',
                type : 'POST',
                data : {
                    'menu_id' : menu_id,
                    'row_id'  :row_id,
                    'button_id':button_id
                },
                dataType:'json',
                success : function(data) {
                    /*console.log(data);
                    console.log(data[0]['id']);
                    console.log(data[0]['name']);
                    console.log(data[0]['description']);
                    console.log(data[0]['remarks']);*/
                    if(button_id == 1){
                        if(menu_id == 2){
                            $("#id").val(data[0]['id']);             
                            $("#company_id").val(data[0]['company_id']);             
                            $("#date").val(data[0]['date']);             
                            $("#type").val(data[0]['type_id']);             
                            $("#account").val(data[0]['bank_id']);             
                            $("#head").val(data[0]['head_id']);             
                            $("#category").val(data[0]['category_id']);             
                            $("#mode").val(data[0]['mode_id']);             
                            $("#emp").val(data[0]['user_id']);             
                            $("#amount").val(data[0]['amount']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 3){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 4){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 6){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 8){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 10){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#father_name").val(data[0]['father_name']);             
                            $("#cnic").val(data[0]['cnic']);             
                            $("#desig").val(data[0]['desig']);             
                            $("#dob").val(data[0]['dob']);             
                            $("#cell_no").val(data[0]['cell_no']);             
                            $("#guardian_cell").val(data[0]['guardian_cell']);             
                            $("#home_cell").val(data[0]['home_cell']);             
                            $("#emergency_cell").val(data[0]['emergency_cell']);             
                            $("#address").val(data[0]['address']);             
                            $("#salary").val(data[0]['salary']);             
                            $("#bank_name").val(data[0]['bank_name']);             
                            $("#bank_account_no").val(data[0]['bank_account_no']);             
                            $("#iban").val(data[0]['iban']);             
                            $("#note").val(data[0]['note']);             
                            $("#email").val(data[0]['email']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 12){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#address").val(data[0]['address']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 14){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#address").val(data[0]['address']);             
                            $("#iban").val(data[0]['iban']);             
                            $("#account_no").val(data[0]['account_no']);             
                            $("#swift").val(data[0]['swift']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 15){
                            $("#id").val(data[0]['id']);             
                            $("#name").val(data[0]['name']);             
                            $("#address").val(data[0]['address']);             
                            $("#longitude").val(data[0]['longitude']);             
                            $("#purchasing_date").val(data[0]['purchasing_date']);             
                            $("#seller_name").val(data[0]['seller_name']);             
                            $("#seller_address").val(data[0]['seller_address']);             
                            $("#seller_cnic").val(data[0]['seller_cnic']);             
                            $("#seller_cell").val(data[0]['seller_cell']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                        else if(menu_id == 20){
                            $("#id").val(data[0]['id']);
                            if(data[0]['class'].length > 0){
                                data[0]['class']= data[0]['class'].toUpperCase();
                            }             
                            $("#class").val(data[0]['class']);             
                            $("#name").val(data[0]['name']);             
                            $("#fname").val(data[0]['fname']);             
                            $("#dob").val(data[0]['dob']);             
                            $("#bform").val(data[0]['bform']);             
                            $("#fnic").val(data[0]['fnic']);             
                            $("#address").val(data[0]['address']);             
                            $("#reqFee").val(data[0]['reqFee']);             
                            $("#adm_date").val(data[0]['adm_date']);             
                            $("#cell").val(data[0]['cell']);             
                            $("#section").val(data[0]['section']);             
                            $("#remarks").val(data[0]['remarks']);             
                            $("#father_occouption").val(data[0]['father_occouption']);             
                            $("#status").val(data[0]['status']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });              
                        }
                    }
                    else if(button_id == 2){
                        Swal.fire(
                            'Record Deleted Successfully',
                            'Thank You.',
                            'success'
                        )
                        $('#datatablesSimple').DataTable().ajax.reload(); 
                    }
                    // alert('Data: '+data);
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });
        }
    })


</script>

</html>
