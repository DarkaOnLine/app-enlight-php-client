<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data\Report;

/**
 * Extra request part of report detail
 */
class RequestExtra {

  /**
   * @var string
   */
  protected $_key;

  /**
   * @var mixed
   */
  protected $_value;

  /**
   * @return string
   */
  public function getKey() {
    return $this->_key;
  }

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->_value;
  }

  /**
   * @param string $key
   * @return \AppEnlight\Endpoint\Data\Report\RequestExtra
   */
  public function setKey($key) {
    $this->_key = (string) $key;
    return $this;
  }

  /**
   * @param mixed $value
   * @return \AppEnlight\Endpoint\Data\Report\RequestExtra
   */
  public function setValue($value) {
    $this->_value = $value;
    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    return array(
      $this->getKey() => $this->getValue()
    );
  }

}
