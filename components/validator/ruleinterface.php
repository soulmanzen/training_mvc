<?php

interface RuleInterface
{
    public function validate(array $array, string $field);

    public function getErrors();
}