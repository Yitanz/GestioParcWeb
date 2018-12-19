<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
class Client {
  /**
    * [Atributs de la clase]
    * @var [type Int.Guardem l'ID del client.]
    * @var [type String. Guardem el nom del client.]
    * @var [type String. Guardem el cognom1 del client.]
    * @var [type String. Guardem el cognom2 del client.]
    * @var [type String. Guardem el email del client.]
    * @var [type String. Guardem la contrasenya.]
    * @var [type Date. Guardem la data de naixement.]
    * @var [type String. Guardem l'adreça.]
    * @var [type String. Guardem la ciutat.]
    * @var [type String. Guardem la provincia.]
    * @var [type Int. Guardem el codic postal.]
    * @var [type String. Guardem el tipus de document.]
    * @var [type Int. Guardem el numero de document.]
    * @var [type String. Guardem el sexe del client.]
    * @var [type Int. Guardem el numero del client.]
    * @var [type Int. Guardem el rol del client]
    * @var [type Boolean. Guardem si esta actiu o no el compte.]
    * @var [type String. Guardem el hash del client.]
    */
  private $id;
  private $nom;
  private $cognom1;
  private $cognom2;
  private $email;
  private $contrasenya;
  private $date;
  private $adreca;
  private $ciutat;
  private $provincia;
  private $cp;
  private $tipus_document;
  private $numero_document;
  private $sexe;
  private $telefon;
  private $id_rol;
  private $actiu;
  private $hash_validacio;

  /**
  * Mètode constructor sense pas de parametres
  */
  function __construct() {
    $args = func_get_args();
    $num = func_num_args();
    $f='__construct'. $num;
    if (method_exists($this,$f)) {
      call_user_func_array(array($this,$f),$args);
    }
  }
  /**
  * Mètode constructor sense pas de parametres
  */
  function __construct0()
  {
  }
  /**
  * Mètode constructor amb pas de dos parametres
  * @param string
  * @param string
  */
  function __construct2($email, $contrasenya)
  {
    $this->email = $email;
    $this->contrasenya = $contrasenya;
  }
/**
 * Constrctor client de creacio
 * @param  string $nom
 * @param  string $cognom1
 * @param  string $cognom2
 * @param  string $email
 * @param  string $contrasenya
 * @param  string $date
 * @param  string $adreca
 * @param  string $ciutat
 * @param  string $provincia
 * @param  int $cp
 * @param  string $tipus_document
 * @param  string $numero_document
 * @param  string $sexe
 * @param  int $telefon
 */
function __construct14($nom,$cognom1,$cognom2,$email,$contrasenya,$date,$adreca,$ciutat,$provincia,$cp,$tipus_document,$numero_document,$sexe,$telefon){
  $this->nom = $nom;
  $this->cognom1 = $cognom1;
  $this->cognom2 = $cognom2;
  $this->email = $email;
  $this->contrasenya = password_hash($contrasenya, PASSWORD_DEFAULT);
  $this->date = $date;
  $this->adreca = $adreca;
  $this->ciutat = $ciutat;
  $this->provincia = $provincia;
  $this->cp = $cp;
  $this->tipus_document = $tipus_document;
  $this->numero_document = $numero_document;
  $this->sexe = $sexe;
  $this->telefon = $telefon;
  $this->id_rol = 1;
  $this->actiu = 0;
  $this->hash = md5(rand(0,1000));
}

/**
 * get nom
 * @return string
 */
  function getNom(){
    return $nom;
  }
  /**
   * set nom
   * @param  string $nom
   */
  function setNom($nom){
      $this->nom = $nom;
  }
  /**
   * get cognom1
   * @return string
   */
  function getCognom1(){
    return $cognom1;
  }
  /**
   * set cognom1
   * @param string $cognom1
   */
  function setCognom1($cognom1){
      $this->cognom1 = $cognom1;
  }
  /**
   * get cognom2
   * @return string
   */
  function getCognom2(){
    return $cognom2;
  }
  /**
   * set cognom2
   * @param string $cognom2
   */
  function setCognom2($cognom2){
      $this->cognom2 = $cognom2;
  }
  /**
   * get email
   * @return string
   */
  function getEmail(){
    return $email;
  }
  /**
   * set email
   * @param string $email
   */
  function setEmail($email){
      $this->email = $email;
  }
  /**
   * get contrasenya
   * @return string
   */
  function getContrasenya(){
    return $contrasenya;
  }
  /**
   * set contrasenya
   * @param string $contrasenya
   */
  function setContrasenya($contrasenya){
      $this->contrasenya = $contrasenya;
  }
  /**
   * get date
   * @return string
   */
  function getDate(){
    return $date;
  }
  /**
   * set date
   * @param string $date
   */
  function setDate($date){
      $this->date = $date;
  }
  /**
   * get adreça
   * @return string
   */
  function getAdreca(){
    return $adreca;
  }
  /**
   * set adreça
   * @param string $adreca
   */
  function setAdreca($adreca){
     $this->adreca = $adreca;
  }
  /**
   * get ciutat
   * @return string
   */
  function getCiutat(){
    return $ciutat;
  }
  /**
   * set ciutat
   * @param string $ciutat
   */
  function setCiutat($ciutat){
      $this->ciutat = $ciutat;
  }
  /**
   * get provincia
   * @return string
   */
  function getProvincia(){
    return $provincia;
  }
  /**
   * [setProvincia description]
   * @param [type] $provincia [description]
   */
  function setProvincia($provincia){
      $this->provincia = $provincia;
  }
  function getCP(){
    return $cp;
  }
  function setCP($cp){
      $this->cp = $cp;
  }
  function getTipus_document(){
    return $tipus_document;
  }
  function setTipus_document($tipus_document){
      $this->tipus_document = $tipus_document;
  }
  function getNumero_document(){
    return $numero_document;
  }
  function setNumero_document($numero_document){
      $this->numero_document = $numero_document;
  }
  function getSexe(){
    return $sexe;
  }
  function setSexe($sexe){
    $this->sexe = $sexe;
  }
  function getTelefon(){
    return $telefon;
  }
  function setTelefon($telefon){
    $this->telefon = $telefon;
  }
  function getId_rol(){
    return $id_rol;
  }
  function setId_rol($id_rol){
      $this->id_rol = $id_rol;
  }
  function getActiu(){
    return $actiu;
  }
  function setActiu($actiu){
      $this->actiu = $actiu;
  }
  function getID(){
    return $id;
  }
  function setID($id){
    $this->id = $id;
  }
  function getHash(){
    return $hash_validacio;
  }
  function setHash($hash_validacio){
    $this->hash_validacio = $hash_validacio;
  }




  /**
  * @brief Mètode per a inserir clients en la base de dades
  * @return boolean
  */
  public function inserir_client(){
    try {
      $connection = crearConnexio();
      $sql = "INSERT INTO USUARI (nom, cognom1, cognom2, email, password, data_naixement, adreca, ciutat, provincia,
        codi_postal, tipus_document, numero_document, sexe, telefon, id_rol, actiu, hash) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
      $sentencia = $connection->prepare($sql);

      $sentencia->bind_param("sssssssssisssiiis",$this->nom,$this->cognom1,$this->cognom2,$this->email,
      $this->contrasenya,$this->date,$this->adreca,$this->ciutat,$this->provincia,$this->cp,
      $this->tipus_document,$this->numero_document,$this->sexe,$this->telefon,$this->id_rol,$this->actiu,$this->hash);
      //var_dump($this->hash);
      $result = $sentencia->execute();
      var_dump($result);

        /*if(){
          echo"funciona";
          $connection->close();
          $sentencia->close();
          return true;
          }
        else{
          $connection->close();
          $sentencia->close();
          return "Error en el registre.";
        }*/
      }catch(Exception $error){
          echo $error;
          $connection->close();
          $sentencia->close();
          return false;

      }
    }

    /**
    * @brief Mètode per a enviar un email a un client per validar el compte
    */
    public function validar_client(){
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "contacto@univeylandia-parc.cat";
      $to = "$this->email";
      var_dump($this->email);
      $subject = "Validacio de Univeylandia";
      $message = "Validar el compte
      http://www.univeylandia-parc.cat/verificar.php?email=$this->email&hash=$this->hash



      ";
      $header = "From: ". $from;
      $envia = mail($to,$subject,$message,$header);
      var_dump($envia);
      if($envia){
        echo "Revisa el teu correu i valida el compte";
      }else {
        echo "Ha hagut un error.";
      }

    }

    /**
    * @brief Mètode que imprimeix codi html per llistar els clients (i modificar-los i eliminar-los)
    * @return [boolean]
    */
    public static function llistar_client(){
      try{
        $connection = crearConnexio();
        $sql = "SELECT * FROM USUARI WHERE id_rol=1";
        $resultat = $connection->query($sql);
        echo '<table class="table table-bordered table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Nom</th>';
        echo '<th scope="col">Cognom1</th>';
        echo '<th scope="col">Cognom2</th>';
        echo '<th scope="col">Correu</th>';
        echo '<th scope="col">Data de naixement</th>';
        echo '<th scope="col">Adreça</th>';
        echo '<th scope="col">Ciutat</th>';
        echo '<th scope="col">Provincia</th>';
        echo '<th scope="col">CP</th>';
        echo '<th scope="col">Tipus Document</th>';
        echo '<th scope="col">Numero Document</th>';
        echo '<th scope="col">Sexe</th>';
        echo '<th scope="col">Telefon</th>';
        echo '</tr>';
        echo '</thead>';

        if($resultat){
          while($row = $resultat->fetch_assoc()){
            $id = $row["id_usuari"];
            $nom = $row["nom"];
            $cognom1 = $row["cognom1"];
            $cognom2 = $row["cognom2"];
            $email = $row["email"];
            $date = $row["data_naixement"];
            $adreca = $row["adreca"];
            $ciutat = $row["ciutat"];
            $provincia = $row["provincia"];
            $cp = $row["codi_postal"];
            $tipus_document = $row["tipus_document"];
            $numero_document = $row["numero_document"];
            $sexe = $row["sexe"];
            $telefon = $row["telefon"];
            $contrasenya = $row["password"];


            echo '<tbody>';
            echo '<tr>';
            echo '<th scope="row">'.$row["nom"].'</th>';
            echo '<td>'.$row["cognom1"].'</th>';
            echo '<td>'.$row["cognom2"].'</th>';
            echo '<td>'.$row["email"].'</th>';
            echo '<td>'.$row["data_naixement"].'</td>';
            echo '<td>'.$row["adreca"].'</td>';
            echo '<td>'.$row["ciutat"].'</td>';
            echo '<td>'.$row["provincia"].'</td>';
            echo '<td>'.$row["codi_postal"].'</td>';
            echo '<td>'.$row["tipus_document"].'</td>';
            echo '<td>'.$row["numero_document"].'</td>';
            echo '<td>'.$row["sexe"].'</td>';
            echo '<td>'.$row["telefon"].'</td>';
            echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$id.'"> Modificar</button></td>';
            echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar'.$id.'"> Eliminar<button></td>';
            echo '</tr>';
            echo '</tbody>';
        echo '<!-- Modal -->
        <div class="modal fade" id="modalModificar'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modificar zona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <form method="post">
                  <div class="form-group row">
                   <div class="col-10">
                     <input class="form-control" type="text" value="'.$id.'" id="example-text-input" name="id" style="display: none;">
                   </div>
                  </div>
                  </div>



                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Nom</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$nom.'" id="example-text-input" name="nom_mod"">
                    </div>
                  </div>
                  </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Cognom1</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$cognom1.'" id="example-text-input" name="cognom1_mod"">
                    </div>
                  </div>
                  </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Cognom2</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$cognom2.'" id="example-text-input" name="cognom2_mod"">
                    </div>
                  </div>
                  </div>


                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Correu</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$email.'" id="example-text-input" name="email_mod"">
                    </div>
                  </div>
                  </div>

                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Password</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="password" value="'.$contrasenya.'" id="example-text-input" name="contrasenya_mod"">
                    </div>
                  </div>
                  </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Data </label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$date.'" id="example-text-input" name="date_mod"">
                    </div>
                  </div>
                  </div>

              <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Adreça</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$adreca.'" id="example-text-input" name="adreca_mod"">
                    </div>
                  </div>
                  </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Ciutat</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$ciutat.'" id="example-text-input" name="ciutat_mod"">
                    </div>
                  </div>
                  </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Provincia</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$provincia.'" id="example-text-input" name="provincia_mod"">
                    </div>
                  </div>
                  </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">CP</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$cp.'" id="example-text-input" name="cp_mod"">
                    </div>
                  </div>
                  </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Tipus document</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$tipus_document.'" id="example-text-input" name="tipus_document_mod"">
                    </div>
                  </div>
                  </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Numero document</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$numero_document.'" id="example-text-input" name="numero_document_mod"">
                    </div>
                  </div>
                  </div>


                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Sexe</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$sexe.'" id="example-text-input" name="sexe_mod"">
                    </div>
                  </div>
                  </div>


                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Telefon</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$telefon.'" id="example-text-input" name="telefon_mod"">
                    </div>
                  </div>
                  </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" name="modificar" value="Modificar"">';
            echo'     </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            </div>
            </div>
          </div>
        </div>';

/*modal de suprimir*/
echo '<!-- Modal -->
        <div class="modal fade" id="ModalEliminar'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Atenció!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                <form method="post">
                <input class="form-control" type="text" value="'.$id.'" id="example-text-input" name="id_mod_sup" style="display: none;">
                Segur que vols eliminar aquesta atracció?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" name="Acceptar" value="Acceptar"">
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>';

        //var_dump($_POST['modificar']);
        if(isset($_POST['modificar'])){
         $client = new Client();
         $client->modificar_client();
        }

        if(isset($_POST['Acceptar'])){
          Client::eliminar_client();
        }

          }
        }
      }catch(Exception $error){
              echo $error;
              $connection->close();
              $sentencia->close();
              return false;

      }
  }
  /**
  * @brief Mètode per a modificar les dades d'un client
  */
  public function modificar_client()
  {
    $connection = crearConnexio();

    $id_mod = $_POST['id'];
    $nom_mod = $_POST['nom_mod'];
    $cognom1_mod = $_POST['cognom1_mod'];
    $cognom2_mod = $_POST['cognom2_mod'];
    $email_mod = $_POST['email_mod'];
    $contrasenya_mod = password_hash($_POST['contrasenya_mod'], PASSWORD_DEFAULT);
    $date_mod = $_POST['date_mod'];
    $adreca_mod = $_POST['adreca_mod'];
    $ciutat_mod = $_POST['ciutat_mod'];
    $provincia_mod = $_POST['provincia_mod'] ;
    $cp_mod = $_POST['cp_mod'];
    $tipus_document_mod = $_POST['tipus_document_mod'];
    $numero_document_mod = $_POST['numero_document_mod'];
    $sexe_mod = $_POST['sexe_mod'];
    $telefon_mod = $_POST['telefon_mod'];

    $sql = "UPDATE USUARI SET nom='$nom_mod',cognom1='$cognom1_mod',cognom2='$cognom2_mod',email='$email_mod',
    password='$contrasenya_mod',data_naixement='$date_mod',adreca='$adreca_mod',ciutat='$ciutat_mod',
    provincia='$provincia_mod',codi_postal='$cp_mod',tipus_document='$tipus_document_mod',
    numero_document='$numero_document_mod',sexe='$sexe_mod',telefon='$telefon_mod' WHERE id_usuari=$id_mod";

    if (mysqli_query($connection, $sql)) {
        echo '<script>window.location.href = window.location.href + "?negativet";</script>';
        echo "<p> Okay </p>";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    $connection->close();
  }

  /**
  * @brief Mètode per eliminar un client
  */
  public static function eliminar_client(){
    $connection = crearConnexio();
    $id_sup = $_POST['id_mod_sup'];
    $sql_sup = "UPDATE USUARI SET actiu='0' WHERE id_usuari='$id_sup'";

    if(mysqli_query($connection, $sql_sup)){
      echo 'fet';
    }else{
      echo "Error updating record: " . mysqli_error($connection);
    }
    $connection->close();


  }

  /**
  * @brief Mètode per a validar el login
  */
    public function validarLogin()
    {
      $connection = crearConnexio();

      $sql = "SELECT id_usuari, id_rol, password, email FROM USUARI WHERE email=? AND id_rol=1 AND actiu=1";
        echo 'sql funcional';
      //$sql = "SELECT password FROM USUARI WHERE email=? AND id_rol='1' ";

      $stmt = $connection->prepare($sql);

      $stmt->bind_param("s",$this->email);

      $stmt->execute();

      $result = $stmt->get_result();

      /* now you can fetch the results into an array - NICE */
      while ($row = $result->fetch_assoc()) {
          // use your $myrow array as you would with any other fetch
          var_dump($row['id_usuari'], $row['id_rol'], $row['email']);
          $username = $row['email'];
          $userID = $row['id_usuari'];
          $rol = $row['id_rol'];
          $hash = $row['password'];

      }

      //$stmt->bind_result($hash);

      //$stmt->fetch();

      $isValid = password_verify($this->contrasenya, $hash);
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

        $_SESSION['id_usuari'] = $userID; //$row['id_usuari'];
        $_SESSION['username'] = $username; //$row['email'];
        $_SESSION['rol'] = $rol;//$row['id_rol'];

        echo $_SESSION['username'], $_SESSION['id_usuari'], $_SESSION['rol'];

        return true;
      }
      else
      {
        echo 'NO VALID';
        return false;
      }
      $connection->close();
    }


   /**
    * [cercarDadesClient per a cercar les dades del client]
    * @param  [string] $email
    */
	  public static function cercarDadesClient($email)
  {
    try {
        $connection = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $connection->connect_error);
        }

        $sql = "SELECT nom, cognom1, cognom2, data_naixement, adreca, ciutat FROM USUARI WHERE email='$email'";

        $result = $connection->query($sql);

        if(!$result) {
          throw new Exception();
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row['nom'];
                $cognom1 = $row['cognom1'];
                $cognom2 = $row['cognom2'];
                $data_naixement = $row['data_naixement'];
                $adreca = $row['adreca'];
                $ciutat = $row['ciutat'];

                echo '<li class="list-group-item"><strong>Nom: </strong>'.$nom.'</li>';
                echo '<li class="list-group-item"><strong>Cognoms: </strong>'.$cognom1.' '.$cognom2.'</li>';
                echo '<li class="list-group-item"><strong>Data naixement: </strong>'.$data_naixement.'</li>';
                echo '<li class="list-group-item"><strong>Adreça: </strong>'.$adreca.'</li>';
                echo '<li class="list-group-item"><strong>Ciutat: </strong>'.$ciutat.'</li>';

            }
        } else {
            echo '';
        }
        $conn->close();
      }
      catch (Exception $e) {
        echo 'Error al realitzar la consulta.';
      }

  }
  /**
   * [omplirDades Omplir les dadesd el forumlari de compra]
   * @param  [string] $email
   */
  	  public static function omplirDades($email)
  {
    try {
        $connection = crearConnexio();

        if ($connection->connect_error) {
            die("Connexió fallida: " . $connection->connect_error);
        }

        $sql = "SELECT nom, cognom1, cognom2, telefon, email FROM USUARI WHERE email='$email'";

        $result = $connection->query($sql);

        if(!$result) {
          throw new Exception();
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row['nom'];
                $cognom1 = $row['cognom1'];
                $cognom2 = $row['cognom2'];
                $telefon = $row['telefon'];
                $email = $row['email'];

                echo '
                <div class="form-group">
                  <label>Nom</label>
                  <input type="text" class="form-control" name="nom"id="exampleInputText1" value='.$nom.' required>
                </div>
                <div class="form-group">
                  <label>Primer cognom</label>
                  <input type="text" class="form-control" name="cognom1" id="exampleInputText1" value='.$cognom1.' required>
                </div>
                <div class="form-group">
                  <label>Segon cognom</label>
                  <input type="text" class="form-control" name="cognom2" id="exampleInputText1" value='.$cognom2.'>
                </div>
                <div class="form-group">
                  <label>Número de telèfon</label>
                  <input type="text" class="form-control" name="telefon" id="exampleInputText1" value='.$telefon.' >
                </div>
                <div class="form-group">
                  <label>Adreça de correu electrònic</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='.$email.' required>
                  <small id="emailHelp" class="form-text text-muted">No compartirem el teu email amb ningú.</small>
                </div>
                ';
            }
        } else {
            echo '';
        }
        $connection->close();
      }
      catch (Exception $e) {
        echo 'Error al realitzar la consulta.';
      }

  }
}
?>
