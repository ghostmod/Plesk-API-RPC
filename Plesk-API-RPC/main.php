<?php
// Esta classe encapsula as Requisições a API RPC do plesk
include_once "Request.php";
/**
 * Em poucos passos, conecta-se ao Servidor Plesk,
 * envia um requisição via XML
 * e salva a resposta em outro XML
 */

$host='domain';
$login='login';
$passwd='password';

// Efetua uma requisição via XML domains_info.xml
$request = new Request($host,$login,$passwd);
$request->remote_action("domain_info.xml");

//Salva a resposta do Servidor em Response.xml
$xml_response="response.xml";
$is_save = $request->save_response($xml_response);

?>