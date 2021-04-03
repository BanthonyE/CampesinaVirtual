<?php 

	class UbicacionModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function selectListaDepartamento()
		{			
			$sql = "SELECT * FROM departamento";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectListaDistrito()
		{        			
			$sql = "SELECT * FROM distrito";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectListaProvincia()
		{
			$sql = "SELECT * FROM provincia";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectListaBaseRondera()
		{
			$sql = "SELECT * FROM baserondera";
			$request = $this->select_all($sql);
			return $request;
		}

	}
 ?>