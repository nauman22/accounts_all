
<div class="container-fluid">
    <h3 class="text-center text-dark mb-4" style="font-size: 33px;font-family: Nunito, sans-serif;">Tree</h3>
   <div class="row">
   <div class="col-6">
       <ul class="list-group ">
          <?php 
        $tot = 0;
        if(is_array($data['data'])){
            $tot =  count($data['data']);
        }
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Level 1 <span style="color: rgba(0,0,200,0.72);"><?php echo "(".$tot.")"; ?></span></div>
                 <?php 
                 $lvl_1_reward =0;
                 $lvl_2_reward =0;
                 $lvl_3_reward =0;
                 for($j=0; $j<count($reward); $j++){
                 $lvl_1_reward = $reward[$j]['level1_reward'] ;  
                 $lvl_2_reward = $reward[$j]['level2_reward'] ;  
                 $lvl_3_reward = $reward[$j]['level3_reward'] ;  
                 break;
                 }
                 $srno =1;
                 $amount=0;
                 for($i=0; $i<count($data['data']); $i++){
                  echo $data['data'][$i]['username']."<br>";
                  if($data['data'][$i]['status']==2){
                      $amount=$lvl_1_reward;
                  }
                  $srno++;
                  ?>   
                <?php }
       
       
        ?>
            </div>
            <span class="badge bg-primary rounded-pill"><?php echo $amount; ?>$</span>
        </li>
        <?php 
        $tot = 0;
        if(is_array($data['level2'])){
            $tot =  count($data['level2']);
        }
        ?>
           <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Level 2 <span style="color: rgba(0,0,200,0.72);"><?php echo "(".$tot.")"; ?></span></div>
                 <?php 
                   // print_r($data['level2'][0]);
                   // echo count($data['level2'][0]);
                   // echo sizeof($data['level2'][0]);
                  //  exit();
                 $srno =1;
                 $amount=0;
                 for($i=0; $i<count($data['level2']); $i++){
                  echo $data['level2'][$i]['username']."<br>";
                  if($data['level2'][$i]['status']==2){
                      $amount=$lvl_2_reward;
                  }
                  ?>   
                <?php }
       
       
        ?>
            </div>
            <span class="badge bg-primary rounded-pill"><?php echo $amount; ?>$</span>
        </li>
          <?php 
        $tot = 0;
        if(is_array($data['level3'])){
            $tot =  count($data['level3']);
        }
        ?>
         <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Level 3 <span style="color: rgba(0,0,200,0.72);"><?php echo "(".$tot.")"; ?></span></div>
                  <?php 
              
                 $srno =1;
                 $amount=0;
                 for($i=0; $i<count($data['level3']); $i++){
                  echo $data['level3'][$i]['username']."<br>";
                  if($data['level3'][$i]['status']==2){
                      $amount=$lvl_3_reward;
                  }
                  ?>  
                <?php }
       
       
        ?>
            </div>
            <span class="badge bg-primary rounded-pill"><?php echo $amount; ?>$</span>
        </li>

    </ul>
   </div>
   </div>




