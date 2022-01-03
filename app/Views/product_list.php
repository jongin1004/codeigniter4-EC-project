<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>	
	<div class="mb-2">
		<a href="<?= base_url('/meeting/new') ?>" class="btn btn-primary">集まり</a>
		<a href="#" class="btn btn-primary">販売</a>
	</div>
	
	<!-- Sale Post -->
	<div class="card text-center mb-3">
		<div class="card-body">
			<div class="row">
				<div class="col-4">
					<div class="card" style="width: 15rem;">
						<img src="images/orihinal.png" class="card-img-top">
						<div class="card-body">
							<div class="card-text">タイトル</div>
							<div class="card-text">注所</div>
							<div class="card-text">値段・日時・いいね</div>
						</div>
					</div>
				</div>
					
				<div class="col-4">
					<div class="card" style="width: 15rem;">
						<img src="images/orihinal.png" class="card-img-top">
						<div class="card-body">
							<div class="card-text">タイトル</div>
							<div class="card-text">注所</div>
							<div class="card-text">値段・日時・いいね</div>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card" style="width: 15rem;">
						<img src="images/orihinal.png" class="card-img-top">
						<div class="card-body">
							<div class="card-text">タイトル</div>
							<div class="card-text">注所</div>
							<div class="card-text">値段・日時・いいね</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
		<a class="card-footer text-muted" href="##">
			더보기
		</a>
	</div>

	<!-- Meeting Post -->
	<div class="card text-center">
		<div class="card-body">
			<div class="row">
				<?php foreach ($meeting_posts as $meeting_post): ?>									
					<div class="col-12">
						<a href="<?= base_url('/meeting/'.$meeting_post['meeting_id']) ?>">
							<div class="card mb-3">
								<div class="row no-gutters">
									<div class="col-md-3">
										<img src="images/orihinal.png" style="width: 100%; height: 100%;">
									</div>
									<div class="col-md-9">
										<div class="card-body">
											<h5 class="card-title"><strong><?= $meeting_post['meeting_title'] ?></strong></h5>
											<p class="card-text"><?= $meeting_post['meeting_description'] ?></p>
											<p class="card-text"><small class="text-muted"><?= $meeting_post['user_id'] ?></small></p>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>					
				<?php endforeach; ?>
			</div>
		</div>
		<a class="card-footer text-muted" href="##">
			더보기
		</a>
	</div>	
<?= $this->endSection() ?>