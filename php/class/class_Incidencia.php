<?php
include_once("connection.php");
class Incidencia {
    private $titol_incidencia_parc;
    private $descripcio_incidencia_parc;
    private $prioritat_incidencia_parc;
    private $data_inici_incidencia_parc;
    private $data_fi_incidencia_parc;
    private $id_estat;
    private $id_usuari_client;
    private $id_usuari_empleat;

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
  function __construct7($titol_incidencia_parc, $descripcio_incidencia_parc, $prioritat_incidencia_parc, $data_inici_incidencia_parc, $data_fi_incidencia_parc){
    $this->titol_incidencia_parc = $titol_incidencia_parc;
    $this->descripcio_incidencia_parc = $descripcio_incidencia_parc;
    $this->prioritat_incidencia_parc = $prioritat_incidencia_parc;
    $this->data_inici_incidencia_parc = $data_inici_incidencia_parc;
    $this->data_fi_incidencia_parc = $data_fi_inici_incidencia_parc;
    $this->id_estat = 1;
    $this->id_usuari_client = 4;
    $this->id_usuari_empleat = 5;
  }

  /**Funcio de inserir zones*/
  public function inserir_incidencia(){
    try {
      $connection = crearConnexio();
      $sql = "INSERT INTO INCIDENCIA_PARC (titol_incidencia_parc, descripcio_incidencia_parc, prioritat_incidencia_parc, data_inici_incidencia_parc, data_fi_incidencia_parc, id_estat, id_usuari_client, id_usuari_empleat) VALUES (?,?,?,?,?,?,?,?);";
      $sentencia = $connection->prepare($sql);

      $sentencia->bind_param("sssssiii",$this->titol_incidencia_parc,$this->descripcio_incidencia_parc, $this->prioritat_incidencia_parc, $this->data_inici_incidencia_parc, $this->data_fi_incidencia_parc, $this->id_estat, $this->id_usuari_client, $this->id_usuari_empleat);
        
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

    public function validar_incidencia(){
          ini_set( 'display_errors', 1 );
          error_reporting( E_ALL );

          echo "Incidencia creada";
        }

  /**Funció per a mostrar els elements de la base de dades*/
  public function llistar_incidencia(){
    try{
      $connection = crearConnexio();
      $sql = "SELECT * FROM INCIDENCIA_PARC";
      $result = $connection->query($sql);
      /*Estructura de la taula ('titols' dels camps)*/
      echo '<table class="table">';
      echo  '<thead>';
      echo    '<tr>';
      echo      '<th scope="col">id_incidencia_parc</th>';
      echo      '<th scope="col">titol_incidencia_parc</th>';
      echo      '<th scope="col">descripcio_incidencia_parc</th>';
      echo      '<th scope="col">prioritat_incidencia_parc</th>';
      echo      '<th scope="col">data_inici_incidencia_parc</th>';
      echo      '<th scope="col">data_fi_incidencia_parc</th>';
      echo      '<th scope="col">id_estat</th>';
      echo      '<th scope="col">Incidencia de:</th>';
      echo      '<th scope="col">Empleat Assignat</th>';
      echo    '</tr>';
      echo  '</thead>';

      if($result){
        /*imprimim les dades de la bbdd en la taula tantes vegades com files tinguem*/
        while($row = $result->fetch_assoc()){
          $this->id_incidencia_parc = $row["id_incidencia_parc"];
          $this->titol_incidencia_parc = $row["titol_incidencia_parc"];
          $this->descripcio_incidencia_parc = $row["descripcio_incidencia_parc"];
          $this->prioritat_incidencia_parc = $row["prioritat_incidencia_parc"];
          $this->data_inici_incidencia_parc = $row["data_inici_incidencia_parc"];
          $this->data_fi_incidencia_parc = $row["data_fi_incidencia_parc"];
          $this->id_estat = $row["id_estat"];
          $this->id_usuari_client = $row["id_usuari_client"];
          $this->id_usuari_empleat = $row["id_usuari_empleat"];
          echo '<tbody>';
          echo  '<tr>';
          echo   '<th scope="row">'.$row["id_incidencia_parc"].'</th>'; 
          echo   '<th scope="row">'.$row["titol_incidencia_parc"].'</th>';              //th es lo "principal", pueden haber 'td' "dentro" de th
          echo   '<th scope="row">'.$row["descripcio_incidencia_parc"].'</th>'; 
          echo   '<th scope="row">'.$row["prioritat_incidencia_parc"].'</th>'; 
          echo   '<th scope="row">'.$row["data_inici_incidencia_parc"].'</th>'; 
          echo   '<th scope="row">'.$row["data_fi_incidencia_parc"].'</th>'; 
          echo   '<th scope="row">'.$row["id_estat"].'</th>'; 
          echo   '<th scope="row">'.$row["id_usuari_client"].'</th>'; 
          echo   '<th scope="row">'.$row["id_usuari_empleat"].'</th>'; 
          echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$this->id_incidencia_parc.'">Modificar</button></td>"';
          echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$this->id_incidencia_parc.'">Eliminar</button></td>"';
          echo   '<br>';
          echo  '</tr>';
          echo '</tbody>';

           /*Modal de modificar*/
                      echo '<!-- Modal -->
                    <div class="modal fade" id="modalModificar'.$this->id_incidencia_parc.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modificar incidencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container">
                              <form method="post">
                              <div class="form-group row">
                               <div class="col-10">
                                 <input class="form-control" type="text" value="'.$this->id_incidencia_parc.'" id="example-text-input" name="id_incidencia_parc" style="display: none;">
                               </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Titol incidencia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->titol_incidencia_parc.'" id="example-text-input" name="titol_incidencia_parc"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Descripcio incidencia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->descripcio_incidencia_parc.'" id="example-text-input" name="descripcio_incidencia_parc"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Prioritat Incidencia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->prioritat_incidencia_parc.'" id="example-text-input" name="prioritat_incidencia_parc"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Data inici</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->data_inici_incidencia_parc.'" id="example-text-input" name="data_inici_incidencia_parc"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Data fi</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->data_fi_incidencia_parc.'" id="example-text-input" name="data_fi_incidencia_parc"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">ID del estat</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->id_estat.'" id="example-text-input" name="id_estat"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">ID del usuari client</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->id_usuari_client.'" id="example-text-input" name="id_usuari_client"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">ID del usuari empleat</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->id_usuari_empleat.'" id="example-text-input" name="id_usuari_empleat"">
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
                      $Incidencia = new Incidencia();
                      $Incidencia->modificar_incidencia($connection);
                    }

        /*Modal d'eliminar*/
          echo '<!-- Modal -->
        <div class="modal fade" id="modalEliminar'.$this->id_incidencia_parc.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <label for="example-text-input" class="col-form-label">Segur que vols eliminar la zona "'.$this->titol_incidencia_parc.'"?</label>
                 </div>
                </div>
            </div>
            <form method="post">
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->id_incidencia_parc.'" id="example-text-input" name="id_incidencia_parc" style="display: none;">
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
        $Incidencia = new Incidencia();
        $Incidencia->eliminar_incidencia($connection);
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

 public function modificar_incidencia($connection){
            $id_incidencia_parc = $_POST['id_incidencia_parc'];
            $titol_incidencia_parc = $_POST['titol_incidencia_parc'];
            $descripcio_incidencia_parc = $_POST['descripcio_incidencia_parc'];
            $prioritat_incidencia_parc = $_POST['prioritat_incidencia_parc'];
            $data_inici_incidencia_parc = $_POST['data_inici_incidencia_parc'];
            $data_fi_incidencia_parc = $_POST['data_fi_incidencia_parc'];
            $id_estat = $_POST['id_estat'];
            $id_usuari_client = $_POST['id_usuari_client'];
            $id_usuari_empleat = $_POST['id_usuari_empleat'];
            $sql_update = "UPDATE INCIDENCIA_PARC SET titol_incidencia_parc='$titol_incidencia_parc',descripcio_incidencia_parc='$descripcio_incidencia_parc',prioritat_incidencia_parc='$prioritat_incidencia_parc',data_inici_incidencia_parc='$data_inici_incidencia_parc', data_fi_incidencia_parc='$data_fi_incidencia_parc', id_estat='$id_estat', id_usuari_client='$id_usuari_client', id_usuari_empleat='$id_usuari_empleat' WHERE id_incidencia_parc=$id_incidencia_parc";
              if (mysqli_query($connection, $sql_update)) {
                  echo "<script>window.location.href='llistarIncidencia.php';</script>";
                  echo "Okay";
              } else {
                  echo "Error updating record: " . mysqli_error($connection);
              }
            }

            /**Mètode per a eliminar una zona*/
            public function eliminar_incidencia($connection){
            $id_incidencia = $_POST['id_incidencia'];
            $sql_delete = "DELETE FROM INCIDENCIA_PARC WHERE id_incidencia_parc=$id_incidencia_parc";
            if (mysqli_query($connection, $sql_delete)) {
            echo "<script>window.location.href='llistarIncidencia.php';</script>";
            echo "Okay";
            } else {
            echo "Error updating record: " . mysqli_error($connection);
            }
        }
}
?>
