<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo ?></h2>
    <p class="devwebcamp__descripcion">Conoce sobre la conferencia más importante de LATAM</p>

    <div class="devwebcamp__grid">
        <div <?php echo aos_animacion() ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="Imagen DevWebCamp">
            </picture>
        </div>
        <div <?php echo aos_animacion() ?> class="devwebcamp__contenido">
            <p class="devwebcamp__texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi voluptas ratione doloremque impedit odio molestias, quam perferendis. Dolore debitis ad quidem deserunt facilis molestias suscipit, porro expedita illum tempore, impedit, cumque totam exercitationem ratione nostrum vero quae pariatur adipisci ex explicabo cupiditate sequi? Laborum libero voluptate in deserunt est deleniti?</p>
            <p class="devwebcamp__texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi voluptas ratione doloremque impedit odio molestias, quam perferendis. Dolore debitis ad quidem deserunt facilis molestias suscipit, porro expedita illum tempore, impedit, cumque totam exercitationem ratione nostrum vero quae pariatur adipisci ex explicabo cupiditate sequi? Laborum libero voluptate in deserunt est deleniti?</p>
        </div>
    </div>
</main>