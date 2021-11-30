<?php


namespace App\Brasiltec\Types;


class NBytea {

    private $val;
    private $name;
    private $type;

    /**
     * NBytea constructor.
     * @param $bytea
     * @param $filename
     * @param $filetype
     */
    public function __construct($bytea=null, $filename='', $filetype='')
    {
        $this->val = $bytea;
        $this->name = $filename;
        $this->type = $filetype;
    }

    public function fromUploadMultiple($file, $i) {
        $tmpfilesize = $file['size'][$i];
        $tmpfilename = $file['tmp_name'][$i];
        $foto_nome = $file['name'][$i];
        $tmpfiletype = $file['type'][$i];
        $img = fopen($tmpfilename, 'r');
        $data = fread($img, filesize($tmpfilename));
        $es_data = pg_escape_bytea($data);
        $this->val = $es_data;
        $this->name = $foto_nome;
        $this->type = $tmpfiletype;
    }

    public function fromUpload($file) {
        $tmpfilesize = $file['size'];
        $tmpfilename = $file['tmp_name'];
        $foto_nome = $file['name'];
        $tmpfiletype = $file['type'];
        $img = fopen($tmpfilename, 'r');
        $data = fread($img, filesize($tmpfilename));
        $es_data = pg_escape_bytea($data);
        $this->val = $es_data;
        $this->name = $foto_nome;
        $this->type = $tmpfiletype;
    }

    public function getBytea() {
        return $this->val;
    }


    /**
     * Download file bytea
     */
    public function download() {
        $name = $this->normalizeString($this->getName());

        if ((new NString($name))->endsWith("gmt") && $this->getType()=='PDF') {
            $name = 'arquivo.pdf';
        }
        if ((new NString($name))->contains("utf-8") && $this->getType()=='PDF') {
            $name = iconv_mime_decode($this->getName(), 0, "UTF-8");
        }
        header("content-type: {$this->getType()}");
        header("Content-disposition: attachment; filename={$name}");
        echo pg_unescape_bytea($this->getVal());
    }

    private function normalizeString ($str = '')
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        $str = str_replace(',', '.', $str);
        return $str;
    }

    public function print() {
        header("content-type: {$this->getType()}");
        echo pg_unescape_bytea($this->getVal());
    }

    /**
     * Save bytea to file on dir
     * @param $file
     * @return mixed
     */
    public function savetoFile($file) {
        file_put_contents($file, pg_unescape_bytea($this->getVal()));
        return $file;
    }


    /**
     * @return string
     */
    public function getVal(): string
    {
        return $this->val;
    }

    /**
     * @param string $val
     * @return NBytea
     */
    public function setVal(string $val): NBytea
    {
        $this->val = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return NBytea
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return NBytea
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }



}