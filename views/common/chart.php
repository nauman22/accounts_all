<script type="text/javascript">
window.onload = function() {// Set new default font family and font color to mimic Bootstrap's default styling
//Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
//Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx_ = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx_, {
  type: 'pie',
  
  data: {
    labels: <?php   echo json_encode($pie_category_name);  ?>,
    datasets: [{
      data:  <?php   echo json_encode($pie_amount);  ?>,
      backgroundColor: <?php   echo json_encode($pie_color);  ?>,
    }],
  },
  options: {
    legend: {
        display: true
    },
     responsiveAnimationDuration: 6000,
           /* barStrokeWidth : 1,
            responsive: true,
            maintainAspectRatio: false,
            barShowStroke: false,
            tooltips: {
               titleFontSize: 12,
            },*/
    
   
} 
});

var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php   echo json_encode($pie_category_name);  ?>,
    datasets: [{
      label: "",
      backgroundColor: <?php   echo json_encode($pie_color);  ?>,
      borderColor:<?php   echo json_encode($pie_color);  ?>,
      data:<?php   echo json_encode($pie_amount);  ?>,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    } ,
     animations: {
            tension: {
                duration: 1200,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
  }
});
//ctx_.defaults.global.animation.duration = 3000;
var ctx = document.getElementById("myDougChart");
var myLineChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?php   echo json_encode($pie_category_name);  ?>,
    datasets: [{
      label: "",
      backgroundColor: <?php   echo json_encode($pie_color);  ?>,
      borderColor:<?php   echo json_encode($pie_color);  ?>,
      data:<?php   echo json_encode($pie_amount);  ?>,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    } ,
     animations: {
            tension: {
                duration: 1200,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
  }
});

var ctx = document.getElementById("myLineChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?php   echo json_encode($pie_category_name);  ?>,
    datasets: [{
      label: "",
      backgroundColor: <?php   echo json_encode($pie_color);  ?>,
      borderColor:<?php   echo json_encode($pie_color);  ?>,
      data:<?php   echo json_encode($pie_amount);  ?>,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    } ,
     animations: {
            tension: {
                duration: 1200,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
  }
});

var ctx = document.getElementById("myRadarChart");
var myLineChart = new Chart(ctx, {
  type: 'radar',
  data: {
    labels: <?php   echo json_encode($pie_category_name);  ?>,
    datasets: [{
      label: "",
      backgroundColor: <?php   echo json_encode($pie_color);  ?>,
      borderColor:<?php   echo json_encode($pie_color);  ?>,
      data:<?php   echo json_encode($pie_amount);  ?>,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    } ,
     animations: {
            tension: {
                duration: 1200,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
  }
});
} 
</script>