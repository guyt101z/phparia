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

namespace phparia\Entity;

/**
 * Base type for API call responses
 *
 * @author Brian Smith <wormling@gmail.com>
 */
class Response
{
    /**
     * The json_decoded message data from ARI
     * 
     * @var object
     */
    protected $response;

    /**
     * @param string $jsonResponse The raw json response response data from ARI
     */
    public function __construct($jsonResponse)
    {
        if (is_array($jsonResponse)) { // For some reson, playback is an array, so this fixes that problem
            $this->response = $object = json_decode(json_encode($jsonResponse), false);
        } elseif (is_object($jsonResponse)) {
            $this->response = $jsonResponse;
        } else {
            $this->response = json_decode($jsonResponse);
        }
    }

}
