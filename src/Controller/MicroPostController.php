<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MicroPostController extends AbstractController
{
    #[Route('/micro/post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->findAll());

        //adding to database
        // $microPost = new MicroPost();
        // $microPost->setTitle('It comes from controller');
        // $microPost->setText('Here akki');
        // $microPost->setCreated(new DateTime());
        // $posts->save($microPost,true);

        //update record
        // $microPost = $posts->find(4);
        // $microPost->setTitle('Welcome in general');
        // $posts->save($microPost,true);
        
        return $this->render('micro_post/index.html.twig',[
            'posts' => $posts->findAll()
        ]);
    }
    #[Route('/micro/post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig',[
            'post' => $post
        ]);
    }
    
    #[Route('/micro/post/add', name: 'app_micro_post_add',priority:2)]
    public function add(Request $request, MicroPostRepository $posts): Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
        ->add('title')
        ->add('text')
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new DateTime());
            $posts->save($post,true);
            
            // add a flash
            $this->addFlash('success','Your micro post has been added');
            return $this->redirectToRoute('app_micro_post');
            // redirect to other page
        }
        return $this->render('micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
