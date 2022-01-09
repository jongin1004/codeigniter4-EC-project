<div class="row">
    <?php foreach ($sale_posts as $sale_post) : ?>    
        <div class="col-4 mb-3">
            <a href="<?= base_url('sale/'.$sale_post['sale_id']) ?>">
                <div class="card" style="width: 15rem;">
                    <img src="images/orihinal.png" class="card-img-top">
                    <div class="card-body">
                        <div class="card-text">
                            <strong><?= $sale_post['sale_title'] ?></strong>
                            <?php if ($sale_post['is_saled']) { echo "<span class='badge badge-danger'>be sold</span>"; } ?>
                        </div>
                        <div class="card-text"><small><?= $sale_post['created_at'] ?></small></div>
                    </div>
                </div>
            </a>
        </div>        
    <?php endforeach; ?>
</div>