<?php //print_r($type); exit(); ?>

<link rel="stylesheet" href="../css/NSB_Box.css" />
<script src="../js/NSB_Box.js"></script>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <?php 
        $icon = "";
        $add_record = "";
        $name = "";
        for($i=0; $i<count($user_rights); $i++){
            ?>
            <?php if($user_rights[$i]['menu_id']==$menu_id) 
            {  
                $icon = $user_rights[$i]['icon'];  
                $add_record=  $user_rights[$i]['add_record'];
                $name = $user_rights[$i]['name']; 
                break;
            }
        } ?>
        <h1 class="mt-4"><i class="<?php echo $icon; ?> "></i> <?php  echo $name; ?></h1>
        <br>
        <?php if($add_record == 1){ ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="<?php echo $icon; ?>"></i> Add / Update 
                        </div>
                        <div class="card-body">
                            <form action="insert_cash_register" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="company_id" name="company_id"  >
                                                <option value="">SELECT COMPANY</option>
                                                <?php 
                                                for($i=0; $i<count($company); $i++){
                                                    $id = $company[$i]['id'];
                                                    $text = $company[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <!-- <label for="company_id">COMPANY</label> --> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <select class="form-control" id="branch_id" name="branch_id">
                                                <option value="">SELECT BRANCH</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">


                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="wrkemp" name="wrkemp" >
                                                <option value="">WORKER EMPLOYEE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="emp" name="emp"   >
                                                <option value="">COLLECTION EMPLOYEE</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>

                                <div class="row align-items-center">

                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="type" name="type" >
                                                <option value="">SELECT TYPE</option>
                                                <?php 
                                                for($i=0; $i<count($type); $i++){
                                                    $id = $type[$i]['id'];
                                                    $text = $type[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="type">TYPE</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="mode" name="mode" >
                                                <option value="0">SELECT MODE</option>
                                                <?php 
                                                for($i=0; $i<count($mode); $i++){
                                                    $id = $mode[$i]['id'];
                                                    $text = $mode[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="mode">MODE</label>  

                                        </div>
                                    </div>
                                </div>
                                <div style="display: none;"  class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="head" name="head" >
                                                <option value="">SELECT HEAD</option>
                                                <?php 
                                                for($i=0; $i<count($head); $i++){
                                                    $id = $head[$i]['id'];
                                                    $text = $head[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="head">HEAD</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control"  id="category" name="category" >
                                                <option value="0">SELECT CATEGORY</option>
                                                <?php 
                                                for($i=0; $i<count($category); $i++){
                                                    $id = $category[$i]['id'];
                                                    $text = $category[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="category">CATEGORY</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="date" name="date" type="date" placeholder="name@example.com" />
                                            <label for="date">COLLECTION DATE</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" readonly="readonly" id="srno" name="srno" type="text" />
                                            <label for="date">Serial Number</label>
                                        </div>
                                    </div> 



                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="number" id="amount" name="amount" placeholder=" description">
                                            <label for="amount">AMOUNT</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder="description" id="description" name="description">
                                            <label for="description">DESCRIPTION</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Type Remarks here" id="remarks" name="remarks" style="height: 100px"></textarea>
                                            <label for="remarks">REMARKS</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12 ">
                                        <label>UPLOAD DOCUMENTS IF ANY</label> 
                                        <input type="file" class="form-control" name="upload_doc_cash_register[]" multiple id="upload_doc_cash_register">


                                    </div>
                                </div>
                                <br>

                                <div class="d-grid gap-2 col-6 mx-auto w-100">
                                    <button class="btn btn-success col-xs-12 form-control"  type="submit">Save</button>
                                    <button class="btn btn-danger col-xs-12 form-control" id="btn_cancel" type="button">Cancel</button>

                                </div>
                                <div id="output1" class="d-grid gap-2 col-6 mx-auto">

                                </div>
                                <input type="hidden" id="id" name="id">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php } ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="<?php echo $icon; ?>"></i>
                Saved Entries
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="display responsive nowrap" style=" width:100%!important">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Images</th>
                            <th>Collection Date</th>
                            <th>Company</th>
                            <th>Branch</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Head</th>
                            <th>Employee</th>
                            <th>Description</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>  
<script type="text/javascript">

    $(document).ready( function () {
        $('#company_id, #branch_id, #emp, #wrkemp').select2({
            placeholder: function() {
                if ($(this).attr('id') === 'company_id') {
                    return 'COMPANY';
                } else if ($(this).attr('id') === 'branch_id') {
                    return 'BRANCH';
                } else if ($(this).attr('id') === 'emp') {
                    return 'COLLECTION EMPLOYEE';
                }else if ($(this).attr('id') === 'wrkemp') {
                    return 'WORK EMPLOYEE';
                }
            },
            allowClear: true
        })


        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."cash_register_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },      

            "columns": [
                { "data": "id" },
                { "data": "images" },
                { "data": "date" },
                { "data": "company_name" },
                { "data": "branch_name" },
                { "data": "amount" },
                { "data": "type_name" },
                { "data": "head_name" },
                { "data": "user_name" },
                { "data": "description" },
                { "data": "remarks" },
                { "data": "buttons" },
            ]     
        });
    });
</script>
<script type="text/javascript">

    $("#date").focusout(function(){

        var collectiondate = $(this).val();
        $.ajax({
            url: "get_serialnumber", // URL to the server endpoint
            method: "POST",
            dataType: "json", // Expected data type of the response
            data: {collectiondate: collectiondate }, 
            success: function(srno) {

                // Populate the dropdown with data from the response

                $("#srno").val(srno);
                return true;

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.log("Error:", error);
            }
        });
    });

    // prepare the form when the DOM is ready 
    $(document).ready(function() { 
        var isDropdown1Changed = false;

        $.ajax({
            url: "get_branch_users", 
            method: "POST",
            dataType: "json", 
            //data: {id: selectedValue }, 
            success: function(data) {

                var dropdown = $("#emp");
                var dropdown2 = $("#wrkemp");
                dropdown.empty();
                dropdown2.empty();
                dropdown.append('<option value="">COLLECTION EMPLOYEE</option>');
                $.each(data, function(index, emp) {
                    dropdown.append($('<option></option>').attr('value', emp.id).text(emp.name));
                });
                dropdown2.append('<option value="0">WORK EMPLOYEE</option>');
                $.each(data, function(index, emp) {
                    dropdown2.append($('<option></option>').attr('value', emp.id).text(emp.name));
                });
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });

        $("#company_id").change(function(){

            if (!isDropdown1Changed) {

                var selectedValue = $(this).val();
                $.ajax({
                    url: "get_Company_branches", // URL to the server endpoint
                    method: "POST",
                    dataType: "json", // Expected data type of the response
                    data: {id: selectedValue }, 
                    success: function(data) {

                        // Populate the dropdown with data from the response

                        var dropdown = $("#branch_id");
                        var dropdown2 = $("#lblBranch");
                        dropdown.empty();
                        dropdown.css("display", "block");
                        dropdown2.css("display", "block");
                        dropdown.append('<option value="">SELECT BRANCH</option>');
                        $.each(data, function(index, branch) {
                            dropdown.append($('<option></option>').attr('value', branch.id).text(branch.branch_name));
                        });
                        isDropdown1Changed = true; 
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log("Error:", error);
                        isDropdown1Changed = false; 
                    }
                });
            }
        });

        $("#wrkemp").change(function(){


            if (!isDropdown1Changed) {

                var selectedValue = $(this).val();
                $.ajax({
                    url: "get_company_branch_wrkemp", 
                    method: "POST",
                    dataType: "json", 
                    data: {wrkempid: selectedValue }, 
                    success: function(data){

                        var company_dropdown = $("#company_id");
                        var branch_dropdown = $("#branch_id");
                        company_dropdown.empty();
                        branch_dropdown.empty();
                        branch_dropdown.append('<option value="">SELECT BRANCH</option>');
                        $.each(data, function(index, emp) {
                            branch_dropdown.append($('<option></option>').attr('value', emp.branch_id).text(emp.branch_name));
                        }); 
                        company_dropdown.append('<option value="">SELECT COMPANY</option>');
                        $.each(data, function(index, emp) {
                            company_dropdown.append($('<option></option>').attr('value', emp.company_id).text(emp.company_name));
                        });

                        isDropdown1Changed = true; 
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log("Error:", error);
                        isDropdown1Changed = false; 
                    }
                });
            }
            else{


                Swal.fire({
                    title: 'You have already choosed company or branch Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        //cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var selectedValue = $(this).val();
                        $.ajax({
                            url: "get_company_branch_wrkemp", 
                            method: "POST",
                            dataType: "json", 
                            data: {wrkempid: selectedValue }, 
                            success: function(data){

                                var company_dropdown = $("#company_id");
                                var branch_dropdown = $("#branch_id");
                                company_dropdown.empty();
                                branch_dropdown.empty();
                                branch_dropdown.append('<option value="">SELECT BRANCH</option>');
                                $.each(data, function(index, emp) {
                                    branch_dropdown.append($('<option></option>').attr('value', emp.branch_id).text(emp.branch_name));
                                }); 
                                company_dropdown.append('<option value="">SELECT COMPANY</option>');
                                $.each(data, function(index, emp) {
                                    company_dropdown.append($('<option></option>').attr('value', emp.company_id).text(emp.company_name));
                                });

                                isDropdown1Changed = true; 
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                console.log("Error:", error);
                                isDropdown1Changed = false; 
                            }
                        });
                        isDropdown1Changed = false; 
                    } else if (result.isDenied) {
                        $("#wrkemp").empty();
                        $("#wrkemp").val('');
                        $.ajax({
                            url: "get_branch_users", 
                            method: "POST",
                            dataType: "json", 
                            //data: {id: selectedValue }, 
                            success: function(data) {

                                var dropdown = $("#emp");
                                var dropdown2 = $("#wrkemp");
                                dropdown.empty();
                                dropdown2.empty();
                                dropdown.append('<option value="">COLLECTION EMPLOYEE</option>');
                                $.each(data, function(index, emp) {
                                    dropdown.append($('<option></option>').attr('value', emp.id).text(emp.name));
                                });
                                dropdown2.append('<option value="0">WORK EMPLOYEE</option>');
                                $.each(data, function(index, emp) {
                                    dropdown2.append($('<option></option>').attr('value', emp.id).text(emp.name));
                                });
                            },
                            error: function(xhr, status, error) {
                                console.log("Error:", error);
                            }
                        });

                        isDropdown1Changed = false;
                        //Swal.fire('Changes are not saved', '', 'info')
                    }
                })



                /*Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: "You have already choosed company or branch"
                });

                $("#wrkemp").empty();
                $("#wrkemp").val('');*/
            }
        });

        var options = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,  // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            dataType:  'json'      ,
            type:      'post' ,
            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true ,       // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 

            // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 

        // bind form using 'ajaxForm' 
        $('#form').ajaxForm(options); 
    }); 

    // pre-submit callback 
    function showRequest(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
        var queryString = $.param(formData); 
        // this.preventDefault();
        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 

        //alert('About to submit: \n\n' + queryString); 

        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
        //return false ;

        return true; 
    } 

    // post-submit callback 
    function showResponse(responseText, statusText, xhr, $form)  { 
        // for normal html responses, the first argument to the success callback 
        // is the XMLHttpRequest object's responseText property 

        // if the ajaxForm method was passed an Options Object with the dataType 
        // property set to 'xml' then the first argument to the success callback 
        // is the XMLHttpRequest object's responseXML property 

        // if the ajaxForm method was passed an Options Object with the dataType 
        // property set to 'json' then the first argument to the success callback 
        // is the json data object returned by the server 
        //  console.log(responseText)  ;
        //  console.log(statusText)  ;
        // console.log($form)  ;

        if(responseText.status == true){
            Swal.fire(
                'Saved Successfully',
                'Thank You.',
                'success'
            )
            $("#amount").val("");
            $("#description").val("");
            $("#remarks").val("");
            document.getElementById("upload_doc_cash_register").value = "";


            $('#datatablesSimple').DataTable().ajax.reload();
        } else{
            Swal.fire({
                icon: 'error',
                title: 'NOT SAVED!',
                text: responseText.message,
                // footer: '<a href="">Why do I have this issue?</a>'
            })
        }
        //console.info(xhr);
        //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
        //     '\n\nThe output div should have already been updated with the responseText.');
    } 

</script>