<?php
    /*******************************************************************
    TTC APP with JQueryMobile and phpFastCache
    ********************************************************************/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no, user-scalable=0"/>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/ttc.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.4.5.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<title>TTC Mobile</title>
</head>

<body>
     <div data-role="page" id="indexPage" data-theme="b">
        <div data-role="header">
            <h1>TTC Mobile App</h1>
        </div>
        <div data-role="content">
            <div data-role="fieldcontain">
                <form class="ui-filterable">
                    <input type="text" id="routeName" name="routeName"  data-type="search" placeholder="Search bus..." />
                </form>
            </div>

            <ul id="routeResult" data-role="listview" data-filter="true" data-inset="true" data-filter-reveal="true" data-input="#routeName"></ul>

            
            <div id="intersection">
                <label>Please enter your nearest intersection</label>
                <input type="text" id="intersection1" name="intersection1" placeholder="Enter Intersection" />
                and
                <input type="text" id="intersection2" name="intersection2" placeholder="Enter Intersection" />
                <input type="button" id="submitIntersection" value="Find Nearby Bus Stops" />
            </div>

            <div id="tripSearch" data-role="fieldcontain">
                <form class="ui-filterable">
                    <input type="text" id="tripName" name="tripName"  data-type="search" placeholder="Filter result..." />
                </form>
            </div>
            <ul id="tripResult" data-role="listview" data-filter="true" data-inset="true" data-input="#tripName"></ul>
        </div>
 
        <div data-role="footer">
            <h1>TTC Mobile App</h1>
        </div>
    </div>
</body>
</html>