<?php
/**
 * The contents for the api call and response to chatgpt
 */

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    die( 'POST only' );
}

$env = parse_ini_file( '.env' );

if( ! isset( $env['API_KEY'] ) ) {
    die( 'No API Key found in .env' );
}

if( ! isset( $env['API_MODEL'] ) ) {
    die( 'No API model found in .env' );
}

$apiKey = $env['API_KEY'];
$model = $env['API_MODEL'];

$response = [];

if( isset( $_POST['prompt'] ) ) {
    $prompt = trim( $_POST['prompt'] );
    $cgptResp = queryGPT( $prompt, $apiKey, $model );

    if( is_array( $cgptResp ) && array_key_exists( 'choices', $cgptResp ) &&
        ! empty( $cgptResp['choices'] ) ) {
            $response['result'] = $cgptResp['choices'][0]['message']['content'];
    } else {
        $response['result'] = 'Choices not found in response';
    }

    // Write the prompt and the response to the log
    file_put_contents( 
        './promptlog.log',
        'PROMPT: ' . date( 'm/d/y' ) . ' '. $prompt . "\n", 
        FILE_APPEND );
} else {
    $response['result'] = 'No prompt found';
}

echo json_encode( $response );

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////

/**
 * Sends a prompt to ChatGPT
 * @param   $prompt The user's prompt
 * @param   $apiKey The chatgpt api key
 * @param   $model  The chatgpt model
 * @return  ChatGPT's response
 */
function queryGPT( string $prompt, string $apiKey, string $model ) {
    $systemContent = getSystemContent();

    $ch = curl_init( 'https://api.openai.com/v1/chat/completions' );

    $data = [
        "model" => $model,
        "messages" => [
            ["role" => "system", "content" => $systemContent],
            ["role" => "user", "content" => $prompt]
        ],
        'max_tokens' => 200,
        "temperature" => 0.5
    ];

    // Set cURL options
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );

    // Execute and handle response
    $response = curl_exec( $ch );

    if( curl_errno( $ch ) ) {
        echo 'Curl error: ' . curl_error( $ch );
        exit;
    }

    curl_close($ch);

    // Decode and print the assistant's reply
    $result = json_decode( $response, true );
    return $result;
}


/**
 * Gets the system content for our chatgpt request
 * @return string   The system content
 */
function getSystemContent() {
    $resume = file_get_contents( './data.min.json' );
    return 'professional assistant for me and will strongly promote my career as a web engineer.  Do not speak about me in first person. Refer to me as Tolley.  If anyone asks anything unrelated to me or my experience, politely try to stear the conversation back to my experience. My career history is outlined in this json document: ' . $resume;
}
