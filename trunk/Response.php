<?php
namespace TrunkSoftware\Component\Http;
use TrunkSoftware\Component\Errors\ErrorInterface;
use TrunkSoftware\Component\Errors\ErrorBag;

/**
 * Created by PhpStorm.
 * User: trunk
 * Date: 05/01/16
 * Time: 16:55
 */

class Response implements ResponseInterface {

	private $errors;
	private $data;

	// response code e.g. HTTP status code
	private $code;

	public function __construct( $data = array(), $code = null ) {

		$this->errors = new ErrorBag();

		$this->data = $data;
		$this->code = $code;

	}

	public function setContent( array $data ) {
		$this->data = $data;
		return $this;
	}

	public function addMergeContent( array $data ) {
		if( !$this->errors->getCount() )
			$this->data = array_merge( $this->data, $data );
		return $this;
	}

	public function addContent( $name, $value = null ) {
		if(is_array( $name )) {
			foreach( $name as $name => $value ) {
				$this->data[ $name ] = $value;
			}
		} else {
			$this->data[ $name ] = $value;
		}

		return $this;
	}

	public function removeContent( $name ) {
		if( isset( $this->data[ $name ]) ) {
			unset( $this->data[ $name ] );
		}
		return $this;
	}

	public function clearContent() {
		$this->data = array();
		return $this;
	}

	public function getContent( $name = null ) {
		return !$name ? $this->data :
				(isset($this->data[ $name ]) ? $this->data[ $name ] : NULL);
	}

	public function getCode() {
		return $this->code;
	}

	public function setCode( $code ) {
		$this->code = $code;
		return $this;
	}

	public function setError( ErrorInterface $error ) {
		$this->setCode( $error->getErrorCode() );
		$this->addError( $error );
		return $this;
	}

	public function addError( ErrorInterface $error ) {
		$this->errors->addError( $error );
		return $this;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function hasErrors() {
		return $this->errors->getCount();
	}
}