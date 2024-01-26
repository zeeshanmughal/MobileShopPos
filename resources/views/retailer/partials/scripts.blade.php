  
  <!-- Bootstrap core JavaScript-->
  <script src="{{ retailer_asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ retailer_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ retailer_asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ retailer_asset('js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  {{-- <script src="{{ retailer_asset('vendor/chart.js/Chart.min.js') }}"></script> --}}

  <!-- Page level custom scripts -->
  {{-- <script src="{{ retailer_asset('js/demo/chart-area-demo.js') }}"></script> --}}
  {{-- <script src="{{ retailer_asset('js/demo/chart-pie-demo.js') }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <!-- Page level plugins -->
    {{-- <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="js/demo/datatables-demo.js"></script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
<!-- chart script Dashboard -->
    <script>
        var dataset = [
            { name: 'Data', percent: 39.10 },
            { name: 'Chrome', percent: 32.51 },
            { name: 'Safari', percent: 13.68 },
            { name: 'Firefox', percent: 8.71 },
            { name: 'Others', percent: 6.01 }
        ];
        
        var pie=d3.layout.pie()
        .value(function(d){return d.percent})
        .sort(null)
        .padAngle(.02);
        
        var w=340,h=340;
        
        var outerRadius=w/2;
        var innerRadius=83;
        
        var color = d3.scale.category10();
        
        var arc=d3.svg.arc()
        .outerRadius(outerRadius)
        .innerRadius(innerRadius);
        
        var svg=d3.select("#chart")
        .append("svg")
        .attr({
            width:w,
            height:h,
            class:'shadow'
        }).append('g')
        .attr({
            transform:'translate('+w/2+','+h/2+')'
        });
        var path=svg.selectAll('path')
        .data(pie(dataset))
        .enter()
        .append('path')
        .attr({
            d:arc,
            fill:function(d,i){
                return color(d.data.name);
            }
        });
        
        path.transition()
        .duration(1000)
        .attrTween('d', function(d) {
            var interpolate = d3.interpolate({startAngle: 0, endAngle: 0}, d);
            return function(t) {
                return arc(interpolate(t));
            };
        });
 
        
        var restOfTheData=function(){
            var text=svg.selectAll('text')
                .data(pie(dataset))
                .enter()
                .append("text")
                .transition()
                .duration(200)
                .attr("transform", function (d) {
                    return "translate(" + arc.centroid(d) + ")";
                })
                .attr("dy", ".4em")
                .attr("text-anchor", "middle")
                .text(function(d){
                    return d.data.percent+"%";
                })
                .style({
                    fill:'#fff',
                    'font-size':'10px'
                });
        
            var legendRectSize=20;
            var legendSpacing=7;
            var legendHeight=legendRectSize+legendSpacing;
        
        
            var legend=svg.selectAll('.legend')
                .data(color.domain())
                .enter()
                .append('g')
                .attr({
                    class:'legend',
                    transform:function(d,i){
                        //Just a calculation for x & y position
                        return 'translate(-35,' + ((i*legendHeight)-65) + ')';
                    }
                });
        };
        
        setTimeout(restOfTheData,1000);
    </script> 