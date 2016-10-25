<?php

abstract class Calc
{
  private $result;
  private $action;

  const ACTION_PLUS = 'Plus:';
  const ACTION_MINUS = 'Minus:';
  const ACTION_MULTIPLY = 'Multiply:';
  const ACTION_DIVIDE = 'Divide:';

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
    $this->action = self::ACTION_PLUS;
  }

  public function minus($args1, $args2)
  {
    $this->result = $args1 - $args2;
    $this->action = self::ACTION_MINUS;
  }

  public function multiply($args1, $args2)
  {
    $this->result = $args1 * $args2;
    $this->action = self::ACTION_MULTIPLY;
  }

  public function divide($args1, $args2)
  {
    if ($args2 == 0) {
      throw new Exception('Деление на ноль');
    }
    $this->result = $args1 / $args2;
    $this->action = self::ACTION_DIVIDE;
  }

  public function result()
  {
    echo $this->convert() . "<br>";
  }

  function __destruct()
  {
    echo "==============="."<br>";
  }
}

class Dec extends Calc {
  function __construct()
  {
    echo __CLASS__ . ': ' . "<br>";
  }

  public function convert()
  {
    return base_convert($this->result,10,10);
  }
}

class Hex extends Calc {
  function __construct()
  {
    echo __CLASS__ . ': ' . "<br>";
  }

  public function convert()
  {
    return base_convert($this->result,10,16);
  }
}

class Binary extends Calc {
  function __construct()
  {
    echo __CLASS__ . ': ' . "<br>";
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

foreach ( [ 'Dec', 'Hex', 'Binary' ] as $class_name ) {
  $calc = new $class_name();

  $calc->plus( $param[0], $param[1]);
  echo $calc->action;
  echo $calc->result();

  $calc->minus( $param[0], $param[1]);
  echo $calc->action;
  echo $calc->result();

  $calc->multiply( $param[0], $param[1]);
  echo $calc->action;
  echo $calc->result();

  $calc->divide( $param[0], $param[1]);
  echo $calc->action;
  echo $calc->result();

  unset($calc);
}
