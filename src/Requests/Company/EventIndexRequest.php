<?php

namespace TruckersMP\APIClient\Requests\Company;

use Psr\Http\Client\ClientExceptionInterface;
use TruckersMP\APIClient\Client;
use TruckersMP\APIClient\Exceptions\ApiErrorException;
use TruckersMP\APIClient\Models\CompanyEventIndex;
use TruckersMP\APIClient\Requests\Request;

class EventIndexRequest extends Request
{
    /**
     * The ID of the requested company.
     *
     * @var int
     */
    protected int $companyId;

    /**
     * Create a new EventIndexRequest instance.
     *
     * @param  Client  $client
     * @param  int  $id
     * @return void
     */
    public function __construct(Client $client, int $id)
    {
        parent::__construct($client);

        $this->companyId = $id;
    }

    /**
     * Get the endpoint of the request.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return 'vtc/' . $this->companyId . '/events';
    }

    /**
     * Get the data for the request.
     *
     * @return CompanyEventIndex
     *
     * @throws ApiErrorException
     * @throws ClientExceptionInterface
     */
    public function get(): CompanyEventIndex
    {
        return new CompanyEventIndex(
            $this->client,
            $this->send()['response']
        );
    }

    /**
     * Get all events that the company is attending.
     *
     * @return EventAttendingRequest
     */
    public function attending(): EventAttendingRequest
    {
        return new EventAttendingRequest(
            $this->client,
            $this->companyId,
        );
    }
}
