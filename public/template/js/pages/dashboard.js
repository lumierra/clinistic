//[Dashboard Javascript]

//Project:	Rhythm Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
		
	var options = {
          series: [{
          name: 'Income',
          data: [76, 85, 101, 98, 87, 105, 91]
        }, {
          name: 'Expense',
          data: [44, 55, 57, 56, 61, 58, 63]
        }],
          chart: {
          type: 'bar',
		  foreColor:"#bac0c7",
          height: 260,
			  toolbar: {
        		show: false,
			  }
        },
        plotOptions: {
          bar: {
			endingShape: 'rounded',
            horizontal: false,
            columnWidth: '50%',
          },
        },
        dataLabels: {
          enabled: false,
        },
		grid: {
			show: false,			
		},
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
		colors: ['#00D0FF', '#3246D3'],
        xaxis: {
          categories: ['10 May', '11 May', '12 May', '13 May', '14 May', '15 May', '16 May'],
			
        },
        yaxis: {
          
        },
		 legend: {
      		show: true,
		 },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          },
			marker: {
			  show: false,
		  },
        }
        };

        var chart = new ApexCharts(document.querySelector("#recent_trend"), options);
        chart.render();
	
	
	var options = {
          series: [
          {
            name: "Income",
			data: [122, 222, 142, 182]
          }
        ],
          chart: {
          height: 100,
          width: 150,
          type: 'area',
          toolbar: {
            show: false
          }
        },
        colors: ['#77B6EA'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
			width: 1,
        },
        grid: {
          show: false,
        },
        yaxis: {
			labels: {
			  show: false
			},
			axisTicks: {
			  show: false
			}
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr'],
			labels: {
			  show: false
			},
			axisTicks: {
			  show: false
			}
        },
        legend: {
          show: false,
        }
        };

        var chart = new ApexCharts(document.querySelector("#balance1"), options);
        chart.render();
	
	
	
	var options = {
          series: [
          {
            name: "Outcome",
			data: [102, 124, 92, 85]
          }
        ],
          chart: {
          height: 100,
          width: 150,
          type: 'area',
          toolbar: {
            show: false
          }
        },
        colors: ['#ee3158'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
			width: 1,
        },
        grid: {
          show: false,
        },
        yaxis: {
			labels: {
			  show: false
			},
			axisTicks: {
			  show: false
			}
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr'],
			labels: {
			  show: false
			},
			axisTicks: {
			  show: false
			}
        },
        legend: {
          show: false,
        }
        };

        var chart = new ApexCharts(document.querySelector("#balance2"), options);
        chart.render();
	
	
	
	
	var options = {
          series: [
          {
            name: "Discharge Patient",
			data: [12, 22, 14, 18, 22 , 13, 17]
          },
          {
            name: "Admit Patient",            
            data: [28, 39, 23, 36, 45, 32, 43]
          }
        ],
          chart: {
          height: 275,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
          toolbar: {
            show: false
          }
        },
        colors: ['#ee3158', '#1dbfc1'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth'
        },
        grid: {
          borderColor: '#e7e7e7',
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        },
        legend: {
          show: false,
        }
        };

        var chart = new ApexCharts(document.querySelector("#overview_trend"), options);
        chart.render();
	
	
	
	var options = {
          series: [30, 25, 30, 25],
          chart: {
          height: 200,
          type: 'polarArea'
        },
        labels: ['Male', 'Female', 'Child', 'Germany'],
        fill: {
          opacity: 1
        },
        stroke: {
          width: 1,
          colors: undefined
        },
        yaxis: {
          show: false
        },
        legend: {
          position: 'right'
        },
		colors: ['#3246D3', '#00D0FF', '#ee3158', '#ffa800'],
        plotOptions: {
          polarArea: {
            rings: {
              strokeWidth: 0
            },
            spokes: {
              strokeWidth: 0
            },
          }
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart432"), options);
        chart.render();
	
	
	// Slim scrolling
  
	  $('.inner-user-div').slimScroll({
		height: '282px'
	  });
  
	  $('.inner-user-div2').slimScroll({
		height: '295px'
	  });
  
	  $('.inner-user-div3').slimScroll({
		height: '200px'
	  });
  
	  $('.inner-user-div4').slimScroll({
		height: '430px'
	  });
	
	var datepaginator = function() {
		return {
			init: function() {
				$("#paginator1").datepaginator()
			}
		}
	}();
	jQuery(document).ready(function() {
		datepaginator.init()
	}); 
	
	
	
	
}); // End of use strict
