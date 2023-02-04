<?php
include "dbClass.php";
class all_function extends dbClass
{
    public function insert_data($table, $data)
    {
        $sql = "INSERT INTO " . $table;
        $sql .= " (" . implode(",", array_keys($data)) . ") VALUES";
        $sql .= " ('" . implode("','", array_values($data)) . "')";
        echo $sql;
        // $query = $this->conn->query($sql);
        // if ($query) {
        //     return true;
        // } else {
        //     return false;
        // }
        // $query->close();
    }
    public function fetch_data($table)
    {
        $sql       = "SELECT * FROM " . $table;
        $query     = $this->conn->query($sql);
        $arrayName = array();
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function fetch_data_or($table, $column, $asc)
    {
        $sql       = "SELECT * FROM " . $table . " ORDER BY " . $column . " " . $asc;
        $query     = $this->conn->query($sql);
        $arrayName = array();
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function select_data($table, $condition)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql       = substr($sql, 0, -5);
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function select_data_or($table, $condition, $column, $asc)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql = substr($sql, 0, -5);
        $sql .= " ORDER BY " . $column . " " . $asc;
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function search_data($table, $condition)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . " LIKE '%" . $value . "%' OR ";
        }
        $sql       = substr($sql, 0, -3);
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function search_con_data($table, $condition, $search_condition)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql = substr($sql, 0, -5);
        $sql = $sql . " AND ( ";
        foreach ($search_condition as $key => $value) {
            $sql .= $key . " LIKE '%" . $value . "%' OR ";
        }
        $sql       = substr($sql, 0, -3);
        $sql       = $sql . " )";
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function distinct_data($table, $column)
    {
        $sql = "SELECT  DISTINCT ";
        foreach ($column as $key => $value) {
            $sql .= $key . " , ";
        }
        $sql       = substr($sql, 0, -2);
        $sql       = $sql . " FROM " . $table;
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function distinct_data_con($table, $column, $condition)
    {
        $sql = "SELECT  DISTINCT ";
        foreach ($column as $key => $value) {
            $sql .= $key . " , ";
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . " FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql       = substr($sql, 0, -5);
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function delete_data($table, $condition)
    {
        $sql = "DELETE FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql   = substr($sql, 0, -5);
        $query = $this->conn->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
        $query->close();
    }
    public function edit_data($table, $data, $condition)
    {
        $sql = "UPDATE " . $table . " SET ";
        foreach ($data as $key => $value) {
            $sql .= $key . "='" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql   = substr($sql, 0, -5);
        $query = $this->conn->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
        $query->close();
    }
    public function one_value($table, $condition)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql    = substr($sql, 0, -5);
        $query  = $this->conn->query($sql);
        $result = $query->fetch_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
        $query->close();
    }
    public function one_value_or($table, $condition, $column, $asc)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($condition as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql    = substr($sql, 0, -5);
        $sql    = $sql . " ORDER BY " . $column . " " . $asc;
        $query  = $this->conn->query($sql);
        $result = $query->fetch_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
        $query->close();
    }
    public function row_count($table)
    {
        $sql   = "SELECT * FROM " . $table;
        $query = $this->conn->query($sql);
        $num   = $query->num_rows;
        $query->close();
        return $num;
    }
    public function row_count_con($table, $con)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        foreach ($con as $key => $value) {
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql   = substr($sql, 0, -5);
        $query = $this->conn->query($sql);
        $num   = $query->num_rows;
        return $num;
        $query->close();
    }
    public function inner_join($table, $con)
    {
        $sql = "SELECT * FROM ";
        foreach ($table as $key => $value) {
            $sql .= $value . " " . $key . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= "WHERE ";
        foreach ($con as $key => $value) {
            $sql .= $key . "=" . $value . " AND ";
        }
        $sql       = substr($sql, 0, -5);
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function inner_join_or($table, $con, $id, $order)
    {
        $sql = "SELECT * FROM ";
        foreach ($table as $key => $value) {
            $sql .= $value . " " . $key . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= "WHERE ";
        foreach ($con as $key => $value) {
            $sql .= $key . "=" . $value . " AND ";
        }
        $sql       = substr($sql, 0, -5);
        $sql       = $sql . " ORDER BY " . $id . " " . $order;
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function inner_join_column($column, $table, $con)
    {
        $sql = "SELECT ";
        foreach ($column as $key => $value) {
            $sql .= $key . " " . $value . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM ";
        foreach ($table as $key => $value) {
            $sql .= $value . " " . $key . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= "WHERE ";
        foreach ($con as $key => $value) {
            $sql .= $key . "=" . $value . " AND ";
        }
        $sql       = substr($sql, 0, -5);
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function inner_join_column_or($column, $table, $con, $id, $order)
    {
        $sql = "SELECT ";
        foreach ($column as $key => $value) {
            $sql .= $key . " " . $value . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM ";
        foreach ($table as $key => $value) {
            $sql .= $value . " " . $key . " ,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= "WHERE ";
        foreach ($con as $key => $value) {
            $sql .= $key . "=" . $value . " AND ";
        }
        $sql       = substr($sql, 0, -5);
        $sql       = $sql . " ORDER BY " . $id . " " . $order;
        $arrayName = array();
        $query     = $this->conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $arrayName[] = $row;
            }
            return $arrayName;
        } else {
            return false;
        }
        $query->close();
    }
    public function redirect($url)
    {
        echo "<script>window.location='" . $url . "'</script>";
    }
    public function get_client_ip_getenv()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function get_client_ip_server()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
$fun = new all_function();
?>