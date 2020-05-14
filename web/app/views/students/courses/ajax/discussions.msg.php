<?php if(!empty($messages)) :  foreach($messages As $message): ?>
    <?php if($message->id_utilisateur != $User->id_utilisateur) : ?>
    <div class="media media-chat">
        <img class="avatar" src="<?= $message->auteur()->getAvatar(); ?>" alt="<?= $message->auteur()->getProfil(); ?>">
        <div class="media-body">
            <p class="meta"><span><?= $message->auteur()->getProfil(); ?></span> | <time datetime="2018"><?= $message->getDate(); ?></time></p>
            <p><?= $message->getContent(); ?></p>
        </div>
    </div>
    <!--<div class="media media-meta-day">Today</div>-->
    <?php else : ?>
    <div class="media media-chat media-chat-reverse">
        <div class="media-body">
            <p class="meta">
               <time datetime=""><?= $message->getDate(); ?></time>
            </p>
            <p><?= $message->getContent(); ?></p>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; endif; ?>
