<?php

include_once 'NotXMLException.php';

/**
 * Encapsula métodos para lidar com a resposta XML do Servidor
 * 
 * baseado no exemplo de http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
 */
class Response_Manager
{
	/*
	 * Request Response Parsed
	 * 
	 * @SimpleXMLElement
	 */
	public $xml;
	
	public function Response_Manager($response_string)
	{
		$this->xml = new SimpleXMLElement($response_string);
	}
    /**
     * Verifica se o arquivo é um XML válido
     * 
     * @return FALSE se nao for um XML
     * @return TRUE se for XML
     * 
     * @throws NotXMLException
     */
	private function is_a_XML()
	{
		if (!is_a($this->$xml, 'SimpleXMLElement'))
		{
			throw new NotXMLException("Cannot parse server response: {}");
			return FALSE;
		}
		else
			return TRUE;
	}
	
	/**
	 * Salva XML em arquivo
	 * 
	 * @param $filename Nome para o arquivo XML da resposta do Servidor
	 * 
	 * @return void
	 */
	public function save_into_a_file($filename)
	{
		$file = fopen($filename,"w");
		fwrite($file,$this->xml->asXML());
		fclose($file);
		return TRUE;
	}

	/**
	 * Retirado do Exemplo da API RPC do Plesk
	 * Exemplo de como efetuar o Parser de um resposta XML
	 * No caso, se espera a reposta a uma requisição de informações sobre o domínio (domain_info.xml)
	 * Resposta esperada em response_valid_domain_info.xml
	 * 
	 * @return void
	 * 
	 * @throws RequestException
	 */
	function checkResponse()
	{
		$resultNode = $this->$xml->domain->get->result;

		// check if request was successful
		if ('error' == (string)$resultNode->status)
		throw new RequestException("Plesk API returned error: " . (string)$resultNode->result->errtext);
	}
	function print_Response($path)
	{
		foreach ($this->$xml->xpath('/packet/siteapp/get_all_packages_list/result/package') as $resultNode) {
			echo "Apps id " . (string)$resultNode->id . " ";
			echo "name: ". (string)$resultNode->name . " (" . (string)$resultNode->version . ")";
			echo "\n";
		}
	}
}
?>