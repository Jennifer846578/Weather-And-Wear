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
        <x-navbar></x-navbar>
        <!-- Tombol Back -->
        <div class="back-button" onclick="window.location.href='/wardrobe'">
            <img src="{{ asset('Asset/Wardrobe/Blazer/back-arrow.png') }}" alt="Back">
        </div>

        <img src="{{ asset('Asset/Wardrobe/Blazer/Blazer.jpg') }}" class="photo-atas">
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
    
    <script src="/js/successNotification.js"></script>
    {{-- <script src="/js/blazer.js"></script> --}}
    {{-- <button onclick="submitForm()">Submit</button> --}}

    <script>
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
        inputDataOne.name = "favourite";
        inputDataOne.value = value;
        form.appendChild(inputDataOne);

        document.body.appendChild(form);
        form.submit();
    }
    let favButtons=document.querySelectorAll('img[alt*="like"]');
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
            }
        })
    }


    
    </script>

</body>
</html>
