<?php

/*
 * Copyright 2017 Brian Smith <wormling@gmail.com>.
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
use phparia\Resources\Bridge;

/**
 * Notification that the source of video in a bridge has changed.
 *
 * @author Brian Smith <wormling@gmail.com>
 */
class BridgeVideoSourceChanged extends Event implements IdentifiableEventInterface
{
    /**
     * @var Bridge
     */
    private $bridge;

    /**
     * @var string (optional)
     */
    private $oldVideoSourceId;

    /**
     * @return Bridge
     */
    public function getBridge()
    {
        return $this->bridge;
    }

    /**
     * @return string (optional)
     */
    public function getOldVideoSourceId()
    {
        return $this->oldVideoSourceId;
    }

    public function getEventId()
    {
        return "{$this->getType()}_{$this->getBridge()->getId()}";
    }

    /**
     * @param AriClient $client
     * @param string $response
     */
    public function __construct(AriClient $client, $response)
    {
        parent::__construct($client, $response);

        $this->bridge = $this->getResponseValue('bridge', '\phparia\Resources\Bridge', $client);
        $this->oldVideoSourceId = $this->getResponseValue('old_video_source_id');
    }
}
