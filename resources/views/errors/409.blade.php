<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
                background-color: white;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Whoops!!</div>
                <div>
                    <h3 class="text-danger">
                        Something went wrong <br>
                        What are you trying to do?<br>
                        Try again OR Contact administrator.
                    </h3>
                </div>
                <div>
                    <h4>
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                            Click here to go back
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </body>
</html>
