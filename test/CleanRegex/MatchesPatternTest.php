<?php
namespace Test\CleanRegex;

use CleanRegex\MatchesPattern;
use CleanRegex\Internal\Pattern;
use PHPUnit\Framework\TestCase;

class MatchesPatternTest extends TestCase
{
    /**
     * @test
     */
    public function shouldMatchPattern()
    {
        // given
        $pattern = new MatchesPattern(new Pattern('/[a-z]/'), 'welcome');

        // when
        $result = $pattern->matches();

        // then
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function shouldNotMatchPattern()
    {
        // given
        $pattern = new MatchesPattern(new Pattern('/^[a-z]+$/'), 'space space');

        // when
        $result = $pattern->matches();

        // then
        $this->assertFalse($result);
    }
}