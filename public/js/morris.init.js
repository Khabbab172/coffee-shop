/*

Template:  Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template
Author: bayyan.in
Design and Developed by: bayyan.in

NOTE: 

*/

(function($){
"use strict";

$(document).ready(function() {
 /*************************
     Line chart
*************************/ 
if ($('#morris-line').exists()) {
    Morris.Line({
      element: 'morris-line',
      data: [
        { y: '2011', a: 50, b: 40 },
        { y: '2012', a: 75,  b: 65 },
        { y: '2013', a: 50,  b: 40 },
        { y: '2014', a: 75,  b: 65 },
        { y: '2015', a: 50,  b: 40 },
        { y: '2016', a: 75,  b: 65 },
        { y: '2017', a: 60,  b: 50 }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Series A', 'Series B'],
      fillOpacity: ['0.1'],
      pointFillColors:['#ffffff'],
      pointStrokeColors:['#999999'],
      behaveLikeLine: true,
      gridLineColor: '#efefef',
      hideHover: 'auto',
      lineWidth: '3px',
      pointSize: 0,
      preUnits: '$',
      resize: true,
      lineColors:['#dc3545 ', '#17a2b8']
    });
}
  /*************************
     Bar chart
*************************/    
if ($('#morris-bar').exists()) {
    Morris.Bar({
        element: 'morris-bar',
        data: [
            { y: '2012', a: 142,  b: 155 , c: 165 },
            { y: '2013', a: 160,  b: 150 , c: 135 },
            { y: '2014', a: 185,  b: 195 , c: 166 },
            { y: '2015', a: 190, b: 205 , c: 185 },
            { y: '2016', a: 210, b: 180 , c: 175 },
            { y: '2017', a: 190, b: 180 , c: 195 },
            { y: '2018', a: 180, b: 190 , c: 200 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['WordPress', 'HTML5', 'eCommerce'],
        hideHover: 'auto',
        resize: true,
        gridLineColor: '#efefef',
        barSizeRatio: 0.4,
        xLabelAngle: 35,
        barColors: ['#ffc107','#28a745', '#17a2b8']
    });
}

  /*************************
     Area chart
*************************/   
if ($('#morris-area').exists()) {
    Morris.Area({
            element: 'morris-area',
            pointSize: 0,
            lineWidth: 0,
            data: [
                { y: '2011', a: 50, b: 60 },
                { y: '2012', a: 75,  b: 55 },
                { y: '2013', a: 40,  b: 60 },
                { y: '2014', a: 65,  b: 75 },
                { y: '2015', a: 60,  b: 50 },
                { y: '2016', a: 75,  b: 85 },
                { y: '2017', a: 40, b: 50 },
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            hideHover: 'auto',
            resize: true,
            gridLineColor: '#efefef',
            lineColors: ['#17a2b8', "#e6e6e6"]
        });
}
/*************************
     Bar chart stacked
*************************/  
if ($('#morris-bar-stacked').exists()) {
    Morris.Bar({
            element: 'morris-bar-stacked',
            data: [
                { y: 'Jan-19', a: 90,  b: 10},
                { y: 'Feb-19', a: 85,  b: 6 },
                { y: 'Mar-19', a: 60,  b: 9 },
                { y: 'Apr-19', a: 85,  b: 15 },
                { y: 'May-19', a: 90, b: 1 },
                { y: 'Jun-19', a: 100, b: 16 },
                { y: 'Jul-19', a: 85, b: 20 },
                { y: 'Aug-19', a: 95,  b: 25 },
                { y: 'Sep-19', a: 55,  b: 3 },
                { y: 'Oct-19', a: 45,  b: 7 },
                { y: 'Nov-19', a: 25,  b: 9 },
                { y: 'Dec-19', a: 15,  b: 3 },
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            stacked: true,
            labels: ['Received', 'Failed'],
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#efefef',
            barColors: ['#84ba3f','#dc3545']
        });
    }
/*************************
    Area chart with point
*************************/  
if ($('#morris-area-dotted').exists()) {
    Morris.Area({
            element: 'morris-area-dotted',
            pointSize: 3,
            lineWidth: 1,
            data: [
                { y: '2011', a: 30, b: 40 },
                { y: '2012', a: 55,  b: 60 },
                { y: '2013', a: 60,  b: 50 },
                { y: '2014', a: 70,  b: 65 },
                { y: '2015', a: 50,  b: 60 },
                { y: '2016', a: 55,  b: 75 },
                { y: '2017', a: 80, b: 70 }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            hideHover: 'auto',
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['#999999'],
            resize: true,
            smooth: false,
            gridLineColor: '#efefef',
            lineColors: ['#17a2b8', "#e6e6e6"]
        });
}
/*************************
    Donut chart
*************************/  
if ($('#morris-donut').exists()) {
        Morris.Donut({
                element: 'morris-donut',
                data: [
                    {label: "Masjid Donation", value: 6444},
                    {label: "Fitra ", value: 2683},
                    {label: "Parking Construction", value: 1747},
                    {label: "Friends of ICJC", value: 8426},
                    {label: "Sadqa", value: 4915},
                    {label: "Community Iftar", value: 4932},
                    {label: "Eid Fair", value: 6414},
                    {label: "Friday Sale", value: 6294},
                    {label: "Quran School", value: 9932},
                    {label: "Sunday School", value: 8129}
                ],
                resize: true,
                colors: ['#e6b0aa','#633974', '#5dade2', "#82e0aa",'#f39c12','#f9e79f', '#117a65', "#dc3545",'#84ba3f','#ffc107']
            });
}
});
})(jQuery);