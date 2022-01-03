<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <h3>集まりページ</h3>
    <form action="<?= base_url('/meeting/new') ?>" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="custom-select" name="category_id">                    
                    <?php foreach ($categories as $category) : ?>                        
                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                    <?php endforeach; ?>      
                    <option selected>category</option>              
                </select>
            </div>
            <input type="text" name="meeting_title" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1"></label>
            <textarea name="meeting_description" id="summernote"></textarea>
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?= $this->endSection() ?>