<?php
namespace App\Http;

class Request{
    protected $segmentos=[];
    protected $controlador;
    protected $metodo;

    public function __construct()
    {
        $this->segmentos = explode("/", $_SERVER['REQUEST_URI']);
        $this->setControlador();
        $this->setMetodo();
    }

    /**
     * @return mixed
     */
    public function getControlador()
    {
        $controlador = ucfirst($this->controlador);
        return "App\Http\Controllers\\{$controlador}Controller";
    }

    /**
     */
    public function setControlador()
    {
        $this->controlador = empty($this->segmentos[2])?'home':$this->segmentos[2];
    }

    /**
     * @return mixed
     */
    public function getMetodo()
    {
        return $this->metodo;
    }

    /**
     */
    public function setMetodo()
    {
        $this->metodo = empty($this->segmentos[3])?'index':$this->segmentos[3];
    }

    public function send()
    {
        $controlador = $this->getControlador();
        $metodo = $this->getMetodo();

        $response = call_user_func([
            new $controlador,
            $metodo
        ]);
        echo ($response);
    }
}