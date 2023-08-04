 <div class="container-fluid">
                    <h3 class="text-dark mb-4">Buy Plan</h3>
                    <section id="currency-section">
                            <div class="row">
                                <div class="col-md-6"><label class="col-form-label" style="color: rgb(6,6,6);"><strong>USDT&nbsp; &nbsp;</strong><span style="color: rgb(13,13,13);">TLyVqr3VGcx1cTmmeMQWmDVUAjUM3JwVgq</span><img style="text-align: center;" src="../assets/img/usd.png"></label></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label class="form-label" style="color: rgb(6,6,6);"><strong>TRX&nbsp;</strong> &nbsp;</label><span style="color: rgb(13,13,13);">TLyVqr3VGcx1cTmmeMQWmDVUAjUM3JwVgq</span><img style="text-align: center;" src="../assets/img/rtx.png"></div>
                            </div>
                        </section>
                </div>
                <div>
                <form action="user_deposit" id="form" name="user_deposit"  method="post" enctype="multipart/form-data">
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-size: 20px;">Currency</label>
                                    <div class="select"><select name="currency" id="currency" style="font-family: Nunito, sans-serif;padding-left: 0px;font-size: 20px;color: var(--bs-gray-800);" required="">
                                           <option value="" selected="">Select Currency</option>
                                            <optgroup label="Select Current">
                                                <option value="USD" >USD</option>
                                                <option value="TRX">TRX</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                               <br>
                              <div class="row">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-size: 20px;">Plan</label>
                                    <div class="select"><select name="plan" id="plan" style="font-family: Nunito, sans-serif;padding-left: 0px;font-size: 20px;color: var(--bs-gray-800);" required="">
                                           <option value="">Select Plan</option>
                                            <?php
                                            $usdplan = "";
                                            $trxplan = "";
                                            for($i=0; $i<count($plan); $i++){
                                                if($plan[$i]['currency']== "USD"){
                                                    $usdplan .= "<option value=".$plan[$i]['id']." >".$plan[$i]['name']."</option>";  
                                                } else
                                                if($plan[$i]['currency']== "TRX"){
                                                 $trxplan .= "<option value=".$plan[$i]['id']." >".$plan[$i]['name']."</option>";      
                                                }
                                            }
                                             ?>
                                            <optgroup id="ddlOptgrpUsd" label="Select USD Plan">
                                            <?php echo $usdplan; ?>
                                            </optgroup>
                                            <optgroup id="ddlOptgrpTrx" label="Select TRX Plan">
                                              <?php echo $trxplan; ?>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 27px;">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(1,1,1);font-family: Nunito, sans-serif;font-size: 20px;">Upload Payment Proof (Allow File Types:&nbsp; .JPG , .JPEG , .PNG)<span style="color: rgb(187, 30, 30);">*</span>&nbsp;</label>
                                    <div></div><input type="file" id="Payment-proof" name="file_upload" required="" accept="image/*" >
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Amount Deposit: <span style="color: rgb(228, 47, 47);">*</span></span>
                                    <div style="margin-top: 5px;"></div><input type="nuber" id="txtAmount" name="amount" style="font-size: 20px;width: 200px;height: 40px;" required="" minlength="2" maxlength="100" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Transaction ID: <span style="color: rgb(228, 47, 47);">*</span></span>
                                    <div style="margin-top: 5px;"></div><input name="tran_id" type="text" style="font-size: 20px;width: 200px;height: 40px;" required="" minlength="2" maxlength="100" placeholder="TJS-12255421..">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1"><button class="btn btn-primary" id="kyc-buton" type="submit" style="width: 90px;height: 40px;font-size: 20px;font-family: Nunito, sans-serif;">Submit</button></div>
                            </div>
                        </div>
                    </div>
                       </form>
                       <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Currency</th>
            <th>Plan</th>
            <th>Amount Deposit</th>
            <th>Transaction ID</th>
            <th>proof</th>
            <th>Status</th>
            <th>Submited Date</th>
          
        </tr>
    </thead>
    <tbody>
    <?php //print_r($data); exit();
    $srno = 0;
    for($i=0; $i<count($data); $i++){
        $srno++;
        $currency = $data[$i]['currency'] ;
        $plan_name = $data[$i]['plan_name'] ;
        $amount = $data[$i]['amount'] ;
        $tran_id = $data[$i]['tran_id'] ;
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
        $proof = "../".user_deposit_img.$data[$i]['id'].".jpg?".time();;
    
     ?>
        <tr <?php echo $tr_backgrount; ?>>
            <td><?php echo $srno; ?></td>
            <td><?php echo $currency; ?></td>
            <td><?php echo $plan_name; ?></td>
            <td><?php echo $amount; ?></td>
            <td><?php echo $tran_id; ?></td>
            <td><img src="<?php echo $proof; ?>" class="img-fluid img-thumbnail" style="max-width:100px;"  /> </td>
            <td><?php echo $status_title; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
           
            
        </tr>
       <?php } ?>
    </tbody>
</table>
                </div>
             
            