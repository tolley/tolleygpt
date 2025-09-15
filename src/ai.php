<?php 

require './vendor/autoload.php';

$client = OpenAI::client( 'to_do_get_api_key' );

debug( $client );
