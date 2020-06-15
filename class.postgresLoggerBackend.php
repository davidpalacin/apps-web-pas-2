<?php

require("class.pdofactory.php");
require("abstract.databoundobject.php");

class postgresLoggerBackend { 
        public function __construct($urlData) {
                $strDSN = "pgsql:dbname=recutres;host=localhost;port=5432";
                $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", 
                    array());

                $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $objBackend = new Conn($objPDO);
    
                $objBackend->setmessage("mensaje1")->setloglevel(2)->setlogdate(date("1999/07/12"))->setmodule("modulo1")->Save();

                print "Mensaje: " . $objBackend->getmessage() . "<br />"; 
                print "Nivel: " . $objBackend->getloglevel() . "<br />"; 
                print "Fecha: " . $objBackend->getlogdate() . "<br />"; 
                print "Modulo: " . $objBackend->getmodule() . "<br />";
        }  
}

class Conn extends DataBoundObject{
        public $message;
        public $loglevel;
        public $logdate;
        public $module;
        public function DefineTableName() {
                return("logdata");
        }

        public function DefineRelationMap() {
                return(array(
                        "message" => "message",
                        "loglevel" => "loglevel",
                        "logdate" => "logdate",
                        "module" => "module"));
        }
}


?>