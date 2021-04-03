<?php 

	class Ubicacion extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

        public function getListaDepartamento()
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

        public function getListaProvincia()
        {
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione una provincia</option> ';                                  
            $arrData = $this->model->selectProvincia();
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {      
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_provincia'] . '">' . $arrData[$i]['nomb_provincia'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

        public function getListatDistrito()
        {
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione un distrito</option> ';                                  
            $arrData = $this->model->selectDistrito();
            if (count($arrData) > 0) {
                for ($i = 0; $i < count($arrData); $i++) {      
                    $htmlOptions .= '<option value="' . $arrData[$i]['id_distrito'] . '">' . $arrData[$i]['nomb_distrito'] . '</option>';
                } 
            }
            echo $htmlOptions;
            die();
        }

        public function getListaBaseRondera()
        {
            $htmlOptions = "";
            $htmlOptions .= '<option class="placeholder" selected disabled value="">Seleccione una base rondera</option> ';                                  
            $arrData = $this->model->selectBaseRondera();
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