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

class Dec extends Calc {
  function __construct()
  {
    echo 'dec: ';
  }

  public function convert()
  {
    return base_convert($this->result,10,10);
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

$param = [ 7, 15];

if ( isset( $_GET['param_1'] ) && is_numeric( $_GET['param_1'] ) )
{
  $param[0] = $_GET['param_1'];
}
if ( isset( $_GET['param_2'] ) && is_numeric( $_GET['param_2'] ) )
{
  $param[1] = $_GET['param_2'];
}

echo "Params:"."<br>";
echo 1 . ':' . $param[0] . "<br>";
echo 2 . ':' . $param[1] . "<br>";
echo "==============="."<br>";

$calc = new Dec();
$calc->multiply( $param[0], $param[1]);
echo $calc->result();
unset($calc);

$calc = new Hex();
$calc->multiply( $param[0], $param[1]);
echo $calc->result();
unset($calc);

$calc = new Binary();
$calc->multiply( $param[0], $param[1]);
echo $calc->result();
unset($calc);
