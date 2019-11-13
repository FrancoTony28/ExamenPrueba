<?php

require_once "models/examendata.model.php";
function run()
{
  $estadoZapatos = obtenerEstados();
  $selectedEst = 'ACT';
  $mode = "";
  $errores=array();
  $hasError = false;
  $modeDesc = array(
    "DSP" => "ZAPATOS ",
    "INS" => "Creando Nuevo Zapatos",
    "UPD" => "Actualizando Zapatos",
    "DEL" => "Eliminando Zapatos"
  );
  $viewData = array();
  $viewData["showcodigo"] = true;
  $viewData["showBtnConfirmar"] = true;
  $viewData["readonly"] = '';
  $viewData["selectDisable"] = '';

  if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
      redirectWithMessage(
          "Petición Solicitada no es Válida",
          "index.php?page=examenlist"
      );
      die();
  }
  $viewData["xcfrt"] = $_SESSION["xcfrt"];
  if (isset($_POST["btnDsp"])) {
      $mode = "DSP";
      $zapatos = obtenerZapatosPorId($_POST["codigo"]);
      $selectedEst=$zapatos["estado"];
      $viewData["showBtnConfirmar"] = false;
      $viewData["readonly"] = 'readonly';
      $viewData["selectDisable"] = 'disabled';
      mergeFullArrayTo($zapatos, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["nombre"];
  }
  if (isset($_POST["btnUpd"])) {
      $mode = "UPD";
      $zapatos = obtenerZapatosPorId($_POST["codigo"]);
      $selectedEst=$zapatos["estado"];
      mergeFullArrayTo($zapatos, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["nombre"];
  }
  if (isset($_POST["btnDel"])) {
      $mode = "DEL";
      //Vamos A Cargar los datos
      $zapatos = obtenerZapatosPorId($_POST["codigo"]);
      $selectedEst=$zapatos["estado"];
      $viewData["readonly"] = 'readonly';
      $viewData["selectDisable"] = 'disabled';
      mergeFullArrayTo($zapatos, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["nombre"];
  }
  if (isset($_POST["btnIns"])) {
      $mode = "INS";
      $viewData["modeDsc"] = $modeDesc[$mode];
       $viewData["showcodigo"]  = false;
  }

  if (isset($_POST["btnConfirmar"])) {
      $mode = $_POST["mode"];
      $selectedEst = $_POST["estado"];
       mergeFullArrayTo($_POST, $viewData);
      switch($mode)
      {
      case 'INS':
          $viewData["showcodigo"] = false;
          $viewData["modeDsc"] = $modeDesc[$mode];

          if (agregarNuevoZapatos(
              $viewData["codigo"],
              $viewData["nombre"],
              $viewData["precio"],
              $viewData["estado"]
          )
          )
          {
              redirectWithMessage(
                  "Zapatos Guardado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      case 'UPD':
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["nombre"];
          if (modificarZapatos(
            $viewData["codigo"],
            $viewData["nombre"],
            $viewData["precio"],
            $viewData["estado"]
          )
          ) {
              redirectWithMessage(
                  "Zapatos Actualizado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      case 'DEL':
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["nombre"];
          $viewData["readonly"] = 'readonly';
          $viewData["selectDisable"] = 'disabled';
          if (eliminarZapatos(
              $viewData["codigo"]
          )
          ) {
              redirectWithMessage(
                  "Zapatos Eliminado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      }
  }
  $viewData["mode"] = $mode;
  $viewData["estzapatos"] = addSelectedCmbArray($estadoZapatos, 'cod', $selectedEst);
  $viewData["hasErrors"] = $hasError;
  $viewData["errores"] = $errores;
  renderizar("examenform", $viewData);

}

run();
?>
