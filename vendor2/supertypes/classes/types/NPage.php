<?php


namespace App\Brasiltec\Types;


class NPage
{
    private $ini = 0;
    private $max = 10;
    private $npp = 10;
    private $anterior = 0;
    private $proxima = 0;
    private $pagina = '';

    private $pagina_atual = '';
    private $pagina_total = '';

    /**
     * NPage constructor.
     * @param int $ini
     * @param int $npp
     */
    public function __construct(int $ini, int $npp)
    {
        $this->ini = $ini;
        $this->npp = $npp;

    }

    public function toSQL() {
        return " limit {$this->getNpp()} offset {$this->getIni()} ";
    }


    /**
     * @param int $max
     */
    public function calcular($max) {

        $this->max = $max;

        $i = 0;
        $res = $this->max/$this->npp;
        $pags = intval($this->max/$this->npp);
        if ($res > $pags) {
            $pags++;
        }
        $pagAtual = intval($this->ini/$this->npp);
        $pagAtual=$pagAtual+1;

        if ($this->ini>0) {
            $this->anterior = $this->ini - ($this->npp);
        } else {
            $this->anterior = 0;
        }
        if(($this->ini+$this->npp) < $this->max) {
            $this->proxima = $this->ini + $this->npp;
        }

        $this->pagina_atual = $pagAtual;
        $this->pagina_total = $pags;
        $this->pagina = "Página {$pagAtual} de {$pags} | {$this->max} Registros";
    }

    /**
     * @return string
     */
    public function getPaginaAtual(): string
    {
        return $this->pagina_atual;
    }

    /**
     * @param string $pagina_atual
     * @return NPage
     */
    public function setPaginaAtual(string $pagina_atual): NPage
    {
        $this->pagina_atual = $pagina_atual;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaginaTotal(): string
    {
        return $this->pagina_total;
    }

    /**
     * @param string $pagina_total
     * @return NPage
     */
    public function setPaginaTotal(string $pagina_total): NPage
    {
        $this->pagina_total = $pagina_total;
        return $this;
    }



    /**
     * @return int
     */
    public function getAnterior(): int
    {
        return $this->anterior;
    }

    /**
     * @param int $anterior
     * @return NPage
     */
    public function setAnterior(int $anterior): NPage
    {
        $this->anterior = $anterior;
        return $this;
    }

    /**
     * @return int
     */
    public function getProxima(): int
    {
        return $this->proxima;
    }

    /**
     * @param int $proxima
     * @return NPage
     */
    public function setProxima(int $proxima): NPage
    {
        $this->proxima = $proxima;
        return $this;
    }

    /**
     * @return string
     */
    public function getPagina(): string
    {
        return $this->pagina;
    }

    /**
     * @param string $pagina
     * @return NPage
     */
    public function setPagina(string $pagina): NPage
    {
        $this->pagina = $pagina;
        return $this;
    }

    /**
     * @return int
     */
    public function getIni(): int
    {
        return $this->ini;
    }

    /**
     * @param int $ini
     * @return NPage
     */
    public function setIni(int $ini): NPage
    {
        $this->ini = $ini;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return NPage
     */
    public function setMax(int $max): NPage
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return int
     */
    public function getNpp(): int
    {
        return $this->npp;
    }

    /**
     * @param int $npp
     * @return NPage
     */
    public function setNpp(int $npp): NPage
    {
        $this->npp = $npp;
        return $this;
    }





}