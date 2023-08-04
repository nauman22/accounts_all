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
                            <form action="std_fee_list" id="form" name="form_std_fee"  method="post" enctype="multipart/form-data">
                                <label for="inputPassword5" class="form-label">Ledger No.</label>



                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-4 col-xs-12 ">
                                        <div class="form-floating mb-3">
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
                                    </div> 


                                    <div class="col-lg-4 col-md-4 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="year" name="year"  >
                                                <option value="0">SELECT YEAR</option>
                                                <?php 
                                                $year = date("Y"); 
                                                for($i=0; $i<5; $i++){

                                                    echo '<option value="'.$year.'">'.$year.'</option>' ;
                                                    $year--;
                                                }
                                                ?>
                                            </select>
                                            <label for="type">SELECT YEAR</label>  

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="month" name="month" >
                                                <option value="0">SELECT MONTH</option>
                                                <?php 
                                                for ($m=1; $m<=12; $m++) {
                                                    $month = strtoupper(date('F', mktime(0,0,0,$m, 1, date('Y'))));
                                                     echo '<option value="'.$month.'">'.$month.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="account">SELECT MONTH</label>  

                                        </div>
                                    </div>
                                </div>


                                <br>

                                <div class="d-grid gap-2 col-6 mx-auto w-100">
                                    <button class="btn btn-success col-xs-12 form-control"  type="submit">SHOW LIST</button>
                                    <button class="btn btn-primary col-xs-12 form-control btnDownloadFeedetail"  type="button">DOWNLOAD FEE DETAIL REPORT</button>
                                    <button class="btn btn-danger col-xs-12 form-control btnDownloadFeeNotPaid"  type="button">DOWNLOAD FEE NOT PAID CANDIDATES REPORT</button>
                                    <button class="btn btn-info col-xs-12 form-control btnDownloadFeeOverAll"  type="button">DOWNLOAD OVER ALL REPORT</button>

                                </div>
                                <div id="output1" class="d-grid gap-2 col-12 mx-auto table-responsive">
                                
                                  <table id="tblfee" class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">image</th>
      <th scope="col">Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">DOB</th>
      <th scope="col">Address</th>
      <th scope="col">Required Fee</th>
      <th scope="col">Fee</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
    
  </tbody>
</table>
                               
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
<script type="text/javascript">

    $(document).ready( function () {
        // $('#datatablesSimple').DataTable();
       
       $('#tblfee').DataTable({
                 rowReorder: {
            selector: 'td:nth-child(1)',
            selector: 'td:nth-child(2)',
            selector: 'td:nth-child(5)'
        },
        responsive: true
            }) ;
    } );
</script>
<script type="text/javascript">
    // prepare the form when the DOM is ready 
    $(document).ready(function() { 
       var options = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSerialize: function($form, options) { 
                 var class_ = $("#class").val();
         if(class_ =="0"){
              Swal.fire({
                icon: 'error',
                title: 'Select Class!',
                text: "Please Select Class First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
         }
         var year = $("#year").val();
          if(year == "0"){
              Swal.fire({
                icon: 'error',
                title: 'Select Year!',
                text: "Please Select Year First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
         }
            var month = $("#month").val();
              if(month =="0"){
              Swal.fire({
                icon: 'error',
                title: 'Select Month!',
                text: "Please Select Month First",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            return false;
         }
        //return false; 
            } ,
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
       // var queryString = $.param(formData); 
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
          console.log(responseText)  ;
          console.log(statusText)  ;
         console.log($form)  ;

        if(responseText){
          /*  Swal.fire(
                'Saved Successfully',
                'Thank You.',
                'success'
            )   */
            var sr = 1;
            var year = $("#year").val();
            var month = $("#month").val();
            $("#tblfee tbody  tr").remove();
            for(var i=0; i<responseText.length; i++){
                console.log(responseText[i]['fee_detail'])
               $("#tblfee")
               .append('<tr><th scope="row">'+sr+'</th><td><img style="width:90px" src = "'+responseText[i]['img']+'"</td><td>'+responseText[i]['name']+'</td><td>'+responseText[i]['fname']+'</td><td>'+responseText[i]['dob']+'</td><td>'+responseText[i]['address']+'</td><td>'+responseText[i]['reqFee']+'</td><td><input type="number" id="fee_'+responseText[i]['id']+'" value="'+responseText[i]['fee']+'" /> <br><p class="text-success"> Enter Date: '+responseText[i]['fee_edate']+'</p></td><td><input type="button" class="btnfeesubmit btn btn-success btn-block btn-lg " value="Save" data-stdid="'+responseText[i]['id']+'" data-year="'+year+'" data-month="'+month+'" /></td></tr>');
                sr++;
                console.log(responseText[i]['id']);
            }
            
            $("#amount").val("");
            $("#description").val("");
            $("#remarks").val("");
           // document.getElementById("upload_doc_cash_register").value = "";

            
           // $('#datatablesSimple').DataTable().ajax.reload();
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