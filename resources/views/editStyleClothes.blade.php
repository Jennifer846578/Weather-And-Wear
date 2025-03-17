<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="css/detail.css">

</head>
<body>
    <div class="backbutton">
        <a onclick="BackToWardrobe()">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Edit Clothes</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" alt="Preview Image" style="width: 300px; height: auto;" src="Asset/Wardrobe/Images/{{ $dataCopy->imagePath }}">
    </div>

    <div class="categoryBox">
        <h2>What are your clothes style?</h2>
        <div class="categories">
          <button class="category-btn"><p>🧢</p> <p class="pcategory">Casual</p></button>
          <button class="category-btn"><p>👨‍💼</p> <p class="pcategory">Formal</p></button>
          <button class="category-btn"><p>‍♀️</p> <p class="pcategory">Sporty</p></button>
          <button class="category-btn"><p>🛹</p> <p class="pcategory">Streetwear</p></button>
          <button class="category-btn"><p>🎞️</p> <p class="pcategory">Vintage</p></button>
        </div>
        <div class="continue">
            <button type="button" id="continue-btn" disabled value={{ $data->id }}>Continue</button>
        </div>
    </div>

</body>
</form>
<script>

    function BackToWardrobe(){
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('ReturnTopBottomEdit') }}"; // Laravel route for handling uploads
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



        // Create file input and append the selected file


        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
    }

    function sendToController(id,style) {
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('editStyleDone') }}"; // Replace with your route name
        form.enctype = "multipart/form-data";

        // Add CSRF Token (Required for Laravel POST requests)
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

        // Add test variable input
        let testInput = document.createElement("input");
        testInput.type = "hidden";
        testInput.name = "id";
        testInput.value = id;
        form.appendChild(testInput);

        let testCopyInput = document.createElement("input");
        testCopyInput.type = "hidden";
        testCopyInput.name = "idCopy";
        testCopyInput.value = @json($dataCopy->id);
        form.appendChild(testCopyInput);

        let inputFav = document.createElement("input");
        inputFav.type = "hidden";
        inputFav.name = "favourite";
        inputFav.value = @json($favourite);
        form.appendChild(inputFav);

        let inputStyle = document.createElement("input");
        inputStyle.type = "hidden";
        inputStyle.name = "style";
        inputStyle.value = style;
        form.appendChild(inputStyle);

        document.body.appendChild(form);
        form.submit();
    }


    let buttons = document.querySelectorAll('button.category-btn');
    for(let i=0;i<buttons.length;i++){
        buttons[i].addEventListener('click',function(){
            for(let ii=0;ii<buttons.length;ii++){
                if(ii!=i){
                    buttons[ii].classList.remove('active');
                }else{
                    if(buttons[ii].classList.contains('active')){
                        buttons[ii].classList.remove('active');
                        document.querySelector('button#continue-btn').disabled=true;
                    }else{
                        buttons[ii].classList.add('active');
                        document.querySelector('button#continue-btn').disabled=false;
                    }
                }
            }
        })
    }

    document.querySelector('div.continue button#continue-btn').addEventListener('click',function(){
        for(let i=0;i<buttons.length;i++){
            if(buttons[i].classList.contains('active')){
                sendToController(document.querySelector('div.continue button#continue-btn').value,buttons[i].querySelector('p.pcategory').innerHTML);
                break;
            }
        }
    })
</script>
{{-- <script src="js/editClothes.js"></script> --}}
