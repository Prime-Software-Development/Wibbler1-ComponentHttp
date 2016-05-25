<?php
namespace TrunkSoftware\Component\Http;

class Request
{
	protected $get = array();
	protected $post = array();

	public function __construct( array $get, array $post ) {
		$this->get = $get;
		$this->post = $post;
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
			default:
				$results = array_merge( array(), $this->get, $this->post );
				break;
		}

		return $results;
	}
}