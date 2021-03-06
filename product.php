<?php 
  include 'database.php';
  $image_id = $_GET['id'];
  $sql = "SELECT image_link FROM image WHERE id = $image_id ";
  $result = mysqli_query($conn,$sql);
  while ($r = mysqli_fetch_array($result))
  {
    $image_link = $r["image_link"];
    $image_link = explode(",", $image_link);
  }
  $sql = "SELECT * FROM product WHERE id = $image_id ";
  $result = mysqli_query($conn,$sql);
  while ($r = mysqli_fetch_array($result))
  {
    $id = $r["id"];
    $name = $r["name"];
    $price_=$r["price"];
    $symbol = 'đ';
    $symbol_thousand = '.';
    $decimal_place = 0;
    $price = number_format($r["price"], $decimal_place, '', $symbol_thousand).$symbol;
    if($r["price"] == "0")
    {
      $price = "Liên hệ mua hàng";
    }
    $brand = $r["brand"];
    $color = $r["color"];
    $color = explode(",", $color);
    $sl = $r["amount"];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    
    <title>Menu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/css/product.css">
    <link rel="stylesheet" type="text/css" href="css/css/comment.css">
  </head>
  <body>
  <?php  
    include 'header.php';
    if(isset($_SESSION['cart'][$id]))
    {
	      $sl = $sl - $_SESSION['cart'][$id];
    }
  ?>
  
    <div class="container clearfix">
      <div class="row">
        <div class="col-md-5 col-xs-12">
          <div class="product-image product-main-image">
            <div class="slider-wrap">
              <div class="pd_slide nopadding">
                <div class="slide">
                  <img itemprop="photos" src="<?=$image_link[0]?>" alt="">
                </div>
              </div> 
              <div class="pd_slide_thumb owl-carousel owl-theme ega-product-img-carousel owl-loaded owl-drag">
                <div class="owl-stage-outer">
                  <div class="owl-stage">

                    <?php
                      for($i=0;  $i < count($image_link); $i = $i + 1)
                      { 
                    ?>
                    <div class="owl-item active" style="width: 82.4px;">
                      <div class="slide">
                        <div class="img">
                          <img class="ega-product-img" alt="" index="0" src="<?=$image_link[$i]?>">
                        </div>
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
                <div class="owl-dots disabled"></div>
              </div>
            </div> <!---->
          </div>
        </div>

        <div class="col-md-4 col-xs-6 pd_desc_wrapper">
          <div class="product-desc">
            <div class="page_title">
              <h1 itemprop="name">
                <?=$name?>
              </h1>
              <span class="id_product">Mã SP: <?=$id?></span> 
              <span class="product_vendor">
                Thương hiệu:
                <a href="" title="<?=$brand?>"><?=$brand?></a>
              </span>
            </div>
            <div class="pd_sale_wrapper clearfix">
              <div class="product-price">
                <ins itemprop="<?=$price_?>"><?=$price?></ins> <!----> <!---->
              </div> 
              <div class="clear"></div> 
              <div class="line"></div> 
                <div class="row">
                  <div class="col-xs-12 options_picker color" style="position: relative;">
                    <h6 class="options_header">Màu sắc</h6>
                    <ul>
                      <?php
                        for($i=0;  $i < count($color); $i = $i + 1)
                        { 
                          if($i == 0)
                          {
                      ?>
                            <li class="selected">
                              <span><?=$color[$i]?></span>
                            </li>
                      <?php
                          }
                          else
                          {
                      ?>
                            <li class="">
                              <span><?=$color[$i]?></span>
                            </li>
                      <?php
                        }
                      }
                      ?>
                    </ul>
                  </div>
                  
                </div> 
                <div class="quantity_title">
                  <label class="nomargin">Số lượng: </label>
                </div> 
                <div class="quantity clearfix product-quantity">
                  <input type="button" value="-" class="minus"> 
                  <input type="text" id="product_quantity" min="1" name="quantity" value="1" title="Qty" size="4" class="qty"> 
                  <input type="button" value="+" class="plus">
                </div> 
                <div class="clear"></div> 
                <?php
                  if($sl != 0)
                  {
                ?>
                    <button type="" data-role="addtocart" class="col-xs-12 button buynow">
                        MUA NGAY
                        <span style="font-size: 12px;">Giao tận nơi hoặc nhận ở cửa hàng</span>
                    </button>
                <?php
                  }
                  else
                  {
                ?>
                    <button type="" class="col-xs-12 btn_noproduct button">
                        CHÁY HÀNG
                        <span style="font-size: 12px;">Liên hệ sau</span>
                    </button>
                <?php    
                  }
                ?>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-xs-6 pd_policies_wrapper">
          <div class="pd_policies style_2">
            <div class="pd_policies_title">
              <h5>
                CHÍNH SÁCH BÁN HÀNG
              </h5> 
              <span>Áp dụng cho từng ngành hàng</span>
            </div> 
            <ul class="unstyled">

                <li data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="clearfix">
                  <a href="chinh-sach-giao-hang.php">
                    <img src="//bizweb.dktcdn.net/100/160/934/themes/599978/assets/pd_policies_1.png?1512385957126" alt="pd_policies_title_1"> 
                    <div class="policies_tit"> MIỄN PHÍ VẬN CHUYỂN</div> 
                    <div class="policies_descrip"> Quý khách sẽ chọn trong 3 mốc giao hàng: Trước 11 giờ, trước 16 giờ và trước 20 giờ mỗi ngày</div>
                  </a>
                </li> 

                <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Đổi trả miễn phí trong 7 ngày" class="clearfix">
                  <a href="chinh-sach-doi-tra.php">
                    <img src="//bizweb.dktcdn.net/100/160/934/themes/599978/assets/pd_policies_2.png?1512385957126" alt="pd_policies_title_2"> 
                    <div class="policies_tit"> ĐỔI TRẢ MIỄN PHÍ</div> 
                    <div class="policies_descrip"> Đổi trả miễn phí tận nhà hoặc tại hệ thống cửa hàng của chúng tôi. Trong trường hợp không có hàng thì hoàn tiền 100%</div>
                  </a>
                </li> 

                <li data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="clearfix">
                  <a href="huong-dan-thanh-toan.php">
                    <img src="//bizweb.dktcdn.net/100/160/934/themes/599978/assets/pd_policies_3.png?1512385957126" alt="pd_policies_title_3"> 
                    <div class="policies_tit"> THANH TOÁN</div> 
                    <div class="policies_descrip"> Thanh toán tại hệ thống cửa hàng, thanh toán khi nhận hàng hoặc Thanh toán bằng thẻ ATM, Visa, MasterCard</div>
                  </a>
                </li>

                <li data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="clearfix">
                  <a href="tel:19001267">
                    <img src="//bizweb.dktcdn.net/100/160/934/themes/599978/assets/pd_policies_4.png?1512385957126" alt="pd_policies_title_4"> 
                    <div class="policies_tit"> HỖ TRỢ MUA NHANH</div> 
                    <div class="policies_descrip"><strong style="color: rgb(0, 197, 187); font-size: 18px;">0942419862</strong><br>
                         từ 8:30 - 22:30 mỗi ngày. Cước phí 1000đ/phút</div>
                  </a>
                </li>

            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col_md_80">
           <div class="pd_description tab_product">
            <h3 class="hidden-lg hidden-md tab_mb">
              <a>CHI TIẾT SẢN PHẨM</a> <i class="fa-caret-down fa"></i>
            </h3>
            <ul class="nav nav-tabs clearfix nav-style" role="tablist">
              <li class="active" role="presentation">
                <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">CHI TIẾT SẢN PHẨM</a>
              </li>
              <li class="" role="tablist">
                <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">HƯỚNG DẪN BẢO QUẢN</a>
              </li>
              <li class="" role="tablist">
                <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">BÌNH LUẬN / ĐÁNH GIÁ</a>
              </li>
              <li class="" role="tablist">
                <a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">CHÍNH SÁCH ĐỔI TRẢ</a>
              </li>
            </ul>

            <div class="tab-content">  
            <div role="tabpanel" class="tab-pane active" id="tab-1">
                <div id="egany-content-edit" data-id="6262142">
                  <p><strong>Điểm nổi bật</strong></p>
                  <ul>
                    <li>- Sản phẩm có xu hướng trẻ trung, màu sắc tươi mới mang đến sự năng động.</li>
                    <li>- Bao bì tinh tế, mang đến sự sang trọng, đẹp mắt, thu hút người dùng.</li>
                    <li>-	Nguyên liệu: chiết xuất tự nhiên, mang đến sự thoải mái trong cảm nhận.</li>
                    <li>-	Sản phẩm phù hợp với nhiều loại da kể cả da nhạy cảm.</li>
                  </ul>
                  </div>
              </div> 
              <div role="tabpanel" class="tab-pane active" id="tab-2">
                
              </div> 
              <div role="tabpanel" class="tab-pane" id="tab-3">       
                 <form method='POST' action="cmt-submit.php?id=<?php echo $id;?>">
                  <textarea cols='60' rows='2' name='txtcomment' class='txtcomment' placeholder='Vui lòng nhập bình luận ở đây...' style='padding-left: 10px;'></textarea><br>
                  <button type='submit' name='cmt-submit'>Bình luận</button>
                  </form>
                  <?php
                  $sql = "select * from comment where idproduct = $id";
                  $result = mysqli_query($conn,$sql);
                  while ($r = mysqli_fetch_array($result)){
                    $idcmt = $r['idcmt'];
                      $iduser = $r['iduser'];
                    $date = $r['timecmt'];
                    $comment = $r['content'];
                    $sql2 = "select * from user where iduser = $iduser";
                    $result2 = mysqli_query($conn,$sql2);
                    while ($r2 = mysqli_fetch_array($result2)){
                      $name = $r2['tenuser'];
                    }
                    ?>
                  <div class='row'>
                    <div id="comment">
                    <img src="<?php echo 'images/avatar.png'  ?>" width="50" height="50" style="float:left; margin-left: 20px; margin-top: 15px;"/>
                    <div id='inCmt'>
                    <?php
                      echo "<br><b>$name </b>";
                      echo "<br>$comment";
                      echo "<br><small>$date</small>";
                      ?>
                      </div>
                      <form method='POST' action="rep-submit.php?idcmt=<?php echo $idcmt;?>&id=<?php echo $id;?>">
                        <textarea cols='53' rows='1' name='txtreply' class='txtreply' placeholder='Vui lòng nhập phản hồi ở đây...' style='margin-left: 70px; padding-left: 10px;'></textarea><br>
                        <button type='submit' name='rep-submit' style="margin-left: 70px">Trả lời</button>
                        </form>
                      <?php
                      $sql3 = "select * from reply where idcmt = $idcmt";
                      $result3 = mysqli_query($conn,$sql3);
                      while ($row = mysqli_fetch_array($result3)){
                        $idrep = $row['idrep'];
                          $iduser2 = $row['iduser'];
                        $date2 = $row['timerep'];
                        $reply = $row['content'];
                        $sql4 = "select * from user where iduser = $iduser2";
                        $result4 = mysqli_query($conn,$sql4);
                        while ($r4 = mysqli_fetch_array($result4)){
                          $name2 = $r4['tenuser'];
                        }
                      ?>
                        <div class='row' style="margin-left: 45px;">
                        <small><div id="reply">
                          <img src="<?php echo 'images/avatar.png'  ?>" width="50" height="50" style="float:left; margin-left: 20px; margin-top: 10px;"/>
                          <div id='inRep'>
                            <?php
                            echo "<br><b>$name2 </b>";
                            echo "<br>$reply";
                            echo "<br><small>$date2</small>";
                            ?>
                          </div>
                      </div></small>
                        </div>
                  <?php
                  }
                  ?>
                </div>
                  </div>
                  <?php
                  }
                  ?>
                

              </div> 
              <div role="tabpanel" class="tab-pane active" id="tab-4">
                
                </div>  
              </div>                  
            </div>
           </div>
          </div>
      </div>  
    </div>

  <?php
    include 'footer.php';
  ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/product.js"></script>-->
    <script >
    $(document).ready(function() {
 	changeImage();
 	changeNumber();
 	var addSelectedColor = $(".color ul li");
 	var addSelectedSize = $(".size ul li");
 	addSelected(addSelectedColor);
 	addSelected(addSelectedSize);
 	$('.buynow').click(function (){
    var ton = <?php echo $sl; ?>;
    var count = "<?php echo $count; ?>";
		var id_product = $('.id_product').text();
    id_product = id_product.substr(7);
    var amount = $(".qty").val();
		if (amount > ton)
		{
			alert ("Sản phẩm này hiện không đủ số lượng");
		}
		else
	  {
      ht =1;
			$.ajax({
				url : "add-cart.php",
				type : 'post',
				dataType : 'text',
				data : {
					"id_product"  	: id_product,
					"amount"		: amount,
					"ht"		: ht
				},
				success : function(result) {
          alert("Thêm vào giỏ hàng thành công");
          location.reload();
          /* if (count ==0) 
  {
    $(".top_cart_qty").text(1);
    $(".top_cart_qty").show();
  }
  else
  {
    if (result == 1)
    {
      count = parseInt(count);
      count = count + 1;
    }
    $(".top_cart_qty").text(count);
  } */
          
				  }
			});
		}
	});
});
function changeImage(){
	$(".ega-product-img").click(function(){
		var src = $(this).attr("src");
		$("img[itemprop='photos']").attr("src",src);
	});
}
function changeNumber(){
	$(".plus").click(function(){
		var number =  $("#product_quantity").attr("value");
		var plus =  parseInt(number,10) + 1;
		$("#product_quantity").attr("value",plus);
	});
	$(".minus").click(function(){
		var number =  $("#product_quantity").attr("value");
		var minus =  parseInt(number,10) - 1;
		if(minus < 1){
			minus = 1;
		}
		$("#product_quantity").attr("value",minus);
	});
}
function removeSelected(element){
	element.removeClass("selected");
}
function addSelected(element){
	element.click(function(){
		removeSelected(element);
	 	$(this).addClass("selected");
	});
}
    </script>
  </body>
</html>
