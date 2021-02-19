<?php defined('BASEPATH') or exit('No direct script access allowed');

class Refresh_controller extends CI_Controller {

  public function refresh(){

          $hostname = $this->db->hostname;
          $database = $this->db->database;
          $username = $this->db->username;
          $password = $this->db->password;

          $mysqli = mysqli_connect($hostname, $username, $password, $database);
          
          // Check for errors
          if (mysqli_connect_errno()){
              echo "mysqli not connect";
          }

          $found_tables = array();
      /* query all tables */
          $sql = "SHOW TABLES WHERE tables_in_".$database." not like 'ci_%'";
          if($result = mysqli_query($mysqli,$sql)){
            /* add table name to array */
            while($row = mysqli_fetch_row($result)){
              $found_tables[]=$row[0];
            }
          }
          else{
            die("Error, could not list tables.");
          }
  

          /* loop through and drop each table */
          foreach($found_tables as $table_name){
            $sql = "DROP TABLE $database.$table_name";
            if($result = mysqli_query($mysqli,$sql)){
              // echo "Success - table $table_name deleted.<br>";
            }
            else{
              // echo "Error deleting";
            }
          }

        // Open the default SQL file
        $query = file_get_contents('install/sql/install.sql');
        // Execute a multi query
        $multi_query = $mysqli->multi_query($query);
        // Close the connection
        $mysqli->close();

   }

}