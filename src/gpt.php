<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7254H2D132"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7254H2D132');
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>Tolley GPT</title>
    <link rel="stylesheet" type="text/css" href="/css/main.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/css/tolleygpt.css" media="screen, projection">
</head>
<body>

    <header>
        tolleycoder.com!
    </header>

    <div class="content">
        <h2>Ask TolleyGPT about my experience in web engineering!</h2>
        <br />
        <span id="gpt_ui">
            <section class="card" aria-label="Prompt composer">
                <div class="prompt-row">
                    <div class="textarea-wrap" role="group" aria-labelledby="prompt-label">
                    <label id="prompt-label" for="prompt">Your Prompt</label>
                    <textarea id="prompt" placeholder="Tell me about Tolley's experience" maxlength="4000" aria-describedby="helper"></textarea>
                    </div>
                    <button id="submitBtn" class="btn" aria-label="Send prompt">Send</button>
                </div>

                <div class="meta" id="helper">
                    <div class="row meters">
                        <span class="pill">Chars: <span id="charCount" class="count">0</span>/<span id="charMax">4000</span></span>
                    </div>
                    <div class="row">
                        <button id="clearBtn" class="btn ghost" aria-label="Clear input">Clear</button>
                    </div>
                </div>

                <div class="output" id="output" aria-live="polite" aria-label="Output area">
                    <!-- Submitted prompt will render here -->
                </div>
            </section>
        </span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/tolleygpt.js"></script>
</body>
</html>
