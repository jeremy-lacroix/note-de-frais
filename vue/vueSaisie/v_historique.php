<?php
    if($_GET['action'] == 'listeFrais' || $_GET['action'] == 'afficherConsulterFrais'){
        echo'
        <!-- RETOUR -->
        <div class="row pt-4 m-0">
            <div class="col-md-6 text-center">
                <button type="button" onclick="history.back()" class="btn btn-link"><i class="bi bi-arrow-left-circle-fill"></i> Retour</button>
            </div>
        </div>';
    } 
?>

<?php
if($_GET['action'] == 'lister'){

    echo '
    <!-- CARD NEW NOTE DE FRAIS -->
    <div class="row w-100 mx-auto d-flex justify-content-center mt-3" style="min-height : 100vh!important;">
        <!-- CARD BOX -->
        <div class="col-md-7 border rounded shadow my-md-5">
            <!-- TITRE -->
            <div class="row border" style="min-height : 11vh!important;">
                <h4 class="text-left my-auto p-2 ml-3">Historique</h4>
            </div>
            <!-- TEXTE -->
            <div class="row text-center" style="min-height : 70vh!important;">
                <div class="mt-5 mx-5 w-100">';
            
                if(isset($valid_ndf)){
                    echo "<table class='table-striped w-100'>";
                    foreach ($valid_ndf as $id_ndf){
                        $ndf = get_info_ndf($id_ndf);
                        echo "<tr>
                                    <td class='p-3'>
                                        ".$ndf['Mission']."
                                    </td>
                                    <td class='p-3'>
                                        ".$ndf['Date']."
                                    </td>
                                    <td class='p-3 d-flex-lg justify-content-center'>
                                        <a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?ctl=notedefrais&action=listeFrais&Id_ndf=".$ndf['Id_ndf']."&vue=historique'>Consulter</a>
                                    </td>
                                </tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo '<h1>
                            Aucun historique...
                        </h1>';
                }
            echo'
                </div>
            </div>
        </div>
    </div>';
}

if($_GET['action'] == 'listeFrais'){
    echo '
    

<!-- CARD NEW NOTE DE FRAIS -->
<div class="row w-100 mx-auto d-flex justify-content-center mt-3" style="min-height : 100vh!important;">
    <!-- CARD BOX -->
    <div class="col-md-7 border rounded shadow my-md-2">
        <!-- TITRE -->
        <div class="row border" style="min-height : 11vh!important;">
            <h4 class="text-left my-auto p-2 ml-3">Historique / Frais</h4>
        </div>
        <!-- TEXTE -->
        <div class="row text-center" style="min-height : 70vh!important;">
            <div class="mt-5 mx-5 w-100">';
        
            if(isset($result)){
                echo '<table class="table-striped w-100">';
                foreach ($result as $row){
                    echo "<tr>
                                <td class='p-3'>   
                                    <p>".$row['Detail']."</p>
                                </td>
                                <td class='p-3'>
                                    <p>".$row['Date']."</p>
                                </td>
                                <td class='p-3'>
                                    <p>".$row['Statut']."</p>
                                </td>
                                <td class='p-3 d-flex-lg justify-content-center'>";
                                    if ($row['Type'] == "FC") {
                                        echo"<a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?vue=1&ctl=notedefrais&action=afficherConsulterFraisClassique&id=".$row['Id']."'>Consulter</a>";
                                    }else{
                                        echo"<a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?vue=1&ctl=notedefrais&action=afficherConsulterFraisKilo&id=".$row['Id']."'>Consulter</a>";
                                    }
                                "</td>
                            </tr>";
                }
                echo "</table>";
            }
            else{
                echo '<h1>
                        Aucune note de frais enregistré
                    </h1>';
            } 
        echo'
            </div>
        </div>
    </div>
</div>';
}

// CONSULTER FRAIS CLASSIQUES
if($_GET['action'] == 'afficherConsulterFraisClassique'){

    ?>
    <!-- BUTTON RETOUR -->
    <div class="row pt-4 m-0">
        <div class="col-md-6 text-center">
            <button type="button" onclick="history.back()" class="btn btn-link"><i class="bi bi-arrow-left-circle-fill"></i> Retour</button>
        </div>
    </div>

    <!-- CARD NEW NOTE DE FRAIS -->
    <div class="row w-100 mx-auto d-flex justify-content-center" style="min-height : 100vh!important;">
        <!-- CARD BOX -->
        <div class="col-md-7 border rounded shadow my-md-3 my-2">
            <!-- TITRE -->
            <div class="row border" style="min-height : 11vh!important;">
                <h4 class="text-left my-auto p-2 ml-3">Note de frais / Frais / Détails</h4>
            </div>
            <!-- TEXTE -->
            <div class="container-fluid text-center mt-5" style="min-height : 70vh!important;">

            <form class='row justify-content-center d-flex'>
                    <div class="col-lg">
                        <div class="row d-flex form-control mx-auto">
                            <label class="text-left col-lg p-0" for="type">Type </label>
                            <input type="hidden" name="Statut" value="En attente">
                            <input type="hidden" name="Type" value="FC">
                            <select class="ml-auto col-lg" name="Detail" disabled>
                                <option <?php if(isset($result)){ if($result[0]['Detail'] == 'Restaurant'){echo"selected";}} ?> value="Restaurant">Restaurant</option>
                                <option <?php if(isset($result)){ if($result[0]['Detail'] == 'Titre de transport'){echo"selected";}} ?> value="Titre de transport">Titre de transport</option>
                                <option <?php if(isset($result)){ if($result[0]['Detail'] == 'Parking'){echo"selected";}} ?> value="Parking">Parking</option>
                                <option <?php if(isset($result)){ if($result[0]['Detail'] == 'Péage'){echo"selected";}} ?> value="Péage">Péage</option>
                                <option <?php if(isset($result)){ if($result[0]['Detail'] != 'Restaurant' && $result[0]['Detail'] != 'Titre de transport' && $result[0]['Detail'] != 'Parking' && $result[0]['Detail'] != 'Péage'){echo"selected";}} ?> value="<?php $result[0]['Detail'] ?>"><?php echo $result[0]['Detail']?></option>
                            </select>
                        </div>
                        <div class="row d-flex form-control mt-5 mx-auto">
                            <label class="text-left col-lg p-0" for="date">Date</label>
                            <input class="ml-auto col-lg" type="date" name="Date" value="<?php if(isset($result)){ echo $result[0]['Date'];} ?>" required disabled>
                        </div>
                        <div class="row d-flex form-control mt-5 mx-auto mb-5">
                            <label class="text-left col-lg p-0" for="montant">Montant </label>
                            <input class="ml-auto col-lg" type="number" name="Montant" placeholder="€" value="<?php if(isset($result)){ echo $result[0]['Montant'];} ?>" required disabled>
                        </div>
                    </div>

                    <div class="col-lg border" style="min-height : 11vh!important;" >
                        <div class="row justify-content-center">
                            <div class="col-lg-4 my-auto"><p class="m-0" id="nomFichier"><?php if (isset($result)){ echo $result[0]['Justificatif']; }?></p></div>
                        </div>
                        <div id="fichier"><?php 
                        if(isset($result)){
                            $res = substr($result[0]['Justificatif'], -3);
                            if($res == "pdf"){
                                echo "<iframe src='uploads/".$result[0]['Justificatif']."' style='min-height: 400px;'></iframe></div>";
                            }
                            else{
                                echo "<img src='uploads/".$result[0]['Justificatif']."' class='img-fluid py-3'></img></div>";
                            }
                        }
                        ?>

                        </div>
                        </div>
                        </div>
                        </div>
<?php
}
?>