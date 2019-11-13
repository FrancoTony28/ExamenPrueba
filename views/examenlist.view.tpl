<section>
  <header>
    <h1>Zapatos</h1>
  </header>
  <main>
    <table class="full-width">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Precio</th>
          <th class="right">
            <form action="index.php?page=examenform" method="post">
            <input type="hidden" name="idzapatos" value="" />
            <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
            <button type="submit" name="btnIns">Agregar</button>
          </form>
          </th>
        </tr>
      </thead>
      <tbody class="zebra">
        {{foreach zapatos}}
        <tr>
          <td>{{codigo}}</td>
          <td>{{nombre}}</td>
          <td>{{estado}}</td>
          <td>{{precio}}</td>
          <td class="right">
            <form action="index.php?page=examenform" method="post">
              <input type="hidden" name="idzapatos" value="{{codigo}}"/>
              <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
              <button type="submit" name="btnDsp">Ver</button>
              <button type="submit" name="btnUpd">Editar</button>
              <button type="submit" name="btnDel">Eliminar</button>
            </form>
          </td>
        </tr>
        {{endfor zapatos}}
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"> Paginación</td>
        </tr>
      </tfoot>
    </table>
  </main>
</section>
