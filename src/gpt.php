<?php

$arSuggestions = array(
    "Full Stack",
    "Front End",
    "Database",
    "Node.js"
);

?><!DOCTYPE html>
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
        Tolleycoder.com!
    </header>

    <div class="content">
        <h2>Ask TolleyGPT about my experience in web engineering!</h2>
        <br />
        <span id="gpt_ui">
            <section class="card" aria-label="Prompt composer">
                <p class="about">
                    TolleyGPT is an AI agent that I trained to talk about my professional
                    experience in web development/software engineering.  With AI filtering
                    job applications, doing first round interviews, and applying for jobs, 
                    I decided that making my own agent would be a great demonstration of my
                    skills.  TolleyGPT is written in PHP, Javascript, CSS, and HTML.  It is 
                    using ChatGPT coupled with my career history.  Let me know if you'd like
                    something similar for your own brand or business, or ask TolleyGPT if I've
                    worked with your tech stack!
                </p>
                <div class="prompt-row">
                    <div class="textarea-wrap" role="group" aria-labelledby="prompt-label">
                        <label id="prompt-label" for="prompt">Your Prompt</label>
                        <textarea id="prompt" placeholder="Ask about Tolley's experience, or any specific area! (Click on a suggestion below to get started)"
                                maxlength="4000" aria-describedby="helper"></textarea>
                    </div>
                    <button id="submitBtn" class="btn" aria-label="Send prompt">
                        Send
                    </button>
                </div>

                <div class="meta" id="helper">
                    <div class="row meters">
                        <span class="pill">Chars: <span id="charCount" class="count">0</span>/<span id="charMax">4000</span></span>
                    </div>
                    <div class="row">
                        <button id="clearBtn" class="btn ghost" aria-label="Clear input">Clear</button>
                    </div>
                </div>

                <div class="output" id="output" aria-live="polite" aria-label="Output area"></div>

                <div class="prompt-row">
                    <?php foreach( $arSuggestions as $suggestion ): ?>
                        <button class="btn suggestion" aria-label="<?= $suggestion ?>"
                            onClick="send( '<?= $suggestion ?>' )">
                                <?= $suggestion ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </section>
        </span>
        <div>
            <a href="https://github.com/tolley/tolleygpt" target="_blank">
                See the code
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/tolleygpt.js"></script>
</body>
</html>
