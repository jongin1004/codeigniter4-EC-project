<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="py-7">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-primary rounded shadow-sm">
            <img class="mr-3" src="/docs/4.6/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">集まり</h6>
                <small>人と人の繋がりの力</small>
            </div>
        </div>

        <!-- 본문 -->
        <div class="d-flex flex-column my-3 p-3 bg-white rounded shadow-sm" style="min-height: 600px;">
            <h5 class="border-bottom border-gray pb-2 mb-0"><?= esc($meeting_post['meeting_title']) ?></h5>
            <div class="media text-muted pt-3 flex-grow-1">        
                <?= $meeting_post['meeting_description'] ?>
            </div>

            <?php $session = session(); ?>
            <?php if ($session->get('user_id') === $meeting_post['user_id']) : ?>
                <div>
                    <a href="<?= base_url('/meeting/'.esc($meeting_post['meeting_id']).'/modify') ?>" class="btn btn-primary">修正</a>
                    <a href="<?= base_url('/meeting/'.esc($meeting_post['meeting_id']).'/delete') ?>" class="btn btn-danger">削除</a>
                </div>        
            <?php endif; ?>
        </div>


        <!-- 댓글 -->
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">コメント</h6>
            <div class="d-flex" style="width: 100%">
                <textarea id="comment_text" rows="3" style="width: 100%"></textarea>
                <button style="width: 100px; height: 74px" class="btn btn-primary ml-2" id="comment_btn">submit</button>
            </div>
            <?php foreach ($meeting_comments as $comment) : ?>
                <div class="media text-muted pt-3">
                    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="text-gray-dark"><?= $comment['user_name'] ?></strong>
                            <small><?= $comment['created_at'] ?></small>
                        </div>
                        <span class="d-block"><?= $comment['comment_description'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
            <div id="commentTable"></div>

            <small class="d-block text-right mt-3">
            <a href="#">All suggestions</a>
            </small>
        </div>    
    </div>

    <script>
        let commentBtn = document.getElementById('comment_btn');
        commentBtn.addEventListener('click', () => {
            this.saveComment();
        });

        function saveComment() {
			let data = {
				comment_description: $('#comment_text').val(),
                meeting_id: <?= $meeting_post['meeting_id'] ?>,
			}

            $.ajax({
				type: "POST",
                url: "<?php echo site_url('fetch/comment'); ?>",  
				data: data,           
                beforeSend: function (f) {
					// $('#spinner').html('');
                    // $('#spinner').addClass('spinner-border');
                },
                success: function (data) {
					$('#comment_text').val('');
                    $('#commentTable').append(data);
                },
                error: function(error) { // if error occured
                    console.log(error);
                },
            })
        }
    </script>
<?= $this->endSection() ?>