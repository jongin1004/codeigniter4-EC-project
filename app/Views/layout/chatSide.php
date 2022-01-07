<div class="list-group">
  <?php foreach ($chatTarget as $to_user) : ?>
    <a href="<?= base_url('chat/'.$to_user['to_id']) ?>" class="list-group-item list-group-item-action"><?= $to_user['user_name'] ?></a>  
  <?php endforeach; ?>
</div>