<div class="row flex-row-reverse">
    <div class="col-lg-4">
        <div class="w-100 accordion">
            <div class="card">
                <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#list_videos">
                    <h5 class="card-title d-flex justify-content-between text-white">
                        <span>Videos disponible</span>
                        <i class="fa fa-chevron-down"></i>
                    </h5>
                </div>
                <div id="list_videos" class="collapse">
                    <div class="card-body p-2">
                        <ul class="m-0 list-arrow">
                            <?php foreach ($ressources As $res) : ?>
                                <?php if(!$res->is('videos')) { continue; } ?>
                                <li class="my-2" style="font-size: 1.25em">
                                    <a href="?vrid=<?= $res->id_ressource; ?>"><?= ucfirst($res->titre_ressource); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if(empty($ressource)) : ?>
            <div class="alert alert-info text-center">
                <i class="fa fa-exclamation-triangle fa-3x"></i><br>
                Veuillez selectionner une vidéo dans la liste des ressouces pour l'afficher
            </div>
        <?php else : ?>
            <video
                id="my-video"
                class="video-js w-100"
                controls
                preload="auto"
                style="height: 40em"
                poster="<?= site_url('lib/projekktor/src/intro.png'); ?>"
                data-setup="{}"
              >
                <source src="<?= $ressource->url(); ?>" type="video/mp4" />
                <p class="vjs-no-js">
                  To view this video please enable JavaScript, and consider upgrading to a
                  web browser that
                  <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >supports HTML5 video</a
                  >
                </p>
              </video>
        <?php endif; ?>
    </div>
</div>
