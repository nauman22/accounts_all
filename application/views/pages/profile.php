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
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">
                                            <input class="form-control" type="text" required id="name" name="name">
                                            <label for="name">Name</label>  

                                        </div>
                                    </div>


                                    <div style="display: none;" class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="father_name" name="father_name">
                                            <label for="father_name">Father's Name</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" id="cnic" name="cnic">
                                            <label for="cnic">ID CARD NO</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">

                                            <input class="form-control" type="date"  id="visa_entry_date" name="visa_entry_date">
                                            <label for="visa_entry_date">VISA ENTRY DATE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">

                                            <input class="form-control"  type="date" id="visa_expiry_date" name="visa_expiry_date">
                                            <label for="visa_expiry_date">VISA EXPIRY DATE</label>  

                                        </div>
                                    </div>

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">

                                            <input class="form-control" type="date"  id="labour_entry_date" name="labour_entry_date">
                                            <label for="labour_entry_date">LABOUR ENTRY DATE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="date"  id="labour_expiry_date" name="labour_expiry_date">
                                            <label for="labour_expiry_date">LABOUR EXPIRY DATE</label>  

                                        </div>
                                    </div>

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">

                                            <input class="form-control" type="date"  id="pasport_issue_date" name="pasport_issue_date">
                                            <label for="passport_issue_date">PASPORT ISSUE DATE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="date"  id="pasport_expiry_date" name="pasport_expiry_date">
                                            <label for="pasport_expiry_date">PASPORT EXPIRY DATE</label>  

                                        </div>
                                    </div>

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3 col-xs-12">

                                            <input class="form-control" type="date"  id="id_card_issue_date" name="id_card_issue_date">
                                            <label for="id_card_issue_date">ID CARD ISSUE DATE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="date"  id="id_card_expiry_date" name="id_card_expiry_date">
                                            <label for="name">ID CARD EXPIRY DATE</label>  

                                        </div>
                                    </div>

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="desig" name="desig">
                                            <label for="desig">Designation</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="date" id="dob" name="dob">
                                            <label for="dob">Date of Birth</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder=" description" id="cell_no" name="cell_no">
                                            <label for="cell_no">Cell No.</label>  

                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center" style="display: none;" >
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="guardian_cell" name="guardian_cell">
                                            <label for="guardian_cell">Guardian Cell</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="home_cell" name="home_cell">
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

                                            <input class="form-control" type="number" id="salary" name="salary">
                                            <label for="salary">Salary</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="bank_name" name="bank_name">
                                            <label for="bank_name">Bank Account Name</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="number" id="bank_account_no" name="bank_account_no">
                                            <label for="bank_account_no">Bank Account No.</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" id="iban" name="iban">
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

                                            <input class="form-control" type="text" id="note" name="note">
                                            <label for="note">NOTE</label>  

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="text" id="description" name="description">
                                            <label for="description">Description.</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-floating mb-3">

                                            <input class="form-control" type="email" id="email" name="email">
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
                                
                                    <div class="row align-items-center">
                                    <div class="col">
                                        <div class="form-floating">
                                            <select id="status" name="status" class="form-control">
                                                <option value="1">ACTIVE</option>
                                                <option value="2">DEACTIVE</option>
                                            </select>
                                            <label for="status">STATUS</label>
                                        </div>
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
                            <th>Documents</th>
                            <th>Name</th>
                            
                            <th>Id Card Number</th>
                            <th>Designation</th>

                            <th>visa_entry_date</th>
                            <th>visa_expiry_date</th>
                            <th>labour_entry_date</th>
                            <th>labour_expiry_date</th>
                            <th>pasport_issue_date</th>
                            <th>pasport_expiry_date</th>
                            <th>id_card_issue_date</th>
                            <th>id_card_expiry_date</th>


                            <th>Cell</th>
                            
                            <!--<th>Guard. Cell</th>
                            <th>Home Cell</th>
                            <th>Emergency Cell</th>-->
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Bank Name</th>
                            <th>Bank Account</th>
                            <th>IBAN</th>
                            <th>Note</th>
                            <th>Description</th>
                            <th>Email</th>
                            <th>Remarks</th>
                            
                            <th>Date of Birth</th>
                            <th>Status</th>
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
                { "data": "images" },
                { "data": "doc" },
                { "data": "name" },
                
                { "data": "cnic" },
                { "data": "designation" },

                { "data": "visa_entry_date" },
                { "data": "visa_expiry_date" },
                { "data": "labour_entry_date" },
                { "data": "labour_expiry_date" },
                { "data": "pasport_issue_date" },
                { "data": "pasport_expiry_date" },
                { "data": "id_card_issue_date" },
                { "data": "id_card_expiry_date" },

                { "data": "cell" },
                /*{ "data": "guardian_cell" },
                { "data": "home_cell" },
                { "data": "emergency_cell" },*/
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
                { "data": "status" },
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