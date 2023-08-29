



<footer class="py-4  mt-auto d-none d-md-block" >
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; PakSol 2023</div>
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

    <?php for($i=0; $i<count($user_rights); $i++){
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
        }})

    });

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

                                else if(menu_id == 5){
                                    $("#id").val(data[0]['id']);             
                                    $("#chqno").val(data[0]['chqno']);             
                                    $("#type").val(data[0]['type']);                 
                                    $("#date").val(data[0]['date']);                 
                                    $("#amount").val(data[0]['amount']);                 
                                    $("#status").val(data[0]['status']);                 
                                    $("#description").val(data[0]['description']);       
                                    $("#branchname").val(data[0]['branchname']);
                                    $("#branchnumber").val(data[0]['branchnumber']);
                                    $("#iban").val(data[0]['iban']);
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

                                    $("#visa_entry_date").val(data[0]['visa_entry_date']);             
                                    $("#visa_expiry_date").val(data[0]['visa_expiry_date']);             
                                    $("#labour_entry_date").val(data[0]['labour_entry_date']);             
                                    $("#labour_expiry_date").val(data[0]['labour_expiry_date']);             
                                    $("#pasport_issue_date").val(data[0]['pasport_issue_date']);             
                                    $("#pasport_expiry_date").val(data[0]['pasport_expiry_date']);             
                                    $("#id_card_issue_date").val(data[0]['id_card_issue_date']);             
                                    $("#id_card_expiry_date").val(data[0]['id_card_expiry_date']);             


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
                                    $("#lic_name").val(data[0]['lic_name']);             
                                    $("#lic_no").val(data[0]['lic_no']);             
                                    $("#company_start_date").val(data[0]['company_start_date']);             
                                    $("#company_last_date").val(data[0]['company_last_date']);             
                                    $("#est_start_date").val(data[0]['est_start_date']);             
                                    $("#est_end_date").val(data[0]['est_end_date']);             
                                    $("#office_ijari_start_date").val(data[0]['office_ijari_start_date']);             
                                    $("#office_ijari_end_date").val(data[0]['office_ijari_end_date']);             
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
                                else if(menu_id == 22){

                                    $("#id").val(data[0]['id']);             
                                    $("#company_id").val(data[0]['company_id']);             
                                    $("#branch_name").val(data[0]['branch_name']);             
                                    //$("#user_id").val(data[0]['user_id']); 

                                    $.ajax({
                                        url: "get_branch_users", // URL to the server endpoint
                                        method: "POST",
                                        dataType: "json", // Expected data type of the response
                                        data: {ids: data[0]['user_id'] }, 
                                        success: function(data){
                                            var dropdown = $("#user_id");
                                            dropdown.empty();
                                            $.each(data, function(index, emp) {
                                                dropdown.append($('<option></option>').attr('value', emp.id).text(emp.name));
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle errors
                                            console.log("Error:", error);
                                        }
                                    });

                                    $("#branch_price").val(data[0]['branch_price']);
                                    $("#monprice").val(data[0]['branch_price']/12);  
                                    $("#monprice").css("background-color", "pink");
                                    $("#row_permit_start_date").val(data[0]['row_permit_start_date']);             
                                    $("#row_permit_end_date").val(data[0]['row_permit_end_date']);             
                                    $("#tax").val(data[0]['tax']);
                                    var TaxRate = $("#tax").val()/100;
                                    var branch_price = $("#branch_price").val();
                                    var TaxAmount =  branch_price * TaxRate;
                                    $("#taxshow").val(TaxAmount);
                                    $("#taxshow").css("background-color", "orange");             
                                    $("#plot_utilization_start_date").val(data[0]['plot_utilization_start_date']);             
                                    $("#plot_utilization_end_date").val(data[0]['plot_utilization_end_date']); 
                                    $("#plot_utilization_price").val(data[0]['plot_utilization_price']);   
                                    $("#plot_utilization_mon_price").val(data[0]['plot_utilization_price']/12);
                                    $("#plot_utilization_mon_price").css("background-color", "yellow");      
                                    var monprice = $("#building_permit_price").val()/12;
                                    $("#building_permit_mon_price").val(monprice );
                                    $("#building_permit_mon_price").css("background-color", "cyan");           
                                    $("#building_permit_start_date").val(data[0]['building_permit_start_date']);             
                                    $("#building_permit_end_date").val(data[0]['building_permit_end_date']);             
                                    $("#building_permit_price").val(data[0]['building_permit_price']);             
                                    $("#project_start_date").val(data[0]['project_start_date']);
                                    $("#project_end_date").val(data[0]['project_end_date']);    
                                    $("#parking_ijari_start_date").val(data[0]['parking_ijari_start_date']);             
                                    $("#parking_ijari_end_date").val(data[0]['parking_ijari_end_date']);             
                                    $("#remarks").val(data[0]['remarks']); 
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

                        else if(menu_id == 5){
                            $("#id").val(data[0]['id']);             
                            $("#chqno").val(data[0]['chqno']);             
                            $("#type").val(data[0]['type']);                 
                            $("#date").val(data[0]['date']);                 
                            $("#amount").val(data[0]['amount']);                 
                            $("#status").val(data[0]['status']);                 
                            $("#description").val(data[0]['description']);       
                            $("#branchname").val(data[0]['branchname']);
                            $("#branchnumber").val(data[0]['branchnumber']);
                            $("#iban").val(data[0]['iban']);
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

                            $("#visa_entry_date").val(data[0]['visa_entry_date']);             
                            $("#visa_expiry_date").val(data[0]['visa_expiry_date']);             
                            $("#labour_entry_date").val(data[0]['labour_entry_date']);             
                            $("#labour_expiry_date").val(data[0]['labour_expiry_date']);             
                            $("#pasport_issue_date").val(data[0]['pasport_issue_date']);             
                            $("#pasport_expiry_date").val(data[0]['pasport_expiry_date']);             
                            $("#id_card_issue_date").val(data[0]['id_card_issue_date']);             
                            $("#id_card_expiry_date").val(data[0]['id_card_expiry_date']); 

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
                            $("#lic_name").val(data[0]['lic_name']);             
                            $("#lic_no").val(data[0]['lic_no']);             
                            $("#company_start_date").val(data[0]['company_start_date']);        
                            $("#company_last_date").val(data[0]['company_last_date']);             
                            $("#est_start_date").val(data[0]['est_start_date']);             
                            $("#est_end_date").val(data[0]['est_end_date']);             
                            $("#office_ijari_start_date").val(data[0]['office_ijari_start_date']);             
                            $("#office_ijari_end_date").val(data[0]['office_ijari_end_date']);             
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

                        else if(menu_id == 22){
                            $("#id").val(data[0]['id']);             
                            $("#company_id").val(data[0]['company_id']);             
                            $("#branch_name").val(data[0]['branch_name']);             
                            //$("#user_id").val(data[0]['user_id']);             


                            $.ajax({
                                url: "get_branch_users", // URL to the server endpoint
                                method: "POST",
                                dataType: "json", // Expected data type of the response
                                data: {ids: data[0]['user_id'] }, 
                                success: function(data){
                                    var dropdown = $("#user_id");
                                    dropdown.empty();
                                    $.each(data, function(index, emp) {
                                        dropdown.append($('<option></option>').attr('value', emp.id).text(emp.name));
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Handle errors
                                    console.log("Error:", error);
                                }
                            });

                            $("#branch_price").val(data[0]['branch_price']);             
                            $("#monprice").val(data[0]['branch_price']/12);       
                            $("#monprice").css("background-color", "pink");      
                            $("#row_permit_start_date").val(data[0]['row_permit_start_date']);             
                            $("#row_permit_end_date").val(data[0]['row_permit_end_date']);             
                            $("#tax").val(data[0]['tax']);             
                            $("#plot_utilization_start_date").val(data[0]['plot_utilization_start_date']);             
                            $("#plot_utilization_end_date").val(data[0]['plot_utilization_end_date']);             
                            $("#plot_utilization_price").val(data[0]['plot_utilization_price']);             
                            $("#plot_utilization_mon_price").val(data[0]['plot_utilization_price']/12);
                            $("#plot_utilization_mon_price").css("background-color", "yellow");             
                            $("#building_permit_start_date").val(data[0]['building_permit_start_date']);             
                            $("#building_permit_end_date").val(data[0]['building_permit_end_date']);             
                            $("#building_permit_price").val(data[0]['building_permit_price']);    
                            var monprice = $("#building_permit_price").val()/12;
                            $("#building_permit_mon_price").val(monprice );
                            $("#building_permit_mon_price").css("background-color", "cyan");
                            var TaxRate = $("#tax").val()/100;
                            var branch_price = $("#branch_price").val();

                            var TaxAmount =  branch_price * TaxRate;
                            $("#taxshow").val(TaxAmount);
                            $("#taxshow").css("background-color", "orange");         
                            $("#project_start_date").val(data[0]['project_start_date']);             
                            $("#project_end_date").val(data[0]['project_end_date']);             
                            $("#parking_ijari_start_date").val(data[0]['parking_ijari_start_date']);             
                            $("#parking_ijari_end_date").val(data[0]['parking_ijari_end_date']);             
                            $("#remarks").val(data[0]['remarks']); 
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
