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

		public function selectDistrito($idprovi)
		{        			
			$sql = "SELECT * FROM distrito WHERE id_provi = $idprovi";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectProvincia($iddep)
		{
			$sql = "SELECT * FROM provincia WHERE id_depart = $iddep";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectBaseRondera($idDistrito)
		{
			$sql = "SELECT * FROM baserondera WHERE id_distrito = $idDistrito";
			$request = $this->select_all($sql);
			return $request;
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