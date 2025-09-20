window.onload = () => {
    const timeRangeMax = 80;
    const header = document.querySelector( 'header' );
    header.classList.add( 'shadow' );

    // Define our header flicker effect
    const flicker = () => {
        // Remove the text shadow and set up a method to re-add id
        header.classList.remove( 'shadow' );
        setTimeout( () => {
            header.classList.add( 'shadow' );
        }, Math.random() + 50 );

        // Set the next flicker
        setTimeout( flicker, Math.floor( Math.random() * timeRangeMax ) * 50 );
    };

    // Start our flicker
    setTimeout( flicker, Math.floor( Math.random() * timeRangeMax ) * 50 );
};