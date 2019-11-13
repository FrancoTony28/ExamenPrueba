<?php
require_once "libs/dao.php";

// Elaborar el algoritmo de los solicitado aquí.

function obtenerListas()
{
    $sqlstr = "select `zapatos`.`codigo`,
              `zapatos`.`nombre`,
              `zapatos`.`precio`,
              `zapatos`.`estado`
          from `examen`.`zapatos`";

    $zapatos = array();
    $zapatos = obtenerRegistros($sqlstr);
    return $zapatos;
}

function obtenerZapatosPorId($id)
{
  $sqlstr="select `zapatos`.`codigo`,
            `zapatos`.`nombre`,
            `zapatos`.`precio`
            `zapatos`.`estado`
        from `examen`.`zapatos` where codigo=%d";
  $zapatos= array();
  $zapatos=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $zapatos;
}

function obtenerEstadoPorId($id)
{
  $sqlstr="select `zapatos`.`estado`
        from `examen`.`zapatos` where codigo=%d";
  $zapatos= array();
  $zapatos=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $zapatos;
}


function obtenerEstados()
{
    return array(
        array("cod"=>"ACT", "dsc"=>"Activo"),
        array("cod"=>"INA", "dsc"=>"Inactivo"),
        array("cod"=>"PLN", "dsc"=>"En Planificación"),
        array("cod"=>"RET", "dsc"=>"Retirado"),
        array("cod"=>"SUS", "dsc"=>"Suspendido"),
        array("cod"=>"DES", "dsc"=>"Descontinuado")
    );
}

function agregarNuevoZapatos($codigo, $nombre, $precio, $estado) {
    $insSql = "INSERT INTO zapatos(codigo, nombre, precio, estado)
      values ('%d', '%s', '%d','%s');";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $codigo,
              $nombre,
              $precio,
              $estado
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarZapatos($codigo, $nombre, $precio, $estado)
{
    $updSQL = "UPDATE zapatos set nombre='%s', precio='%d',
    estado='%s' where codigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $codigo,
            $nombre,
            $precio,
            $estado

        )
    );
}
function eliminarZapatos($id)
{
    $delSQL = "DELETE FROM zapatos where codigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $id
        )
    );
}

?>
