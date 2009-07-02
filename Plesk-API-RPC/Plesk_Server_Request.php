<?php

include_once 'Request_Exception.php';
/**
 * Efetua a conexгo com o Servidor Plesk
 * 
 * baseado no exemplo de http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
 */
class Plesk_Server_Request
{

	var $curl;
	
	/**
     * Construtor
     * 
     * @param $hostname Nome do Host ou Domнnio 
     * @param $login Login do Painel Plesk
     * @param $passwd Senha do painel plesk
     * 
     * @return void
     */
	function Plesk_Server_Request($hostname, $login, $passwd)
	{
		$this->curl = $this->curlInit($hostname, $login, $passwd);
	}

	/**
	 * Prepara CURL para efetuar a conxao com o servidor Plesk
	 * 
	 * @param $hostname Nome do Host ou Domнnio 
     * @param $login Login do Painel Plesk
     * @param $passwd Senha do painel plesk
	 * 
	 * @return resource
	 */
	private function curlInit($hostname, $login, $password)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://{$hostname}:8443/enterprise/control/agent.php");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST,           true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER,
		array("HTTP_AUTH_LOGIN: {$login}",
                    "HTTP_AUTH_PASSWD: {$password}",
                    "HTTP_PRETTY_PRINT: TRUE",
                    "Content-Type: text/xml")
		);
		return $curl;
	}
	/**
	 * Faz a requisiзгo ao Plesk,retorna a reposta texto
	 *
	 * @return string
	 * 
	 * @param @curl conexao via CURL
	 * @param $packet Pacote XML
	 * 
	 * @throws RequestException
	 */
	public function sendRequest($curl, $packet)
	{
		curl_setopt($curl, CURLOPT_POSTFIELDS, $packet);
		$result = curl_exec($curl);
		if (curl_errno($curl)) {
			$errmsg  = curl_error($curl);
			$errcode = curl_errno($curl);
			curl_close($curl);
			throw new RequestException($errmsg, $errcode);
		}
		curl_close($curl);
		return $result;
	}	
	
    /**
     * Chama a requisicao, retorna a resposta do Servidor plesk
     * 
     * @param $xml XML da Requisiзгo
     * 
     * @return XML da resposta do Servidor
     * 
     */
	public function getXML_Response($xml)
	{
		try 
		{
			//requisiзгo ao Servidor
			$response = $this->sendRequest($this->curl, $xml->saveXML());
			return $response;

		} catch (RequestException $e) {
			echo $e;
			return null;
		}			
	}
}
?>