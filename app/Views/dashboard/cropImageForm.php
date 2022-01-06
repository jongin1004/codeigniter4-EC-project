<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="py-7 row" style="height: 100vh;">
        <div class="col-8">
            <div class="d-flex flex-column p-3 bg-white rounded shadow-sm" style="min-height: 600px;">
                <h5 class="border-bottom border-gray pb-2 mb-0">Avatar 設定</h5>
                <div class="media text-muted pt-3 flex-grow-1">
                    <!-- image upload form -->
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header text-center">
                                <img src="<?= "images/".$user['avatar_title'] ?>" alt="아바타를 설정해주세요.">
                            </div>
                            <div class="card-body">
                                <input type="file" name="before_crop_image" id="before_crop_image" accept="image/*" />
                            </div>
                        </div>
                    </div>

                    <div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Crop & Resize Upload Image in PHP with Ajax</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8 text-center">
                                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                    </div>
                                    <div class="col-md-4" style="padding-top:30px;">
                                        <br />
                                        <br />
                                        <br/>
                                        <button class="btn btn-success crop_image">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="col-4">
            <?= $this->include('layout/dashboardSide') ?>
        </div>
    </div>
    

    <script>  
        $(document).ready(function(){
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                width:250,
                height:250,
                type:'circle' //square
                },
                boundary:{
                width:300,
                height:300
                }    
            });
            $('#before_crop_image').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                    url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#imageModel').modal('show');
            });
            $('.crop_image').click(function(event){
                console.log('안녕');
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajax({
                        url:"<?= base_url('fetch/cropImage') ?>",  
                        type:'POST',
                        data:{"image":response},
                        success:function(data){
                            console.log(data);
                            $('#imageModel').modal('hide');
                            alert('Crop image has been uploaded');
                            location.reload();
                        },
                        error: function(error) { // if error occured
                            console.log(error);
                        },
                    })
                });
            });
        });  
    </script>
<?= $this->endSection() ?>