<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        return $this->render('page/index.html.twig', [
            'form'=> $form->createView()
        ]); 

    }
    #[Route('/message/{toUserId}', name: 'send-message')]
    public function message(ManagerRegistry $doctrine, int $toUserId, Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $message->setFromUser($this->getUser());
            $message->setFromUser($toUserId);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
        }
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'form'=> $form->createView()
    
        ]);
    }

    #[Route('/contact', name: 'contact',  methods: ['GET'])]
    public function contact(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(User::class);
        $users = $repository->findAll();
        if (!$users)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);
        $data = [];
        foreach ($users as $user) {
            if ($this->getUser()->getId() == $user->getId())
                continue;
            $item = [

                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "info" => $user->getInfo(),
                "image" => $user->getImage()
                
            ];
            $data[] = $item;
        }    
        
        
        return new JsonResponse($data, Response::HTTP_OK);
    
        
    }
}
