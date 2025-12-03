<x-layout>
    <style>
.banner-img {
width: 100%;
height: 400px;
object-fit: cover;
border-radius: 10px;
}
.fav-container {
display: flex;
justify-content: space-between;
align-items: center;
margin: 40px 0;
}
.fav-items {
display: flex;
justify-content: center;
gap: 20px;
}
.watermark {
font-size: 24px;
color: rgba(0, 0, 0, 0.3);
transform: rotate(-45deg);
font-weight: bold;
}
.fav-box img {
width: 200px;
height: 200px;
object-fit: cover;
border-radius: 10px;
box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.bottom-ad img {
width: 100%;
height: 300px;
object-fit: cover;
border-radius: 10px;
margin-top: 50px;
}


</style>
</head>
<body>


<!-- IKLAN ATAS -->
<div class="top-ad">
<img src="<?= asset('/img/1.png') ?>" alt="Iklan Atas" class="banner-img">
</div>


<!-- FAVORIT DI TENGAH -->
<div class="fav-container">
<div class="fav-box">
<div class="watermark">WATERMARK</div>
<img src="<?= asset('/img/1.png') ?>" alt="Favorit 1">
</div>
<div class="fav-box">
<img src="<?= asset('/img/1.png') ?>" alt="Favorit 2">
</div>
<div class="fav-box">
<img src="<?= asset('/img/1.png') ?>" alt="Favorit 3">
</div>
<div class="fav-box">
<div class="watermark">WATERMARK</div>
<img src="<?= asset('/img/1.png') ?>" alt="Favorit 4">
</div>
</div>


<!-- IKLAN BAWAH -->
<div class="bottom-ad">
<img src="<?= asset('/img/1.png') ?>" alt="Iklan Bawah">
</div>
</x-layout>