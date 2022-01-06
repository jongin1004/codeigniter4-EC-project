<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h3>販売ページ</h3>
        
        <form action="<?= base_url('/sale/'.$sale_post['sale_id'].'/modify') ?>" method="post">
            <!-- sale title and category-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <select class="custom-select" name="category_id">                    
                        <?php foreach ($categories as $category) : ?>                        
                            <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                        <?php endforeach; ?>                                    
                    </select>
                </div>
                <input type="text" name="sale_title" class="form-control" value="<?= esc($sale_post['sale_title']) ?>">
            </div>
            <!-- 카테고리 검증 오류 메세지 -->
            <?php if ( isset($errors['category_id']) ) :?>
                <div class="alert alert-danger" role="alert">
                    <?= var_export($errors['category_id']) ?>                
                </div>
            <?php endif; ?>

            <!-- 제목 검증 오류 메세지 -->
            <?php if ( isset($errors['sale_title']) ) :?>
                <div class="alert alert-danger" role="alert">                
                    <?= var_export($errors['sale_title']) ?>
                </div>
            <?php endif; ?>
            
            <!-- sale state -->
            <div class="form-group">
                <label for="sale_state" class="mr-3"><strong>商品の状態</strong></label>
                <div class="custom-control custom-radio custom-control-inline" id="sale_state">
                    <input type="radio" id="sale_state1" name="sale_state" class="custom-control-input" value="b">
                    <label class="custom-control-label" for="sale_state1">best</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sale_state2" name="sale_state" class="custom-control-input" value="m">
                    <label class="custom-control-label" for="sale_state2">middle</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sale_state3" name="sale_state" class="custom-control-input" value="w">
                    <label class="custom-control-label" for="sale_state3">worst</label>
                </div>
            </div>
                    
            <div class="form-group">
                <label for="sale_price"><strong>値段</strong></label>
                <input type="text" name="sale_price" class="form-control" id="sale_price" value="<?= esc($sale_post['sale_price']) ?>">
            </div>  

            <div class="form-group">                
                <textarea name="sale_description" id="summernote"><?= esc($sale_post['sale_description']) ?></textarea>
            </div>  
            <!-- 검증 오류 메세지 -->     
            <?php if ( isset($errors['sale_description']) ) :?>
                <div class="alert alert-danger" role="alert">
                    <?= var_export($errors['sale_description']) ?>                
                </div>
            <?php endif; ?> 
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        // radio박스를 자동적으로 선택되도록 만들기 위한 script
        let sale_state = "<?= $sale_post['sale_state'] ?>";
        let radio;
        if (sale_state === 'b') {
            radio = $('#sale_state1');
        } else if (sale_state === 'm') {
            radio = $('#sale_state2');
        } else {
            radio = $('#sale_state3');
        }

        $(document).ready(function(){
            radio.attr('checked', 'checked');  
        });
    </script>
<?= $this->endSection() ?>