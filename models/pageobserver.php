<?php

class PageObserver implements SplObserver {

    /**
     * @var Notification model
     */
    private $notification;

    /**
     * PageObserver constructor.
     */
    public function __construct()
    {
        $this->notification = new Notification();
    }


    /**
     * @param SplSubject $page
     * @return string
     */
    public function update(SplSubject $page)
    {
        $userId = $page->getActiveUser()['id'];
        $userLogin = $page->getActiveUser()['login'];
        $pageId = $_POST['id'];

        $message = "Page with ID $pageId was edited by user with ID $userId and Login \"$userLogin\"";

        $this->notification->save($message);

    }

}