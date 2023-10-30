@section('head')
    <link rel="stylesheet" type="text/css" href="/template/admin/css/slider.css">
@endsection
@section('slide')
    <div class="slider">
        <div class="in-slider">
            <div class="list-danhmuc">
                <div class="danhmuc">
                    <div class="text-top"><i class="fas fa-bars"></i>&ensp;DANH MỤC SẢN PHẨM
                    </div>
                    <br>
                    <div class="option"><a href="danhsachsp.php?MaLoai=AO01"><i
                                class="fas fa-arrow-circle-right"></i>&ensp;Áo may
                            theo thiết kế</a>
                    </div>
                    <hr>
                    <div class="option"><a href="danhsachsp.php?MaLoai=AO02"><i
                                class="fas fa-arrow-circle-right"></i>&ensp;Áo câu
                            lạc
                            bộ</a>
                    </div>
                    <hr>
                    <div class="option"><a href="danhsachsp.php?MaLoai=GIAY01"><i
                                class="fas fa-arrow-circle-right"></i>&ensp;Giày thể
                            thao</a>
                    </div>
                    <hr>
                    <div class="option"><a href="danhsachsp.php?MaLoai=PK01"><i
                                class="fas fa-arrow-circle-right"></i>&ensp;Phụ
                            kiện</a>
                    </div>
                </div>
            </div>
            <div class="slideshow-container">
                <div class="mySlides">
                    <img class="slide-img" src="Ảnh\item7.jpg">
                </div>

                <div class="mySlides">
                    <img class="slide-img" src="Ảnh\item6.jpg">
                </div>

                <div class="mySlides">
                    <img class="slide-img" src="Ảnh\item8.jpg">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            //ẩn tất cả hình ảnh
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
@endsection
