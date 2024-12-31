<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blazer</title>
    <link rel="stylesheet" href="{{ asset('css/blazer.css') }}">
</head>
<body>
    <div class="phone-card">
        {{-- <x-navbar></x-navbar> --}}
        <!-- Tombol Back -->
        <div class="back-button" onclick="goBack()">
            <img src="{{ asset('Asset/Wardrobe/Blazer/back-arrow.png') }}" alt="Back">
        </div>

        <img src="{{ asset('Asset/Wardrobe/Blazer/Blazer Photo.avif') }}" class="">
        <div class="clothes-wrapper-luar">
            <div class="clothes-wrapper">
                <div class="judul-dan-fav-icon">
                    <h1>Blazer</h1>
                    <div id="btn">
                        <img id="no" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                        <img id="yes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                    </div>
                </div>
                <p>A blazer is a tailored jacket, versatile for both formal and semi-casual settings, often styled with trousers or jeans.</p>
                <hr>

                <div class="style-filter">
                    <select id="style">
                        <option value="All">All</option>
                        <option value="Casual">Casual</option>
                        <option value="Formal">Formal</option>
                        <option value="Sporty">Sporty</option>
                        <option value="Streetwear">Streetwear</option>
                        <option value="Vintage">Vintage</option>
                    </select>
                </div>

                <div class="clothes-list">
                    <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/Blazer.png') }}" class="category-icon-image">
                        </div>
        
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer1.png') }}" class="category-icon-image">
                        </div>
                    </div>

                    <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer2.png') }}" class="category-icon-image">
                        </div>
        
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer3.png') }}" class="category-icon-image">
                        </div>
                    </div>

                    <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer4.png') }}" class="category-icon-image">
                        </div>
        
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer5.png') }}" class="category-icon-image">
                        </div>
                    </div>

                    <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer6.png') }}" class="category-icon-image">
                        </div>
        
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer7.png') }}" class="category-icon-image">
                        </div>
                    </div>

                    <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer8.png') }}" class="category-icon-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Scroll to Top -->
        <div class="scroll-top-button" onclick="scrollToTop()">
            <img src="{{ asset('Asset/Wardrobe/Blazer/up-arrow.png') }}" alt="Scroll to Top">
        </div>
    </div>
    <script src="/js/blazer.js"></script>
</body>
</html>