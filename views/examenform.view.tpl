<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=examenform" method="post" class="col-8 col-offset-2">

  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  <fieldset class="row">
    <label class="col-5" for="codigo">Código de Zapatos</label>
    <input type="text" name="codigo" id="codigo" {{readonly}} value="{{codigo}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="nombre">Nombre: </label>
    <input type="text" name="nombre" id="nombre" {{readonly}} value="{{nombre}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="estado">Estado de Zapatos: </label>
    <select name="estado" id="estado" class="col-7" {{selectDisable}} {{readonly}} >
      {{foreach estado}}
        <option value="{{cod}}" {{selected}}>{{estado}}</option>
      {{endfor estado}}
    </select>
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="precio">Precio: </label>
    <input type="text" name="precio" id="precio" {{readonly}} value="{{precio}}" class="col-7" />
  </fieldset>

  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=examenlist");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
  });
</script>
