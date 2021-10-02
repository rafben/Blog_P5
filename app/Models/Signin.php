<?php

namespace App\Models;

use App\Models\Model;

class Signin extends Model
{

    public function connect($email)
    {

        $sql = 'SELECT id, first_name, last_name, niveau, pwd
                    FROM users
                    WHERE email = :email
                    LIMIT 1';
        $query = $this->pdo->prepare($sql);
        $query->execute(["email" => $email]);

        if ($query->rowCount() == 1) {
            $user = $query->fetchObject();

            return $user;
        }
        return false;
    }
}
