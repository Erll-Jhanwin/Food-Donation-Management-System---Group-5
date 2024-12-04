<?php
class User {
    private $conn;
    private $tbl_name = "usersdata";
    private $tbl_food = "foods";
    private $tbl_admin = "admin";

    //for registration
    public $id;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $address;

    //for food donation
    public $f_name;
    public $Meal_type;
    public $f_category;
    public $f_quantity;
    public $u_email;
    public $phoneNum;
    public $date_pickup;
    public $food_donator_name;
    public $donate_date_creation;
    public $status;
    public $donatorAdd;
    public $DonateTo;

    

    public function __construct($db) {
        $this->conn = $db;
    }

    //Query to insert user
    public function create() {
        $query = "INSERT INTO " . $this->tbl_name . " (Name, Email, Phone, Password, Address) VALUES (:name, :email, :phoneNum, :password, :address)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phoneNum', $this->phoneNum);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':address', $this->address);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Query to insert Donation
    public function createDonation() {
        $query = "INSERT INTO " . $this->tbl_food . " (FoodName, MealType, FoodCategory, FoodQuantity, Email, PhoneNumber, DateToPickup, FoodDonatorName, DonateDateCreation, Status, DonatorLocation, DeliverTo) VALUES (:f_name, :Meal_type, :f_category, :f_quantity, :u_email, :phone, :date_pickup, :food_donator_name, :donate_date_creation, :status, :donator_loc, :deliverto)";
       
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':f_name', $this->f_name);
        $stmt->bindParam(':Meal_type', $this->Meal_type);
        $stmt->bindParam(':f_category', $this->f_category);
        $stmt->bindParam(':f_quantity', $this->f_quantity);
        $stmt->bindParam(':u_email', $this->u_email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':date_pickup', $this->date_pickup);
        $stmt->bindParam(':food_donator_name', $this->food_donator_name);
        $stmt->bindParam(':donate_date_creation', $this->donate_date_creation);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':donator_loc', $this->donatorAdd);
        $stmt->bindParam(':deliverto', $this->DonateTo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //retrieve data from the user table
    public function read(){
        $query = "SELECT * FROM " .$this->tbl_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    

    //retrieve all the donations donation
    public function readForDonation(){
        $query = "SELECT * FROM " .$this->tbl_food;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readForDonationOrderDate(){
        $query = "SELECT * FROM " . $this->tbl_food . " ORDER BY DateToPickup ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }



    //login query
    public function login($email){
        $query = "SELECT * FROM " . $this->tbl_food . " WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt;
    }

    //delete data from user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->tbl_name . " WHERE Id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //delete data from donation
    public function deleteDonation($id) {
        $query = "DELETE FROM " . $this->tbl_food . " WHERE Id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Query donations for a specific month and year
    public function readDonationsByMonth($month, $year, $meal){
        $query = "SELECT * FROM " . $this->tbl_food . " WHERE MONTH(DonateDateCreation) = :month AND YEAR(DonateDateCreation) = :year AND MealType=:meal";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':meal', $meal, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    //counting donated food
    public function countDonated($month, $year) {
        $query = "SELECT COUNT(*) FROM " . $this->tbl_food . " WHERE MONTH(DonateDateCreation) = :month AND YEAR(DonateDateCreation) = :year";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    //counting all the food donated by the user
    public function countDonatedByUser($name,$email) {
        $query = "SELECT COUNT(*) FROM " . $this->tbl_food . " WHERE FoodDonatorName = :name AND Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    //counting all the food already picked up, by user
    public function countPickup($name,$email) {
        $query = "SELECT COUNT(*) FROM " . $this->tbl_food . " WHERE Status='Already picked up' AND FoodDonatorName = :name AND Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }



    // Update Donation Details
    public function updateDonation($id) {
        $n_status = "Already picked up";
        $query = "UPDATE " . $this->tbl_food . " SET Status = :n_status 
                WHERE Id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':n_status', $n_status);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //retrieve data from the user table
    public function readAdmin(){
        $query = "SELECT * FROM " .$this->tbl_admin;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


   
}
?>
