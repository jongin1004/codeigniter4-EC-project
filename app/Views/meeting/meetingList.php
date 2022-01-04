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