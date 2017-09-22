<?php

namespace tests\PHPCTags\Acceptance;

final class TypeHintsTest extends AcceptanceTestCase
{
    /**
     * @test
     */
    public function itTagsClassFromFunctionReturnTypeHint()
    {
        $this->givenSourceFile('TypeHints.php', <<<'EOS'
<?php declare(strict_types=1);

function returns_a_class(): MyClass
{
}
EOS
        );

        $this->runPHPCtags();

        $this->assertTagsFileHeaderIsCorrect();
        $this->assertNumberOfTagsInTagsFileIs(2);
        $this->assertTagsFileContainsTag(
            'TypeHints.php',
            'MyClass',
            self::KIND_CLASS,
            3,
            'function:returns_a_class'
        );
    }

    /**
     * @test
     */
    public function itTagsClassFromNullableFunctionReturnTypeHint()
    {
        $this->givenSourceFile('TypeHints.php', <<<'EOS'
<?php declare(strict_types=1);

function returns_a_class(): ?MyClass
{
}
EOS
        );

        $this->runPHPCtags();

        $this->assertTagsFileHeaderIsCorrect();
        $this->assertNumberOfTagsInTagsFileIs(2);
        $this->assertTagsFileContainsTag(
            'TypeHints.php',
            'MyClass',
            self::KIND_CLASS,
            3,
            'function:returns_a_class'
        );
    }

    /**
     * @test
     */
    public function itTagsClassFromClassMethodReturnTypeHint()
    {
        $this->givenSourceFile('TypeHints.php', <<<'EOS'
<?php declare(strict_types=1);

class MyClass
{
    public function foo(): Bar
    {
    }
}
EOS
        );

        $this->runPHPCtags();

        $this->assertTagsFileHeaderIsCorrect();
        $this->assertNumberOfTagsInTagsFileIs(3);
        $this->assertTagsFileContainsTag(
            'TypeHints.php',
            'Bar',
            self::KIND_CLASS,
            5,
            'function:foo'
        );
    }

    /**
     * @test
     */
    public function itTagsClassFromNullableClassMethodReturnTypeHint()
    {
        $this->givenSourceFile('TypeHints.php', <<<'EOS'
<?php declare(strict_types=1);

class MyClass
{
    public function foo(): ?Bar
    {
    }
}
EOS
        );

        $this->runPHPCtags();

        $this->assertTagsFileHeaderIsCorrect();
        $this->assertNumberOfTagsInTagsFileIs(3);
        $this->assertTagsFileContainsTag(
            'TypeHints.php',
            'Bar',
            self::KIND_CLASS,
            5,
            'function:foo'
        );
    }
}
