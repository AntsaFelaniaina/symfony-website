<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    //inject doctrine into the constructor of the controller to use it
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
    
        /*$article = new Articles();
        $article->setTitle("our first article");

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response("The first article is created");*/


        // return $this->render('article/index.html.twig', [
        //     'controller_name' => 'ArticleController',
        // ]);

        //second methode
        $article = new Articles();
        $article->setTitle("our second article");
        $em = $this->doctrine->getManager();
        $em->persist($article);
        $em->flush();
        return new Response("The second article is created");
    }

    #[Route('/article/one', name: 'one_article')]
    public function findAll(): Response
    {
        $em = $this->doctrine->getManager();
        $getArticle = $em->getRepository(Articles::class)->findOneBy(['id' => '1']);

        return $this->render('article/index.html.twig',[
            'article' => $getArticle
        ]);
    }

    #[Route('/article/delete', name: 'delete_article')]
    public function delete(): Response
    {
        $em = $this->doctrine->getManager();
        $getArticle = $em->getRepository(Articles::class)->findOneBy(['id' => '1']);

        $em->remove($getArticle);
        $em->flush();

        return new Response("Article deleted");
    }
}
