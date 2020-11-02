<?php

namespace app\core;



class RouterCore
{

    private $uri;
    private $method;
    private $getArr = [];


    public function __construct()
    {
        $this->initialize();
        require_once('../app/config/Router.php');
        $this->execute();
    }

    private function initialize()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // poderia usar o replace pra tirar o caminho do server
        //dd(str_replace('/SatellaSoft/MiniFrameworkMVC/', '', $this->uri));

        // uri completa
        $ex = explode('/', $uri);
        
        // uri completa e tratada
        $uri = $this->normalizeURI($ex); 
        dd($uri, false);//

        // remove parte da uri que não é necessario
        // nesse caso nome servidor e pasta onde esta os arquivos
        for ($i = 0; $i < UNSET_URI_COUNT; $i++) {
            unset($uri[$i]);
        }

        dd($uri, false);//
        

        // uri tratada, metodo e ação
        $this->uri = implode('/', $this->normalizeURI($uri));
        dd($this->uri, false);
        
        if(DEBUG_URI) {
            dd($this->uri);
        }

    }

    private function get($router, $call) 
    {
        $this->getArr[] = [
            'router' => $router,
            'call' => $call
        ];
    }

    private function execute() 
    {
        switch($this->method) {
            case 'GET':
                $this->executeGet();
                break;
            case 'POST':
                $this->executePost();
                break;
        }
    }

    private function executeGet()
    {
        foreach($this->getArr as $get)
        {
            $r = substr($get['router'], 1);

            // checa se o ultimo elemento tem uma barra
            if(substr($r, -1) == '/') {
                $r = substr($r, 0, -1);
            }

            if($r == $this->uri) {
                if(is_callable($get['call'])) {
                    $get['call']();
                    break;
                }
            }
        }
    }

    private function executePost()
    {

    }

    private function normalizeURI($arr)
    {
        // array_filter retorna todos indexes do array que não estão vazios
        // array_values recalcula o array para começar a partir do indice 0
        return array_values(array_filter($arr));
    }

}
