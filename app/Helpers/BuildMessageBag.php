<?php

namespace App\Helpers;

use Illuminate\Support\MessageBag;

class BuildMessageBag
{
    public $bag = null;

    public function __construct(private $content = []) {}

    /**
     * 
     */
    public function initialiseBag(): void
    {
        $messageBag = new MessageBag();
        $this->bag = $messageBag;
    }

    /**
     * 
     */
    public function addKeyValueToBag($bag, $key, $message): void
    {
        $this->bag->add($key, $message);
    }
}
