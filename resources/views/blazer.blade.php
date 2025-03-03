<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $category }}</title> --}}
    <title>{{ Str::replace('TShirt', 'T-Shirt', $category) }}</title>
    <link rel="stylesheet" href="{{ asset('css/blazer.css') }}">
</head>
<body>
    <div class="phone-card">
        <x-navbar></x-navbar>
        <!-- Tombol Back -->
        <div class="back-button" onclick="window.location.href='/wardrobe'">
            <img src="{{ asset('Asset/Wardrobe/Blazer/back-arrow.png') }}" alt="Back">
        </div>

        <img src="{{ asset('Asset/Wardrobe/Blazer/'.$category.'.jpg') }}" class="photo-atas">
        <div class="clothes-wrapper-luar">
            <div class="clothes-wrapper">
                <div class="judul-dan-fav-icon">
                    {{-- <h1>{{ $category }}</h1> --}}
                    <h1>{{ Str::replace('TShirt', 'T-Shirt', $category) }}</h1>
                    <div id="btn">
                        <img id="no" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                        <img id="yes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                    </div>
                </div>
                <p class="details"></p>
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
                
                @if (count($results)===0)
                    <div class="BajuKosong">
                        <img src="{{ asset('Asset/Wardrobe/Blazer/no clothes.png') }}">
                        <p>You don't have any {{ Str::replace('TShirt', 'T-Shirt', $category) }}<br>in your wardrobe yet.</p>
                    </div>
                @endif
                
                <div class="clothes-list">
                    @for ($i=0;$i+2<=count($results);$i+=2)
                        <div class="two-category-wrapper">
                            <div class="category">
                                <div class="btn-fav-clothes">
                                    @if ($results[$i]->favourite=="yes")
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                                    @else
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    @endif
                                    {{-- <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like"> --}}
                                </div>
                                <div class="editIcon">
                                    {{-- <a href="{{ route('editClothes_page') }}"> --}}
                                    <a>
                                        <img src="{{ asset('Asset/Wardrobe/Blazer/edit icon.png') }}" alt="edit icon">
                                    </a>
                                </div>
                                <img src="{{ asset('Asset/Wardrobe/Images/'.$results[$i]->imagePath) }}" class="category-icon-image">
                                <p style="display: none;" class="value">{{ $results[$i]->id }}</p>
                            </div>

                            <div class="category">
                                <div class="btn-fav-clothes">
                                    @if ($results[$i+1]->favourite=="yes")
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                                    @else
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    @endif
                                    {{-- <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like"> --}}
                                </div>
                                <div class="editIcon">
                                    <a>
                                        <img src="{{ asset('Asset/Wardrobe/Blazer/edit icon.png') }}" alt="edit icon">
                                    </a>
                                </div>
                                <img src="{{ asset('Asset/Wardrobe/Images/'.$results[$i+1]->imagePath) }}" class="category-icon-image">
                                <p style="display: none;" class="value">{{ $results[$i+1]->id }}</p>
                            </div>
                        </div>   
                    @endfor
                    @if (count($results)%2)
                        <div class="two-category-wrapper">
                            <div class="category">
                                <div class="btn-fav-clothes">
                                    @if ($results[$i]->favourite=="yes")
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                                    @else
                                        <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    @endif
                                    {{-- <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                    <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like"> --}}
                                </div>
                                <div class="editIcon">
                                    <a>
                                        <img src="{{ asset('Asset/Wardrobe/Blazer/edit icon.png') }}" alt="edit icon">
                                    </a>
                                </div>
                                <img src="{{ asset('Asset/Wardrobe/Images/'.$results[count($results)-1]->imagePath) }}" class="category-icon-image">
                                <p style="display: none;" class="value">{{ $results[count($results)-1]->id }}</p>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="two-category-wrapper">
                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <div class="editIcon">
                                <a href="{{ route('editClothes_page') }}">
                                    <img src="{{ asset('Asset/Wardrobe/Blazer/edit icon.png') }}" alt="edit icon">
                                </a>
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/Blazer.png') }}" class="category-icon-image">
                        </div>

                        <div class="category">
                            <div class="btn-fav-clothes">
                                <img class="no-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/gray-heart.png') }}" alt="no like">
                                <img class="yes-fav-clothes" src="{{ asset('Asset/Wardrobe/Heart icon/red-heart.png') }}" alt="yes like">
                            </div>
                            <div class="editIcon">
                                <a href="{{ route('editClothes_page') }}">
                                    <img src="{{ asset('Asset/Wardrobe/Blazer/edit icon.png') }}" alt="edit icon">
                                </a>
                            </div>
                            <img src="{{ asset('Asset/Wardrobe/Blazer/blazer1.png') }}" class="category-icon-image">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="bottom-white"></div>
        </div>

        <!-- Tombol Scroll to Top -->
        <div class="scroll-top-button" onclick="scrollToTop()">
            <img src="{{ asset('Asset/Wardrobe/Blazer/up-arrow.png') }}" alt="Scroll to Top">
        </div>
    </div>

    <div id="notification-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <img src="{{ asset('Asset/Wardrobe/checklist.png') }}" alt="Success" style="width: 80px; height: 80px;">
                <p>Clothes successfully updated!</p>
            </div>
        </div>
    </div>
    
    {{-- <script src="/js/successNotification.js"></script> --}}
    {{-- <script src="/js/blazer.js"></script> --}}
    {{-- <button onclick="submitForm()">Submit</button> --}}

    <script>

    if(@json($editted)==="yes"){
        document.querySelector('div#notification-modal').style="display: flex;"
    }

    function closeModal(){
        window.location.href="{{ route('wardrobe_page_category',['category'=>'__category__','favourite'=>'__favourite__','style'=>'__style__','editted'=>'no']) }}".replace('__category__',@json($category)).replace('__favourite__',@json($favourite)).replace('__style__',@json($style));
    }
    
    let description={
        Blazer:"A blazer is a tailored jacket, versatile for both formal and semi-casual settings, often styled with trousers or jeans.",
        Coat:"A coat is a long outer garment, designed for warmth and style, often layered over formal or casual outfits.",
        Dress:"A dress is a one-piece garment, available in various styles, suited for both casual and elegant occasions.",
        Hoodie:"A hoodie is a cozy, hooded sweatshirt, perfect for casual wear and layering in cooler weather.",
        Jacket:"A jacket is a lightweight outerwear piece, adding warmth and style to both casual and formal looks.",
        Shirt:"A shirt is a buttoned, collared garment, suitable for professional, semi-formal, or casual styling.",
        Sweater:" A sweater is a knitted garment, providing warmth and comfort in various casual and formal settings.",
        TShirt:"A T-shirt is a short-sleeved, lightweight top, ideal for everyday casual wear and layering.",
        Cargo:"Cargo pants are relaxed-fit trousers with multiple pockets, blending functionality with casual style.",
        Jeans:"Jeans are durable, denim trousers, offering a classic, versatile look for casual and smart-casual outfits.",
        Jogger:"Joggers are soft, tapered sweatpants, combining comfort and style for lounging or active wear.",
        Legging:"Leggings are stretchy, form-fitting bottoms, perfect for layering, workouts, or casual styling.",
        Shorts:"Shorts are knee-length or shorter bottoms, designed for warm weather and casual comfort.",
        Skirt:"A skirt is a lower-body garment, available in various lengths, suitable for casual and formal wear.",
        Trousers:"Trousers are structured pants, offering a polished look for professional or smart-casual attire."
    }

    document.querySelector('p.details').innerHTML=description[@json($category)];

    console.log(@json($category));
    
    function submitEditForm(id) {
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('editClothes_page') }}"; // Replace with your route name

        // Add CSRF Token (required for Laravel POST requests)
        let csrfToken = document.createElement("input");
        csrfToken.type = "hidden";
        csrfToken.name = "_token";
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);

        // Optional: Add additional data as hidden inputs
        let inputData = document.createElement("input");
        inputData.type = "hidden";
        inputData.name = "id";
        inputData.value = id;
        form.appendChild(inputData);

        let inputFav = document.createElement("input");
        inputFav.type = "hidden";
        inputFav.name = "favourite";
        inputFav.value = @json($favourite);
        form.appendChild(inputFav);

        let inputStyle = document.createElement("input");
        inputStyle.type = "hidden";
        inputStyle.name = "style";
        inputStyle.value = @json($style);
        form.appendChild(inputStyle);

        document.body.appendChild(form);
        form.submit();
    }

    let editIcons=document.querySelectorAll('div.editIcon');
    for(let i=0;i<editIcons.length;i++){
        editIcons[i].querySelector('img').addEventListener('click',function(){
            submitEditForm(editIcons[i].parentElement.querySelector('p.value').innerHTML);
        })
    }

    function submitFavForm(id,value) {
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('wardrobe_fav') }}"; // Replace with your route name

        // Add CSRF Token (required for Laravel POST requests)
        let csrfToken = document.createElement("input");
        csrfToken.type = "hidden";
        csrfToken.name = "_token";
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);

        // Optional: Add additional data as hidden inputs
        let methodInput = document.createElement("input");
        methodInput.type = "hidden";
        methodInput.name = "_method";
        methodInput.value = "PUT";
        form.appendChild(methodInput);

        let inputData = document.createElement("input");
        inputData.type = "hidden";
        inputData.name = "id";
        inputData.value = id;
        form.appendChild(inputData);

        let inputDataOne = document.createElement("input");
        inputDataOne.type = "hidden";
        inputDataOne.name = "favouriteValue";
        inputDataOne.value = value;
        form.appendChild(inputDataOne);

        let inputFav = document.createElement("input");
        inputFav.type = "hidden";
        inputFav.name = "favourite";
        inputFav.value = @json($favourite);
        form.appendChild(inputFav);

        let inputStyle = document.createElement("input");
        inputStyle.type = "hidden";
        inputStyle.name = "style";
        inputStyle.value = @json($style);
        form.appendChild(inputStyle);

        document.body.appendChild(form);
        form.submit();
    }
    let favButtons=document.querySelectorAll('img[alt*="like"]');
    for(let i=0;i<favButtons.length;i++){
        if(@json($favourite)=="yes"){
            favButtons[0].style.opacity="0"
            favButtons[0].style.visibility="hidden"
            favButtons[1].style.opacity="1"
            favButtons[1].style.visibility="visible"
        }else{
            favButtons[1].style.opacity="0"
            favButtons[1].style.visibility="hidden"
            favButtons[0].style.opacity="1"
            favButtons[0].style.visibility="visible"
        }
    }
    for(let i=0;i<favButtons.length;i++){
        favButtons[i].addEventListener('click',function(){
            if(i>1){
                id=favButtons[i].parentElement.parentElement.querySelector('p.value').innerHTML;
                if(favButtons[i].getAttribute('alt')?.includes('yes')){
                    value="no"
                }else{
                    value="yes"
                }
                // console.log(id,value)
                submitFavForm(id,value);
            }else{
                let favourite="yes"
                if(favButtons[i].getAttribute('alt')?.includes('yes')){
                    favourite="no"
                }
                window.location.href="{{ route('wardrobe_page_category',['category'=>'__category__','favourite'=>'__favourite__','style'=>'__style__','editted'=>'no']) }}".replace('__category__',@json($category)).replace('__favourite__',favourite).replace('__style__',@json($style));
            }
        })
    }


    //setting the options
    let select = document.getElementById("style");
    let selectedValue = @json($style); // Get style from Laravel
    let optionss = Array.from(select.options);
    let selectedOption = optionss.find(option => option.value === selectedValue);
    if (selectedOption) {
        // Remove the selected option
        select.removeChild(selectedOption);
        // Insert it at the beginning
        select.insertBefore(selectedOption, select.firstChild);
        // Keep it selected
        selectedOption.selected = true;
    }

    let selectElement = document.getElementById('style');
    selectElement.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        window.location.href="{{ route('wardrobe_page_category',['category'=>'__category__','favourite'=>'__favourite__','style'=>'__style__','editted'=>'no']) }}".replace('__category__',@json($category)).replace('__favourite__',@json($favourite)).replace('__style__',selectedOption.value);
    });

    
    </script>

</body>
</html>
