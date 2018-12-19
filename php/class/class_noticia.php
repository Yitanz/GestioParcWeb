    <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
    class noticia {
      private $titol_noticia;
      private $descripcio_noticia;
      private $data_noticia;
      private $id_usuari;

      /**
      * Mètode constructor
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
      * Mètode constructor
      */
      function __construct0()
      {

      }

      /**
      * Mètode constructor amb pas de 3 paràmetres
      *@param $titol_noticia,$descripcio_noticia,$data_noticia
      */
    function __construct3($titol_noticia,$descripcio_noticia,$data_noticia){
      $this->titol_noticia = $titol_noticia;
      $this->descripcio_noticia = $descripcio_noticia;
      $this->data_noticia = $data_noticia;
      $this->id_usuari = 2;
    }
    /*getters i setters*/
      function getTitol_Noticia(){
        return $titol_noticia;
      }
      function setTitol_Noticia($titol_noticia){
          $this->titol_noticia = $titol_noticia;
      }

      function getDescripcio_Noticia(){
        return $descripcio_noticia;
      }
      function setDescripcio_Noticia($descripcio_noticia){
          $this->descripcio_noticia = $descripcio_noticia;
      }

      function getData_Noticia(){
        return $data_noticia;
      }
      function setData_Noticia($data_noticia){
          $this->data_noticia = $data_noticia;
      }


      /**
      * Mètode per a inserir noticies en la base de dades
      */
      public function inserir_noticia(){
        try {
          $connection = crearConnexio();
          $sql = "INSERT INTO NOTICIA (titol_noticia, descripcio_noticia, data_noticia, id_usuari) VALUES (?,?,?,?);";
          $sentencia = $connection->prepare($sql);
          $sentencia->bind_param("sssi",$this->titol_noticia,$this->descripcio_noticia,$this->data_noticia,$this->id_usuari);
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

        public function validar_noticia(){
          ini_set( 'display_errors', 1 );
          error_reporting( E_ALL );

          echo "Noticia creada";
        }

        /*
        public function validar_client(){
          ini_set( 'display_errors', 1 );
          error_reporting( E_ALL );

          $from = "contacto@univeylandia-parc.cat";
          $to = "$this->email";
          var_dump($this->email);
          $subject = "Validacio de Univeylandia";
          $message = "Validar el compte";
          $header = "From". $from;

          mail($to,$subject,$message,$header);

          echo "Revisa el teu correu i valida el compte";
        }
        */
        /**
        * Mètode per a llistar les noticies que hi han en la base de dades (mitjançant codi html, mostra també modificar i eliminar)
        */
        public function llistar_noticia(){
                  try{
                    $connection = crearConnexio();
                    $sql = "SELECT * FROM NOTICIA";
                    $resultat = $connection->query($sql);
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">id_noticia</th>';
                    echo '<th scope="col">titol_noticia</th>';
                    echo '<th scope="col">descripcio_noticia</th>';
                    echo '<th scope="col">data_noticia</th>';
                    echo '<th scope="col">id_usuari</th>';
                    echo '</tr>';
                    echo '</thead>';

                    if($resultat){
                      while($row = $resultat->fetch_assoc()){
                        $this->id_noticia = $row["id_noticia"];
                        $this->titol_noticia = $row["titol_noticia"];
                        $this->descripcio_noticia = $row["descripcio_noticia"];
                        $this->data_noticia = $row["data_noticia"];
                        $this->id_usuari = $row["id_usuari"];

                        echo '<tbody>';
                        echo '<tr>';
                        echo '<th scope="row">'.$row["id_noticia"].'</th>';
                        echo '<td>'.$row["titol_noticia"].'</th>';
                        echo '<td>'.$row["descripcio_noticia"].'</th>';
                        echo '<td>'.$row["data_noticia"].'</th>';
                        echo '<td>'.$row["id_usuari"].'</td>';
                        echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$this->id_noticia.'">Modificar</button></td>"';
                        echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$this->id_noticia.'">Eliminar</button></td>"';
                        echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearHTML'.$this->id_noticia.'">CrearHTML</button></td>"';
                        echo   '<br>';
                        echo '</tr>';
                        echo '</tbody>';

                        /*Modal de modificar*/
                      echo '<!-- Modal -->
                    <div class="modal fade" id="modalModificar'.$this->id_noticia.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                 <input class="form-control" type="text" value="'.$this->id_noticia.'" id="example-text-input" name="id_noticia" style="display: none;">
                               </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Titol noticia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->titol_noticia.'" id="example-text-input" name="titol_noticia"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Descripcio noticia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->descripcio_noticia.'" id="example-text-input" name="descripcio_noticia"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Data de la noticia</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->data_noticia.'" id="example-text-input" name="data_noticia"">
                                </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">ID del usuari</label>
                                <div class="form-group row">
                                <div class="col-10">
                                  <input class="form-control" type="text" value="'.$this->id_usuari.'" id="example-text-input" name="id_usuari"">
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
                      $noticia = new noticia();
                      $noticia->modificar_noticia($connection);
                    }

                  /*Modal d'eliminar*/
          echo '<!-- Modal -->
        <div class="modal fade" id="modalEliminar'.$this->id_noticia.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <label for="example-text-input" class="col-form-label">Segur que vols eliminar la noticia "'.$this->titol_noticia.'"?</label>
                 </div>
                </div>
            </div>
            <form method="post">
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->id_noticia.'" id="example-text-input" name="id_noticia" style="display: none;">
            </div>
              <div class="modal-footer">
                <input type="submit" name= "confirmacio" class="btn btn-primary" value="Sí" >
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
            </form>
            </div>
          </div>
        </div>';

      if (isset($_POST['confirmacio'])) {
        $noticia = new noticia();
        $noticia->eliminar_noticia($connection);
      }

       echo '<!-- Modal -->
        <div class="modal fade" id="modalCrearHTML'.$this->id_noticia.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Crear arxiu HTML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="form-group row">
                    <label for="example-text-input" class="col-form-label">Segur que vols crear el arxiu de la noticia de:  "'.$this->titol_noticia.'"?</label>
                 </div>
                </div>
            </div>
            <form method="post">
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->id_noticia.'" id="example-text-input" name="id_noticia" style="display: none;">
            </div>
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->titol_noticia.'" id="example-text-input" name="titol_noticia" style="display: none;">
            </div>
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->descripcio_noticia.'" id="example-text-input" name="descripcio_noticia" style="display: none;">
            </div>
            <div class="col-10">
              <input class="form-control" type="text" value="'.$this->data_noticia.'" id="example-text-input" name="data_noticia" style="display: none;">
            </div>
              <div class="modal-footer">
                <input type="submit" name= "aceptar" class="btn btn-primary" value="Sí" >
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
            </form>
            </div>
          </div>
        </div>';

        if (isset($_POST['aceptar'])) {
        $noticia = new noticia();
        $noticia->arxiu_noticia($connection);
      }
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
  * Mètode per a modificar noticies
  */
            public function modificar_noticia($connection){
            $id_noticia = $_POST['id_noticia'];
            var_dump($id_noticia);
            $titol_noticia = $_POST['titol_noticia'];
            var_dump($titol_noticia);
            $descripcio_noticia = $_POST['descripcio_noticia'];
            $data_noticia = $_POST['data_noticia'];
            $sql_update = "UPDATE NOTICIA SET titol_noticia='$titol_noticia',descripcio_noticia='$descripcio_noticia',data_noticia='$data_noticia' WHERE id_noticia=$id_noticia";
              if (mysqli_query($connection, $sql_update)) {
                  echo "<script>window.location.href='llistarNoticia.php';</script>";
                  echo "Okay";
              } else {
                  echo "Error updating record: " . mysqli_error($connection);
              }
            }

            /**Mètode per a eliminar una noticia*/
            public function eliminar_noticia($connection){
            $id_noticia = $_POST['id_noticia'];
            $sql_delete = "DELETE FROM NOTICIA WHERE id_noticia=$id_noticia";
            if (mysqli_query($connection, $sql_delete)) {
            echo "<script>window.location.href='llistarNoticia.php';</script>";
            echo "Okay";
            } else {
            echo "Error updating record: " . mysqli_error($connection);
            }
        }
        /**
        * Mètode que genera una pagina html amb la noticia
        */
            public function arxiu_noticia($connection){
            $id_noticia = strip_tags($_POST['id_noticia']);
            $titol_noticia = strip_tags($_POST['titol_noticia']);
            $descripcio_noticia = strip_tags($_POST['descripcio_noticia']);
            $data_noticia = strip_tags($_POST['data_noticia']);
            $nom_arxiu = 'noticia'.$titol_noticia.'.html';

            $contingut = "<!DOCTYPE html>
                                            <html lang='en'>
                                            <head>
                                              <title>Parc Atraccions Univeylandia</title>
                                              <link rel='icon' href='../../img/icon.png' type='image/gif'>
                                              <meta charset='utf-8'>
                                              <meta name='viewport' content='width=device-width, initial-scale=1'>
                                              <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
                                              <link rel='stylesheet' href='../../css/style.css'>
                                              <style>
                                              .fakeimg {
                                                  height: 200px;
                                                  background: #aaa;
                                              }
                                              </style>
                                            </head>
                                            <body>
                                              <nav class='navbar navbar-expand-sm py-0'>
                                                <div class='collapse navbar-collapse flex-row-reverse' id='collapsibleNavbar'>
                                                  <ul class='navbar-nav'>
                                                    <li class='nav-item dropdown'>
                                                      <a class='nav-link dropdown-toggle '  href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Idioma      </a>
                                                      <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                        <li><a class='dropdown-item' href='#'>ES</a></li>
                                                        <li><a class='dropdown-item' href='#'>CA</a></li>
                                                      </ul>
                                                    </li>
                                                    <li class='nav-item'>
                                                      <a class='nav-link' href='../img/mapa_parc.jpg'>Mapa</a>
                                                    </li>
                                                  <li>
                                                    <a class='nav-link' href='../login.php'>Login</a>
                                                  </li>
                                                  </ul>
                                                </div>
                                              </nav>

                                            <nav class='navbar navbar-expand-sm bg-dark navbar-dark py-4'>
                                              <a class='navbar-brand' href='../index.php'>UniveyLandia</a>
                                              <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
                                                <span class='navbar-toggler-icon'></span>
                                              </button>
                                              <div class='collapse navbar-collapse' id='collapsibleNavbar'>
                                                <ul class='navbar-nav'>
                                                  <li class='nav-item dropdown'>
                                                    <a class='nav-link dropdown-toggle '  href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Parc      </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                      <li><a class='dropdown-item' href='noticies_1.php'>Noticies</a></li>
                                                      <li><a class='dropdown-item' href='#'>Promocions</a></li>
                                                    </ul>
                                                  </li>
                                                  <li class='nav-item'>
                                                    <a class='nav-link' href='#'>Atraccions</a>
                                                  </li>
                                                  <li class='nav-item dropdown'>
                                                    <a class='nav-link dropdown-toggle '  href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Hotel      </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                      <li><a class='dropdown-item' href='#'>Habitacions</a></li>
                                                      <li><a class='dropdown-item' href='#'>Restaurants</a></li>
                                                    </ul>
                                                  </li>
                                                  <li class='nav-item dropdown'>
                                                    <a class='nav-link dropdown-toggle '  href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Entrades      </a>
                                                    <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                                      <li><a class='dropdown-item' href='#'>Parc</a></li>
                                                      <li><a class='dropdown-item' href='#'>Parc+Hotel</a></li>
                                                    </ul>
                                                  </li>

                                                </ul>
                                              </div>
                                            </nav>

                                            <!-- NOTICIES -->
                                            <div class='container' style='margin-top:30px'>
                                              <div class='row'>
                                                <div class='col-sm-12'>
                                                  <h1 class='font-weight-bold text-center text-uppercase'>$titol_noticia</h1>
                                                </div>
                                              </div>
                                              <div class='row' style='margin-top:25px'>
                                                <div class='col-sm-6'>
                                                  <p class='font-weight-bold text-center text-uppercase'>$descripcio_noticia</p>
                                                </div>
                                                <div class='col-sm-6'>
                                                  <img src='https://meencantamurcia.es/wp-content/uploads/2016/09/feria-de-murcia.jpg' class='rounded' alt='noticiesimg' width='400' height='400' >
                                                </div>
                                             </div>
                                             <div class='row' style='margin-top:20px'>
                                                <div class='col-sm-2'>
                                                  <p text-right text-uppercase'>$data_noticia</p>
                                                </div>
                                                <div class='col-sm-10'>
                                                </div>
                                             </div>
                                            </div>

                                            <!-- FI LOCALITZA -->

                                            <div class='jumbotron text-center' width='100%' style='margin-bottom:0'>
                                              <div class='row'>

                                                  <div class='col-sm-2'>
                                                    <h6>Univeylandia</h6>
                                                    <ul class='list-inline'>
                                                      <li><a href='#'>Sobre nosaltres</a></li>
                                                      <li><a href='#'>Reconeixements</a></li>
                                                      <li><a href='#'>Treballa amb nosaltres</a></li>
                                                      <li><a href='#'>Partners</a></li>
                                                      <li><a href='#'>Contacte</a></li>
                                                    </ul>
                                                  </div>

                                                  <div class='col-sm-2'>
                                                    <h6>Condicions</h6>
                                                    <ul class='list-inline'>
                                                      <li><a href='#'>Condicions generals</a></li>
                                                      <li><a href='#'>Política de privacitat</a></li>
                                                      <li><a href='#'>Normes del Resort</a></li>
                                                      <li><a href='#'>Politica de cookies</a></li>
                                                      <li><a href='#'>MAPA WEB</a></li>
                                                    </ul>
                                                  </div>

                                                  <div class='col-sm-2'>
                                                    <h6>Parc</h6>
                                                    <ul class='list-inline'>
                                                      <li><a href='#'>Atraccions</a></li>
                                                      <li><a href='#'>Hotel</a></li>
                                                      <li><a href='#'>Restaurants</a></li>
                                                    </ul>
                                                  </div>

                                                  <div class='col-sm-3'>
                                                    <h3>Trucans</h3>
                                                    <p>642 18 90 00</p>
                                                  </div>


                                                  <div class='col-sm-3'>
                                                    <h3>Segueix-nos</h3>
                                                    <a href='#'>
                                                    <img class='img_face' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjQuODI2LDBDMTEuMTM3LDAsMCwxMS4xMzcsMCwyNC44MjZjMCwxMy42ODgsMTEuMTM3LDI0LjgyNiwyNC44MjYsMjQuODI2YzEzLjY4OCwwLDI0LjgyNi0xMS4xMzgsMjQuODI2LTI0LjgyNiAgICBDNDkuNjUyLDExLjEzNywzOC41MTYsMCwyNC44MjYsMHogTTMxLDI1LjdoLTQuMDM5YzAsNi40NTMsMCwxNC4zOTYsMCwxNC4zOTZoLTUuOTg1YzAsMCwwLTcuODY2LDAtMTQuMzk2aC0yLjg0NXYtNS4wODhoMi44NDUgICAgdi0zLjI5MWMwLTIuMzU3LDEuMTItNi4wNCw2LjA0LTYuMDRsNC40MzUsMC4wMTd2NC45MzljMCwwLTIuNjk1LDAtMy4yMTksMGMtMC41MjQsMC0xLjI2OSwwLjI2Mi0xLjI2OSwxLjM4NnYyLjk5aDQuNTZMMzEsMjUuN3ogICAgIiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==' />
                                                    </a>
                                                    <a href='#'>
                                                      <img class='img_face' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjQuODI2LDBDMTEuMTM3LDAsMCwxMS4xMzcsMCwyNC44MjZjMCwxMy42ODgsMTEuMTM3LDI0LjgyNiwyNC44MjYsMjQuODI2YzEzLjY4OCwwLDI0LjgyNi0xMS4xMzgsMjQuODI2LTI0LjgyNiAgICBDNDkuNjUyLDExLjEzNywzOC41MTYsMCwyNC44MjYsMHogTTM1LjkwMSwxOS4xNDRjMC4wMTEsMC4yNDYsMC4wMTcsMC40OTQsMC4wMTcsMC43NDJjMCw3LjU1MS01Ljc0NiwxNi4yNTUtMTYuMjU5LDE2LjI1NSAgICBjLTMuMjI3LDAtNi4yMzEtMC45NDMtOC43NTktMi41NjVjMC40NDcsMC4wNTMsMC45MDIsMC4wOCwxLjM2MywwLjA4YzIuNjc4LDAsNS4xNDEtMC45MTQsNy4wOTctMi40NDYgICAgYy0yLjUtMC4wNDYtNC42MTEtMS42OTgtNS4zMzgtMy45NjljMC4zNDgsMC4wNjYsMC43MDcsMC4xMDMsMS4wNzQsMC4xMDNjMC41MjEsMCwxLjAyNy0wLjA2OCwxLjUwNi0wLjE5OSAgICBjLTIuNjE0LTAuNTI0LTQuNTgzLTIuODMzLTQuNTgzLTUuNjAzYzAtMC4wMjQsMC0wLjA0OSwwLjAwMS0wLjA3MmMwLjc3LDAuNDI3LDEuNjUxLDAuNjg1LDIuNTg3LDAuNzE0ICAgIGMtMS41MzItMS4wMjMtMi41NDEtMi43NzMtMi41NDEtNC43NTVjMC0xLjA0OCwwLjI4MS0yLjAzLDAuNzczLTIuODc0YzIuODE3LDMuNDU4LDcuMDI5LDUuNzMyLDExLjc3Nyw1Ljk3MiAgICBjLTAuMDk4LTAuNDE5LTAuMTQ3LTAuODU0LTAuMTQ3LTEuMzAzYzAtMy4xNTUsMi41NTgtNS43MTQsNS43MTMtNS43MTRjMS42NDQsMCwzLjEyNywwLjY5NCw0LjE3MSwxLjgwNCAgICBjMS4zMDMtMC4yNTYsMi41MjMtMC43MywzLjYzLTEuMzg3Yy0wLjQzLDEuMzM1LTEuMzMzLDIuNDU0LTIuNTE2LDMuMTYyYzEuMTU3LTAuMTM4LDIuMjYxLTAuNDQ0LDMuMjgyLTAuODk5ICAgIEMzNy45ODcsMTcuMzM0LDM3LjAxOCwxOC4zNDEsMzUuOTAxLDE5LjE0NHoiIGZpbGw9IiMwMDAwMDAiLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                                                    </a>

                                                    <a href='#'>
                                                    <img class='img_face' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTI0LjgyNSwyOS43OTZjMi43MzksMCw0Ljk3Mi0yLjIyOSw0Ljk3Mi00Ljk3YzAtMS4wODItMC4zNTQtMi4wODEtMC45NC0yLjg5N2MtMC45MDMtMS4yNTItMi4zNzEtMi4wNzMtNC4wMjktMi4wNzMgICAgIGMtMS42NTksMC0zLjEyNiwwLjgyLTQuMDMxLDIuMDcyYy0wLjU4OCwwLjgxNi0wLjkzOSwxLjgxNS0wLjk0LDIuODk3QzE5Ljg1NCwyNy41NjYsMjIuMDg1LDI5Ljc5NiwyNC44MjUsMjkuNzk2eiIgZmlsbD0iIzAwMDAwMCIvPgoJCQk8cG9seWdvbiBwb2ludHM9IjM1LjY3OCwxOC43NDYgMzUuNjc4LDE0LjU4IDM1LjY3OCwxMy45NiAzNS4wNTUsMTMuOTYyIDMwLjg5MSwxMy45NzUgMzAuOTA3LDE4Ljc2MiAgICAiIGZpbGw9IiMwMDAwMDAiLz4KCQkJPHBhdGggZD0iTTI0LjgyNiwwQzExLjEzNywwLDAsMTEuMTM3LDAsMjQuODI2YzAsMTMuNjg4LDExLjEzNywyNC44MjYsMjQuODI2LDI0LjgyNmMxMy42ODgsMCwyNC44MjYtMTEuMTM4LDI0LjgyNi0yNC44MjYgICAgIEM0OS42NTIsMTEuMTM3LDM4LjUxNiwwLDI0LjgyNiwweiBNMzguOTQ1LDIxLjkyOXYxMS41NmMwLDMuMDExLTIuNDQ4LDUuNDU4LTUuNDU3LDUuNDU4SDE2LjE2NCAgICAgYy0zLjAxLDAtNS40NTctMi40NDctNS40NTctNS40NTh2LTExLjU2di01Ljc2NGMwLTMuMDEsMi40NDctNS40NTcsNS40NTctNS40NTdoMTcuMzIzYzMuMDEsMCw1LjQ1OCwyLjQ0Nyw1LjQ1OCw1LjQ1N1YyMS45Mjl6IiBmaWxsPSIjMDAwMDAwIi8+CgkJCTxwYXRoIGQ9Ik0zMi41NDksMjQuODI2YzAsNC4yNTctMy40NjQsNy43MjMtNy43MjMsNy43MjNjLTQuMjU5LDAtNy43MjItMy40NjYtNy43MjItNy43MjNjMC0xLjAyNCwwLjIwNC0yLjAwMywwLjU2OC0yLjg5NyAgICAgaC00LjIxNXYxMS41NmMwLDEuNDk0LDEuMjEzLDIuNzA0LDIuNzA2LDIuNzA0aDE3LjMyM2MxLjQ5MSwwLDIuNzA2LTEuMjEsMi43MDYtMi43MDR2LTExLjU2aC00LjIxNyAgICAgQzMyLjM0MiwyMi44MjMsMzIuNTQ5LDIzLjgwMiwzMi41NDksMjQuODI2eiIgZmlsbD0iIzAwMDAwMCIvPgoJCTwvZz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                                                    </a>
                                                  </div>

                                              </div>
                                            </div>
                                              <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                                              <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
                                              <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
                                            </body>
                                            </html>
                                            ";

            file_put_contents($nom_arxiu, $contingut );
            }

      }
    ?>
