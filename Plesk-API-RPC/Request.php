<?php

require_once 'Plesk_Server_Request.php';
require_once 'XML_Request.php';
require_once 'Request_Exception.php';
require_once 'Response_Manager.php';
/**
 * Efetua a conexгo com o Servidor Plesk
 * 
 * baseado no exmplo em http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
 */
class Request
{
	/*
	 * hostname
	 */
	var $hostname;
	/*
	 * login
	 */
	var $login;
	/*
	 * passwd
	 */
	var $passwd;
	/*
	 * response
	 */
	var $response;
	
    /**
     * Construtor
     * 
     * @param $hostname Nome do Host ou Domнnio 
     * @param $login Login do Painel Plesk
     * @param $passwd Senha do painel plesk
     * 
     * @return void
     */
	public function Request($hostname="",$login="",$passwd="")
	{
		$this->set_args($hostname,$login,$passwd);
	}

	protected  function set_args($hostname,$login,$passwd)
	{
		$this->hostname = $hostname;
		$this->login = $login;
		$this->passwd = $passwd;
	}
	/**
	 * Envia uma requisicao XML ao Servidor Plesk
	 * 
	 * @param $xml XML filename
	 * 
	 * @return void
	 * 
	 * @throws Exception
	 */
	public function remote_action($xml)
	{   
		// abre arquivo XML e salva na variбvel $xml_request
		$xml_request= XML_Request::get_XML_from_file($xml);	
		
		// Instancia a classe da Requisicao
	    $plesk_request = new Plesk_Server_Request($this->hostname,
			$this->login,$this->passwd);
		// Envia a requisiзгo e Retorna a resposta do Servidor
		$this->response= $plesk_request->getXML_Response($xml_request);
	}
	
	/**
	 * Vefica se houve resposta e a salva em um arquivo XML
	 * 
	 * @param $filename Nome com o qual se salvarб a resposta
	 * 
	 * @return void 
	 * 
	 * @throws RequestException
	 */
	public function save_response($filename)
	{
		$response_manager =  new Response_Manager($this->response);
		// Salva em arquivo XML
		return $response_manager->save_into_a_file($filename);
	}
}
?>