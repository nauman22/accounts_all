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
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-tachometer-alt "></i> Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Progress...</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4" style="background: #484744 !important;">
                    <div class="card-body" style="text-align: center;">Daily Income
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php  echo @$dashboard['daily_income'][0]['amount']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4" style="    background: #56565e !important">
                    <div class="card-body" style="text-align: center;">Daily Expense
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php echo @$dashboard['daily_expenses'][0]['amount']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4" style="background: #50584d !important;">
                   <div class="card-body" style="text-align: center;">Monthly Income
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php echo @$dashboard['monthly_income'][0]['amount']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>  -->
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4" style="background: #6c4053 !important;">
                   <div class="card-body" style="text-align: center;">Monthly Expense
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php echo @$dashboard['monthly_expenses'][0]['amount']; ?> </p>
                            </div>
                        </div>
                    </div>
                 <!--   <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
             <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4" style="background: #50584d !important;">
                   <div class="card-body" style="text-align: center;">Overall Income
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php echo @$dashboard['overall_income'][0]['amount']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>  -->
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4" style="background: #6c4053 !important;">
                   <div class="card-body" style="text-align: center;">Overall Expense
                        <div class="row">
                            <div class="col">
                               <p class="counter-count"><?php echo @$dashboard['overall_expenses'][0]['amount']; ?> </p>
                            </div>
                        </div>
                    </div>
                 <!--   <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar  me-1"></i>
                        Bar Chart
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa fa-pie-chart me-1"></i>
                        Radar Chart
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>

    </div>
</main>
<script type="text/javascript">
    $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
            }, {
                duration: 5000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
        });
    });
</script>
