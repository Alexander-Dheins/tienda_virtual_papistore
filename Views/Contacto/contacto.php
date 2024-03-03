<?php 
headerTienda($data);
$banner = $data['page']['portada'];
$idpagina = $data['page']['idpost'];

 ?>
<script>
 	document.querySelector('header').classList.add('header-v4');
 </script>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
	<h2 class="ltext-105 cl0 txt-center">
		Contacto
	</h2>
</section>

<?php
	if(viewPage($idpagina)){	
 ?>
<!-- Content page -->

<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="flex-w flex-tr">
			

			<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-map-marker"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							Dirección
						</span>

						<p class="stext-115 cl6 size-213 p-t-18">
							<?= DIRECCION ?>
						</p>
					</div>
				</div>

				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-phone-handset"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							Teléfono
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">

							<a class="" href="tel:<?= TELEMPRESA ?>"><?= TELEMPRESA ?></a>
						</p>
					</div>
				</div>

				<div class="flex-w w-full">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-envelope"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							E-mail
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">
							<a class="" href="mailto:<?= EMAIL_EMPRESA ?>"><?= EMAIL_EMPRESA ?>
						</p>
					
					</div>
					
					

					<div class="whatsapp">
						<form href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
							
						<a href="https://api.whatsapp.com/send?phone=51989484671&text=Hola%21%20Quisiera%20m%C3%A1s%20informacion." class="float" target="_blank">
						<div class="incono-whatsapp">
							<image src="<?= media(); ?>/tienda/images/whatsapp-iphone.png" width="450px" height="140px">
						</div>
						</form>
						<h1 class="asistente_wa" >
							Asistencia por Whatsapp
						</h1>

					
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>	
<?php 
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