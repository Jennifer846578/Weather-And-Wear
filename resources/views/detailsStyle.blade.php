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
        <a onclick="back()">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Add Clothes to Wardrobe</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" alt="Preview Image" style="width: 300px; height: auto;" src="Asset/Wardrobe/Images/{{ $data->imagePath }}">
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
<script>

    function back(){
        let form = document.createElement("form");
        form.method = "POST";
        let categories=['Cargo','Jeans','Jogger','Legging','Shorts','Skirt','Trousers']
        if(categories.includes(@json($data->category))){
            form.action = "{{ route('backdetailsBottom') }}";
        }else{
            form.action = "{{ route('backdetailsTop') }}";
        }

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
        testInput.value = @json($data->id);
        form.appendChild(testInput);

        document.body.appendChild(form);
        form.submit();
    }

    function sendToController(id,style) {
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('detailSave') }}"; // Replace with your route name

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

        let testInputOne = document.createElement("input");
        testInputOne.type = "hidden";
        testInputOne.name = "style";
        testInputOne.value = style;
        form.appendChild(testInputOne);

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
</html>
{{-- <script src="js/details.js"></script> --}}
