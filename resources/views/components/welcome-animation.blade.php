<style class="animation_style">
    svg {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20rem !important;
        transform: translate(-50%,-50%) !important;
        margin: 0;
        transition-duration: 1s;
    }

    * {margin:0;}

    span {
        position: absolute;
        top: 50%; right: 50%;
        transform: translate(50%,-50%);
        color: white;
    }

    @media only screen and (max-width: 768px) {
        span {
            top: 55%;
        }
    }
</style>
<div id="welcome_animation" class="animation_style">
    <div id="intro"></div>
    <span class="animate__fadeIn d-none h1" id="title">Handler</span>
</div>
<script class="animation_style">
    $(() => {
        let animation = lottie.loadAnimation({
            container: intro, // the dom element that will contain the animation
            renderer: 'svg',
            loop: false,
            autoplay: true,
            name: 'wallet',
            path: '{{ asset('images/lottie/wallet.json') }}' // the path to the animation json
        });
        $(animation).on('complete', function () {
            $(this.wrapper).find('svg').css('top','35%')
            setTimeout(()=> {
                let title = $('#title')
                title.removeClass('d-none')
                title.addClass('animate__animated')
            },600)
            setTimeout(()=>{
                let welcome = $('#welcome_animation')
                welcome.addClass("animate__animated")
                welcome.addClass("animate__fadeOut")
            },4000)
            setTimeout(()=>{
                $('.animation_style').remove()
                $('#{{ $content }}').removeClass('d-none')
            },5000)
        })
    })
</script>