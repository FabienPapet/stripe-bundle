<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpVersion(PhpVersion::PHP_81);
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    $rectorConfig->sets([
        SymfonySetList::SYMFONY_54,
        SymfonySetList::SYMFONY_60,
        SetList::DEAD_CODE,
    ]);
};
