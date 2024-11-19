<div class="slider-container position-relative">
    <!-- Background Image -->
    <img src="./assets/images/slider/main-2.jpg" alt="Background Image" class="img-fluid slider-background">

    <!-- Slider Content -->
    <div class="slider-content text-white text-center">
        <h2>BOOKTOPIA</h2>
<br>
        <h2>Mua sẵm ngay hôm nay để được nhận giá ưu đãi</h2>
<br>
        <div class="mt-3">
            <a class="btn btn-primary px-4 py-2" href="shop.php">Mua sách ngay bây giờ</a>
        </div>
    </div>
</div>

<style>
/* Container tổng */
.slider-container {
    position: relative;
    width: 100%; /* Chiếm toàn bộ chiều rộng */
    height: 100vh; /* Chiều cao chiếm toàn màn hình */
    overflow: hidden;
}

/* Hình nền phía sau */
.slider-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
    filter: brightness(70%); /* Làm tối ảnh để chữ nổi bật */
    z-index: 0;
}

/* Nội dung chữ trên ảnh */
.slider-content {
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Canh giữa cả chiều ngang lẫn dọc */
    z-index: 1;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Bóng chữ nhẹ hơn để chữ sáng rõ hơn */
    filter: brightness(1.3); /* Tăng độ sáng cho chữ */
}

/* Tùy chỉnh các tiêu đề */
.slider-content h5 span {
    color: #ffd700; /* Vàng để nổi bật */
    font-weight: bold;
}

.slider-content h2,
.slider-content h3,
.slider-content h4 {
    color: white;
    margin: 10px 0;
    filter: brightness(1.3); /* Tăng độ sáng cho toàn bộ chữ */
}

/* Nút nhấn */
.btn-primary {
    color: white;
    background-color: #cda557;
    border-color: #cda557;
    transition: all 0.3s ease;
    font-size: 28px;;
}

.btn-primary:hover {
    color: white;
    background-color: #b08c47;
    border-color: #b08c47;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}
</style>
