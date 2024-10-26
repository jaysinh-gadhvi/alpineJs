<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/includes/connection.php";

use App\Models\Customers;

class Customer
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "core-php", "core-php", "core-php");
        if (!$this->conn) {
            echo "Error: " . mysqli_error($this->conn);
        }
    }

    public function saveCoustomer($data)
    {
        $coustomer_id = $data['id'] ?? null;
        $result = false;
        $action = $coustomer_id ? 'update' : 'create';

        try {
            $result = $coustomer_id
                ? Customers::where('id', $coustomer_id)->update($data)
                : Customers::create($data);

            $message = $coustomer_id ? 'Customer Updated Successfully' : 'Customer Inserted Successfully';
            $status = true;
        } catch (\Throwable $th) {
            $message = 'Invalid Request!';
            $status = false;
        }

        echo json_encode([
            'status' => $status,
            'message' => $result ? $message : "Something Went Wrong!"
        ]);
    }


    public function getCoustomer($id = "")
    {
        $Customers = [];
        if ($id) {
            $Customers = Customers::find($id)->toArray();
        } else {
            $Customers = Customers::get()->toArray();
        }

        echo json_encode([
            'status' => true,
            'data' => $Customers
        ]);
    }

    public function delete($id = "")
    {
        if (!empty($id)) {
            $result = Customers::where('id', $id)->delete();
            echo json_encode([
                'status' => $result,
                'message' => $result ? 'Deleted Successfully' : 'Something Went Wrong!'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'User Id not Found!'
            ]);
        }
    }
}
