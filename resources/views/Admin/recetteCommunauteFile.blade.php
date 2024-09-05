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
        <h4 style="text-align:center; color:blue; text-transform:uppercase">Recettes des communautés urbaines</h4>
        <table class="table table-bordered table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">CUB</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">annee</th>                                      
                                                    <th scope="col"style="text-align:center; text-transform:uppercase">pic</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">pcac</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">ptc</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">rdp</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">rdpc</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">rtps</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase" >total</th>
                                                    <th scope="col" style="text-align:center; text-transform:uppercase">Mtnt à verser</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                    $currentUserId = null;
                                                    $rowspanCount = 0;
                                            @endphp

                                                @foreach($recetteCommunautes as $index => $recette)
                                                    @php
                                                            // Vérifie si la communauté urbaine actuelle est la même que la précédente
                                                            if($recette->userId !== $currentUserId) {
                                                                // Si oui, mettre à jour la communauté urbaine actuelle
                                                                $currentUserId = $recette->userId ;

                                                                // Calculer combien de fois cette communauté urbaine apparaît dans la liste
                                                                $rowspanCount = $recetteCommunautes->where('userId', $recette->userId)->count();
                                                            }
                                                    @endphp
                                                        <tr>
                                                            <td scope="row">{{ $index + 1 }}</td>
                                                            @if($rowspanCount > 0)
                                                                <td rowspan="{{ $rowspanCount }}">{{ $recette->user->name  }}</td>
                                                                @php $rowspanCount = 0; @endphp
                                                            @endif
                                                            <td scope="row">{{$recette->annee}}</td>                                                          
                                                            <td scope="row">{{ number_format($recette->pic, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->pcac, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->ptc, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rdp, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rdpc, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->rtps, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->Total, 0, ',', '.') }}</td>
                                                            <td scope="row">{{ number_format($recette->tauxApplique, 0, ',', '.') }}</td>
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
