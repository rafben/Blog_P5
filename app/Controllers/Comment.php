<?php

namespace App\Controllers;

use Framework\Http;
use App\Models\Article;


class Comment extends Controller
{

    protected $modelName = \App\Models\Comment::class;


    public function insert()
    {
        /**
         * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
         * 
         * On doit d'abord vérifier que toutes les informations ont été entrées dans le formulaire
         * Si ce n'est pas le cas : un message d'erreur
         * Sinon, on va sauver les informations
         * 
         * Pour sauvegarder les informations, ce serait bien qu'on soit sur que l'article qu'on essaye de commenter existe
         * Il faudra donc faire une première requête pour s'assurer que l'article existe
         * Ensuite on pourra intégrer le commentaire
         * 
         * Et enfin on pourra rediriger l'utilisateur vers l'article en question
         */

        $articleModel = new Article();

        /**
         * 1. On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */
        // On commence par l'author
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        // l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        /**
         * 2. Vérification que l'id de l'article pointe bien vers un article qui existe
         * Ca nécessite une connexion à la base de données puis une requête qui va aller chercher l'article en question
         * Si rien ne revient, la personne se fout de nous.
         * 
         * Attention, on précise ici deux options :
         * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
         * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
         * 
         * PS : Ca fait pas genre 3 fois qu'on écrit ces lignes pour se connecter ?! 
         */

        $article = $articleModel->find($article_id);

        /*$query = $pdo->prepare('SELECT * FROM articles WHERE id = :article_id');
        $query->execute(['article_id' => $article_id]);*/

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas !");
        }

        // 3. Insertion du commentaire
        $this->model->insert($author, $content, $article_id);

        // 4. Redirection vers l'article en question :
        Http::redirect(URL . "/article/show/" . $article_id);
    }

    public function delete()

    {
        if (!$_SESSION['connected'] || $_SESSION['connected'] !== 'yes' || $_SESSION['niveau'] < 1) {
            Http::redirect(URL);
        }
        /**
         * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
         * 
         * On va donc vérifier que le paramètre "id" est bien présent en GET, qu'il correspond bien à un commentaire existant
         * Puis on le supprimera !
         * Récupération du paramètre "id" en GET
         */

        $id = PARAMS[0];

        if (empty($id)) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }



        /**
         * Vérification de l'existence du commentaire
         */
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        /**
         * Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */

        $article_id = $commentaire['article_id'];

        $this->model->delete($id);

        /**
         * Redirection vers l'article en question
         */
        Http::redirect(URL . "/article/show/" . $article_id);
    }
}
