<?php

class Usuarios extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		session_regenerate_id(true);
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
		getPermisos(2);
	}

	public function Usuarios()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Usuarios";
		$data['page_title'] = "USUARIOS <small>Registro</small>";
		$data['page_name'] = "usuarios";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "usuarios", $data);
	}

		public function setUsuario(){
			if($_POST){			
				/* if (empty($_POST['txtPassword']) ||empty($_POST['txtRepeatPassword']) ||empty($_POST['txtDireccion']) ||empty($_POST['listBaseRondera']) ||empty($_POST['listDistrito']) ||empty($_POST['listProvincia']) ||empty($_POST['listDepartamento']) || empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['listRolid']) || empty($_POST['listStatus'])) */
				/* if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) ) */
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
				{
					/* $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.'); */
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'Ingrese los datos correctamente';
				} elseif ($_POST['txtRepeatPassword'] != $_POST['txtPassword']) {
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'Las claves no coinciden';
				} elseif (strlen(strClean($_POST['txtIdentificacion']))!=8) {
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'El campo de identificación debe tener 8 dígitos';
				} elseif (strlen(strClean($_POST['txtTelefono']))!=9) {
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'El campo del teléfono debe tener 9 dígitos';
				} else {
					$idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = ucwords(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intStatus = intval(strClean($_POST['listStatus']));
					$request_user = "";
					$request_carnet = "";

					$txtDireccion = ucwords(strClean($_POST['txtDireccion']));
					$listBaseRondera = intval(strClean($_POST['listBaseRondera']));

					if (!empty($_FILES['filedImagen']['name'])) {
						$nombre_foto = $_FILES['filedImagen']['name'];
						$size_foto = $_FILES['filedImagen']['size'];
						$tipo_foto = $_FILES['filedImagen']['type'];
						$temp_foto = $_FILES['filedImagen']['tmp_name'];
						$ruta = "Assets/images/fotos". "/" . $nombre_foto;
						move_uploaded_file($temp_foto, $ruta);
					}else{
						$nombre_foto = "avatar.jpg";
					}

				$this->model->createCarnet($strIdentificacion);
				if ($idUsuario == 0) {
					$option = 1;
					$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);

					if ($_SESSION['permisosMod']['w']) {
						$request_user = $this->model->insertUsuario(
							$strIdentificacion,
							$strNombre,
							$strApellido,
							$intTelefono,
							$strEmail,
							$strPassword,
							$intTipoId,
							$intStatus,
							$txtDireccion,
							$listBaseRondera,
							$nombre_foto
						);
					}
				} else {
					$option = 2;
					$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
					if ($_SESSION['permisosMod']['u']) {
						$request_user = $this->model->updateUsuario(
							$idUsuario,
							$strIdentificacion,
							$strNombre,
							$strApellido,
							$intTelefono,
							$strEmail,
							$strPassword,
							$intTipoId,
							$intStatus,
							$txtDireccion,
							$listBaseRondera,
							$nombre_foto
						);
					}
				}

				if ($request_user > 0) {
					if ($option == 1) {
						/* $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamentecc.'); */
						$arrResponse['status'] = true;
						$arrResponse['msg'] = 'Datos guardados correctamente.';
					} else {
						/* $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.'); */
						$arrResponse['status'] = true;
						$arrResponse['msg'] = 'Datos Actualizados correctamente..A.';
					}
				} else if ($request_user == 'exist') {
					/* $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.'); */
					$arrResponse['status'] = false;
					$arrResponse['msg'] = '¡Atención! el email o la identificación ya existe, ingrese otro.';
				} else {
					/* $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.'); */
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'No es posible almacenar los datos.';
				}
			}
			/* echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); */
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($arrResponse);
		}
		die();
	}

	public function getUsuarios()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectUsuarios();
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idpersona'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					}else{
						$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if($_SESSION['permisosMod']['d']){
					if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
						($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'] )
						 ){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
					}else{
						$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
					}
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUsuario($idpersona){
		if($_SESSION['permisosMod']['r']){
			$idusuario = intval($idpersona);
			if($idusuario > 0)
			{
				$arrData = $this->model->selectUsuario($idusuario);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delUsuario()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intIdpersona = intval($_POST['idUsuario']);
				$requestDelete = $this->model->deleteUsuario($intIdpersona);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function perfil()
	{
		$data['page_tag'] = "Perfil";
		$data['page_title'] = "Perfil de usuario";
		$data['page_name'] = "perfil";
		$data['page_functions_js'] = "functions_usuarios.js";
		$this->views->getView($this, "perfil", $data);
	}

	public function putPerfil()
	{
		if ($_POST) {
			if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono'])) {
				/* $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.'); */
				$arrResponse['status'] = false;
				$arrResponse['msg'] = 'Datos incorrectos.';

			} else {
				$idUsuario = $_SESSION['idUser'];
				$strIdentificacion = strClean($_POST['txtIdentificacion']);
				$strNombre = strClean($_POST['txtNombre']);
				$strApellido = strClean($_POST['txtApellido']);
				$intTelefono = intval(strClean($_POST['txtTelefono']));

				$nombre_foto = "";
				if (!empty($_FILES['filedImagen']['name'])) {
					$nombre_foto = $_FILES['filedImagen']['name'];
					$size_foto = $_FILES['filedImagen']['size'];
					$tipo_foto = $_FILES['filedImagen']['type'];
					$temp_foto = $_FILES['filedImagen']['tmp_name'];
					$ruta = "Assets/images/fotos". "/" . $nombre_foto;
					move_uploaded_file($temp_foto, $ruta);
				}

				$strPassword = "";
				if (!empty($_POST['txtPassword'])) {
					$strPassword = hash("SHA256", $_POST['txtPassword']);
				}
				$request_user = $this->model->updatePerfil(
					$idUsuario,
					$strIdentificacion,
					$strNombre,
					$strApellido,
					$intTelefono,
					$strPassword,
					$nombre_foto
				);
				if ($request_user) {
					sessionUser($_SESSION['idUser']);
					/* $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.'); */
					$arrResponse['status'] = true;
					$arrResponse['msg'] = 'Datos Actualizados correctamente.';
				} else {
					/* $arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.'); */
					$arrResponse['status'] = false;
					$arrResponse['msg'] = 'No es posible actualizar los datos.';
				}
			}
			/* echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); */
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($arrResponse);
		}
		die();
	}

	public function putDFical()
	{
		if ($_POST) {
			if (empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = $_SESSION['idUser'];
				$strNit = strClean($_POST['txtNit']);
				$strNomFiscal = strClean($_POST['txtNombreFiscal']);
				$strDirFiscal = strClean($_POST['txtDirFiscal']);
				$request_datafiscal = $this->model->updateDataFiscal(
					$idUsuario,
					$strNit,
					$strNomFiscal,
					$strDirFiscal
				);
				if ($request_datafiscal) {
					sessionUser($_SESSION['idUser']);
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.C.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
