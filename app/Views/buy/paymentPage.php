<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <div class="d-flex flex-column justify-content-center py-7" style="height: 100vh;">
        <h3>決済ページ</h3>
          
        <!-- payment -->
        <div class="p-3 bg-white rounded shadow-sm">                        
            <form action="<?= base_url('buy/payment') ?>" method="post">
                <!-- adress -->
                <h6 class="border-bottom border-gray pb-2 mb-2">注所</h6>
                <?= $this->include('address/address') ?>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="inputCity">address</label>
                        <input class="form-control" id="roadFullAddr" disabled/>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip Nomber</label>
                        <input class="form-control" id="zipNo" disabled/>
                    </div>
                </div>
                <div class="mb-5">
                    <input type="button" value="注所検索" class="btn btn-primary" onclick="goPopup();">
                    <div class="btn btn-primary" id="address_btn">注所追加</div>
                </div>                
                
                <!-- coupon -->
                <h6 class="border-bottom border-gray pb-2 my-2">Coupon</h6>
                <div class="form-group">
                    <select class="form-control">
                        <option>Default select</option>
                    </select>
                </div>
                <a href="<?= base_url() ?>" class="btn btn-primary mb-5">適用</a>

                <!-- 최종금액 -->
                <h6 class="border-bottom border-gray pb-2 mb-2">金額</h6>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="d-flex list-group-item"><div class="flex-grow-1">商品金額</div><div>1</div></li>
                        <li class="d-flex list-group-item"><div class="flex-grow-1">割引金額</div><div>1</div></li>
                        <li class="d-flex list-group-item"><div class="flex-grow-1">最終金額</div><div>1</div></li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-primary my-5">決済</button>
            </form>
            

            <small class="d-block text-right mt-3">
                <a href="#">All suggestions</a>
            </small>
        </div>                              
    </div>

    <script>
        // 주소검색 API 시작
        window.onload = jusoCallBack();        

        function goPopup(){
            // 주소검색을 수행할 팝업 페이지를 호출합니다.
            // 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(https://www.juso.go.kr/addrlink/addrLinkUrl.do)를 호출하게 됩니다.
            var pop = window.open("<?= base_url('addressPopup') ?>","pop","width=570,height=420, scrollbars=yes, resizable=yes");
        }

        function jusoCallBack(roadFullAddr = null, zipNo = null){
            document.getElementById('roadFullAddr').value = roadFullAddr;
            document.getElementById('zipNo').value = zipNo;
        }
        // 주소검색 API 끝


        // 주소 저장
        let addressBtn = document.getElementById('address_btn');
        addressBtn.addEventListener('click', () => {
            this.saveAddress();
        });

        function saveAddress() {
            let fullAddress = $('#roadFullAddr').val();
            let zipNo = $('#zipNo').val();
            
            if (fullAddress === '' || zipNo === '') {
                alert('まずは、注所検索をしてください。');
                return;
            }

			let data = {
				fullAddress: fullAddress,
                zipNo: zipNo,
			}

            $.ajax({
				type: "POST",
                url: "<?php echo site_url('fetch/address'); ?>",  
				data: data,           
                success: function (data) {					
                    $('#address_select').append(data);
                    alert('注所が追加されました。上で選択してください。');
                },
                error: function(error) { // if error occured
                    console.log(error);
                },
            })
        }
    </script>
<?= $this->endSection() ?>