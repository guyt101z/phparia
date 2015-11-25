<?php

/*
 * Copyright 2014 Brian Smith <wormling@gmail.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace phparia\Events;

use phparia\Client\AriClient;
use phparia\Resources\Channel;

/**
 * Notification that a channel has been destroyed.
 *
 * @author Brian Smith <wormling@gmail.com>
 */
class ChannelDestroyed extends Event implements IdentifiableEventInterface
{
    /* Causes for disconnection (from Q.931) */
    const AST_CAUSE_UNALLOCATED = 1;
    const AST_CAUSE_NO_ROUTE_TRANSIT_NET = 2;
    const AST_CAUSE_NO_ROUTE_DESTINATION = 3;
    const AST_CAUSE_CHANNEL_UNACCEPTABLE = 6;
    const AST_CAUSE_CALL_AWARDED_DELIVERED = 7;
    const AST_CAUSE_NORMAL_CLEARING = 16;
    const AST_CAUSE_USER_BUSY = 17;
    const AST_CAUSE_NO_USER_RESPONSE = 18;
    const AST_CAUSE_NO_ANSWER = 19;
    const AST_CAUSE_CALL_REJECTED = 21;
    const AST_CAUSE_NUMBER_CHANGED = 22;
    const AST_CAUSE_DESTINATION_OUT_OF_ORDER = 27;
    const AST_CAUSE_INVALID_NUMBER_FORMAT = 28;
    const AST_CAUSE_FACILITY_REJECTED = 29;
    const AST_CAUSE_RESPONSE_TO_STATUS_ENQUIRY = 30;
    const AST_CAUSE_NORMAL_UNSPECIFIED = 31;
    const AST_CAUSE_NORMAL_CIRCUIT_CONGESTION = 34;
    const AST_CAUSE_NETWORK_OUT_OF_ORDER = 38;
    const AST_CAUSE_NORMAL_TEMPORARY_FAILURE = 41;
    const AST_CAUSE_SWITCH_CONGESTION = 42;
    const AST_CAUSE_ACCESS_INFO_DISCARDED = 43;
    const AST_CAUSE_REQUESTED_CHAN_UNAVAIL = 44;
    const AST_CAUSE_PRE_EMPTED = 45;
    const AST_CAUSE_FACILITY_NOT_SUBSCRIBED = 50;
    const AST_CAUSE_OUTGOING_CALL_BARRED = 52;
    const AST_CAUSE_INCOMING_CALL_BARRED = 54;
    const AST_CAUSE_BEARERCAPABILITY_NOTAUTH = 57;
    const AST_CAUSE_BEARERCAPABILITY_NOTAVAIL = 58;
    const AST_CAUSE_BEARERCAPABILITY_NOTIMPL = 65;
    const AST_CAUSE_CHAN_NOT_IMPLEMENTED = 66;
    const AST_CAUSE_FACILITY_NOT_IMPLEMENTED = 69;
    const AST_CAUSE_INVALID_CALL_REFERENCE = 81;
    const AST_CAUSE_INCOMPATIBLE_DESTINATION = 88;
    const AST_CAUSE_INVALID_MSG_UNSPECIFIED = 95;
    const AST_CAUSE_MANDATORY_IE_MISSING = 96;
    const AST_CAUSE_MESSAGE_TYPE_NONEXIST = 97;
    const AST_CAUSE_WRONG_MESSAGE = 98;
    const AST_CAUSE_IE_NONEXIST = 99;
    const AST_CAUSE_INVALID_IE_CONTENTS = 100;
    const AST_CAUSE_WRONG_CALL_STATE = 101;
    const AST_CAUSE_RECOVERY_ON_TIMER_EXPIRE = 102;
    const AST_CAUSE_MANDATORY_IE_LENGTH_ERROR = 103;
    const AST_CAUSE_PROTOCOL_ERROR = 111;
    const AST_CAUSE_INTERWORKING = 127;

    /**
     * @var int Integer representation of the cause of the hangup
     */
    private $cause;

    /**
     * @var string Text representation of the cause of the hangup
     */
    private $causeTxt;

    /**
     * @var Channel
     */
    private $channel;

    /**
     * @return int Integer representation of the cause of the hangup
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @return string Text representation of the cause of the hangup
     */
    public function getCauseTxt()
    {
        return $this->causeTxt;
    }

    /**
     * @return Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    public function getEventId()
    {
        return "{$this->getType()}_{$this->getChannel()->getId()}";
    }

    /**
     * @param AriClient $client
     * @param string $response
     */
    public function __construct(AriClient $client, $response)
    {
        parent::__construct($client, $response);

        $this->cause = $this->response->cause;
        $this->causeTxt = $this->response->cause_txt;
        $this->channel = new Channel($client, $this->response->channel);
    }

}
