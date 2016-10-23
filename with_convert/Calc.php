<?php

abstract class Calc
{
  private $result;

  public function __get($property)
  {
    return $this->$property;
  }

  public function __set($property, $value)
  {
    $this->$property = $value;
  }

  public function plus($args1, $args2)
  {
    $this->result = $args1 + $args2;
  }

  public function minus($args1, $args2)
  {
    $this->result = $args1 + $args2;
  }

  public function multiply($args1, $args2)
  {
    $this->result = $args1 * $args2;
  }

  public function divide($args1, $args2)
  {
    if ($args2 == 0) {
      throw new Exception('Деление на ноль');
    }
    $this->result = $args1 / $args2;
  }

  public function result()
  {
    echo $this->convert();
  }

  function __destruct()
  {
    echo "<br>"."==============="."<br>";
  }
}

class Hex extends Calc {
  function __construct()
  {
    echo 'hex: ';
  }

  public function convert()
  {
    return base_convert($this->result,10,16);
  }
}

class Binary extends Calc {
  function __construct()
  {
    echo 'binary: ';
  }

  public function convert()
  {
    return base_convert($this->result,10,2);
  }
}

$calc = new Hex();
$calc->multiply(7, 15);
echo $calc->result();

$calc = new Binary();
$calc->multiply(7, 15);
echo $calc->result();