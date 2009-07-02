<?php

include_once 'PHPUnit\Framework.php';
include_once "Request.php";

class Test_Request extends PHPUnit_Framework_TestCase
{

	public function test_Remote_Request_Valid_plesk_Server_get_error_response()
	{
		$request = new Request($host,$login,$passwd);
		$request->remote_action("request.xml");
		$this->assertNotNull($request->response);
		
		$xml_response="test_error_response_Valid_plesk.xml";
		$is_save = $request->save_response($xml_response);
		$this->assertTrue($is_save);
	}

	public function test_Remote_Request_Valid_plesk_Server_XML_Valid()
	{
		$request = new Request($host,$login,$passwd);
		$request->remote_action("domain_info.xml");
		$this->assertNotNull($request->response);
		
		$xml_response="test_response_Valid_plesk.xml";
		$is_save = $request->save_response($xml_response);
		$this->assertTrue($is_save);
		
		
	}

	public function test_Remote_Request_Not_Valid_plesk_Server()
	{
		$this->markTestIncomplete();
		$request = new Request($host,$login,$passwd);
		$request->remote_action("request.xml");
		$this->assertNull($request->response);
	}

	//@espectedException RequestEsception
}
?>