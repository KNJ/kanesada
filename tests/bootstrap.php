<?php

require_once __DIR__.'/../vendor/autoload.php';

function fixture(string $filename): string
{
    return file_get_contents(__DIR__.'/fixtures/'.$filename);
}
