<?php
class Address
{


    public function __construct(private PDO $pdo)
    {
    }


    public function store(string $street, string  $city, string $zipcode, int $number) {


        $query = "INSERT into immobilis.addresses(street, city, zipcode, number)
        VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$street,$city,$zipcode,$number]);
        return intval($this->pdo->lastInsertId());                      
    }


    public function update(int $id, string $street, string  $city, string $zipcode, int $number){

        $query = "  UPDATE immobilis.addresses ad
                    JOIN properties pro
                    ON pro.addresses_id = ad.id
                    SET street = ?, city = ?, zipcode = ?, number = ? 
                    WHERE pro.id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$street, $city, $zipcode, $number, $id]);
    }   
}




?>