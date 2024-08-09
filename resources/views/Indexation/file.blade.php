<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des utilisateurs</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">


    <!-- <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> 
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">  -->
      <!-- <link href="assets/css/style.css" rel="stylesheet"> -->
      
      <!-- <link href="style.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="assets/css/pdf-styles.css">
<!--  -->
    <style>
      .header-left, .header-right {
            width: 50%;
            float: left;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        @page {
            margin-top: 3mm; /* Réduit les marges du PDF */
        }
        .highlight {
            font-weight: bold; /* Optionnel : mettre en gras */
            text-decoration: underline; /* Souligne le texte */
        }
        .montant {
            font-weight: bold; /* Optionnel : mettre en gras */
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
      .t {
          margin: 0;
          font-size: 10px;
      }
      body {
        font-family: Arial, sans-serif;
            margin: 0; /* Supprime les marges par défaut du body */
      }
    </style>
</head>
<body>
    <header class="header-left">
        <div class="header-content">
            <h1 class="h1">REPUBLIQUE DU CAMEROUN</h1>
            <p class="p">Paix- Travail- Patrie</p>
            <p class="p">*********</p>
            <p class="p">{{$commune->name}}</p>
            <p class="p">*********</p>
            <p class="p">SECRETARIAT GENERAL</p>
            <p class="p">*********</p>
            <p class="p">DIRECTION DES AFFAIRES GENERALE</p>
            <p class="p">*********</p>
        </div>
    </header>
    <header class="header-right">
        <div class="header-content">
            <h1 class="h1">REPUBLIC OF CAMEROON</h1>
            <p class="p">Peace-Work-Fatherland</p>
            <p class="p">*********</p>
            <p class="p">{{$commune->name}}</p>
            <p class="p">*********</p>
            <p class="p">SECRETARIAT GENERAL</p>
            <p class="p">*********</p>
            <p class="p">GENERAL AFFAIRS DEPARTMENT</p>
            <p class="p">*********</p>
        </div>
    </header>

  <div class="row">
    <div class="card-body" style="margin-top:100px;">
        <p class="t" style="text-align:center; font-size:13px">DECISION COMMUNAUTAIRE N°...../DC/CUB/SG/DAG.</p>
        <p class="t" style="text-align:center; font-size:13px">FIXANT LE MONTANT DE LA DOTATION GENERALE DE FONCTIONNEMENT A REVERSER PAR LA {{$commune->name}} A SES COMMUNES D'ARRONDISSEMENT</p>
    </div><!-- End Recent Sales -->
    
    <div class="card-body" style="margin-top:20px;">
        <h1 class="t" style="text-align:center; font-size:20px">LE MAIRE DE LA VILLE</h1>
        <p class="t" style="text-align:center; font-size:13px">CHEVALIER DE L'ORDRE NATIONAL DE LA VALEUR</p>
    </div><!-- End Recent Sales -->

    <div class="card-body" style="margin-top:20px;">
        <p class="t" style=" font-size:11px margin-left:10px">VU la constitution;</p>
        <p class="t" style="font-size:10px">VU la la loi N°92/007 du 14 Aout 1992 portant Code du travail;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2012/001 du 19 Aavril 2012 portant Code Electoral;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>

        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
        <p class="t" style="font-size:10px">VU la la loi N°2019/024 du 19 Décembre 2019 portant Code Général des Collectivités Territoriales;</p>
    </div><!-- End Recent Sales -->

    <div class="card-body" style="margin-top:20px; ">
        <h1 class="t" style="text-align:center; font-size:20px; text-transform:underline">D E C I D E : </h1>
    </div><!-- End Recent Sales -->

    <div class="card-body" style="margin-top:20px; ">
        <p class="t" style="font-size:15px; text-align: justify"> <span class="highlight">Article 1 </span> : Le montant de la Dotation Générale de fonctionnement à repartir par la {{$commune->name}} à ses communes d'arrondissement au titre de l'exercice {{$currentYear}}
            est fixé par l'Arreté N°000011/A/MINDDEVEL du 16 Février 2021 susvisée à la somme de <span class="montant">{{ number_format($recette->tauxApplique, 0, ',', '.')}} </span>de franc CFA.
       </p>
    </div><!-- End Recent Sales -->

    <div class="card-body" style="margin-top:20px; ">
       <p class="t" style="font-size:15px; text-align: justify"> <span class="highlight">Article 2 </span> : Les montants de la Dotation Générale de fonctionnement aux différentes communes  d'arrondissement sont arretés conformément aux dispositions des articles
       5; 6 et 7 de l'Arreté N°000011/A/MINDDEVEL du 16 Février 2022 susvisé. ils sont présentés comme suit dans le tableau ci-après:
       </p>
    </div><!-- End Recent Sales -->

    <div class="card-body" style="margin-top:20px; ">
    <table class="table table-bordered table-borderless datatable" style="font-size">
                                <thead >
                                    <tr>
                                        <th scope="col" style="text-align:center">LIBELLES</th>
                                        @foreach($netPercevoirData as $commune)
                                        <th scope="col" style="text-align:center">{{ $commune->commune_name }}</th>
                                        @endforeach
                                        <th scope="col" style="text-align:center">Totaux</th>                   
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- <tr style="">
                                        <td scope="row">
                                            <tr>
                                                <th scope="col" style="">Le produit de l'impot libératoire</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="">Le produit des taxes communales</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="">Le produit de l'esploitation du domaine et des services</th>
                                            </tr>
                                        </td>
                                        
                                </tr> -->
                                <tr style="t">
                                        <td scope="row">
                                            Part fixe égalitaire
                                        </td>
                                        @foreach($netPercevoirData as $commune)
                                        <td scope="col" style="text-align:center">{{ number_format($commune->partFixe, 0, ',', '.')  }}</td>
                                        @endforeach
                                        <td scope="row">
                                            {{number_format($recette->partFixe, 0, ',', '.')}}
                                        </td>
                                </tr>{{ number_format($recette->Total, 0, ',', '.') }}
                                <tr style="">
                                        <td scope="row">
                                            Taux de repartition par Commune
                                        </td>
                                        @foreach($netPercevoirData as $commune)
                                        <td scope="col" style="text-align:center">{{number_format( $commune->tauxRepartition, 0, ',', '.') }}%</td>
                                        @endforeach
                                        <td scope="row">
                                            100%
                                        </td>
                                </tr>
                                <tr style="">
                                        <td scope="row">
                                            Part Variable
                                        </td>
                                        @foreach($netPercevoirData as $commune)
                                        <td scope="col" style="text-align:center">{{ number_format( $commune->partVariable, 0, ',', '.') }}</td>
                                        @endforeach
                                        <td scope="row">
                                            {{number_format( $recette->partVariable, 0, ',', '.')}}
                                        </td>
                                </tr>
                                <tr style="">
                                        <td scope="row">
                                           Montant annuel à reverser aux Communes d'Arrondissement 
                                        </td>
                                        @foreach($netPercevoirData as $commune)
                                        <td scope="col" style="text-align:center"> {{number_format($commune->partFixe, 0, ',', '.') }} + {{number_format(  $commune->partVariable , 0, ',', '.')}} = {{ number_format( $commune->total, 0, ',', '.') }}</td>
                                        @endforeach
                                        <td scope="row">
                                            {{number_format( $recette->tauxApplique, 0, ',', '.')}}
                                        </td>
                                </tr>
                                <tr style="">
                                        <td scope="row">
                                           Montant trimestriel à reverser aux Communes d'Arrondissement 
                                        </td>
                                        @foreach($netPercevoirData as $commune)
                                        <td scope="col" style="text-align:center">{{number_format(  $commune->totalTrimestriel, 0, ',', '.') }}</td>
                                        @endforeach
                                </tr>
                                </tbody>
                            </table>
    </div><!-- End Recent Sales -->
  </div><!-- End Recent Sales -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script>
    // Fonction pour formater la date et l'heure
    function formatDateTime(date) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
        return date.toLocaleDateString('fr-FR', options);
    }

    // Récupérer l'élément HTML où afficher la date et l'heure
    const currentDateTimeElement = document.getElementById('currentDateTime');

    // Obtenir la date et l'heure actuelles
    const currentDateTime = new Date();

    // Formater et afficher la date et l'heure dans l'élément HTML
    currentDateTimeElement.textContent = 'Date et heure actuelles : ' + formatDateTime(currentDateTime);
</script>
<p id="currentDateTime" style="color:blue;"></p>
</body>
</html>