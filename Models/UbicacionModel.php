<?php 

	class UbicacionModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function selectDepartamento()
		{			
			$sql = "SELECT * FROM departamento";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectDistrito()
		{        			
			$sql = "SELECT * FROM distrito";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectProvincia()
		{
			$sql = "SELECT * FROM provincia";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectBaseRondera()
		{
			$sql = "SELECT * FROM baserondera";
			$request = $this->select_all($sql);
			return $request;
		}

	}
 ?>