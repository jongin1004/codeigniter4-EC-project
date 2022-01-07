<div class="media text-muted pt-3">
    <div class="mr-2">
        <img src="<?= base_url('images/'.$chat['avatar_title']) ?>" style="width: 32px; height: 32px;">
    </div>

    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
            <strong class="text-gray-dark"><?= $chat['user_name'] ?></strong>
            <small><?= $chat['created_at'] ?></small>
        </div>
        <span class="d-block"><?= $chat['chat_message'] ?></span>
    </div>
</div>