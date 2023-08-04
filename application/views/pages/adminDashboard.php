 <div class="container-fluid">
<form action="adminDashboard" id="form" name="adminDashboard"  method="post" enctype="multipart/form-data"></form>
                    <h3 class="text-dark mb-4">Admin Dashboard</h3>
             <div class="row justify-content-center">
                    <div class="col-md-6 col-xl-3 text-center mb-4" style="width: 250px;">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Deposited</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$<?php echo $query['data'][0]['DepositAmount']; ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>REJECTED</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$<?php echo $query['data'][0]['RejectedAmount']; ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>PENDING</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$<?php echo $query['data'][0]['PendingAmount']; ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="border:1px solid black;">
                    <h3 style="
    text-align: center;
    font-weight: bold;
    color: darkgreen;
"><u>Deposit</u></h3>
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
            <th>Action</th>
          
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
            <td>
            <?php //if($status == 1 || $status == 3){ ?>
            <button type="submit" data-id="<?php echo $data[$i]['id'] ?>" data-action="1" data-type="1"  name="<?php echo "approve_".$data[$i]['id'] ?>" class="btnApprov form-control btn btn-success btn-sm btn-block">Approve</button>
            <button type="submit" data-id="<?php echo $data[$i]['id'] ?>" data-action="2" data-type="1" name="<?php echo "reject_".$data[$i]['id'] ?>" class="btnApprov form-control btn btn-danger btn-sm btn-block">Reject</button>
            <?php // } ?>
            </td>
            
        </tr>
       <?php } ?>
    </tbody>
</table>
  </div>
  <hr>
            <div class="container" style="border:1px solid black;">
                    <h3 style="
    text-align: center;
    font-weight: bold;
    color: darkgreen;
"><u>KYC</u></h3>
                 <table id="kycTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Document Number </th>
            <th>KYC Type</th>
            <th>proof</th>
            <th>Status</th>
            <th>Submited Date</th>
            <th>Action</th>
          
        </tr>
    </thead>
    <tbody>
    <?php // print_r($kyc); exit();
    $srno = 0;
    for($i=0; $i<count($kyc); $i++){
        $srno++;
       // $currency = $data[$i]['currency'] ;
        $username = $kyc[$i]['username'] ;
        $userid = $kyc[$i]['userid'] ;
        $type = $kyc[$i]['type'] ;
        $number = $kyc[$i]['number'] ;
        $submitDate = $kyc[$i]['edate'] ;
        $status = $kyc[$i]['status'] ;
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
        $proof = "../".user_kyc.$kyc[$i]['id'].".jpg?".time();;
    
     ?>
        <tr <?php echo $tr_backgrount; ?>>
            <td><?php echo $srno; ?></td>
            <td><?php echo $userid.$username; ?></td>
            <td><?php echo $number; ?></td>
            <td><?php echo $type; ?></td>
            <td><img src="<?php echo $proof; ?>" class="img-fluid img-thumbnail" style="max-width:100px;"  /> </td>
            <td><?php echo $status_title; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
            <td>
            <button type="submit" data-id="<?php echo $kyc[$i]['id'] ?>" data-action="1" data-type="2" name="<?php echo "approve_".$kyc[$i]['id'] ?>" class="btnApprov form-control btn btn-success btn-sm btn-block">Approve</button>
            <button type="submit" data-id="<?php echo $kyc[$i]['id'] ?>" data-action="2" data-type="2" name="<?php echo "reject_".$kyc[$i]['id'] ?>" class="btnApprov form-control btn btn-danger btn-sm btn-block">Reject</button>
            </td>
            
        </tr>
       <?php } ?>
    </tbody>
</table>
  </div>
  <hr>
            <div class="container" style="border:1px solid black;">
                    <h3 style="
    text-align: center;
    font-weight: bold;
    color: darkgreen;
"><u>Widthdrawl</u></h3>
                 <table id="withDrawTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>User Detail</th>
            <th>Amount Deposit</th>
            <th>Withdrawal Mode</th>
           
            <th>Status</th>
            <th>Submited Date</th>
            <th>Action</th>
          
        </tr>
    </thead>
    <tbody>
    <?php //print_r($data); exit();
    $srno = 0;
    for($i=0; $i<count($withdraw); $i++){
        $srno++;
        $userid = $withdraw[$i]['userid'] ;
        $username = $withdraw[$i]['username'] ;
        $amount = $withdraw[$i]['amount'] ;
        $mode = $withdraw[$i]['type'] ;
        $submitDate = $withdraw[$i]['edate'] ;
        $status = $withdraw[$i]['status'] ;
        $tr_backgrount = "";
        if($mode == 11){
            $mode = "Ref Bonus";
        }
        if($mode == 23){
            $mode = "ROI";
        }
        if($mode == 24){
            $mode = "Affiliate Bonus";
        }
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
        //$proof = "../".user_deposit_img.$data[$i]['id'].".jpg?".time();;
    
     ?>
        <tr <?php echo $tr_backgrount; ?>>
            <td><?php echo $srno; ?></td>
            <td><?php echo $userid."-".$username; ?></td>
            <td><?php echo $amount; ?></td>
            <td><?php echo $mode; ?></td>
            <td><?php echo $status_title; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
            <td>
            <button type="submit" data-id="<?php echo $withdraw[$i]['id'] ?>" data-action="1" data-type="3" name="<?php echo "approve_".$withdraw[$i]['id'] ?>" class="btnApprov form-control btn btn-success btn-sm btn-block">Approve</button>
            <button type="submit" data-id="<?php echo $withdraw[$i]['id'] ?>" data-action="2" data-type="3" name="<?php echo "reject_".$withdraw[$i]['id'] ?>" class="btnApprov form-control btn btn-danger btn-sm btn-block">Reject</button>
 </td>
            
        </tr>
       <?php } ?>
    </tbody>
</table>
  </div>
</form>
            