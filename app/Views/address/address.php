<div class="form-group">
    <select class="form-control" id="address_select">
        <?php foreach ($addresses as $address) : ?>
            <option><?= $address['fullAddress'] ?></option> 
        <?php endforeach; ?>                            
    </select>
</div>