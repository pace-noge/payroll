<?php
    class DB_Functions {
        private $con = false;
        private $result = array();

        public function connect() {
            require_once '../../config/DB_Config.php';
            if(!$this->con) {
                $myconn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD) or die(mysql_error());
                if($myconn) {
                    $seldb = @mysql_select_db(DB_NAME, $myconn);
                    if($seldb) {

                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }

        public function disconnect() {
            if($this->con) {
                if(@mysql_close()) {
                    $this->con = false;
                    return true;
                } else {
                    return false;
                }
            }
        }



        private function tableExist($table) {
            $tablesInDb = @mysql_query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$table.'"');
            if($tablesInDb) {
                if(mysql_num_rows($tablesInDb) == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }


        public function select($table, $rows = '*', $where = null, $order = null) {
            $q = 'SELECT '.$rows.' FROM '.$table;
            if($where != null)
                $q .= ' WHERE '.$where;

            if($order != null)
                $q .= ' ORDER BY '.$order;


                $query = @mysql_query($q);
//                echo "<p>".$q."</p>";
                if($query) {
                    $this->numResults = mysql_num_rows($query);
                    for($i = 0; $i < $this->numResults; $i++) {
                        $r = mysql_fetch_array($query);
                        $key = array_keys($r);
                        for($x = 0; $x < count($key); $x++) {
                            if(!is_int($key[$x])) {
                                if(mysql_num_rows($query) > 1)
                                    $this->result[$i][$key[$x]] = $r[$key[$x]];
                                else if(mysql_num_rows($query) < 1)
                                    $this->result = null;
                                else
                                    $this->result[$key[$x]] = $r[$key[$x]];
                            }
                        }
                    }
                    return true;
                } else {
                    return false;
                }

        }

        public function insert($table, $values, $rows = null) {
            if($this->tableExist($table)) {
                $insert = 'INSERT INTO '.$table;
                if($rows != null) {
                    $insert .= ' ('.$rows.')';
                }
                for($i = 0; $i < count($values); $i++) {
                    if(is_string($values[$i]))
                        $values[$i] = '"'.$values[$i].'"';
                }
                $values = implode(',', $values);
                $insert .= ' VALUES('.$values.')';
                $ins = mysql_query($insert);
                //echo $insert;
                    return true;
                } else {
                    return false;
                }
            }



        public function update($table, $rows, $where) {
            if($this->tableExist($table)) {

                for($i = 0; $i < count($where); $i++) {
                    if($i%2 != 0) {
                        if(is_string($where[$i])) {
                            if(($i+1) != null)
                                $where[$i] = '"'.$where[$i].'" AND ';
                            else
                                $where[$i] = '"'.$where[$i].'"';
                        }
                    }
                }
                    $where = implode(',', $where);
                    $update = 'UPDATE '.$table.' SET ';
                    $keys = array_keys($rows);
                    for($i = 0; $i < count($rows); $i ++) {
                        if(is_string($rows[$keys[$i]])) {
                            $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                        } else {
                            $update .= $keys[$i].'='.$rows[$keys[$i]].'"';
                        }
                        if($i != count($rows)-1) {
                            $update .= ',';
                        }
                    }
                    $update .= ' WHERE '.$where;
                    //echo $update;
                    $query = @mysql_query($update);
                    if($query) {
                        return true;
                    } else {
                        return false;
                    }
            } else {
                return false;
            }
        }

        public function delete($table, $where=null) {

            if($this->tableExist($table)) {
                if($where==null) {
                    $delete = 'DELETE '.$table;
                } else {
                    $delete = 'DELETE FROM '.$table.' WHERE '.$where;
                    //echo "ini where ".$where;
                }

                $del = @mysql_query($delete);

                echo $delete;

                if($del) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function getResult() {
            return $this->result;
        }
    }

?>
