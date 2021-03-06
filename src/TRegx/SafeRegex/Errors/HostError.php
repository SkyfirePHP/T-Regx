<?php
namespace TRegx\SafeRegex\Errors;

use TRegx\SafeRegex\Exception\SafeRegexException;

interface HostError
{
    public function occurred(): bool;

    public function clear(): void;

    public function getSafeRegexpException(string $methodName): SafeRegexException;
}
