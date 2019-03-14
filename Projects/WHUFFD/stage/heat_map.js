var margin = { top:48, right: 20, bottom: 50, left: 40 },
    width = 700 - margin.left - margin.right,
    height = 960 - margin.top - margin.bottom,
    gridSize = Math.floor(width / 24),
    legendElementWidth = gridSize*2,
    buckets = 9,
    colors = ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#253494","#081d58"] 
    days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
    times = ["1:00", "2:00", "3:00", "4:00", "5:00", "6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"];

      d3.tsv("../process/file/data"+data1[1]+"tsv",
        function(d) {
          return {
            day: +d.day,
            hour: +d.hour,
            value: +d.value
          };
        },
        function(error, data) {
          var colorScale = d3.scale.quantile()
              .domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
              .range(colors);

          var svg = d3.select("#chart").append("svg")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
              .append("g")
              .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

          var dayLabels = svg.selectAll(".timeLabel")
              .data(times)
              .enter().append("text")
                .text(function (d) { return d; })
                .attr("x", 0)
                .attr("y", function (d, i) { return i * gridSize; })
                .style("text-anchor", "end")
                .attr("transform", "translate(-6," + gridSize / 1.5 + ")")
                .attr("class", function (d, i) { return ((i >= 0 && i <= 4) ? "timeLabel mono axis axis-workweek" : "timeLabel mono axis"); });

          var timeLabels = svg.selectAll(".dayLabel")
              .data(days)
              .enter().append("text")
                .text(function(d) { return d; })
                .attr("x", function(d, i) { return i * gridSize; })
                .attr("y", 0)
                .style("text-anchor", "middle")
                .attr("transform", "translate(" + gridSize / 2 + ", -6)")
                .attr("class", function(d, i) { return ((i >= 7 && i <= 16) ? "dayLabel mono axis axis-worktime" : "dayLabel mono axis"); });

          var heatMap = svg.selectAll(".hour")
              .data(data)
              .enter().append("rect")
              .attr("x", function(d) { return (d.day - 1) * gridSize; })
              .attr("y", function(d) { return (d.hour - 1) * gridSize; })
              .attr("rx", 2)
              .attr("ry", 2)
              .attr("width", gridSize)
              .attr("height", gridSize)
              .style("fill", function(d) { return colorScale(d.value); })
              .style("stroke", "#ccc")
              .attr('data-title',function(d) { return '访问人次 : '+d.value; });
        var legend = svg.selectAll(".legend")
              .data([0].concat(colorScale.quantiles()), function(d) { return d; });
          legend.enter().append("g")
              .attr("class", "legend");
          legend.append("rect")
            .attr("x", function(d, i) { return 30 * i-30; })
            .attr("y", -50)
            .attr("width", 30)
            .attr("height", gridSize / 2)
            .style("fill", function(d, i) { return colors[i]; });
          legend.append("text")
            .attr("class", "mono")
            .text(function(d) { return "≥ " + Math.round(d); })
            .attr("x", function(d, i) { return 30 * i-30; })
            .attr("y", -50+gridSize);
          legend.exit().remove();
              
        $("rect").tooltip({container: 'body', html: true, placement:'right'});        
      });