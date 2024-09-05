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
        .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 20px; /* Ajustez la hauteur selon vos besoins */
        text-align: left;
        font-size: 10px;
        padding-top: 10px;
        background-color: #f2f2f2; /* Couleur de fond si nécessaire */
        font-weight: bold;
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
        <h4 style="text-align:center; color:blue; text-transform:uppercase">Recettes des communes d'arrondissements</h4>
        <table class="table table-bordered table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="text-align:center;">CA</th>
                                                    <th scope="col" style="text-align:center;">Année</th>
                                                    <th scope="col" style="text-align:center;">PIL</th>
                                                    <th scope="col" style="text-align:center;">PEDS</th>
                                                    <th scope="col" style="text-align:center;">PTC</th>
                                                    <th scope="col" style="text-align:center;">Total AN2</th>
                                                    <th scope="col" style="text-align:center;">Total AN3</th>
                                                    <th scope="col" style="text-align:center;">Progression</th>
                                                    <th scope="col" style="text-align:center;">Total</th>
                                                    <th scope="col"style="text-align:center;">Pourcentage</th>
                                                    <th scope="col" style="text-align:center;">Illigibilité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $currentUserId = null;
                                                    $rowspanCount = 0;
                                                @endphp

                                                @foreach($recetteCommunes as $index => $recette)
                                                    @php
                                                        if ($recette->userId !== $currentUserId) {
                                                            $currentUserId = $recette->userId;

                                                            // Calculer combien de fois ce userId apparaît consécutivement
                                                            $rowspanCount = $recetteCommunes->where('userId', $recette->userId)->count();
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{ $index + 1 }}</td>

                                                        @if ($rowspanCount > 0)
                                                            <td scope="row" rowspan="{{ $rowspanCount }}" style=" vertical-align:middle;">{{ $recette->user->name }}</td>
                                                            @php $rowspanCount = 0; @endphp
                                                        @endif

                                                        <td scope="row" style="text-align:center;">{{ $recette->annee }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->pil, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->peds, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->ptc, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totalAnneeN2, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totalAnneeN3, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->difference, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ number_format($recette->totauxCommunes, 0, ',', '.') }}</td>
                                                        <td scope="row" style="text-align:center;">{{ $recette->tauxRepartition }}%</td>
                                                        @if($recette->illigibilite == "oui")
                                                            <td scope="row" style="background-color:green; color:white;text-align:center;">{{ $recette->illigibilite }}</td>
                                                        @elseif($recette->illigibilite == "non")
                                                            <td scope="row" style="background-color:red; color:white;text-align:center;">{{ $recette->illigibilite }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody> 
                                        </table>
    </div>
    <div class="footer">
        Document édité le : <span id="currentDate"></span>
        DSI-MINDDEVEL
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
        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('fr-FR', options);
        }

        const currentDateElement = document.getElementById('currentDate');
        const currentDate = new Date();
        currentDateElement.textContent = formatDate(currentDate);
    </script>
</body>
</html>
