<?= $this->extend('frontend/layouts/template') ;?>

<?= $this->section('title') ;?>
<?= $post['title'] ?>
<?= $this->endSection() ;?>


<?= $this->section('content') ;?>
<div class="row">
	<div class="col-lg-8 mb-5 mb-lg-0">
		<article>
			<img loading="lazy" decoding="async" src="<?= $post['img'] ?>" alt="Post Thumbnail" class="w-100">
			<ul class="post-meta mb-2 mt-4">
				<li>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
						<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
						<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
						<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
					</svg> <span><?= $post['created_at'] ?></span>
				</li>
			</ul>
			<h1 class="my-3"><?= $post['title'] ?></h1>
			<ul class="post-meta mb-4">
				<li> <a href="/categories/destination">destination</a>
				</li>
			</ul>
			<div class="content text-left">
			<?= $post['content'] ?>
			</div>
		</article>
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
