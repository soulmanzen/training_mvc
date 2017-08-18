<?php

class Model implements SplSubject
{
    /**
     * @var connect to DB
     */
    protected $db;

    /**
     * @var SplObjectStorage
     */
    protected $observers;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = App::getDb();
        $this->observers = new SplObjectStorage();
    }

    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}