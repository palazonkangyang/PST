<?php

class ReplacementArray {
	private $data = false;
	private $fss = false;

	/**
	 * Create an object with the specified replacement array
	 * The array should have the same form as the replacement array for strtr()
	 * @param array $data
	 */
	function __construct( $data = array() ) {
		$this->data = $data;
	}

	/**
	 * @return array
	 */
	function __sleep() {
		return array( 'data' );
	}

	function __wakeup() {
		$this->fss = false;
	}

	/**
	 * Set the whole replacement array at once
	 * @param array $data
	 */
	function setArray( $data ) {
		$this->data = $data;
		$this->fss = false;
	}

	/**
	 * @return array|bool
	 */
	function getArray() {
		return $this->data;
	}

	/**
	 * Set an element of the replacement array
	 * @param string $from
	 * @param string $to
	 */
	function setPair( $from, $to ) {
		$this->data[$from] = $to;
		$this->fss = false;
	}

	/**
	 * @param array $data
	 */
	function mergeArray( $data ) {
		$this->data = array_merge( $this->data, $data );
		$this->fss = false;
	}

	/**
	 * @param ReplacementArray $other
	 */
	function merge( $other ) {
		$this->data = array_merge( $this->data, $other->data );
		$this->fss = false;
	}

	/**
	 * @param string $from
	 */
	function removePair( $from ) {
		unset( $this->data[$from] );
		$this->fss = false;
	}

	/**
	 * @param array $data
	 */
	function removeArray( $data ) {
		foreach ( $data as $from => $to ) {
			$this->removePair( $from );
		}
		$this->fss = false;
	}

	/**
	 * @param string $subject
	 * @return string
	 */
	function replace( $subject ) {
		if ( function_exists( 'fss_prep_replace' ) ) {
			wfProfileIn( __METHOD__ . '-fss' );
			if ( $this->fss === false ) {
				$this->fss = fss_prep_replace( $this->data );
			}
			$result = fss_exec_replace( $this->fss, $subject );
			wfProfileOut( __METHOD__ . '-fss' );
		} else {
			wfProfileIn( __METHOD__ . '-strtr' );
			$result = strtr( $subject, $this->data );
			wfProfileOut( __METHOD__ . '-strtr' );
		}

		return $result;
	}
}