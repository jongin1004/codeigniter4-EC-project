<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="py-7">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-primary rounded shadow-sm">
            <img class="mr-3" src="/docs/4.6/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">集まり</h6>
                <small>人と人の繋がりの力</small>
            </div>
        </div>

        <!-- 본문 -->
        <div class="d-flex flex-column my-3 p-3 bg-white rounded shadow-sm" style="min-height: 600px;">
            <h5 class="border-bottom border-gray py-2 mb-0" id="sale_title"><?= esc($sale_post['sale_title']) ?></h5>
            <h5 class="border-bottom border-gray py-2 mb-0" id="sale_title"><?= '가격 : '.esc($sale_post['sale_price']) ?></h5>
            <h5 class="border-bottom border-gray py-2 mb-0" id="sale_title"><?= '상태 : '.esc($sale_post['sale_state']) ?></h5>

            <div class="media text-muted pt-3 flex-grow-1" id="sale_description">        
                <?= $sale_post['sale_description'] ?>
            </div>

            <?php $session = session(); ?>
            <?php if ($session->get('user_id') === $sale_post['user_id']) : ?>
                <div>
                    <a href="<?= base_url('/sale/'.esc($sale_post['sale_id']).'/modify') ?>" class="btn btn-primary">修正</a>
                    <a href="<?= base_url('/sale/'.esc($sale_post['sale_id']).'/delete') ?>" class="btn btn-danger">削除</a>
                </div>        
            <?php endif; ?>
        </div>
        
        <div class="text-right">
            <a href="<?= base_url('shoppingCart/'.$sale_post['sale_id']) ?>" class="btn btn-primary">お気に入り</a>
            <a href="<?= base_url('buy/'.$sale_post['sale_id']) ?>" class="btn btn-danger">購入</a>
            <a href="<?= base_url('chat/'.$sale_post['user_id']) ?>" class="btn btn-success">チャット</a>
        </div> 

        <script>
            let is_saled = "<?= $sale_post['is_saled'] ?>";
            if (is_saled === 'y') {
                $('#sale_title').append(' <span class="badge badge-danger">be sold</span>');
            }
            
        </script>
<?= $this->endSection() ?>