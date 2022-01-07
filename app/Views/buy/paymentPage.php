<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h3>決済ページ</h3>
          
        <!-- payment -->
        <div class="p-3 bg-white rounded shadow-sm">                        
            <form action="<?= base_url('buy/payment') ?>" method="post">
                <!-- adress -->
                <h6 class="border-bottom border-gray pb-2 mb-2">注所</h6>
                <div class="form-group">
                    <select class="form-control">
                        <option>Default select</option>
                    </select>
                </div>
                <a href="<?= base_url() ?>" class="btn btn-primary mb-5">注所追加</a>
                
                <!-- coupon -->
                <h6 class="border-bottom border-gray pb-2 my-2">Coupon</h6>
                <div class="form-group">
                    <select class="form-control">
                        <option>Default select</option>
                    </select>
                </div>
                <a href="<?= base_url() ?>" class="btn btn-primary mb-5">適用</a>

                <!-- 최종금액 -->
                <h6 class="border-bottom border-gray pb-2 mb-2">金額</h6>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="d-flex list-group-item"><div class="flex-grow-1">商品金額</div><div>1</div></li>
                        <li class="d-flex list-group-item"><div class="flex-grow-1">割引金額</div><div>1</div></li>
                        <li class="d-flex list-group-item"><div class="flex-grow-1">最終金額</div><div>1</div></li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-primary my-5">決済</button>
            </form>
            

            <small class="d-block text-right mt-3">
                <a href="#">All suggestions</a>
            </small>
        </div>                              
    </div>
<?= $this->endSection() ?>