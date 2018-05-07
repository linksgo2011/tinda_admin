<?php
class mysql {
    private $db_host; 
    private $db_user;
    private $db_pwd; 
    private $db_database;
    private $conn; 
    private $result;
    private $sql;
    private $row;
    private $coding;
    private $bulletin = true; 
    private $show_error = true; 
    private $is_error = false;

    public function __construct($db_host, $db_user, $db_pwd, $db_database, $conn, $coding) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;
        $this->db_database = $db_database;
        $this->conn = $conn;
        $this->coding = $coding;
        $this->connect();
    }

    public function connect() {
        if ($this->conn == "pconn") {
            $this->conn = mysql_pconnect($this->db_host, $this->db_user, $this->db_pwd);
        } else {
            $this->conn = mysql_connect($this->db_host, $this->db_user, $this->db_pwd);
        }

        if (!mysql_select_db($this->db_database, $this->conn)) {
            if ($this->show_error) {
                $this->show_error("���ݿⲻ���ã�", $this->db_database);
            }
        }
        mysql_query("SET NAMES $this->coding");
    }
     
    public function query($sql) {
        if ($sql == "") {
            $this->show_error("SQL������", "SQL��ѯ���Ϊ��");
        }
        $this->sql = $sql;

        $result = mysql_query($this->sql, $this->conn);

        if (!$result) {
            if ($this->show_error) {
                $this->show_error("����SQL��䣺", $this->sql);
            }
        } else {
            $this->result = $result;
        }
        return $this->result;
    }

	public function show_msg($url,$show="�����ѳɹ�"){
		$msg='<script>alert("'.$show.'");window.location="'.$url.'"</script>;
	���������޷���ת��<a href="'.$url.'">�����˴�</a>';
	echo $msg;
	exit();
	}
	
	public function create_database($database_name) {
        $database = $database_name;
        $sqlDatabase = 'create database ' . $database;
        $this->query($sqlDatabase);
    }

    
    public function show_databases() {
        $this->query("show databases");
        echo "�������ݿ⣺" . $amount = $this->db_num_rows($rs);
        echo "<br />";
        $i = 1;
        while ($row = $this->fetch_array($rs)) {
            echo "$i $row[Database]";
            echo "<br />";
            $i++;
        }
    }

    public function databases() {
        $rsPtr = mysql_list_dbs($this->conn);
        $i = 0;
        $cnt = mysql_num_rows($rsPtr);
        while ($i < $cnt) {
            $rs[] = mysql_db_name($rsPtr, $i);
            $i++;
        }
        return $rs;
    }

    public function show_tables($database_name) {
        $this->query("show tables");
        echo "�������ݿ⣺" . $amount = $this->db_num_rows($rs);
        echo "<br />";
        $i = 1;
        while ($row = $this->fetch_array($rs)) {
            $columnName = "Tables_in_" . $database_name;
            echo "$i $row[$columnName]";
            echo "<br />";
            $i++;
        }
    }

    public function mysql_result_li() {
        return mysql_result($str);
    }

    public function fetch_array() {
        return mysql_fetch_array($this->result);
    }

    public function fetch_assoc() {
        return mysql_fetch_assoc($this->result);
    }

    public function fetch_row() {
        return mysql_fetch_row($this->result);
    }

    public function fetch_Object() {
        return mysql_fetch_object($this->result);
    }

    public function findall($table) {
        $this->query("SELECT * FROM $table");
    }

    public function select($table, $columnName = "*", $condition = '',$limit,$debug = '',$substr,$date) {
        $condition = $condition ? ' Where newstypeid=' . $condition : NULL;
        if ($debug) {
            $sql = "SELECT $columnName FROM $table $condition order by newsid desc limit 0,".$limit;
			$rs = $this->query($sql);
			while($rows=mysql_fetch_assoc($rs))
			{
			echo "<tr class='line'>
              <td width='20' height='25' align='center'>
                <img src='image/xxcms_icon.jpg' width='4' height='4'/></td>
              <td align='left'>
			  <a href='news/".$rows["newspath"]."' title=".$rows["newstitle"]." target='_blank'>".substr($rows["newstitle"],0,$substr)."</a></td>";
			  if($date){
              echo "<td width='91' align='center'>".substr($rows["newstime"],0,10)."</td></tr>";
				}
			}
        } else {
            $this->query("SELECT $columnName FROM $table $condition");
        }
    }

    public function delete($table, $condition, $url = '') {
        if ($this->query("DELETE FROM $table WHERE $condition")) {

            if (!empty ($url))
                $this->show_msg($url, 'ɾ���ɹ���');
        }
    }

    public function insert($table, $columnName, $value, $url = '') {
        if ($this->query("INSERT INTO $table ($columnName) VALUES ($value)")) {
            if (!empty ($url))
                $this->show_msg($url, '��ӳɹ���');
        }
    }

    public function update($table, $mod_content, $condition, $url = '') {
        
        if ($this->query("UPDATE $table SET $mod_content WHERE $condition")) {
            if (!empty ($url))
                $this->show_msg($url);
        }
    }

    public function insert_id() {
        return mysql_insert_id();
    }

    public function db_data_seek($id) {
        if ($id > 0) {
            $id = $id -1;
        }
        if (!@ mysql_data_seek($this->result, $id)) {
            $this->show_error("SQL�������", "ָ��������Ϊ��");
        }
        return $this->result;
    }

    public function db_num_rows() {
        if ($this->result == null) {
            if ($this->show_error) {
                $this->show_error("SQL������", "��ʱΪ�գ�û���κ����ݣ�");
            }
        } else {
            return mysql_num_rows($this->result);
        }
    }

    public function db_affected_rows() {
        return mysql_affected_rows();
    }

    public function free() {
        @ mysql_free_result($this->result);
    }

    public function select_db($db_database) {
        return mysql_select_db($db_database);
    }

    public function num_fields($table_name) {
        $this->query("select * from $table_name");
        echo "<br />";
        echo "�ֶ�����" . $total = mysql_num_fields($this->result);
        echo "<pre>";
        for ($i = 0; $i < $total; $i++) {
            print_r(mysql_fetch_field($this->result, $i));
        }
        echo "</pre>";
        echo "<br />";
    }


    public function __destruct() {
        if (!empty ($this->result)) {
            $this->free();
        }
        mysql_close($this->conn);
    } 
}?>