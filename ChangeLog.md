T-Regx Changelog
================

This file is to keep track of enhancements and bug fixes in different versions of T-Regx.

Added in 1.0
---------------

* Features
    * `PatternBuilder` with `inject()`, `prepare()` and `compose()`!
    * General development (refactor, clean, removed unused code)
    * Add `Match.groups()` and `Match.limit()`
    * Returning from `match()->first(callable)` modifies its return type
    * Add `replace()->all()`, `replace()->first()` and `replace()->only(int)`
    * Add `pattern()->remove()`
    * Add `match()->only(int)`
    * Add `match()->flatMap()`
    * Pass flags as `pattern()` second argument
    * Add `ReplaceMatch.modifiedSubject()`
    * Add UTF-8 support for methods `offset()`, `modifiedOffset()` and `modifiedSubject()`
    * Add `match()->group()->all()`, `match()->group()->first()` and `match()->group()->only()`
    * Add `match()->forFirst()` with methods `orReturn()`, `orElse()` and `orThrow()`
    * `orThrow()` can instantiate exceptions by class name (with one of predefined constructor signatures)
    * `match()->first()` throws on unmatched subject and on unmatched group
    * Add `match()->iterator()`
    * Use `PREG_UNMATCHED_AS_NULL` if PHP version is supported
    * Add `CompositePattern` (#8)
    * Add `split()->filter()`
    * `match->only(i)` calls `preg_match` for `i=1`, and `preg_match_all` for other values
    * Add `group()->all()` to `Match`
    * Add `groupsCount()` to `NotMatched`
    * `pattern()->match()` is `\Countable`
    * Add user data to `Match`
* Tests
    * Split tests into `\Test\Unit`, `\Test\Integration`, `\Test\Functional` and `\Test\Feature` folders 
    * Add dynamic skip for `ErrorsCleanerTest`
    * Add test for `ReplacePatternAll`, `ErrorsCleaner.getError()`, `ValidPatternTest.shouldNotLeaveErrors()`,
 `GuardedExecution.silenced()`, `GuardedExecutionTest.shouldNotCatchException()`, `FailureIndicators`,
      `ReplaceCallbackObject`, `ReplacePatternCallbackInvoker` from 1.0.
    * Handle [PHP bugfix in 7.1.13](https://bugs.php.net/bug.php?id=74183).
* Debug
    * Add `pregConstant` field to `RuntimeError`. Only reason to do it is so if you **catch the exception it 
    in debugger**, you'll see constant name (ie. `PREG_BAD_UTF8_ERROR`) instead of constant value (ie. `4`).
* Other
    * Set `\TRegx` namespace prefix
    * Add MIT license
    * `preg_match()` won't return unmatched groups at the end of list, which makes validating groups and general
      work with group names impossible. Thanks to `GroupPolyfillDecorator`, a second call to `preg_match_all()` is done
      to get a list of all groups (even unmatched ones). The call to `preg_match_all()` is of course only in the case
      of `Match.hasGroup()` or similar method. Regular methods like `Match.text()` won't call `preg_match_all()`
    * Handle bug [PHP #75355](https://bugs.php.net/bug.php?id=75355)

API
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
      (ie. `preg::error_constant(4) == 'PREG_BAD_UTF8_ERROR'`).

* CleanRegex
    * Automatic delimiter (ie. `pattern('[A-Z]')`)
    * Matching API
        * `pattern()->matches()`
        * `pattern()->fails()`
        * `pattern()->match()->all()`
        * `pattern()->match()->first()`
        * `pattern()->match()->map()`
        * `pattern()->match()->flatMap()`
        * `pattern()->match()->forEach()` / `iterate()`
        * `pattern()->match()->iterator()`
        * `pattern()->match()->offsets()`
            * `->first()`
            * `->all()`
            * `->only(int)`
        * `pattern()->match()->group(name|index)`
            * `->first()`
            * `->all()`
            * `->only(int)`
        * `pattern()->match()->group(name|index)->offsets()`
            * `->first()`
            * `->all()`
            * `->only(int)`
        * `pattern()->match()->forFirst()`
            * `->orReturn(mixed)`
            * `->orElse(callable)`
            * `->orThrow(className|null)`
        * `Match` details:
            * `Match.match()` / `Match.__toString()` / `(string) $match`
            * `Match.subject()`
            * `Match.index()`
            * `Match.limit()`
            * `Match.offset()`
            * `Match.byteOffset()`
            * `Match.group(string|int)`
            * `Match.groups()`
            * `Match.groups().offsets()`
            * `Match.namedGroups().*`
            * `Match.groupNames()`
            * `Match.matched(string|int)`
            * `Match.hasGroup(string|int)`
            * `Match.all()`
            * `Match.setUserData()`/`Match.getUserData()`
        * `NotMatched` details
            * `NotMatched.subject()`
            * `NotMatched.groupNames()`
            * `NotMatched.groupsCount()`
            * `NotMatched.hasGroup(string|int)`
    * Replace API
        * `pattern()->replace()->all()`
            * `->with()`
            * `->withRaw()`
            * `->callback()`
        * `pattern()->replace()->first()`
            * `->with()`
            * `->withRaw()`
            * `->callback()`
        * `pattern()->replace()->only(int)`
            * `->with()`
            * `->withRaw()`
            * `->callback()`
        * `ReplaceMatch` details (extending `Match` details)
            * `ReplaceMatch.modifiedOffset()`
            * `ReplaceMatch.modifiedSubject()`
            * `ReplaceMatch.allUnlimited()`
    * Remove API
        * `pattern()->remove()->all()`
        * `pattern()->remove()->first()`
        * `pattern()->remove()->only(int)`
    * Other API
        * `pattern()->filter()`
        * `pattern()->split()->ex()`
        * `pattern()->split()->inc()`
        * `pattern()->split()->filter()->*`
        * `pattern()->count()`
        * `pattern()->quote()`
        * `pattern()->is()->valid()`
        * `pattern()->is()->usable()`
        * `pattern()->is()->delimitered()`
        * `pattern()->delimitered()`
    * Building Pattern API
        *  `PatternBuilder::inject()`/`Pattern::inject()`
        *  `PatternBuilder::prepare()`/`Pattern::prepare()`
        *  `PatternBuilder::compose()`/`Pattern::compose()`
