<?php

/*
 * This file is part of the Solarium package.
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code.
 */

namespace Solarium\QueryType\ManagedResources\RequestBuilder;

use Solarium\Core\Client\Request;
use Solarium\Core\Query\AbstractQuery;
use Solarium\Core\Query\AbstractRequestBuilder as BaseRequestBuilder;
use Solarium\Exception\RuntimeException;
use Solarium\QueryType\ManagedResources\Query\AbstractCommand;
use Solarium\QueryType\ManagedResources\Query\Stopwords as StopwordsQuery;

/**
 * Stopwords.
 */
class Stopwords extends BaseRequestBuilder
{
    /**
     * Build request for a stopwords query.
     *
     * @param \Solarium\Core\Query\AbstractQuery $query
     *
     * @throws \Solarium\Exception\RuntimeException
     *
     * @return Request
     */
    public function build(AbstractQuery $query): Request
    {
        if (empty($query->getName())) {
            throw new RuntimeException('Name of the stopwords resource is not set in the query.');
        }

        $request = parent::build($query);
        $request->setHandler($query->getHandler().$query->getName());
        if (null !== $query->getCommand()) {
            $request->addHeader('Content-Type: application/json; charset=utf-8');
            $this->buildCommand($request, $query->getCommand());
        } else {
            // Lists all stopwords.
            $request->setMethod(Request::METHOD_GET);
        }

        return $request;
    }

    /**
     * @param Request         $request
     * @param AbstractCommand $command
     *
     * @return self
     */
    protected function buildCommand(Request $request, AbstractCommand $command): self
    {
        $request->setMethod($command->getRequestMethod());

        switch ($command->getType()) {
            case StopwordsQuery::COMMAND_ADD:
                $request->setRawData($command->getRawData());
                break;
            case StopwordsQuery::COMMAND_CONFIG:
                $request->setRawData($command->getRawData());
                break;
            case StopwordsQuery::COMMAND_CREATE:
                $request->setRawData($command->getRawData());
                break;
            case StopwordsQuery::COMMAND_DELETE:
                $request->setHandler($request->getHandler().'/'.$command->getTerm());
                break;
            case StopwordsQuery::COMMAND_EXISTS:
                $request->setHandler($request->getHandler().'/'.$command->getTerm());
                break;
            case StopwordsQuery::COMMAND_REMOVE:
                break;
            default:
                throw new RuntimeException('Unsupported command type');
        }

        return $this;
    }
}
