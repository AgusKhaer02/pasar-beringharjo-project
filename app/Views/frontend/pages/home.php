<?= $this->extend('frontend/layouts/template'); ?>
<?= $this->section('title') ;?>
Home
<?= $this->endSection() ;?>

<?= $this->section('content') ;?>
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <div class="col-12 mb-4">
                    <article class="card article-card">
                        <a href="<?= base_url('post/'. $posts[0]['slug']) ?>">
                            <div class="card-image">
                                <div class="post-info"> <span class="text-uppercase"><?= $posts[0]['created_at'] ?></span>
                                    <!-- <span class="text-uppercase">3 minutes read</span> -->
                                </div>
                                <img loading="lazy" decoding="async" src="<?= $posts[0]['img'] ?>" alt="Post Thumbnail" class="w-100">
                            </div>
                        </a>
                        <div class="card-body px-0 pb-1">
                            <ul class="post-meta mb-2">
                                <li> <a href="#!">travel</a>
                                    <a href="#!">news</a>
                                </li>
                            </ul>
                            <h2 class="h1"><a class="post-title" href="<?= base_url('post/'. $posts[0]['slug']) ?>"><?= $posts[0]['title'] ?></a></h2>
                            <p class="card-text"><?= strip_tags($posts[0]['content']) ?></p>
                            <div class="content"> <a class="read-more-btn" href="<?= base_url('post/'. $posts[0]['slug']) ?>">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php foreach ($posts as $item) : ?>
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="<?= base_url('post/' . $item['slug']) ?>">
                                <div class="card-image">
                                    <div class="post-info"> <span class="text-uppercase"><?= $item['created_at'] ?></span>
                                        <span class="text-uppercase">2 minutes read</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="<?= $item['img'] ?>" alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li> <a href="#!">Pakaian</a>
                                    </li>
                                </ul>
                                <h2><a class="post-title" href="<?= base_url('post/' . $item['slug']) ?>"><?= $item['title'] ?></a></h2>
                                <p class="card-text"><?= strip_tags($item['content']) ?></p>
                                <div class="content"> <a class="read-more-btn" href="<?= base_url('post/' . $item['slug']) ?>">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <nav class="mt-4">
                                <!-- pagination -->
                                <nav class="mb-md-50">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#!" aria-label="Pagination Arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="page-item active "> <a href="index.html" class="page-link">
                                                1
                                            </a>
                                        </li>
                                        <li class="page-item"> <a href="#!" class="page-link">
                                                2
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#!" aria-label="Pagination Arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget-blocks">
                <div class="row">
                    

                    <?= $this->include('frontend/pages/widgets/recommended-post') ;?>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Categories</h2>
                            <div class="widget-body">
                                <ul class="widget-list">
                                    <li><a href="#!">computer<span class="ml-auto">(3)</span></a>
                                    </li>
                                    <li><a href="#!">cruises<span class="ml-auto">(2)</span></a>
                                    </li>
                                    <li><a href="#!">destination<span class="ml-auto">(1)</span></a>
                                    </li>
                                    <li><a href="#!">internet<span class="ml-auto">(4)</span></a>
                                    </li>
                                    <li><a href="#!">lifestyle<span class="ml-auto">(2)</span></a>
                                    </li>
                                    <li><a href="#!">news<span class="ml-auto">(5)</span></a>
                                    </li>
                                    <li><a href="#!">telephone<span class="ml-auto">(1)</span></a>
                                    </li>
                                    <li><a href="#!">tips<span class="ml-auto">(1)</span></a>
                                    </li>
                                    <li><a href="#!">travel<span class="ml-auto">(3)</span></a>
                                    </li>
                                    <li><a href="#!">website<span class="ml-auto">(4)</span></a>
                                    </li>
                                    <li><a href="#!">hugo<span class="ml-auto">(2)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ;?>