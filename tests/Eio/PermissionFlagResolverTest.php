<?php

namespace React\Tests\Filesystem\Eio;

use React\Filesystem\Eio\PermissionFlagResolver;

class PermissionFlagResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testResolveProvider()
    {
        return [
            [
                'r--------',
                256,
            ],
            [
                '-w-------',
                128,
            ],
            [
                '--x------',
                64,
            ],
            [
                '---r-----',
                32,
            ],
            [
                '----w----',
                16,
            ],
            [
                '-----x---',
                8,
            ],
            [
                '------r--',
                4,
            ],
            [
                '-------w-',
                2,
            ],
            [
                '--------x',
                1,
            ],
            [
                'rwxrwxrwx',
                511,
            ],
            [
                '-wxrwxrwx',
                255,
            ],
            [
                'r-xrwxrwx',
                383,
            ],
            [
                'rw-rwxrwx',
                447,
            ],
            [
                'rwx-wxrwx',
                479,
            ],
            [
                'rwxr-xrwx',
                495,
            ],
            [
                'rwxrw-rwx',
                503,
            ],
            [
                'rwxrwx-wx',
                507,
            ],
            [
                'rwxrwxr-x',
                509,
            ],
            [
                'rwxrwxrw-',
                510,
            ],
        ];
    }

    /**
     * @dataProvider testResolveProvider
     */
    public function testResolve($flags, $result)
    {
        $resolver = new PermissionFlagResolver();
        $this->assertSame($result, $resolver->resolve($flags));
    }
}
