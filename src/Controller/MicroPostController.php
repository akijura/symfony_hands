<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro/post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): JsonResponse
    {
        //dd($posts->findAll());

        //adding to database
        // $microPost = new MicroPost();
        // $microPost->setTitle('It comes from controller');
        // $microPost->setText('Here akki');
        // $microPost->setCreated(new DateTime());
        // $posts->save($microPost,true);

        //update record
        $microPost = $posts->find(4);
        $microPost->setTitle('Welcome in general');
        $posts->save($microPost,true);
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MicroPostController.php',
        ]);
    }
}
