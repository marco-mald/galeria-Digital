<?php
    include_once 'db.php';
    class Galeria extends DB{    
        private $paginaActual;//Pagina Actual
        private $totalPaginas;//Total de paginas
        private $nResultados;
        private $resultadosPorPag; //Resultados por pagina
        private $indice; //Posicion de la tabla
        private $error = false;
        private $id;

        function __construct($nPorPagina,$id_evento){//Numero de resultados por pagina
            parent::__construct();
            $this->resultadosPorPag = $nPorPagina;
            $this->indice = 0;
            $this->paginaActual = 1;
            $this->calcularPaginas($id_evento);
        }

        function calcularPaginas($id_evento){
            
            $query = $this->connect()->query('SELECT COUNT(*) AS total FROM imagen where id_evento = '.$id_evento); //Total de imagenes
            //Objeto con el valor de la columna, numero de resultados totales
            $this->nResultados = $query->fetch(PDO::FETCH_OBJ)->total;
            $this->totalPaginas = $this->nResultados / $this->resultadosPorPag;

    
            if(isset($_GET['pagina'])){
                //validar que  pagina sea un numero
                if(is_numeric($_GET['pagina'])){
                    //validar que se mayor o igual 1 o menor o igual a total de paginas
                    if($_GET['pagina'] >= 1 && $_GET['pagina'] <= $this->totalPaginas){
                        $this->paginaActual = $_GET['pagina'];
                        $this->indice = ($this->paginaActual - 1) * ($this->resultadosPorPag);
                    }
                    else{
                        echo "No existe esa pagina";
                        $this->error = true;
                    }
                
                }else{
                    //confirmar error
                    echo "Error al mostrar la pagina";
                    $this->error = true;
                }
                
            }
        }
        function mostrarImagenes($id_evento){
            if(!$this->error){
                //continuar
                $query = $this->connect()->prepare('SELECT*FROM imagen where id_evento = '.$id_evento.' LIMIT :pos, :n');
                $query->execute(['pos'=> $this->indice,'n'=> $this->resultadosPorPag]);

                
                foreach($query as $imagen){
                    include 'vista.php';
                }
            }else{

            }
        }
        function mostrarPaginas(){
            $actual = '';
            echo "<ul>";
                for($i=0; $i <= $this->totalPaginas - 1;$i++){
                    if($i + 1 == $this->paginaActual){
                        $actual = 'class="actual" ';
                    }
                    else{$actual = '';
                    }
                   echo '<li><a ' .$actual . 'href="?pagina='. ($i + 1) .'" onclick="link()" >' . ($i + 1) . '</a></li>'; 
                }
            echo "</ul>";
        }

    }

?>
