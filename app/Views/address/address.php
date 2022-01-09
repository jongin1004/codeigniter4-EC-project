<div class="form-group">
    <select class="form-control" id="address_select" name="address_id">
        <?php foreach ($addresses as $address) : ?>
            <option value="<?= $address['address_id'] ?>"><?= $address['fullAddress'] ?></option> 
        <?php endforeach; ?>                            
    </select>
</div>