<?php
class MessageController
{
    private $model;

    public function __construct()
    {
        $this->model = Model::getModel();
    }

    public function sendMessage($content, $sentAt, $senderId, $receiverId, $annotationSender = null, $annotationRecipient = null)
    {
        $this->model->addMessageWithEmotion($content, $sentAt, $senderId, $receiverId, $annotationSender, $annotationRecipient);
    }

    public function getMessages($conversationId)
    {
        return $this->model->getMessagesFromConversation($conversationId);
    }

    public function annotateMessage($messageId, $annotatorId, $emotion)
    {
        $this->model->addAnnotation($messageId, $annotatorId, $emotion);
    }
}