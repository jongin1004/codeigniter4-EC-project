<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <h3>集まりページ</h3>
    
    <form action="<?= base_url('/meeting/'.$meeting_post['meeting_id'].'/modify') ?>" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="custom-select" name="category_id">                    
                    <?php foreach ($categories as $category) : ?>                        
                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                    <?php endforeach; ?>                                    
                </select>
            </div>
            <input type="text" name="meeting_title" class="form-control" value="<?= esc($meeting_post['meeting_title']) ?>">
        </div>
        <!-- 카테고리 검증 오류 메세지 -->
        <?php if ( isset($errors['category_id']) ) :?>
            <div class="alert alert-danger" role="alert">
                <?= var_export($errors['category_id']) ?>                
            </div>
        <?php endif; ?>

        <!-- 제목 검증 오류 메세지 -->
        <?php if ( isset($errors['meeting_title']) ) :?>
            <div class="alert alert-danger" role="alert">                
                <?= var_export($errors['meeting_title']) ?>
            </div>
        <?php endif; ?>
        

        <div class="form-group">
            <label for="exampleInputPassword1"></label>
            <textarea name="meeting_description" id="summernote"><?= esc($meeting_post['meeting_description']) ?></textarea>
        </div>  
        <!-- 검증 오류 메세지 -->     
        <?php if ( isset($errors['meeting_description']) ) :?>
            <div class="alert alert-danger" role="alert">
                <?= var_export($errors['meeting_description']) ?>                
            </div>
        <?php endif; ?> 
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?= $this->endSection() ?>