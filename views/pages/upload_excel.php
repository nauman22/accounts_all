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
                        <i class="<?php echo $icon; ?>"></i>
                        Add / Update 
                    </div>
                    <div class="card-body">
                        <form action="excel_read" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                             <label for="inputEmail">Upload Excel File</label>
                            <div class="input-group mb-3">
                                <input class=" form-control" id="uploadFile" name="uploadFile" required="required" type="file" placeholder="name@example.com" />
                               
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
                            <th>Name</th>
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
        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."mode_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "description" },
                { "data": "remarks" },
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
