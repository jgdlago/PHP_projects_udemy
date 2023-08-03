<?php
    include_once("templates/header.php");

    if(isset($_GET['id'])) {
        $postId = $_GET['id'];
        $currentPost;

        foreach($posts as $post) {
            if($post['id'] == $postId) {
                $currentPost = $post;
            }
        }

    }
?>
    <main id="post-container">
        <div class="content-container">
            <h1 id="main-title"><?=$currentPost['title']?></h1>
            <p id="post-description"><?=$currentPost['description']?></p>
            <div class="img-container">
                <img src="<?= $BASE_URL ?>/img/<?= $currentPost['img'] ?>" alt="<?= $currentPost['title'] ?>">
            </div>
            <p class="post-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt consequatur ex exercitationem, laborum sint sed cupiditate blanditiis consectetur, voluptatum nihil animi voluptates vel saepe, quasi eius porro excepturi provident. Quibusdam?
            Cumque deleniti reiciendis necessitatibus excepturi asperiores animi atque aspernatur possimus praesentium dolor nulla, cum, ad porro, nisi quod? Eum sit rerum qui vel eveniet blanditiis nam dicta temporibus laborum asperiores.
            Illo maiores exercitationem inventore delectus aut ex animi eligendi, corporis debitis odit aspernatur sunt dolor natus, consequuntur minima reprehenderit eum aliquam! Minima deserunt mollitia ab omnis, pariatur suscipit ullam aliquam!
            Modi doloribus ut id explicabo, voluptates tempora, dolor qui dolorem eligendi odit deleniti et alias maiores fuga dicta debitis ducimus, officia voluptate. Quaerat ex nostrum eius doloribus praesentium commodi porro!
            Possimus minus reprehenderit quod itaque. Eos voluptates, perferendis fuga libero atque hic deserunt magni deleniti recusandae nulla velit tempore repudiandae delectus ad maxime tempora quas, obcaecati facere ex ab rerum.</p>
        </div>
        <aside id="nav-container">
            <h3 id="tags-title">Tags</h3>
            <ul id="tags-list">
                <?php foreach($currentPost['tags'] as $tag): ?>
                    <li><a href="#"><?= $tag ?></a></li>
                <?php endforeach; ?>
                <h3 id="categories-title">Categorias</h3>
                <ul id="categories-list">
                    <?php foreach($categories as $category): ?>
                        <li><a href="#"><?= $category ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </ul>
        </aside>
    </main>
<?php
    include_once("templates/footer.php");
?>