<?php
    //show all errors - useful whilst developing
    error_reporting(E_ALL);
    // these keys can be obtained by registering at http://developer.ebay.com

    $siteID = 0;
    $RuName = "Andy_Nu-AndyNu8d7-9b52--ncjfbhfz";
    $production = false;   // toggle to true if going against production
    $compatabilityLevel = 897;    // eBay API version
    if ($production) {
        $devID = 'a32b03dc-9ce0-46ac-be02-0f507f8c621e';   // these prod keys are different from sandbox keys
        $appID = 'AldoGonz-45f7-4613-aee6-d5b672457d2e';
        $certID = '717118d4-958e-49e7-80f1-e41d278f0805';
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.ebay.com/ws/api.dll';      // server URL different for prod and sandbox
        //the token representing the eBay user to assign the call with
        $userToken = 'AgAAAA**AQAAAA**aAAAAA**5MhDVg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AFl4uoAZeFpgqdj6x9nY+seQ**ohEDAA**AAMAAA**LJ440j75vFqm1uo6OZtYXplEwKRJhIybfa+jsfMP8YAjS2e+hGBMmlKpwwaXBztTk6QKIp263UP4ml/aurAwyKLwWj14D2m92ltZFC61yzWh74qhxqR6f9D9LsiyueBlvU5yJRqsGiaiQm7UKj7rByE4s00rQDnvlspv5L+kMK1KTuPMEp3OjNZOJjuw63F9DYeyPkBWYKnF2GsnRSI0aiy5Zz9gxPynWiUyQQYWpC/gMedP2kEvcK8cIbYa3bI41Zp8e5GRA5YscApazezDs5VMfM3ub9/HcL1PNlcFz0TpSWXww7xER05xGu8/59y506C9AdnFOBwZBQXiEwMsKdocCdyRS49hxaJ8g8gFwFpKXhkJU5vFIuF0erou+VwXKnOpKwv4dK6KFrsh3HgE/SK23x9BXtnJ2SNcbkf+G0c5XTH0JqJTxBauhVsZe5j/EMDJWmluya0Tz2Fesi7aL72etoKob1A5W/97cvKSHY7bJ6z9jKRqL8TZ4NwlWBZUCT8HlRhDFxsaG2gAUiU+HabeutqfuLjWYfcCZyIyRPN3f8KpSp/eBHQYdGjfd8M6w8+YrcHqGjyJ+bcq9LF2oK8cwz3nbCTMsyIWNt2NkmG8UGrBd70uQQuJPiCbgPvdbZAmxT6ivIG0JDgmBYGjYpRfTXMqPxtHx1EXJc7+aVVAoGzik94GSmaCkAeteqvnwAUPBpryJLJVr03ZrUTsWSHUe3ngOA4L1QU0J03k+TeQpE7iHz009pOGDulsJ0uO';
    } else {
        // sandbox (test) environment
        $devID = 'a32b03dc-9ce0-46ac-be02-0f507f8c621e';         // insert your devID for sandbox
        $appID = 'AldoGonz-d766-44ac-828e-0a02176a1335';   // different from prod keys
        $certID = '3f02b4c5-ed1e-4c15-afcc-d261b0f9a45c';  // need three 'keys' and one token
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.sandbox.ebay.com/ws/api.dll';
        // the token representing the eBay user to assign the call with
        // this token is a long string - don't insert new lines - different from prod token
        $userToken = 'AgAAAA**AQAAAA**aAAAAA**qcpDVg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDpOLogSdj6x9nY+seQ**X58DAA**AAMAAA**fs2gtPbznKBfshgP5rdTgGmjnNaXUt+47mNRzfx5NQmD2lU9EA8WoyQEKz3Ej1Ab/jAc6EwmfCqYApklIfWTC9KkZdMNmffmCu1F2jKGg9qfjHSeivxVA4nVsedM69KUK3/uak2IhoQrfalbbVtclk9gdjvymluW4c7B9cwS2WQdZxp2eyqWL6OMSMR1mBtLmRYcoEtjmDl4HJLKCzEUDrTKRhHJkEbn7u2KzUS50r7q/5N0cgr3syQwM+HwQDs62z1TAmsXpfgddklCoImFrKYw9UxXo9GHcMrHtMrCpe2tlcGT0JWHs0BDei32KQ7euUEiU1tP9C06UfRX3CIlWXt+gOzYynkpmBdpOzLLWCB5T9C7jxBz/cs61m1ve+ql8RHpczI+I/IA/R9C7FhQhSQ+KbRohMffMz+us4pm5HQqaIKfrlCpB1auoX1KjAVyl9gyCPVexGiYR+hIsnVY5KpMarLsVNGm9uzTY5xKx54F5jAnCdMcII3CNzyTQ/WEdi0J4y7j2LCoKzJSG20QiUlI1o+5bUZ2WbAQKvsMFRZgC9zo2ox2dhke5EL/oIYZNJfOBjlIL19ZOMcl9MbOrvmcHHC5mwFGCprC2zWR2bVDUMWoPT9EtCgcu86klFB7oP7TxHnMoRpLcfVrntnwoz26bpCKbFNakOejTHq9W26mgwGec5sN6OV1ER7LS+EjRYxq5nH5i6/Cv0VSPqJvuXL+fV3O6bnzVTZrkzTTtldtOZFT0EDk+HrL8AyqGq7u';
    }
?>
