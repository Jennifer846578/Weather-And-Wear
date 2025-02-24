<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Clothes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link rel="stylesheet" href="css/detail.css">
</head>
<body>
    <div class="backbutton">
        <a onclick="BackToWardrobe()">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        {{-- <img id="PreviewImage" class="PreviewImage" alt="Preview Image" style="width: 250px;" src="{{ asset('Asset/Wardrobe/Images/'.$data->imagePath) }}"> --}}

        <img class="PreviewImage" alt="Preview Image" style="width: 250px;" src="{{ asset('Asset/Wardrobe/Images/'.$dataCopy->imagePath) }}">
    </div>

    
    <div class="changeClothesWrapper">
        <div class="iconChangeClothes">
            <img src="Asset/Wardrobe/Edit Clothes/change clothes.png" width="33px">
        </div>
        {{-- <div class="changeClothes">
            <p>Change Clothes</p>
        </div> --}}
        
        <button class="changeClothes" style="border: none;">
            <input type="text" value="{{ $data->id }}" name="id" style="display: none;">
            <input type="text" value="{{ $dataCopy->id }}" name="id" style="display: none;">
            <input type="file" id="FileInput" accept="image/*" name="image" style="opacity: 0;z-index:100;position: absolute;">
            <label for="FileInput" style="cursor: pointer" style="margin-left: -100px;position: absolute;"><p>Change Clothes</p></label>
        </button>
    </div>
    


    <div class="removeClothesWrapper" onclick="confirmRemoveClothes()">
        <div class="removeClothes">
            <p>Remove Clothes</p>
        </div>
        <div class="iconRemoveClothes">
            <img src="Asset/Wardrobe/Edit Clothes/delete clothes.png" width="27px">
        </div>
    </div>

    <!-- Pop-up Confirmation -->
    <div id="popupConfirm" class="popup">
        <div class="popup-content">
            <h1>Are you sure you want to remove this clothes?</h1>
            <p>This action can not be undone</p>
            <button class="btn-cancel" onclick="closePopup()">Cancel</button>
            <button class="btn-remove" onclick="removeClothWardrobe({{ $data->id }},{{ $dataCopy->id }})">Remove</button>
        </div>
    </div>

    {{-- <div class="continue">
        <button type="button" id="continue-btn" disabled onclick="redirectToPageBlazer()">Continue</button>
    </div> --}}

    <h1 class="h1_editClothes">Edit Clothes</h1>

    <div class="-color-picker-container">
        <h2>Select your clothes color</h2>
        <div class="-color-area" id="ColorArea"></div>
        <input type="range" class="-color-slider" id="ColorSlider" min="0" max="360" value="360">
        <div class="-color-display" id="ColorDisplay"></div>
        <div class="-hex-display" id="HexDisplay">HEX: {{ $data->color }}</div>
        <p class="value" style="display: none;">{{ $data->color }}</p>
    </div>
    
    
    <div class="bottomtop" >
        <p>Top or Bottom</p>
        <div class="picktopbot">
            
            <label for="top" class="labeltop">
                <input type="radio" id="top" name="top" value="top">
                <img src="Asset/detail/top.png" alt="Top"zx class="top">
            </label>
            <label for="bottom">
                <input type="radio" id="bottom" name="top" value="bottom">
                <img src="Asset/detail/bot.png" alt="Bottom" class="bottom">
            </label>
            <input type="text" value="{{ $data->id }}" name="id" style="display: none;">
            <input type="text" value="{{ $dataCopy->id }}" name="id" style="display: none;">
        </div>
    </div>
    <div class="continue" style="margin: auto;">
        <button type="submit" id="uploadBtn">Continue</button>
    </div>
    

    {{-- <div class="continue">
        <button type="submit" onclick="window.location.href='detailsTop'">Continue</button>
    </div> --}}

    </form>
    <script src="js/editClothes.js"></script>
    <script src="js/color.js"></script>
    <script>

        function BackToWardrobe(){
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('deleteDataCopy') }}"; // Laravel route for handling uploads
            form.enctype = "multipart/form-data"; // Important for file uploads

            // Add CSRF Token (for Laravel security)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            let inputData = document.createElement("input");
            inputData.type = "hidden";
            inputData.name = "id";
            inputData.value = @json($data->id);
            form.appendChild(inputData);

            let inputDataCopy = document.createElement("input");
            inputDataCopy.type = "hidden";
            inputDataCopy.name = "idCopy";
            inputDataCopy.value = @json($dataCopy->id);
            form.appendChild(inputDataCopy);

            document.body.appendChild(form);
            form.submit();
        }

        document.getElementById("uploadBtn").addEventListener("click", function() {
            // console.log('udh bang')
            const fileInput = document.getElementById("FileInput");
            const file = fileInput.files[0]; // Get the selected file


            // Create a new form element
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('GetTopBottomEdit') }}"; // Laravel route for handling uploads
            form.enctype = "multipart/form-data"; // Important for file uploads

            // Add CSRF Token (for Laravel security)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            let methodInput = document.createElement("input");
            methodInput.type = "hidden";
            methodInput.name = "_method";
            methodInput.value = "PUT";
            form.appendChild(methodInput);

            let inputData = document.createElement("input");
            inputData.type = "hidden";
            inputData.name = "id";
            inputData.value = @json($data->id);
            form.appendChild(inputData);

            let inputDataCopy = document.createElement("input");
            inputDataCopy.type = "hidden";
            inputDataCopy.name = "idCopy";
            inputDataCopy.value = @json($dataCopy->id);
            form.appendChild(inputDataCopy);

            let inputColor = document.createElement("input");
            inputColor.type = "hidden";
            inputColor.name = "color";
            inputColor.value = document.querySelector('p.value').innerHTML
            form.appendChild(inputColor);

            // Create file input and append the selected file
            let imageInput = document.createElement("input");
            imageInput.type = "file";
            imageInput.name = "image"; // Laravel will receive this as $request->image
            if (!file) {
                imageInput.files = null; // Assign the selected file
            }else{
                imageInput.files = fileInput.files; // Assign the selected file
            }
            form.appendChild(imageInput);

            const selectedRadio = document.querySelector('input[name="top"]:checked');
            if (!selectedRadio) {
                alert("Please select an option (Top or Bottom) before proceeding!");
                return;
            }
            let radioInput = document.createElement("input");
            radioInput.type = "hidden";
            radioInput.name = "option"; // Laravel will receive this as $request->selected_option
            radioInput.value = selectedRadio.value;
            form.appendChild(radioInput);

            // Append form to body and submit
            document.body.appendChild(form);
            form.submit();
            // console.log(form)
        });


        document.getElementById('FileInput').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file
            if (file) {
                const reader = new FileReader(); // Create a file reader
                reader.onload = function(e) {
                    const img = document.querySelector('img.PreviewImage');
                    img.src = e.target.result; // Set the image source to the selected file
                    img.style.display = 'block'; // Make the image visible
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });

        // document.querySelector('input#FileInput').addEventListener('change',function(){
        //     if(this.files.length>0){
        //         document.querySelector('form.submitlah').submit();
        //     }
        // })
        // console.log(@json($data->id));
        function removeClothWardrobe(id,idCopy){
            console.log(id)
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('deleteWardrobeClothes') }}"; // Replace with your route name

            // Add CSRF Token (required for Laravel POST requests)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            let methodInput = document.createElement("input");
            methodInput.type = "hidden";
            methodInput.name = "_method";
            methodInput.value = "DELETE";
            form.appendChild(methodInput);

            // Optional: Add additional data as hidden inputs
            let inputData = document.createElement("input");
            inputData.type = "hidden";
            inputData.name = "id";
            inputData.value = id;
            form.appendChild(inputData);

            let inputDataCopy = document.createElement("input");
            inputDataCopy.type = "hidden";
            inputDataCopy.name = "idCopy";
            inputDataCopy.value = idCopy;
            form.appendChild(inputDataCopy);

            document.body.appendChild(form);
            form.submit();
        }


        // Get the color display element

    </script>

</body>
</html>
