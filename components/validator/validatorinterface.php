<?php

interface ValidatorInterface
{
    public function validate(array $array);

    public function getErrors();
}