<?php
namespace Trunk\Component\Http;

interface ResponseInterface {

	public function setContent( array $data );
	public function addContent( $name, $value );
	public function getContent( $name );
	public function getCode();
	public function setCode( $code );
}
