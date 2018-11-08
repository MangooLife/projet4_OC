<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Modifier son commentaire</h1>

<div class="news">
    <form action="index.php?action=changeComment&amp;id=<?= $getLine['id']?>&amp;idArticle=<?= $getLine['post_id']?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" value="<?= htmlspecialchars($getLine['author']) ?>" disabled/>
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($getLine['comment'])) ?></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>