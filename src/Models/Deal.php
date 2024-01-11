<?php

namespace App\Models;

use App\Database\DB;

class Deal
{
    private string $title;
    private string $type;
    private string $contactId;
    private string $closeDate;
    private int $id;
    function __construct(int $id, string $title, string $type, int $contactId, string $closeDate) {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->contactId = $contactId;
        $this->closeDate = $closeDate;
    }

    public function save() {
        $connection = (new DB())->getConnection();
        $query = "INSERT INTO deals(id, title, type, contact_id, close_date)
            VALUES(:id, :title, :type, :contact_id, :close_date);";

        $stmt = $connection->prepare($query) or die($connection->errorInfo());

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":contact_id", $this->contactId);
        $stmt->bindParam(":close_date", $this->closeDate);

        try {
            $stmt->execute();
        }
        catch (\PDOException $e) {

        }
    }
    public static function getListWithContacts():array
    {
        $connection = (new DB)->getConnection();
        $query = "
            SELECT * FROM deals
            LEFT JOIN contacts 
                on deals.contact_id = contacts.id
            ";
        $stmt = $connection->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return [];
    }
}