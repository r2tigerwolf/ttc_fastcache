<?php  
    include('autoload.php');
    use phpFastCache\CacheManager;
    
    include("db.class.php");
    
    CacheManager::setup(array(
        "path" =>  dirname(__FILE__) . '/cache', // or in windows "C:/tmp/"
    ));
    
    // In your class, function, you can call the Cache
    $InstanceCache = CacheManager::getInstance('files');

    $conn = new Connect();   
    $busConn = $conn->dbconnect();
    $bus = new Bus; 
       
    $route_cache_result = array();
    $trips_cache_result = array();
    
    
    
    foreach($_REQUEST as $key => $val) {
        ${$key} = $val;
    }
    
    if(isset($buslist)) {

        $route_cache_result = $InstanceCache->getItem('route');

        if($route_cache_result->get()) {
            $routeResult = $route_cache_result->get();
            echo "<br/>this is cached<br/>";
        } else {
            $sqlArray = array('conn' => $busConn, 'rows' => '*', 'table' => 'bus_view', 'join' => '', 'where' => '', 'order' => '', 'limit' => '');
            $routeResult = $bus->select($sqlArray); 
            
            
            $route_cache_result->set($routeResult)->expiresAfter(0);//in seconds, also accepts Datetime
	        $InstanceCache->save($route_cache_result);
            echo "<br/>this is NOT cached<br/>";
        }
    
    
    
        foreach($routeResult  as $key => $val) {
            echo '<li><a href="javascript:void(0);" class="route" route="' . $val['route_id'] . '">' . $val['route_long_name'] . ' ' . $val['route_short_name'] . '</a></li>';  
        }

        
    }

    if(isset($route)) {
        $trips_cache_result = $InstanceCache->getItem('trips_' . $route . '_' . $intersection1 . '_' . $intersection2);
        
 
        $trips_result = array();
        
        if($trips_cache_result->get()) {
            $tripsResult = $trips_cache_result->get();
            echo "this is cached<br/>";
        } else {
            if(isset($intersection1)) { 
                $intersection1 = ' and stop_name LIKE "%' . $intersection1 . '%"';
            }
            
            if(isset($intersection2)) {
                $intersection2 = ' and stop_name LIKE "%' . $intersection2 . '%"';
            }
            
            $sqlArray = array('conn' => $busConn, 'rows' => '*', 'table' => 'route_view', 'join' => '', 'where' => 'route_id = "' . $route . '"' . $intersection1 . $intersection2, 'order' => '', 'limit' => '');
            $tripsResult = $bus->select($sqlArray); 
            
            if($tripsResult) {
                
                $trips_cache_result->set($tripsResult)->expiresAfter(0);//in seconds, also accepts Datetime
	            $InstanceCache->save($trips_cache_result);
                
                echo "this is NOT cached<br/>";
            } else {
                echo "No Result";
            }
        }
        
        
        foreach($tripsResult as $key => $val) {
            echo '<li>';
            echo $val['trip_headsign'] . '<br/> Arrive at: ' . 
            date("g:i A", strtotime($val['arrival_time'])) . ', Depart at: ' . 
            date("g:i A", strtotime($val['departure_time']));
            echo "<br />";
            echo $val['stop_name'];
            echo '</li>';  
        }
 
    }
?>