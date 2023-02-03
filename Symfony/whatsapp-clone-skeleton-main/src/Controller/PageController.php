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
    #[Route('/post/touser/{toUserId}', name: 'send-message')]
    public function message(ManagerRegistry $doctrine, int $toUserId, Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $repository = $doctrine->getRepository(User::class);
            $toUser= $repository->find($toUserId);
            $message->setFromUser($this->getUser());
            $message->setToUser($toUser);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
        }
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'form'=> $form->createView()
    
        ]);
    }
    #[Route('/messages/from/{toUserId}', name:'open-chat')]
    public function chat(ManagerRegistry $doctrine, int $toUserId): JsonResponse
    {
        $repository = $doctrine->getRepository(Message::class);
        $userId=$this->getUser()->getId();
        $messages = $repository->findOurMessages($toUserId,$userId);
        $data=[];
        $repositoryUser = $doctrine->getRepository(User::class);
        $toUser = $repositoryUser->find($toUserId);
        foreach($messages as $message){
            $item=[
               /*  "id"=> $message ->getId(), */
                "text"=>$message->getText(),
                "formUser"=>$message->getFromUser()->getId(),
                "timestamp"=>$message->getTimestamp(),
                "toUser"=> $message->getToUser()->getId(), 
                "name"=>$message->getFromUser()->getUserName(),
            ];
            $data[] = $item;
        }

        return new JsonResponse($data, Response::HTTP_OK);
        
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
