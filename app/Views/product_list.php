<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>	
	<div class="py-7">
		<div class="mb-2">
			<a href="<?= base_url('/meeting/new') ?>" class="btn btn-primary">集まり</a>
			<a href="<?= base_url('/sale/new') ?>" class="btn btn-primary">販売</a>
		</div>
		
		<!-- Sale Post -->
		<div class="card text-center mb-3">			
			<div class="card-body">
				<div class="row">
					<?php foreach ($sale_posts as $sale_post) : ?>
						<div class="col-4">
							<div class="card" style="width: 15rem;">
								<img src="images/orihinal.png" class="card-img-top">
								<div class="card-body">
									<div class="card-text"><?= $sale_post['sale_title'] ?></div>									
									<div class="card-text"><small><?= $sale_post['created_at'] ?></small></div>
								</div>
							</div>
						</div>		
					<?php endforeach; ?>
				</div>
			</div>			
			<a class="card-footer text-muted" href="##">
				더보기
			</a>
		</div>

		<!-- Meeting Post -->
		<div class="card text-center">
			<div class="card-body">
				<div class="row">
					<?php foreach ($meeting_posts as $meeting_post): ?>									
						<div class="col-12">
							<a href="<?= base_url('/meeting/'.$meeting_post['meeting_id']) ?>">
								<div class="card mb-3">
									<div class="row no-gutters">
										<div class="col-md-3">
											<img src="images/orihinal.png" style="width: 100%; height: 100%;">
										</div>
										<div class="col-md-9">
											<div class="card-body">
												<h5 class="card-title"><strong><?= $meeting_post['meeting_title'] ?></strong></h5>
												<p class="card-text"><?= $meeting_post['meeting_description'] ?></p>
												<p class="card-text"><small class="text-muted"><?= $meeting_post['user_id'] ?></small></p>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>					
					<?php endforeach; ?>
					<div id="meetingTable"></div>
				</div>
			</div>
			<div class="card-footer text-muted" id="more_meeting" style="cursor: pointer">
				<div id="spinner">
					더보기
				</div>
			</div>
		</div>	
	</div>

	<script>
		let meeting_post_num = <?= count($meeting_posts) ?>;
        let btn = document.getElementById('more_meeting');
        btn.addEventListener('click', ()=> {
			this.getMorePost();
        });

		

        function getMorePost() {
			let data = {
				offset: meeting_post_num,				
			}

            $.ajax({
				type: "POST",
                url: "<?php echo site_url('fetch/meeting'); ?>",  
				data: data,           
                beforeSend: function (f) {
					$('#spinner').html('');
                    $('#spinner').addClass('spinner-border');
                },
                success: function (data) {
					$('#spinner').removeClass('spinner-border');
					$('#spinner').html('더보기');
                    $('#meetingTable').append(data);
					meeting_post_num += 4;
                }
            })
        }

        // function saveMeeting() {
        //     let data = {
        //         comment: $("#comment").val(),
        //         blog_id: $("#blog_id").val(),
        //     }

        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo site_url('fetch/meeting'); ?>",
        //         data:data,
        //         beforeSend: function (f) {
        //             $('#userTable').html('Load Table ...');
        //         },
        //         success: function (data) {
        //             if (data[0] !== "<") {
        //                 alert(JSON.parse(data).error.comment);
        //             } else {
        //                 $('#userTable').html(data);
        //                 $('#comment').val('');  
        //             }
        //         },
        //         error: function(error) { // if error occured
        //             alert(error);
        //         },
        //     })
        // }
    </script>
<?= $this->endSection() ?>