<!DOCTYPE html>
<html lang="en">
<head>
    <meta charget="UTF-8">
    <link rel="stylesheet" href="../css/Styles.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    
    <title>Product</title>
    <script>
         function ProductRegistered(name){
               swal({
                    title: "Done!",
                    text: "Product: "+name+" has been saved successfully.",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "green",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                    },
                    function(){
                    window.location.href='../Views/frmRegisterProduct.php';
                    });
            }

            function ProductDeleted(id, name){
               swal({
                    title: "Done!",
                    text: "Product: "+name+" with ID "+id+" has been deleted successfully.",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "green",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                    },
                    function(){
                    window.location.href='../Views/SectionMain.php';
                    });
            }  

            function Update(){
               swal({
                    title: "Done!",
                    text: "Product has been updated successfully.",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "green",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                    },
                    function(){
                    window.location.href='../Views/SectionMain.php';
                    });
            } 
             function ErrorUpdate(){
               swal({
                    title: "Error!",
                    text: "This product couldn't be updated",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "green",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                    },
                    function(){
                    window.location.href='../Views/SectionMain.php';
                    });
            } 
            
   </script>
</head>
<body>
<?php
require('../Connection/stringConnection.php');

class Product {
    private $productID;
    private $name;
    private $description;
    private $quantity;
    private $cost;
    private $con;

    public function __construct() {
        $this->con = dbConnection::connectedDB();
    }

    public function setIdentification($nroid) {
        $this->productID = $nroid;
    }

    public function setName($nomb) {
        $this->name = $nomb;
    }

    public function setDescription($des) {
        $this->description = $des;
    }

    public function setQuantity($quant) {
        $this->quantity = $quant;
    }

    public function setCost($cos) {
        $this->cost = $cos;
    }

    public function registerProduct() {
        $insertSQL = "INSERT INTO tblproductos(productID, name, description, quantity, cost, categID, customID) VALUES(
            '$this->productID','$this->name','$this->description','$this->quantity', '$this->cost', '1', '1')";

        $res = $this->con->query($insertSQL);

        if($res) {
            echo '<script>ProductRegistered("'.$this->name.'");</script>';
           
        } else {
            echo "Registry failed.";
            
            exit();
        }
         $this->con->close();
    }

    public function SearchProductById($id){
        $QueryResult = "SELECT * FROM tblproductos WHERE productID = '$id'";
        $statement = $this->con->query($QueryResult);
        
        if($statement->num_rows>0){
            while($res = $statement->fetch_assoc()){
                echo "<br>".$res["name"]."<br>".$res["description"]."<br>".$res["quantity"]."<br>".$res["cost"];
            }
        }
    }

    public function DeleteProductById($id, $name) {
        $deleteSQL = "DELETE FROM tblproductos WHERE productID = '$id'";
        $sqlResult = $this->con->query($deleteSQL);

        if($sqlResult) {
            echo '<script>ProductDeleted("'.$id.'","'.$name.'");</script>';
        } else {
            echo "Deletion failed.";
            exit();
        }
         $this->con->close();
    }

    public function UpdateProduct(){
        $Set = "UPDATE tblproductos 
        SET name = '$this->name', description = '$this->description', quantity = '$this->quantity', cost = '$this->cost', categID = '1', consumID = '1' 
        WHERE productID = '$this->productID'";
        
        if($this->con->query($Set) == true){
            echo "<script>Update();</script>";
        }else{
            echo "<script>ErrorUpdate();</script>";
        }
        $this->con->close();
    }
    
    public function ShowListProduct(){
            $QueryResult = "SELECT * FROM tblproductos";
            $statement = $this->con->query($QueryResult);
        ?>
        <div id="container-table">
        <table class="table table-striped table-hover table-responsive table-bordered">
            <thead>
              <tr>
                 <th>Id Product</th>
                 <th>Name</th>
                 <th>Description</th>
                 <th>Quantity</th>
                 <th>Cost</th>
                 <th>Category</th>
                 <th><th>
              </tr>             
            </thead>
            <tbody>
            <?php
            if($statement->num_rows > 0){
                while($log = $statement->fetch_assoc()){
                    echo "<tr><form action='../Views/Opcion2.php' method='post'>";
                    echo "<td><input type='number' name='proID' value='".$log['productID']."' readonly /></td>";
                    echo "<td><input type='text' name='proName' value='".$log['name']."' readonly /></td>";
                    echo "<td><input type='text' name='proDes' value='".$log['description']."' readonly /></td>";
                    echo "<td><input type='number' name='proQuan' value='".$log['quantity']."' readonly /></td>";
                    echo "<td><input type='number' name='proCost' value='".$log['cost']."' readonly /></td>";
                    echo "<td><input type='text' name='proCateg' value='".$log['categID']."' readonly /></td>";
                    //echo "<td><input  type='submit' class='btn btn-warning' value='Edit' data-toggle='tooltip' title='Editar'/></td>";
                    echo "<td><button type='submit' class='glyphicon glyphicon-edit btn btn-warning' data-toggle='tooltip' title='Edit' /></td>";
                    echo "<td><button type='submit' class='glyphicon glyphicon-trash btn btn-danger' data-toggle='tooltip' title='Delete' formaction='../Controllers/DeleteController.php' /></td>";
                    echo "</form></tr>";
                }
                 $this->con->close();
             }
             ?>
           </tbody>                  
         </table>
         </div>
          <?php
        }
}
?>
 <script src="../js/jquery-3.1.1.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="../js/sweetalert.min.js"></script>
 <script src="../js/Tooltip.js"></script>
</body>
</html>