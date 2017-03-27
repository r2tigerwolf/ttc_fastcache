$(function() {
    var route;
    
    $(document).on("click", "#routeName", function() {
        $("#routeResult").show();
        $("#tripSearch").hide();
    });
    
    $(document).on("click", ".route", function () {
        route = $(this).attr("route");
        $("#intersection").show();
        $("#routeResult").hide();
    });
    
    
    function loading(showOrHide) {
        setTimeout(function(){
            $.mobile.loading(showOrHide);
        }, 1); 
    }
       
    
    $(document).on("click", "#submitIntersection", function () {
        var intersection1 = $("#intersection1").val();
        var intersection2 = $("#intersection2").val();
                
        loading('show');
        
        $.ajax({
            type: "POST",
            url: "result.php",
            data: ({'intersection1': intersection1, 'intersection2': intersection2, 'route': route}),
            cache: false,
            dataType: "html",
            success: function(data) {                  
                $("#tripResult").html(data);
                $("#routeResult").hide();
                $("#tripSearch").show();
                $("#tripResult").listview('refresh');
                loading('hide');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log("Status: " + textStatus); 
                console.log("Error: " + errorThrown); 
            } 
        });
    });
    
 
    window.onload = function(){
        var route = $(this).attr("route");
        var routeName = $(this).attr("routename");

        $("#tripSearch").hide();
        $("#intersection").hide();
        
        $.ajax({
            type: "POST",
            url: "result.php",
            data: ({'buslist': true}),
            cache: false,
            dataType: "html",
            success: function(data) {                  
                $("#routeResult").html(data);
                $("#routeResult").listview('refresh');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log("Status: " + textStatus); 
                console.log("Error: " + errorThrown); 
            } 
        
        });
    }

});