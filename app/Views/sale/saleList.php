<div class="row">
    <?php foreach ($sale_posts as $sale_post) : ?>    
        <div class="col-4 mb-3">
            <a href="<?= base_url('sale/'.$sale_post['sale_id']) ?>">
                <div class="card" style="width: 15rem;">
                    <img src="images/orihinal.png" class="card-img-top">
                    <div class="card-body">
                        <div class="card-text"><?= $sale_post['sale_title'] ?></div>									
                        <div class="card-text"><small><?= $sale_post['created_at'] ?></small></div>
                    </div>
                </div>
            </a>
        </div>        
    <?php endforeach; ?>
</div>