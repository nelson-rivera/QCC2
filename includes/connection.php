<?php
include_once 'file_const.php';    
    function openConnection()
    {
        try
        {
           $link = new PDO('mysql:host='.var_host_db.';port=3306;dbname='.var_name_db,var_user_db,var_pss_db,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        }
        catch (PDOException $e) 
        {
            echo "Error en la conexión a base de datos: " . $e->getMessage() . "<br/>";
            die();
        }
        return $link;
    }
?>