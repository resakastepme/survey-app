<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Surveys </title>
    <!-- Tab Icon -->
    <link rel="icon" href="//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15/svgs/solid/ghost.svg"
        style="color: #da8001;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"
        integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>

<body>


    <section id="loadContent" style="display: block;">
        <div id="spinner"
        class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            {{-- <span class="sr-only">Loading...</span> --}}
        </div>
    </div>
</section>

<section id="contentLoaded" style="display: none;">
    <nav class="navbar navbar-expand-lg fixed-top" id="navbarExample">
            <div class="container-fluid">

                <a class="navbar-brand" href="{{ url('/') }}"> <i class="fa-solid fa-ghost"
                        style="color: #da8001;"></i> SURVEYS </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-auto">
                        {{-- <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Bahasa: <span id="inisialLang">ID</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">ID</a></li>
                                <li><a class="dropdown-item" href="#">EN</a></li>
                                <li><a class="dropdown-item" href="#">PH</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="defaultThemeBtn" style="cursor: pointer;"> Tema: <span
                                    id="themeDOM">Light</span> </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        <br>

        @yield('content')

        <footer class="bg-dark text-center" id="foot">
            <p style="font-size: 10px; margin-bottom: -3px;"> made with 🤌 by <a
                    href="https://www.instagram.com/resaka.xmp/" target="_blank">resaka</a> </p>
            <p style="font-size: 12px; margin-bottom: -4px;">&copy; 2024 SURVEYS - STEPME'S PLACE</p>
        </footer>

    </section>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/d639410787.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#loadContent').fadeOut();
        $('#contentLoaded').fadeIn();

        // $('#defaultThemeBtn').on('click', function () {
        //     $('#').
        // });

        const themeToggle = $('#defaultThemeBtn');
        const body = $('body');
        const exampleCard = $('.card.bg-light'); // Select only cards with bg-light class
        const navbar = $('#navbarExample');
        const modalContent = $('.modal-content'); // Update with the actual class for your modal content

        body.toggleClass('dark-mode');
        const isDarkMode1 = body.hasClass('dark-mode');

        // CUSTOM SPAN
        $('#themeDOM').html('');
        $('#themeDOM').html(isDarkMode1 ? 'Dark' : 'Light');

        // Check user's preference from local storage
        if (localStorage.getItem('theme') == 'dark') {
            body.addClass('dark-mode');
            exampleCard.removeClass('bg-light').addClass('bg-dark');
            navbar.removeClass('bg-light').addClass('bg-dark');
            navbar.removeClass('navbar-light').addClass('navbar-dark');
            modalContent.removeClass('bg-light').addClass('bg-dark');
            $('#themeDOM').html('');
            $('#themeDOM').html('Dark');
            $('#foot').removeClass('bg-light').addClass('bg-dark');
        } else {
            body.removeClass('dark-mode');
            exampleCard.removeClass('bg-dark').addClass('bg-light');
            navbar.addClass('bg-light').removeClass('bg-dark');
            navbar.addClass('navbar-light').removeClass('navbar-dark');
            modalContent.addClass('bg-light').removeClass('bg-dark');
            $('#themeDOM').html('');
            $('#themeDOM').html('Light');
            $('#foot').removeClass('bg-dark').addClass('bg-light');
        }

        // Toggle between light and dark modes
        themeToggle.on('click', function() {
            body.toggleClass('dark-mode');
            const isDarkMode = body.hasClass('dark-mode');

            // CUSTOM SPAN
            $('#themeDOM').html('');
            $('#themeDOM').html(isDarkMode ? 'Dark' : 'Light');

            // CUSTOM FOOTER
            $('#foot').removeClass(isDarkMode ? 'bg-light' : 'bg-dark').addClass(isDarkMode ?
                'bg-dark' : 'bg-light')

            // Update card background class based on dark mode
            exampleCard.each(function() {
                const card = $(this);
                card.removeClass(isDarkMode ? 'bg-light' : 'bg-dark').addClass(isDarkMode ?
                    'bg-dark' : 'bg-light');
            });

            // Update navbar background class based on dark mode
            navbar.removeClass(isDarkMode ? 'bg-light' : 'bg-dark').addClass(isDarkMode ? 'bg-dark' :
                'bg-light');
            navbar.removeClass(isDarkMode ? 'navbar-light' : 'navbar-dark').addClass(isDarkMode ?
                'navbar-dark' :
                'navbar-light');

            // Update modal content background class based on dark mode
            modalContent.removeClass(isDarkMode ? 'bg-light' : 'bg-dark').addClass(isDarkMode ?
                'bg-dark' : 'bg-light');

            // Save user's preference to local storage
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');

        });
    });
</script>
@yield('script')
</html>
