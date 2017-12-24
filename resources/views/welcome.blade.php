<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            /*****************************************************/

            /*****************************************************/
            ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
            li { margin: 5px; padding: 5px; width: 150px; }
            .list_sortable
            {
                border: 1px solid red;
            }
            /*****************************************************/

            #red, #green, #blue {
                float: left;
                clear: left;
                width: 300px;
                margin: 15px;
            }
            #swatch {
                width: 120px;
                height: 100px;
                margin-top: 18px;
                margin-left: 350px;
                background-image: none;
            }
            #red .ui-slider-range { background: #ef2929; }
            #red .ui-slider-handle { border-color: #ef2929; }
            #green .ui-slider-range { background: #8ae234; }
            #green .ui-slider-handle { border-color: #8ae234; }
            #blue .ui-slider-range { background: #729fcf; }
            #blue .ui-slider-handle { border-color: #729fcf; }
            .colorpicker
            {
                border: 1px solid red;
            }
            /*****************************************************/

            /*****************************************************/

            /*****************************************************/

            /*****************************************************/

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" class="draggable">Home</a>
                    @else
                        <a href="{{ route('login_select') }}" class="draggable">Login</a>
                        <a href="{{ route('register') }}" class="draggable">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content container">
                <div class="title m-b-md draggable" id="show">
                    Laravel
                </div>

                <div class="links draggable">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>

                <div class="list_sortable draggable">
                    <ul>
                        <li id="draggable2" class="ui-state-highlight">Drag me down</li>
                    </ul>

                    <ul id="sortable">
                        <li class="ui-state-default">Item 1</li>
                        <li class="ui-state-default">Item 2</li>
                        <li class="ui-state-default">Item 3</li>
                        <li class="ui-state-default">Item 4</li>
                        <li class="ui-state-default">Item 5</li>
                    </ul>
                </div>

            </div>

            <div class="container draggable colorpicker">
                <p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
                    <span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
                    Simple Colorpicker
                </p>

                <div id="red"></div>
                <div id="green"></div>
                <div id="blue"></div>

                <div id="swatch" class="ui-widget-content ui-corner-all"></div>
            </div>
        </div>



        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <script
                src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
                crossorigin="anonymous"></script>

        <script>
            $( function() {
                $( ".draggable" ).draggable({ scroll: true });
            } );


/******************************************************************/


            $( "#sortable" ).sortable({
                revert: true
            });
            $( "#draggable2" ).draggable({
                connectToSortable: "#sortable",
                helper: "clone",
                revert: "invalid"
            });
            $( "ul, li" ).disableSelection();

/******************************************************************/
            function hexFromRGB(r, g, b) {
                var hex = [
                    r.toString( 16 ),
                    g.toString( 16 ),
                    b.toString( 16 )
                ];
                $.each( hex, function( nr, val ) {
                    if ( val.length === 1 ) {
                        hex[ nr ] = "0" + val;
                    }
                });
                return hex.join( "" ).toUpperCase();
            }
            function refreshSwatch() {
                var red = $( "#red" ).slider( "value" ),
                    green = $( "#green" ).slider( "value" ),
                    blue = $( "#blue" ).slider( "value" ),
                    hex = hexFromRGB( red, green, blue );
                $( "#swatch" ).css( "background-color", "#" + hex );
            }

            $( "#red, #green, #blue" ).slider({
                orientation: "horizontal",
                range: "min",
                max: 255,
                value: 127,
                slide: refreshSwatch,
                change: refreshSwatch
            });
            $( "#red" ).slider( "value", 255 );
            $( "#green" ).slider( "value", 140 );
            $( "#blue" ).slider( "value", 60 );
/******************************************************************/


        </script>
    </body>
</html>
