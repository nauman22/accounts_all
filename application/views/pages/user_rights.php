<div id="layoutSidenav_content">
<link rel="stylesheet" href="../css/NSB_Box.css" />

<script src="../js/NSB_Box.js"></script>
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
                        <form action="insert_user_rights" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <select id="userid" name="userid" class="form-control" >
                                    <option value="0">SELECT EMPLOYEE</option>
                                    <?php 
                                    for($i=0; $i<count($user); $i++){
                                        $id = $user[$i]['id'];
                                        $text = $user[$i]['name'];
                                        echo '<option value="'.$id.'">'.$text.'</option>' ;
                                    }
                                    ?>
                                </select>
                                <label for="inputEmail">Select Employee</label>
                            </div>
                            <table  class=" table  table-success table-hover display  responsive nowrap" style=" width:100%!important">
                                <thead>
                                    <tr>
                                        <th>
                                            Menu Name
                                        </th>
                                        <th>
                                            Show Menu
                                        </th>
                                        <th>
                                            Add Record
                                        </th>
                                        <th>
                                            Update Record
                                        </th>
                                        <th>
                                            Delete Record
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i<count($menu_all); $i++){ ?>
                                        <tr>
                                            <td>
                                                <label for="address"><?php echo $menu_all[$i]['name'] ?></label>
                                            </td>
                                            <td><input data-menu_id = '<?php echo $menu_all[$i]['menu_id'] ?>'  data-menu_type="show_menu" id="show_menu-<?php echo $menu_all[$i]['menu_id'] ?>"   type="checkbox" class="checkbox " style="width:25px; height:25px;"></td>
                                            <td><input data-menu_id = '<?php echo $menu_all[$i]['menu_id'] ?>'  data-menu_type="add_record" id="add_record-<?php echo $menu_all[$i]['menu_id'] ?>"   type="checkbox" class="checkbox " style="width:25px; height:25px;"></td>
                                            <td><input data-menu_id = '<?php echo $menu_all[$i]['menu_id'] ?>'  data-menu_type="edit_record" id="edit_record-<?php echo $menu_all[$i]['menu_id'] ?>"   type="checkbox" class="checkbox " style="width:25px; height:25px;"></td>
                                            <td><input data-menu_id = '<?php echo $menu_all[$i]['menu_id'] ?>'  data-menu_type="delete_record" id="delete_record-<?php echo $menu_all[$i]['menu_id'] ?>"  type="checkbox" class="checkbox " style="width:25px; height:25px;"></td>
                                        </tr>

                                        <?php } ?>
                                </tbody>
                            </table>

                            <br>
                            <!--    
                            <div class="form-floating">
                            <div class="form-check">
                            <input class="form-check-input " type="checkbox" value="" id="flexCheckIndeterminate">
                            <label class="form-check-label" for="flexCheckIndeterminate">
                            Indeterminate checkbox
                            </label>
                            </div>
                            </div> -->

                            <div id="output1" class="d-grid gap-2 col-6 mx-auto">

                            </div>
                            <input type="hidden" id="id" name="id">
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <?php } ?>

    </div>
</main>
 <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<script type="text/javascript">
    $(document).ready( function () {
        function uncheck_all(){
            $('input[type="checkbox"]').each(function() {
                this.checked = false;
            });
        }
        $('input[type="checkbox"]').on('change', function() {

            var menu_id = $(this).attr('data-menu_id');
            var menu_type = $(this).attr('data-menu_type');
            var  userid = $("#userid").val();
            var status = $(this).is(":checked");
            //console.log($(this).attr('data-menu_id'))


            if(userid == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Select Employee First',
                    // footer: '<a href="">Why do I have this issue?</a>'
                })
                uncheck_all();
                return false;
            }
            $.ajax({

                url : 'insert_user_rights',
                type : 'POST',
                data : {
                    'userid' :userid ,
                    'menu_id':menu_id,
                    'menu_type':menu_type,
                    'status':status


                },
                dataType:'json',
                success : function(data) { 

                    console.log(data);
                    if(data['status']==true){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Saved Successfully',
                        showConfirmButton: false,
                        timer: 2000 ,
                        toast:true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })    
                    } else{
                        Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'An error occoured!',
                        showConfirmButton: false,
                        timer: 2000 ,
                        toast:true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                    }
                    
                    //alert('Data: '+data);
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            }); 

        });  
        $("#userid").change(function(){
            uncheck_all();

            var  userid = $("#userid").val();
            if(userid == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Select Employee First',
                    // footer: '<a href="">Why do I have this issue?</a>'
                })
                return false;
            }
            $.ajax({

                url : 'get_user_rights',
                type : 'POST',
                data : {
                    'userid' :userid 
                },
                dataType:'json',
                success : function(data) {              
                    console.log(data);

                    for(var i=0; i<data.length; i++){
                        var menu_name = data[i]['name'];  
                        var menuid = data[i]['menu_id']  ;
                        var show_menu = data[i]['show_menu'];
                        var add_record = data[i]['add_record'];
                        var edit_record = data[i]['edit_record'];
                        var delete_record = data[i]['delete_record'];

                        var checkboxname = "#show_menu"+"-"+menuid;
                        console.log($(checkboxname))
                        if(show_menu == "1"){
                            $(checkboxname).prop('checked', true);  
                        }   else{
                            $(checkboxname).prop('checked', false);  
                        }
                        checkboxname = "#add_record"+"-"+menuid
                        if(add_record == "1"){
                            $(checkboxname).prop('checked', true);  
                        }   else{
                            $(checkboxname).prop('checked', false);  
                        }
                        checkboxname = "#edit_record"+"-"+menuid
                        if(edit_record == "1"){
                            $(checkboxname).prop('checked', true);  
                        }   else{
                            $(checkboxname).prop('checked', false);  
                        }
                        checkboxname = "#delete_record"+"-"+menuid
                        if(delete_record == "1"){
                            $(checkboxname).prop('checked', true);  
                        }   else{
                            $(checkboxname).prop('checked', false);  
                        } 


                    }
                    //alert('Data: '+data);
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });   
        }) 



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
            type:      'post'   ,
            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true  ,      // clear all form fields after successful submit 
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