 <div class="container-fluid">
                    <h3 class="text-dark mb-4">KYC</h3>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="alert alert-danger text-center alert-dismissible" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <h5 class="alert-heading">Please</h5><span style="color: rgb(0,0,0);"><strong>&nbsp;</strong>Upload Your Identification Proof for Further Approval. Thanks</span>
                            </div>
                        </div>
                    </div>
                </div>
                    <form action="user_kyc" id="form" name="user_kyc"  method="post" enctype="multipart/form-data">
                <div>
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-size: 20px;">Select KYC Type</label>
                                    <div class="select"><select name="type" style="font-family: Nunito, sans-serif;padding-left: 0px;font-size: 20px;color: var(--bs-gray-800);" required="">
                                            <optgroup label="Select KYC Type">
                                                <option value="Identity Card with selfie" selected="">Identity Card with selfie</option>
                                                <option value="Passport with selfie">Passport with selfie</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Enter&nbsp;</span><span style="color: var(--bs-primary);font-size: 20px;">Document&nbsp;</span><span style="color: rgb(0,0,0);font-size: 20px;">Number<sup style="font-size: 12px;color: rgb(1,1,1);font-family: Nunito, sans-serif;">&nbsp; Id Card | Passport</sup></span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="kyc-number" name="number" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 27px;">
                                <div class="col offset-1">
                                    <div class="alert alert-info alert-dismissible" role="alert" style="width: 60%;"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <h4 class="alert-heading">Noted</h4><span style="font-size: 14px;text-align: left;"><strong>Upload only one</strong>&nbsp;Id Card Front and back Picture or Passport Picture or Selfie Document Picture&nbsp;</span>
                                    </div><label class="form-label" style="color: rgb(1,1,1);font-family: Nunito, sans-serif;font-size: 20px;">Attach Image File<sup style="font-size: 12px;color: rgb(1, 1, 1);font-family: Nunito, sans-serif;">&nbsp; &nbsp;Id Card | Passport | Selfie Document&nbsp;</sup></label>
                                    <div></div><input type="file" name="file_upload" required="" accept="image/*" multiple="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1"><button class="btn btn-primary" id="kyc-buton" type="submit" style="width: 90px;height: 40px;font-size: 20px;font-family: Nunito, sans-serif;">Submit</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div id="hidden-area-div">
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col offset-1"><label class="form-label" style="font-size: 20px;"><span style="color: rgb(0, 0, 0);">Select KYC Type:&nbsp;</span><br></label><span style="color: var(--bs-link-color);font-size: 20px;">&nbsp; Identity Card&nbsp;</span></div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: var(--bs-black);font-size: 20px;">KYC&nbsp;</span><span style="color: rgb(0,0,0);font-size: 20px;">Number<sup style="font-size: 12px;color: rgb(1,1,1);font-family: Nunito, sans-serif;">&nbsp; Id Card | Passport</sup></span>
                                    <div></div>
                                    <div style="margin-top: 5px;"><span style="font-size: 20px;font-family: Nunito, sans-serif;color: var(--bs-link-color);">3740111122043</span></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1">                <div class="caption v-middle text-center">
                  <?php if($_SESSION['status'] == 2){
                      
                  ?>
                    <h1 class="cd-headline clip">
                        <span class="blc">Your Account is </span>
                        <span class="cd-words-wrapper">
                          <b class="is-visible">Verified.</b>
                         
                        </span>
                      </h1>
                      <?php } ?>
                </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
          
            <th>KYC Type</th>
            <th>ID Number</th>
            <th>Proof</th>
              <th>Submited Date</th>
            <th>Status</th>
          
          
        </tr>
    </thead>
    <tbody>
    <?php //print_r($data); exit();
    $srno = 0;
    for($i=0; $i<count($data); $i++){
        $srno++;
       // $currency = $data[$i]['currency'] ;
        $type = $data[$i]['type'] ;
        $number = $data[$i]['number'] ;
        $submitDate = $data[$i]['edate'] ;
        $status = $data[$i]['status'] ;
        $tr_backgrount = "";
        if($status == 1){
            $status_title = '<span class="badge rounded-pill bg-primary">'."PENDING"."</span>";
            $tr_backgrount = 'style="    background: #e6f3ff;"';
        } else
        if($status == 2){
            $status_title = '<span class="badge rounded-pill bg-success">'."APPROVED"."</span>";
             $tr_backgrount = 'style="    background: #cef5cc;"';
        } else
        if($status == 3){
            $status_title = '<span class="badge rounded-pill bg-danger">'."REJECTED"."</span>";
             $tr_backgrount = 'style="    background: #ffd5d5;"';
        }
        $proof = "../".user_kyc.$data[$i]['id'].".jpg?".time();;
    
     ?>
        <tr <?php echo $tr_backgrount; ?>>
            <td><?php echo $srno; ?></td>
           
            <td><?php echo $type; ?></td>
            <td><?php echo $number; ?></td>
            <td><img src="<?php echo $proof; ?>" class="img-fluid img-thumbnail" style="max-width:100px;"  /> </td>
            <td><?php echo $status_title; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
           
            
        </tr>
       <?php } ?>
    </tbody>
</table>
            