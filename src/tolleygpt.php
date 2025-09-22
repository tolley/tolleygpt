<?php

// Send the user to gpt.php
header( "HTTP/1.1 301 Moved Permanently" );
header( "Location: /gpt" );
header( "Connection: close" );
