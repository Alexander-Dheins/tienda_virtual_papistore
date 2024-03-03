<?php 
headerTienda($data);
$banner = $data['page']['portada'];
$idpagina = $data['page']['idpost'];
 ?>
<script>
  document.querySelector('header').classList.add('header-v4');
</script>

 <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
  <h2 class="ltext-105 cl0 txt-center">
    <?= $data['page']['titulo'] ?>
  </h2>
</section>

<!-- <section class="py-5 text-center">
    <div class="container">
      <p>Visitanos y obten los mejores precios del mercado, cualquier artículo que necestas para vivir mejor</p>
      <a href="" class="btn btn-info">VER PRODUCTOS</a>
    </div>
</section>
<div class="py-5 bg-light">
  <div class="container">
    <div class="row">

      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img src="<?= media() ?>/images/s1.jpg" alt="Sucural uno">
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p>
            <p>Dirección: Antigua Gautemala <br>
              Teléfono: 4654645 <br>
              Correo: info@abelosh.com
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img src="<?= media() ?>/images/s1.jpg" alt="Sucural uno">
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p>
            <p>Dirección: Antigua Gautemala <br>
              Teléfono: 4654645 <br>
              Correo: info@abelosh.com
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img src="<?= media() ?>/images/s1.jpg" alt="Sucural uno">
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p>
            <p>Dirección: Antigua Gautemala <br>
              Teléfono: 4654645 <br>
              Correo: info@abelosh.com
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> -->

<?php
  if(viewPage($idpagina)){
    echo $data['page']['contenido'];
  }else{
  ?>
<div>
  <div class="container-fluid py-5 text-center" >
    <img src="<?= media() ?>/images/construction.png" alt="En construcción">
    <h3>Estamos trabajando para usted.</h3>
  </div>
</div>
<?php 
  }
  footerTienda($data);
?>