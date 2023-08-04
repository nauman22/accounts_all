<div class="container-fluid">
                    <h3 class="text-center text-dark mb-4" style="font-size: 33px;font-family: Nunito, sans-serif;">Add Plans</h3>
                      <form action="add_plan" id="form" name="add_plan"  method="post" enctype="multipart/form-data">
                    <div>
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Plan Name</span>
                                    <div style="margin-top: 5px;"></div><input type="text" id="planName" name="planName" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                               <div class="row">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-size: 20px;">Currency</label>
                                    <div class="select"><select name="currency" style="font-family: Nunito, sans-serif;padding-left: 0px;font-size: 20px;color: var(--bs-gray-800);" required="">
                                            <optgroup label="Select Current">
                                                <option value="USD" selected="">USD</option>
                                                <option value="TRX">TRX</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Minimum Deposit</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="minDeposit" name="minDeposit" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Maximum Deposit</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="maxDeposit" name="maxDeposit" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Maximum income&nbsp;</span>
                                    <div style="margin-top: 5px;"></div><input type="text" id="maxIncome" name="maxIncome" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Minimum Withdrawal</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="minWithdraw" name="minWithdraw" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">&nbsp;ROI&nbsp;</span>
                                    <div style="margin-top: 5px;"></div><input type="text" id="roi" name="roi" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">&nbsp;Withdrawal fee %</span>
                                    <div style="margin-top: 5px;"></div><input type="text" id="withdrawFee" name="withdrawFee" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1"><button class="btn btn-primary" id="btnAddPlan" type="submit" style="width: 90px;height: 40px;font-size: 20px;font-family: Nunito, sans-serif;">SAVE</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                  </form>
            <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
          
            <th>Plan Name</th>
            <th>Currency</th>
            <th>Min. Deposit</th>
            <th>Max. Deposit</th>
            <th>Max. Income</th>
            <th>Min. Withdraw</th>
            <th>ROI</th>
            <th>Fee</th>
            <th>Submitted Date</th>
            <th>Action</th>
          
        </tr>
    </thead>
    <tbody>
    <?php //print_r($data); exit();
    $srno = 0;
    for($i=0; $i<count($data); $i++){
        $srno++;
     
        $name = $data[$i]['name'] ;
        $currency = $data[$i]['currency'] ;
         $minDeposit = $data[$i]['minDeposit'] ; 
         $maxDeposit = $data[$i]['maxDeposit'] ; 
         $maxIncome = $data[$i]['maxIncome'] ; 
         $minWithdraw = $data[$i]['minWithdraw'] ; 
         $roi = $data[$i]['roi'] ; 
         $fee = $data[$i]['fee'] ; 
        $submitDate = $data[$i]['edate'] ;
        $status = $data[$i]['status'] ;
        $tr_backgrount = "";
        if($status == 1){
            $status_title = '<span class="badge rounded-pill bg-primary">'."ACTIVE"."</span>";
            $tr_backgrount = 'style="    background: #e6f3ff;"';
        } else
        if($status == 2){
            $status_title = '<span class="badge rounded-pill bg-success">'."DELETE"."</span>";
             $tr_backgrount = 'style="    background: #cef5cc;"';
        } else
        if($status == 3){
            $status_title = '<span class="badge rounded-pill bg-danger">'."REJECTED"."</span>";
             $tr_backgrount = 'style="    background: #ffd5d5;"';
        }
        
    
     ?>
        <tr <?php echo $tr_backgrount; ?>>
            <td><?php echo $srno; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $currency; ?></td>
            <td><?php echo $minDeposit; ?></td>
            <td><?php echo $maxDeposit; ?></td>
            <td><?php echo $maxIncome; ?></td>
            <td><?php echo $minWithdraw; ?></td>
            <td><?php echo $roi; ?></td>
            <td><?php echo $fee; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
           <td>  
            <button type="submit" data-id="<?php echo $data[$i]['id'] ?>" data-action="2" data-type="4" name="<?php echo "reject_".$data[$i]['id'] ?>" class="btnApprov form-control btn btn-danger btn-sm btn-block">DELETE</button>
           </td>
           
            
        </tr>
       <?php } ?>
    </tbody>
</table>
            
                           