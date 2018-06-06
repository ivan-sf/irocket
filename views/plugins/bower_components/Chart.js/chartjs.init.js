$( document ).ready(function() {
    var valor4 = $("#valor4").val();
    var valor5 = $("#valor5").val();
    var valor6 = $("#valor6").val();
    var ctx4 = document.getElementById("chart4").getContext("2d");
    var data4 = [
        {
            value: valor4,
            color:"#ff7961",
            highlight: "#ff7961",
            label: "Gastos diarios"
        },
        {
            value: valor5,
            color: "#4caf50",
            highlight: "#4caf50",
            label: "Ingresos diarios"
        },
        {
            value: valor6,
            color: "#2196f3",
            highlight: "#2196f3",
            label: "Balance diario"
        }
    ];
    
    var myDoughnutChart = new Chart(ctx4).Doughnut(data4,{
        segmentShowStroke : true,
        segmentStrokeColor : "#fff",
        segmentStrokeWidth : 0,
        animationSteps : 100,
		tooltipCornerRadius: 2,
        animationEasing : "easeOutBounce",
        animateRotate : true,
        animateScale : false,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
    
   
    
});