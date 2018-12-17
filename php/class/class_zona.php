<?php
include_once("connection.php");
class Zona {
  private $nom;

  /**Constructor sense res*/
  function __construct() {
      $args = func_get_args();
      $num = func_num_args();
      $f='__construct'. $num;
      if (method_exists($this,$f)) {
        call_user_func_array(array($this,$f),$args);
      }
    }

  /**Constructor amb dos parametres*/
  function __construct1($nom){
    $this->nom = $nom;
  }

  /**Funcio de inserir zones*/
  public function inserir_zona(){
    try {
      $connection = crearConnexio();
      $sql = "INSERT INTO ZONA_PARC (nom_zona_parc) VALUES (?);";
      $sentencia = $connection->prepare($sql);

      $sentencia->bind_param("s",$this->nom);
      if($sentencia->execute()){
        $connection->close();
        $sentencia->close();
        return true;
      }
      else{
        $connection->close();
        $sentencia->close();
        return "Error en el registre.";
      }
    }catch(Exception $error){
      echo $error;
      $connection->close();
      $sentencia->close();
      return false;
    }
  }

  /**Funció per a mostrar els elements de la base de dades*/
  public function llistar_zona(){
    try{
      $connection = crearConnexio();
      $sql = "SELECT * FROM ZONA_PARC";
      $result = $connection->query($sql);
      /*Estructura de la taula ('titols' dels camps)*/
      echo '<table class="table">';
      echo  '<thead>';
      echo    '<tr>';
      echo      '<th scope="col">Nom</th>';
      echo    '</tr>';
      echo  '</thead>';

      if($result){
        /*imprimim les dades de la bbdd en la taula tantes vegades com files tinguem*/
        while($row = $result->fetch_assoc()){
          $this->id_zona = $row["id_zona_parc"];
          $this->nom = $row["nom_zona_parc"];

          echo '<tbody>';
          echo  '<tr>';
          echo   '<th scope="row">'.$row["nom_zona_parc"].'</th>';              //th es lo "principal", pueden haber 'td' "dentro" de th
          echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$this->id_zona.'">Modificar</button></td>"';
          echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$this->id_zona.'">Eliminar</button></td>"';
          echo   '<br>';
          echo  '</tr>';
          echo '</tbody>';

          /*Modal de modificar*/
          echo '<!-- Modal -->
        <div class="modal fade" id="modalModificar'.$this->id_zona.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                     <input class="form-control" type="text" value="'.$this->id_zona.'" id="example-text-input" name="id_zona" style="display: none;">
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Nom</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$this->nom.'" id="example-text-input" name="nom"">
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="modificar" value="Modificar"">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
              </div>
            </form>
            </div>
          </div>
        </div>';


        if (isset($_POST['modificar'])) {
          $zona = new Zona();
          $zona->modificar_zona($connection);
        }

        /*Modal d'eliminar*/
          echo '<!-- Modal -->
        <div class="modal fade" id="modalEliminar'.$this->id_zona.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar zona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="form-group row">
                    <label for="example-text-input" class="col-form-label">Segur que vols eliminar la zona "'.$this->nom.'"?</label>
                 </div>
                </div>
            </div>
            <form method="post">
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->id_zona.'" id="example-text-input" name="id_zona" style="display: none;">
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
        $zona = new Zona();
        $zona->eliminar_zona($connection);
      }
    }
    }catch(Exception $error){
      echo $error;
      $connection->close();
      $sentencia->close();
      return false;
    }
    echo '</table>';
    $connection->close();
  }



  /**Mètode per a modificar les dades de una zona*/
  public function modificar_zona($connection){
    $id_zona = $_POST['id_zona'];
    $nom = $_POST['nom'];
    $sql_update = "UPDATE ZONA_PARC SET nom_zona_parc='$nom' WHERE id_zona_parc=$id_zona";
      if (mysqli_query($connection, $sql_update)) {
          echo "<script>window.location.href='llistarZona.php';</script>";
          echo "Okay";
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }

  /**Mètode per a eliminar una zona*/
  public function eliminar_zona($connection){
    $id_zona = $_POST['id_zona'];
    $sql_delete = "DELETE FROM ZONA_PARC WHERE id_zona_parc=$id_zona";
      if (mysqli_query($connection, $sql_delete)) {
          echo "<script>window.location.href='llistarZona.php';</script>";
          echo "Okay";
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }

  /*setters i getters*/
  function getNom(){
    return $nom;
  }
  function setNom($nom){
    $this->nom = $nom;
  }
}
?>