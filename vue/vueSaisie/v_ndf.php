<?php
    if($_GET['action'] == 'listeFrais' || $_GET['action'] == 'saisie_fc'|| $_GET['action'] == 'saisie_fk' || $_GET['action'] == 'afficherModifierFrais' || $_GET['action'] == 'newFrais'){
        echo'
        <!-- RETOUR -->
        <div class="row pt-4 m-0">
            <div class="col-md-6 text-center">
                <a type="button" href="index.php?ctl=notedefrais&action=lister&vue=saisie&TypeNdf=0" class="btn btn-link"><i class="bi bi-arrow-left-circle-fill"></i> Retour</a>
            </div>
        </div>';
    } 
?>

<!-- CARD NEW NOTE DE FRAIS -->
<div class="row w-100 mx-auto d-flex justify-content-center my-3">
    <!-- CARD BOX -->
    <div class="col-md-10 border rounded shadow my-md-2 mb-2">
        <!-- TITRE -->
        <div class="row border d-flex justify-content-between" style="min-height : 11vh!important;">
            <h4 class="text-left my-auto p-2 ml-3"><?php if($_GET['action'] == 'lister' or $_GET['action'] == 'newNote' or $_GET['action'] == 'supprimer'){ echo'Note de frais</h4><a class="p-3 my-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> &nbsp Créer une nouvelle note de frais</button></a>';} if($_GET['action'] == 'listeFrais'){ echo 'Note de frais / Frais';} if($_GET['action'] == 'saisie_fk'){ echo'Frais Kilometriques';}?></h4>
        </div>

        <!-- <a class="p-3 my-auto" href="index.php?ctl=notedefrais&action=newNote&vue=saisie"><button type="button" class="btn btn-primary"><i class="bi bi-plus-circle"></i> &nbsp Créer une nouvelle note de frais</button></a> -->

        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle note de frais</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">

                        <form class="text-center" action="index.php?ctl=notedefrais&action=newNote&vue=saisie" method="POST">

                            <h5  class="mt-3 mb-1">Nom de mission :</h5><br>
                            <input name="nom" type="text" class="mb-3" required>

                            <h5  class="mt-3 mb-1">Date de debut :</h5><br>
                            <input name="dateDebut" type="date" class="mb-3" min="2000-01-01" onchange="setDateDebut(event)" required>

                            <h5  class="mt-3 mb-1">Date de fin:</h5><br>
                            <input name="dateFin" type="date" class="mb-3" min="2000-01-01" onchange="setDateDebut(event)" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                        <input type="submit" class="btn btn-primary" value="Créer"></button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

            var dateDebut
            var datefin

            function setDateDebut(e) {
                dateDebut = e
            }
            function setDateFin(a) {
                dateDebut = a
            }

            
            if(dateFin != null && dateDebut != null){

                if(dateFin < dateDebut){
                    alert("error");
                }

            }
            
        </script>
<?php

//Liste note de frais

if($_GET['action'] == 'lister' || $_GET['action'] == "newNote" || $_GET['action'] == "supprimer"){
    echo '<div class="row text-center" style="min-height : 70vh!important;">
                <div class="mt-5 mx-5 w-100">';

                if(isset($valid_ndf)){
                    echo "<table class='table-striped w-100'>";
                    foreach ($valid_ndf as $id_ndf){
                        $ndf = get_info_ndf($id_ndf);
                        echo "<tr>
                                    <td class='p-3'>
                                        ".$ndf['Mission']."
                                    </td>
                                    <td class='p-3' id='dateDebut'>
                                        Date debut : ".$ndf['Date']."
                                    </td>
                                    <td class='p-3' id='dateFin'>
                                        Date fin : ".$ndf['dateFin']."
                                    </td>
                                    <td class='p-3 d-flex-lg justify-content-center'>
                                        <a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?ctl=notedefrais&action=listeFrais&Id_ndf=".$ndf['Id_ndf']."&vue=saisie&dateDebut=".$ndf['Date']."&dateFin=".$ndf['dateFin']."'>Saisir des frais</a>
                                        <form class='mt-2 p-0' action='index.php?ctl=notedefrais&action=supprimer' method='post'>
                                            <input type='hidden' name='idNdf' value='".$ndf['Id_ndf']."'>
                                            <input type='submit' class='btn btn-danger mx-auto w-100' value='Suprimer' style='max-width : 200px!important;'>
                                        </form>
                                    </td>
                                </tr>";
                    }
                    echo "</table><br>";
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
    </div>
    
    
    ';
}

//Liste frais

if($_GET['action'] == 'listeFrais' || $_GET['action'] == "newFrais" || $_GET["action"] == "supprimerFrais"){

    echo'
    
    <div class="row text-center" style="min-height : 70vh!important;">
        <div class="mt-5 mx-5 w-100">';

            if(isset($result) && count($result) > 0){
                echo "<table class='table-striped w-100'>";
                foreach ($result as $row){
                    echo "<tr>
                                <td class='p-3'>
                                    <p>".$row['Statut']."</p>
                                </td>
                                <td class='p-3 d-flex-lg justify-content-center'>";
                    // Frais Classiques
                    if($row['Type'] == "FC"){
                        if($row['Statut'] == 'En attente'){
                            // MODIFIER / SUPPRIMER
                            echo "<a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?ctl=notedefrais&action=afficherModifierFraisClassique&id=".$row['Id']."&vue=saisie'>Modifier</a>
                                    <form class='mt-2 p-0' action='index.php?ctl=notedefrais&action=supprimerFrais&Id_ndf=".$_GET['Id_ndf']."' method='post'>
                                        <input type='hidden' name='Id' value='".$row['Id']."'>
                                        <input type='submit' class='btn btn-danger mx-auto w-100' value='Supprimer' style='max-width : 200px!important;'>
                                    </form>
                                </td>
                            </tr>";
                        }
                        else{
                            // CONSULTER
                            echo"<form class='mt-2 p-0' action='index.php?ctl=notedefrais&action=afficherConsulterFraisClassique&id=".$row['Id']."&vue=saisie' method='post'>
                                        <input type='submit' class='btn btn-primary mx-auto w-100' value='Consulter' style='max-width : 200px!important;'>
                                    </form>
                                </td>
                            </tr>";
                        }
                    }
                    // Frais Kilométriques
                    if($row['Type'] == "FK"){
                        if($row['Statut'] == 'En attente'){
                            // MODIFIER / SUPPRIMER
                            echo "<a class='btn btn-primary mx-auto w-100' style='max-width : 200px!important;' href='index.php?ctl=notedefrais&action=afficherModifierFraisKilo&id=".$row['Id']."&vue=saisie'>Modifier</a>
                                    <form class='mt-2 p-0' action='index.php?ctl=notedefrais&action=supprimerFrais&Id_ndf=".$_GET['Id_ndf']."' method='post'>
                                        <input type='hidden' name='Id' value='".$row['Id']."'>
                                        <input type='submit' class='btn btn-danger mx-auto w-100' value='Supprimer' style='max-width : 200px!important;'>
                                    </form>
                                </td>
                            </tr>";
                        }
                        else{
                            // CONSULTER
                            echo"<form class='mt-2 p-0' action='index.php?ctl=notedefrais&action=afficherConsulterFraisKilo&id=".$row['Id']."&vue=saisie' method='post'>
                                        <input type='submit' class='btn btn-primary mx-auto w-100' value='Consulter' style='max-width : 200px!important;'>
                                    </form>
                                </td>
                            </tr>";
                        }
                    }
                    
                }
                echo "</table>";
            }
            else{
                echo '<h1>
                        Aucun frais enregistré
                    </h1>';
            } 
            echo'
                </div>
            </div>
            <div class="row border d-flex justify-content-around text-center" style="min-height : 11vh!important;">
                <a class="p-3 my-auto" href="index.php?ctl=notedefrais&action=saisie_fc&Id_ndf='.$_GET["Id_ndf"].'&vue=saisie&dateDebut='.$_GET["dateDebut"].'&dateFin='.$_GET["dateFin"].'"><button type="button" class="btn btn-primary"><i class="bi bi-plus-circle"></i> &nbsp Crée un frais classique</button></a>
                <a class="p-3 my-auto" href="index.php?ctl=notedefrais&action=saisie_fk&Id_ndf='.$_GET["Id_ndf"].'&vue=saisie"><button type="button" class="btn btn-primary"><i class="bi bi-plus-circle"></i> &nbsp Crée un frais kilométrique</button></a>
            </div>
        </div>
    </div>';
}

//Saisie et Modification frais classique

if($_GET['action'] == 'saisie_fc' || $_GET['action'] == 'afficherModifierFraisClassique'){
    echo'
    <div class="container-fluid text-center mt-5" style="min-height : 70vh!important;">';

                if (isset($result))
                {
                    echo "<form class='row justify-content-center d-flex' action='index.php?ctl=notedefrais&action=modifierFrais&Id_ligne=".$result[0]['Id']."&vue=saisie' method='post' enctype='multipart/form-data'>";
                }
                else {
                    echo "<form class='row justify-content-center d-flex' action='index.php?ctl=notedefrais&action=newFrais&Id_ndf=".$_GET['Id_ndf']."&vue=saisie&dateDebut=".$_GET['dateDebut']."&dateFin=".$_GET['dateFin']."' method='post' enctype='multipart/form-data'>";
                }

                    echo '
                    
                    <div class="col-lg">
                <div class="row d-flex form-control mx-auto">
                    <label class="text-left col-lg p-0" for="type">Type </label>
                    <input type="hidden" name="Statut" value="En attente">
                    <input type="hidden" name="Type" value="FC">
                    <select class="ml-auto col-lg" name="Detail">
                        <option'; if(isset($result)){ if($result[0]["Detail"] == "Restaurant"){echo"selected";}} echo' value="Restaurant">Restaurant</option>
                        <option'; if(isset($result)){ if($result[0]["Detail"] == "Titre de transport"){echo"selected";}} echo' value="Titre de transport">Titre de transport</option>
                        <option'; if(isset($result)){ if($result[0]["Detail"] == "Parking"){echo"selected";}} echo' value="Parking">Parking</option>
                        <option'; if(isset($result)){ if($result[0]["Detail"] == "Péage"){echo"selected";}} echo' value="Péage">Péage</option>
                        <option'; if(isset($result)){ if($result[0]["Detail"] != "Restaurant" && $result[0]["Detail"] != "Titre de transport" && $result[0]["Detail"] != "Parking" && $result[0]["Detail"] != "Péage"){echo"selected";}} ?> value="<?php if(isset($result[0]["Detail"])){$result[0]["Detail"];}else{"autre";} ?>"><?php if(isset($result[0]["Detail"])){echo $result[0]["Detail"];}else{echo "autre";} echo'</option>
                    </select>
                </div>
                <div class="row d-flex form-control mt-5 mx-auto">
                    <label class="text-left col-lg p-0" for="date">Date Debut</label>
                    <input class="ml-auto col-lg" type="date" name="Date" value="'; if(isset($result)){ echo $result[0]["Date"];} else{ echo '"min="'.$_GET['dateDebut'].'" max="'.$_GET['dateFin'].'"'; } echo'" required>
                </div>

                <div class="row d-flex form-control mt-5 mx-auto">
                    <label class="text-left col-lg p-0" for="date">Date Fin</label>
                    <input class="ml-auto col-lg" type="date" name="dateFin" value="'; if(isset($result)){ echo $result[0]["Date"];} else{ echo '"min="'.$_GET['dateDebut'].'" max="'.$_GET['dateFin'].'"'; } echo'" required>
                </div>

                <div class="row d-flex form-control mt-5 mx-auto mb-5">
                    <label class="text-left col-lg p-0" for="montant">Montant </label>
                    <input class="ml-auto col-lg" type="number" name="Montant" placeholder="€" value="'; if(isset($result)){ echo $result[0]["Montant"];} echo '" required>
                </div>
            </div>

            <div class="col-lg border" style="min-height : 11vh!important;" >
                <div class="row justify-content-center">
                    <div class="col-lg-4"><label for="files" class="btn btn-primary mt-3">Select Files</label></div>
                    <div class="col-lg-4 my-auto"><p class="m-0" id="nomFichier">'; if (isset($result)){ echo $result[0]["Justificatif"]; } echo'</p></div>
                </div>
                <input id="files" class="text-left d-none" type="file" name="Justificatif" onchange="previewPicture(this)" value="'; if(isset($result)){ echo "uploads/".$result[0]["Justificatif"];} echo'" accept=".jpg, .png, .pdf , .PDF">
                <div id="fichier">
                    
                    ';
                

                if(isset($result)){
                    $res = substr($result[0]['Justificatif'], -3);
                    if($res == "pdf" || $res == "PDF"){
                        echo "<iframe src='uploads/".$result[0]['Justificatif']."' style='min-height: 400px;'></iframe>";
                    }
                    else{
                        echo "<img src='uploads/".$result[0]['Justificatif']."' class='img-fluid py-3'></img>";
                    }
                }
                echo'</div>
                
                <script type="text/javascript" >

                    let previewPicture  = function (e) {

                        // e.files contient un objet FileList
                        const [file] = e.files

                        let extension = file.name.split(".").pop()
                        document.getElementById("nomFichier").innerHTML = file.name

                        if(extension != "pdf"){
                            let doc = document.createElement("img")
                            doc.classList.add("img-fluid")
                            doc.classList.add("my-3")
                            // "file" est un objet File
                            if (file) {

                                // On change l\'URL du fichier
                                doc.src = URL.createObjectURL(file)
                                let madiv = document.getElementById("fichier")
                                madiv.innerHTML=""
                                madiv.appendChild(doc)
                            }
                        }
                        else{
                            let doc = document.createElement("iframe")
                            // "file" est un objet File
                            if (file) {
                                doc.style.cssText += "min-height: 400px;"
                                // On change l\'URL du fichier
                                doc.src = URL.createObjectURL(file) + "#toolbar=0"
                                let madiv = document.getElementById("fichier")
                                madiv.innerHTML=""
                                madiv.appendChild(doc)
                            }
                        }
                        
                    } 
                </script>

            </div>
            
        </div>
        <div class="row border d-flex justify-content-around text-center" style="min-height : 11vh!important;">
            <button type="submit" class="btn btn-primary my-auto w-50" onclick="loader()">'; if(isset($result)){ echo "Modifier";} else { echo"Envoyer";} echo'</button>
            </form>
        </div>
    </div>
</div>';
}

//Saisie frais kilométrique

// AJOUTER BOUTON RETOUR // 

if($_GET['action'] == 'saisie_fk' || $_GET['action'] == 'afficherModifierFraisKilo'){

?>
    <div class="row text-center" style="min-height : 70vh!important;">

        <?php
            if($_GET["action"] == "saisie_fk" || $_GET["action"] == "afficherModifierFraisKilo")
            { 
        ?>
                <div class="col-md-6 text-center">
                    <div class="col-12 d-flex form-control mt-2">
                        <label class="text-left col-lg p-0" for="depart">Départ</label>
                        <input type="text" id="origin" placeholder="Départ">
                    </div>
                    <div class="col-md-12 d-flex form-control mt-2">
                        <label class="text-left col-lg p-0" for="arriver">Arrivé</label>
                        <input type="text" id="dest" placeholder="Arrivé">
                    </div>
                    
                    <div class="col-md-12 mt-3 mb-3">
                        <button class="btn btn-primary" id="button">Calculer</button>
                        <button class="btn btn-secondary"  onclick="location.reload();">Reset</button>
                    </div>

                    <p class="col-12" id="result">
                        
                    </p>

                    <!-- DEBUT FORM -->
                    <?php
                        if (isset($result))
                        {
                            echo "<form action='index.php?ctl=notedefrais&action=modifierFrais&Id_ligne=".$result[0]['Id']."&vue=saisie' method='post' enctype='multipart/form-data'>";
                        }
                        else {
                            echo "<form action='index.php?ctl=notedefrais&action=newFrais&Id_ndf=".$_GET['Id_ndf']."&vue=saisie' method='post' enctype='multipart/form-data'>";
                        }     
                    ?>

                    <!-- INFOS HIDDEN-->
                    <input id="montantTT" type="hidden" name="Montant" value="">
                    <input type="hidden" name="Statut" value="En attente">
                    <input type="hidden" name="Type" value="FK">
                    
                    <!-- RECUPERATION MONTANT -->
                    <script>
                        document.addEventListener("DOMNodeInserted", function(event) {

                            let p = document.getElementById('montant').innerText;
                            console.log(p);
                            document.getElementById('montantTT').innerText = p;
                        });
                        
                    </script>
                    
                    
                    <input class="ml-auto col-lg" type="date" name="Date" value="<?php if(isset($result)){ echo $result[0]["Date"];} ?>" required>
                    <textarea class="ml-auto col-lg mt-3" type="text-area" name="Detail" value=" "></textarea>
                </div>
            
</div>
</div>
</div>    
</div></div>        
<?php 
        }
    }
?>


<script>
    document.getElementById("button").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "vue/vueSaisie/calcul_distance.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };
        var origin = document.getElementById("origin").value;
        var dest = document.getElementById("dest").value;
        xhr.send("origin=" + origin + "&dest=" + dest);
    });

    document.getElementById("result").addEventListener("change", function() {
        console.log("DATAAAA");
    });
</script>