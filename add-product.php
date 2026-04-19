<?php
include("includes/navbar.php");

if(isset($_POST['name'])){
    $img = time()."_".$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/".$img);

    $xml = simplexml_load_file("xml/products.xml");

    $p = $xml->addChild("product");
    $p->addChild("id", rand(100,999));
    $p->addChild("name", $_POST['name']);
    $p->addChild("rent", $_POST['rent']);
    $p->addChild("image", $img);
    $p->addChild("contact", $_POST['contact']);
    $p->addChild("category", $_POST['category']);

    $xml->asXML("xml/products.xml");

    $success = true;
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="upload-container">

<div class="upload-box">

<h2>Add Product</h2>

<?php if(!empty($success)){ ?>
<p class="success">Product Added Successfully!</p>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

<!-- IMAGE UPLOAD -->
<div class="drop-area" id="drop-area">
    <p>Drag & Drop Image Here</p>
    <input type="file" name="image" id="fileInput" accept="image/*" required>
</div>

<img id="preview" style="display:none;">

<!-- INPUTS -->
<input type="text" name="name" placeholder="Product Name" required>
<input type="number" name="rent" placeholder="Rent per day" required>
<input type="text" name="contact" placeholder="Contact number" required>

<select name="category">
<option>Books</option>
<option>Electronics</option>
<option>Furniture</option>
<option>others</option>
</select>

<button type="submit">Add Product</button>

</form>

</div>
</div>

<script>
let dropArea = document.getElementById("drop-area");
let fileInput = document.getElementById("fileInput");
let preview = document.getElementById("preview");

// CLICK TO UPLOAD
dropArea.onclick = () => fileInput.click();

// SHOW IMAGE PREVIEW
fileInput.onchange = function(){
    let file = this.files[0];
    preview.src = URL.createObjectURL(file);
    preview.style.display = "block";
};

// DRAG & DROP
dropArea.addEventListener("dragover", (e)=>{
    e.preventDefault();
    dropArea.classList.add("active");
});

dropArea.addEventListener("dragleave", ()=>{
    dropArea.classList.remove("active");
});

dropArea.addEventListener("drop", (e)=>{
    e.preventDefault();
    fileInput.files = e.dataTransfer.files;
    preview.src = URL.createObjectURL(e.dataTransfer.files[0]);
    preview.style.display = "block";
});
</script>