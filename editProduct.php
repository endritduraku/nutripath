<?php 
include 'database/product.php';
$model = new Product();


$productId = $_GET['product'];
$product = $model->getProductById($productId); 
if (!$product) {
    echo "<script>alert('Product not found'); window.location.replace('myProducts.php');</script>";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        
        $model->delete(); 
        echo "<script>alert('Product deleted successfully'); window.location.replace('products.php');</script>";
        exit;
    } else {
        
        $model->editProduct($productId);
    }
}
?>

<style>
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }

    
    .dashboard-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .form-edit {
        background: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    
    .form-group-edit {
        margin-bottom: 1.5rem;
    }

    .label-edit {
        display: block;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #555;
    }

    .input-edit,
    textarea.input-edit,
    .select-edit {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f5f5f5;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .input-edit:focus,
    textarea.input-edit:focus,
    .select-edit:focus {
        border-color: #4caf50;
    }

    
    .current-image {
        display: block;
        max-width: 100%;
        height: auto;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 5px;
    }

    
    .button-edit,
    .button-delete {
        display: inline-block;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .button-edit {
        background-color: #4caf50;
    }

    .button-edit:hover {
        background-color: #45a049;
    }

    .button-delete {
        background-color: #f44336;
    }

    .button-delete:hover {
        background-color: #d32f2f;
    }

    
    @media (max-width: 768px) {
        .form-edit {
            padding: 1.5rem;
        }

        .label-edit {
            font-size: 12px;
        }

        .input-edit,
        textarea.input-edit,
        .button-edit,
        .button-delete {
            font-size: 14px;
        }
    }

</style>

<div class="dashboard-edit">
    <form class="form-edit" action="editProduct.php?product=<?= $productId; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <div class="form-group-edit">
            <label class="label-edit" for="name">Name of the product:</label>
            <input class="input-edit" type="text" id="name" name="name" value="<?= $product['name']; ?>" required>
        </div>
        <div class="form-group-edit">
            <label class="label-edit" for="description">Description:</label>
            <textarea class="input-edit" id="description" name="description" rows="4" required><?= $product['description']; ?></textarea>
        </div>
        <div class="form-group-edit">
            <label class="label-edit" for="price">Price:</label>
            <input class="input-edit" type="number" id="price" name="price" min="0" step="0.01" value="<?= $product['price']; ?>" required>
        </div>
        <div class="form-group-edit">
            <label class="label-edit" for="image">Current Image:</label>
            <img src="uploads/<?= $product['image']; ?>" alt="<?= $product['name']; ?>" class="current-image">
            <label class="label-edit" for="image">Change Image:</label>
            <input class="input-edit" type="file" id="image" name="image" accept="image/*">
        </div>
        <button class="button-edit" type="submit">Edit Product</button>
        <button class="button-delete" type="submit" name="delete" value="true">Delete Product</button>
    </form>
</div>
