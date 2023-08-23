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
                            <form action="insert_branch" id="form" name="form_cat"  method="post" enctype="multipart/form-data">
                                <div class="form-floating mb-3 col-lg-12 col-md-12 col-xs-12">
                                    <select class="form-control" id="company_id" name="company_id"  >
                                        <option value="0">SELECT COMPANY</option>
                                        <?php 
                                        for($i=0; $i<count($company); $i++){
                                            $id = $company[$i]['id'];
                                            $text = $company[$i]['name'];
                                            echo '<option value="'.$id.'">'.$text.'</option>' ;
                                        }
                                        ?>
                                    </select>
                                    <label for="company_id">COMPANY</label>  

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="branch_name" name="branch_name" type="text" placeholder="Branch Name" />
                                            <label for="date">BRANCH NAME</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="user_id" name="user_id"  >
                                                <option value="0">SELECT EMPLOYEE</option>
                                                <?php 
                                                for($i=0; $i<count($user); $i++){
                                                    $id = $user[$i]['id'];
                                                    $text = $user[$i]['name'];
                                                    echo '<option value="'.$id.'">'.$text.'</option>' ;
                                                }
                                                ?>
                                            </select>
                                            <label for="user_id">SELECT EMPLOYEE</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="branch_price" name="branch_price" type="number" placeholder="Branch Price" />
                                            <label for="price">BRANCH PRICE</label>
                                        </div>
                                    </div> 

                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input readonly="readonly" class="form-control" id="monprice" type="text"  />
                                            <label for="monprice">Monthly Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="row_permit_start_date" name="row_permit_start_date" type="date" placeholder="Row Permit Start Date" />
                                            <label for="date">ROW PERMIT START</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="row_permit_end_date" name="row_permit_end_date" type="date" placeholder="Row Permit Last Date" />
                                            <label for="date">ROW PERMIT END</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="tax" name="tax" type="number"  />
                                            <label for="date">Tax %</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" readonly="readonly" id="taxshow" type="text" />
                                            <label for="taxshow">TAX PRICE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="plot_utilization_start_date" name="plot_utilization_start_date" type="date" />
                                            <label for="plot_utilization_start_date">PLOT UTILIZATION START</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="plot_utilization_end_date" name="plot_utilization_end_date" type="date"  />
                                            <label for="plot_utilization_end_date">PLOT UTILIZATION END</label>
                                        </div>
                                    </div> 
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="plot_utilization_price" name="plot_utilization_price" type="number"  />
                                            <label for="plot_utilization_price">PLOT UTILIZATION PRICE</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" readonly="readonly" id="plot_utilization_mon_price" type="number"  />
                                            <label for="plot_utilization_mon_price">PLOT PRICE M/O</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="building_permit_start_date" name="building_permit_start_date" type="date"  />
                                            <label for="building_permit_start_date">BUILDING PERMIT START</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="building_permit_end_date" name="building_permit_end_date" type="date" />
                                            <label for="building_permit_end_date">BUILDING PERMIT END</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="building_permit_price" name="building_permit_price" type="number"  />
                                            <label for="building_permit_price">BUILDING PRICE</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" readonly="readonly" id="building_permit_mon_price"  type="number" />
                                            <label for="date">BUILDING PRICE M/O</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="project_start_date" name="project_start_date" type="date" placeholder="Row Permit Start Date" />
                                            <label for="date">PROJECT ENTRY START</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="project_end_date" name="project_end_date" type="date" placeholder="Row Permit Last Date" />
                                            <label for="date">PROJECT ENTRY END</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="parking_ijari_start_date" name="parking_ijari_start_date" type="date" placeholder="Row Permit Start Date" />
                                            <label for="date">PARKING IJARI START</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 ">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="parking_ijari_end_date" name="parking_ijari_end_date" type="date" placeholder="Row Permit Last Date" />
                                            <label for="date">PARKING IJARI END</label>
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
                                        <label for="inputGroupFile01">UPLOAD DOCUMENTS IF ANY</label> 
                                        <input type="file" class="form-control" name="upload_branches[]" multiple id="upload_branches">


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
                            <th>Image</th>
                            <th>Company</th>
                            <th>Branch</th>
                            <th>Employee</th>
                            <th>Price</th>
                            <th>Row Permit Start</th>
                            <th>Row Permit End</th>
                            <th>Tax</th>
                            <th>Plot Utilization Start</th>
                            <th>Plot Utilization End</th>
                            <th>Plot Price</th>
                            <th>Building Permit Start</th>
                            <th>Building Permit End</th>
                            <th>Building Permit Price</th>
                            <th>Project Start</th>
                            <th>Project End</th> 
                            <th>Parking Ijari Start</th>
                            <th>Parking Ijari End</th>
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


        $("#branch_price").keyup(function(){
            var monprice = $("#branch_price").val()/12;
            $("#monprice").val(monprice );
            $("#monprice").css("background-color", "pink");
            return true;
        });
        $("#plot_utilization_price").keyup(function(){
            var monprice = $("#plot_utilization_price").val()/12;
            $("#plot_utilization_mon_price").val(monprice );
            $("#plot_utilization_mon_price").css("background-color", "yellow");
            return true;
        });
        $("#building_permit_price").keyup(function(){
            var monprice = $("#building_permit_price").val()/12;
            $("#building_permit_mon_price").val(monprice );
            $("#building_permit_mon_price").css("background-color", "cyan");
            return true;
        });
        $("#tax").keyup(function(){

            //tax formula
            /*Tax Rate = 8%
            Tax Rate (in decimal form) = 8% / 100 = 0.08
            Tax Amount = $100 × 0.08 = $8*/


            var TaxRate = $("#tax").val()/100;
            var branch_price = $("#branch_price").val();

            if(branch_price  == "")
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Enter Branch Price First !!!"
                });
                $("#tax").val('');
                $("#branch_price").focus();
                return false;
            }

            var TaxAmount =  branch_price * TaxRate;
            $("#taxshow").val(TaxAmount);
            $("#taxshow").css("background-color", "orange");
            return true;
        });

        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            "ajax":{
                "url": "<?php echo base_url()."branch_table" ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },      

            "columns": [
                { "data": "id" },
                { "data": "image" },
                { "data": "company_id" },
                { "data": "branch_name" },
                { "data": "user_id" },
                { "data": "branch_price" },
                { "data": "row_permit_start_date" },
                { "data": "row_permit_end_date" },
                { "data": "tax" },
                { "data": "plot_utilization_start_date" },
                { "data": "plot_utilization_end_date" },
                { "data": "plot_utilization_price" },
                { "data": "building_permit_start_date" },
                { "data": "building_permit_end_date" },
                { "data": "building_permit_price" },
                { "data": "project_start_date" },
                { "data": "project_end_date" },
                { "data": "parking_ijari_start_date" },
                { "data": "parking_ijari_start_date" },
                { "data": "remarks" },
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