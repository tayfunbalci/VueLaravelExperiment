<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">


        <!-- Styles -->
        
    </head>
    <body>
        <div id="app">
            <v-app>
                <h1>Tayfun'la ReST API</h1>
                <v-content>
                    <Articles/>
                 </v-content>
            </v-app>
            
        </div>

        <!-- <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script> -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
