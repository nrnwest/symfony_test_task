<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Services\MessageServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/messages')]
class MessageController extends AbstractController
{

    public function __construct(private MessageServices $messageServices)
    {
    }

    #[Route('/', name: 'app_messages_index', methods: ['GET'])]
    public function index(): Response
    {
        $messages = $this->messageServices->getAll();

        return $this->render('message/index.html.twig', compact('messages'));
    }

    #[Route('/new', name: 'app_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $message = new Message();
        $form    = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageServices->write($message);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/new.html.twig',  compact('form', 'message'));
    }

    #[Route('/{id}', name: 'app_message_show', methods: ['GET'])]
    public function show(Message $message): Response
    {
        return $this->render('message/show.html.twig',  compact('message'));
    }

    #[Route('/{id}/edit', name: 'app_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageServices->update();

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/edit.html.twig', compact('form', 'message'));
    }

    #[Route('/{id}', name: 'app_message_delete', methods: ['POST'])]
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $this->messageServices->delete($message);
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}
