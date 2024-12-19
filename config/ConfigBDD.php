<?php 
class Database {
   private static $instance = NULL;
   private $connexion;

   private $host = 'localhost';
   private $port =3306;
   private $db_name = 'sae_301_conservatoire2';
   private $user_name = 'root';
   private $password = 'root';

   private function __construct(){
      $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db_name";
      try{
         $this->connexion = new PDO($dsn,$this->user_name, $this->password);
         $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
         // définir l'encodage des caractères en UTF-8
         $this->connexion->exec("SET NAMES 'utf8'");
      } catch(PDOException $e){
         echo "Échec lors de la connexion : ". $e->getMessage();
         exit;
      }
   }

   public static function getInstance(){
      if (is_null(self::$instance)) {
         self::$instance = new Database();
      }
      return self::$instance;
   }

   // obtenir la connexion PDO
   public function getConnexion(){
      return $this->connexion;
   }

   // fermer la connexion
   public function closeConnexion(){
      $this->connexion = null;
   }
}
?>
