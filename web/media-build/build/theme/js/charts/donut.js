$(function(){var e=[],t=3;for(var n=0;n<t;n++)e[n]={label:"Series "+(n+1),data:Math.floor(Math.random()*100)+1};$.plot($("#donut-chart"),e,{colors:["#F90","#222","#777","#AAA"],series:{pie:{innerRadius:.5,show:!0}}})});