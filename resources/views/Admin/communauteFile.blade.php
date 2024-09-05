<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Communes</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pdf-styles.css">

    <style>
        .header-left, .header-right {
            width: 50%;
            float: left;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .header-content {
            margin: 0 auto;
        }

        .h1 {
            margin: 5px 0;
            font-size: 10px;
            font-weight: bold;
        }

        .p {
            margin: 0;
            font-size: 10px;
            font-weight: bold;
        }

        .table-container {
            margin-top: 20px;
            clear: both; /* Assure que le tableau commence sous les en-têtes */
        }

        /* table.table-bordered {
            border: 1px solid black;
        } */

        td, th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <header class="header-left">
        <div class="header-content">
            <h1 class="h1">REPUBLIQUE DU CAMEROUN</h1>
            <p class="p">Paix-Travail-Patrie</p>
            <p class="p">*********</p>
            <p class="p">MINISTERE DE LA DECENTRALISATION ET DU DEVELOPPEMENT LOCAL</p>
            <p class="p">*********</p>
            <p class="p">SECRETARIAT GENERAL</p>
            <p class="p">*********</p>
            <p class="p">DIVISION DES SYSTEMES D’INFORMATION</p>
            <p class="p">*********</p>
        </div>
    </header>
    <header class="header-right">
        <div class="header-content">
            <h1 class="h1">REPUBLIC OF CAMEROON</h1>
            <p class="p">Peace-Work-Fatherland</p>
            <p class="p">*********</p>
            <p class="p">MINISTRY OF DECENTRALIZATION AND LOCAL DEVELOPMENT</p>
            <p class="p">*********</p>
            <p class="p">SECRETARIAT GENERAL</p>
            <p class="p">*********</p>
            <p class="p">INFORMATION SYSTEMS DIVISION</p>
            <p class="p">*********</p>
        </div>
    </header>

    <div class="table-container">
    <h4 style="text-align:center; color:blue; text-transform:uppercase">Liste des Communes d'Arrondissements reparties par Communautés Urbaines</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="text-align:center; text-transform:uppercase">Communautés urbaines</th>
                    <th scope="col" style="text-align:center; text-transform:uppercase">Communes d'arrondissement</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentCubId = null;
                    $rowspanCount = 0;
                @endphp

                @foreach($communes as $index => $commune)
                    @php
                        if($commune->cubId !== $currentCubId) {
                            $currentCubId = $commune->cubId;
                            $rowspanCount = $communes->where('cubId', $commune->cubId)->count();
                        }
                    @endphp

                    <tr>
                        <td scope="row">{{ $index + 1 }}</td>

                        @if($rowspanCount > 0)
                            <td rowspan="{{ $rowspanCount }}" style="vertical-align:middle;">{{ $commune->cubUser->name }}</td>
                            @php $rowspanCount = 0; @endphp
                        @endif

                        <td>{{ $commune->carUser->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script>
        function formatDateTime(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            return date.toLocaleDateString('fr-FR', options);
        }

        const currentDateTimeElement = document.getElementById('currentDateTime');
        const currentDateTime = new Date();
        currentDateTimeElement.textContent = 'Date et heure actuelles : ' + formatDateTime(currentDateTime);
    </script>
    <p id="currentDateTime" style="color:blue;"></p>
</body>
</html>
