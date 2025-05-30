<style>
/*!
 * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
 * Copyright 2015 Daniel Cardoso <@DanielCardoso>
 * Licensed under MIT
 */
 .la-ball-scale-pulse,
.la-ball-scale-pulse > div {
    position: relative;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
.la-ball-scale-pulse {
    display: block;
    font-size: 0;
    color: #fff;
}
.la-ball-scale-pulse.la-dark {
    color: #333;
}
.la-ball-scale-pulse > div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor;
}
.la-ball-scale-pulse {
    width: 32px;
    height: 32px;
}
.la-ball-scale-pulse > div {
    position: absolute;
    top: 0;
    left: 0;
    width: 32px;
    height: 32px;
    border-radius: 100%;
    opacity: .5;
    -webkit-animation: ball-scale-pulse 2s infinite ease-in-out;
       -moz-animation: ball-scale-pulse 2s infinite ease-in-out;
         -o-animation: ball-scale-pulse 2s infinite ease-in-out;
            animation: ball-scale-pulse 2s infinite ease-in-out;
}
.la-ball-scale-pulse > div:last-child {
    -webkit-animation-delay: -1.0s;
       -moz-animation-delay: -1.0s;
         -o-animation-delay: -1.0s;
            animation-delay: -1.0s;
}
.la-ball-scale-pulse.la-sm {
    width: 16px;
    height: 16px;
}
.la-ball-scale-pulse.la-sm > div {
    width: 16px;
    height: 16px;
}
.la-ball-scale-pulse.la-2x {
    width: 64px;
    height: 64px;
}
.la-ball-scale-pulse.la-2x > div {
    width: 64px;
    height: 64px;
}
.la-ball-scale-pulse.la-3x {
    width: 96px;
    height: 96px;
}
.la-ball-scale-pulse.la-3x > div {
    width: 96px;
    height: 96px;
}
/*
 * Animation
 */
@-webkit-keyframes ball-scale-pulse {
    0%,
    100% {
        -webkit-transform: scale(0);
                transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
                transform: scale(1);
    }
}
@-moz-keyframes ball-scale-pulse {
    0%,
    100% {
        -moz-transform: scale(0);
             transform: scale(0);
    }
    50% {
        -moz-transform: scale(1);
             transform: scale(1);
    }
}
@-o-keyframes ball-scale-pulse {
    0%,
    100% {
        -o-transform: scale(0);
           transform: scale(0);
    }
    50% {
        -o-transform: scale(1);
           transform: scale(1);
    }
}
@keyframes ball-scale-pulse {
    0%,
    100% {
        -webkit-transform: scale(0);
           -moz-transform: scale(0);
             -o-transform: scale(0);
                transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
           -moz-transform: scale(1);
             -o-transform: scale(1);
                transform: scale(1);
    }
}

</style>

<div class="la-ball-scale-pulse la-sm mt-1">
    <div></div>
    <div></div>
</div>