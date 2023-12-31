<div id="layoutSidenav_content">

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
                            select Options to Generate Report.
                        </div>
                        <div class="card-body">
                            <form action="" id="myform" name="myform" method="post">
                                <!--<div class="form-floating mb-3">
                                <select class="form-control" id="type" name="type"  >
                                <option value="0">SELECT REPORT TYPE</option>
                                <?php 
                                /* for($i=0; $i<count($get_report_type); $i++){
                                $id = $get_report_type[$i]['id'];
                                $text = $get_report_type[$i]['name'];
                                echo '<option value="'.$id.'">'.$text.'</option>' ;
                                } */
                                ?>
                                </select>
                                <label for="type">REPORT TYPE</label>  

                                </div>  -->
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="company" name="company"  >
                                        <option value="0">SELECT COMPANY</option>
                                        <?php 
                                        for($i=0; $i<count($company); $i++){
                                            $id = $company[$i]['id'];
                                            $text = $company[$i]['name'];
                                            echo '<option value="'.$id.'">'.$text.'</option>' ;
                                        }
                                        ?>
                                    </select>
                                    <!--  <label for="type">COMPANY</label>    -->

                                </div>

                                <div class="form-floating mb-3">

                                    <select class="form-control" id="branch_id" name="branch_id">
                                        <option value="">SELECT BRANCH</option>
                                    </select>
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
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="date_from" name="date_from" type="date" placeholder="name@example.com" />
                                    <label for="date_from">Date From</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="date_to" name="date_to" type="date" placeholder="Password" />
                                    <label for="date_to">Date To</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="type" name="type"  >
                                        <option value="0">SELECT TYPE</option>
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
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="account" name="account" >
                                        <option value="0">SELECT ACCOUNT</option>
                                        <?php 
                                        for($i=0; $i<count($account); $i++){
                                            $id = $account[$i]['id'];
                                            $text = $account[$i]['name'];
                                            echo '<option value="'.$id.'">'.$text.'</option>' ;
                                        }
                                        ?>
                                    </select>
                                    <label for="account">ACCOUNT</label>  

                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="head" name="head" >
                                        <option value="0">SELECT HEAD</option>
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
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="category" name="category" >
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


                                <br>

                                <div class="d-grid gap-2 col-6 mx-auto w-100">
                                    <button id="btn_gen_report" name="btn_gen_report" class="btn btn-success col-xs-12 form-control"  type="button">Generate Report</button>
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
                Reports Detail
            </div>
            <div class="card-body">
                <table id="datatablesSimple"  data-ordering="false" class="display responsive nowrap"  style=" width:100%!important">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Bank</th>
                            <th>Head</th>
                            <th>Category</th>
                            <th>Branch</th>
                            <th>Work Employee</th>
                            <th>Collection Employee</th>
                            <th>Mode</th>
                            <th>Remarks</th>
                            <th>Company</th>
                            <th>Serial No.</th>
                            <th>Images</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Amount</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready( function () {
        $('#company, #branch_id, #emp, #wrkemp').select2({
            placeholder: function() {
                if ($(this).attr('id') === 'company') {
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
        });
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

        $("#company").change(function(){

            isDropdown1Changed = false; 
            if (!isDropdown1Changed) {

                var selectedValue = $(this).val();
                $.ajax({
                    url: "get_Company_branches",
                    method: "POST",
                    dataType: "json", 
                    data: {id: selectedValue }, 
                    success: function(data) {

                        var dropdown = $("#branch_id");
                        dropdown.empty();
                        dropdown.append('<option value="">SELECT BRANCH</option>');
                        $.each(data, function(index, branch) {
                            dropdown.append($('<option></option>').attr('value', branch.id).text(branch.branch_name));
                        });
                        //isDropdown1Changed = true; 
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log("Error:", error);
                        isDropdown1Changed = false; 
                    }
                });
            }
        });

        $("#branch_id").change(function(){

            // if (!isDropdown1Changed) {

            var selectedValue = $(this).val();
            $.ajax({
                url: "get_branches_employee", // URL to the server endpoint
                method: "POST",
                dataType: "json", // Expected data type of the response
                data: {id: selectedValue }, 
                success: function(data) {

                    // Populate the dropdown with data from the response

                    var dropdown = $("#wrkemp");

                    dropdown.empty();
                    dropdown.append('<option value="">WORK EMPLOYEE</option>');
                    $.each(data, function(index, emp) {
                        dropdown.append($('<option></option>').attr('value', emp.id).text(emp.name));
                    });
                    isDropdown1Changed = true; 
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log("Error:", error);
                    isDropdown1Changed = false; 
                }
            });
            // }
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

                        var company_dropdown = $("#company");
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
            /*else{


            Swal.fire({
            title: 'You have already choosed company or branch. Choose this option in case you do not know the company and branch. Do you want to save the changes?',
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
            $("#wrkemp").val('');
            }*/
        });


        var company = $('#company').val()
        var branch_id = $('#branch_id').val()
        var wrkemp = $('#wrkemp').val()
        var emp= $('#emp').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        var account = $('#account').val();
        var head =  $('#head').val();
        var category=  $('#category').val();
        var type= $('#type').val();
        var mode = $('#mode').val();


        $("#btn_gen_report").click(function(){

            company = $('#company').val()
            branch_id = $('#branch_id').val()
            wrkemp = $('#wrkemp').val()
            emp= $('#emp').val();
            date_from = $('#date_from').val();
            date_to = $('#date_to').val();
            account = $('#account').val();
            head =  $('#head').val();
            category=  $('#category').val();
            type= $('#type').val();
            mode = $('#mode').val();

            // console.log($('#category').val());
            $('#datatablesSimple').DataTable().ajax.reload();
        })
        // $('#datatablesSimple').DataTable();
        var table =  $('#datatablesSimple').DataTable({
            colReorder: true,
            searching : false,
            /*ordering: false,      */
            bInfo: false,
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', 'All rows' ]
            ],
            iDisplayLength: 10,
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
                "url": "<?php echo base_url()."report_table" ?>",
                "dataType": "json",
                "type": "POST",
                // "data":{  '<?php //echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                "data": function(d){

                    d.form = $("#myform").serializeArray();
                },

                // "data_compay":  $("#myform").serializeArray(),
                /*"company": company,
                "date_from": date_from,
                "date_to": date_to,
                "account": account,
                "head": head,
                "category": category,
                "type": type,
                "mode": mode,
                "emp": emp, */


                // }
            },      

            "columns": [
                { "data": "id" },
                { "data": "date" },
                { "data": "description" },
                { "data": "amount" },
                { "data": "type_name" },
                { "data": "bank_name" },
                { "data": "head_name" },
                { "data": "category_name" },
                { "data": "branch_name" },
                { "data": "work_employee" },
                { "data": "collection_employee" },
                { "data": "mode_name" },
                { "data": "remarks" },
                { "data": "company_name" },
                { "data": "serialNo" },
                { "data": "images" },
            ] ,
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
                $(api.column(2).footer()).html("<b>Total Amount<b>");
                // Sum each of 4 columns, beginning with col[0]:
                for(var i=3; i<=3; i++) {
                    var sum = api.column(i).data().sum();
                    //$(api.column(i).footer()).html("hello");
                    $(api.column(i).footer()).html(sum);
                }

            },
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
                return nRow;
            }, 

        });
        $('a.toggle-vis').on('click', function (e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
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
            type:      'post'     ,
            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true   ,     // clear all form fields after successful submit 
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