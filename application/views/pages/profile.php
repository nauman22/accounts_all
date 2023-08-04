<?php //print_r($type); exit(); ?>
<link rel="stylesheet" href="../css/NSB_Box.css" />

<script src="../js/NSB_Box.js"></script>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <br>
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
                            <i class="<?php echo $icon; ?> "></i>  Add / Update 
                        </div>
                        <div class="card-body">
                            <form action="insert_profile" id="form" name="form_staff"  method="post" enctype="multipart/form-data">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!--<label for="inputPassword5" class="form-label">Staff Id.</label>-->
                                        <!--<img src="../assets/img/profile.jpg" class="rounded float-end" alt="...">-->
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">

                                            <input class="form-control" type="text" required id="name" name="name" placeholder="amount">
                                            <label for="name">Name</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="father_name" name="father_name" placeholder="amount">
                                            <label for="father_name">Father's Name</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder=" description" id="cnic" name="cnic">
                                            <label for="cnic">CNIC</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="desig" name="desig" placeholder="amount">
                                            <label for="desig">Designation</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="date" id="dob" name="dob" placeholder="amount">
                                            <label for="dob">DOB</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder=" description" id="cell_no" name="cell_no">
                                            <label for="cell_no">Cell No.</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="guardian_cell" name="guardian_cell" placeholder="amount">
                                            <label for="guardian_cell">Guardian Cell</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="home_cell" name="home_cell" placeholder="amount">
                                            <label for="home_cell">Home Cell No.</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder="description" id="emergency_cell" name="emergency_cell">
                                            <label for="emergency_cell">Emergency Cell No.</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Type Address here" id="address" name="address" style="height: 100px"></textarea>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="number" id="salary" name="salary" placeholder="amount">
                                            <label for="salary">Salary</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="bank_name" name="bank_name" placeholder="amount">
                                            <label for="bank_name">Bank Name</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="number" id="bank_account_no" name="bank_account_no" placeholder="amount">
                                            <label for="bank_account_no">Bank Account No.</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder=" description" id="iban" name="iban">
                                            <label for="iban">Bank IBAN</label>  

                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="password" placeholder="Password" id="pwd" name="pwd">
                                            <label for="pwd">Password</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="note" name="note" placeholder="amount">
                                            <label for="note">NOTE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="description" name="description" placeholder="amount">
                                            <label for="description">Description.</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="email" id="email" name="email" placeholder="amount">
                                            <label for="email">Email</label>  

                                        </div>
                                    </div> 
                                </div>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Type Remarks here" id="remarks" name="remarks" style="height: 100px"></textarea>
                                            <label for="remarks">REMARKS</label>
                                        </div>
                                    </div>
                                </div>
                                <br>


                                <div class="row align-items-center">
                                    <div class="col ">
                                        <label for="inputGroupFile01">UPLOAD IMAGE (.jpg, .png allowed)</label> 
                                        <input  type="file" class="form-control" id="staff_img"  name="staff_img[]">


                                    </div>
                                </div>
                                <br>
                                <div class="row align-items-center">
                                    <div class="col ">
                                        <label for="inputGroupFile01">UPLOAD DOCUMENTS IF ANY</label> 
                                        <input type="file" multiple class="form-control" id="staff_docs" name="staff_docs[]">


                                    </div>
                                </div>
                                <br>

                                <div class="d-grid gap-2 col-6 mx-auto w-100">
                                    <button class="btn btn-success col-xs-12 form-control"  type="submit">Save</button>
                                     <button class="btn btn-danger col-xs-12 form-control" id="btn_cancel" type="button">Cancel</button>

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
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>CNIC</th>
                            <th>Designation</th>
                            <th>Cell</th>
                            <th>Guard. Cell</th>
                            <th>Home Cell</th>
                            <th>Emergency Cell</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Bank Name</th>
                            <th>Bank Account</th>
                            <th>IBAN</th>
                            <th>Note</th>
                            <th>Description</th>
                            <th>Email</th>
                            <th>Remarks</th>
                            <th>DOB</th>
                            <th>Documents</th>
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
        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."profile_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "id" },
                { "data": "image" },
                { "data": "name" },
                { "data": "father_name" },
                { "data": "cnic" },
                { "data": "designation" },
                { "data": "cell" },
                { "data": "guardian_cell" },
                { "data": "home_cell" },
                { "data": "emergency_cell" },
                { "data": "address" },
                { "data": "salary" },
                { "data": "bank_name" },
                { "data": "bank_account" },
                { "data": "iban" },
                { "data": "note" },
                { "data": "description" },
                { "data": "email" },
                { "data": "remarks" },
                { "data": "dob" },
                { "data": "doc" },
                { "data": "buttons" },

            ]     

        });


        
    } );
</script>
<script type="text/javascript">
    // prepare the form when the DOM is ready 
    $(document).ready(function() { 

        var options = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,  // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            dataType:  'json'      ,
            type:      'post'    ,
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

        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 

        //alert('About to submit: \n\n' + queryString); 

        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
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
        console.log(responseText)  ;
        console.log(statusText)  ;
        // console.log($form)  ;

        if(responseText.status == true){
            Swal.fire(
                'Saved Successfully',
                'Thank You.',
                'success'
            )
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