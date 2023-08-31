<?php
namespace Trunk\Component\Http;

class Request
{
	protected $get = array();
	protected $post = array();
	protected $raw = array();
	private $method = "";

	public function __construct( array $get, array $post, array $raw = [] ) {
		$this->get = $get;
		$this->post = $post;
		$this->raw = $raw;

		$this->method = strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function raw( $name, $default = null ) {
		if( isset( $this->raw[ $name ] ) ) {
			return $this->raw[ $name ];
		}

		return $default;
	}

	public function post( $name, $default = null ) {
		if( isset( $this->post[ $name ] ) ) {
			return $this->post[ $name ];
		}

		return $default;
	}

	public function get( $name, $default = null ) {
		if( isset( $this->get[ $name ] ) ) {
			return $this->get[ $name ];
		}

		return $default;
	}

	public function request( $name, $default = null ) {
		if( isset( $this->get[ $name ] ) ) {
			return $this->get[ $name ];
		}
		if( isset( $this->post[ $name ] ) ) {
			return $this->post[ $name ];
		}
		if ( isset( $this->raw[ $name ] ) ) {
			return $this->raw[ $name ] ;
		}

		return $default;
	}

	public function toArray( $global = null ) {
		switch($global){
			case "post":
			case "POST":
				$results = $this->post;
				break;
			case "get":
			case "GET":
				$results = $this->get;
				break;
			case "raw":
			case "RAW":
				$results = $this->raw;
				break;
			default:
				$results = array_merge( array(), $this->get, $this->post, $this->raw );
				break;
		}

		return $results;
	}
}
