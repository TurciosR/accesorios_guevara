<?php
include "_conexion.php";
/*
$sql = _query("SELECT * FROM prods");
$error = 0;
$msg = "";
_begin();
while ($row = _fetch_array($sql))
{
  $tipo = $row["tipo"];
  $codigo = $row["codigo"];
  $upc = $row["upc"];
  $descri = $row["descri"];
  $provider = $row["provider"];
  $provider2 = $row["provider2"];
  $provider3 = $row["provider3"];
  $familia = trim($row["familia"]);
  $atributo1 = $row["atributo1"];
  $atributo2 = $row["atributo2"];
  $atributo3 = $row["atributo3"];
  $atributo4 = $row["atributo4"];
  $atributo5 = $row["atributo5"];
  $estante = $row["estante"];
  $anaquel = $row["anaquel"];
  $caja = $row["caja"];
  $min = $row["min"];
  $max = $row["max"];
  $b1 = $row["b1"];
  $b2 = $row["b2"];
  $b3 = $row["b3"];
  $b4 = $row["b4"];
  $sala = $row["sala"];
  $existencia = $row["existencia"];
  $g_e = $row["g_e"];
  $p1 = str_replace(",",".",$row["p1"]);
  $p2 = str_replace(",",".",$row["p2"]);
  $p3 = str_replace(",",".",$row["p3"]);
  $p4 = str_replace(",",".",$row["p4"]);
  $p5 = str_replace(",",".",$row["p5"]);
  $desc = $row["desc"];
  $foto = $row["foto"];
  $costo = str_replace(",",".",$row["costo"]);
  $ulcosto = str_replace(",",".",$row["ulcosto"]);
  $ulcompra = MD($row["ulcompra"]);
  $contar = $row["contar"];
  $sql_cat = _query("SELECT id_categoria FROM categoria WHERE nombre LIKE '%$familia%'");
  $row_cat = _fetch_array($sql_cat);
  $categoria = $row_cat["id_categoria"];
  $form_data = array(
    'tipo' => $tipo,
    'codigo' => $codigo,
    'id_proveedor1' => $provider,
    'id_proveedor2' => $provider2,
    'id_proveedor3' => $provider3,
    'descripcion' => $descri,
    'ultcosto' => $ulcosto,
    'ultcompra' => $ulcompra,
    'id_categoria' => $categoria,
    'marca' => $atributo2,
    'modelo' => $atributo4,
    'serie' => $atributo3,
    'presentacion' => $atributo1,
    'existencia' => $existencia,
  );
  $insert = _insert("productos",$form_data);
  if($insert)
  {
    $id_producto = _insert_id();
    $sql_porc = _query("SELECT * FROM porcentajes");
    $n=0;
    $precios = array($p1,$p2,$p3,$p4,$p5);
    while($row_porc = _fetch_array($sql_porc))
    {
      if($costo>0)
      {
        $porc =(($precios[$n] - $costo)/$costo)*100;
      }
      else {

      }
      $form_data_aux = array(
        'id_producto' => $id_producto,
        'costo' => $costo,
        'costo_iva' => $costo*1.13,
        'detalle' => $row_porc["detalle"],
        'ganancia' => $precios[$n]-$costo,
        'total' => $precios[$n],
        'total_iva' => ($precios[$n])*1.13,
        'porcentaje' => $porc
      );
      $n++;
      $insert_aux = _insert("precio_producto", $form_data_aux);
      if(!$insert_aux)
      {
        $error=1;
        $msg.="<br>"._error();
      }
    }
  }
  else {
    $error = 1;
    $msg.="<br>"._error();
  }
}
if(!$error)
{
  _commit();
  echo "OK";
}
else
{
  _rollback();
  echo "Ups!";
  echo $msg;
}
*/
/*
$sql = _query("SELECT * FROM proveedores");
$error = 0;
$msg = "";
while ($row = _fetch_array($sql))
{
  $id_proveedor = $row["id_proveedor"];
  $giro = $row["giro"];
  $id_giro = 0;

  if($giro!="")
  {
    $sql_mg = _query("SELECT id_giro, descripcion FROM giro WHERE replace( replace ( replace  (replace( replace  (descripcion, 'á', 'a' ), 'é', 'e' ), 'í', 'i' ), 'ó', 'o' ), 'ú', 'u' ) LIKE '%$giro%'");
    if(_num_rows($sql_mg)>0)
    {
      $row_mg = _fetch_array($sql_mg);
      $id_giro = $row_mg["id_giro"];
    }
  }
  $form_data = array(
    'giro' => $id_giro,
  );
  $upd = _update("proveedores", $form_data ,"id_proveedor='".$id_proveedor."'");
  if(!$upd)
  {
    echo _error()."<br>";
  }
}*/
/*
$inicio = 385;
$n = 1;
$ini = $inicio;
$fin = $inicio;
$fechai = '2020-03-21';
_begin();
$sql = _query("SELECT * FROM factura WHERE fecha>'2020-03-21' ORDER BY fecha ASC");
while ($row =_fetch_array($sql))
{
  if($fechai != $row["fecha"])
  {
    //$nuevo = $inicio+2;
    $fechai = $row["fecha"];
    //$nuevoa = $nuevo;
    if(_num_rows(_query("SELECT * FROM factura WHERE tipo='TICKET' AND fecha='$fechai'"))>0)
    {
      $nuevo = $inicio+1;
      if($ini == $fin)
      {
        $ini = 0;
        $fin = 0;
      }
    }
    else {
      $ini = 0;
      $fin = 0;
      $nuevo = 0;
    }

    echo "FECHA - >".$fechai." - >". $ini." - > ". $fin. " - > ". $nuevo." <br>";
    $sql_aux = _query("SELECT * FROM controlcaja WHERE fecha_corte='$fechai'");
    while ($row_aux = _fetch_array($sql_aux))
    {
      $id_corte = $row_aux["id_corte"];
      $tinicio = $row_aux["tinicio"];
      $tfinal = $row_aux["tfinal"];
      $tiket = $row_aux["tiket"];
      if($tiket > 0)
      {
        $array_aux = array(
          'tinicio' => $ini,
          'tfinal' => $fin,
          'tiket' => $nuevo
        );
      }
      else
      {
        $array_aux = array(
          'tinicio' => $ini,
          'tfinal' => $fin,
          'tiket' => 0
        );
      }
      $where1 = "id_corte='".($id_corte-1)."'";
      $update1 = _update("controlcaja",$array_aux,$where1);
      if(!$update1)
      {
        $error = 1;
      }
      echo $id_corte." FECHA - >".$fechai." - >". $tinicio." - > ". $tfinal. " - > ". $tiket." <br>";
    }
    if(_num_rows(_query("SELECT * FROM factura WHERE tipo='TICKET' AND fecha='$fechai'"))>0)
    {
      $ini = $inicio;
      $inicio+=1;
      $fin = $nuevo;
    }
  }
  if($row["tipo"] == "TICKET")
  {
    $id_factura = $row["id_factura"];
    $num_fact_impresa = $row["num_fact_impresa"];
    $nuevo = $inicio+1;
    echo $n." - >".$fechai." - >". $id_factura." - > ". $num_fact_impresa. " - > ". $nuevo." <br>";
    $array = array(
      'num_fact_impresa'=>$nuevo,
    );
    $where = "id_factura='".$id_factura."'";
    $update = _update("factura",$array,$where);
    if(!$update)
    {
      $error = 1;
    }
    $n++;
    $inicio++;
    $fin = $nuevo;
  }

  echo "<hr>";
}
_commit();*/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
$fini = "2022-03-21";
$fin = "2022-03-31";
$total_g_m = 0;
$total_e_m = 0;
$total_t_m = 0;
$total_g_m_e = 0;
$total_e_m_e = 0;
$total_t_m_e = 0;
$err = 0;
_begin();
while(strtotime($fini) <= strtotime($fin))
{
  $total_g_d = 0;
  $total_e_d = 0;
  $total_t_d = 0;
  $total_g_d_e = 0;
  $total_e_d_e = 0;
  $total_t_d_e = 0;
  $sql = _query("SELECT * FROM factura WHERE fecha='$fini' AND tipo='TICKET' AND pago_tarjeta=0 ORDER BY fecha ASC");
  while ($row =_fetch_array($sql))
  {
    //echo "TIKET ".$row["numero_doc"]."<br>";
    if($row["anulada"])
    {
      $tot_g_e = 0;
      $tot_e_e = 0;
      $tot_a =  0;
    }
    else {
      $tot_g_e = $row["subtotal"];
      $tot_e_e = $row["venta_exenta"];
      $tot_a =  $row["total"];
    }
    $tot_g = 0;
    $tot_e = 0;
    $tot = 0;
    $sql_aux = _query('SELECT factura_detalle.*, producto.descripcion, producto.exento as exen FROM factura_detalle JOIN producto ON producto.id_producto=factura_detalle.id_prod_serv WHERE id_factura="'.$row["id_factura"].'"');
    while ($row_aux =_fetch_array($sql_aux))
    {

      //echo "Producto :".$row_aux["descripcion"]."<br>";
      //echo "Cantidad: ".$row_aux["cantidad"]." Precio: $".$row_aux["precio_venta"]." Subtotal: $".$row_aux["subtotal"]."<br>";
      $sql_aux_aux = _query("SELECT * FROM presentacion_producto WHERE id_pp='".$row_aux["id_presentacion"]."'");
      $datos_aux_aux = _fetch_array($sql_aux_aux);
      /*$precio1 = $datos_aux_aux["precio"];
      $precio2 = $datos_aux_aux["precio1"];
      $precio3 = $datos_aux_aux["precio2"];
      $precio4 = $datos_aux_aux["precio3"];
      $precio5 = $datos_aux_aux["precio4"];
      $precio6 = $datos_aux_aux["precio5"];
      if($precio6 >0)
      {
      $nprecio = 6;
      $min = $precio6;
      }
      else if($precio5 >0)
      {
      $nprecio = 5;
      $min = $precio5;
      }
      else if($precio4 >0)
      {
      $nprecio = 4;
      $min = $precio4;
      }
      else if($precio3 >0)
      {
      $nprecio = 3;
      $min = $precio3;
      }
      else if($precio2 >0)
      {
      $nprecio = 2;
      $min = $precio2;
      }
      else if($precio1 >0)
      {
      $nprecio = 1;
      $min = $precio1;
      }*/
      $n_precio = "Personalizado";
      if($datos_aux_aux["costo"]>0)
      {
        $min = round(($datos_aux_aux["costo"]*1.25),2);
        $subtotal = round(($row_aux["cantidad"]*$min),2);
        /************************************************/
        /************************************************/
        /************************************************/
        /************************************************/
        $table_aux = "factura_detalle";
        $id_detalle = $row_aux["id_factura_detalle"];
        $form_data_aux = array(
          'precio_venta' => $min,
          'subtotal' => $subtotal,
        );
        $where_aux = "id_factura_detalle='$id_detalle'";
        if(!_update($table_aux,$form_data_aux,$where_aux))
        {
          $err =1;
        }
      }
      /************************************************/
      /************************************************/
      /************************************************/
      /************************************************/
      if(!$row["anulada"])
      {
        $tot += $subtotal;
      }
      if($row_aux["exen"] == "1")
      {
        if(!$row["anulada"])
        {
          $tot_e += $subtotal;
        }
        //echo "Cantidad: ".$row_aux["cantidad"]." Precio $nprecio: $".$min." Subtotal: $".$row_aux["cantidad"]*$min." E<br>";
      }
      else {
        if(!$row["anulada"])
        {
          $tot_g += $subtotal;
        }
        //echo "Cantidad: ".$row_aux["cantidad"]." Precio $nprecio: $".$min." Subtotal: $".$row_aux["cantidad"]*$min." G<br>";
      }
    }
    /**********************************************************/
    /**********************************************************/
    /**********************************************************/
    $table = "factura";
    $id_factura = $row["id_factura"];
    $form_data = array(
      'subtotal' => $tot_g,
      'suma_gravado' => $tot_g,
      'total' => $tot,
      'venta_exenta' => $tot_e,
      'total_menos_retencion' => $tot,
    );
    $where = "id_factura='$id_factura'";
    if(!_update($table,$form_data,$where))
    {
      $err =1;
    }
    /**********************************************************/
    /**********************************************************/
    /**********************************************************/
    //echo "Total gravado anterior: $".$tot_g_e." Total gravado nuevo $".$tot_g."<br>";
    //echo "Total exento anterior: $".$tot_e_e." Total exento nuevo $".$tot_e."<br>";
    //echo "Total general anterior: $".$tot_a." Total general nuevo $".$tot."<br>";
    //echo "<br><br>";
    $total_t_d_e += $tot_a;
    $total_e_d_e += $tot_e_e;
    $total_g_d_e += $tot_g_e;
    $total_t_d += $tot;
    $total_e_d += $tot_e;
    $total_g_d += $tot_g;
    /***************************************************/
    /***************************************************/
    /*A actualizar:
    /* Factura: subtotal, suma_gravado
    /* Factura: venta_exenta
    /* Factura: total, total_menos_retencion, total
    /* Factura Detalle: precio_venta, subtotal
    /* Corte: totalt, totalgral --- totalgral = ttik+tcof+tccf+cini
    /* Corte: total_exento, total_gravado --- totalgral = ttik+tcof+tccf+cini
    /***************************************************/
    /***************************************************/
  }
  echo "DIA ".dialetras($fini)." ".ED($fini)."<br>";
  echo "Total gravado anterior: $".number_format($total_g_d_e,2,".","")." Total gravado nuevo $".number_format($total_g_d,2,".","")."<br>";
  echo "Total exento anterior: $".number_format($total_e_d_e,2,".","")." Total exento nuevo $".number_format($total_e_d,2,".","")."<br>";
  echo "Total general anterior: $".number_format($total_t_d_e,2,".","")." Total general nuevo $".number_format($total_t_d,2,".","")."<br>";
  $sql_corte = _query("SELECT * FROM controlcaja WHERE tipo_corte='Z' AND fecha_corte='$fini'");
  $datos_corte = _fetch_array($sql_corte);
  /*$total_tik = $datos_corte["totalt"];*/
  $total_f = $datos_corte["totalf"];
  $total_cf = $datos_corte["totalcf"];
  $cashinicial = $datos_corte["cashinicial"];

  $totalgral = $total_f + $total_cf + $total_t_d + $cashinicial;

  $total_exento_e = $datos_corte["total_exento"];
  $total_gravado_e = $datos_corte["total_gravado"];

  $total_exento = $total_exento_e - $total_e_d_e + $total_e_d;
  $total_gravado = $total_gravado_e - $total_g_d_e + $total_g_d;

  $total_c_t = $datos_corte["totalt"];
  echo "Total corte anterior: $".number_format($total_c_t,2,".","")." Total corte nuevo $".number_format($total_t_d,2,".","")."<br>";
  echo "<br><br>";
  echo "<br><br>";
  /**********************************************************/
  /**********************************************************/
  /**********************************************************/
  $table_corte = "controlcaja";
  $id_corte= $datos_corte["id_corte"];
  $form_data_corte = array(
    'totalt' => $total_t_d,
    'totalgral' => $totalgral,
    'cashfinal' => $totalgral,
    'total_exento' => $total_exento,
    'total_gravado' => $total_gravado,
  );
  $where_corte = "id_corte='$id_corte'";
  if(!_update($table_corte,$form_data_corte,$where_corte))
  {
    $err =1;
  }
  /**********************************************************/
  /**********************************************************/
  /**********************************************************/
  $total_t_m_e += $total_t_d_e;
  $total_e_m_e += $total_e_d_e;
  $total_g_m_e += $total_g_d_e;
  $total_t_m += $total_t_d;
  $total_e_m += $total_e_d;
  $total_g_m += $total_g_d;
  $fini = sumar_dias_Ymd($fini,1);
}
if(!$err)
{
  _commit();
  echo "OK";

}
else {
  _rollback();
  echo "NO error";
}
echo "TOTALES GENERALES <br>";
echo "Total gravado anterior: $".number_format($total_g_m_e,2,".","")." Total gravado nuevo $".number_format($total_g_m,2,".","")."<br>";
echo "Total exento anterior: $".number_format($total_e_m_e,2,".","")." Total exento nuevo $".number_format($total_e_m,2,".","")."<br>";
echo "Total general anterior: $".number_format($total_t_m_e,2,".","")." Total general nuevo $".number_format($total_t_m,2,".","")."<br>";
echo "<br><br>";
echo "<br><br>";

/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
?>
