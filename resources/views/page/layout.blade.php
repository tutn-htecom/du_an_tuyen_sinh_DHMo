<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('includes.stylesheet')
</head>
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ĐH học Mở HCM - </title>
    </head>
    <body>        
        <section class="container-fluid">
            <div class="screen-loading">
                <div class="screen-loading-container"><div class="loader"></div></div>
            </div>
            @yield('content')
        </section>
    </body>
    </html>

    @include('includes.script')   
</body>
</html>