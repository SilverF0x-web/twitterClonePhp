<?php if ($posts) { ?>
<section class="wrapper">
    <ul class="tweet-list">
        <?php foreach($posts as $post) { ?>
            <li>
                <article class="tweet">
                    <div class="row">
                        <img class="avatar" src="<?php echo get_url($post['avatar']); ?>" alt="Аватар пользователя <?php echo $post['name']; ?>">
                        <div class="tweet__wrapper">
                            <header class="tweet__header">
                                <h3 class="tweet-author"><?php echo $post['name']; ?>
                                    <a class="tweet-author__add tweet-author__nickname" href="<?php echo get_url('user_posts.php?id=' . $post['user_id']); ?>">@<?php echo $post['login']; ?></a>
                                    <time class="tweet-author__add tweet__date"><?php echo date('d.m.y в H:i', strtotime($post['date'])); ?></time>
                                </h3>
                                <?php if (logged_in() && $post['user_id'] == $_SESSION['user']['id']) { ?>
                                    <a class="tweet__delete-button chest-icon" href="<?php echo get_url('includes/delete_post.php?id=' . $post['id']); ?>"></a>
                                <?php } ?>
                            </header>
                            <div class="tweet-post">
                                <p class="tweet-post__text"><?php echo $post['text']; ?></p>
                            <?php if ($post['image']) { ?>
                                <figure class="tweet-post__image">
                                    <img src="<?php echo $post['image']; ?>" alt="tweet image">
                                </figure>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <?php
                            $likes_count = get_likes_count($post['id']);
                            if (logged_in()) {
                                if (is_post_liked($post['id'])) { ?>
                                    <a class="tweet__like tweet__like_active" href="<?php echo get_url('includes/delete_like.php?id=' . $post['id']); ?>"><?php echo $likes_count; ?></a>
                                <?php } else { ?>
                                    <a class="tweet__like" href="<?php echo get_url('includes/add_like.php?id=' . $post['id']); ?>"><?php echo $likes_count; ?></a>
                                <?php } ?>
                                <?php } else { ?>
                                    <div class="tweet__like"><?php echo $likes_count; ?></div>
                                <?php } ?>
                    </footer>
                </article>
            </li>
        <?php }?>
    </ul>
</section>

<?php } else {
    echo '<h2 class="tweet-form__title">Здесь пока нет твитов...</h2>';
}
