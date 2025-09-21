const ta = document.getElementById( 'prompt' );
const submitBtn = document.getElementById( 'submitBtn' );
const clearBtn = document.getElementById( 'clearBtn' );
const copyBtn = document.getElementById( 'copyBtn' );
const out = document.getElementById( 'output' );

const charCount = document.getElementById( 'charCount' );
const charMax = document.getElementById( 'charMax' );
const wordCount = document.getElementById( 'wordCount' );
const lineCount = document.getElementById( 'lineCount' );

let typerToken = 0;

function sleep( ms ){ return new Promise( r => setTimeout( r, ms ) ); }

const MAXLEN = parseInt( ta.getAttribute('maxlength') || '4000', 10 );
charMax.textContent = MAXLEN;

function autosize(){
    ta.style.height = 'auto';
    ta.style.height = Math.min(ta.scrollHeight, window.innerHeight * 0.4) + 'px';
}

function counts(){
    const v = ta.value;
    const words = v.trim().length ? v.trim().split(/\s+/).length : 0;
    const lines = v.split(/\n/).length;
    charCount.textContent = v.length;

    // Color state
    charCount.classList.remove('limit-ok','limit-warn','limit-bad');
    const ratio = v.length / MAXLEN;
    if (ratio < 0.8) charCount.classList.add('limit-ok');
    else if (ratio < 1) charCount.classList.add('limit-warn');
    else charCount.classList.add('limit-bad');

    submitBtn.disabled = v.trim().length === 0 || v.length > MAXLEN;
}

function render( v ) {
    const when = new Date().toLocaleString();
    const text = `📝 Prompt @ ${when}\n\n${v}`;
    typeOut( text, out, { delay: 16, newlineDelay: 70 } );
}

function send() {
    const prompt = ta.value.trim();
    if( ! prompt ) return;
    // render( prompt );

    axios.post( '/gptapi.php', {
        prompt: prompt
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    } )
    .then( ( resp ) => {
        render( resp.data.result );
        console.log( 'response = ', resp.data.result );
     } )
    .catch( ( error ) => { console.error } );

    ta.value = '';
    counts(); autosize();
}

async function typeOut( text, el, { delay = 18, newlineDelay = 60 } = {} ){
  const token = ++typerToken;            // bump token to cancel prior runs
  el.textContent = "";
  el.classList.add( "typing" );

  for( let i = 0; i < text.length; i++ ) {
    if( token !== typerToken ) {           // cancelled by a newer call
      el.classList.remove( "typing" );
      return;
    }
    el.textContent += text[i];
    await sleep(text[i] === "\n" ? newlineDelay : delay);
  }
  el.classList.remove( "typing" );
}

// Events
ta.addEventListener('input', ()=>{ autosize(); counts(); });
ta.addEventListener('keydown', (e)=>{
    if (e.key === 'Enter' && !e.shiftKey){
    e.preventDefault();
    send();
    }
});
submitBtn.addEventListener('click', send);
clearBtn.addEventListener('click', ()=>{
    ta.value = '';
    counts(); autosize(); ta.focus();
    out.textContent = '';
});
clearBtn.addEventListener( 'click', () => {
    typerToken++;                 // cancels current typeOut
    out.textContent = "";
    out.classList.remove( "typing" );
} );
copyBtn.addEventListener('click', async ()=>{
    try{
        await navigator.clipboard.writeText(ta.value);
        copyBtn.textContent = 'Copied!';
        setTimeout(()=> copyBtn.textContent = 'Copy', 900);
    } catch(e) {
        console.error(e);
    }
});

// Shortcut to focus (Ctrl/Cmd + K)
window.addEventListener('keydown', (e)=>{
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k'){
        e.preventDefault();
        ta.focus();
    }
});

// Init
autosize(); counts();