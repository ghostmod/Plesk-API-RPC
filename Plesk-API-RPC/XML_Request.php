<?php
/**
 * 
 * Cria o arquivo XML da Requisição
 * 
 * baseado no exemplo de http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
 *
 */
class XML_Request

{
	/**
	 * Create a XML to get domains info
	 * Exemplo de como se pode criar um XML direto do código
	 * baseado no exemplo de http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
	 *
	 * @return DOMDocument
	 * 
	 * @throws Exception
	 */
	static function domainsInfoRequest()
	{
		$xmldoc = new DomDocument('1.0', 'UTF-8');
		$xmldoc->formatOutput = true;

		// <packet>
		$packet = $xmldoc->createElement('packet');
		$packet->setAttribute('version', '1.4.1.2');
		$xmldoc->appendChild($packet);

		// <packet/domain>
		$domain = $xmldoc->createElement('domain');
		$packet->appendChild($domain);

		// <packet/domain/get>
		$get = $xmldoc->createElement('get');
		$domain->appendChild($get);

		// <packet/domain/get/filter>
		$filter = $xmldoc->createElement('filter');
		$get->appendChild($filter);

		// <packet/domain/get/dataset>
		$dataset = $xmldoc->createElement('dataset');
		$get->appendChild($dataset);

		// dataset elements
		$dataset->appendChild($xmldoc->createElement('limits'));
		$dataset->appendChild($xmldoc->createElement('prefs'));
		$dataset->appendChild($xmldoc->createElement('user'));
		$dataset->appendChild($xmldoc->createElement('hosting'));
		$dataset->appendChild($xmldoc->createElement('stat'));
		$dataset->appendChild($xmldoc->createElement('gen_info'));
		
		return $xmldoc;
	}
	
    /**
	 * Create a XML to get the packages (apps) avaiables in the server
	 * Exemplo de como se pode criar um XML direto do código
	 * baseado no exemplo de http://download1.parallels.com/Plesk/Plesk8.4/Doc/en-US/plesk-8.4-api-rpc-guide/index.htm
	 *
	 * @return DOMDocument
	 * 
	 * @throws Exception
	 */
	static function  get_all_packages_list()
	{
		/**
		 * Return this XML
		 * 
		 * <packet version="1.4.2.0">
		 *<siteapp>
		 *  <get_all_packages_list/>
		 *</siteapp>
		 *</packet>
		 */
		$xmldoc = new DomDocument('1.0', 'UTF-8');
		$xmldoc->formatOutput = true;

		// <packet>
		$packet = $xmldoc->createElement('packet');
		$packet->setAttribute('version', '1.4.1.2');
		$xmldoc->appendChild($packet);

		// <packet/siteapp>
		$siteapp = $xmldoc->createElement('siteapp');
		$packet->appendChild($siteapp);

		// <packet/siteapp/get_all_packages_list>
		$get_all_packages_list = $xmldoc->createElement('get_all_packages_list');
		$siteapp->appendChild($get_all_packages_list);

		return $xmldoc;
	}
	
	/**
	 * Cria um DOMDocument de um arquivo XML
	 *
	 * @return DOMDocument
	 * 
	 * @throws Exception
	 */
	static function get_XML_from_file($filename)
	{
		$xmldoc = new DOMDocument();
		if ($xmldoc->load($filename))
			return $xmldoc;
		throw new Exception();
		return NULL;
	}
}

?>