<?php

declare(strict_types=1);

/*
 * This file is part of the Solarium package.
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code.
 */

namespace Solarium\Core\Query\QueryParser;

/**
 * Boost.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 *
 * @see https://lucene.apache.org/solr/guide/other-parsers.html#boost-query-parser
 */
final class BoostQueryParser implements QueryParserInterface
{
    private const TYPE = 'boost';

    /**
     * @var string
     */
    private $boost;

    /**
     * @param string $boost
     */
    public function __construct(string $boost)
    {
        $this->boost = $boost;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        $values = array_filter(
            [
                'b' => $this->boost,
            ],
            static function ($var) {
                return null !== $var;
            }
        );

        return sprintf('!%s %s', self::TYPE, http_build_query($values, '', ' '));
    }

}
