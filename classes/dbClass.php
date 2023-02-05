 <?php
        class dbClass
        {
          protected $conn;

          function __construct()
          {
          	   $this->conn=new mysqli("localhost", "root","","ijvs");
          }
        }
        $obj =new dbClass();
        
 ?>

