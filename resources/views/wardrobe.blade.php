<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wardrobe</title>
    <link rel="stylesheet" href="css/wardrobe.css">
</head>
<body>
    <div class="phone-card">
        <x-navbar></x-navbar>
        <div class="wardrobe-header">
            <h1>Wardrobe</h1>
            <div class="wrapper-atas">
                <div class="InputFile">
                    <form action="{{ route('wardrobe_store') }}" method="POST" enctype="multipart/form-data" class="submitlahbang">
                        @csrf
                        {{-- @if ($session)
                            <p>{{ $session }} and {{ $who }}</p>
                        @endif --}}
                        <button class="inputButton">
                            <input type="file" id="FileInput" accept="image/*" name="image" >
                            <label class="inputLabel" for="FileInput">Add Clothes to Wardrobe</label>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="categories-wrapper-luar">
            <div class="categories-wrapper">
                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Blazer','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Blazer.png') }}" class="category-icon-image">
                        <p>Blazer</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Coat','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Coat.png') }}" class="category-icon-image">
                        <p>Coat</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Dress','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Dress.png') }}" class="category-icon-image">
                        <p>Dress</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Hoodie','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Hoodie.png') }}" class="category-icon-image">
                        <p>Hoodie</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Jacket','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jacket.png') }}" class="category-icon-image">
                        <p>Jacket</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Shirt','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Shirt.png') }}" class="category-icon-image">
                        <p>Shirt</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Sweater','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Sweater.png') }}" class="category-icon-image">
                        <p>Sweater</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'TShirt','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/T-Shirt.png') }}" class="category-icon-image">
                        <p>T-Shirt</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Cargo','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Cargo.png') }}" class="category-icon-image">
                        <p>Cargo</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Jeans','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jeans.png') }}" class="category-icon-image">
                        <p>Jeans</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Jogger','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jogger.png') }}" class="category-icon-image">
                        <p>Jogger</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Legging','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Legging.png') }}" class="category-icon-image">
                        <p>Legging</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Shorts','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Shorts.png') }}" class="category-icon-image">
                        <p>Shorts</p>
                    </a>

                    <a href="{{ route('wardrobe_page_category',['category'=>'Skirt','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Skirt.png') }}" class="category-icon-image">
                        <p>Skirt</p>
                    </a>
                </div>

                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe_page_category',['category'=>'Trousers','favourite'=>'no','style'=>'All','editted'=>'no']) }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Trousers.png') }}" class="category-icon-image">
                        <p>Trousers</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="notification-modal" class="modal">
        <div class="modal-content">
            <span class="close-buttoncool" onclick="closeModal()">&#10005;</span>
            <div class="modal-body">
                <img src="{{ asset('Asset/Wardrobe/checklist.png') }}" alt="Success" style="width: 80px; height: 80px;">
                <p>Clothes successfully added!</p>
            </div>
        </div>
    </div>

    <script>

        let notification=@json($notification??null);
        if(typeof notification !=='undefined' && notification !=null){
            document.querySelector('div#notification-modal').style="display: flex;"
        }

        function closeModal(){
            window.location.href="{{ route('wardrobe_page') }}";
        }

        document.querySelector('input#FileInput').addEventListener('change',function(){
            if(this.files.length>0){
                document.querySelector('form.submitlahbang').submit();
            }
        })
    </script>
    {{-- <script src="js/addFile.js"></script> --}}
</body>
</html>
