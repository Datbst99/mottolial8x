<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$product->name}}</title>
    <meta name="robots" content="noindex">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendors/slick/slick.css" type="text/css" >
    <link rel="stylesheet" href="/assets/vendors/awesome/css/all.css" type="text/css" >
    <link rel="stylesheet" href="{{mix('/assets/css/client/detail.css')}}">
</head>
<body>
<?php
$firstProduct = $product->firstClassify()
?>
    <div>
        <div class="slider-section">
            <div class="slider">
                @foreach($product->classify as $classify)
                    <img src="{{$classify->thumbnail}}" alt="{{$classify->name}}">
                @endforeach
            </div>
            <div class="slider__counter">
                1/{{count($product->classify)}}
            </div>
        </div>
        <div class="content">
            <div class="box-item">
                <div class="sale-price">{{number_format($firstProduct->sale_price)}}đ</div>
                <div class="">
                    <span class="price">{{number_format($firstProduct->price)}}đ</span>
                    <span class="ratio-price"> {{round($firstProduct->sale_price / $firstProduct->price * 100, 0)}}% </span>
                </div>
                <div class="name-product">
                    {{$product->name}}
                </div>
                <div class="amount">
                    {{number_format($product->classifyAmount())}} đã được bán
                </div>
            </div>
            <div class="line-box"></div>
            <div class="classify box-item">
                <div class="text-classify">Chọn các tùy chọn</div>
                <div class="color-classify showPopJs"> Màu sắc kích cỡ <i class="fal fa-angle-right icon-arrow"></i> </div>
            </div>
            <div class="line-box"></div>
            <div class="d-flex box-item">
                <img src="/assets/images/shop.png" alt="" class="shop-img">
                <div style="margin-left: 10px; margin-top: 5px">
                    HUSSIO
                    <p class="m-0" style="font-size: 12px; color: rgba(22, 24, 35, 0.5);">
                        52 sản phẩm
                    </p>
                </div>
            </div>
            <div class="line-box"></div>
            <div class="description">
                <div class="text-description">Mô tả sản phẩm</div>
                {!! $product->description !!}
            </div>
        </div>
    </div>

    <div id="order">
       <div class="order-bottom">
           <div style="width: 20%; ;text-align: center" class="comment">
               <i class="fal fa-store" style="margin-right: 5px"></i>
               <i class="far fa-comments"></i>
           </div>
           <div style="width: 75%">
               <div class="btn-submit showPopJs">
                   Mua ngay
               </div>
           </div>
       </div>
    </div>

    <div id="popup-show-product">
        <form action="{{route('order')}}" method="post">
            @csrf
            <input type="text" name="classify" style="display: none" class="classifyItem" value="{{$firstProduct->id}}">

            <div class="box-item box-show-js">
                <div >
                    <div class="wp-price">
                        <img src="{{$firstProduct->thumbnail}}" alt="{{$firstProduct->name}}" class="select-image">
                        <div class="show-price">
                            <div>
                                <div class="sale-price" id="saleJs">{{number_format($firstProduct->sale_price)}}đ</div>
                                <div class="">
                                    <span class="price" id="priceJs">{{number_format($firstProduct->price)}}đ</span>
                                    <span class="ratio-price" id="ratioJs"> {{round($firstProduct->sale_price / $firstProduct->price * 100, 0)}}% </span>
                                </div>
                            </div>
                            <div class="color">
                                <span class="color-name">{{$firstProduct->name}}</span> <span class="color-size"></span>
                            </div>
                        </div>

                    </div>
                    <div style="margin-right: 10px" class="hide-popup">
                        <i class="far fa-times"></i>
                    </div>
                </div>
                <div class="wp-images">
                    <div class="title-classify">
                        Màu sắc
                    </div>
                    <div class="product-classify">
                        @foreach($product->classify as $classify)
                            <div onclick="renderImage('{{$classify->thumbnail}}', {{$classify->price}}, {{$classify->sale_price}}, {{$classify->id}})">
                                <input type="radio" name="color" value="{{$classify->name}}" id="color-{{$classify->name}}" class="d-none check-size" @if($loop->first) checked @endif >
                                <label for="color-{{$classify->name}}" class="thumbnail-classify ">
                                    <img src="{{$classify->thumbnail}}" alt="{{$classify->name}}" class="pop-image">
                                    <p class="text-color">{{$classify->name}}</p>
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="wp-size">
                    <div class="title-classify">
                        Kích cỡ
                    </div>
                    <div class="size-product">
                        <div class="group">
                            <input type="radio" name="size" value="M" id="size-m" class="d-none check-size" checked>
                            <label for="size-m" class="border-size">
                                M
                            </label>
                        </div>
                        <div class="group">
                            <input type="radio" name="size" value="L" id="size-l" class="d-none check-size">
                            <label for="size-l" class="border-size">
                                L
                            </label>
                        </div>
                        <div class="group">
                            <input type="radio" name="size" value="Xl" id="size-xl" class="d-none check-size">
                            <label for="size-xl" class="border-size">
                                XL
                            </label>
                        </div>
                    </div>
                </div>
                <div class="wp-quantity">
                    <div class="title-classify m-0">
                        Số lượng
                    </div>
                    <div>
                        <span class="input-number-decrement">–</span><input class="input-number" name="amount" type="text" value="1" min="0" max="10"><span class="input-number-increment">+</span>
                    </div>
                </div>
                <div class="info-user">
                    <div class="group-control">
                        <label for="" class="title-classify">Tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="group-control">
                        <label for="" class="title-classify">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <button class="btn-submit" type="submit">
                    Đặt hàng ngay
                </button>
            </div>
        </form>
    </div>
@if ($message = Session::get('success'))
    <script>
        alert('Đặt hàng thành công')
    </script>
@endif


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/assets/vendors/slick/slick.js"></script>
    <script>

        function renderImage(img, price, sale, id) {
            document.getElementsByClassName('select-image')[0].setAttribute("src", img)
            document.getElementById('saleJs').innerText =  formatNumber(sale)+ 'đ'
            document.getElementById('priceJs').innerText =  formatNumber(price) + 'đ'
            document.getElementById('ratioJs').innerText = (Math.ceil(sale / price * 100)).toFixed().replace(/\d(?=(\d{3})+\.)/g, ',') + '%'
            $('.classifyItem').val(id)
        }

        function formatNumber(number){
            return new Intl.NumberFormat('ja-JP', {
                style: 'currency',
                currency: 'JPY',
                currencyDisplay: "code"
            })
                .format(number)
                .replace("JPY", "")
                .trim()
        }

        jQuery(document).ready(function($) {
            $('.slider').slick({
                arrows: false,
                autoplay: true,
            });

            var $status = $('.slider__counter');
            var $slickElement = $('.slider');

            $slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
                //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
                var i = (currentSlide ? currentSlide : 0) + 1;
                $status.text(i + '/' + slick.slideCount);
            });
            $('.showPopJs').click(function () {
                $('#popup-show-product').css('display', 'block')
                $('#popup-show-product .box-show-js').animate({
                    height : "70%"
                }, 100)
            });

            $("input[name='size']").change(function () {
                $('.color-size').text(', ' + $("input[name='size']:checked").val())
            })
            $("input[name='color']").change(function () {
                $('.color-name').text($("input[name='color']:checked").val())
            })

            $('.hide-popup').click(function () {
                $('#popup-show-product .box-show-js').animate({
                    height : "0"
                }, 100)
                $('#popup-show-product').hide()
            })

            $("#popup-show-product").click(function(event) {
                var $target = $(event.target);
                if(!$target.closest('.box-show-js').length &&
                    $('.box-show-js').is(":visible")) {
                    $('.box-show-js').animate({
                        height : "0"
                    }, 100)
                    $('#popup-show-product').hide();
                }
            });
        })



    </script>
    <script>
        (function() {

            window.inputNumber = function(el) {

                var min = el.attr('min') || false;
                var max = el.attr('max') || false;

                var els = {};

                els.dec = el.prev();
                els.inc = el.next();

                el.each(function() {
                    init($(this));
                });

                function init(el) {

                    els.dec.on('click', decrement);
                    els.inc.on('click', increment);

                    function decrement() {
                        var value = el[0].value;
                        value--;
                        if(!min || value >= min) {
                            el[0].value = value;
                        }
                    }

                    function increment() {
                        var value = el[0].value;
                        value++;
                        if(!max || value <= max) {
                            el[0].value = value++;
                        }
                    }
                }
            }
        })();

        inputNumber($('.input-number'));
    </script>
</body>
</html>
