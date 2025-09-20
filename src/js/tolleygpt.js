function initialize() {
    document.querySelector( 'span#gpt_ui button' ).onclick = () => {
        const promptField = document.querySelector( 'span#gpt_ui textarea' );
        let prompt = promptField.value;

        sendPrompt( prompt );
    }
}

// Keep track of prompts to keep track of the "conversation"
var prompts = [];

function sendPrompt( prompt ) {
    prompts.push( prompt );

    // Only sending a single prompt atm
    axios.post( '/gptapi.php', {
        prompt: prompt
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    } )
    .then( ( resp ) => { 
        console.log( 'response = ', resp.data );
     } )
    .catch( ( error ) => { console.log( error ) } );
}

function 

if( window.addEventListener ) {
    window.addEventListener( 'load', initialize, false );
} else if( window.attachEvent ) { 
    window.attachEvent('onload', initialize );
}