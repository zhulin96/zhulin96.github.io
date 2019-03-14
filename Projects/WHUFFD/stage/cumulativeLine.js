d3.json('../process/file/arr.json', function(data) 
{
  nv.addGraph(function() 
{
    var chart = nv.models.cumulativeLineChart()
                  
                          .x(function(d) { return d[0] })
                  
                          .y(function(d) { return d[1]})
//adjusting, 100% is 1.00, not 100 as it is in the data
                 
                          .color(d3.scale.category10().range())
                  
                          .useInteractiveGuideline(true)
;

     
chart.xAxis
        
     .tickValues([1,2,3,4,5,6,7])
        

   
chart.yAxis
 .tickFormat(d3.format());

    
d3.select('#chart')
.append('svg')
        
                   .attr('width','300px')
        
                  .attr('height','200px')
        
                   .datum(data)     
                   .call(chart);

    
//TODO: Figure out a good way to do this automatically
    
nv.utils.windowResize(chart.update);

    
        return chart;
  });
});

