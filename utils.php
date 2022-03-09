<?php

function getQueryArgument(string $key, mixed $defaultValue): mixed
{
    return $_GET[$key] ?? $defaultValue;
}
