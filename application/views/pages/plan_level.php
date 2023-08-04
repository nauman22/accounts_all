<div class="container-fluid">
                    <h3 class="text-center text-dark mb-4" style="font-size: 33px;font-family: Nunito, sans-serif;">Level Reward</h3>
                      <form action="add_reward_level" id="form" name="add_reward_level"  method="post" enctype="multipart/form-data">
                    <div>
                    <div class="row g-0 text-start justify-content-center">
                      <div>
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Reward Name</span>
                                    <div style="margin-top: 5px;"></div><input type="text" id="rewardName" name="rewardName" class="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Level 1 Reward&nbsp;&nbsp;</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="level1_reward" name="level1_reward" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Level 2 Reward</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="level2_reward" name="level2_reward" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Level 3 Reward&nbsp;&nbsp;</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="level3_reward" name="level3_reward" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;" required="">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1"><button class="btn btn-primary" id="btnAddRewardLevel" type="submit" style="width: 90px;height: 40px;font-size: 20px;font-family: Nunito, sans-serif;">SAVE</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                  </form>
            <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Sr.No</th>
          
            <th>Reward Name</th>
            <th>Level 1 Reward</th>
            <th>Level 2 Reward</th>
            <th>Level 3 Reward</th>
            <th>Submitted Date</th>
            <th>Action</th>
          
        </tr>
    </thead>
    <tbody>
    <?php //print_r($data); exit();
    $srno = 0;
    for($i=0; $i<count($data); $i++){
        $srno++;
     
        $name = $data[$i]['rewardName'] ;
        $level1_reward = $data[$i]['level1_reward'] ;
        $level2_reward = $data[$i]['level2_reward'] ;
        $level3_reward = $data[$i]['level3_reward'] ;
       
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
            <td><?php echo $level1_reward; ?></td>
            <td><?php echo $level2_reward; ?></td>
            <td><?php echo $level3_reward; ?></td>
            <td><?php echo date("d-m-Y h:m:s a ",strtotime($submitDate)); ?></td>
           <td>  
            <button type="submit" data-id="<?php echo $data[$i]['id'] ?>" data-action="2" data-type="5" name="<?php echo "reject_".$data[$i]['id'] ?>" class="btnApprov form-control btn btn-danger btn-sm btn-block">DELETE</button>
           </td>
           
            
        </tr>
       <?php } ?>
    </tbody>
</table>
            
                           