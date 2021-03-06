<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $strNit;
		private $strNomFiscal;
		private $strDirFiscal;

		private $strNombFoto;
		private $intBaseComunera;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status, string $direccion, int $base_comunera, string $foto){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;

			$this->strDirFiscal = $direccion;
			$this->intBaseComunera = $base_comunera;
			$this->strNombFoto = $foto;

			$return = 0;
			if($this->strEmail=="-" || $this->strEmail=="0" || $this->strEmail==0){
				$sql = "SELECT * FROM persona WHERE 
				identificacion = '{$this->strIdentificacion}' ";
				$request = $this->select_all($sql);
			}else{				
				$sql = "SELECT * FROM persona WHERE 
						email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
				$request = $this->select_all($sql);
			}

			if(empty($request))
			{
				$query_insert  = "INSERT INTO persona(identificacion,nombres,apellidos,telefono,email_user,password,rolid,status,direccionfiscal,idbase,nombre_foto) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus,
								$this->strDirFiscal,
								$this->intBaseComunera,
								$this->strNombFoto);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function createCarnet(string $identificacion_carnet){

			$fecha_e = date("Y-m-d h:i:s");

			$fecha_c = date("d-m-Y",strtotime($fecha_e."+ 2 year"));


			$query_insert_carnet  = "INSERT INTO carnet(fecha_emi,fecha_cadu,identificacion_persona) 
			VALUES(?,?,?)";
			$arrData_carnet = array($fecha_e,
			$fecha_c,
			$identificacion_carnet);

			$this->insert($query_insert_carnet,$arrData_carnet);	
		}

		public function selectUsuarios()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idpersona != 1 ";
			}
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,r.idrol,r.nombrerol 
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectUsuario(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.idpersona,p.idbase,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro,
							c.descrip, br.id_base, dis.id_distrito, pr.id_provincia, dep.id_depart
					FROM persona p
					INNER JOIN rol r
					ON p.rolid = r.idrol				
					INNER JOIN cargo c 
					ON r.idcargo=c.idcargo
					INNER JOIN baserondera br 
					ON br.id_base=p.idbase
					INNER JOIN distrito dis 
					ON dis.id_distrito=br.id_distrito
					INNER JOIN provincia pr 
					ON pr.id_provincia=dis.id_provi
					INNER JOIN departamento dep
					ON dep.id_depart=pr.id_depart
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status, string $direccion, int $base_comunera, string $foto){

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;

			$this->strDirFiscal = $direccion;
			$this->intBaseComunera = $base_comunera;
			$this->strNombFoto = $foto;

			$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
										  OR (identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, rolid=?, status=?,direccionfiscal=?,idbase=?,nombre_foto=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus,
									$this->strDirFiscal,
									$this->intBaseComunera,
									$this->strNombFoto);
				}else{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, rolid=?, status=?,direccionfiscal=?,idbase=?,nombre_foto=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intTipoId,
	        						$this->intStatus,
									$this->strDirFiscal,
									$this->intBaseComunera,
									$this->strNombFoto);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password, string $foto){
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			$this->strNombFoto = $foto;

			if($this->strPassword != "")
			{
				if($this->strNombFoto != ""){
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, password=?, nombre_foto=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
									$this->strNombre,
									$this->strApellido,
									$this->intTelefono,
									$this->strPassword,
									$this->strNombFoto);
				}else{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, password=?,  
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
									$this->strNombre,
									$this->strApellido,
									$this->intTelefono,
									$this->strPassword);					
				}
			}else{
				if($this->strNombFoto != ""){
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=?, telefono=?,nombre_foto=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
									$this->strNombre,
									$this->strApellido,
									$this->intTelefono,
									$this->strNombFoto);
				}else{
					$sql = "UPDATE persona SET identificacion=?, nombres=?, apellidos=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
									$this->strNombre,
									$this->strApellido);					
				}
			}
			$request = $this->update($sql,$arrData);
		    return $request;
		}

		public function updateDataFiscal(int $idUsuario, string $strNit, string $strNomFiscal, string $strDirFiscal){
			$this->intIdUsuario = $idUsuario;
			$this->strNit = $strNit;
			$this->strNomFiscal = $strNomFiscal;
			$this->strDirFiscal = $strDirFiscal;
			$sql = "UPDATE persona SET nit=?, nombrefiscal=?, direccionfiscal=? 
						WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strNit,
							$this->strNomFiscal,
							$this->strDirFiscal);
			$request = $this->update($sql,$arrData);
		    return $request;
		}

	}
 ?>