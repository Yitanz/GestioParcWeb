<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
class Empleat {
  /*Atributs*/
  private $id_empleat;
  private $nom;
  private $cognom1;
  private $cognom2;
  private $email;
  private $pass;
  private $data;
  private $adreca;
  private $ciutat;
  private $provincia;
  private $codi_postal;
  private $tipus_doc;
  private $num_doc;
  private $sexe;
  private $tlf;
  private $rol;
  private $actiu;
  private $codi_ss;
  private $num_nomina;
  private $iban;
  private $especialitat;
  private $carrec;
  private $data_inici;
  private $data_fi;
  private $horari;
  /* CONSTRUCTORS */
  function __construct() {
    $args = func_get_args();
    $num = func_num_args();
    $f='__construct'.$num;
    if (method_exists($this,$f)) {
      call_user_func_array(array($this,$f),$args);
    }
  }
  function __construct2($email, $pass)
  {
    $this->email = $email;
    $this->pass = $pass;
  }
  /* CONSTRUCTOR PER A QUAN CREEM UN USUARI DES DE ADMINISTRACIO */
  function __construct23($nom, $cognom1, $cognom2, $tipus_doc, $num_doc, $data, $sexe, $tlf,
  $email, $adreca, $ciutat, $provincia, $codi_postal, $pass, $rol, $codi_ss, $num_nomina, $iban, $especialitat, $carrec, $data_inici, $data_fi, $horari) {
   $this->id_empleat = NULL;
   $this->nom = $nom;
   $this->cognom1 = $cognom1;
   $this->cognom2 = $cognom2;
   $this->tipus_doc = $tipus_doc;
   $this->num_doc = $num_doc;
   $this->data = $data;
   $this->sexe = $sexe;
   $this->tlf = $tlf;
   $this->email = $email;
   $this->adreca = $adreca;
   $this->ciutat = $ciutat;
   $this->provincia = $provincia;
   $this->codi_postal = $codi_postal;  //NPI de si deixar el codi o no
   $this->pass = password_hash($pass, PASSWORD_DEFAULT); //ENCRIPTAR CONTRASENYA PER DEFECTE
   $this->rol = $rol;
   $this->actiu = '1';
   $this->codi_ss = $codi_ss;
   $this->num_nomina = $num_nomina;
   $this->iban = $iban;
   $this->especialitat = $especialitat;
   $this->carrec = $carrec;
   $this->data_inici = $data_inici;
   $this->data_fi = $data_fi;
   $this->horari = $horari;
  }
  public function crearEmpleat()
  {
    try
    {
        $connection = crearConnexio();
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }$stmt$stmt
        $connection->autocommit(FALSE);
        $sql= "INSERT INTO DADES_EMPLEAT (codi_seg_social, num_nomina, IBAN, especialitat, carrec, data_inici_contracte, data_fi_contracte, id_horari) VALUES (?,?,?,?,?,?,?,?);";
        $stmt = $connection->prepare($sql);
        if($stmt==false){
          var_dump($stmt);
          die("Secured");
        }
        $resultBP = $stmt->bind_param("sssssssi",$this->codi_ss, $this->num_nomina, $this->iban, $this->especialitat, $this->carrec, $this->data_inici, $this->data_fi, $this->horari);
        if($resultBP==false) {
          var_dump($stmt);
          die("Secured2");
        }
        $resultEx = $stmt->execute();
        if($resultEx==false) {
          var_dump($stmt);
          die("Secured3");
        }
        $sql2= "INSERT INTO USUARI (id_usuari, nom, cognom1, cognom2, email, password, data_naixement, adreca, ciutat, provincia, codi_postal,
          tipus_document, numero_document, sexe, telefon, id_rol, actiu, id_dades_empleat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,LAST_INSERT_ID());";
        $stmt2 = $connection->prepare($sql2);
        if($stmt2==false){
          var_dump($stmt2);
          die("Secured4");
        }
        $resultBP2 = $stmt2->bind_param("isssssssssisssiii",$this->id_empleat, $this->nom, $this->cognom1, $this->cognom2, $this->email, $this->pass, $this->data,
        $this->adreca, $this->ciutat, $this->provincia, $this->codi_postal, $this->tipus_doc, $this->num_doc, $this->sexe, $this->tlf, $this->rol, $this->actiu);
        if($resultBP2==false) {
          var_dump($stmt2);
          die("Secured5");
        }
        $resultEx2 = $stmt2->execute();
        if($resultEx2==false) {
          var_dump($stmt2);
          die("Secured6");
        }
        else {
          $msg = "S'ha afegit l'empleat correctament!";
          echo '<script>alert("'.$msg.'");</script>';
        }
        $stmt->close();
        $stmt2->close();
        $connection->autocommit(TRUE);
        $connection->close();
    }
    catch (Exception $e) {
      $connection->rollback();
      throw $e;
    }
  }
  public function validarLogin()
  {
    $connection = crearConnexio();
    $sql = "SELECT id_usuari, id_rol, password, email FROM USUARI WHERE email=? AND id_rol!=1 AND actiu=1";
      //$sql = "SELECT password FROM USUARI WHERE email=? AND id_rol='1' ";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s",$this->email);
    $stmt->execute();
    $result = $stmt->get_result();
      /* now you can fetch the results into an array - NICE */
    while ($row = $result->fetch_assoc()) {
        // use your $myrow array as you would with any other fetch
        //var_dump($row['id_usuari'], $row['id_rol'], $row['email']);
        $username = $row['email'];
        $userID = $row['id_usuari'];
        $rol = $row['id_rol'];
        $hash = $row['password'];
    }
    $isValid = password_verify($this->pass, $hash);
    //$isValid = true;
    if ($isValid)
    {
      echo 'VALID';
      session_start();
      if (array_key_exists('remember', $_POST)) {
          // Crear una nova cookie de sessió que expira en 7 dies
          setcookie('idu', $username, time() + 7 * 24 * 60 * 60);
          //Reemplaçar el ID de la sessio actual amb una nova i mantenir la informació de la sessio actual
          session_regenerate_id(true);
      } elseif (!$_POST['remember']) {
          //Si hi ha una COOKIE creada, atrassar-la en el temps per a que la elimine
          if (isset($_COOKIE['idu'])) {
              $past = time() - 100;
              setcookie(idu, gone, $past);
          }
      }
      $_SESSION['id_usuari'] = $userID;
      $_SESSION['username'] = $username;
      $_SESSION['rol'] = $rol;
      //echo $_SESSION['username'], $_SESSION['id_usuari'], $_SESSION['rol'];
      return true;
    }
    else
    {
      //echo 'NO VALID';
      return false;
    }
    $connection->close();
  }
  public static function SelecciollistarUsuarisBusqueda(){
  $connection = crearConnexio();
  //if ($conexio->connect_error)
  //{
  //    die('Error de conexión: ' . $conexion->connect_error);
  //}
  $busqueda = $_POST['buscar_empleat'];
  //$_POST['busqueda_atraccio']
  $sql = "SELECT * FROM USUARI WHERE id_rol !=1 && nom LIKE '%$busqueda%' or cognom1 LIKE '%$busqueda%' or cognom2 like '%$busqueda%' or numero_document like '%$busqueda%'";
  $result = $connection->query($sql);
  echo '<table class="table">';
  echo '  <thead>';
  echo '    <tr>';
  echo '      <th scope="col">ID</th>';
  echo '      <th scope="col">Nom</th>';
  echo '      <th scope="col">1º Cog</th>';
  echo '      <th scope="col">2º Cog</th>';
  echo '      <th scope="col">Num Document</th>';
  /*echo '      <th scope="col">Altura maxima</th>';
  echo '      <th scope="col">Accessibilitat</th>';
  echo '      <th scope="col">Acces express</th>';
  echo '      <th scope="col">Data creacio registre</th>';*/
  echo '      <th scope="col"></th>';
  echo '      <th scope="col"></th>';
  echo '    </tr>';
  echo '  </thead>';
  if ($result) {
      while($row = $result->fetch_assoc()) {
        $id_empleat = $row["id_usuari"];
        $nom = $row["nom"];
        $cognom1 = $row["cognom1"];
        $cognom2 = $row["cognom2"];
        $num_doc = $row["numero_document"];

        echo '  <tbody>';
        echo '    <tr>';
        echo '      <th scope="row">'.$row["id_usuari"].'</th>';
        echo '      <td>'.$row["nom"].'</td>';
        echo '      <td>'.$row["cognom1"].'</td>';
        echo '      <td>'.$row["cognom2"].'</td>';
        echo '      <td>'.$row["numero_document"].'</td>';
        echo '      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> Seleccionar Empleats
                    </button></td>';
        echo '    </tr>';
        echo '  </tbody>';
      }
    }
        echo '</table>';
        $connection->close();
  }



  public static function SelecciollistarUsuaris(){
      try{
      $connection = crearConnexio();

      $sql = "SELECT * FROM USUARI LEFT JOIN DADES_EMPLEAT ON USUARI.id_dades_empleat = DADES_EMPLEAT.id_dades_empleat
                                    LEFT JOIN HORARI ON HORARI.id_horari = DADES_EMPLEAT.id_horari
                                    LEFT JOIN ROL ON ROL.id_rol = USUARI.id_rol WHERE USUARI.id_rol != 1";
      $result = $connection->query($sql);

      echo '<table class="table">';
      echo '  <thead>';
      echo '    <tr>';
      echo '      <th scope="col">ID</th>';
      echo '      <th scope="col">Nom</th>';
      echo '      <th scope="col">Cog 1</th>';
      echo '      <th scope="col">Cog 2</th>';
      echo '      <th scope="col">DNI</th>';
      echo '    </tr>';
      echo '  </thead>';

      if ($result) {
          while($row = $result->fetch_assoc()) {
            $id_empleat = $row["id_usuari"];
            $nom = $row["nom"];
            $cognom1 = $row["cognom1"];
            $cognom2 = $row["cognom2"];
            $num_doc = $row["nom"];
            $tipus_doc = $row["tipus_document"];
            $tlf = $row["telefon"];
            $email = $row["email"];
            $adreca = $row["adreca"];
            $ciutat = $row["ciutat"];
            $provincia = $row["provincia"];
            $codi_postal = $row["codi_postal"];
            $codi_ss = $row["codi_seg_social"];
            $num_nomina = $row["num_nomina"];
            $iban = $row["IBAN"];
            $especialitat = $row["especialitat"];
            $carrec = $row["carrec"];
            $sexe = $row["sexe"];
            $data_naixement = $row["data_naixement"];
            $rol = $row["id_rol"];
            $nom_rol = $row["nom_rol"];
            $data_inici = $row["data_inici_contracte"];
            $data_fi = $row["data_fi_contracte"];
            $horari = $row["id_horari"];
            $torn = $row["torn"];


            echo '  <tbody>';
            echo '    <tr>';
            echo '      <th scope="row">'.$row["id_usuari"].'</th>';
            echo '      <td>'.$row["nom"].'</td>';
            echo '      <td>'.$row["cognom1"].'</td>';
            echo '      <td>'.$row["cognom2"].'</td>';
            echo '      <td>'.$row["numero_document"].'</td>';
            echo '      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$id_empleat.'">Modificar</button></td>"';
            echo '      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$id_empleat.'">Eliminar</button></td>"';
            echo '      <br>';
            echo '    </tr>';
            echo '  </tbody>';

            /*Modal de modificar*/
            echo '<!-- Modal -->
          <div class="modal fade" id="modalModificar'.$id_empleat.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modificar Empleat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form method="post">
                    <div class="form-group row">
                     <div class="col-10">
                       <input class="form-control" type="text" value="'.$id_empleat.'" id="example-text-input" name="id_empleat" style="display: none;">
                     </div>
                    </div>


                    <!-- <form class="needs-validation" method="post" action="<?php echo htmlentities($_SERVER[\'PHP_SELF\']); ?>"> -->
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="nom">Nom *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Nom" name="nom" value="'.$nom.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="cognom1">Cognom 1 *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Cognom 1" name="cognom1" value="'.$cognom1.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="cognom2">Cognom 2</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Cognom 2" value = "'.$cognom2.'" name="cognom2">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="tipus_document">Tipus document</label>
                          <div class="input-group">
                            <select class="form-control form-control-sm" name="tipus_doc">
                              <option selected> '.$tipus_doc.' </option>
                              <option>DNI</option>
                              <option>NIE</option>
                              <option>CIF</option>
                              <option>Altres</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="numero_document">Nº document *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Número document" name="num_doc" value = "'.$num_doc.'" $required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="date">Data de naixement *</label>
                          <input type="date" class="form-control form-control-sm" placeholder="Data naixement" name="data" value = "'.$data_naixement.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="sexe">Sexe</label>
                          <select class="form-control form-control-sm" name="sexe">
                            <option selected> '.$sexe.' </option>
                            <option>Home</option>
                            <option>Dona</option>
                          </select>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="tlf">Telèfon de contacte</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Telèfon de contacte" name="tlf" value = "'.$tlf.'">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="email">Correu electrònic *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Email" name="email" value = "'.$email.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="adreca">Adreça *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Adreça" name="adreca" value = "'.$adreca.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="ciutat">Ciutat *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Ciutat" name="ciutat" value = "'.$ciutat.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="provincia">Provincia *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Provincia" name="provincia" value = "'.$provincia.'" required>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="cp">Codi postal *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Codi postal" name="codi_postal" value = "'.$codi_postal.'" required>
                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="css">Codi de seguretat social *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Codi Seg Social" name="codi_ss" value = "'.$codi_ss.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="cn">Num nomina *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Num nòmina" name="num_nomina" value = "'.$num_nomina.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="iban">IBAN *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="IBAN" name="iban" value = "'.$iban.'" required>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="especialitat">Especialitat *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Especialitat" name="especialitat" value = "'.$especialitat.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="carec">Càrrec *</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Càrrec" name="carrec" value = "'.$carrec.'" required>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="rol">Rol *</label>
                          <select class="form-control form-control-sm" name="rol" required>
                            <option selected value = "'.$rol.'"> '.$nom_rol.' </option>
                            <option value="2">Treballador</option>
                            <option value="3">Gestor</option>
                          </select>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="dfi">Horari *</label>
                          <select class="form-control form-control-sm" name="horari" required>
                            <option selected value = "'.$horari.'"> '.$torn.' </option>
                            <option value="1">Matí</option>
                            <option value="2">Tarda</option>
                            <option value="3">Nit</option>
                          </select>
                        </div>
                      </div>
                        <div class="form-row">
                          <div class="col-md-3 mb-3">
                            <label for="dic">Data inici contracte *</label>
                            <input type="date" class="form-control form-control-sm" name="data_inici" value = "'.$data_inici.'" required>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="dfi">Data fi contracte *</label>
                            <input type="date" class="form-control form-control-sm" name="data_fi" value = "'.$data_fi.'" required>
                          </div>
                        </div>
                    <!--</form>-->
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" name="modificar" value="Modificar">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                </div>
              </form>
              </div>
            </div>
          </div>';


          if (isset($_POST['modificar'])) {

            $empleat = new Empleat();
            $empleat->modificar_empleat($connection);
          }

          /*Modal d'eliminar*/
            echo '<!-- Modal -->
          <div class="modal fade" id="modalEliminar'.$id_empleat.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Empleat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="form-group row">
                      <label for="example-text-input" class="col-form-label">Segur que vols eliminar a "'.$nom.' '.$cognom1.' '.$cognom2.'" ?</label>
                   </div>
                  </div>
              </div>
              <form method="post">
              <div class="col-10">
                <input class="form-control" type="text" value="'.$id_empleat.'" id="example-text-input" name="id_empleat" style="display: none;">
              </div>
                <div class="modal-footer">
                  <input type="submit" name= "confirmacio" class="btn btn-primary" value="Sí" >
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
              </form>
              </div>
            </div>
          </div>';
          }

        if (isset($_POST['confirmacio'])) {
          $empleat = new Empleat();
          $empleat->eliminar_empleat($connection);
        }
      }
    }catch(Exception $error){
      echo $error;
      $connection->close();
      $sentencia->close();
      return false;
    }
    echo '</table>';
  }
  /**Mètode per a modificar les dades*/
  public function modificar_empleat($connection){

    $id_empleat = $_POST['id_empleat'];
    $nom = $_POST['nom'];
    $cognom1 = $_POST['cognom1'];
    $cognom2 = $_POST ['cognom2'];
    $num_doc = $_POST["nom"];
    $tipus_doc = $_POST["tipus_doc"];
    $tlf = $_POST["tlf"];
    $email = $_POST["email"];
    $adreca = $_POST["adreca"];
    $ciutat = $_POST["ciutat"];
    $provincia = $_POST["provincia"];
    $codi_postal = $_POST["codi_postal"];
    $codi_ss = $_POST["codi_ss"];
    $num_nomina = $_POST["num_nomina"];
    $iban = $_POST["iban"];
    $especialitat = $_POST["especialitat"];
    $carrec = $_POST["carrec"];
    $sexe = $_POST["sexe"];
    $data_naixement = $_POST["data"];
    $rol = $_POST["rol"];
    $data_inici = $_POST["data_inici"];
    $data_fi = $_POST["data_fi"];
    $horari = $_POST["horari"];

    $sql_update = "UPDATE USUARI JOIN DADES_EMPLEAT ON USUARI.id_dades_empleat = DADES_EMPLEAT.id_dades_empleat
                        LEFT JOIN HORARI ON HORARI.id_horari = DADES_EMPLEAT.id_horari
                        LEFT JOIN ROL ON ROL.id_rol = USUARI.id_rol
                        SET USUARI.nom='$nom', USUARI.cognom1='$cognom1', USUARI.cognom2='$cognom2', USUARI.tipus_document = '$tipus_doc', USUARI.telefon = '$tlf',
                        USUARI.email = '$email', USUARI.adreca = '$adreca', USUARI.ciutat='$ciutat', USUARI.provincia='$provincia', USUARI.codi_postal='$provincia',
                        USUARI.codi_postal='$codi_postal', DADES_EMPLEAT.codi_seg_social='$codi_ss', DADES_EMPLEAT.num_nomina='$num_nomina', DADES_EMPLEAT.IBAN='$iban', DADES_EMPLEAT.especialitat='$especialitat',
                        DADES_EMPLEAT.carrec='$carrec', USUARI.sexe='$sexe', USUARI.data_naixement='$data_naixement', USUARI.id_rol='$rol', DADES_EMPLEAT.data_inici_contracte='$data_inici',
                        DADES_EMPLEAT.data_fi_contracte = '$data_fi', DADES_EMPLEAT.id_horari='$horari' WHERE USUARI.id_usuari='$id_empleat'";
                        var_dump($sql_update);



      if (mysqli_query($connection, $sql_update)) {
          echo "<script>window.location.href='llistarEmpleat.php';</script>";
          echo "Okay";
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }

  /**Mètode per a eliminar*/
  public function eliminar_empleat($connection){
    $id_empleat = $_POST['id_empleat'];
    $sql_delete = "DELETE FROM USUARI WHERE id_usuari=$id_empleat";
      if (mysqli_query($connection, $sql_delete)) {
          echo "<script>window.location.href='llistarEmpleat.php';</script>";
          echo "Okay";
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }
}
 ?>
