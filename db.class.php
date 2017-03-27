<?php    
    class Connect {
        private $db_host = 'localhost';
        private $db_user = 'root';
        private $db_password = '';
        private $db_db = 'ttc';
    
        function dbconnect(){           
            $conn = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_db);
            return $conn;
        }
    } 
   
    class Bus {
        private $result;
        
        public function select($sqlArray) {
            
            if($sqlArray['where']) {
                $sqlArray['where'] = ' WHERE ' . $sqlArray['where'];
            }
            
            $sql = 'SELECT ' . $sqlArray['rows'] . ' FROM `' . $sqlArray['table'] . '` ' . $sqlArray['join'] . $sqlArray['where'] . ' ' . $sqlArray['order'] . ' ' . $sqlArray['limit'];
        
            $result =  $sqlArray['conn']->query($sql);
            $keyResult = $sqlArray['conn']->query($sql);

            if($result->num_rows) {
                $busInfo = array_keys($keyResult->fetch_assoc());
                $i = 0;
                
                while ($bus = $result->fetch_assoc()) {
                    for($j = 0; $j < count($busInfo); $j++) {
                        $this->result[$i][$busInfo[$j]] = $bus[$busInfo[$j]];
                    }
                    $i++;
                }
                
                mysqli_close($sqlArray['conn']);
                return $this->result; 
            }
            else {
                mysqli_close($sqlArray['conn']);
                return false; 
            }
        }
    }
?>