<?php

/**
 * @link: https://github.com/aztech/app-enlight-php-client
 * @link: http://appenlight.com
 * @package AppEnlight
 *
 * @author Tomasz Suchanek <tomasz.suchanek@gmail.com>
 */

namespace AppEnlight\Endpoint\Data\Report;

class Tag {

  /**
   * @var string
   */
  protected $_tag;

  /**
   * @var mixed
   */
  protected $_value;

  /**
   * @return string
   */
  public function getTag() {
    return $this->_tag;
  }

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->_value;
  }

  /**
   * @param string $tag
   * @return \AppEnlight\Endpoint\Data\Report\Tag
   */
  public function setTag($tag) {
    $this->_tag = $tag;
    return $this;
  }

  /**
   * @param mixed $value
   * @return \AppEnlight\Endpoint\Data\Report\Tag
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
      $this->getTag() => $this->getValue()
    );
  }

}
