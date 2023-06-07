<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>Certificado de Cargamento Recibido</h1>
    </center>
    <br>
    <div class="row">
        <div style="page-break-inside: avoid; width:100%">
            <table border="1" width="100%" cellspacing=0>
                <tr align="center" style="background-color: rgba(131, 131, 131, 0.6)">
                    <td colspan="2"><b>Dictamen Final del Cargamento</b></td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Número</strong></td>
                    <td align="left">&nbsp;{{$id_cargamento}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Peso del Cargamento</strong></td>
                    <td align="left">&nbsp;{{$peso_total}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Máximo Permitido</strong></td>
                    <td align="left">&nbsp;{{$mayor_permitido}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Mínimo Permitido</strong></td>
                    <td align="left">&nbsp;{{$menor_permitido}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Diferencia de Peso</strong></td>
                    <td align="left">&nbsp;{{$diferencia}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Peso Recibido</strong></td>
                    <td align="left">&nbsp;{{$peso_certificado}}</td>
                </tr>
            </table>
        </div>
        <br>
    </div>
</body>
</html>
