<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Service\Interface\MessageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/messages')]
class MessageController extends AbstractController
{

    private const REDIRECT_MESSAGES = 'app_messages_index';

    public function __construct(private readonly MessageServiceInterface $messageServices)
    {
    }

    #[Route('/', name: self::REDIRECT_MESSAGES, methods: ['GET'])]
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
            $this->messageServices->create($message);

            return $this->redirectToRoute(self::REDIRECT_MESSAGES, [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/new.html.twig', compact('form', 'message'));
    }

    #[Route('/{id}', name: 'app_message_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Message $message): Response
    {
        return $this->render('message/show.html.twig', compact('message'));
    }

    #[Route('/{id}/edit', name: 'app_message_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageServices->update($message);

            return $this->redirectToRoute(self::REDIRECT_MESSAGES, [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/edit.html.twig', compact('form', 'message'));
    }

    #[Route('/{id}', name: 'app_message_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $this->messageServices->delete($message);
        }

        return $this->redirectToRoute(self::REDIRECT_MESSAGES, [], Response::HTTP_SEE_OTHER);
    }
}
