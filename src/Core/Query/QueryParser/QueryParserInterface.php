<?php

declare(strict_types=1);

namespace Solarium\Core\Query\QueryParser;

/**
 * Query Parser Interface.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
interface QueryParserInterface
{
    /**
     * @return string
     */
    public function __toString(): string;
}