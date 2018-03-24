$(function(){
	/* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    
});
function areaChart(){
	var areaChartData = {
        labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label               : 'Laptop',
                data                : [65, 59, 80, 81, 56, 55, 40, 54, 43, 12, 54, 65],
                fillColor           : '#3b8bba',
                strokeColor         : '#3b8bba'
            },
            {
                label               : 'Apple',
                data                : [28, 48, 40, 19, 86, 27, 90, 86, 54, 45, 23, 23],
                fillColor           : '#00a65a',
                strokeColor         : '#00a65a'
            }
        ]
    }

    var outputData = '';
    for (var i=0; i<areaChartData.datasets.length; i++) {
        outputData += '<li style="margin-right: 5px;"><span style="width: 10px; height: 10px; color: #fff; padding: 5px; background-color:' + areaChartData.datasets[i].fillColor + ';">' + areaChartData.datasets[i].label + '</span></li>';
    }

    $('#inputData').html(outputData);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData

    var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    return barChart.Bar(barChartData, barChartOptions);
}

function pieChart(id, value) {
    var quantityChartCanvas = $(id).get(0).getContext('2d');
    var quantityChart       = new Chart(quantityChartCanvas);
    var quantityData        = JSON.parse($(value).val());
    var quantityOptions     = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for quantity charts
        //Number - Amount of animation steps
        animationSteps       : 50,
        //String - Animation easing effect
        animationEasing      : 'ease',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive           : true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio  : true,
        //String - A legend template
        legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create quantity or douhnut chart
    // You can switch between quantity and douhnut using the method below.
    return quantityChart.Doughnut(quantityData, quantityOptions);
}