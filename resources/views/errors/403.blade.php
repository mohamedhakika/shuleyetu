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
                <div class="title">Whoops</div>
                <div>
                    <h3 class="text-danger">
                        You are unauthourized to access this page.
                    </h3>
                </div>
                <div>
                    <h4>
                        <a href="/home">
                            Go back to the Dashboard
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </body>
</html>
