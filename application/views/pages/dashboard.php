<style type="text/css">
    .counter
    {
        background-color: #eaecf0;
        text-align: center;
    }
    .employees,.customer,.design,.order
    {
        margin-top: 70px;
        margin-bottom: 70px;
    }
    .counter-count
    {
        font-size: 46px;
        /* background-color: #00b3e7;
        border-radius: 50%; */
        position: relative;
        /*color: #ffffff;*/
        text-align: center;
        /*line-height: 92px;
        width: 92px;
        height: 92px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;*/
        display: inline-block;
    }

    .employee-p,.customer-p,.order-p,.design-p
    {
        font-size: 24px;
        color: #000000;
        line-height: 34px;
    }
</style>
<link rel="stylesheet" type="text/css" href="../assets/multiselect/css/style.css"> 

<div id="layoutSidenav_content">
<main style="background: cadetblue !important;">
    <form action="#" type="post" id="myform"></form>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-tachometer-alt "></i> Dashboard Expenses <?php 
            $monthNum  = $_GET['month'];
            if($monthNum){
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F'); 
                echo $monthName;   
            }   else{
                $monthNum = date('F',strtotime('first day of this month'));
                //$dateObj   = DateTime::createFromFormat('!m', $monthNum);
                //$monthName = $dateObj->format('F'); 
                echo $monthNum;
            }

        // March ?></h1>


        <div class="row">

            <div class="col-lg-8 col-md-8 col-xl-8 col-sm-12">
                <table class="table table-success table-striped table-hover table-sm table-bordered" border="1">
                    <thead>
                        <tr>
                            <th>
                                Category
                            </th>

                            <th>
                                Amount
                            </th>
                            <th>
                                percentage
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php   for($i=0; $i<count($dashboard['cat_data']); $i++){  ?>
                            <tr>
                                <td>
                                    <?php echo $dashboard['cat_data'][$i]['name']; ?>
                                </td>
                                <td>
                                    <?php echo $dashboard['cat_data'][$i]['amount_']; ?>
                                </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="<?php echo (round(($dashboard['cat_data'][$i]['amount_']/$dashboard['cat_data_sum'][0]['amount_']*100),2)); ?>" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                            <?php echo (round($dashboard['cat_data'][$i]['amount_']/$dashboard['cat_data_sum'][0]['amount_']*100,2)); ?>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <b>Total</b>
                            </td>
                            <td>
                                <b><?php echo $dashboard['cat_data_sum'][0]['amount_']; ?></b>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar  me-1"></i>
                        Expense Inforamtion in Visulaized form
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart"></canvas>
                        <hr>
                        <canvas id="myBarChart" ></canvas>
                        <hr>
                        <canvas id="myLineChart" ></canvas>
                        <hr>
                        <canvas id="myDougChart" ></canvas>
                        <hr>
                        <canvas id="myRadarChart" ></canvas>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12">
                <button class="btn_month btn btn-primary btn-block " data-val="1" >JANUARY</button>
                <button class="btn_month btn btn-primary btn-block " data-val="2">FEBRUARY</button>
                <button class="btn_month btn btn-primary btn-block " data-val="3">MARCH</button>
                <button class="btn_month btn btn-primary btn-block " data-val="4">APRIL</button>
                <button class="btn_month btn btn-primary btn-block " data-val="5">MAY</button>
                <button class="btn_month btn btn-primary btn-block " data-val="6">JUNE</button>
                <button class="btn_month btn btn-primary btn-block " data-val="7">JULY</button>
                <button class="btn_month btn btn-primary btn-block " data-val="8">AUGUST</button>
                <button class="btn_month btn btn-primary btn-block " data-val="9">SEPTEMBER</button>
                <button class="btn_month btn btn-primary btn-block " data-val="10">OCTOBER</button>
                <button class="btn_month btn btn-primary btn-block " data-val="11">NOVEMBER</button>
                <button class="btn_month btn btn-primary btn-block " data-val="12">DECEMBER</button>
                <hr>
                <canvas id="myBarChartExpense" ></canvas>     
                <hr>
                <canvas id="myBarChartOverAll" ></canvas>                       

            </div>
        </div>


    </div>
</main>

