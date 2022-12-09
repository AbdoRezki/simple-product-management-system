<?php 
    include('connexion.php');
    session_start();
    $ref=$_GET["ref"];
    if (isset($_POST['libelle'])){
      $nlibelle=$_POST['libelle'];
      $npu=$_POST['prixUnitaire'];
      $ndateAchat=$_POST['dateAchat'];
      $ncategorie=$_POST['categorie'];
      
    $con->exec("UPDATE `produit` SET `libelle`='$nlibelle', `prixUnitaire`='$npu', `dateAchat`='$ndateAchat', `idCategorie`='$ncategorie' where `reference`='$ref'");
    echo "<script>location.assign('accueil.php')</script>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <title>Accueil</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Application Produit</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="accueil.php">Accueil </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Ajouter Produit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Quitter la session</a>
      </li>
    </ul>
  </div>
</nav>
<?php 
$result = $con->query("select * from produit where reference='$ref'");
    while($row=$result->fetch()){
       $libelle=$row["libelle"];
       $pu=$row['prixUnitaire'];
       $dateAchat=$row['dateAchat'];
       $categorie=$row['idCategorie'];
    }
?>
<h2 class="text-center">Modifier le produit</h2>
<form enctype="multipart/form-data" class="text-center" action="modifierProduit.php?ref=<?php echo $ref; ?>" method="POST" style="width:40%;margin-left:30%;margin-top:3%;padding-bottom:6.55%" >
  		<div class="form-group row">
  		<label for="staticEmail" class="col-sm-2 col-form-label">Libelle</label>
  		<div class="col-sm-10">
    		<input type="text" class="form-control" id="staticEmail" name="libelle" value="<?php echo $libelle ?>">
  		</div>
	</div>
	<div class="form-group row" style="margin-top:2%">
  		<label for="staticEmail" class="col-sm-2 col-form-label">Prix Unitaire</label>
  		<div class="col-sm-10">
    		<input type="text" class="form-control" id="staticEmail" name="prixUnitaire" value="<?php echo $pu ?>">
  		</div>
	</div>
    <div class="form-group row" style="margin-top:2%">
  		<label for="staticEmail" class="col-sm-2 col-form-label">Date Achat</label>
  		<div class="col-sm-10">
    		<input type="date" class="form-control" id="staticEmail" name="dateAchat" value="<?php echo $dateAchat ?>">
  		</div>
	</div>
    <div class="form-group row" style="margin-top:2%">
        <label for="" class="col-sm-2 col-form-label">Categorie</label>
        <div class="col-sm-10">
        <select name="categorie">
        <?php 
        $sql = $con->query("SELECT * FROM categorie where id=$categorie");
        while ($row = $sql->fetch()){?>
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['denomination'] ?></option>
        <?php } ?>
        <?php 
        $sql = $con->query("SELECT * FROM categorie where id!= $categorie");
        while ($row = $sql->fetch()){?>
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['denomination'] ?></option>
        <?php } ?>
    
        </select>
        </div>
        </div>
        <input type="submit" value="submit" class="btn btn-primary" style="margin-top:2%; width:30%;">
	</form>
</body>