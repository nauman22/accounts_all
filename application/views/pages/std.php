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
                        <form action="insert_form_std" id="form" name="form_std"  method="post" enctype="multipart/form-data">
                            <label for="inputPassword5" class="form-label">Std Id.</label>

                            <div class="form-floating mb-3 col-lg-12 col-md-12 col-xs-12">
                                <select class="form-control" id="class" name="class"  >
                                    <option value="0">SELECT CLASS</option>
                                 <!--   <?php 
                                    /*for($i=0; $i<count($company); $i++){
                                        $id = $company[$i]['id'];
                                        $text = $company[$i]['name'];
                                        echo '<option value="'.$id.'">'.$text.'</option>' ;
                                    }*/
                                    ?>  -->
                                    <option value="PG">PG</option>
                                    <option value="NURSERY">NURSERY</option>
                                    <option value="PREP">PREP</option>
                                    <option value="ONE">ONE</option>
                                    <option value="TWO">TWO</option>
                                    <option value="THREE">THREE</option>
                                    <option value="FOUR">FOUR</option>
                                    <option value="FIVE">FIVE</option>
                                    <option value="SIX">SIX</option>
                                    <option value="SEVEN">SEVEN</option>
                                    <option value="9TH JUNIOR">9TH JUNIOR</option>
                                    <option value="NINE">NINE</option>
                                    <option value="TEN">TEN</option>
                                </select>
                                <label for="company_id">CANDIDATE CLASS</label>  

                            </div>

                            
                             <div class="row align-items-center">
                               <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="name" name="name">
                                        <label for="description">CANDIDATE NAME </label>  

                                    </div>
                                </div>
                                 <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="fname" name="fname">
                                        <label for="description">CANDIDATE FATHER NAME </label>  

                                    </div>
                                </div>
                                     <div class="col-lg-4 col-md-4 col-xs-12 ">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="dob" name="dob" type="date" placeholder="name@example.com" />
                                        <label for="date">DOB</label>
                                    </div>
                                </div>
                                </div>
                                <div class="row align-items-center">
                               <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="bform" name="bform">
                                        <label for="description">CANDIDATE BFORM </label>  

                                    </div>
                                </div>
                                 <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="fnic" name="fnic">
                                        <label for="description">CANDIDATE FATHER CNIC </label>  

                                    </div>
                                </div>
                                     <div class="col-lg-4 col-md-4 col-xs-12 ">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="adm_date" name="adm_date" type="date" placeholder="name@example.com" />
                                        <label for="date">ADMISSION DATE</label>
                                    </div>
                                </div>
                                </div>
                                <div class="row align-items-center">
                                 <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="cell" name="cell">
                                        <label for="description">CELL NO. </label>  

                                    </div>
                                </div>
                               <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="section" name="section">
                                        <label for="description">CLASS SECTION </label>  

                                    </div>
                                </div>
                                 <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Name according to BFORM" id="remarks" name="remarks">
                                        <label for="description">REMARKS </label>  

                                    </div>
                                </div>

                                <div class="row align-items-center">
                                 <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="number" placeholder="Candidate FEE" id="reqFee" name="reqFee">
                                        <label for="description">REQUIRED FEE</label>  

                                    </div>
                                </div>
                                 <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="Candidate Address" id="address" name="address">
                                        <label for="description">ADDRESS</label>  

                                    </div>
                                </div>
                                </div>
                                 <div class="row align-items-center">
                                 <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="FATHER OCCUPATION" id="father_occouption" name="father_occouption">
                                        <label for="description">FATHER OCCUPATION</label>  

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-floating mb-3">
                                    <select class="form-control" id="status" name="status">
                                    <option value="0">Select One</option>
                                    <option value="1">Struck OFF</option>
                                    <option value="2">Quit</option>
                                    <option value="3">Leave wiht all dues paid</option>
                                    </select>
                                        <label for="status">Status</label>  

                                    </div>
                                </div>
                                </div>
                              <br>
                                <div class="row align-items-center">
                                <div class="col-lg-12 col-md-12 col-xs-12 ">
                                    <label for="inputGroupFile01">UPLOAD CANDIDATE IMAGE</label> 
                                    <input type="file" class="form-control" name="upload_doc_std_img[]"  id="upload_doc_std_img">


                                </div>
                            </div>   
                            <br>
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-md-12 col-xs-12 ">
                                    <label for="inputGroupFile01">UPLOAD DOCUMENTS IF ANY</label> 
                                    <input type="file" class="form-control" name="upload_doc_std_doc[]" multiple id="upload_doc_std_doc">


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
                            <th>CLASS</th>
                            <th>Std Name</th>
                            <th>Father Name</th>
                            <th>DOB</th>
                            <th>BFORM</th>
                            <th>FNIC</th>
                            <th>ADDRESS</th>
                            <th>ADM. DATE</th>
                            <th>Monthly Fee</th>
                            <th>CELL NO.</th>
                            <th>SECTION</th>
                            <th>REMARKS</th>
                            <th>FATHER OCCUPATION</th>
                            <th>PIC</th>
                            <th>DOCS</th>
                            <th>STATUS</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js" crossorigin="anonymous"></script>
  
<link rel="stylesheet" href="../css/NSB_Box.css" />
<script src="../js/NSB_Box.js"></script>
<script type="text/javascript">
   
    $(document).ready( function () {
        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            colReorder: true,
            lengthMenu: [
                [ 10, 25, 50, 100, 200, 500,1000, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows','200 rows','500 rows','1000 rows', 'All rows' ]
            ],
            dom: 'Bfrtip',
            buttons: [
                'pageLength', 
                { extend: 'copyHtml5', footer: true,
                exportOptions: {
                        columns: ':visible'

                    }},
                { extend: 'excelHtml5', footer: true,
                exportOptions: {
                        columns: ':visible'

                    }},
                { extend: 'csvHtml5', footer: true, 
                exportOptions: {
                        columns: ':visible'

                    }},
                { extend: 'pdfHtml5', footer: true ,
                orientation: 'landscape',
                pageSize: 'A4',
                 exportOptions: {
                        columns: ':visible'

                    }
                } ,
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'

                    }
                },
                'colvis'
                /* 'copy', 'csv', 'excel', 'pdf', 'print' */
            ],
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."std_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },      

            "columns": [
                { "data": "id" },
                { "data": "class" },
                { "data": "name" },
                { "data": "fname" },
                { "data": "dob" },
                { "data": "bform" },
                { "data": "fnic" },
                { "data": "address" },
                
                { "data": "adm_date" },
                { "data": "reqFee" },
                { "data": "cell" },
                { "data": "section" },
                  { "data": "remarks" },
                  { "data": "father_occouption" },
                  { "data": "pic" },
                { "data": "doc" },
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
            type:      'post' ,
            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            //clearForm: true ,       // clear all form fields after successful submit 
           // resetForm: true        // reset the form after successful submit 

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
             document.getElementById("upload_doc_std_img").value = "";
             document.getElementById("upload_doc_std_doc").value = "";
             
            
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