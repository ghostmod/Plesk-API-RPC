<?php

require_once 'PHPUnit\Framework.php';
require_once 'Request_Exception.php';
require_once 'Plesk_Server_Request.php';
require_once 'XML_Request.php';

class Plesk_Server_Request_Tester extends PHPUnit_Framework_TestCase
{
/**
* use a valid plesk server
*/
	public function test_connect_to_valid_plesk_server()
	{
		$plesk_request = new Plesk_Server_Request($host,$login,$passwd);
		$xml = XML_Request::domainsInfoRequest();
		$plesk_request->getXML_Response($xml);
		$this->assertNotNull($plesk_request);
	}
	
	public function test_invalid_XML()
	{
		$this->markTestIncomplete();
	}
	/*
	 * @expectedException Request_Exception
	 */
	public function test_connect_to_Not_Valid_Plesk_Server()
	{
		$plesk_request = new Plesk_Server_Request("200.200.200.200","admin","snehalsk");
		$xml = XML_Request::domainsInfoRequest();
		$plesk_request->getXML_Response($xml);
		$this->assertNull($plesk_request);
	}

	public function test_receive_XML_from_Plesk_Server()
	{
		$this->markTestIncomplete();
	}

}
?>