<?php

namespace App\Models;

use App\Models\Model;

class Contact extends Model
{
 
        public function contact()
        {
              
          if(!empty($_POST["send"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $object = $_POST["object"];
            $message = $_POST["message"];

        
            $result =  'INSERT INTO contact (name, email, object, message) 
                        VALUES (:name, :email, :object, :message)';
            
            if($result){
              $db_msg = "Vos informations de contact sont enregistrées avec succés.";
              $type_db_msg = "success";
            }else{
              $db_msg = "Erreur lors de la tentative d'enregistrement de contact.";
              $type_db_msg = "error";
            }
            
        
        }
    }
}