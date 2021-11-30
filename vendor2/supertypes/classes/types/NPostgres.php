<?php


namespace App\Brasiltec\Types;

class NPostgres {

    private $conn = null;
    private $host;
    private $dbname;
    private $password;

    /**
     * Postgres constructor.
     * @param $host
     * @param $dbname
     * @param string $password
     */
    public function __construct($dbname='base', $host = "localhost", $password = "senha")
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->password = $password;
        $this->conn = pg_connect("host=$this->host port=5432 dbname=$this->dbname user=postgres password=$this->password ") or die('Database inicialization failed.');
    }

    public function sql_insert($sql) {
        if (pg_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($sql) {
        if (pg_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function listar($sql) {
        return pg_query($this->conn, $sql);
    }

    public function getResultSet($sql) {
        $res = null;
        $rs = pg_query($this->conn, $sql);
        while ($row = pg_fetch_array($rs)) {
            $res = $row;
        }
        return $res;
    }

    function getRows($lista) {
        return pg_num_rows($lista);
    }

    function isEmpty($rs) {
        if (pg_num_rows($rs) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function close() {
        pg_close($this->conn);
    }

    function getUltimoId($table) {
        $rs = $this->listar("select id from $table order by id desc limit 1");
        if (pg_num_rows($rs) > 0) {
            while ($row = pg_fetch_array($rs)) {
                return $row['id'];
            }
        } else {
            return 0;
        }
    }


}