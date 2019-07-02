 <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <title>@yield('title')</title>
      <link rel="icon" href="{{ asset('/') }}images/buo.png">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ asset('/css/vendor.css') }}"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ asset('/css/app.css') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
        body{
          background-color: #1976d2;
          width: 100vw;
          height: 100vh;
        }
        .vertical{
          height: 100%;
        }
      </style>
    </head>
    <body>
      <div class="vertical valign-wrapper">
        @yield('content')
      </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="{{ asset('/js/vendor.js') }}"></script> 
      <script type="text/javascript">
        $(document).ready(function() {
          Materialize.updateTextFields();
        });
      </script>
    </body>
  </html>
        