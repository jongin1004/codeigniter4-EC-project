<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h3>チャットページ</h3>

        <div class="row">
            <div class="col-2">
                리스트
            </div>
            <div class="col-10">
                <!-- 댓글 -->
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">コメント</h6>                    
                
                    <div class="media text-muted pt-3" style="min-height: 500px;">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">유저이름</strong>
                                <small>시간</small>
                            </div>
                            <span class="d-block">내용</span>
                        </div>                        
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <textarea id="chat_message" rows="3" style="width: 100%"></textarea>
                        <button style="width: 100px; height: 74px" class="btn btn-primary ml-2" id="comment_btn">submit</button>
                    </div>

                    <small class="d-block text-right mt-3">
                        <a href="#">All suggestions</a>
                    </small>
                </div>          
            </div>
        </div>    
    </div>

    <script>
        let commentBtn = document.getElementById('comment_btn');
        commentBtn.addEventListener('click', () => {
            this.saveComment();
        });

        function saveComment() {
			let data = {
				chat_message: $('#chat_message').val(),
                to_id: <?= $to_id ?>,
			}

            $.ajax({
				type: "POST",
                url: "<?php echo site_url('fetch/chat'); ?>",  
				data: data,           
                beforeSend: function (f) {
					// $('#spinner').html('');
                    // $('#spinner').addClass('spinner-border');
                },
                success: function (data) {
					$('#chat_message').val('');
                    $('#chatTable').append(data);
                },
                error: function(error) { // if error occured
                    console.log(error);
                },
            })
        }
    </script>
<?= $this->endSection() ?>