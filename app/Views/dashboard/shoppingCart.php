<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="py-7 row" style="min-height: 100vh;">
        <div class="col-9">
            <div class="d-flex flex-column p-3 bg-white rounded shadow-sm" style="min-height: 600px;">
                <h5 class="border-bottom border-gray pb-2 mb-0">お気に入り</h5>
                <div class="text-muted pt-3 flex-grow-1">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>                            
                                        <th scope="col">写真</th>
                                        <th scope="col">商品情報</th>   
                                        <th scope="col">価格</th>                            
                                    </tr>
                                </thead>
                                <?php foreach($shopping_carts as $shopping_cart): ?>
                                    <tbody>
                                        <tr style="height: 150px;">
                                            <td class="align-middle"><input type="checkbox" name="" id=""></td> 
                                            <td class="align-middle" style="width: 150px;">사진</td>                                        
                                            <td class="align-middle text-left">
                                                <div>상품명 : <?= $shopping_cart['sale_title'] ?></div>
                                                <div>상품상태 : <?= $shopping_cart['sale_state'] ?></div>
                                                <div>판매자 : <?= $shopping_cart['user_name'] ?></div>
                                            </td>
                                            <td class="align-middle"><?= $shopping_cart['sale_price'] ?></td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
                            </table>

                            <div class="card">
                                <div class="card-header">
                                    値段
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between card-title">
                                        <div class="text-left">総 商品数</div>
                                        <div class="text-right">商品数</div> 
                                    </div>
                                    <div class="d-flex justify-content-between card-text">
                                        <div class="text-left">商品価格</div> 
                                        <div class="text-right">商品価格</div> 
                                    </div>
                                    <a href="#" class="btn btn-primary mt-3">決決済</a>
                                </div>
                            </div>
                        </div>
                    </div>                                           
                </div>  
            </div>
        </div>

        <div class="col-3">
            <?= $this->include('layout/dashboardSide') ?>
        </div>
    </div>
    
<?= $this->endSection() ?>