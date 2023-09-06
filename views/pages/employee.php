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
                            <form action="insert_employee" id="form" name="form_employee"  method="post" enctype="multipart/form-data">

                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="paid_emp" name="paid_emp"  >
                                                <option value="">SELECT EMPLOYEE</option>
                                                <?php 
                                                for($i=0; $i<count($user); $i++){
                                                    $id = $user[$i]['id'];
                                                    $text = $user[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="paid_emp">PAID BY EMPLOYEE</label> 
                                        </div>
                                    </div>

                                </div> 
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="user_id" name="user_id"  >
                                                <option value="">SELECT EMPLOYEE</option>
                                                <?php 
                                                for($i=0; $i<count($user); $i++){
                                                    $id = $user[$i]['id'];
                                                    $text = $user[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="user_id">RECEIVED BY EMPLOYEE</label> 
                                        </div>
                                    </div>

                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="type" name="type"  >
                                                <option value="">SELECT TYPE</option>
                                                <option value="1">Salary</option>
                                                <option value="2">Loan</option>
                                                <option value="3">Return Loan</option>
                                            </select>
                                            <label>TYPE</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="date" name="date" type="date" />
                                            <label>DATE</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="number" id="amount" name="amount" >
                                            <label for="amount">AMOUNT</label>  

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" id="description" name="description">
                                            <label for="description">DESCRIPTION</label>  
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row align-items-center">
                                    <div class="col ">
                                        <label>UPLOAD DOCUMENTS IF ANY</label> 
                                        <input type="file" multiple class="form-control" id="staff_mgt_docs" name="staff_mgt_docs[]">


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
                            <!-- <th>Employee Id</th>-->
                            <th>Employee Name</th>
                            <!--<th>Type</th>-->
                            <th>Type Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Image</th>
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

        var table =  $('#datatablesSimple').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."employee_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "id" },
                //{ "data": "user_id" },
                { "data": "empname" },
                //{ "data": "type" },
                { "data": "typename" },
                { "data": "date" },
                { "data": "amount" },
                { "data": "description" },
                { "data": "images" },
                { "data": "buttons" },
            ]     
        });
    });
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
            clearForm: true ,       // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
        }; 

        // bind form using 'ajaxForm' 
        $('#form').ajaxForm(options); 
    }); 

    // pre-submit callback 
    function showRequest(formData, jqForm, options) { 

        var queryString = $.param(formData); 
        return true; 
    } 

    // post-submit callback 
    function showResponse(responseText, statusText, xhr, $form)  { 


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

            })
        }
    } 

</script>