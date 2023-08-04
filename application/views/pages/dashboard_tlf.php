
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3>
                </div>
                <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Currency</th>
            <th>Plan</th>
            <th>Amount Deposit</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Submited Date</th>
            <th>ROI</th>
          
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
         if($status == 1){
             continue;
         }
        $roi =  number_format((float)$data[$i]['current_roi'] , 2, '.', '');;
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
            <td><?php echo $status_title; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
             <td><?php echo $roi."$"; ?></td>
           
            
        </tr>
       <?php } ?>
    </tbody>
</table>
                
                
            <!--    <div>
                    <div class="row text-nowrap" style="text-align: center;">
                        <div class="col-auto text-center" style="width: 50%;height: 50%;"><label class="form-label">Earning</label>
                            <div style="width: 100%;height: 100%;"><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Revuen&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:[&quot;#7f73f3&quot;,&quot;rgb(255,174,98)&quot;,&quot;rgb(13,228,73)&quot;],&quot;borderColor&quot;:[&quot;rgba(78,115,223,0)&quot;,&quot;rgba(78,115,223,0)&quot;,&quot;rgba(78,115,223,0)&quot;],&quot;data&quot;:[&quot;9800&quot;,&quot;4200&quot;,&quot;100&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;position&quot;:&quot;right&quot;},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;}}}"></canvas></div>
                        </div>
                        <div class="col-auto text-center" style="width: 50%;height: 50%;"><label class="form-label">Package Details (Investor)</label>
                            <div style="width: 100%;height: 100%;"><canvas data-bss-chart="{&quot;type&quot;:&quot;pie&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;January&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:[&quot;rgba(242,1,1,0.6)&quot;,&quot;#8175f1&quot;],&quot;borderColor&quot;:[&quot;rgba(78,115,223,0)&quot;,&quot;rgba(78,115,223,0)&quot;],&quot;data&quot;:[&quot;6250&quot;,&quot;300&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;position&quot;:&quot;left&quot;},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;}}}"></canvas></div>
                        </div>
                    </div>
                </div>
                <div style="height: 80px;">
                    <div class="row"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-xl-3 text-center mb-4" style="width: 250px;">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Deposited</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$40,000</span></div>
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
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>REF.BONUS</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$16,000</span></div>
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
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>TOTAL TEAM</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>3.0</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 text-center mb-4" style="width: 250px;">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>ROI</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$215,000</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Affiliate Bonus</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$0.007</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Team Deposit</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$178.00</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 text-center mb-4" style="width: 250px;">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>LAST ROI</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$8.5</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>withdrawals</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$8.5</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>1'st Level Deposit</span></div>
                                                <div class="text-dark fw-bold h5 mb-0"><span>$8.5</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            