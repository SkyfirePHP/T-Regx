CleanRegex Changelog
====================

This file is to keep track of enhancments and bugfixes in different versions of CleanRegex.

Incoming in 1.1
---------------

* Features
    * General development (refactor, clean, unused code)
    * Add `Match.groups()`
    * Returning from `match()->first(callable)` modifies its return type
    * Add `replace()->all()`, `replace()->first()` and `replace()->only(int)`
    * Add `pattern()->remove()`
* Tests
    * Split tests into `\Test\Unit` and `\Test\Integration` folders 
    * Add dynamic skip for `ErrorsCleanerTest`
    * Add test for `ReplacePatternAll`, `ErrorsCleaner.getError()`, `ValidPatternTest.shouldNotLeaveErrors()`,
 `GuardedExecution.silenced()`, `GuardedExecutionTest.shouldNotCatchException()`, `FailureIndicators`,
      `ReplaceCallbackObject`, `ReplacePatternCallbackInvoker`.
    * Handle [PHP bugfix in 7.1.13](https://bugs.php.net/bug.php?id=74183).
* Debug
    * Add `pregConstant` field to `RuntimeError`. Only reason to do it is so if you **catch the exception it 
    in debugger**, you'll see constant name (ie. `PREG_BAD_UTF8_ERROR`) instead of constant value (ie. `4`).
* Other
    * Add MIT license

Features in 1.0
---------------

* SafeRegex
    * Create exact copies of `preg_match()`, `preg_match_all()`, `preg_replace()`, `preg_replace_callback()`, 
      `preg_replace_callback_array()`, `preg_filter()`, `preg_split()`, `preg_grep()`, `preg_quote()`,
      `preg_last_error()` methods.
    * Create SafeRegex `preg::match()`, `preg::match_all()`, `preg::replace()`, `preg::replace_callback()`, 
      `preg::replace_callback_array()`, `preg::filter()`, `preg::split()`, `preg::grep()`, `preg::quote()`,
      `preg::last_error()` methods.
    * `preg::*` SafeRegex methods never emit warnings or errors, but throw `SafeRegexException` instead.
    * Add additional utility method `preg::last_error_constant()`, which returns error constant as string
      (ie. `'PREG_RECURSION_LIMIT_ERROR'`), where as `preg_last_error()` and `preg::last_error()` return constant
      as integer (ie. `3`).
    * Additional `preg::error_constant(int)` method to change error constant from integer to string
      (ie. `preg::error_constant(PREG_BAD_UTF8_ERROR) == 4`).

* CleanRegex
    * Automatic delimiter (ie. `pattern('[A-Z]')`)
    * Matching API
        * `pattern()->matches()`
        * `pattern()->match()->all()`
        * `pattern()->match()->first()`
        * `pattern()->match()->map()`
        * `pattern()->match()->iterate()`
        * `Match` details:
            * `Match.match()` / `Match.__toString()` / `(string) $match`
            * `Match.subject()`
            * `Match.index()`
            * `Match.offset()`
            * `Match.group(string|int)`
            * `Match.groups()`
            * `Match.namedGroups()`
            * `Match.groupNames()`
            * `Match.hasGroup()`
            * `Match.matched(string|int)`
            * `Match.all()`
    * Replace API
        * `pattern()->replace()->all()->with()`
        * `pattern()->replace()->first()->with()`
        * `pattern()->replace()->only(int)->with()`
        * `pattern()->replace()->all()->callback()`
        * `pattern()->replace()->first()->callback()`
        * `pattern()->replace()->only(int)->callback()`
        * `ReplaceMatch` details (extending `Match` details)
            * `ReplaceMatch.modifiedOffset()`
            * `ReplaceMatch.allUnlimited()`
    * Other API
        * `pattern()->filter()`
        * `pattern()->split()->split()`
        * `pattern()->split()->separate()`
        * `pattern()->count()`
        * `pattern()->quote()`
        * `pattern()->valid()`
        * `pattern()->delimitered()`