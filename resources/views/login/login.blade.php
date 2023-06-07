<!DOCTYPE html>
<html>

<head>
    <title>Beneficio de cafe</title>
    <link rel="stylesheet" href="{{ secure_asset('css/login.css') }}">

</head>

<body>
    <div class="container">
        <img class="logo" src="{{ secure_asset('img/logo.png') }}" alt="logo Beneficio de Cafe">
        <h1>Login Beneficio de Cafe</h1>
        <form id="login-form">
            @csrf
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button id="btn_iniciar_sesion">Inciar sesion</button>
            <div id="error" class="error">Nombre de usuario o contraseña incorrectos.</div>
        </form>

    </div>
</body>

</html>
<script src="{{ secure_asset('jquery/jquery.js') }}"></script>
<script>
    $("#btn_iniciar_sesion").click(function(e) {
        $('#error').hide();
        console.log('antes del ajax');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: modifyURLScheme("{{ route('login') }}", "https"),
            //url: "{{ route('login') }}",
            data: $('#login-form').serialize(),
            dataType: "json",
            success: function(data) {
                // Redireccionar a la página de inicio después de un inicio de sesión exitoso
                window.location.href = modifyURLScheme("{{ route('inicio') }}", "https");
                console.log('success');
                //window.location.href = "{{ route('inicio') }}";
            },
            error: function() {
                console.log('error');
                $('#error').show();
            }
        });
    });

    function modifyURLScheme(url, scheme) {
        return url.replace(/^http:/i, scheme + ":");
    }
</script>
