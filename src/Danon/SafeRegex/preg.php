<?php
namespace Danon\SafeRegex;

use Danon\SafeRegex\Constants\PregConstants;

class preg
{
    public static function match($pattern, $subject, array &$matches = null, $flags = 0, $offset = 0)
    {
        $result = preg_match($pattern, $subject, $matches, $flags, $offset);
        self::validateResult('preg_match', $result);
        return $result;
    }

    public static function match_all($pattern, $subject, array &$matches = null, $flags = PREG_PATTERN_ORDER, $offset = 0)
    {
        $result = preg_match_all($pattern, $subject, $matches, $flags, $offset);
        self::validateResult('preg_match_all', $result);
        return $result;
    }

    public static function replace($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        $result = preg_replace($pattern, $replacement, $subject, $limit, $count);
        self::validateResult('preg_replace', $result);
        return $result;
    }

    public static function replace_callback($pattern, callable $callback, $subject, $limit = -1, &$count = null)
    {
        $result = preg_replace_callback($pattern, $callback, $subject, $limit, $count);
        self::validateResult('preg_replace_callback', $result);
        return $result;
    }

    public static function replace_callback_array($patterns_and_callbacks, $subject, $limit = -1, &$count)
    {
        $result = preg_replace_callback_array($patterns_and_callbacks, $subject, $limit, $count);
        self::validateResult('preg_replace_callback_array', $result);
        return $result;
    }

    public static function filter($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        $result = preg_filter($pattern, $replacement, $subject, $limit, $count);
        self::validateResult('preg_filter', $result);
        return $result;
    }

    public static function split($pattern, $subject, $limit = -1, $flags = 0)
    {
        $result = preg_split($pattern, $subject, $limit, $flags);
        self::validateResult('preg_split', $result);
        return $result;
    }

    public static function grep($pattern, array $input, $flags = 0)
    {
        $result = preg_grep($pattern, $input, $flags);
        self::validateResult('preg_grep', $result);
        return $result;
    }

    public static function quote($string, $delimiter = null)
    {
        return preg_quote($string, $delimiter);
    }

    private static function validateResult(string $methodName, $result)
    {
        (new ExceptionFactory())->retrieveGlobalsAndThrow($methodName, $result);
    }

    public static function last_error()
    {
        return preg_last_error();
    }

    public static function last_error_constant(): string
    {
        return (new PregConstants())->getConstant(preg_last_error());
    }

    public static function error_constant(int $error): string
    {
        return (new PregConstants())->getConstant($error);
    }
}