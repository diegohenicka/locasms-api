<?php

/*
 *
 * Locasms é uma solução para envio de SMS
 * Para usar, é necessário ter um cadastro no Locasms.
 * Acesse e confira: locasms.com.br
 * Documentação: http://locasms.com.br/download/locasms-manual-api.pdf
 * Criado por: Diego Henicka
 *
 */

namespace LocaSMS;

class LocaSMS {

    private $login;
    private $senha;
    public $msg;
    public $numeros;
    
    public $id;

    public $callback;
    public $jobdata;
    public $jobtime;

    const URL = "http://209.133.205.2/painel/api.ashx";   

    function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = $senha;
    }

    function enviarSMS($msg, $numeros, $callback = '', $jobdate = '', $jobtime = ''){
        $this->msg    = $msg;
        $this->numeros = $numeros;
        $this->callback = $callback;
        $this->jobdate  = $jobdate;
        $this->jobtime  = $jobtime;
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'msg'           => $this->msg,
            'numbers'       => $this->numeros
        );
        
        if ($this->callback != '') {            
            $requestData['callback'] = $this->callback;
        }
        if ($this->jobdate != '') {            
            $requestData['jobdate'] = $this->jobdate;
        }
        if ($this->jobtime != '') {            
            $requestData['jobtime'] = $this->jobtime;
        }       

        return $this->request('sendsms', $requestData);
    }    

    
    function statusCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('getstatus', $requestData);
    }

    function prenderCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('holdsms', $requestData);
    }

    function liberarCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('releasesms', $requestData);
    }


    function consultaSaldo(){
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha
        );
        return $this->request('getbalance', $requestData);
    }
    


    private function request($urlSufix, $data) {
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
            CURLOPT_URL => LocaSMS::URL.'?action='.$urlSufix,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => http_build_query($data) . "\n",
            CURLOPT_HTTPHEADER => $data
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        return $response;
    }
}


 




?>