<?php

class Logger {
  public $url_parseada;

  public $DEBUG     = 100;
  public $INFO      = 75;
  public $NOTICE    = 50;
  public $WARNING   = 25;
  public $ERROR     = 10;
  public $CRITICAL  = 5;
  
   public function __construct($url) {
    $url_parseada = $url;

    $urlData = parse_url($url_parseada); 
 
    echo 'class.'.$urlData['scheme'].'LoggerBackend.php';
    if(! isset($urlData['scheme'])) { 
      throw new Exception("Invalid log connection string $connectionString");
    }
    
    include_once('class.'.$urlData['scheme'].'LoggerBackend.php');

    $className = $urlData['scheme'].'LoggerBackend'; 

    echo "<br>";
    
    echo $className;

    if(!class_exists($className)) { 
      throw new Exception('No logging backend available for '.$urlData['scheme']); 
    } 
    $objBack = new $className($urlData); 

    
  }
}
?>