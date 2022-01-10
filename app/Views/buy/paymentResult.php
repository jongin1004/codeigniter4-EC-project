<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h3>決済結果ページ</h3>
          
        <!-- payment -->
        <div class="p-3 bg-white rounded shadow-sm">                                    

            <!-- 최종금액 -->
            <table class="table table-striped text-center">
                <thead>
                    <tr>                            
                        <th scope="col">写真</th>
                        <th scope="col">商品価格</th>   
                        <th scope="col">配送先</th>                            
                    </tr>
                </thead>
                <tbody>
                    <tr style="height: 150px;">
                        <td class="align-middle"><?= $paymentResult['sale_title'] ?></td>   
                        <td class="align-middle"><?= $paymentResult['sale_price'] ?></td>                                        
                        <td class="align-middle"><?= $paymentResult['fullAddress'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>                              
    </div>
<?= $this->endSection() ?>