<?php

class subirstockController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (isset($_SESSION['usuario'])) {

			$this->_view->setCss_Specific(
				array(
					'dist/css/fontawesome/css/all',
					'dist/css/vendors.min',
					// 'dist/css/extensions/toastr.min',
					// 'dist/css/forms/bs-stepper.min',
					'plugins/vendors/css/extensions/sweetalert2.min',
					'dist/css/bootstrap',
					'dist/css/bootstrap-extended',
					'dist/css/colors',
					'dist/css/components',
					'dist/css/core/menu/menu-types/vertical-menu',
					'dist/css/plugins/forms/form-validation',
					// 'dist/css/plugins/extensions/ext-component-toastr',
					'dist/css/custom',
					'dist/css/style',
					'plugins/vendors/css/extensions/ext-component-sweet-alerts',
					// 'plugins/vendors/css/pickers/flatpickr/flatpickr.min',
					//data tables
					'plugins/datatables-net/css/jquery.dataTables.min',
					//'plugins/datatables-net/css/searchPanes.dataTables.min',
					//'plugins/datatables-net/select.dataTables.min',
					'plugins/datatables-net/css/buttons.dataTables.min',
					'plugins/datatables-net/css/responsive.dataTables.min',
					//
					'plugins/vendors/css/pickers/pickadate/pickadate',
					'plugins/vendors/css/pickers/flatpickr/flatpickr.min',
					'plugins/vendors/css/pickers/form-flat-pickr',
					'plugins/vendors/css/pickers/form-pickadate',
				)
			);

			$this->_view->setJs_Specific(
				array(
					'plugins/vendors/js/vendors.min',
					'plugins/vendors/js/extensions/toastr.min',
					'plugins/vendors/js/forms/select/select2.full.min',
					'plugins/vendors/js/forms/validation/jquery.validate.min',
					'dist/js/core/app-menu',
					'dist/js/core/app',
					'dist/js/scripts/forms/form-wizard',
					//data tables
					'plugins/datatables-net/js/jquery.dataTables.min',
					'plugins/datatables-net/js/dataTables.responsive.min',
					//sweetalert
					'plugins/vendors/js/extensions/sweetalert2.all.min',
					// 'dist/js/scripts/pages/app-calendar-events',
					// 'dist/js/scripts/pages/app-calendar',
					//picker
					'plugins/vendors/js/pickers/pickadate/picker',
					'plugins/vendors/js/pickers/pickadate/picker.date',
					'plugins/vendors/js/pickers/pickadate/picker.time',
					'plugins/vendors/js/pickers/pickadate/legacy',
					'plugins/vendors/js/pickers/flatpickr/flatpickr.min',
					'dist/js/scripts/forms/pickers/form-pickers',
					// imput mask
					'dist/js/scripts/forms/form-input-mask',
					'plugins/vendors/js/forms/cleave/cleave.min'
				)
			);

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);
			$soap = new SoapClient($wsdl, $options);

			$param = array(
				"ruc" => $_SESSION['ruc'], //ruc asignado al personal
				"user" => $_SESSION['id'], //id del usuario
			);

			$result = $soap->ConsultarStockRuc($param);
			$stockruc = json_decode($result->ConsultarStockRucResult, true);

			$this->_view->stockruc = $stockruc;

			$this->_view->setJs(array('index'));
			$this->_view->renderizar('index');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function cargar_datos() //ok
	{
		if (isset($_SESSION['usuario'])) {

			putenv("NLS_LANG=SPANISH_SPAIN.AL32UTF8");
			putenv("NLS_CHARACTERSET=AL32UTF8");

			$this->getLibrary('json_php/JSON');
			$json = new Services_JSON();

			$dia = date("Ymd"); //brindar formato
			$timezone = -5;
			$dia2 = gmdate("Y-m-d H:i:s", time() + 3600 * ($timezone + date("I")));
			$fconcat = date("YmdHis", time()); //formato año+hora, indice para registro de archivo
			// $fecha = $_POST['fecha'];

			if (!empty($_SESSION['ruc']) || $_SESSION['id'] == 1) {

				$nombrearchivo = $_FILES["documento"]["name"];
				// $fechaext = explode("_",$_FILES["documento"]["name"]); //2022-02-10.xlsx
				// $solfecha = explode(".",$fechaext[1]);

				// if ($solfecha[0] == $fecha){

				if (is_array($_FILES) && count($_FILES) > 0) {

					// CONSULTAMOS A LA BASE DE DATOS, SI EL TIPO DE ARCHIVO A SUBIR ES PERMITIDO
					$extdoc = explode("/", $_FILES["documento"]["type"]);

					$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

					$options = array(
						"uri" => $wsdl,
						"style" => SOAP_RPC,
						"use" => SOAP_ENCODED,
						"soap_version" => SOAP_1_1,
						"connection_timeout" => 60,
						"trace" => false,
						"encoding" => "UTF-8",
						"exceptions" => false,
					);
					$soap = new SoapClient($wsdl, $options);

					$params = array(
						"modulo"	=> 'subirarchivo', // 
						"mime"		=> $extdoc[0], // image / application --> mime clasificado por php
						"type"		=> $extdoc[1], // jpeg / pdf / msword --> tipo de archivo clasificado por php input file
					);

					$result = $soap->ConsultaTipoArchivo($params);
					$tipoarchivo = json_decode($result->ConsultaTipoArchivoResult, true);

					if ($extdoc[0] == $tipoarchivo[0]['v_mime'] && $extdoc[1] == $tipoarchivo[0]['v_type']) {

						// $extension = $_FILES['documento']['type']; //extensión del archivo
						// $destino = "temp/".$_SESSION['ruc']."_".$fecha."_".$extension;
						// $destino = "temp/".$_SESSION['ruc']."_".$fecha.".".$solfecha[1];
						// $destino = "temp/".$_SESSION['ruc']."_".$fecha.".".$tipoarchivo[0]["v_archivo"]; // este es con fecha
						$destino = "temp/" . $_SESSION['ruc'] . "_" . $dia . "." . $tipoarchivo[0]["v_archivo"]; // este es con fecha
						// $destino = "temp/".$_SESSION['ruc'].".".$tipoarchivo[0]["v_archivo"];

						if (copy($_FILES['documento']['tmp_name'], $destino)) { //temp\20105367407_2022-02-10.xlsx

							if (file_exists($destino)) {

								$this->getLibrary('PHPExcel/PHPExcel');

								$inputFileType = PHPExcel_IOFactory::identify($destino);
								$objReader = PHPExcel_IOFactory::createReader($inputFileType);
								$objPHPExcel = $objReader->load($destino);

								$sheet = $objPHPExcel->getSheet(0);
								$cantidadfilas = $sheet->getHighestRow();
								$ultimacolumna = $sheet->getHighestColumn();

								if ($ultimacolumna == 'G') {

									for ($i = 2; $i <= $cantidadfilas; $i++) {

										$_DATOS_EXCEL[$i]['fecha'] 			= $sheet->getCell("A" . $i)->getValue();
										$_DATOS_EXCEL[$i]['ruc'] 			= $sheet->getCell("B" . $i)->getValue();
										$_DATOS_EXCEL[$i]['razon'] 			= $sheet->getCell("C" . $i)->getValue();
										$_DATOS_EXCEL[$i]['sku'] 			= $sheet->getCell("D" . $i)->getValue();
										$_DATOS_EXCEL[$i]['producto'] 		= $sheet->getCell("E" . $i)->getValue();
										$_DATOS_EXCEL[$i]['kilos']			= $sheet->getCell("F" . $i)->getValue();
										$_DATOS_EXCEL[$i]['cantidad']		= $sheet->getCell("G" . $i)->getValue();

										// $_DATOS_EXCEL[$i]['razon'] 			= $sheet->getCell("C".$i)->getValue();
										if (empty($sheet->getCell("C" . $i)->getValue()) || ($sheet->getCell("C" . $i)->getValue() == "")) {
											$_DATOS_EXCEL[$i]['razon'] = "AAA";
										} else {
											$_DATOS_EXCEL[$i]['razon'] = $sheet->getCell("C" . $i)->getValue();
										}

										// $_DATOS_EXCEL[$i]['kilos']			= $sheet->getCell("M".$i)->getValue();
										if (empty($sheet->getCell("F" . $i)->getValue()) || ($sheet->getCell("F" . $i)->getValue() == "")) {
											$_DATOS_EXCEL[$i]['kilos'] = "0";
										} else {
											$_DATOS_EXCEL[$i]['kilos'] = $sheet->getCell("F" . $i)->getValue();
										}

										// $_DATOS_EXCEL[$i]['cantidad']		= $sheet->getCell("N".$i)->getValue();
										if (empty($sheet->getCell("G" . $i)->getValue()) || ($sheet->getCell("G" . $i)->getValue() == "")) {
											$_DATOS_EXCEL[$i]['cantidad'] = "0";
										} else {
											$_DATOS_EXCEL[$i]['cantidad'] = $sheet->getCell("G" . $i)->getValue();
										}
									}

									unlink($destino);

									$soap = new SoapClient($wsdl, $options);

									$j = 0;
									$k = 0;
									foreach ($_DATOS_EXCEL as $campo) {

										if (
											$campo['kilos'] == '0' &&
											$campo['cantidad'] == '0'
										) {
											$j++;
										} else {

											$param = array(
												"post"			=> 1,
												"ruc"			=> $campo['ruc'],
												"razon"			=> $campo['razon'],
												// "fecha"			=> date("Y-m-d",$campo['fecha']),
												"fecha"			=> $campo['fecha'],
												"iproducto"		=> $campo['sku'],
												"vproducto"		=> $campo['producto'],
												"kilos"			=> $campo['kilos'],
												"cantidad"		=> $campo['cantidad'],
												"archivo"		=> $fconcat . '_' . $nombrearchivo,
												"registro"		=> $dia2,
												"user"			=> $_SESSION['id']
											);

											$result = $soap->MantenimientoStock($param);
											// $mantStock = json_decode($result->MantenimientoStockResult, true);
											$k++;
										}
									}

									header('Content-type: application/json; charset=utf-8');
									echo $json->encode(
										array(
											// "dato"		 	=> "carga correcta ".$cantidadfilas,
											// "count"		 	=> $j.' - '.$k,
											"vicon"		 	=> "success",
											"vtitle" 		=> "Carga de archivo",
											"vtext" 		=> "Se cargaron " . $k . " filas correctamente, se recargar la página para actualizar sus registros",
											"itimer" 		=> 2000,
											"icase" 		=> 1,
											"vprogressbar" 	=> true,
										)
									);
								} else {
									//Archivo no contiene el formato correcto.
									header('Content-type: application/json; charset=utf-8');
									echo $json->encode(
										array(
											// "dato" 		=> "error6 - Archivo no contiene el formato correcto",
											"vicon" 		=> "error",
											"vtitle" 		=> "Archivo no contiene las columnas correctas, favor de descargar el formato de guia para comparar...",
											"vtext" 		=> "No se pudo cargar el archivo!",
											"itimer" 		=> 3000,
											"icase" 		=> 2, //"archivo no se pudo guardar em ruta destino";
											"vprogressbar" 	=> true
										)
									);
								}
							} else {
								//Archivo no encontrado en la ruta para cargar
								header('Content-type: application/json; charset=utf-8');
								echo $json->encode(
									array(
										// "dato" => "error5 - Archivo no encontrado en la ruta para cargar"
										"vicon" 		=> "error",
										"vtitle" 		=> "Archivo no existe en la carpeta para cargar...",
										"vtext" 		=> "No se pudo cargar el archivo!",
										"itimer" 		=> 3000,
										"icase" 		=> 3, //"archivo no se pudo guardar em ruta destino";
										"vprogressbar" 	=> true
									)
								);
							}
						} else {
							//Error al copiar el archivo a la carpeta temp
							header('Content-type: application/json; charset=utf-8');
							echo $json->encode(
								array(
									// "dato" => "erro4 - Error al copiar el archivo a la carpeta temp"
									"vicon" 		=> "error",
									"vtitle" 		=> "No se encontro carpeta de destino para guardar el archivo a cargar...",
									"vtext" 		=> "No se pudo cargar el archivo!",
									"itimer" 		=> 3000,
									"icase" 		=> 4, //"archivo no se pudo guardar em ruta destino";
									"vprogressbar" 	=> true
								)
							);
						}
					} else {
						//Archivo no permitidos en el sistema
						header('Content-type: application/json; charset=utf-8');
						echo $json->encode(
							array(
								// "dato" => "error3 - Archivo no permitidos en el sistema"
								"vicon" 		=> "error",
								"vtitle" 		=> "Tipo de archivo no permitido para cargarlo en el sistema...",
								"vtext" 		=> "No se pudo cargar el archivo!",
								"itimer" 		=> 3000,
								"icase" 		=> 5, //"archivo no se pudo guardar em ruta destino";
								"vprogressbar" 	=> true
							)
						);
					}
				} else {
					//Archivo de origen no existe, error al cargar archivo al sistema
					header('Content-type: application/json; charset=utf-8');
					echo $json->encode(
						array(
							// "dato" => "error2 - Archivo de origen no existe, error al cargar archivo al sistema"
							"vicon" 		=> "error",
							"vtitle" 		=> "Archivo de ruta de origen no se puedo copiar, verifique si el documento existe en la carpeta de origen...",
							"vtext" 		=> "No se pudo cargar el archivo!",
							"itimer" 		=> 3000,
							"icase" 		=> 6, //"archivo no se pudo guardar em ruta destino";
							"vprogressbar" 	=> true
						)
					);
				}

				// } else {
				// 	//No se puede cargar, fecha seleccionada no es igual a la fecha de archivo de carga
				// 	header('Content-type: application/json; charset=utf-8');
				// 	echo $json->encode(
				// 		array(
				// 			"dato" => "error1 - No se puede cargar, fecha seleccionada no es igual a la fecha de archivo de carga" //"error"
				// 			)
				// 	);
				// }

			} else {
				//No se puede cargar, usuario no esta asignado a ningun proveedor
				header('Content-type: application/json; charset=utf-8');
				echo $json->encode(
					array(
						// "dato" => "error - No se puede cargar, usuario no esta asignado a ningun proveedor"
						"vicon" 		=> "error",
						"vtitle" 		=> "Usuario no esta asignado a ningun proveedor, no puede cargar archivos...",
						"vtext" 		=> "No se pudo cargar el archivo!",
						"itimer" 		=> 3000,
						"icase" 		=> 7, //"archivo no se pudo guardar em ruta destino";
						"vprogressbar" 	=> true
					)
				);
			}
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function descargar_formato()
	{
		if (isset($_SESSION['usuario'])) {

			$this->getLibrary('PHPExcel/PHPExcel');

			// Crea un nuevo objeto PHPExcel
			$objPHPExcel = new PHPExcel();

			// Establecer propiedades
			$objPHPExcel->getProperties()
				->setCreator("Joseph Magallanes")
				->setLastModifiedBy("Portal web Distribuidores")
				->setTitle("Formato ditribuidores ventas")
				->setSubject("Formato ditribuidores ventas")
				->setDescription("Formato para importacion de datos al portaldistribuidor")
				->setKeywords("Excel Office 2007 openxml")
				->setCategory("Formatos");

			//titulos del reporte y datos donde va cada informacion
			$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($boldArray);

			// COLOCAR MARCO A LAS CELDAS
			$rango = 'A1:G1';
			$styleArray = array(
				'font' => array('name' => 'Arial', 'size' => 9),
				'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '#FFFFFF')))
			);
			$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'FECHA');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'RUC_DISTRIBUIDOR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'NOMBRE_DISTRIBUIDOR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'CODIGO_PRODUCTO');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'NOMBRE_PRODUCTO');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'KILOS');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'CANTIDAD');

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '28/02/2022');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '20000451281');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'NOMBRE DISTRIBUIDOR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', 'SKU0001');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'ALTOMAYO CAFE INSTANTANEO GOURMET 50GR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '50 GR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '1 UND');

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '28/02/2022');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '20000451281');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'NOMBRE DISTRIBUIDOR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'SKU0002');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'ALTOMAYO CAFE INSTANTANEO GOURMET 25GR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '25 GR');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '1 UND');

			$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 2)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 3)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);

			$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 2)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 3)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);

			// Renombrar Hoja
			$objPHPExcel->getActiveSheet()->setTitle('distribuidor_inventario');

			// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
			$objPHPExcel->setActiveSheetIndex(0);

			// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="distribuidor_inventario.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		} else {
			$this->redireccionar('index/logout');
		}
	}

	public function descargar_archivo()
	{
		if (isset($_SESSION['usuario'])) {

			$archivo = $_GET['archivo'];
			$ruc = $_GET['ruc'];

			function html_caracteres($string)
			{
				$string = str_replace(
					array('&amp;', '&Ntilde;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;'),
					array('&', 'Ñ', 'Á', 'É', 'Í', 'Ó', 'Ú'),
					$string
				);
				return $string;
			}

			$this->getLibrary('PHPExcel/PHPExcel');

			// Crea un nuevo objeto PHPExcel
			$objPHPExcel = new PHPExcel();

			// Establecer propiedades
			$objPHPExcel->getProperties()
				->setCreator("Joseph Magallanes")
				->setLastModifiedBy("Portal web Distribuidores")
				->setTitle("Archivo ditribuidor stock")
				->setSubject("Archivo ditribuidor stock")
				->setDescription("Archivo importado al portaldistribuidor")
				->setKeywords("Excel Office 2007 openxml")
				->setCategory("Formatos");

			//AQUI SERVICIO DE CONSULTA PARA FOR Y OBTENER LOS DATOS

			$wsdl = 'http://localhost:81/VDWEB/WSDistribuidor.asmx?WSDL';

			$options = array(
				"uri" => $wsdl,
				"style" => SOAP_RPC,
				"use" => SOAP_ENCODED,
				"soap_version" => SOAP_1_1,
				"connection_timeout" => 60,
				"trace" => false,
				"encoding" => "UTF-8",
				"exceptions" => false,
			);

			$param = array(
				"archivo"	=> $archivo,
			);

			$soap = new SoapClient($wsdl, $options);
			$result = $soap->ConsultarArchivosStockRuc($param);
			$lista = json_decode($result->ConsultarArchivosStockRucResult, true);

			//titulos del reporte y datos donde va cada informacion
			$objPHPExcel->setActiveSheetIndex(0);

			// Fuente de la primera fila en negrita
			$boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($boldArray);

			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'FECHA');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'RUC_DISTRIBUIDOR');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NOMBRE_DISTRIBUIDOR');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'CODIGO_PRODUCTO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'NOMBRE_PRODUCTO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'KILOS');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'CANTIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ARCHIVO ORIGINAL');

			// COLOCAR MARCO A LAS CELDAS
			$rango = 'A1:H1';
			$styleArray = array(
				'font' => array('name' => 'Arial', 'size' => 9),
				'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '#FFFFFF')))
			);
			$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

			$rowcel = 2;
			for ($i = 0; $i < count($lista); $i++) {

				$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowcel, $lista[$i]['d_fecha']);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $rowcel, $lista[$i]['v_ruc']);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $rowcel, html_caracteres($lista[$i]['v_razon']));
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $rowcel, $lista[$i]['i_producto']);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $rowcel, html_caracteres($lista[$i]['v_producto']));
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $rowcel, $lista[$i]['f_kilos']);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $rowcel, $lista[$i]['f_cantidad']);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $rowcel, $archivo);

				$rango = 'A' . $rowcel . ":" . 'H' . $rowcel;
				$styleArray = array(
					'font' => array('name' => 'Arial', 'size' => 9),
					'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '#FFFFFF')))
				);
				$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

				// FORMATO TIPO TEXTO
				$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);

				$rowcel++;
			}

			$timezone = -5;
			$dia = gmdate("Ymd_His", time() + 3600 * ($timezone + date("I")));

			if ($_SESSION['id'] == 1) {
				$rucdistribuidor = $ruc;
			} else {
				$rucdistribuidor = $_SESSION['ruc'];
			}

			// Renombrar Hoja
			$objPHPExcel->getActiveSheet()->setTitle($rucdistribuidor . '_' . $dia);

			// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
			$objPHPExcel->setActiveSheetIndex(0);

			// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="' . $rucdistribuidor . '_' . $dia . '.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		} else {
			$this->redireccionar('index/logout');
		}
	}
}

?>