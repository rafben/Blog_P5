<?php

namespace App\Controllers;

use Framework\Http;
use Framework\Renderer;
use App\Models\Comment;

class Article extends Controller
{

    protected $modelName = \App\Models\Article::class;


    public function index()
    {
         /**
         *CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         */

        $articles = $this->model->findAll("created_at DESC");

        /**
         * 3. Affichage des articles
         */
        $pageTitle = "Accueil";


        //Renderer::twig('articles/index', compact('pageTitle', 'articles'));
        Renderer::twig('articles/index', [
            "pageTitle" => $pageTitle,
            "articles" => $articles,
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }

    public function show($article_id = null)
    {
        
        
        //affiche un seul article
        /**
         * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
         * 
         */

        $commentModel = new Comment;



        // On peut désormais décider : erreur ou pas ?!
        if ($article_id === null) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        

        /**
         * Récupération de l'article en question
         * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
         * jamais confiance à ce connard d'utilisateur ! :D
         */
        $article = $this->model->find($article_id);

        /**
         * Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */

        $commentaires = $commentModel->findAllWithArticle($article_id);


        /**
         * On affiche 
         */
        $pageTitle = $article['title'];

        Renderer::twig('articles/show', [
            'pageTitle' => $pageTitle,
            'article' => $article,
            'commentaires' => $commentaires,
            'article_id' => $article_id,
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }

    public function delete($id = null)
    {
        if (!$_SESSION['connected'] || $_SESSION['connected'] !== 'yes' || $_SESSION['niveau'] < 1) {
            Http::redirect( URL );
            
        }

        //supprime un article
        /**
         * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         * 
         * Il va donc falloir bien s'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         * Ensuite, on va pouvoir effectivement supprimer l'article et rediriger vers la page d'accueil
         */

        /**
         * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if ($id === null) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }



        /**
         * 3. Vérification que l'article existe bel et bien
         */
        $article = $this->model->find($id);

        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * 4. Réelle suppression de l'article
         */
        $this->model->delete($id);

        /**
         * 5. Redirection vers la page d'accueil
         */
        Http::redirect(URL . "/article");
    }

    public function add()

    {
        if (!$_SESSION['connected'] || $_SESSION['connected'] !== 'yes' || $_SESSION['niveau'] < 1) {
            Http::redirect( URL );
        }
        $date = date("Y-m-d  H:i:s ");


    
        if (!empty($_POST)) {

            $input_params = [
                'title' =>[
                    'filter' => FILTER_SANITIZE_STRING,
                ],
               
                'intro' => [
                    'filter'  => FILTER_SANITIZE_STRING,
                ],
                'content' => [
                    'filter'  => FILTER_SANITIZE_STRING
                ],
                
            ];

            $inputs = (object)filter_input_array(INPUT_POST, $input_params);

            //$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs->title)));

            $slug = Http::slugify($inputs->title);
       
            if ($this->model->add($inputs->title, $slug, $inputs->intro, $inputs->content)) {
                Http::redirect(URL . "/article" );
            } else {
                $this->index("merci de réessayer");
            }


            
        }
    }

}