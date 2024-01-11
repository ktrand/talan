<?php

namespace App\Models;

use App\Database\DB;

class Contact
{
    private string $name;
    private string $lastName;
    private string $phone;
    private string $email;
    private int $id;
    function __construct(array $fields) {
        $this->init($fields);
    }

    public function save() {
        $connection = (new DB())->getConnection();
        $query = "INSERT INTO contacts(id, name, email, phone, last_name)
            VALUES(:id, :name, :email, :phone, :last_name);";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":last_name", $this->lastName);
        try {
            $stmt->execute();
        }
        catch (\PDOException $e) {

        }

        return $this->id;
    }
    public function getById(int $id){

    }

    private function init(array $fields)
    {
        if ($fields['HAS_EMAIL'] === 'Y') {
            $email = $fields['EMAIL'][0]['VALUE'];
        }
        if ($fields['HAS_PHONE'] === 'Y') {
            $phone = $fields['PHONE'][0]['VALUE'];
        }
        $this->id = $fields['ID'];
        $this->email = $email ?? '';
        $this->phone = $phone ?? '';
        $this->name = $fields['NAME'] ?? '';
        $this->lastName = $fields['LAST_NAME'] ?? '';
    }
}