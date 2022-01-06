<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="py-7 row">
        <div class="col-8">
            <div class="d-flex flex-column p-3 bg-white rounded shadow-sm" style="min-height: 600px;">
                <h5 class="border-bottom border-gray pb-2 mb-0">User Information</h5>
                <div class="media text-muted pt-3 flex-grow-1">                            
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>                            
                            <th scope="col" colspan="2">ユーザー情報</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">名前</th>                                                        
                                <td><?= $user['user_name'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">E-Mali</th>                                                        
                                <td><?= $user['user_email'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">아바타</th>                                                        
                                <td><img src="<?= "images/".$user['avatar_title'] ?>" alt="아바타를 설정해주세요."></td>
                            </tr>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>

        <div class="col-4">
            <?= $this->include('layout/dashboardSide') ?>
        </div>
    </div>
    
<?= $this->endSection() ?>