<?php 

	class Ubicacion extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

        public function getSelectDepartamento()
        {
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione un departamento</option> ';
            $arrData = $this->model->selectDepartamento();
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {                                                
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_depart'] . '">' . $arrData[$i]['nomb_depart'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectProvincia()
        {
            $iddep = $_POST['idDepartamento'];
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione una provincia</option> ';                                  
            $arrData = $this->model->selectProvincia($iddep);
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {      
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_provincia'] . '">' . $arrData[$i]['nomb_provincia'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectDistrito()
        {
            $idprovi = $_POST['idProvincia'];
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione un distrito</option> ';                                  
            $arrData = $this->model->selectDistrito($idprovi);
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {      
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_distrito'] . '">' . $arrData[$i]['nomb_distrito'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectBaseRondera()
        {
            $iddistri = $_POST['idDistrito'];
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione una base rondera</option> ';                                  
            $arrData = $this->model->selectBaseRondera($iddistri);
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {      
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_base'] . '">' . $arrData[$i]['nomb_base'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

	}
 ?>