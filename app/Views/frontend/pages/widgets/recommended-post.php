

<div class="col-lg-12 col-md-6">
    <div class="widget">
        <h2 class="section-title mb-3">Rekomendasi</h2>
        <div class="widget-body">
            <div class="widget-list">
                <article class="card mb-4">
                    <div class="card-image">
                        <div class="post-info"> <span class="text-uppercase"><?= $recommendedPost[0]['created_at'] ?></span>
                        </div>
                        <img loading="lazy" decoding="async" src="<?= $recommendedPost[0]['img'] ?>" alt="Post Thumbnail" class="w-100">
                    </div>
                    <div class="card-body px-0 pb-1">
                        <h3><a class="post-title post-title-sm" href="<?= base_url('post/' . $recommendedPost[0]['slug']) ?>"><?= $recommendedPost[0]['title'] ?></a></h3>
                        <p class="card-text"><?= strip_tags($recommendedPost[0]['content']) ?></p>
                        <div class="content"> <a class="read-more-btn" href="<?= base_url('post/' . $recommendedPost[0]['slug']) ?>">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </article>
                <?php foreach ($recommendedPost as $item) : ?>
                    <a class="media align-items-center" href="<?= base_url('post/' . $recommendedPost[0]['slug']) ?>">
                        <img loading="lazy" decoding="async" src="<?= $item['img'] ?>" alt="Post Thumbnail" class="w-100">
                        <div class="media-body ml-3">
                            <h3 style="margin-top:-5px"><?= $item['title'] ?></h3>
                            <p class="mb-0 small"><?= strip_tags($item['content']) ?></p>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>


