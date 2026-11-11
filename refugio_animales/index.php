<?php
require_once "funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huellitas | Refugio de animales</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header class="navbar">
    <a class="logo" href="index.php"><span></span> Huellitas</a>
    <nav>
        <a href="#inicio">Inicio</a>
        <a href="#nosotros">Nosotros</a>
        <a href="#adopciones">Adopciones</a>
        <a href="#contacto">Contacto</a>
        <?php if (isset($_SESSION["usuario_id"])): ?>
            <a class="nav-button" href="panel.php">Mi cuenta</a>
        <?php else: ?>
            <a href="login.php">Ingresar</a>
            <a class="nav-button" href="registro.php">Registrarme</a>
        <?php endif; ?>
    </nav>
</header>

<main>
<section class="hero" id="inicio">
    <div class="hero-content">
        <span class="eyebrow">REFUGIO DE ANIMALES · BUENOS AIRES</span>
        <h1>Un hogar cambia<br>una vida. <em>Adoptá.</em></h1>
        <p>Rescatamos, cuidamos y acompañamos a perros y gatos que esperan una segunda oportunidad.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="#adopciones">Conocé a nuestros animales</a>
            <a class="button button-light" href="registro.php">Crear una cuenta</a>
        </div>
    </div>
    <div class="hero-photo">
        <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=1100&q=85" alt="Perro mirando a cámara">
        <div class="photo-note"><strong>Amor que transforma</strong><span>Cada adopción cuenta.</span></div>
    </div>
</section>

<section class="stats">
    <div><strong>+120</strong><span>animales rescatados</span></div>
    <div><strong>+85</strong><span>adopciones responsables</span></div>
    <div><strong>1</strong><span>misión: darles una oportunidad</span></div>
</section>

<section class="section about" id="nosotros">
    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1000&q=85" alt="Dos perros jugando al aire libre">
    </div>
    <div class="about-copy">
        <span class="eyebrow">QUIÉNES SOMOS</span>
        <h2>Un refugio lleno de segundas oportunidades.</h2>
        <p>Huellitas es un refugio dedicado al rescate y cuidado de animales que fueron abandonados o se encuentran en situación de calle.</p>
        <p>Les brindamos alimento, atención veterinaria y, sobre todo, cariño. Nuestro objetivo es encontrarles familias responsables que los acompañen para siempre.</p>
        <a class="text-link" href="#contacto">Conocé cómo ayudar <span>→</span></a>
    </div>
</section>

<section class="section animals" id="adopciones">
    <div class="section-heading">
        <div><span class="eyebrow">EN BUSCA DE UNA FAMILIA</span><h2>Conocé a nuestros amigos</h2></div>
    </div>
    <div class="animal-grid">
        <article class="animal-card">
            <img src="https://images.unsplash.com/photo-1551717743-49959800b1f6?auto=format&fit=crop&w=800&q=85" alt="Perro marrón">
            <div class="animal-info"><span class="animal-tag">Perro · 2 años</span><h3>Rocco</h3><p>Juguetón, compañero y fanático de los paseos.</p><a href="registro.php" class="text-link">Quiero conocerlo →</a></div>
        </article>
        <article class="animal-card">
            <img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?auto=format&fit=crop&w=800&q=85" alt="Gato atigrado">
            <div class="animal-info"><span class="animal-tag">Gato · 1 año</span><h3>Mora</h3><p>Tranquila, curiosa y amante de las siestas.</p><a href="registro.php" class="text-link">Quiero conocerla →</a></div>
        </article>
        <article class="animal-card">
            <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&w=800&q=85" alt="Perro mirando de frente">
            <div class="animal-info"><span class="animal-tag">Perro · 3 años</span><h3>Toby</h3><p>Muy cariñoso y siempre dispuesto a jugar.</p><a href="registro.php" class="text-link">Quiero conocerlo →</a></div>
        </article>
    </div>
</section>

<section class="help-banner" id="contacto">
    <div><span class="eyebrow">TODOS PODEMOS AYUDAR</span><h2>Un pequeño gesto puede cambiar una vida.</h2><p>Podés adoptar, colaborar con alimento o compartir nuestra misión.</p></div>
    <a class="button button-primary" href="registro.php">Sumarme al refugio</a>
</section>
</main>

<footer class="footer">
    <a class="logo" href="index.php"><span></span> Huellitas</a>
    <p>Fátima Carceglia  Programación</p>
    <p> Huellitas</p>
</footer>
</body>
</html>
