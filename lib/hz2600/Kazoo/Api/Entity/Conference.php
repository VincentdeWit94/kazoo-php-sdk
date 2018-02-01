<?php

namespace Kazoo\Api\Entity;

class Conference extends AbstractEntity
{
    /**
     * Dial out to an endpoint (DID, user/device, SIP URI) and join it to the
     * conference
     * See https://docs.2600hz.com/dev/applications/crossbar/doc/conference/#dialing-an-endpoint
     *
     * @param string|object $endpoint The endpoint to dial out to
     * @param stdClass|null $data Additional settings on the dial command
     */
    public function dial($endpoint, $data = null) {
        $this->setTokenValue($this->getEntityIdName(), $this->getId());

        $payload = new \stdClass;
        $payload->action = "dial";
        $payload->data = new \stdClass;
        $payload->data->data = is_null($data) ? new \stdClass : $data;
        $payload->data->data->endpoints = array($endpoint);

        $this->put(json_encode($payload));
    }
}
