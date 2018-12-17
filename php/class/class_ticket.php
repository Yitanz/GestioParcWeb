<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
class Ticket {
  private $id_venta_ticket;
  private $id_tipus_ticket;
  private $id_usuari;
  private $nado;
  private $xiquet;
  private $adult;
  private $visitant;
/**
 * Constructor de clase ticket
 */
  function __construct(){
    $args = func_get_args();
    $num = func_num_args();
    $f='__construct'. $num;
    if (method_exists($this,$f)) {
      call_user_func_array(array($this,$f),$args);
    }
  }

  function __construct0(){
  }
/**
 * Constructor amb 4 parametres
 * @param  [type] $adult    [description]
 * @param  [type] $xiquet   [description]
 * @param  [type] $nado     [description]
 * @param  [type] $visitant [description]
 * @return [type]           [description]
 */
  function __construct4($adult, $xiquet, $nado, $visitant){
    $this->nado = $nado;
    $this->xiquet = $xiquet;
    $this->adult = $adult;
    $this->visitant = $visitant;
  }
/**
 * Constructor de la clase ticket amb pas de 6 paràmetres
 * @param  [type] $id_tipus_ticket [description]
 * @param  [type] $id_usuari       [description]
 * @param  [type] $nado            [description]
 * @param  [type] $xiquet          [description]
 * @param  [type] $adult           [description]
 * @param  [type] $visitant        [description]
 * @return [type]                  [description]
 */
  function __construct6($id_tipus_ticket, $id_usuari, $nado, $xiquet, $adult, $visitant){
    $this->id_usuari = $id_usuari;
    $this->id_tipus_ticket = $id_tipus_ticket;
    $this->nado = $nado;
    $this->xiquet = $xiquet;
    $this->adult = $adult;
    $this->visitant = $visitant;
  }

/*getters*/
  function getId_Tipus_Ticket(){
    return $id_tipus_ticket;
  }
  function getId_usuari(){
    return $id_usuari;
  }
  function getNado(){
    return $nado;
  }
  function getXiquet(){
    return $xiquet;
  }
  function getAdult(){
    return $adult;
  }
  function getvisitant(){
    return $visitant;
  }

/*setters*/

  function setId_Tipus_Ticket(){
    $this->id_tipus_ticket = $id_tipus_ticket;
  }

  function setId_usuari(){
    $this->$id_usuari = $id_usuari;
  }
  function setNado(){
    $this->$nado = $nado;
  }
  function setXiquet(){
    $this->$xiquet = $xiquet;
  }
  function setAdult(){
    $this->$adult = $adult;
  }
  function setVisitant(){
    $this->$visitant = $visitant;
  }

/**
 * Mètode per a crear tickets
 * @return [type] [description]
 */
      public function crear_ticket(){
        try {
          $connection = crearConnexio();
          //$sql = "INSERT INTO TICKET (id_tipus_ticket, id_tipus_linea, preu_total_linea) VALUES (?,?,?)";
          $sql = "INSERT INTO VENTA_TICKET (id_tipus_ticket, id_usuari, nado, xiquet, adult, visitant, actiu) VALUES (?,?,?,?,?,?,?)";
          $sentencia = $connection->prepare($sql);
          //$sentencia->bind_param("iiis",$this->id_tipus_ticket,$this->$id_tipus_linea,$this->preu_total_linea);
          $sentencia->bind_param("iiiiii",$this->id_tipus_ticket,$this->$id_tipus_linea,$this->preu_total_linea);
           if ($sentencia->execute()) {
             $connection->close();
             $sentencia->close();
             return true;
           }
           else {
             $connection->close();
             $sentencia->close();
             return "Error en el registre";
           }
         }catch(Exception $error){
           echo $error;
           $connection->close();
           $sentencia->close();
           return false;
         }
        }
    public function validar_ticket(){
      ini_set('display_errors', 1);
      error_reporting(E_ALL);

      echo "Noticia creada";
    }

/**
 * Mètode per a llistar tickets
 * @return [type] [description]
 */
    public function llistar_ticket(){
      try {
        $connection = crearConnexio();
        $sql = "SELECT * from TICKET";
        $resultat = $connection->query($sql);
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">id_ticket</th>';
        echo '<th scope="col">id_tipus_ticket</th>';
        echo '<th scope="col">id_tipus_linea</th>';
        echo '<th scope="col">preu_total_linea</th>';
        echo '</tr>';
        echo '</thead>';

        if($resultat){
          while ($row = $resultat->fetch_assoc()) {
            $this->id_ticket = $row["id_ticket"];
            $this->id_tipus_ticket = $row["id_tipus_ticket"];
            $this->id_tipus_linea = $row["id_tipus_linea"];
            $this->preu_total_linea = $row["preu_total_linea"];

            echo '<tbody>';
            echo '<tr>';
            echo '<th scope="row">'.$row["id_ticket"].'</th>';
            echo '<td>'.$row["id_tipus_ticket"].'</th>';
            echo '<td>'.$row["id_tipus_linea"].'</th>';
            echo '<td>'.$row["preu_total_linea"].'</th>';
            echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$this->id_noticia.'">Modificar</button></td>"';
            echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$this->id_noticia.'">Eliminar</button></td>"';
            echo   '<br>';
            echo '</tr>';
            echo '</tbody>';

            /*Modal de modificar*/
          echo '<!-- Modal -->
        <div class="modal fade" id="modalModificar'.$this->id_ticket.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                     <input class="form-control" type="text" value="'.$this->id_ticket.'" id="example-text-input" name="id_ticket" style="display: none;">
                   </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Titol noticia</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$this->id_tipus_ticket.'" id="example-text-input" name="id_tipus_ticket"">
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Descripcio noticia</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$this->id_tipus_linea.'" id="example-text-input" name="id_tipus_linea"">
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Data de la noticia</label>
                    <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="text" value="'.$this->preu_total_linea.'" id="example-text-input" name="preu_total_linea"">
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
          $ticket = new ticket();
          $ticket->modificar_ticket($connection);
        }

        echo '<!-- Modal -->
      <div class="modal fade" id="modalEliminar'.$this->id_ticket.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar ticket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="form-group row">
                  <label for="example-text-input" class="col-form-label">Segur que vols eliminar la noticia "'.$this->id_ticket.'"?</label>
               </div>
              </div>
          </div>
          <form method="post">
          <div class="col-10">
            <input class="form-control" type="text" value="'.$this->id_ticket.'" id="example-text-input" name="id_noticia" style="display: none;">
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
      $ticket = new ticket();
      $ticket->eliminar_ticket($connection);
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

/**
 * Mètode per a modificar tickets
 * @param  [type] $connection [description]
 * @return [type]             [description]
 */
public function modificar_ticket($connection){
$id_ticket = $_POST['id_ticket'];
var_dump($id_ticket);
$id_tipus_ticket = $_POST['id_tipus_ticket'];
var_dump($titol_noticia);
$id_tipus_linea = $_POST['id_tipus_linea'];
$preu_total_linea = $_POST['preu_total_linea'];
$sql_update = "UPDATE TICKET SET id_tipus_ticket='$id_tipus_ticket',id_tipus_linea='$id_tipus_linea',preu_total_linea='$preu_total_linea' WHERE id_ticket=$id_ticket";
  if (mysqli_query($connection, $sql_update)) {
      echo "<script>window.location.href='llistarTicket.php';</script>";
      echo "Okay";
  } else {
      echo "Error updating record: " . mysqli_error($connection);
  }
}

/**
   * Mètode per a donar de baixa un ticket
   * @param  [type] $connection [description]
   * @return [type]             [description]
   */
  public function baixa_ticket($connection){
    $id_ticket = $_POST['id_ticket'];
    $sql_delete = "UPDATE VENTA_TICKET SET actiu = 0 WHERE id_ticket=$id_ticket";
    if (mysqli_query($connection, $sql_delete)) {
    echo "<script>window.location.href='llistarTicket.php';</script>";
    echo "Okay";
    } else {
    echo "Error updating record: " . mysqli_error($connection);
    }
  }


  public function guardar(){
    session_start();
  }

  public function afegirCistella3(){
    
  }
}
 ?>
