<?php

namespace App\Models;

use App\Models\Model;
use Exception;

class Admin extends Model
{

    public $table = "users";

    public function getUsers()
    {
        $query = $this->pdo->prepare('SELECT * FROM users ORDER BY id DESC LIMIT 0,5');
        
        $query->execute();
        $resultat = $query->fetch();
        
        return $resultat ;
    }
    
    public function actionUser($idUser, $action)
    {
        $sql = false;

        if ($action == 'activate') $sql = 'UPDATE users SET niveau = 2 WHERE id = ?';
        if ($action == 'desactivate') $sql = 'UPDATE users SET niveau = 0 WHERE id = ?';
        if ($action == 'delete') $sql = 'DELETE FROM users WHERE id = ?';
        
        if ($sql) {
            $query = $this->pdo->prepare($sql);
            $query->execute([$idUser]);

            if ($query->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception('Erreur sur l\'action');
        }
    }

    public function editRoleUser($idUser, $role)
    {

        $sql = 'UPDATE users SET niveau = ? WHERE id = ?';

        $query = $this->pdo->prepare($sql);
        $query->execute([$role, $idUser]);

        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function actionComments($idUser, $action)
    {
        $sql = false;

        if ($action == 'activate') $sql = 'UPDATE comments SET published = 1 WHERE id = ?';
        if ($action == 'desactivate') $sql = 'UPDATE comments SET published = 0 WHERE id = ?';
        if ($action == 'delete') $sql = 'DELETE FROM comments  WHERE id = ?';
        
        if ($sql) {
            $query = $this->pdo->prepare($sql);
            $query->execute([$idUser]);

            if ($query->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception('Erreur sur l\'action');
        }
    }


}