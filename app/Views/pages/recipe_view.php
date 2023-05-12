<?php
function getYoutubeVideoId($url)
{
    $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    preg_match($pattern, $url, $matches);
    return isset($matches[1]) ? $matches[1] : null;
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 20px;
    }

    .recipe-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }

    .recipe-header img {
        width: 100%;
        max-width: 600px;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }

    .ingredient-list {
        display: flex;
        flex-wrap: wrap;
        list-style-type: none;
        padding: 0;
        margin: 0;
        margin-bottom: 30px;
    }

    .ingredient-item {
        display: flex;
        align-items: center;
        width: 50%;
        padding: 5px 0;
    }

    .ingredient-item img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }

    .instructions {
        white-space: pre-line;
    }

    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        /* RelaciÃ³n de aspecto 16:9 */
        height: 0;
        overflow: hidden;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #profile-pic {
        border-radius: 10px;
        width: 25px;
        height: 25px;
    }
</style>

<main id="main" class="main">
    <section class="section dashboard">


        <div class="container">
            <div class="recipe-header">
                <h1>
                    <?php echo $recipe->name; ?>
                </h1>
                <img src="<?php echo base_url('recipe/image/' . $recipe->id); ?>" alt="<?php echo $recipe->name; ?>" />
            </div>

            <p>
                <?php echo $recipe->description; ?>
            </p>

            <div class="recipe-header">
                <p>Receta subida por:
                    <b>
                        <?= $username ?>

                        <?php if (empty($photoUser)): ?>
                            <img src="<?= base_url("imagenes/profile.png") ?>" alt="Profile" id="profile-pic">
                        <?php else: ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($photoUser) ?>" alt="Profile"
                                id="profile-pic">
                        <?php endif; ?>

                    </b>
                </p>
            </div>

            <h2>Ingredientes</h2>
            <ul class="ingredient-list">
                <?php foreach ($ingredients as $ingredient) { ?>
                    <li class="ingredient-item">
                        <img src="../imagenes/ingredientes/<?php echo $ingredient->icon; ?>"
                            alt="<?php echo $ingredient->name; ?>" />
                        <span>
                            <?php echo $ingredient->name; ?>:
                            <?php echo $ingredient->amount; ?>
                        </span>
                    </li>
                <?php } ?>
            </ul>

            <h2>Instrucciones</h2>
            <p class="instructions">
                <?php echo $recipe->instructions; ?>
            </p>

            <?php if (!empty($recipe->link)): ?>
                <?php $videoId = getYoutubeVideoId($recipe->link); ?>
                <?php if ($videoId): ?>
                    <h2>Video de la receta</h2>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoId; ?>"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

</main><!-- End #main -->