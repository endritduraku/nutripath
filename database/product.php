<?php
class Product
{
    private $server = 'localhost';
    private $username = 'root';
    private $password;
    private $database = 'nutripath_db';
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Connection failed: ' . $ex->getMessage();
        }
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

       
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image = $_FILES["image"]["name"];
        $uploadOk = true;

        
        if ($_FILES["image"]["size"] > 500000) {
            echo "<script>alert('Sorry, your file is too large.')</script>";
            $uploadOk = false;
        }

        
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            echo "<script>alert('Sorry, only JPG, JPEG, and PNG files are allowed.')</script>";
            $uploadOk = false;
        }

        
        if (!$uploadOk) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
            return;
        }

        
        $sql = "INSERT INTO products(name, description, price, image) VALUES (:name, :description, :price, :image)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $description);
        $query->bindParam(':price', $price);
        $query->bindParam(':image', $image);

        
        if ($query->execute() && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file " . basename($_FILES["image"]["name"]) . " has been uploaded.'); window.location.href = 'products.php';</script>";
        } else {
            echo "<script>alert('Sorry, there was an error adding the product or uploading the file.')</script>";
        }
    }

    public function getProducts()
    {
    try {
        $sql = "SELECT * FROM products"; 
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(); 
        
        $products = array(); 
        
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }
        
        return $products; 
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return [];
    }
    }

    public function delete()
        {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return;
            }

            $id = $_POST['id'];
            $query = "DELETE FROM products where id = '$id'";
            if ($this->conn->query($query)) {
                return true;
            } else {
                return false;
            }
        }

    public function getProductById($id)
    {
    try {
        $sql = "SELECT * FROM products WHERE id = :id"; 
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; 
    }
    }


    public function editProduct($id)
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $uploadOk = true;

        if ($_FILES["image"]["size"] > 500000 || !in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo "<script>alert('Invalid file.')</script>";
            return;
        }

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<script>alert('File upload failed.')</script>";
            return;
        }

        $sql = "UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id";
        $params = [':name' => $name, ':description' => $description, ':price' => $price, ':image' => $image, ':id' => $id];
    } else {
        $sql = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
        $params = [':name' => $name, ':description' => $description, ':price' => $price, ':id' => $id];
    }

    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute($params)) {
        echo "<script>alert('Product updated successfully.'); window.location.replace('products.php');</script>";
    } else {
        echo "<script>alert('Product update failed.')</script>";
    }
}

}
?>